<?php
/**
 * ColorMag Changelog Parser Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.3.9
 */

defined( 'ABSPATH' ) || exit;

/**
 * ColorMag Changelog Parser.
 */
class ColorMag_Changelog_Parser {

	/**
	 * Get item.
	 *
	 */
	public function get_item( $request ) {
		$changelog = $this->read_changelog();
		$changelog = $this->parse_changelog( $changelog );

		$data = array_search( $request['version'], array_column( $changelog, 'version' ), true );
		if ( false === $data ) {
			return new \WP_Error( 'changelog_not_found', esc_html__( 'Changelog not found.', 'colormag' ) );
		}
		$data = $changelog[ $data ];
		return $this->prepare_item_for_response( $data, $request );
	}

	/**
	 * Check if a given request has access to get items.
	 *
	 */
	public function get_items_permissions_check() {

		if ( ! current_user_can( 'manage_themes' ) ) {
			return new \WP_Error(
				'rest_forbidden',
				esc_html__( 'You are not allowed to access this resource.', 'colormag' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}
		return true;
	}

	/**
	 * Regenerate CSS.
	 *
	 */
	public function get_items() {
		$changelog = $this->read_changelog();
		$changelog = $this->parse_changelog( $changelog );

		return $changelog;
	}

	/**
	 * Read changelog.
	 *
	 * @return \WP_Error|string
	 */
	protected function read_changelog() {
		/**
		 * WP_FIlesystem_Direct instance.
		 *
		 *  @var \WP_Filesystem_Direct $wp_filesystem WP_FIlesystem_Direct instance.
		 */
		global $wp_filesystem;

		if ( ! $wp_filesystem || 'direct' !== $wp_filesystem->method ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			$credentials = request_filesystem_credentials( '', 'direct' );
			WP_Filesystem( $credentials );
		}

		if ( ! $wp_filesystem ) {
			return new \WP_Error( 'filesystem_error', esc_html__( 'Could not access filesystem.', 'colormag' ) );
		}
		$changelog_file = COLORMAG_PARENT_DIR . '/changelog.txt';

		if ( ! $wp_filesystem->exists( $changelog_file ) ) {
			return new \WP_Error( 'changelog_not_found', esc_html__( 'Changelog not found.', 'colormag' ) );
		}

		$raw_changelog = $wp_filesystem->get_contents( $changelog_file );

		if ( ! $raw_changelog ) {
			return new \WP_Error( 'changelog_read_error', esc_html__( 'Failed to read changelog.', 'colormag' ) );
		}

		return $raw_changelog;
	}

	protected function parse_changelog( $raw_changelog ) {
		if ( is_wp_error( $raw_changelog ) ) {
			return $raw_changelog;
		}

		$entries = preg_split( '/(?=\=\s\d+\.\d+\.\d+|\Z)/', $raw_changelog, -1, PREG_SPLIT_NO_EMPTY );
		array_shift( $entries );

		$parsed_changelog = array();

		foreach ( $entries as $entry ) {
			$date    = null;
			$version = null;

			if ( preg_match( '/^= (\d+(\.\d+)+) - (\d+-\d+-\d+) =/m', $entry, $matches ) ) {
				$version = $matches[1] ?? null;
				$date    = $matches[3] ?? null;
			}

			$changes_arr = array();

			if ( preg_match_all( '/^\* (\w+(\s*-\s*.+)?)$/m', $entry, $matches ) ) {
				$changes = $matches[1] ?? null;

				if ( is_array( $changes ) ) {
					foreach ( $changes as $change ) {
						$parts = explode( ' - ', $change );
						$tag   = trim( $parts[0] ?? '' );
						$data  = isset( $parts[1] ) ? trim( $parts[1] ) : '';

						if ( isset( $changes_arr[ $tag ] ) ) {
							$changes_arr[ $tag ][] = $data;
						} else {
							$changes_arr[ $tag ] = array( $data );
						}
					}
				}
			}

			if ( $version && $date && $changes_arr ) {
				$parsed_changelog[] = array(
					'version' => $version,
					'date'    => $date,
					'changes' => $changes_arr,
				);
			}
		}

		return $parsed_changelog;
	}

	/**
	 * Prepare item for response.
	 *
	 * @param array $item Item.
	 * @param \WP_Rest_Request $request Full detail about the request.
	 * @return \WP_Rest_Response
	 */
	public function prepare_item_for_response( $item, $request ) {
		$data     = $this->add_additional_fields_to_object( $item, $request );
		$response = new \WP_REST_Response( $data );
		$response->add_links( $this->prepare_links( $item ) );

		return apply_filters( 'colormag_blocks_prepare_changelog', $response, $item, $request );
	}

	/**
	 * Prepare links for the request.
	 *
	 * @param array $item
	 * @return array
	 */
	protected function prepare_links( $item ) {
		return array(
			'self' => array(
				'href' => rest_url(
					sprintf(
						$item['version']
					)
				),
			),
		);
	}
}



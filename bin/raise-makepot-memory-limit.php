<?php
/**
 * Raises the memory limit for `composer makepot`.
 *
 * Loaded by WP-CLI via --require before `i18n make-pot`. Scanning the whole
 * theme exceeds the default limit on some setups, which fails the release
 * build with no useful error.
 *
 * @package ColorMag
 */

ini_set( 'memory_limit', '512M' ); // phpcs:ignore WordPress.PHP.IniSet.memory_limit_Blacklisted -- Build-time only, never loaded by WordPress.

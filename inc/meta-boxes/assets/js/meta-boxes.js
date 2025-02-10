/**
 * Meta boxes JS for toggle meta box options.
 *
 * @package ColorMag
 */

/**
 * For video post format.
 */
jQuery(document).ready(function () {
	// Hide the div by default.
	jQuery("#post-video-url").hide();
	// If post format is selected, then, display the respective div.
	if (jQuery("#post-format-video").is(":checked")) {
		jQuery("#post-video-url").show();
	}

	// Hiding the default post format type input box by default.
	jQuery('input[name="post_format"]').change(function () {
		jQuery("#post-video-url").hide();
		if (jQuery(this).val() === "video") {
			jQuery("#post-video-url").show();
		} else {
			jQuery("#post-video-url").hide();
		}
	});

	var postFormatSelector;
	setInterval(() => {
		if (!postFormatSelector) {
			postFormatSelector = jQuery('select[id^="post-format-selector"]');
		} else {
			if (
				jQuery('select[id^="post-format-selector"]').val() === "video"
			) {
				jQuery("#post-video-url").show();
			} else {
				jQuery("#post-video-url").hide();
			}
		}
	}, 700);
});

/**
 * Tabs and other settings.
 */
(function ($) {
	// Generate tabs.
	var metaBoxWrap = $("#page-settings-tabs-wrapper");
	metaBoxWrap.tabs();
})(jQuery);

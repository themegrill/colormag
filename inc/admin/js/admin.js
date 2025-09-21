/**
 * Remove activate button and replace with activation in progress button.
 *
 * @package ColorMag
 */

/**
 * Import button
 */
jQuery(document).ready(function ($) {
	$('.btn-get-started').click(function (e) {
		e.preventDefault();

		// Show updating gif icon and update button text.
		$(this)
			.addClass('updating-message')
			.text(colormagRedirectDemoPage.btn_text);

		var btnData = {
			action: 'import_button',
			security: colormagRedirectDemoPage.nonce,
		};

		$.ajax({
			type: 'POST',
			url: ajaxurl, // URL to "wp-admin/admin-ajax.php"
			data: btnData,
			success: function (response) {
				var redirectUri,
					dismissNonce,
					extraUri = '',
					btnDismiss = $('.colormag-message-close');

				if (btnDismiss.length) {
					dismissNonce = btnDismiss
						.attr('href')
						.split('_colormag_notice_nonce=')[1];
					extraUri = '&_colormag_notice_nonce=' + dismissNonce;
				}

				redirectUri = response.redirect;
				window.location.href = redirectUri;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			},
		});
	});
});

jQuery(document).ready(function ($) {
	$('#cm-notification').click(function (e) {
		// Add the 'open' class to the cm-dialog element
		e.stopPropagation(); // Prevent the click event from reaching the document
		$('#cm-dialog').addClass('open');
		$('.wrap').addClass('overlay');
	});

	// Remove 'open' class when clicking on cm-dialog-close
	$('#dialog-close').click(function (e) {
		e.stopPropagation(); // Prevent the click event from reaching the overlay
		$('#cm-dialog').removeClass('open');
		$('.wrap').removeClass('overlay');
	});

	// Close the dialog when clicking outside the dialog area
	$(document).on('click', function (e) {
		if (
			!$('#cm-dialog').is(e.target) &&
			$('#cm-dialog').has(e.target).length === 0
		) {
			$('#cm-dialog').removeClass('open');
			$('.wrap').removeClass('overlay');
		}
	});
});

jQuery(document).ready(function ($) {
	// Access the admin URL from the localized script vars
	var adminUrl = colormagRedirectDemoPage.admin_url;

	var targetUrl = adminUrl + 'themes.php?page=colormag';

	// Get the current page URL
	var currentPage = window.location.href;

	// Loop through each menu item and check if it corresponds to the current page
	$('.cm-dashboard-menu-container ul li').each(function () {
		var pageURL = $(this).find('a').attr('href');
		$;
		// If the page URL matches the current URL, add the 'active' class
		if (currentPage === pageURL) {
			$(this).addClass('active');
		}
	});

	// Check if the current page URL matches the specific URL
	if (currentPage === targetUrl) {
		// Add the 'active' class to the first li
		$('.cm-dashboard-menu-container ul li:first').addClass('active');
	}
});

jQuery(document).ready(function ($) {
	$('.install-plugin, .activate-plugin').on('click', function (e) {
		e.preventDefault();
		var button = $(this);
		var plugin = button.data('plugin');
		var pluginSlug = button.data('slug');
		var action = button.hasClass('install-plugin')
			? 'install_plugin'
			: 'activate_plugin';
		var data = {
			action: action,
			plugin: plugin,
			slug: pluginSlug,
			security: colormagRedirectDemoPage.nonce,
		};

		// Add loading animation and update text
		var originalText = button.html();
		button.html(
			'<i class="fa fa-spinner fa-spin"></i> ' +
				colormagRedirectDemoPage.btn_text,
		);

		$.post(colormagRedirectDemoPage.ajaxurl, data, function (response) {
			// Restore the button text after completion
			button.html('Activated');

			if (response.success) {
				// Optional: You can perform additional actions here if needed.
				if (
					button.hasClass('activate-plugin') ||
					button.hasClass('install-plugin')
				) {
					button.removeClass('activate-plugin install-plugin');
					button.addClass('activated-plugin');

					// Add the 'activated-plugin' class to the parent span
					button.parent('span').addClass('activated');
				}
			} else {
				// Handle the case when the response is not successful
			}
		});
	});
});

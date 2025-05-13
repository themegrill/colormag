/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

(function () {
	var container, button, menu, links, i, len;

	container = document.getElementById('cm-primary-nav');
	if (!container) {
		return;
	}

	button = container.getElementsByClassName('cm-menu-toggle')[0];
	if ('undefined' === typeof button) {
		return;
	}

	menu = container.getElementsByTagName('ul')[0];

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute('aria-expanded', 'false');
	if (-1 === menu.className.indexOf('nav-menu')) {
		menu.className += 'nav-menu';
	}

	button.onclick = function () {
		if (-1 !== container.className.indexOf('cm-mobile-nav')) {
			container.className = container.className.replace(
				'cm-mobile-nav',
				'cm-primary-nav',
			);
			button.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-expanded', 'false');
		} else {
			container.className = container.className.replace(
				'cm-primary-nav',
				'cm-mobile-nav',
			);
			button.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-expanded', 'true');
		}
	};

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName('a');

	// Each time a menu link is focused or blurred, toggle focus.
	for (i = 0, len = links.length; i < len; i++) {
		links[i].addEventListener('focus', toggleFocus, true);
		links[i].addEventListener('blur', toggleFocus, true);
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while (-1 === self.className.indexOf('nav-menu')) {
			// On li elements toggle the class .focus.
			if ('li' === self.tagName.toLowerCase()) {
				if (-1 !== self.className.indexOf('focus')) {
					self.className = self.className.replace(' focus', '');
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	(function (container) {
		var touchStartFn,
			i,
			parentLink = container.querySelectorAll(
				'.menu-item-has-children > a, .page_item_has_children > a',
			);

		if (
			'ontouchstart' in window &&
			window.matchMedia('(min-width: 768px)').matches
		) {
			touchStartFn = function (e) {
				var menuItem = this.parentNode,
					i;

				if (!menuItem.classList.contains('focus')) {
					e.preventDefault();
					for (i = 0; i < menuItem.parentNode.children.length; ++i) {
						if (menuItem === menuItem.parentNode.children[i]) {
							continue;
						}

						menuItem.parentNode.children[i].classList.remove('focus');
					}
					menuItem.classList.add('focus');
				} else {
					menuItem.classList.remove('focus');
				}
			};

			for (i = 0; i < parentLink.length; ++i) {
				parentLink[i].addEventListener('touchstart', touchStartFn, false);
			}
		}
	})(container);
})();

function initMobileNavigation() {
	const container = document.querySelector('.cm-mobile-nav-container');
	if (!container) return;

	const button = container.querySelector('.cm-menu-toggle');
	const menu = container.querySelector('.cm-mobile-menu');
	const mobileArea = container.querySelector('.cm-mobile-header-row');

	// Check if required elements exist
	if (!button || !menu || !mobileArea) return;

	// Define handler function outside addEventListener to maintain reference
	function toggleMobileMenu(e) {
		e.preventDefault();
		// Use e.currentTarget to reference the clicked button (newButton)
		const currentButton = e.currentTarget;
		const expanded = currentButton.getAttribute('aria-expanded') === 'true';

		// Toggle expanded state based on current value
		currentButton.setAttribute('aria-expanded', !expanded);

		if (!expanded) {
			container.classList.add('cm-toggle-open');
			menu.classList.add('cm-mobile-menu--open');
			mobileArea.classList.add('cm-mobile-menu--open');
		} else {
			container.classList.remove('cm-toggle-open');
			menu.classList.remove('cm-mobile-menu--open');
			mobileArea.classList.remove('cm-mobile-menu--open');
		}
	}

	// Remove any existing handler by cloning the element
	const newButton = button.cloneNode(true);
	button.parentNode.replaceChild(newButton, button);

	// Set initial aria state
	newButton.setAttribute('aria-expanded', 'false');

	// Add event listener to the new button
	newButton.addEventListener('click', toggleMobileMenu);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function () {
	initMobileNavigation();
});

// Handle WordPress Customizer events
if (typeof wp !== 'undefined' && wp.customize) {
	wp.customize.bind('preview-ready', function () {
		// Initial run
		initMobileNavigation();

		// Listen for partial content refresh
		wp.customize.selectiveRefresh.bind('partial-content-rendered', function () {
			// Use a slightly longer delay
			setTimeout(initMobileNavigation, 150);
		});

		// Listen for any preview change
		wp.customize.preview.bind('refresh', function () {
			setTimeout(initMobileNavigation, 150);
		});
	});
}

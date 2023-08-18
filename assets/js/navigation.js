/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

(
	function () {
		var container, button, menu, links, i, len;

		container = document.getElementById( 'cm-primary-nav' );
		if ( ! container ) {
			return;
		}

		button = container.getElementsByClassName( 'cm-menu-toggle' )[0];
		if ( 'undefined' === typeof button ) {
			return;
		}

		menu = container.getElementsByTagName( 'ul' )[0];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}

		menu.setAttribute( 'aria-expanded', 'false' );
		if ( - 1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += 'nav-menu';
		}

		button.onclick = function () {
			if ( - 1 !== container.className.indexOf( 'cm-mobile-nav' ) ) {
				container.className = container.className.replace( 'cm-mobile-nav', 'cm-primary-nav' );
				button.setAttribute( 'aria-expanded', 'false' );
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className = container.className.replace( 'cm-primary-nav', 'cm-mobile-nav' );
				button.setAttribute( 'aria-expanded', 'true' );
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// Get all the link elements within the menu.
		links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i ++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( - 1 === self.className.indexOf( 'nav-menu' ) ) {

				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( - 1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
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
		(
			function ( container ) {
				var touchStartFn, i,
				    parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

				if ( 'ontouchstart' in window && window.matchMedia( '(min-width: 768px)' ).matches ) {
					touchStartFn = function ( e ) {
						var menuItem = this.parentNode, i;

						if ( ! menuItem.classList.contains( 'focus' ) ) {
							e.preventDefault();
							for ( i = 0; i < menuItem.parentNode.children.length; ++ i ) {
								if ( menuItem === menuItem.parentNode.children[i] ) {
									continue;
								}

								menuItem.parentNode.children[i].classList.remove( 'focus' );
							}
							menuItem.classList.add( 'focus' );
						} else {
							menuItem.classList.remove( 'focus' );
						}
					};

					for ( i = 0; i < parentLink.length; ++ i ) {
						parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
					}
				}
			}( container )
		);
	}
)();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const cmNavigation = function() {
		const self         = this;

		// Secondary navigation.
		this.secondaryMenu        = document.getElementById( 'cm-drawer-box' );
		this.openSecondaryMenu    = document.querySelector( '.cm-drawer-toggle' );
		this.closeSecondaryMenu   = document.querySelector( '.close-secondary-menu' );
		this.toggleSecondaryBtn   = document.getElementById( 'cm-secondary-menu' );
		this.secondarySubMenu     = this.toggleSecondaryBtn ? this.toggleSecondaryBtn.querySelectorAll( '.sub-menu' ) : null;
		this.secondaryMenuOverlay = document.getElementById( 'cm-secondary-nav-overlay' );

		// this.slideUp = ( target, duration = 300 ) => {
		// 	target.style.transitionProperty = 'height, margin, padding';
		// 	target.style.transitionDuration = duration + 'ms';
		// 	target.style.boxSizing = 'border-box';
		// 	target.style.height = target.offsetHeight + 'px';
		//
		// 	target.offsetHeight;
		//
		// 	target.style.overflow = 'hidden';
		// 	target.style.height = 0;
		// 	target.style.paddingTop = 0;
		// 	target.style.paddingBottom = 0;
		// 	target.style.marginTop = 0;
		// 	target.style.marginBottom = 0;
		//
		// 	window.setTimeout( () => {
		// 		target.style.display = 'none';
		// 		target.style.removeProperty( 'height' );
		// 		target.style.removeProperty( 'padding-top' );
		// 		target.style.removeProperty( 'padding-bottom' );
		// 		target.style.removeProperty( 'margin-top' );
		// 		target.style.removeProperty( 'margin-bottom' );
		// 		target.style.removeProperty( 'overflow' );
		// 		target.style.removeProperty( 'transition-duration' );
		// 		target.style.removeProperty( 'transition-property' );
		// 	}, duration );
		// };
		//
		// this.slideDown = ( target, duration = 500 ) => {
		// 	target.style.removeProperty( 'display' );
		//
		// 	let display = window.getComputedStyle( target ).display;
		//
		// 	if ( display === 'none' ) {
		// 		display = 'block';
		// 	}
		//
		// 	target.style.display = display;
		//
		// 	const height = target.offsetHeight;
		// 	target.style.overflow = 'hidden';
		// 	target.style.height = 0;
		// 	target.style.paddingTop = 0;
		// 	target.style.paddingBottom = 0;
		// 	target.style.marginTop = 0;
		// 	target.style.marginBottom = 0;
		//
		// 	target.offsetHeight;
		//
		// 	target.style.boxSizing = 'border-box';
		// 	target.style.transitionProperty = 'height, margin, padding';
		// 	target.style.transitionDuration = duration + 'ms';
		// 	target.style.height = height + 'px';
		//
		// 	target.style.removeProperty( 'padding-top' );
		// 	target.style.removeProperty( 'padding-bottom' );
		// 	target.style.removeProperty( 'margin-top' );
		// 	target.style.removeProperty( 'margin-bottom' );
		//
		// 	window.setTimeout( () => {
		// 		target.style.removeProperty( 'height' );
		// 		target.style.removeProperty( 'overflow' );
		// 		target.style.removeProperty( 'transition-duration' );
		// 		target.style.removeProperty( 'transition-property' );
		// 	}, duration );
		// };
		//
		// this.slideToggle = ( target, duration = 300 ) => {
		// 	if ( window.getComputedStyle( target ).display === 'none' ) {
		// 		return self.slideDown( target, duration );
		// 	}
		// 	return self.slideUp( target, duration );
		// };
		//
		// this.toggleBtnIconTransition = function ( el ) {
		// 	const toggleInnerEl = el.getElementsByTagName( 'span' );
		//
		// 	Array.from( toggleInnerEl ).forEach( function ( item, index ) {
		// 		item.classList.toggle( 'active' );
		// 	} );
		// };
		//
		// this.trapFocus = function( container, initialFocusIndex = 0 ) {
		// 	container.addEventListener( 'keydown', ( e ) => {
		// 		if ( 'true' !== container.querySelector('.cm-menu-toggle').getAttribute( 'aria-expanded' ) ) { // If toggle off, slide menu.
		// 			return
		// 		}
		//
		// 		let elements ;
		//
		// 		const selectors         = 'a, button, input[type="search"], span[tabindex="0"]'
		// 		const focusableElements = Array.prototype.slice.call( container.querySelectorAll( selectors ) );
		//
		// 		elements = focusableElements.filter( function( element ) {
		// 			return null !== element.closest( '.cm-mobile-nav' ) && null !== element.offsetParent;
		// 		} );
		//
		// 		elements.unshift( document.querySelector( '.cm-menu-toggle' ) );
		//
		// 		const firstEl = elements[ 0 ];
		// 		const lastEl  = elements[ elements.length - 1 ];
		//
		// 		if ( 'Tab' === e.key ) {
		// 			if ( e.shiftKey ) {
		// 				if ( document.activeElement === firstEl ) {
		// 					e.preventDefault();
		// 					lastEl.focus();
		// 				}
		// 			} else {
		// 				if ( document.activeElement === lastEl ) {
		// 					e.preventDefault();
		// 					firstEl.focus();
		// 				}
		// 			}
		// 		}
		// 	} );
		// }
		//
		// this.toggleMobileNavigation = function( e ) {
		// 	e.preventDefault();
		//
		// 	/**
		// 	 * Sets or removes `active` class on toggle icon for transition.
		// 	 */
		// 	self.toggleBtnIconTransition( this );
		//
		// 	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
		// 	self.toggleMenu.classList.toggle( 'cm-open' );
		//
		// 	self.slideToggle( self.toggleMenu, 300 );
		//
		// 	if ( 'true' === self.toggleBtn.getAttribute( 'aria-expanded' ) ) { // If toggle off, slide menu.
		// 		self.toggleBtn.setAttribute( 'aria-expanded', 'false' );
		//
		// 	} else { // If toggle on, slide menu.
		// 		self.toggleBtn.setAttribute( 'aria-expanded', 'true' );
		// 		self.trapFocus( self.mobileMenu, 0 );
		// 	}
		// };

		this.toggleSecondaryNavigation = function( e ) {
			e.preventDefault();

			// Toggle the .toggled class each time the button is clicked.
			self.secondaryMenu.classList.toggle( 'cm-open' );

			if ( 'true' === self.closeSecondaryMenu.getAttribute( 'aria-expanded' ) ) { // If toggle off, slide menu.
				self.closeSecondaryMenu.setAttribute( 'aria-expanded', 'false' );

			} else { // If toggle on, slide menu.
				self.closeSecondaryMenu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// this.toggleTertiaryNavigation = function( e ) {
		// 	e.preventDefault();
		//
		// 	// Toggle the .toggled class each time the button is clicked.
		// 	self.toggleTertiaryMenu.classList.toggle( 'cm-open' );
		// };
		//
		// this.toggleSubMenu = function( e ) {
		// 	e.preventDefault();
		//
		// 	this.classList.toggle( 'active' );
		//
		// 	const targetSubMenu = e.currentTarget.parentNode.querySelector( '.sub-menu' );
		//
		// 	self.slideToggle( targetSubMenu );
		// };
		//
		// /**
		//  * Sets or removes .focus class on an element.
		//  */
		// this.toggleFocus = function () {
		// 	if ( event.type === 'focus' || event.type === 'blur' ) {
		// 		let selfNav = this;
		//
		// 		// Move up through the ancestors of the current link until we hit .nav-menu.
		// 		while ( ! selfNav.classList.contains( 'nav-menu' ) ) {
		// 			// On li elements toggle the class .focus.
		// 			if ( 'li' === selfNav.tagName.toLowerCase() ) {
		// 				selfNav.classList.toggle( 'focus' );
		// 			}
		//
		// 			selfNav = selfNav.parentNode;
		// 		}
		// 	}
		//
		// 	if ( event.type === 'touchstart' ) {
		// 		const menuItem = this.parentNode;
		//
		// 		event.preventDefault();
		//
		// 		for ( const link of menuItem.parentNode.children ) {
		// 			if ( menuItem !== link ) {
		// 				link.classList.remove( 'focus' );
		// 			}
		// 		}
		//
		// 		menuItem.classList.toggle( 'focus' );
		// 	}
		// };
		//
		// this.init = function() {
		//
		// 	// Hide menu toggle button if menu is empty and return early.
		// 	if ( ! self.primaryMenu ) {
		// 		self.toggleBtn.style.display = 'none';
		//
		// 		return;
		// 	}
		//
		// 	if ( ! self.primaryMenu.classList.contains( 'nav-menu' ) ) {
		// 		self.primaryMenu.classList.add( 'nav-menu' );
		// 	}
		//
		// 	if ( self.toggleBtn ) {
		// 		/**
		// 		 * Mobile navigation toggle.
		// 		 */
		// 		self.toggleBtn.addEventListener( 'click', self.toggleMobileNavigation );
		// 	}
		//
			/**
			 * Secondary navigation toggle.
			 */
			if ( self.openSecondaryMenu ) {
				self.openSecondaryMenu.addEventListener( 'click', this.toggleSecondaryNavigation );
				self.closeSecondaryMenu.addEventListener( 'click', this.toggleSecondaryNavigation );
			}
		//
		// 	/**
		// 	 * Tertiary navigation toggle.
		// 	 */
		// 	if ( self.showTertiaryMenu ) {
		// 		self.showTertiaryMenu.addEventListener( 'click', this.toggleTertiaryNavigation );
		// 	}
		//
		// 	// Slide toggle mobile submenu.
		// 	if ( null !== self.mobileSubMenu ) {
		// 		self.mobileSubMenu.forEach( function( item, index ) {
		// 			item.parentNode.querySelector( '.cm-submenu-toggle' ).addEventListener( 'click', self.toggleSubMenu );
		// 		} );
		// 	}
		//
		// 	if ( null !== self.mobileSubMenu ) {
		// 		self.mobileSubMenu.forEach( function( item, index ) {
		// 			item.parentNode.querySelector( '.cm-submenu-toggle' ).addEventListener( 'keypress', self.toggleSubMenu );
		// 		} );
		// 	}
		//
		// 	// Slide toggle secondary submenu.
		// 	if ( null !== self.secondarySubMenu ) {
		// 		self.secondarySubMenu.forEach( function( item, index ) {
		// 			item.parentNode.querySelector( '.cm-submenu-toggle' ).addEventListener( 'click', self.toggleSubMenu );
		// 		} );
		// 	}
		//
		// 	// Toggle focus each time a menu link is focused or blurred.
		// 	for ( const link of this.links ) {
		// 		link.addEventListener( 'focus', this.toggleFocus, true );
		// 		link.addEventListener( 'blur', this.toggleFocus, true );
		// 	}
		//
		// 	// Toggle focus each time a menu link with children receive a touch event.
		// 	for ( const link of this.linksWithChildren ) {
		// 		link.addEventListener( 'touchstart', this.toggleFocus, { passive: true} );
		// 	}
		// };
		//
		// this.init();
	};

	window.cmNavigation = new cmNavigation();
}() );

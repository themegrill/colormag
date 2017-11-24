// For Search Icon Toggle effect added at the top
jQuery( document ).ready( function() {

  jQuery( '.search-top' ).click( function() {
    jQuery( '#masthead .search-form-top' ).toggle();
  });

  jQuery( '#scroll-up' ).hide();

  jQuery( function () {

    jQuery( window ).scroll( function () {
      if ( jQuery( this ).scrollTop() > 1000 ) {
        jQuery( '#scroll-up' ).fadeIn();
      } else {
        jQuery( '#scroll-up' ).fadeOut();
      }
    });

    jQuery( 'a#scroll-up' ).click( function () {
      jQuery( 'body,html' ).animate( {
        scrollTop: 0
      }, 800);
      return false;
    });

  });

  jQuery( '.better-responsive-menu #site-navigation .menu-item-has-children' ).append( '<span class="sub-toggle"> <i class="fa fa-caret-down"></i> </span>' );
  
  jQuery( '.better-responsive-menu #site-navigation .sub-toggle' ).click( function() {
    jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
    jQuery( this ).children( '.fa-caret-right' ).first().toggleClass( 'fa-caret-down' );
    jQuery( this ).toggleClass( 'active' );
  });

  jQuery( document ).on( 'click', '#site-navigation ul li.menu-item-has-children > a', function( event ) {
    var menuClass = jQuery( this ).parent( '.menu-item-has-children' );
    
    if ( ! menuClass.hasClass( 'focus' ) && jQuery( window ).width() <= 768 ){
      menuClass.addClass( 'focus' );
      event.preventDefault();
      menuClass.children( '.sub-menu' ).css({
         'display': 'block'
      });
    }
  });

  /**
   * Scrollbar on fixed responsive menu
   *
   */
  jQuery( window ).load( function() {
    if ( window.matchMedia( "(max-width: 768px)" ).matches && jQuery( '#masthead .sticky-wrapper' ).length >= 1 ) {

        var screenHeight = jQuery( window ).height();
        var availableMenuHeight = screenHeight - 43;
        var menu = jQuery( '#site-navigation' ).find( 'ul' ).first();

        menu.css( 'max-height', availableMenuHeight )
        menu.addClass( 'menu-scrollbar' );
      
    }
  });

});
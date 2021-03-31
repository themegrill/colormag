/**
 * Dimensions JS to handle the background customize option.
 *
 * File `background.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-dimensions'] = wp.customize.Control.extend( {

    ready : function () {

        'use strict';

        var control = this;

        // Top Dimension setting.
        control.container.on( 'change keyup paste input', '.top input', function () {
            control.updateTop();
        } );

        // Right Dimension setting.
        control.container.on( 'change keyup paste input', '.right input', function () {
            control.updateRight();
        } );

        // Left Dimension setting.
        control.container.on( 'change keyup paste input', '.left input', function () {
            control.updateLeft();
        } );

        // Bottom Dimension setting.
        control.container.on( 'change keyup paste input', '.bottom input', function () {
            control.updateBottom();
        } );

    },

    updateTop : function () {

        var control  = this,
            val      = control.setting._value,
            input    = control.container.find( '.dimensions-hidden-value' ),
            newValue = {
                'top' : {}
            };

        control.container.find( '.top .input-wrapper' ).each(
            function () {
                var controlValue = jQuery( this ).find( 'input' ).val();

                newValue['top'] = controlValue;
            }
        );

        // Extend/Update the `val` object to include `newValue`'s new data as an object.
        jQuery.extend( val, newValue );

        jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
        control.setting.set( val );

    },

    updateRight : function () {

        var control  = this,
            val      = control.setting._value,
            input    = control.container.find( '.dimensions-hidden-value' ),
            newValue = {
                'right' : {}
            };

        control.container.find( '.right .input-wrapper' ).each(
            function () {
                var controlValue = jQuery( this ).find( 'input' ).val();

                newValue['right'] = controlValue;
            }
        );

        // Extend/Update the `val` object to include `newValue`'s new data as an object.
        jQuery.extend( val, newValue );

        jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
        control.setting.set( val );

    },

    updateBottom: function () {

        var control  = this,
            val      = control.setting._value,
            input    = control.container.find( '.dimensions-hidden-value' ),
            newValue = {
                'bottom' : {}
            };

        control.container.find( '.bottom .input-wrapper' ).each(
            function () {
                var controlValue = jQuery( this ).find( 'input' ).val();

                newValue['bottom'] = controlValue;
            }
        );

        // Extend/Update the `val` object to include `newValue`'s new data as an object.
        jQuery.extend( val, newValue );

        jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
        control.setting.set( val );

    },

    updateLeft : function () {

        var control  = this,
            val      = control.setting._value,
            input    = control.container.find( '.dimensions-hidden-value' ),
            newValue = {
                'left' : {}
            };

        control.container.find( '.left .input-wrapper' ).each(
            function () {
                var controlValue = jQuery( this ).find( 'input' ).val();

                newValue['left'] = controlValue;
            }
        );

        // Extend/Update the `val` object to include `newValue`'s new data as an object.
        jQuery.extend( val, newValue );

        jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
        control.setting.set( val );

    },

} );
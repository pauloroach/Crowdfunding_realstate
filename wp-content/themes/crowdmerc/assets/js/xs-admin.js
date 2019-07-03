
jQuery( document ).ready( function ( $ ) {
    "use strict";


    var xs_template = jQuery( '#page_template' );

    jQuery( '#wp-content-media-buttons' ).on( 'click', '.button-primary', function () {
        if ( xs_template.val() === 'template/template-multipage-homepage.php' ) {
            xs_template.val( 'template/template-multipage-homepage.php' );
        } else if ( xs_template.val() === 'template/template-blank.php' ) {
            xs_template.val( 'template/template-blank.php' );
        } else if ( xs_template.val() === 'template/template-builder.php' ) {
            xs_template.val( 'template/template-builder.php' );
        } else if ( xs_template.val() === 'template/template-woo.php' ) {
            xs_template.val( 'template/template-woo.php' );
        } else {
            xs_template.val( 'template/template-full-width.php' );
        }
    } );

    jQuery( '#post-body' ).on( 'click', '.page-builder-hide-button', function () {
        xs_template.val( 'default' );
    } );

    xs_template.on( 'change', function () {
        if ( xs_template.val() === 'default' ) {
            jQuery( '.page-builder-hide-button' ).trigger( 'click' );
        } else {
            jQuery( '#wp-content-media-buttons .button-primary' ).trigger( 'click' );
        }
    } );
} );

jQuery(document).ready( function($) {
    $("#xs-donate-charity-modal").change(function(){
        var product_id = $(this).val();

        jQuery.ajax({
            url : donation_level.ajax_url,
            type : 'post',
            data : {
                action : 'donation_level',
                post_id : product_id
            },
            success : function( response ) {
                jQuery('.ajax-donation-level').html(response);
            }
        });
    });
});
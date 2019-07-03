<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $post;
$xs_product = wc_get_product($post->ID);
if($xs_product->get_type() == 'wf_donation'){
    $end_date = get_post_meta( $post->ID, '_wfd_duration_end', true );
}elseif($xs_product->get_type() == 'wp_fundraising'){
    $end_date = get_post_meta( $post->ID, '_wf_duration_end', true );
}else{
    $end_date = '';
}
if (wf_get_option('_wf_hide_campaign_expiry_from_details', 'wf_basics')=='off'):
?>
<div class="xs-single-sidebar xs-mb-40">
    <div class="xs-countdown-timer-wraper">
        <div class="countdown-container xs-countdown-timer-v2" data-countdown="<?php echo $end_date; ?>"></div>
    </div>
</div>
<?php endif; ?>
<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $post, $woocommerce, $product;
$currency = '$';
if ($product->get_type() == 'wp_fundraising') {
    if(is_campaign_valid($post->ID)){
        $recomanded_price = get_post_meta($post->ID, '_wf_funding_recommended_price', true);
        $min_price = get_post_meta($post->ID, '_wf_funding_minimum_price', true);
        $max_price = get_post_meta($post->ID, '_wf_funding_maximum_price', true);
    ?>

        <form enctype="multipart/form-data" method="post" class="cart">
            <div class="xs-single-sidebar">
                <div class="xs-btn-wraper">
                    <?php echo get_woocommerce_currency_symbol(); ?>
                    <input type="number" step="any" placeholder="<?php esc_attr_e('Amount','wp-fundraising');?>" name="wp_donate_amount_field" class="input-text amount wp_donate_amount_field text" value="<?php echo $recomanded_price; ?>" value="<?php echo number_format($recomanded_price,wc_get_price_decimals(),wc_get_price_decimal_separator(), wc_get_price_thousand_separator()); ?>"  min="<?php echo $min_price ?>" max="<?php echo $max_price ?>" >
                    <?php do_action('after_wf_donate_field'); ?>
                    <input type="hidden" value="<?php echo esc_attr($post->ID); ?>" name="add-to-cart">
                    <button type="submit" class="icon-btn xs-btn radius-btn green-btn xs-btn-medium <?php echo apply_filters('add_to_donate_button_class', 'wp_donate_button'); ?>"><?php echo wf_single_invest_now_button_text(); ?></button>
                </div>
            </div>
        </form>

    <?php }else{
        echo wf_single_expired_text();
    }

}elseif ($product->get_type() == 'wf_donation') { 
    ?>
    <form enctype="multipart/form-data" method="post" class="cart xs-donation-form" >
        <div class="xs-input-group">
            <label for="xs-donate-name"><?php esc_html_e('Donation Amount ','wp-fundraising');?><span class="color-light-red">**</span></label>
            <input type="text" name="wp_donate_amount_field" id="xs-donate-name" class="form-control" placeholder="<?php esc_attr_e('Custom Amount','wp-fundraising');?>">
        </div>
        <?php
        $donation_level_fields = get_post_meta($post->ID, 'repeatable_donation_level_fields', true);
        ?>
        <?php if ( $donation_level_fields ) : ?>
            <div class="xs-input-group">
                <label for="xs-donate-charity"><?php esc_html_e('List of Donation Level ','wp-fundraising');?><span class="color-light-red" >**</span></label>
                <select id="xs-donate-charity" class="form-control">
                    <option value=""><?php esc_html_e('Select Amount','wp-fundraising');?></option>
                    <?php foreach ( $donation_level_fields as $field ) { ?>
                        <option value="<?php echo esc_attr( $field['_wf_donation_level_amount'] ); ?>"><?php echo wf_price(esc_attr( $field['_wf_donation_level_amount'] )); ?></option>
                    <?php } ?>
                    <option value="custom"><?php esc_html_e('Give a Custom Amount','wp-fundraising');?></option>
                </select>
            </div>
        <?php endif; ?>
        <?php do_action('after_wf_donate_field'); ?>
        <input type="hidden" value="<?php echo esc_attr($post->ID); ?>" name="add-to-cart">
        <button type="submit" class="btn btn-primary"><span class="badge"><i class="fa fa-heart"></i></span> <?php echo wf_donate_now_button_text(); ?></button>
    </form>
    <?php 
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'wp_fundraising_login_btn','wp_fundraising_login_btn_shortcode_html' );
function wp_fundraising_login_btn_shortcode_html($atts = array()) {
    extract(shortcode_atts(
        array(
            'label' => esc_html__('Log In','wp-fundraising'),
        ), $atts)
    );

    ob_start();
    if(!is_user_logged_in()): ?>

    <a href="" data-toggle="modal" data-target=".<?php echo wf_login_signup_modal_class();?>">
        <?php echo esc_html($label);?>
    </a>
    <?php
    endif;
    return ob_get_clean();
}
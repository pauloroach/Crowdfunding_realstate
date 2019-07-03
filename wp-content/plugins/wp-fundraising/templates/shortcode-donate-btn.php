<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'wp_fundraising_donate_btn','wp_fundraising_donate_btn_shortcode_html' );
function wp_fundraising_donate_btn_shortcode_html() {
    ob_start(); ?>
    <div class="xs-btn-wraper">
        <a class="btn btn-primary" href="" data-toggle="modal" data-target=".bd-donate-modal-lg">Donate Now</a>
    </div>

    <?php
    return ob_get_clean();
}
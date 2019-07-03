<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'wp_fundraising_search_shortcode','wp_fundraising_search_shortcode_data' );
function wp_fundraising_search_shortcode_data() {
    ob_start(); ?>
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( "Search","wp-fundraising" ); ?>" value="" name="s">
        <input type="hidden" name="post_type" value="product">
        <input type="hidden" name="product_type" value="wp_fundraising">
        <button type="submit"><?php esc_html_e( "Search" , "wp-fundraising" ); ?></button>
    </form>
    <?php
    return ob_get_clean();
}
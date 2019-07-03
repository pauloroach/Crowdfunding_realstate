<?php

/**
 * functions.php
 *
 * The theme's functions and definitions.
 */
/**
 * 1.0 - Define constants. Current Version number & Theme Name.
 */
define('CROWDMERC_THEME', 'crowdmerc WordPress Theme');
define('CROWDMERC_VERSION', '1.0');
define('CROWDMERC_THEMEROOT', get_template_directory_uri());
define('CROWDMERC_THEMEROOT_DIR', get_parent_theme_file_path());
define('CROWDMERC_IMAGES', CROWDMERC_THEMEROOT . '/assets/images');
define('CROWDMERC_IMAGES_DIR', CROWDMERC_THEMEROOT_DIR . '/assets/images');
define('CROWDMERC_IMAGES_DIR_URI', CROWDMERC_THEMEROOT . '/assets/images' );
define('CROWDMERC_CSS', CROWDMERC_THEMEROOT . '/assets/css');
define('CROWDMERC_CSS_DIR', CROWDMERC_THEMEROOT_DIR . '/assets/css');
define('CROWDMERC_SCRIPTS', CROWDMERC_THEMEROOT . '/assets/js');
define('CROWDMERC_SCRIPTS_DIR', CROWDMERC_THEMEROOT_DIR . '/assets/js');
define('CROWDMERC_PHPSCRIPTS', CROWDMERC_THEMEROOT . '/assets/php');
define('CROWDMERC_PHPSCRIPTS_DIR', CROWDMERC_THEMEROOT_DIR . '/assets/php');
define('CROWDMERC_INC', CROWDMERC_THEMEROOT_DIR . '/inc');
define( 'CROWDMERC_CUSTOMIZER_DIR', CROWDMERC_INC . '/customizer/' );
define( 'CROWDMERC_SHORTCODE_DIR', CROWDMERC_INC . '/shortcode/' );
define( 'CROWDMERC_SHORTCODE_DIR_STYLE', CROWDMERC_INC . '/shortcode/style' );
define( 'CROWDMERC_PLUGINS_DIR', CROWDMERC_INC . '/includes/plugins' );
define( 'CROWDMERC_REMOTE_CONTENT', 'http://xpeedstudio.net/demo-content/crowdmerc' );







/**
 * ----------------------------------------------------------------------------------------
 * 3.0 - Set up the content width value based on the theme's design.
 * ----------------------------------------------------------------------------------------
 */
if (!isset($content_width)) {
    $content_width = 800;
}



/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('crowdmerc_setup')) {

    function crowdmerc_setup() {
	/**
	 * Make the theme available for translation.
	 */
	$lang_dir = CROWDMERC_THEMEROOT . '/languages';
	load_theme_textdomain('crowdmerc', $lang_dir);

	/**
	 * Add support for post formats.
	 */
	add_theme_support('post-formats', array()
	);
	
	/**
	 * Add support for automatic feed links.
	 */
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');


	/**
	 * Add support for post thumbnails.
	 */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(750, 465, array('center', 'center')); // Hard crop center center
	add_image_size('crowdmerc-crowd', 360, 227, TRUE);

	/**
	 *
	 * woocommerce
	 *
	*/
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	/**
	 * Register nav menus.
	 */
	register_nav_menus(
		array(
		    'primary' => esc_html__('Main Menu', 'crowdmerc')
		)
	);
	register_nav_menus(
		array(
		    'footer' => esc_html__('Footer Menu', 'crowdmerc')
		)
	);
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
	    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
    }

	add_action('after_setup_theme', 'crowdmerc_setup');
	
	/*
	 * Enable support for wide alignment class for Gutenberg blocks.
	 */
	add_theme_support( 'align-wide' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - theme INC.
 * ----------------------------------------------------------------------------------------
 */
include_once get_template_directory() . '/inc/init.php';
if(class_exists('WP_FundRaising')) {
    add_action('wf_wc_before_main_loop', 'crowdmerc_before_single_shop');
    add_filter('wf_single_fund_raised_percent_text','crowdmerc_single_custom_fund_raised_text');
    add_filter('wf_single_related_campaign_title','crowdmerc_single_related_campaign_title');
    function crowdmerc_before_single_shop()
    {
        get_template_part('template-parts/header/content', 'shop-header');
    }

    function crowdmerc_single_custom_fund_raised_text(){
        return  esc_html__('Funds Raised', 'crowdmerc');
    }

    function crowdmerc_single_related_campaign_title(){
        return  sprintf(
            '<h2 class="color-navy-blue">%s</h2><span class="xs-separetor dashed-separetor fundpress-separetor"></span>' ,
            esc_html__('Other Causes', 'crowdmerc')
        );
    }
}
add_filter( 'woocommerce_order_button_text', 'crowdmerc_custom_order_button_text' );

function crowdmerc_custom_order_button_text() {
    return esc_html__( 'Fund this campaign', 'crowdmerc' );
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

add_action( 'admin_menu', 'crowdmerc_remove_theme_settings', 999 );
function crowdmerc_remove_theme_settings() {
    remove_submenu_page( 'themes.php', 'fw-settings' );
}

// Add this to your theme functions.php file. Change sidebar id to your primary sidebar id.
function crowdmerc_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    return $classes;
}
add_filter( 'body_class','crowdmerc_body_classes' );

add_action('enqueue_block_editor_assets', 'crowdmerc_action_enqueue_block_editor_assets' );
function crowdmerc_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'crowdmerc-gutenberg-editor-customizer-styles', CROWDMERC_CSS . '/gutenberg-editor.css', null, CROWDMERC_VERSION );
}
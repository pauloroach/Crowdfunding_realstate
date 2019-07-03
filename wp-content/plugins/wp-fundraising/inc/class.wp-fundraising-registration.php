<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}




class WP_Fundraising_Registration{
    /**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    /**
     * Plugin Name
     *
     * @since 1.0
     *
     */
    public $plugin_name = 'WP Fundraising Login and Registration';

    /**
     * Plugin Version
     *
     * @since 1.0
     *
     */

    public $plugin_version = '1.0.0';

    /**
     * Plugin File
     *
     * @since 1.0
     *
     */

    public $file = __FILE__;


    public $base;


    /**
     * Load Construct
     * @since 1.0
     *
     */

    public function __construct(){
        $this->wp_fundraising_plugin_init();
    }

    /**
     * Plugin Initialization
     * @since 1.0
     *
     */

    public function wp_fundraising_plugin_init(){

        add_action( 'wp_enqueue_scripts', array( $this, 'wp_fundraising_enqueue_scripts'));
        include_once WP_FUNDRAISING_DIR_PATH . '/inc/class.wp-fundraising-registration-function.php';
        include_once WP_FUNDRAISING_DIR_PATH . '/templates/shortcode-registration.php';
    }

    /**
     * Enqueue Script
     * @since 1.0
     *
     */
    public function wp_fundraising_enqueue_scripts(){

        wp_enqueue_script('fundpress-registration-ajax', WP_FUNDRAISING_DIR_URL . 'assets/js/registration.js', array('jquery'), '', true);

        /*Ajax Call*/
        $params = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('wp_fundraising_security_check'),
        );
        wp_localize_script('fundpress-registration-ajax', 'wp_fundraising_check_obj', $params);
    }

    public static function wp_fundraising_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new WP_Fundraising_Registration();
        }
        return self::$_instance;
    }
}

$WP_Fundraising_Registration = WP_Fundraising_Registration::wp_fundraising_get_instance();
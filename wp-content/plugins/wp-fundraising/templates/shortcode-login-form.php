<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class WP_Fundraising_Login_Form_Shortcode{

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
    public $plugin_name = 'WP Fundraising';

    /**
     * Plugin Version
     *
     * @since 1.0
     *
     */

    public $plugin_version = '1.0';

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
        $this->wp_fundraising_init_login_form_shortcode();
    }

    public function wp_fundraising_init_login_form_shortcode(){
        add_shortcode('wp_fundraising_registration_form', array($this,'wp_fundraising_show_login_form_shortcode'));
    }

    public function wp_fundraising_show_login_form_shortcode($atts, $content = NULL){
        ob_start();
        ?>
        <div id="fundpress-lregister-wrapper">
            <?php
            if(!is_user_logged_in()){
                require WP_FUNDRAISING_DIR_PATH. '/templates/content-registration.php';
            }
            ?>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function wp_fundraising_login_form_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new WP_Fundraising_Login_Form_Shortcode();
        }
        return self::$_instance;
    }

}

WP_Fundraising_Login_Form_Shortcode::wp_fundraising_login_form_get_instance();
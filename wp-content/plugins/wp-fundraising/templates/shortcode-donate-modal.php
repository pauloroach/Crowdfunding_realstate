<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class WP_Fundraising_Donate_Modal_Shortcode{

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
        $this->wp_fundraising_init_donate_modal_shortcode();
    }

    public function wp_fundraising_init_donate_modal_shortcode(){
        add_shortcode('wp_fundraising_donate_modal', array($this,'wp_fundraising_show_donate_modal_shortcode'));
    }

    public function wp_fundraising_show_donate_modal_shortcode($atts, $content = NULL){

        extract(shortcode_atts(
                array(
                    'name' => '',
                ), $atts)
        );
        ob_start();
        ?>
        <div id="fundpress-donation-modal-wrapper">
            <?php require WP_FUNDRAISING_DIR_PATH. '/templates/content-donate-modal.php'; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function wp_fundraising_donate_modal_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new WP_Fundraising_Donate_Modal_Shortcode();
        }
        return self::$_instance;
    }

}

WP_Fundraising_Donate_Modal_Shortcode::wp_fundraising_donate_modal_get_instance();
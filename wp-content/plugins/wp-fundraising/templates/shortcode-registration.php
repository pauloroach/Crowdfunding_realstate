<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class WP_Fundraising_Registration_Shortcode{

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
        $this->wp_fundraising_init_shortcode();
    }

    public function wp_fundraising_init_shortcode(){
        add_shortcode('wp_fundraising_registration', array($this,'wp_fundraising_show_shortcode'));
    }

    public function wp_fundraising_show_shortcode($atts, $content = NULL){

        extract(shortcode_atts(
                array(
                    'name' => '',
                ), $atts)
        );
        ob_start();
        ?>
        <div id="fundpress-lregister-wrapper">
            <div class="modal xs-modal fade <?php echo wf_login_signup_modal_class();?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-default">
                    <div class="modal-content">
                        <?php
                        if(!is_user_logged_in()){
                            require WP_FUNDRAISING_DIR_PATH. '/templates/content-registration.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function wp_fundraising_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new WP_Fundraising_Registration_Shortcode();
        }
        return self::$_instance;
    }

}

WP_Fundraising_Registration_Shortcode::wp_fundraising_get_instance();
<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WF_Shortcode{
	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
	public static $_instance;
	/**
     * Load Construct
     * 
     * @since 1.0
     */
	public function __construct(){
		add_action('elementor/init', array($this, 'wf_elementor_init'));
        add_action('elementor/widgets/widgets_registered', array($this, 'wf_shortcode_elements'));
	}
    /**
     * Enqueue Scripts
     *
     * @return void
     */

    public function wf_elementor_init(){
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'wf-elements',
            [
                'title' =>esc_html__( 'WP Fundraising', 'wp-fundraising' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }
    public function wf_shortcode_elements($widgets_manager){

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-campaigns.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Campaigns_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-campaign-submit-form.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Campaign_Submit_Form_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-login-btn.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Login_Btn_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-donate-form.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Donate_Form_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-donate-btn.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Donate_Btn_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-dashboard.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Dashboard_Widget());

        require_once WP_FUNDRAISING_DIR_PATH.'inc/builder-support/elementor/wf-registration-form.php';
        $widgets_manager->register_widget_type(new Elementor\WF_Registration_Form_Widget());

    }
	public static function wf_get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new WF_Shortcode();
        }
        return self::$_instance;
    }
}
$WF_Shortcode = WF_Shortcode::wf_get_instance();
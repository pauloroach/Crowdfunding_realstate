<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Shortcode{

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

		add_action('elementor/init', array($this, 'xs_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'xs_icon_pack' ), 11 );
        add_action('elementor/widgets/widgets_registered', array($this, 'xs_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );
	}


    /**
     * Enqueue Scripts
     *
     * @return void
     */
    
     public function enqueue_scripts() {
        wp_enqueue_script( 'xs-main-elementor', CROWDMERC_SCRIPTS . '/elementor.js',array( 'jquery', 'elementor-frontend' ), CROWDMERC_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'xs-icon-elementor', CROWDMERC_CSS.'/iconfont.css',null, CROWDMERC_VERSION );
    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {
        wp_enqueue_style('xs-admin-elementor', CROWDMERC_CSS . '/elementor-admin.css', null, CROWDMERC_VERSION);
    }
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function xs_elementor_init(){
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'crowdmerc-elements',
            [
                'title' =>esc_html__( 'Crowdmerc', 'crowdmerc' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */

    public function xs_icon_pack( $controls_manager ) {

        require_once CROWDMERC_SHORTCODE_DIR. 'controls/xs-icon.php';

        $controls = array(
            $controls_manager::ICON => 'Xs_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }

    public function xs_shortcode_elements($widgets_manager){
        require_once CROWDMERC_SHORTCODE_DIR.'xs-map.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-heading.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-button.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-icon-box.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-image-box.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-blog.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-partner.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-shape-background.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-gallery.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-video.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-team.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-testimonial.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-faq.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-event.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-event-tab.php';
        require_once CROWDMERC_SHORTCODE_DIR.'xs-contact-info.php';

        $widgets_manager->register_widget_type(new Elementor\Xs_Maps_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Heading_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Button_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Icon_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Image_Box_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Post_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Partner_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Shape_Background_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Gallery_Widget());
        $widgets_manager->register_widget_type(new Elementor\XS_Video_Widget());
        $widgets_manager->register_widget_type(new Elementor\XS_Team_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Testimonial_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Faq_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Event_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Event_Tab_Widget());
        $widgets_manager->register_widget_type(new Elementor\Xs_Contact_Info_Widget());

        if(class_exists('WP_FundRaising')){
            require_once CROWDMERC_SHORTCODE_DIR.'xs-crowdfunding.php';
            require_once CROWDMERC_SHORTCODE_DIR.'xs-featured-crowdfunding.php';
            require_once CROWDMERC_SHORTCODE_DIR.'xs-crowdfunding-cat.php';
            $widgets_manager->register_widget_type(new Elementor\Xs_Crowdfunding_Widget());
            $widgets_manager->register_widget_type(new Elementor\Xs_Featured_Crowdfunding_Widget());
            $widgets_manager->register_widget_type(new Elementor\Xs_Crowdfunding_Cat_Widget());
        }
        
    }
    
	public static function xs_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Xs_Shortcode();
        }
        return self::$_instance;
    }

}
$Xs_Shortcode = Xs_Shortcode::xs_get_instance();
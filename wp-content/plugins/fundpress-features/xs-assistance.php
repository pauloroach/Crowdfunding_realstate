<?php
/**
 Plugin Name: FundPress Features
 Plugin URI:http://xpeedstudio.com
 Description: FundPress Features is a plugin for our FundPress Theme.
 Author: xpeedstudio
 Author URI: http://xpeedstudio.com
 Version:1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define("XS_PLUGIN_DIR", plugin_dir_path(__FILE__ ));

class Xs_Main{

	/**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     */
    
	public static $_instance;

	/**
     * Plugin Name
     *
     * @since 1.0.0
     *
     */

	public $plugin_name = 'Finances Assistance';

	/**
     * Plugin Version
     *
     * @since 1.0.0
     *
     */

	public $plugin_version = '1.0.0';

	/**
     * Plugin File
     *
     * @since 1.0.0
     *
     */

	public $file = __FILE__;

	/**
     * Load Construct
     * 
     * @since 1.0.0
     */

	public function __construct(){
		$this->xs_plugin_init();
	}

	/**
     * Plugin Initialization
     *
     * @since 1.0.0
     *
     */

	public function xs_plugin_init(){

		require_once (plugin_dir_path($this->file). 'post-type/xs-post-class.php');
		
	}
    
    public function get_footer_widget($xs_widget){
        if($xs_widget){

            register_sidebar(
                array(
                    'name'           => esc_html__( 'Footer 1', 'fundpress' ),
                    'id'             => 'footer-widget-1',
                    'description'    => esc_html__( 'Appears on posts and pages.', 'fundpress' ),
                    'before_widget'  => '<div class="footer-widget"><div id="%1$s" class="fundpress-single-footer %2$s">',
                    'after_widget'   => '</div></div>',
                    'before_title'   => '<div class="xs-footer-title"><h4 class="color-white">',
                    'after_title'    => '</h4></div>',
                )
            );

            register_sidebar(
                array(
                    'name'           => esc_html__( 'Footer 2', 'fundpress' ),
                    'id'             => 'footer-widget-2',
                    'description'    => esc_html__( 'Appears on posts and pages.', 'fundpress' ),
                    'before_widget'  => '<div class="footer-widget"><div id="%1$s" class="fundpress-single-footer %2$s">',
                    'after_widget'   => '</div></div>',
                    'before_title'   => '<div class="xs-footer-title"><h4 class="color-white">',
                    'after_title'    => '</h4></div>',
                )
            );

            register_sidebar(
                array(
                    'name'           => esc_html__( 'Footer 3', 'fundpress' ),
                    'id'             => 'footer-widget-3',
                    'description'    => esc_html__( 'Appears on posts and pages.', 'fundpress' ),
                    'before_widget'  => '<div class="footer-widget"><div id="%1$s" class="fundpress-single-footer %2$s">',
                    'after_widget'   => '</div></div>',
                    'before_title'   => '<div class="xs-footer-title"><h4 class="color-white">',
                    'after_title'    => '</h4></div>',
                )
            );

            register_sidebar(
                array(
                    'name'           => esc_html__( 'Footer 4', 'fundpress' ),
                    'id'             => 'footer-widget-4',
                    'description'    => esc_html__( 'Appears on posts and pages.', 'fundpress' ),
                    'before_widget'  => '<div class="footer-widget"><div id="%1$s" class="fundpress-single-footer %2$s">',
                    'after_widget'   => '</div></div>',
                    'before_title'   => '<div class="xs-footer-title"><h4 class="color-white">',
                    'after_title'    => '</h4></div>',
                )
            );
        }
        
    }

	public static function xs_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Xs_Main();
        }
        return self::$_instance;
    }

}
$Xs_Main = Xs_Main::xs_get_instance();
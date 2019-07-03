<?php

/* ---------------------------------------------------------
 * Enqueue
 *
 * Class for including Javascript and CSS files
  ---------------------------------------------------------- */

class WP_Fundraising_Enqueue {

    public static $css;
    public static $js;
    public static $admin_css;

    /**
     * Configuration array for stylesheet that will be loaded
     */
    static function wf_load_css() {

        // array with CSS file to load

        static::$css = array(
            'wf-bootstrap'=>  WP_FUNDRAISING_DIR_URL. 'assets/css/bootstrap.min.css',
            'wf-iconfont'=>  WP_FUNDRAISING_DIR_URL. 'assets/css/iconfont.css',
            'wf-style'=>  WP_FUNDRAISING_DIR_URL. 'assets/css/style.css'
		);
        // enqueue files
        WP_Fundraising_Enqueue::wf_enqueue_css();
    }

    /**
     * Configuration array for Javascript files that will be loaded
     */
    static function wf_load_js() {

      
        static::$js = array(
            'wf-Popper' => WP_FUNDRAISING_DIR_URL. 'assets/js/Popper.js',
            'wf-bootstrap' => WP_FUNDRAISING_DIR_URL. 'assets/js/bootstrap.min.js',
            'wf-jquery-waypoints' => WP_FUNDRAISING_DIR_URL. 'assets/js/jquery.waypoints.min.js',
            'wf-jquery-countdown' => WP_FUNDRAISING_DIR_URL. 'assets/js/jquery.countdown.min.js',
            'wf-jquery-easypiechart' => WP_FUNDRAISING_DIR_URL. 'assets/js/jquery.easypiechart.min.js',
            'wf-main' => WP_FUNDRAISING_DIR_URL. 'assets/js/main.js'

        );

        // enqueue files
        WP_Fundraising_Enqueue::wf_enqueue_js();
    }

    /**
     * Enqueue Javascript and CSS file to admin
     */
    static function wf_load_admin_css_js() {

        // array with admin css files
        static::$admin_css = array(
            'wf-admin' => WP_FUNDRAISING_DIR_URL. '/assets/css/admin.css'
        );

        // enqueue files
        WP_Fundraising_Enqueue::wf_enqueue_admin_css_js();
    }

    /**
     * Enqueue CSS files
     */
    static function wf_enqueue_css() {

        // concate full url to file by add url prefix to css dir
        static::$css = array_map( 'wf_enqueue_css_prefix', static::$css );

        // allow modifiying array of css files that will be loaded
        static::$css = apply_filters( 'wf_css_files', static::$css );

        // loop through files and enqueue
        foreach ( static::$css as $key => $value ) {

            // if value is array it means dependency and $media might be set
            if ( is_array( $value ) ) {
                $file = isset( $value[0] ) ? $value[0] : '';
                $dependency = isset( $value[1] ) ? $value[1] : '';
                $media = isset( $value[2] ) ? $value[2] : 'all';

                wp_enqueue_style( $key, $file, $dependency, '', $media );
            } else {
                wp_enqueue_style( $key, $value, '', '' );
            }
        }

    }

    /**
     * Enqueue Javascript files
     */
    static function wf_enqueue_js() {

        // concate full url to file by add url prefix to js dir
        static::$js = array_map( 'wf_enqueue_js_prefix', static::$js );

        // allow modifiying array of javascript files that will be loaded
        static::$js = apply_filters( 'wf_js_files', static::$js );

        // Enqueue Javascript
        wp_enqueue_script( 'jquery' );

        wp_enqueue_media();

        // loop through files and enqueue
        foreach ( static::$js as $key => $value ) {

            // if value is array it means dependency and $in_footer might be set
            if ( is_array( $value ) ) {
                $file = isset( $value[0] ) ? $value[0] : '';
                $dependency = isset( $value[1] ) ? $value[1] : '';
                $in_footer = isset( $value[2] ) ? $value[2] : true;

                wp_enqueue_script( $key, $file, $dependency, '', $in_footer );
            } else {

                wp_enqueue_script( $key, $value, '', '', true );
            }
        }
    }

    static function add_ajax_donation_level()
    {
        wp_enqueue_script( 'donation-level-script', WP_FUNDRAISING_DIR_URL. 'assets/js/ajax-donation-level.js', array('jquery') );
    }

    /**
     * Enqueue Javascript and CSS file to admin
     */
    static function wf_enqueue_admin_css_js() {

        // allow modifiying array of css files that will be loaded
        static::$admin_css = apply_filters( 'wf_admin_css_files', static::$admin_css );
        wp_enqueue_script( 'wp-color-picker');
        // loop through array of admin css files and load them
        foreach ( static::$admin_css as $key => $value ) {

            wp_enqueue_style( $key, $value );
        }
    }

    /**
     * Make certain options available on front-end
     */
    static function wf_localize_script() {
        wp_localize_script( 'donation-level-script', 'donation_level', array( 'ajax_url' => admin_url('admin-ajax.php')) );
    }

}
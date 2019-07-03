<?php

/*
Plugin Name: Ultimate Shortcodes Addon for King Composer
Plugin URI: http://demo.themebon.com/
Description: 
Author: WPeffects
Author URI: http://demo.themebon.com/
Version: 1.0.4
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if(!function_exists('is_plugin_active')){
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
    require_once ( 'shortcodes/wf_kc_campaigns/wf-campaigns-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_campaign_submit_form/wf-kc-campaign-submit-form-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_login_btn/wf-kc-login-btn-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_donate_btn/wf-kc-donate-btn-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_donate_form/wf-kc-donate-form-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_registration_form/wf-kc-registration-form-shortcode.php' );
    require_once ( 'shortcodes/wf_kc_dashboard/wf-kc-dashboard-shortcode.php' );
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WP_Fundraising_Frontend_Account_Submit_Form')) {

    class WP_Fundraising_Frontend_Account_Submit_Form{

        protected static $_instance;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_action('init', 'WP_Fundraising_Frontend_Account_Submit_Form::wp_fundraising_frontend_account_data_save');
        }


        public static function wp_fundraising_frontend_account_data_save(){
            if (isset($_POST["userUpdate"])) {

                $current_user = wp_get_current_user();

                $userEmail = $userFName = $userLName = $userBio = $userWebSite = '';

                if( isset($_POST['userEmail']) ){
                    $userEmail = sanitize_text_field($_POST['userEmail']);
                }
                if( isset($_POST['userFName']) ){
                    $userFName = sanitize_text_field($_POST['userFName']);
                }
                if( isset($_POST['userLName']) ){
                    $userLName = sanitize_text_field($_POST['userLName']);
                }
                if( isset($_POST['userWebSite']) ){
                    $userWebSite = sanitize_text_field($_POST['userWebSite']);
                }
                if( isset($_POST['userBio']) ){
                    $userBio = sanitize_textarea_field($_POST['userBio']);
                }

                $user_data = array(
                    'ID' => $current_user->ID,
                    'user_email' => $userEmail,
                    'user_url' => $userWebSite,
                );


                if (isset($_POST["userUpdate"])) {
                    $user_id = wp_update_user($user_data);

                    update_user_meta( $user_id, 'description', $userBio );
                    update_user_meta( $user_id, 'first_name', $userFName );
                    update_user_meta( $user_id, 'last_name', $userLName );
                    update_user_meta( $user_id, 'description', $userBio );
                }

            }
        }
    }
}

//Run this class now
WP_Fundraising_Frontend_Account_Submit_Form::instance();
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WP_Fundraising_Frontend_Address_Submit_Form')) {

    class WP_Fundraising_Frontend_Address_Submit_Form{

        protected static $_instance;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_action('init', 'WP_Fundraising_Frontend_Address_Submit_Form::wp_fundraising_frontend_address_data_save');
        }


        public static function wp_fundraising_frontend_address_data_save(){

            $user_id = get_current_user_id();

            if (isset($_POST["userShippingUpdate"])) {

                if( isset($_POST['shipping_first_name']) ){
                    $shipping_first_name = sanitize_text_field($_POST['shipping_first_name']);
                }
                if( isset($_POST['shipping_last_name']) ){
                    $shipping_last_name = sanitize_text_field($_POST['shipping_last_name']);
                }
                if( isset($_POST['shipping_company']) ){
                    $shipping_company = sanitize_text_field($_POST['shipping_company']);
                }
                if( isset($_POST['shipping_address_1']) ){
                    $shipping_address_1 = sanitize_textarea_field($_POST['shipping_address_1']);
                }
                if( isset($_POST['shipping_address_2']) ){
                    $shipping_address_2 = sanitize_textarea_field($_POST['shipping_address_2']);
                }
                if( isset($_POST['shipping_city']) ){
                    $shipping_city = sanitize_text_field($_POST['shipping_city']);
                }
                if( isset($_POST['shipping_postcode']) ){
                    $shipping_postcode = sanitize_text_field($_POST['shipping_postcode']);
                }
                if( isset($_POST['shipping_country']) ){
                    $shipping_country = sanitize_text_field($_POST['shipping_country']);
                }
                if( isset($_POST['shipping_state']) ){
                    $shipping_state = sanitize_text_field($_POST['shipping_state']);
                }


                update_user_meta( $user_id, 'shipping_first_name', $shipping_first_name );
                update_user_meta( $user_id, 'shipping_last_name', $shipping_last_name );
                update_user_meta( $user_id, 'shipping_company', $shipping_company );
                update_user_meta( $user_id, 'shipping_address_1', $shipping_address_1 );
                update_user_meta( $user_id, 'shipping_address_2', $shipping_address_2 );
                update_user_meta( $user_id, 'shipping_city', $shipping_city );
                update_user_meta( $user_id, 'shipping_postcode', $shipping_postcode );
                update_user_meta( $user_id, 'shipping_country', $shipping_country );
                update_user_meta( $user_id, 'shipping_state', $shipping_state );

            }

            if (isset($_POST["userBillingUpdate"])) {

                if( isset($_POST['billing_first_name']) ){
                    $billing_first_name = sanitize_text_field($_POST['billing_first_name']);
                }
                if( isset($_POST['billing_last_name']) ){
                    $billing_last_name = sanitize_text_field($_POST['billing_last_name']);
                }
                if( isset($_POST['billing_company']) ){
                    $billing_company = sanitize_text_field($_POST['billing_company']);
                }
                if( isset($_POST['billing_address_1']) ){
                    $billing_address_1 = sanitize_textarea_field($_POST['billing_address_1']);
                }
                if( isset($_POST['billing_address_2']) ){
                    $billing_address_2 = sanitize_textarea_field($_POST['billing_address_2']);
                }
                if( isset($_POST['billing_city']) ){
                    $billing_city = sanitize_text_field($_POST['billing_city']);
                }
                if( isset($_POST['billing_postcode']) ){
                    $billing_postcode = sanitize_text_field($_POST['billing_postcode']);
                }
                if( isset($_POST['billing_country']) ){
                    $billing_country = sanitize_text_field($_POST['billing_country']);
                }
                if( isset($_POST['billing_state']) ){
                    $billing_state = sanitize_text_field($_POST['billing_state']);
                }
                if( isset($_POST['billing_phone']) ){
                    $billing_phone = sanitize_text_field($_POST['billing_phone']);
                }
                if( isset($_POST['billing_email']) ){
                    $billing_email = sanitize_text_field($_POST['billing_email']);
                }

                update_user_meta( $user_id, 'billing_first_name', $billing_first_name );
                update_user_meta( $user_id, 'billing_last_name', $billing_last_name );
                update_user_meta( $user_id, 'billing_company', $billing_company );
                update_user_meta( $user_id, 'billing_address_1', $billing_address_1 );
                update_user_meta( $user_id, 'billing_address_2', $billing_address_2 );
                update_user_meta( $user_id, 'billing_city', $billing_city );
                update_user_meta( $user_id, 'billing_postcode', $billing_postcode );
                update_user_meta( $user_id, 'billing_country', $billing_country );
                update_user_meta( $user_id, 'billing_state', $billing_state );
                update_user_meta( $user_id, 'billing_phone', $billing_phone );
                update_user_meta( $user_id, 'billing_email', $billing_email );

            }
        }
    }
}

//Run this class now
WP_Fundraising_Frontend_Address_Submit_Form::instance();
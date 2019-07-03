<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WP_Fundraising_Init')) {

    class WP_Fundraising_Init{

        /**
         * @var null
         *
         * Instance of this class
         */
        protected static $_instance = null;

        /**
         * @return null|WP_Fundraising
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Some task during plugin activate
         */
        public static function wf_plugin_init(){
            //Check is plugin used before or not
            if (get_option('wp_fundraising_is_used'))
                return false;


            update_option( '_wp_fundraising_is_used'         , WP_FUNDRAISING_VERSION); //Insert plugin version name into Option
            update_option( '_wf_selected_theme',           'basic'); //Select a basic theme
            update_option( '_wf_enable_color_styling',        'off'); //Set check true at Enable color styling option for custom color layout.
            update_option( '_wf_hide_min_amount',              'on'); //Set check true at min price show during campaign add
            update_option( '_wf_hide_max_amount',              'off'); //Set check true at max price show during campaign add
            update_option( '_wf_hide_recommended_amount',      'off'); //Set check true at recommended price show during campaign add
            update_option( '_wf_hide_target_goal',            'off'); //Set check at campaign end method
            update_option( '_wf_hide_target_date',            'on');
            update_option( '_wf_hide_target_goal_and_date',   'off');
            update_option( '_wf_hide_campaign_never_end',     'off');
            update_option( '_wf_single_page_template',   'in_wp_fundraising'); //Single page rewards
            update_option( '_wf_single_page_reward_design',   '1'); //Single page rewards
            update_option( '_wf_hide_campaign_from_shop_page',    'off'); //Hide campaign form shop page initial value
            update_option( '_wf_add_to_cart_redirect', 'checkout_page'); // Redirect Add to cart

            //WooCommerce Settings
            update_option( '_wf_single_page_id', 'true'); // Redirect Add to cart

            /**
             * reCaptcha Page Settings
             */
            update_option( '_wf_enable_recaptcha',            'off');
            update_option( '_wf_enable_recaptcha_in_user_registration', 'off');
            update_option( '_wf_enable_recaptcha_campaign_submit_page', 'off');
            update_option( '_wf_requirement_agree_title',      'I agree with the terms and conditions.'); //accept agreement during add campaign

            // Create page object
            $fundraising_dashboard_page = array(
                'post_title'    => 'WF Dashboard',
                'post_content'  => '[wp_fundraising_dashboard]',
                'post_type'     => 'page',
                'post_status'   => 'publish',
            );
            $fundraising_form_page = array(
                'post_title'    => 'WF campaign form',
                'post_content'  => '[wp_fundraising_form]',
                'post_type'     => 'page',
                'post_status'   => 'publish',
            );
            $fundraising_listing_page = array(
                'post_title'    => 'WF Listing Page',
                'post_content'  => '[wp_fundraising_listing]',
                'post_type'     => 'page',
                'post_status'   => 'publish',
            );

            // Insert the page into the database
            if(!post_exists( "WF Dashboard" )){
                $insert_dashboard_page = wp_insert_post( $fundraising_dashboard_page );
                update_post_meta( $insert_dashboard_page, '_wp_page_template', 'template-wp-fundraising.php' );
            }

            if(!post_exists( "WF Campaign Form" )){
                $insert_frm_page = wp_insert_post( $fundraising_form_page );
                update_post_meta( $insert_frm_page, '_wp_page_template', 'template-wp-fundraising.php' );
            }
            if(!post_exists( "WF Listing Page" )){
                $fundraising_listing_page = wp_insert_post( $fundraising_listing_page );
                update_post_meta( $fundraising_listing_page, '_wp_page_template', 'template-wp-fundraising.php' );
            }

            if (isset($insert_dashboard_page)){
                update_option( 'wp_fundraising_dashboard_page_id', $insert_dashboard_page );
            }

            /**
             * add or update option
             */
            if (isset($insert_frm_page)){
                update_option( 'wf_form_page_id', $insert_frm_page );
            }

            //Upload Permission
            update_option( 'wf_user_role_selector', array('administrator', 'editor', 'author', 'shop_manager') );
            $role_list = get_option( 'wf_user_role_selector' );
            if( is_array( $role_list ) ){
                if( !empty( $role_list ) ){
                    foreach( $role_list as $val ){
                        $role = get_role( $val );
                        $role->add_cap( 'campaign_form_submit' );
                        $role->add_cap( 'upload_files' );
                    }
                }
            }
        }

        /**
         * Reset method, the ajax will call that method
         */


        public function wp_fundraising_reset(){

            update_option( '_wp_fundraising_is_used'         , WP_FUNDRAISING_VERSION); //Insert plugin version name into Option
            update_option( '_wf_selected_theme',           'basic'); //Select a basic theme
            update_option( '_wf_enable_color_styling',        'off'); //Set check true at Enable color styling option for custom color layout.
            update_option( '_wf_hide_min_amount',              'on'); //Set check true at min price show during campaign add
            update_option( '_wf_hide_max_amount',              'off'); //Set check true at max price show during campaign add
            update_option( '_wf_hide_recommended_amount',      'off'); //Set check true at recommended price show during campaign add
            update_option( '_wf_hide_target_goal',            'off'); //Set check at campaign end method
            update_option( '_wf_hide_target_date',            'on');
            update_option( '_wf_hide_target_goal_and_date',   'off');
            update_option( '_wf_hide_campaign_never_end',     'off');
            update_option( '_wf_single_page_template',   'in_wp_fundraising'); //Single page rewards
            update_option( '_wf_single_page_reward_design',   '1'); //Single page rewards
            update_option( '_wf_hide_campaign_from_shop_page',    'off'); //Hide campaign form shop page initial value
            update_option( '_wf_add_to_cart_redirect', 'checkout_page'); // Redirect Add to cart

            //WooCommerce Settings
            update_option( '_wf_single_page_id', 'true'); // Redirect Add to cart

            /**
             * reCaptcha Page Settings
             */
            update_option( '_wf_enable_recaptcha',            'off');
            update_option( '_wf_enable_recaptcha_in_user_registration', 'off');
            update_option( '_wf_enable_recaptcha_campaign_submit_page', 'off');
            update_option( '_wf_requirement_agree_title',      'I agree with the terms and conditions.'); //accept agreement during add campaign

            /**
             * Add new role for user
             */

            // Init Setup Action
            update_option( '_wf_user_role_selector', array('administrator', 'editor', 'author', 'shop_manager') );
            $role_list = get_option( 'wf_user_role_selector' );
            if( is_array( $role_list ) ){
                if( !empty( $role_list ) ){
                    foreach( $role_list as $val ){
                        $role = get_role( $val );
                        $role->add_cap( 'campaign_form_submit' );
                        $role->add_cap( 'upload_files' );
                    }
                }
            }
        }


        /**
         * Show notice if there is no vendor
         */
        public static function no_vendor_notice(){

            $html = '';
            $html .= '<div class="notice notice-error is-dismissible">
                    <p>' . esc_html__('WP Fundraising requires WooCommerce to be activated', 'wp-fundraising') . '</p>
                </div>';
            echo $html;
        }

        public static function wc_low_version(){
            $html = '';
            $html .= '<div class="notice notice-error is-dismissible">
                        <p>'.esc_html__('Your WooCommerce version is below then 3.0, please update', 'wp-fundraising').'</p>
                    </div>';
            echo $html;
        }

    }
}
<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */

include_once WP_FUNDRAISING_DIR_PATH.'libs/external/class.settings-api.php';
if ( !class_exists('WF_Menu_Settings' ) ):
    class WF_Menu_Settings {
        private $settings_api;
        function __construct() {
            $this->settings_api = new WeDevs_Settings_API;
            add_action( 'admin_init', array($this, 'admin_init') );
            add_action( 'admin_menu', array($this, 'admin_menu') );
        }
        function admin_init() {
            //set the settings
            $this->settings_api->set_sections( $this->get_settings_sections() );
            $this->settings_api->set_fields( $this->get_settings_fields() );
            //initialize settings
            $this->settings_api->admin_init();
        }
        function admin_menu() {
            add_menu_page( 'WP Fundraising', 'WP Fundraising', 'edit_theme_options', 'fundraising', array($this, 'plugin_page') );
        }
        function get_settings_sections() {
            $sections = array(
                array(
                    'id'    => 'wf_basics',
                    'title' => esc_html__( 'General Options', 'wp-fundraising' )
                ),
                array(
                    'id'    => 'wf_donation',
                    'title' => esc_html__( 'Donation Options', 'wp-fundraising' )
                ),
                array(
                    'id'    => 'wf_social_share',
                    'title' => esc_html__( 'Share Options', 'wp-fundraising' )
                ),
                array(
                    'id'    => 'wf_advanced',
                    'title' => esc_html__( 'Advanced Options', 'wp-fundraising' )
                ),
                array(
                    'id'    => 'wf_recaptcha',
                    'title' => esc_html__( 'reCaptcha Options', 'wp-fundraising' )
                ),

            );
            return $sections;
        }
        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        function get_settings_fields() {
            $settings_fields = array(
                'wf_basics' => array(
                    array( 
                        'name'  => '_wf_hide_min_price',
                        'label' => esc_html__( 'Disable Minimum Price', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable minimum price option on the campaign submission form', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_max_price',
                        'label' => esc_html__( 'Disable Maximum Price', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable maximum price option on the campaign submission form', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_recommended_price',
                        'label' => esc_html__( 'Disable Recommended Price', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable recommended price option on the campaign submission form', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_target_goal',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Target Goal', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_target_date',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Target Date', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_target_goal_and_date',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Target Goal & Date', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_campaign_never_end',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Campaign Never End', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_campaign_expiry_from_listing',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Expiry from Campaign Listing', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array( 
                        'name'  => '_wf_hide_campaign_expiry_from_details',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Disable Expiry from Campaign Details', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                ),
                'wf_donation' => array(
                    array(
                        'name'        => '_wf_feature_campaign_id',
                        'label'     => esc_html__('Select Feature Campaign','wp-fundraising'),
                        'desc'      => esc_html__('Select feature campaign for donation.','wp-fundraising'),
                        'type'      => 'select',
                        'options'    => wp_fundraising_evaluated_charities(),
                    ),
                ),
                'wf_social_share' => array(

                    array(
                        'name'  => '_wf_enable_twitter',
                        'label' => esc_html__( 'Enable Twitter', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Enable Twitter in Single Campaign', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),

                    array(
                        'name'  => '_wf_enable_facebook',
                        'label' => esc_html__( 'Enable Facebook', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Enable Facebook in Single Campaign', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_enable_googleplus',
                        'label' => esc_html__( 'Enable GooglePlus', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Enable GooglePlus in Single Campaign', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_enable_pinterest',
                        'label' => esc_html__( 'Enable Pinterest', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Enable Pinterest in Single Campaign', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_enable_linkedin',
                        'label' => esc_html__( 'Enable Linkedin', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Enable Linkedin in Single Campaign', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),

                ),
                'wf_advanced' => array(
                    array(
                        'name'        => '_wf_frontend_campaign_submission_status',
                        'label'     => esc_html__('Select Frontend Campaign Submission Status','wp-fundraising'),
                        'desc'      => esc_html__('Select Publish, Draft or Pending Review.','wp-fundraising'),
                        'type'      => 'select',
                        'default'      => 'draft',
                        'options' => array(
                            'draft' => 'Draft',
                            'publish' => 'Published',
                            'pending' => 'Pending',
                        )
                    ),
                    array(
                        'name'  => '_wf_hide_campaign_from_shop_page',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Hide Campaign From Shop Page', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_hide_address_from_checkout',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Hide Billing Address From Checkout Page', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_reward_fixed_price',
                        'label' => esc_html__( 'Enable/Disable', 'wp-fundraising' ),
                        'desc'  => esc_html__( 'Reward show fixed price not range.', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    // #Listing Page Select
                    array(
                        'name'        => '_wf_terms_page_id',
                        'label'     => esc_html__('Select Terms & Conditions Page','wp-fundraising'),
                        'desc'      => esc_html__('Select Fundraising Terms & Conditions Page.','wp-fundraising'),
                        'type'      => 'select',
                        'options'    => wf_get_published_pages(),
                    ),
                    // #Listing Page Select
                    array(
                        'name'        => '_wf_listing_page_id',
                        'label'     => esc_html__('Select Listing Page','wp-fundraising'),
                        'desc'      => esc_html__('Select Fundraising Product Listing Page.','wp-fundraising'),
                        'type'      => 'select',
                        'options'    => wf_get_published_pages(),
                    ),

                    // #Campaign Registration Page Select
                    array(
                        'name'        => '_wf_registration_page_id',
                        'label'     => esc_html__('Select Registration Page','wp-fundraising'),
                        'desc'      => esc_html__('Select Fundraising Registration Page.','wp-fundraising'),
                        'type'      => 'select',
                        'options'    => wf_get_published_pages(),
                    ),
                    array(
                        'name'    => '_wf_add_to_cart_redirect',
                        'label'   => esc_html__( 'Redirect after Invest Now Button submit', 'wp-fundraising' ),
                        'desc'    => esc_html__( 'You can set redirect page when you submit back amount and click Invest Now Button', 'wp-fundraising' ),
                        'type'    => 'radio',
                        'options' => array( 'checkout_page' => 'Checkout Page', 'cart_page' => 'Cart Page', 'none' => 'None' ) ,
                        'default' => 'checkout_page',
                    ),
                ),
                'wf_recaptcha' => array(
                    array(
                        'name'        => '_wf_recaptcha_site_key',
                        'label'     => esc_html__('Enter your site  key','wp-fundraising'),
                        'desc'     => _x('<a href="https://www.google.com/recaptcha/admin#list">Get site key from here</a>','wp-fundraising'),
                        'type'      => 'text',
                    ),
                    array(
                        'name'        => '_wf_recaptcha_secret_key',
                        'label'     => esc_html__('Enter your secret  key','wp-fundraising'),
                        'type'      => 'text',
                    ),
                    array(
                        'name'  => '_wf_enable_login_recaptcha',
                        'label' => esc_html__( 'Enable', 'wp-fundraising' ),
                        'desc' => esc_html__( 'Enable reCaptcha for login ', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_enable_registration_recaptcha',
                        'label' => esc_html__( 'Enable', 'wp-fundraising' ),
                        'desc' => esc_html__( 'Enable reCaptcha for registration ', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                    array(
                        'name'  => '_wf_enable_campaign_submit_recaptcha',
                        'label' => esc_html__( 'Enable', 'wp-fundraising' ),
                        'desc' => esc_html__( 'Enable reCaptcha for campaign submit ', 'wp-fundraising' ),
                        'type'  => 'checkbox'
                    ),
                ),

            );
            return $settings_fields;
        }
        function plugin_page() {
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        }
        /**
         * Get all the pages
         *
         * @return array page names with key value pairs
         */
        function get_pages() {
            $pages = get_pages();
            $pages_options = array();
            if ( $pages ) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }
            return $pages_options;
        }
    }
endif;


new WF_Menu_Settings();
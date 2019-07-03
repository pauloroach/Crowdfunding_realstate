<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if (!class_exists('WP_FundRaising')) {
    class WP_FundRaising{
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

        public $plugin_version = '1.0.0';

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

        public function __construct()
        {
            $this->wp_plugin_init();
        }

        /**
         * Plugin Initialization
         * @since 1.0
         *
         */


        public static function wf_get_instance()
        {
            if (!isset(self::$_instance)) {
                self::$_instance = new WP_FundRaising();
            }
            return self::$_instance;
        }


        public function wp_plugin_init()
        {
            add_filter( 'product_type_selector', array(&$this, 'wf_add_product' ));
            add_action( 'admin_footer', array(&$this, 'wf_custom_js' ));
            add_filter( 'woocommerce_product_data_tabs', array(&$this, 'wf_product_tabs' ));
            add_action( 'woocommerce_product_data_panels', array(&$this, 'wf_options_product_tab_content' ));
            add_action( 'woocommerce_product_data_panels', array(&$this, 'wf_options_product_reward_tab_content' ));
            add_action( 'woocommerce_product_data_panels', array(&$this, 'wf_options_product_update_tab_content' ));
            add_action( 'woocommerce_process_product_meta_wp_fundraising', array(&$this, 'wf_save_option_field'  ));
            add_action( 'woocommerce_process_product_meta_wp_fundraising', array(&$this, 'wf_save_reward_option_field'  ));
            add_action( 'woocommerce_process_product_meta_wp_fundraising', array(&$this, 'wf_save_update_option_field'  ));
            add_filter( 'woocommerce_product_data_tabs', array(&$this, 'wf_hide_tab_panel' ));
            add_action( 'woocommerce_add_to_cart_validation', array($this, 'wf_remove_item_from_cart'), 10, 5); // Remove fundraising item from cart
            add_filter( 'woocommerce_add_cart_item', array($this, 'wf_save_user_funding_to_cookie'), 10, 3 ); //Filter cart item and save donation amount into cookir if product type fundraising
            add_action( 'woocommerce_before_calculate_totals', array($this, 'wf_add_user_funding')); //Save user input as there preferable amount with cart
            add_filter( 'woocommerce_add_to_cart_redirect', array($this, 'wf_redirect_to_checkout')); //Skip cart page after click Donate button, going directly on checkout page
            add_filter( 'woocommerce_coupons_enabled', array($this, 'wf_wc_coupon_disable')); //Hide coupon form on checkout page
            add_filter( 'woocommerce_get_price_html', array($this, 'wf_wc_price_remove'), 10, 2 ); //Hide default price details
            add_filter( 'woocommerce_is_purchasable', array($this, 'wf_return_true_woocommerce_is_purchasable'), 10, 2 ); // Return true is purchasable
            add_filter( 'woocommerce_paypal_args', array($this, 'wf_custom_override_paypal_email'), 100, 1); // Override paypal reciever email address with campaign creator email
            add_action( 'woocommerce_new_order', array($this, 'wf_order_type')); // Track is this product fundraising.
            add_action('woocommerce_new_order_item', array($this, 'wf_new_order_item'), 10, 3);


        }


        /**
         * Add to product type drop down.
         */
        public function wf_add_product( $types ){

            // Key should be exactly the same as in the class
            $types[ 'wp_fundraising' ] = esc_html__( 'WP Fundraising' );

            return $types;

        }

        /**
         * Show pricing fields for simple_rental product.
         */
        public function wf_custom_js() {

            if ( 'product' != get_post_type() ) :
                return;
            endif;

            ?><script type='text/javascript'>
                jQuery( document ).ready( function() {
                    jQuery( '.options_group.pricing' ).addClass( 'show_if_wf_fundraising' ).show();
                });

            </script><?php

        }

        /**
         * Add a custom product tab.
         */
        function wf_product_tabs( $original_prodata_tabs) {

            $fundraising_tab = array(
                'fundraising' => array( 'label' => esc_html__( 'Fundraising', 'wp-fundraising' ), 'target' => 'wf_options', 'class' => array( 'show_if_wf_fundraising' ), ),
                'reward' => array( 'label' => esc_html__( 'Rewards', 'wp-fundraising' ), 'target' => 'reward_options', 'class' => array( 'show_if_wf_fundraising' ), ),
                'update' => array( 'label' => esc_html__( 'Updates', 'wp-fundraising' ), 'target' => 'update_options', 'class' => array( 'show_if_wf_fundraising' ), ),
            );
            $insert_at_position = 2; // Change this for desire position
            $tabs = array_slice( $original_prodata_tabs, 0, $insert_at_position, true ); // First part of original tabs
            $tabs = array_merge( $tabs, $fundraising_tab ); // Add new
            $tabs = array_merge( $tabs, array_slice( $original_prodata_tabs, $insert_at_position, null, true ) ); // Glue the second part of original
            return $tabs;
        }


        /**
         * Contents of the wp_fundraising options product tab.
         */
        public function wf_options_product_tab_content() {

            global $post;

            ?><div id='wf_options' class='panel woocommerce_options_panel'><?php

            ?><div class='options_group'><?php


            woocommerce_wp_text_input(
                array(
                    'id'            => '_wf_funding_goal',
                    'label'         => esc_html__( 'Funding Goal ('.get_woocommerce_currency_symbol().')', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Funding goal','wp-fundraising' ),
                    'description'   => esc_html__('Enter the funding goal', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'type' 			=> 'text',
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id'            => '_wf_duration_start',
                    'label'         => esc_html__( 'Start date- mm/dd/yyyy or dd-mm-yyyy', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Start time of this campaign', 'wp-fundraising' ),
                    'description'   => esc_html__( 'Enter start of this campaign', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'type' 			=> 'text',
                )
            ); 
            if (wf_get_option('_wf_hide_target_date', 'wf_basics')=='off') {
                woocommerce_wp_text_input(
                    array(
                        'id'            => '_wf_duration_end',
                        'label'         => esc_html__( 'End date- mm/dd/yyyy or dd-mm-yyyy', 'wp-fundraising' ),
                        'placeholder'   => esc_attr__( 'End time of this campaign', 'wp-fundraising' ),
                        'description'   => esc_html__( 'Enter end time of this campaign', 'wp-fundraising' ),
                        'desc_tip'      => true,
                        'type' 			=> 'text',
                    )
                );
            }

            woocommerce_wp_text_input(
                array(
                    'id'            => '_wf_funding_video',
                    'label'         => esc_html__( 'Video Url', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Video url', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'description'   => esc_html__( 'Enter a video url to show your video in campaign details page', 'wp-fundraising' )
                )
            );

            echo '<div class="options_group"></div>';

            if (wf_get_option('_wf_hide_min_price', 'wf_basics')=='off') {
                woocommerce_wp_text_input(
                    array(
                        'id'            => '_wf_funding_minimum_price',
                        'label'         => esc_html__('Minimum Price ('. get_woocommerce_currency_symbol().')', 'wp-fundraising'),
                        'placeholder'   => esc_attr__('Minimum Price','wp-fundraising'),
                        'description'   => esc_html__('Enter the minimum price', 'wp-fundraising'),
                        'desc_tip'      => true,
                        'class'         => 'wc_input_price'
                    )
                );
            }

            if (wf_get_option('_wf_hide_max_price', 'wf_basics')=='off') {
                woocommerce_wp_text_input(
                    array(
                        'id'            => '_wf_funding_maximum_price',
                        'label'         => esc_html__('Maximum Price ('. get_woocommerce_currency_symbol() . ')', 'wp-fundraising'),
                        'placeholder'   => esc_attr__('Maximum Price','wp-fundraising'),
                        'description'   => esc_html__('Enter the maximum price', 'wp-fundraising'),
                        'desc_tip'      => true,
                        'class'         =>'wc_input_price'
                    )
                );
            }

            if (wf_get_option('_wf_hide_recommended_price', 'wf_basics')=='off') {
                woocommerce_wp_text_input(
                    array(
                        'id'            => '_wf_funding_recommended_price',
                        'label'         => esc_html__('Recommended Price (' . get_woocommerce_currency_symbol() . ')', 'wp-fundraising'),
                        'placeholder'   => esc_attr__('Recommended Price', 'wp-fundraising'),
                        'description'   => esc_html__('Enter the recommended price', 'wp-fundraising'),
                        'desc_tip'      => true,
                        'class'         => 'wc_input_price'
                    )
                );
            }
            echo '<div class="options_group"></div>';
 
            $options = array();

            if (wf_get_option('_wf_hide_target_goal', 'wf_basics')=='off') {
                $options['target_goal'] = 'Target Goal';
            }
            if (wf_get_option('_wf_hide_target_date', 'wf_basics')=='off') {
                $options['target_date'] = 'Target Date';
            }
            if (wf_get_option('_wf_hide_target_goal_and_date', 'wf_basics')=='off') {
                $options['target_goal_and_date'] = 'Target Goal & Date';
            }
            if (wf_get_option('_wf_hide_campaign_never_end', 'wf_basics')=='off') {
                $options['never_end'] = 'Campaign Never Ends';
            }
            if (wf_get_option('_wf_hide_target_goal', 'wf_basics')=='off' || wf_get_option('_wf_hide_target_date', 'wf_basics')=='off' || wf_get_option('_wf_hide_target_goal_and_date', 'wf_basics')=='off' || wf_get_option('_wf_hide_campaign_never_end', 'wf_basics')=='off') {
                //Campaign end method
                woocommerce_wp_select(
                    array(
                        'id' => '_wf_campaign_end_method',
                        'label' => esc_html__('Campaign End Method', 'wp-fundraising'),
                        'placeholder' => esc_attr__('Country', 'wp-fundraising'),
                        'class' => 'select2 _wf_campaign_end_method',
                        'options' => $options
                    )
                );
            }

            //Show contributor table
            woocommerce_wp_checkbox(
                array(
                    'id'            => '_wf_show_contributor_table',
                    'label'         => esc_html__( 'Show Contributor Table', 'wp-fundraising' ),
                    'cbvalue'       => "yes",
                    'description'   => esc_html__( 'Enable this option to display the contributors for this Campaign', 'wp-fundraising' ),
//                    'desc_tip'      => true,
                )
            );

            //Mark contributors as anonymous
            woocommerce_wp_checkbox(
                array(
                    'id'            => '_wf_mark_contributors_as_anonymous',
                    'label'         => esc_html__( 'Mark Contributors as Anonymous', 'wp-fundraising' ),
                    'cbvalue'       => "yes",
                    'description'   => esc_html__( 'Enable this option to display the contributors Name as Anonymous for this Campaign', 'wp-fundraising' ),
//                    'desc_tip'      => true,
                )
            );
            echo '<div class="options_group"></div>';


            //Get country select
            $countries_obj      = new WC_Countries();
            $countries          = $countries_obj->__get('countries');
            array_unshift($countries, 'Select a country');

            //Country list
            woocommerce_wp_select(
                array(
                    'id'            => '_wf_country',
                    'label'         => esc_html__( 'Country', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Country', 'wp-fundraising' ),
                    'class'         => 'select2 _wf_country',
                    'options'       => $countries
                )
            );

            // Location of this campaign
            woocommerce_wp_text_input(
                array(
                    'id'            => '_wf_location',
                    'label'         => esc_html__( 'Location', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Location', 'wp-fundraising' ),
                    'description'   => esc_html__( 'Location of this campaign','wp-fundraising' ),
                    'desc_tip'      => true,
                    'type'          => 'text'
                )
            );
            do_action( 'new_fundraising_campaign_option' );


            echo '</div>';

            ?></div><?php


        }

        /**
         * Save the custom fields.
         */
        public function wf_save_option_field( $post_id ) {

            if (isset($_POST['_wf_funding_goal'])) :
                update_post_meta($post_id, '_wf_funding_goal', sanitize_text_field($_POST['_wf_funding_goal']));
            endif;

            if (isset($_POST['_wf_duration_start'])) :
                update_post_meta($post_id, '_wf_duration_start', sanitize_text_field($_POST['_wf_duration_start']));
            endif;

            if (isset($_POST['_wf_duration_end'])) :
                update_post_meta($post_id, '_wf_duration_end', sanitize_text_field($_POST['_wf_duration_end']));
            endif;

            if (isset($_POST['_wf_funding_video'])) :
                update_post_meta($post_id, '_wf_funding_video', sanitize_text_field($_POST['_wf_funding_video']));
            endif;

            if (isset($_POST['_wf_funding_minimum_price'])) :
                update_post_meta($post_id, '_wf_funding_minimum_price', sanitize_text_field($_POST['_wf_funding_minimum_price']));
            endif;

            if (isset($_POST['_wf_funding_maximum_price'])) :
                update_post_meta($post_id, '_wf_funding_maximum_price', sanitize_text_field($_POST['_wf_funding_maximum_price']));
            endif;

            if (isset($_POST['_wf_funding_recommended_price'])) :
                update_post_meta($post_id, '_wf_funding_recommended_price', sanitize_text_field($_POST['_wf_funding_recommended_price']));
            endif;

            if (isset($_POST['_wf_campaign_end_method'])) :
                update_post_meta($post_id, '_wf_campaign_end_method', sanitize_text_field($_POST['_wf_campaign_end_method']));
            endif;


            update_post_meta($post_id, '_wf_show_contributor_table', sanitize_text_field($_POST['_wf_show_contributor_table']));
            update_post_meta($post_id, '_wf_mark_contributors_as_anonymous', sanitize_text_field($_POST['_wf_mark_contributors_as_anonymous']));


            if (isset($_POST['_wf_country'])) :
                update_post_meta($post_id, '_wf_country', sanitize_text_field($_POST['_wf_country']));
            endif;

            if (isset($_POST['_wf_location'])) :
                update_post_meta($post_id, '_wf_location', sanitize_text_field($_POST['_wf_location']));
            endif;

            update_post_meta( $post_id, '_sale_price', '0' );
            update_post_meta( $post_id, '_price', '0' );
        }

        /**
         * Hide Attributes data panel.
         */
        public function wf_hide_tab_panel( $tabs) {

            $tabs['attribute']['class'] = array( 'hide_if_wf_fundraising','hide_if_wf_donation' );
            $tabs['general']['class'] = array( 'hide_if_wf_fundraising','hide_if_wf_donation' );
            $tabs['fundraising']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['reward']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['update']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );

            return $tabs;

        }
        /**
         * wp_donate_input_field();
         */
        function wf_donate_input_field()
        {
            global $post, $woocommerce;
            $product = wc_get_product( $post->ID );


            $html = '';
            if (($product->get_type() == 'wp_fundraising') ||($product->get_type() == 'wf_donation')) {
                $html .= '<div class="donate_field">';

                if (WPFR()->is_campaign_valid()) {

                    $html .= '<form class="cart" method="post" enctype="multipart/form-data">';
                    $html .= do_action('before_wf_donate_field');
                    $recomanded_price = get_post_meta($post->ID, 'wp_funding_recommended_price', true);
                    $html .= get_woocommerce_currency_symbol();
                    $html .= apply_filters('wp_donate_field', '<input type ="number" step="any" class="input-text amount wp_donation_input text" name="wp_donate_amount_field" min="0" value="100" />');
                    $html .= do_action('after_wf_donate_field');
                    $html .= '<input type="hidden" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" />';
                    $btn_text = get_option('wp_donation_btn_text');
                    $html .= '<button type="submit" class="'.apply_filters('add_to_donate_button_class', 'single_add_to_cart_button button alt').'">' . esc_html__(apply_filters('add_to_donate_button_text', esc_html($btn_text) ? esc_html($btn_text) : 'Donate now'), 'wp-fundraising').'</button>';
                    $html .= '</form>';
                } else {
                    $html .= apply_filters('end_campaign_message', esc_html__('This campaign has been end', 'wp-fundraising'));
                }
                $html .= '</div>';
            }
            echo $html;
        }


        /**
         * Remove Fundraising item form cart
         */
        public function wf_remove_item_from_cart($passed, $product_id, $quantity, $variation_id = '', $variations= '') {
            global $woocommerce;
            $product = wc_get_product($product_id);

            if(($product->get_type() == 'wp_fundraising') || ($product->get_type() == 'wf_donation')) {
                foreach (WC()->cart->cart_contents as $item_cart_key => $prod_in_cart) {
                    WC()->cart->remove_cart_item( $item_cart_key );
                }
            }
            foreach (WC()->cart->cart_contents as $item_cart_key => $prod_in_cart) {
                if (($prod_in_cart['data']->get_type() == 'wp_fundraising') || ($prod_in_cart['data']->get_type() == 'wf_donation')) {
                    WC()->cart->remove_cart_item( $item_cart_key );
                }
            }
            return $passed;
        }

        /**
         * @param $array
         * @param $int
         * @return mixed
         *
         * Save user input donation into cookie
         */
        function wf_save_user_funding_to_cookie( $array, $int ) {
            if (($array['data']->get_type() == 'wp_fundraising') || ($array['data']->get_type() == 'wf_donation')){
                if ( ! empty($_POST['wp_donate_amount_field'])){
                    //setcookie("wp_user_donation", esc_attr($_POST['wp_donate_amount_field']), 0, "/");
                    $donate_amount = sanitize_text_field($_POST['wp_donate_amount_field']);
                    WC()->session->set('wp_donate_amount', $donate_amount);

                    if ( ! empty($_POST['wp_rewards_index'])){
                        $wp_rewards_index = (int) sanitize_text_field($_POST['wp_rewards_index']) -1;
                        $_cf_product_author_id = sanitize_text_field($_POST['_cf_product_author_id']);
                        $product_id = sanitize_text_field($_POST['add-to-cart']);
                        WC()->session->set('wp_rewards_data', array('rewards_index' => $wp_rewards_index, 'product_id' => $product_id, '_cf_product_author_id' => $_cf_product_author_id) );
                    }else{
                        WC()->session->__unset('wp_rewards_data');
                    }
                }
            }
            return $array;
        }

        /**
         * Get donation amount from cookie. Add user input base donation amount to cart
         */

        function wf_add_user_funding(){
            global $woocommerce;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if (($cart_item['data']->get_type() == 'wp_fundraising') || ($cart_item['data']->get_type() == 'wf_donation')) {
                    $donate_cart_amount = WC()->session->get('wp_donate_amount');
                    if ( ! empty($donate_cart_amount)){
                        $cart_item['data']->set_price($donate_cart_amount);
                    }
                }
            }
        }

        /**
         * Redirect to checkout after cart
         */
        function wf_redirect_to_checkout($url) {
            global $woocommerce, $product;

            if (! empty($_REQUEST['add-to-cart'])){
                $product_id = absint( $_REQUEST['add-to-cart'] );
                $product = wc_get_product( $product_id );
                if( ($product->is_type( 'wp_fundraising' )) || ($product->is_type( 'wf_donation' )) ){

                    $preferance     = wf_get_option('_wf_add_to_cart_redirect', 'wf_advanced');

                    if ($preferance == 'checkout_page'){
                        $checkout_url = wc_get_checkout_url();
                    }elseif ($preferance == 'cart_page'){
                        $checkout_url = $woocommerce->cart->get_cart_url();
                    }else{
                        $checkout_url = get_permalink();
                    }

                    wc_clear_notices();

                    return $checkout_url;
                }
            }
            return $url;
        }

        /**
         * Disabled coupon system from system
         */
        function wf_wc_coupon_disable( $coupons_enabled ) {
            global $woocommerce;
            return false;
        }

        /**
         * @param $price
         * @param $product
         * @return string
         *
         * reove price html for fundraising campaign
         */

        function wf_wc_price_remove( $price, $product ) {
            $target_product_types = array( 'wp_fundraising', 'wf_donation' );
            if ( in_array ( $product->get_type(), $target_product_types ) ) {
                // if variable product return and empty string
                return '';
            }
            // return normal price
            return $price;
        }


        /**
         * @param $purchasable
         * @param $product
         * @return bool
         *
         * Return true is purchasable if not found price
         */

        function wf_return_true_woocommerce_is_purchasable( $purchasable, $product ){
            if( $product->get_price() == 0 ||  $product->get_price() == ''){
                $purchasable = true;
            }
            return $purchasable;
        }


        /**
         * @return mixed
         *
         * get paypal email address from campaign
         */

        public function wf_get_paypal_reciever_email_address() {
            global $woocommerce;
            foreach ($woocommerce->cart->cart_contents as $item) {
                $emailid = get_post_meta($item['product_id'], 'wp_campaigner_paypal_id', true);
                $enable_paypal_per_campaign = get_option('wp_enable_paypal_per_campaign_email');

                if ($enable_paypal_per_campaign == 'true') {
                    if (!empty($emailid)) {
                        return $emailid;
                    } else {
                        $paypalsettings = get_option('woocommerce_paypal_settings');
                        return $paypalsettings['email'];
                    }
                } else {
                    $paypalsettings = get_option('woocommerce_paypal_settings');
                    return $paypalsettings['email'];
                }
            }
        }

        public function wf_custom_override_paypal_email($paypal_args) {
            global $woocommerce;
            $paypal_args['business'] = $this->wf_get_paypal_reciever_email_address();
            return $paypal_args;
        }

        /**
         * @param $order_id
         *
         * Save order reward if any with order meta
         */
        public function wf_order_type($order_id){
            global $woocommerce;

            $wp_rewards_data = WC()->session->get('wp_rewards_data');
            if ( ! empty($wp_rewards_data)){
                $campaign_rewards   = get_post_meta($wp_rewards_data['product_id'], 'wp_reward', true);
                $campaign_rewards   = stripslashes($campaign_rewards);
                $campaign_rewards_a = json_decode($campaign_rewards, true);
                $reward = $campaign_rewards_a[$wp_rewards_data['rewards_index']];
                update_post_meta($order_id, 'wp_selected_reward', $reward);
                update_post_meta($order_id, '_cf_product_author_id', $wp_rewards_data['_cf_product_author_id'] );
                WC()->session->__unset('wp_rewards_data');
            }
        }

        public function wf_new_order_item( $item_id, $item, $order_id){
            $product_id = wc_get_order_item_meta($item_id, '_product_id', true);
            if( ! $product_id ){
                return;
            }
            $get_product = wc_get_product($product_id);
            $product_type = $get_product->get_type();
            if (($product_type === 'wp_fundraising') || ($product_type === 'wf_donation')){
                update_post_meta($order_id, '_is_fundraising_order','1');
            }
        }


        /**
         * Contents of the wp_fundraising options product reward tab.
         */
        public function wf_options_product_reward_tab_content() {

            ?><div id='reward_options' class='panel woocommerce_options_panel'><?php

            global $post;

            $reward_fields = get_post_meta($post->ID, 'repeatable_reward_fields', true);

            ?>
            <script type="text/javascript">
                jQuery(document).ready(function( $ ){
                    $( '#add-row' ).on('click', function() {
                        var row = $( '.empty-row.screen-reader-text' ).clone(true);
                        row.removeClass( 'empty-row screen-reader-text' );
                        row.insertBefore( '#repeatable-fieldset-one > div.reward-item:last' );
                        return false;
                    });

                    $( '.remove-row' ).on('click', function() {
                        $(this).parents('.reward-item').remove();
                        return false;
                    });
                    jQuery('.color-field').wpColorPicker();
                });
            </script>

            <div id="repeatable-fieldset-one">
                <?php

                if ( $reward_fields ) :

                    foreach ( $reward_fields as $field ) {

                        ?>
                        <div class="options_group reward-item">
                            <p class="form-field _wf_pledge_amount_field ">
                                <label for="_wf_pledge_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_pledge_amount[]" value="<?php if(isset($field['_wf_pledge_amount']) && $field['_wf_pledge_amount'] != '') echo sanitize_text_field( $field['_wf_pledge_amount'] ); ?>" />
                            </p>
                            <p class="form-field _wf_reward_title_field ">
                                <label for="_wf_reward_title"><?php esc_html_e('Reward Title','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_reward_title[]" value="<?php if(isset($field['_wf_reward_title']) && $field['_wf_reward_title'] != '') echo sanitize_text_field( $field['_wf_reward_title'] ); ?>" />
                            </p>
                            <p class="form-field _wf_reward_description_field ">
                                <label for="_wf_reward_description"><?php esc_html_e('Reward Description','wp-fundraising');?></label>
                                <textarea name="_wf_reward_description[]"><?php if(isset($field['_wf_reward_description']) && $field['_wf_reward_description'] != '') echo sanitize_textarea_field( $field['_wf_reward_description'] ); ?></textarea>
                            </p>
                            <p class="form-field _wf_reward_subtitle_field ">
                                <label for="_wf_reward_offer"><?php esc_html_e('Additional Reward Offer','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_reward_offer[]" value="<?php if(isset($field['_wf_reward_offer']) && $field['_wf_reward_offer'] != '') echo sanitize_text_field( $field['_wf_reward_offer'] ); ?>" />
                            </p>
                            <p class="form-field _wf_reward_estimated_delivery_date_field ">
                                <label for="_wf_reward_estimated_delivery_date"><?php esc_html_e('Estimated Delivery Date','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_reward_estimated_delivery_date[]" value="<?php if(isset($field['_wf_reward_estimated_delivery_date']) && $field['_wf_reward_estimated_delivery_date'] != '') echo sanitize_text_field( $field['_wf_reward_estimated_delivery_date'] ); ?>" />
                            </p>
                            <p class="form-field _wf_reward_quantity_field ">
                                <label for="_wf_reward_quantity"><?php esc_html_e('Quantity','wp-fundraising');?></label>
                                <input type="number" step="1" min="1" class="short" name="_wf_reward_quantity[]" value="<?php if(isset($field['_wf_reward_quantity']) && $field['_wf_reward_quantity'] != '') echo sanitize_text_field( $field['_wf_reward_quantity'] ); ?>"/>
                            </p>
                            <p class="form-field _wf_reward_ships_to_field ">
                                <label for="_wf_reward_ships_to"><?php esc_html_e('Ships To','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_reward_ships_to[]" placeholder="<?php esc_html_e('Anywhere in the world','wp-fundraising');?>" value="<?php if(isset($field['_wf_reward_ships_to']) && $field['_wf_reward_ships_to'] != '') echo sanitize_text_field( $field['_wf_reward_ships_to'] ); ?>"/>
                            </p>
                            <p class="form-field _wf_reward_bg_color_field ">
                                <label for="_wf_reward_bg_color"><?php esc_html_e('Reward Card BG Color','wp-fundraising');?></label>
                                <input class="color-field" type="text" name="_wf_reward_bg_color[]" value="<?php if(isset($field['_wf_reward_bg_color']) && $field['_wf_reward_bg_color'] != '') echo sanitize_text_field( $field['_wf_reward_bg_color'] ); ?>"/>
                            </p>
                            <p class="form-field "><a class="button remove-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                        </div><?php
                    }

                else:
                ?><div class="options_group reward-item"><?php
                    ?>
                    <p class="form-field _wf_pledge_amount_field ">
                        <label for="_wf_pledge_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_pledge_amount[]" />
                    </p>
                    <p class="form-field _wf_reward_title_field ">
                        <label for="_wf_reward_title"><?php esc_html_e('Reward Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_title[]" />
                    </p>
                    <p class="form-field _wf_reward_description_field ">
                        <label for="_wf_reward_description"><?php esc_html_e('Reward Description','wp-fundraising');?></label>
                        <textarea name="_wf_reward_description[]"></textarea>
                    </p>
                    <p class="form-field _wf_reward_subtitle_field ">
                        <label for="_wf_reward_offer"><?php esc_html_e('Additional Reward Offer','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_offer[]" />
                    </p>
                    <p class="form-field _wf_reward_estimated_delivery_date_field ">
                        <label for="_wf_reward_estimated_delivery_date"><?php esc_html_e('Estimated Delivery Date','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_estimated_delivery_date[]" />
                    </p>
                    <p class="form-field _wf_reward_quantity_field ">
                        <label for="_wf_reward_quantity"><?php esc_html_e('Quantity','wp-fundraising');?></label>
                        <input type="number" step="1" min="1" class="short" name="_wf_reward_quantity[]" />
                    </p>
                    <p class="form-field _wf_reward_ships_to_field ">
                        <label for="_wf_reward_ships_to"><?php esc_html_e('Ships To','wp-fundraising');?></label>
                        <input type="text" placeholder="<?php esc_attr_e('Anywhere in the world','wp-fundraising');?>" class="short" name="_wf_reward_ships_to[]" />
                    </p>
                    <p class="form-field _wf_reward_bg_color_field ">
                        <label for="_wf_reward_bg_color"><?php esc_html_e('Reward Card BG Color','wp-fundraising');?></label>
                        <input class="color-field" type="text" name="_wf_reward_bg_color[]" />
                    </p>
                    <p class="form-field "><a class="button remove-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>


                    </div><?php
                endif; ?>

                <div class="options_group reward-item empty-row screen-reader-text">
                    <p class="form-field _wf_pledge_amount_field ">
                        <label for="_wf_pledge_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_pledge_amount[]" />
                    </p>
                    <p class="form-field _wf_reward_title_field ">
                        <label for="_wf_reward_title"><?php esc_html_e('Reward Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_title[]" />
                    </p>
                    <p class="form-field _wf_reward_description_field ">
                        <label for="_wf_reward_description"><?php esc_html_e('Reward Description','wp-fundraising');?></label>
                        <textarea name="_wf_reward_description[]"></textarea>
                    </p>
                    <p class="form-field _wf_reward_offer_field ">
                        <label for="_wf_reward_offer"><?php esc_html_e('Additional Reward Offer','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_offer[]" />
                    </p>
                    <p class="form-field _wf_reward_estimated_delivery_date_field ">
                        <label for="_wf_reward_estimated_delivery_date"><?php esc_html_e('Estimated Delivery Date','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_reward_estimated_delivery_date[]"/>
                    </p>
                    <p class="form-field _wf_reward_quantity_field ">
                        <label for="_wf_reward_quantity"><?php esc_html_e('Quantity','wp-fundraising');?></label>
                        <input type="number" step="1" min="1" class="short" name="_wf_reward_quantity[]" />
                    </p>
                    <p class="form-field _wf_reward_ships_to_field ">
                        <label for="_wf_reward_ships_to"><?php esc_html_e('Ships To','wp-fundraising');?></label>
                        <input type="text" placeholder="<?php esc_attr_e('Anywhere in the world','wp-fundraising');?>" class="short" name="_wf_reward_ships_to[]" />
                    </p>
                    <p class="form-field _wf_reward_bg_color_field ">
                        <label for="_wf_reward_bg_color"><?php esc_html_e('Reward Card BG Color','wp-fundraising');?></label>
                        <input class="color-field" type="text" name="_wf_reward_bg_color[]"/>
                    </p>
                    <p class="form-field "><a class="button remove-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                </div>
            </div>

            <p><a id="add-row" class="button" href="#"><?php esc_html_e('Add another','wp-fundraising');?></a></p>

            <?php

            ?></div><?php


        }

        /**
         * Save the custom fields.
         */
        public function wf_save_reward_option_field( $post_id ) {

            $old = get_post_meta($post_id, 'repeatable_reward_fields', true);
            $new = array();

            $names = $_POST['_wf_pledge_amount'];
            $title = $_POST['_wf_reward_title'];
            $description = $_POST['_wf_reward_description'];
            $offer = $_POST['_wf_reward_offer'];
            $delivery_date = $_POST['_wf_reward_estimated_delivery_date'];
            $quantity = $_POST['_wf_reward_quantity'];
            $ships_to = $_POST['_wf_reward_ships_to'];
            $bg_color = $_POST['_wf_reward_bg_color'];

            $count = count( $names );

            for ( $i = 0; $i < $count; $i++ ) {
                if ( $names[$i] != '' ) :
                    $new[$i]['_wf_pledge_amount'] = stripslashes( strip_tags( $names[$i] ) );
                    $new[$i]['_wf_reward_title'] = stripslashes( strip_tags( $title[$i] ) );
                    $new[$i]['_wf_reward_description'] = stripslashes( strip_tags( $description[$i] ) );
                    $new[$i]['_wf_reward_offer'] = stripslashes( strip_tags( $offer[$i] ) );
                    $new[$i]['_wf_reward_estimated_delivery_date'] = stripslashes( strip_tags( $delivery_date[$i] ) );
                    $new[$i]['_wf_reward_quantity'] = stripslashes( strip_tags( $quantity[$i] ) );
                    $new[$i]['_wf_reward_ships_to'] = stripslashes( strip_tags( $ships_to[$i] ) );
                    $new[$i]['_wf_reward_bg_color'] = stripslashes( strip_tags( $bg_color[$i] ) );
                endif;
            }

            if ( !empty( $new ) && $new != $old )
                update_post_meta( $post_id, 'repeatable_reward_fields', $new );
            elseif ( empty($new) && $old )
                delete_post_meta( $post_id, 'repeatable_reward_fields', $old );

        }






        /**
         * Contents of the wp_fundraising options product update tab.
         */
        public function wf_options_product_update_tab_content() {

            ?><div id='update_options' class='panel woocommerce_options_panel'><?php

            global $post;

            $update_fields = get_post_meta($post->ID, 'repeatable_update_fields', true);

            ?>
            <script type="text/javascript">
                jQuery(document).ready(function( $ ){
                    $( '#add-update-row' ).on('click', function() {
                        var row = $( '.empty-update-row.screen-reader-text' ).clone(true);
                        row.removeClass( 'empty-update-row screen-reader-text' );
                        row.insertBefore( '#repeatable-fieldset-two > div.update-item:last' );
                        return false;
                    });

                    $( '.remove-update-row' ).on('click', function() {
                        $(this).parents('.update-item').remove();
                        return false;
                    });
                });
            </script>

            <div id="repeatable-fieldset-two">
                <?php

                if ( $update_fields ) :

                    foreach ( $update_fields as $field ) {
                        ?>
                        <div class="options_group update-item">
                        <p class="form-field _wf_update_date_field ">
                            <label for="_wf_update_date"><?php esc_html_e('Date','wp-fundraising');?></label>
                            <input type="text" class="short" name="_wf_update_date[]" value="<?php if(isset($field['_wf_update_date']) && $field['_wf_update_date'] != '') echo sanitize_text_field( $field['_wf_update_date'] ); ?>" />
                        </p>
                        <p class="form-field _wf_update_title_field ">
                            <label for="_wf_update_title"><?php esc_html_e('Update Title','wp-fundraising');?></label>
                            <input type="text" class="short" name="_wf_update_title[]" value="<?php if(isset($field['_wf_update_title']) && $field['_wf_update_title'] != '') echo sanitize_text_field( $field['_wf_update_title'] ); ?>" />
                        </p>
                        <p class="form-field _wf_update_description_field ">
                            <label for="_wf_update_description"><?php esc_html_e('Update Description','wp-fundraising');?></label>
                            <textarea name="_wf_update_description[]"><?php if(isset($field['_wf_update_description']) && $field['_wf_update_description'] != '') echo sanitize_text_field( $field['_wf_update_description'] ); ?></textarea>
                        </p>
                        <p class="form-field _wf_update_url_field ">
                            <label for="_wf_update_url"><?php esc_html_e('URL','wp-fundraising');?></label>
                            <input type="text" class="short" name="_wf_update_url[]" value="<?php if(isset($field['_wf_update_url']) && $field['_wf_update_url'] != '') echo sanitize_text_field( $field['_wf_update_url'] ); ?>" />
                        </p>
                        <p class="form-field "><a class="button remove-update-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                        </div><?php
                    }

                else:
                    ?><div class="options_group update-item"><?php
                    ?>
                    <p class="form-field _wf_update_date_field ">
                        <label for="_wf_update_date"><?php esc_html_e('Date','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_date[]"/>
                    </p>
                    <p class="form-field _wf_update_title_field ">
                        <label for="_wf_update_title"><?php esc_html_e('Update Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_title[]" />
                    </p>
                    <p class="form-field _wf_update_description_field ">
                        <label for="_wf_update_description"><?php esc_html_e('Update Description','wp-fundraising');?></label>
                        <textarea name="_wf_update_description[]"></textarea>
                    </p>
                    <p class="form-field _wf_update_url_field ">
                        <label for="_wf_update_url"><?php esc_html_e('URL','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_url[]"/>
                    </p>
                    <p class="form-field "><a class="button remove-update-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>


                    </div><?php
                endif; ?>

                <div class="options_group update-item empty-update-row screen-reader-text">
                    <p class="form-field _wf_update_date_field ">
                        <label for="_wf_update_date"><?php esc_html_e('Date','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_date[]"/>
                    </p>
                    <p class="form-field _wf_update_title_field ">
                        <label for="_wf_update_title"><?php esc_html_e('Update Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_title[]" />
                    </p>
                    <p class="form-field _wf_update_description_field ">
                        <label for="_wf_update_description"><?php esc_html_e('Update Description','wp-fundraising');?></label>
                        <textarea name="_wf_update_description[]"></textarea>
                    </p>
                    <p class="form-field _wf_update_url_field ">
                        <label for="_wf_update_url"><?php esc_html_e('URL','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_update_url[]"/>
                    </p>
                    <p class="form-field "><a class="button remove-update-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                </div>
            </div>

            <p><a id="add-update-row" class="button" href="#"><?php esc_html_e('Add another','wp-fundraising');?></a></p>

            <?php

            ?></div><?php


        }

        /**
         * Save the custom fields.
         */
        public function wf_save_update_option_field( $post_id ) {

            $old = get_post_meta($post_id, 'repeatable_update_fields', true);
            $new = array();

            $date = $_POST['_wf_update_date'];
            $title = $_POST['_wf_update_title'];
            $description = $_POST['_wf_update_description'];
            $url = $_POST['_wf_update_url'];

            $count = count( $title );

            for ( $i = 0; $i < $count; $i++ ) {
                if ( $title[$i] != '' ) :
                    $new[$i]['_wf_update_date'] = stripslashes( strip_tags( $date[$i] ) );
                    $new[$i]['_wf_update_title'] = stripslashes( strip_tags( $title[$i] ) );
                    $new[$i]['_wf_update_description'] = stripslashes( strip_tags( $description[$i] ) );
                    $new[$i]['_wf_update_url'] = stripslashes( strip_tags( $url[$i] ) );
                endif;
            }

            if ( !empty( $new ) && $new != $old )
                update_post_meta( $post_id, 'repeatable_update_fields', $new );
            elseif ( empty($new) && $old )
                delete_post_meta( $post_id, 'repeatable_update_fields', $old );

        }


    }

}
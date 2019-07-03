<?php

/* ---------------------------------------------------------
 * Actions
 *
 * Class for registering actions
  ---------------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) exit;
class WP_Fundraising_Actions{

    static $hooks = array();

    /**
     * Setup all plugin actions
     */
    static function init(){
        require_once WP_FUNDRAISING_DIR_PATH.'inc/wp-fundraising-enqueue.php';
        /**
         * Array of action hooks
         *
         *
         * When 'callback' value is empty (non-array) or any of values ommited,
         * default priority and accepted args will be used
         *
         * e.g.
         * priority = 10
         * accepted_args = 1
         */

        static::$hooks = array(
            'wp_enqueue_scripts' => array(
                'WP_Fundraising_Enqueue::wf_load_css',
                'WP_Fundraising_Enqueue::wf_load_js',
                'WP_Fundraising_Enqueue::add_ajax_donation_level',
                'WP_Fundraising_Enqueue::wf_localize_script',
            ),
            'admin_enqueue_scripts' => array(
                'WP_Fundraising_Enqueue::wf_load_admin_css_js',
            ),
            'wp_footer' => array(
                'WP_Fundraising_Actions::wp_fundraising_registration',
                'WP_Fundraising_Actions::wp_fundraising_donate_modal',
            ),
            'woocommerce_checkout_fields' => array(
                'wf_override_checkout_fields',
            ),
            'woocommerce_product_tabs' => array(
                'WP_Fundraising_Actions::wf_product_backers_tab',
                'WP_Fundraising_Actions::wf_campaign_update_tab',
            ),
            'wf_wc_after_main_content' => array(

                'WP_Fundraising_Actions::wf_campaign_single_pie_chart' => array(5),
                'WP_Fundraising_Actions::wf_campaign_single_goal_raised_bakers' => array(10),
                'WP_Fundraising_Actions::wf_campaign_single_countdown_timer' => array(15),
                'WP_Fundraising_Actions::wf_campaign_single_fund_this_campaign_btn' => array(20),
                'WP_Fundraising_Actions::wf_campaign_single_reward_info' => array(30),
                'WP_Fundraising_Actions::wf_campaign_single_social_share' => array(25),
            ),
            'woocommerce_after_shop_loop_item' => array(
                'WP_Fundraising_Actions::wf_after_item_title_data',
            ),
            'wf_wc_before_single_product_summary' => array(
                'woocommerce_show_product_sale_flash' => array(10),
                'WP_Fundraising_Actions::wf_campaign_single_feature_image' => array(15),
                // 'woocommerce_show_product_images' => array(20),
            ),
            'wf_wc_after_single_product_summary' => array(
                'woocommerce_output_product_data_tabs' => array(5),
            ),
            'wf_wc_related_campaign' => array(
                'wp_fundraising_related_campaign' => array(5),
            ),

        );


        if (wf_get_option('_wf_hide_campaign_from_shop_page', 'wf_advanced')=='on') {
            static::$hooks = array_merge(static::$hooks, array(
                'woocommerce_product_query' => array(
                    'WP_Fundraising_Actions::wf_limit_show_campaign_in_shop',
                ),
            ));
        }
         if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' )) {
             static::$hooks = array_merge(static::$hooks, array(
                 'plugins_loaded' => array(
                     'wf_product_type_register',
                     'wf_donation_product_type_register',
                 ),
             ));
        }else{
             static::$hooks = array_merge(static::$hooks, array(
                 'admin_notices' => array(
                     'WP_Fundraising_Init::no_vendor_notice',
                 ),
             ));
        }
        wf_register_hooks(static::$hooks, 'action');


    }
    static function wf_campaign_single_feature_image() {
            wf_get_template_part('loop/single/feature-image');
        }
    static function wp_fundraising_registration() {
        echo do_shortcode('[wp_fundraising_registration]');
    }
    static function wp_fundraising_donate_modal() {
        echo do_shortcode('[wp_fundraising_donate_modal]');
    }

    /**
     * Action hooks for single campaign page
     */
    static function wf_campaign_single_pie_chart() {
        wf_get_template_part('loop/single/percent-pie-chart');
    }
    static function wf_campaign_single_goal_raised_bakers() {
        wf_get_template_part('loop/single/goal-raised-baker');
    }
    static function wf_campaign_single_countdown_timer() {
        wf_get_template_part('loop/single/countdown-timer');
    }
    static function wf_campaign_single_social_share() {
        wf_get_template_part('loop/single/social-share');
    }
    static function wf_campaign_single_fund_this_campaign_btn() {
        wf_get_template_part('loop/single/invest-now-btn');
    }
    static function wf_campaign_single_reward_info() {
        wf_get_template_part('loop/single/reward-info');
    }

    static function wf_after_item_title_data(){
        wf_get_template_part('loop/shop-loop-after-item-title');
    }

    public function _wf_date_remaining($post_id = 0){
        echo wf_date_remaining($post_id);
    }
    public function _wf_get_date_remaining($post_id = 0){
        return wf_date_remaining($post_id);
    }

    /**
     * @param $campaign_id
     * @return mixed
     *
     * Get Total funded amount by a campaign
     */
    static function _wf_total_fund_raised_by_campaign($campaign_id = 0) {
        echo wc_price(wf_get_total_fund_raised_by_campaign($campaign_id));
    }
    public function _wf_get_total_fund_raised_by_campaign($campaign_id = 0){
        return wf_get_total_fund_raised_by_campaign($campaign_id);
    }

    /**
     * @param $campaign_id
     * @return mixed
     *
     * Get total campaign goal
     */
    public function _wf_get_total_goal_by_campaign($campaign_id){
        return wf_get_total_goal_by_campaign($campaign_id);
    }
    public static function _wf_total_goal_by_campaign($campaign_id){
        echo wc_price(wf_get_total_goal_by_campaign($campaign_id));
    }

    /**
     * @param $campaign_id
     * @return int|string
     *
     * Return total percent funded for a campaign
     */
    public function _wf_get_fund_raised_percent($campaign_id = 0) {
        return wf_get_fund_raised_percent($campaign_id);
    }
    public function _wf_fund_raised_percent($campaign_id = 0) {
        echo ceil(wf_get_fund_raised_percent($campaign_id));
    }

    public function wf_get_fund_raised_percentFormat(){
        return $this->_wf_get_fund_raised_percent().'%';
    }
    public function wf_fund_raised_percentFormat(){
        echo $this->_wf_get_fund_raised_percent().'%';
    }


    /**
     * @param $tabs
     * @return string
     *
     * Return Backer Tab
     */
    public static function wf_product_backers_tab( $tabs ) {

        global $post;
        $product = wc_get_product($post->ID);
        $show_contributor_table   = get_post_meta( $post->ID, '_wf_show_contributor_table', true );
        if($show_contributor_table == 'yes'):
            if(($product->get_type() =='wp_fundraising')){
                // Adds the new tab
                $tabs['backers'] = array(
                    'title'     => wf_single_backers_tab_text(),
                    'priority'  => 51,
                    'callback'  => 'WP_Fundraising_Actions::wf_product_backers_tab_content'
                );
            }
        endif;

        return $tabs;
    }

    public static function wf_product_backers_tab_content(){
        wf_get_template_part('loop/single/tabs/backers');
    }

    /**
     * @param $tabs
     * @return string
     *
     * Return Backer Tab
     */
    public static function wf_campaign_update_tab( $tabs ) {

        global $post;
        $product = wc_get_product($post->ID);
        if($product->get_type() =='wp_fundraising'){
            // Adds the new tab
            $tabs['updates'] = array(
                'title'     => wf_single_update_tab_text(),
                'priority'  => 50,
                'callback'  => 'WP_Fundraising_Actions::wf_campaign_update_tab_content'
            );
        }
        return $tabs;
    }

    public static function wf_campaign_update_tab_content(){
        wf_get_template_part('loop/single/tabs/updates');
    }
    public static function wf_get_orders_ID_list_per_campaign(){

        global $wpdb, $post;
        $prefix = $wpdb->prefix;
        $post_id = $post->ID;

        $query ="SELECT 
                        order_id 
                    FROM 
                        {$prefix}woocommerce_order_itemmeta woim 
			        LEFT JOIN 
                        {$prefix}woocommerce_order_items oi ON woim.order_item_id = oi.order_item_id 
			        WHERE 
                        meta_key = '_product_id' AND meta_value = %d
			        GROUP BY 
                        order_id ORDER BY order_id DESC ;";
        $order_ids = $wpdb->get_col( $wpdb->prepare( $query, $post_id ) );

        return $order_ids;
    }

    public function wf_get_customers_by_product_query(){
        $order_ids = WP_Fundraising_Actions::wf_get_orders_ID_list_per_campaign();
        if( $order_ids ) {
            $args = array(
                'post_type'         =>'shop_order',
                'post__in'          => $order_ids,
                'posts_per_page'    =>  999,
                'order'             => 'ASC',
                'post_status'       => 'wc-completed',
            );
            $wp_fundraising_orders = new WP_Query( $args );
            return $wp_fundraising_orders;
        }
        return false;
    }

    function wf_get_customers_by_product(){
        $order_ids = WP_Fundraising_Actions::wf_get_orders_ID_list_per_campaign();
        return $order_ids;
    }

    static function wf_limit_show_campaign_in_shop($wp_query){
        $tax_query = array(
            array(
                'taxonomy' => 'product_type',
                'field' => 'slug',
                'terms' => array(
                    'wp_fundraising',
                    'wf_donation'
                ),
                'operator' => 'NOT IN'
            )
        );
        $wp_query->set('tax_query', $tax_query);
        return $wp_query;

    }

}

WP_Fundraising_Actions::init();
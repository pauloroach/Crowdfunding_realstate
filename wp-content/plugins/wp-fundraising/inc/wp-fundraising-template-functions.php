<?php
if ( ! defined( 'ABSPATH' ) ) exit;


if( ! function_exists('wf_logged_in_user_campaign_ids')) {
    /**
     * @param int $user_id
     * @return array
     *
     * Get logged user all campaign id;
     */
    function wf_logged_in_user_campaign_ids($user_id = 0)
    {
        global $wpdb;
        if ($user_id == 0)
            $user_id = get_current_user_id();

        $campaign_ids = $wpdb->get_col("select ID from {$wpdb->posts} WHERE post_author = {$user_id} AND post_type = 'product'");
        return $campaign_ids;
    }
}

if ( ! function_exists('wf_get_author_name')){
    function wf_get_author_name(){
        global $post;
        $author = get_user_by('id', $post->post_author);

        $author_name = $author->first_name . ' ' . $author->last_name;
        if (empty($author->first_name))
            $author_name = $author->display_name;

        return $author_name;
    }
}



if ( ! function_exists('wf_get_author_name_by_login')){
    function wf_get_author_name_by_login($author_login){
        $author = get_user_by('login', $author_login);

        $author_name = $author->first_name . ' ' . $author->last_name;
        if (empty($author->first_name))
            $author_name = $author->user_login;

        return $author_name;
    }
}


/**
 * @return mixed|string
 *
 * get campaigns location
 */
if ( ! function_exists('wf_get_campaigns_location')){
    function wf_get_campaigns_location($campaign_id=null){
        global $post, $product;
        $xs_product = wc_get_product($campaign_id);
        if($xs_product){
            $xs_product = $xs_product;
        }else{
            $xs_product = $product;
        }
        if ($xs_product->get_type() == 'wp_fundraising'){
            $wp_country = get_post_meta($post->ID, '_wf_country', true);
            $location = get_post_meta($post->ID, '_wf_location', true);
        }elseif ($xs_product->get_type() == 'wf_donation'){
            $wp_country = get_post_meta($post->ID, '_wfd_country', true);
            $location = get_post_meta($post->ID, '_wfd_location', true);
        }else{
            $wp_country = '';
            $location = '';
        }

        if (class_exists('WC_Countries')) {
            //Get Country name from WooCommerce
            $countries_obj = new WC_Countries();
            $countries = $countries_obj->__get('countries');

            if ($wp_country){
                $country_name = $countries[$wp_country];
                $location = $location . ', ' . $country_name;
            }
        }
        return $location;
    }
}

if ( ! function_exists('wf_get_total_fund_raised_by_campaign')) {
    function wf_get_total_fund_raised_by_campaign($campaign_id = 0){
        global $wpdb, $post;
        $db_prefix = $wpdb->prefix;

        if ($campaign_id == 0)
            $campaign_id = $post->ID;

        $query = "SELECT
                    SUM(ltoim.meta_value) as total_sales_amount
                FROM
                    {$db_prefix}woocommerce_order_itemmeta woim
			    LEFT JOIN
                    {$db_prefix}woocommerce_order_items oi ON woim.order_item_id = oi.order_item_id
			    LEFT JOIN
                    {$db_prefix}posts wpposts ON order_id = wpposts.ID
			    LEFT JOIN
                    {$db_prefix}woocommerce_order_itemmeta ltoim ON ltoim.order_item_id = oi.order_item_id AND ltoim.meta_key = '_line_total'
			    WHERE
                    woim.meta_key = '_product_id' AND woim.meta_value = %d AND wpposts.post_status = 'wc-completed';";

        $wp_sql = $wpdb->get_row($wpdb->prepare($query, $campaign_id));

        return $wp_sql->total_sales_amount;
    }
}
if ( ! function_exists('is_reach_target_goal')) {
    function is_reach_target_goal($campaign_id=null)
    {
        global $post, $product;
        $xs_product = wc_get_product($campaign_id);
        if($xs_product){
            $xs_product = $xs_product;
        }else{
            $xs_product = $product;
        }
        if ($xs_product->get_type() == 'wp_fundraising'){
            $funding_goal = get_post_meta($post->ID, '_wf_funding_goal', true);
        }elseif ($xs_product->get_type() == 'wf_donation'){
            $funding_goal = get_post_meta($post->ID, '_wfd_funding_goal', true);
        }else{
            $funding_goal = '0';
        }
        $raised = wf_get_total_fund_raised_by_campaign();
        if ($raised >= $funding_goal) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('wf_get_total_goal_by_campaign')) {
    function wf_get_total_goal_by_campaign($campaign_id){
        $xs_product = wc_get_product($campaign_id);
        if(isset($xs_product)){
            if ($xs_product->get_type() == 'wp_fundraising'){
                $funding_goal = get_post_meta($campaign_id, '_wf_funding_goal', true);
            }elseif ($xs_product->get_type() == 'wf_donation'){
                $funding_goal = get_post_meta($campaign_id, '_wfd_funding_goal', true);
            }else{
                $funding_goal = '0';
            }
            return $funding_goal;
        }

    }
}

if (!function_exists('wf_date_remaining')){
    function wf_date_remaining($campaign_id = 0){
        global $post, $product;
        $xs_product = wc_get_product($campaign_id);
        if($xs_product){
            $xs_product = $xs_product;
        }else{
            $xs_product = $product;
        }
        if ($campaign_id == 0) $campaign_id = $post->ID;
 
        if ($xs_product->get_type() == 'wp_fundraising'){
            $enddate = get_post_meta( $campaign_id, '_wf_duration_end', true );
        }elseif ($xs_product->get_type() == 'wf_donation'){
            $enddate = get_post_meta( $campaign_id, '_wfd_duration_end', true );
        }else{
            $enddate = '';
        }
        if ((strtotime($enddate) + 86399) > time()) {
            $diff = strtotime($enddate) - time();
            $temp = $diff / 86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
            $days = floor($temp);
            return $days >= 1 ? $days : 1; //Return min one days, though if remain only 1 min
        }
        return 0;
    }
}
if (!function_exists('is_campaign_valid')) {
    function is_campaign_valid($campaign_id=null)
    {
        global $post, $product;
        $xs_product = wc_get_product($campaign_id);
        
        if($xs_product){
            $xs_product = $xs_product;
        }else{
            $xs_product = $product;
        }
        if ($xs_product->get_type() == 'wp_fundraising'){
            $campaign_end_method = get_post_meta($post->ID, '_wf_campaign_end_method', true);
        }elseif ($xs_product->get_type() == 'wf_donation'){
            $campaign_end_method = get_post_meta($post->ID, '_wfd_campaign_end_method', true);
        }else{
            $campaign_end_method = '';
        }
        switch ($campaign_end_method) {

            case 'target_goal':
                if (is_reach_target_goal()) {
                    return false;
                } else {
                    return true;
                }
                break;

            case 'target_date':
                if (wf_date_remaining()) {
                    return true;
                } else {
                    return false;
                }
                break;

            case 'target_goal_and_date':
                if (!is_reach_target_goal()) {
                    return true;
                }
                if (wf_date_remaining()) {
                    return true;
                }
                return false;
                break;

            case 'never_end':
                return true;
                break;

            default :
                return false;
        }
    }
}
if (!function_exists('wf_get_fund_raised_percent')) {
    function wf_get_fund_raised_percent($campaign_id = 0)
    {

        global $post;
        $percent = 0;
        if ($campaign_id == 0) {
            $campaign_id = $post->ID;
        }
        $total = wf_get_total_fund_raised_by_campaign($campaign_id);

        $goal = wf_get_total_goal_by_campaign($campaign_id);
        if ($total > 0 && $goal > 0) {
            $percent = number_format($total / $goal * 100, 2, '.', '');
        }
        if($percent > 100){
            return 100;
        }
        return ceil($percent);
    }
}


if (!function_exists('wf_get_fund_raised_percentFormat')) {
    function wf_get_fund_raised_percentFormat()
    {
        return ceil(wf_get_fund_raised_percent()) . '%';
    }
}

if (!function_exists('wf_price')) {
    function wf_price($price){
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
            return get_woocommerce_currency_symbol().number_format($price,wc_get_price_decimals(),wc_get_price_decimal_separator(), wc_get_price_thousand_separator());
        }else{
            return $price;
        }
        
    }
}

if (!function_exists('wf_backers_count')) {
    function wf_backers_count($post_id)
    {
        $data_array = WP_Fundraising_Actions::wf_get_orders_ID_list_per_campaign($post_id);
        if (!empty($data_array)) {
            $data_array = $data_array;
        }else{
            $data_array = array ('0');
        }
        $args = array(
            'post_type'     => 'shop_order',
            'post_status'   => array('wc-completed','wc-on-hold'),
            'post__in'      => $data_array
        );

        $count = count(get_posts( $args ));
        return $count;
    }
}

if (!function_exists('wp_fundraising_related_campaign')) {
    function wp_fundraising_related_campaign()
    {
        if (class_exists('WP_FundRaising')) {
            include WP_FUNDRAISING_DIR_PATH . 'templates/loop/single/related.php';
        }
    }
}

if (!function_exists('wp_fundraising_output_donation_level')) {
    function wp_fundraising_output_donation_level($campaign_id=null)
    {

        if(!isset($campaign_id)){
            $campaign_id = wf_get_option('_wf_feature_campaign_id', 'wf_donation');
        }
        $donation_level_fields = get_post_meta($campaign_id, 'repeatable_donation_level_fields', true);
        ob_start();
        ?>
        <?php if ( $donation_level_fields ) : ?>
        <div class="xs-input-group">
            <label for="xs-donate-charity-amount"><?php esc_html_e('List of Donation Level','wp-fundraising');?> <span class="color-light-red" >**</span></label>
            <select id="xs-donate-charity-amount" class="form-control">
                <option value=""><?php esc_html_e('Select Amount','wp-fundraising');?></option>
                <?php foreach ( $donation_level_fields as $field ) { ?>
                    <option value="<?php echo esc_attr( $field['_wf_donation_level_amount'] ); ?>"><?php echo wf_price(esc_attr( $field['_wf_donation_level_amount'] )); ?></option>
                <?php } ?>
                <option value="custom"><?php esc_html_e('Give a Custom Amount','wp-fundraising');?></option>
            </select>
        </div>
    <?php endif; ?>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}



if (!function_exists('wp_fundraising_output_donation_level_ajax')) {
    function wp_fundraising_output_donation_level_ajax()
    {
        $campaign_id = $_POST['post_id'];
        global $post;
        if(!isset($campaign_id)){
            $campaign_id = $post->ID;
        }
        $donation_level_fields = get_post_meta($campaign_id, 'repeatable_donation_level_fields', true);
        ob_start();
        ?>
        <?php if ( $donation_level_fields ) : ?>
        <div class="xs-input-group">
            <label for="xs-donate-charity"><?php esc_html_e('List of Donation Level','wp-fundraising');?> <span class="color-light-red" >**</span></label>
            <select id="xs-donate-charity-amount" class="form-control">
                <option value=""><?php esc_html_e('Select Amount','wp-fundraising');?></option>
                <?php foreach ( $donation_level_fields as $field ) { ?>
                    <option value="<?php echo esc_attr( $field['_wf_donation_level_amount'] ); ?>"><?php echo wf_price(esc_attr( $field['_wf_donation_level_amount'] )); ?></option>
                <?php } ?>
                <option value="custom"><?php esc_html_e('Give a Custom Amount','wp-fundraising');?></option>
            </select>
        </div>
        <?php endif; ?>
        <?php
        $html = ob_get_clean();
        echo $html;
    }
}
add_action ( 'wp_ajax_donation_level', 'wp_fundraising_output_donation_level_ajax' );
add_action ( 'wp_ajax_nopriv_donation_level', 'wp_fundraising_output_donation_level_ajax' );



if (!function_exists('wp_fundraising_output_evaluated_charities')) {
    function wp_fundraising_output_evaluated_charities()
    {
        $user_id = get_current_user_id();
        $query_args = array(
            'post_type'   => 'product',
            'author'      => $user_id,
            'tax_query'   => array(
                array(
                    'taxonomy'  => 'product_type',
                    'field'     => 'slug',
                    'terms'     => 'wf_donation',
                ),
            ),
            'posts_per_page' => -1
        );
        query_posts($query_args);
        if (have_posts()): ?>
            <div class="xs-input-group">
                <label for="xs-donate-charity"><?php esc_html_e('List of Evaluated Charities','wp-fundraising');?> <span class="color-light-red">**</span></label>
                <select id="xs-donate-charity-modal" class="form-control" name="add-to-cart">
                    <option value=""><?php esc_html_e('Select Campaign','wp-fundraising');?></option>
                    <?php while (have_posts()) : the_post(); ?>
                        <option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        <?php
        else:
            include WP_FUNDRAISING_DIR_PATH.'templates/loop/no-campaigns-found.php';
        endif;

        $html = ob_get_clean();
        wp_reset_query();
        return $html;
    }
}


if ( ! function_exists('wf_embeded_video')) {
	function wf_embeded_video($url){
		if (! empty($url)) {
			$embeded = wp_oembed_get($url);

			if ($embeded == false) {
				$url = strtolower($url);

				$format = '';
				if (strpos($url, '.mp4')) {
					$format = 'mp4';
				} elseif (strpos($url, '.ogg')) {
					$format = 'ogg';
				} elseif (strpos($url, '.webm')) {
					$format = 'WebM';
				}

				$embeded = '<video controls><source src="' . $url . '" type="video/' . $format . '">'.__('Your browser does not support the video tag.', 'wp-fundraising').'</video>';
			}
			return '<div class="wf-video-wrapper">' . $embeded . '</div>';
		} else{
			return false;
		}
	}
}
if ( ! function_exists('getYoutubeImage')) {
    function getYoutubeImage($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];  
        //DISPLAY THE IMAGE
        if(strlen($v)>0){
            echo "<img src='http://i3.ytimg.com/vi/$v/default.jpg' width='600' />";
        }
    }
}
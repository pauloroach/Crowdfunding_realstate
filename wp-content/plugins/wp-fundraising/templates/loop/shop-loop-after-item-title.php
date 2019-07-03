<?php
    if ( ! defined( 'ABSPATH' ) ) exit;

    global $post;
    $product = wc_get_product($post->ID);

    if($product->get_type() != 'wp_fundraising'){
        return '';
    }

    $funding_goal   = wf_get_total_goal_by_campaign($post->ID);

    $wp_country  = get_post_meta( $post->ID, '_wf_country', true);
    $total_sales    = get_post_meta( $post->ID, 'total_sales', true );
    $enddate        = get_post_meta( $post->ID, '_wf_duration_end', true );

    //Get Country name from WooCommerce
    $countries_obj  = new WC_Countries();
    $countries      = $countries_obj->__get('countries');

    $country_name = '';
    if ($wp_country){
        $country_name = $countries[$wp_country];
    }

    $raised = 0;
    $total_raised = wf_get_total_fund_raised_by_campaign();
    if ($total_raised){
        $raised = $total_raised;
    }

    //Get order sales value by product
    $sales_value_by_product = 0;

    $days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
    if (wf_date_remaining()){
        $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining().' days remaining', 'wp-fundraising'));
    }

    $html = '';
    $html .= '<ul class="xs-list-with-content fundpress-list-item-content">';

    if ($country_name) {
        $html .= '<li><span>'. $country_name.'</span></li>';
    }

    if ($funding_goal) {
        $html .= '<li>'.wc_price($funding_goal).'<span>'.esc_html__('Funding Goal', 'wp-fundraising') . '</span></li>';
    }

    if ($total_sales) {
        $html .=  '<li>'.wc_price( $raised).'<span>'.esc_html__('Raised', 'wp-fundraising') . '</span></li>';
    }
    if ($total_sales && $funding_goal) {
        $percent = wf_get_fund_raised_percent();
        $html .= '<li><span class="number-percentage-count">' . $percent.' %</span><span>'.esc_html__('Funded: ', 'wp-fundraising') . '</span></li>';
    }

    if ($total_sales) {
        $html .= '<li>'.$days_remaining. '<span>'.esc_html__('Days to go', 'wp-fundraising') . '</span></li>';
    }

    $html .= '</ul>';
    echo apply_filters('woocommerce_product_cf_meta_data',$html);
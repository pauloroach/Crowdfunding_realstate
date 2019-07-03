<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $post, $wpdb;
$html       = '';
$prefix     = $wpdb->prefix;
$product_id = $post->ID;
$data_array = WP_Fundraising_Actions::wf_get_orders_ID_list_per_campaign();

$args = array(
    'post_type'     => 'shop_order',
    'post_status'   => array('wc-completed','wc-on-hold'),
    'post__in'      => $data_array
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
    
    ?>
    <div class="xs-backers-lsit-wraprer">
    <ul class="fundpress-backer-lsit">

    <?php
    while ( $the_query->have_posts() ) : $the_query->the_post();

        $post_id = get_the_ID();
        $order = new WC_Order($post_id);
        $price = $wpdb->get_results("SELECT order_meta.meta_value FROM `{$prefix}woocommerce_order_itemmeta` AS order_meta, `{$prefix}woocommerce_order_items` AS order_item WHERE order_meta.order_item_id IN (SELECT order_item.order_item_id FROM `{$prefix}woocommerce_order_items` as order_item WHERE order_item.order_id = {$post_id}) AND order_meta.order_item_id IN (SELECT meta.order_item_id FROM `{$prefix}woocommerce_order_itemmeta` AS meta WHERE meta.meta_key='_product_id' AND meta.meta_value={$product_id} ) AND order_meta.meta_key='_line_total' GROUP BY order_meta.meta_id");
        $price = json_decode( json_encode($price), true );

        $html .= '<li class="row xs-margin-0">';
        $html .= '<div class="row xs-margin-0 col-md-6 text-left">';

        $html .= '<div class="xs-avatar full-round">';
        $html .= get_avatar( $order->get_billing_email(), 100 );
        $html .= '</div>';

        $html .= '<div class="fundpress-backer-info">';


        $contributor_show   = get_post_meta( $product_id, '_wf_mark_contributors_as_anonymous', true );

        if($contributor_show == 'yes'):
            $html .= '<h3 class="color-navy-blue semi-bold">'.esc_html__('Anonymous','wp-fundraising').'</h3>';
        else:
            $html .= '<h3 class="color-navy-blue semi-bold">'.$order->get_billing_first_name().' '.$order->get_billing_last_name().'</h3>';
        endif;

        if(isset($price[0]['meta_value'])){
            $html .= '<h4 class="color-green regular xs-mb-0">'.wc_price($price[0]['meta_value']).'</h4>';
        }
        $html .= '</div>';

        $html .= '</div>';

        $html .= '</li>';

    endwhile;
    wp_reset_postdata();

    $html .= '</ul></div>';
    ?>



<?php
else :
    $html .= esc_html__( 'Sorry, no backer for this campaign.','wp-fundraising' );
endif;

echo $html;
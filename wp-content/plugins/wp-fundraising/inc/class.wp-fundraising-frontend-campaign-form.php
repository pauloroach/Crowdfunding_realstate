<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WP_Fundraising_Frontend_Campaign_Submit_Form')) {

    class WP_Fundraising_Frontend_Campaign_Submit_Form{

        protected static $_instance;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_action('init', 'WP_Fundraising_Frontend_Campaign_Submit_Form::wp_fundraising_frontend_data_save');
        }

        public static function wp_fundraising_frontend_data_save(){
            if (isset($_POST["campaign_submit"])) {

                $title = $campaign_goal = $description = $short_description  = $campaign_predefined_amount = $category = $tag = $image_id = $video = $start_date = '';
                $end_date = $min_price = $max_price = $recommended_price = $type = '';
                $campaign_end_method = $campaign_contributor_table = $campaign_contributor_show = $campaign_country = $campaign_location = '';

                if ( empty($_POST['wp_fundraising_terms_agree'])){
                    die(json_encode(array('success'=> 0, 'message' => esc_html__('Please check terms condition', 'wp-fundraising'))));
                } 
                
                // if (wf_get_option('_wf_frontend_campaign_submission_status', 'wf_advanced')=='draft') {
                //     $status = 'draft';
                // }elseif (wf_get_option('_wf_frontend_campaign_submission_status', 'wf_advanced')=='publish') {
                
                // }elseif (wf_get_option('_wf_frontend_campaign_submission_status', 'wf_advanced')=='pending') {
                
                // }
                if ($_POST['wf_campaign_title']) {
                    $title = sanitize_text_field($_POST['wf_campaign_title']);
                }
                if( $_POST['wf_campaign_description'] ){
                    $description = $_POST['wf_campaign_description'];
                }
                if( $_POST['wf_campaign_short_description'] ){
                    $short_description = $_POST['wf_campaign_short_description'];
                }
                if( $_POST['wf_campaign_category'] ){
                    $category = sanitize_text_field($_POST['wf_campaign_category']);
                }
                if( $_POST['wf_campaign_tags'] ){
                    $tag = sanitize_text_field($_POST['wf_campaign_tags']);
                }
                if( $_FILES['wf_campaign_image_id'] ){
                    $image_id = $_FILES['wf_campaign_image_id'];
                }
                if ($_POST['wf_campaign_video']) {
                    $video = sanitize_text_field($_POST['wf_campaign_video']);
                }
                if ($_POST['wf_campaign_start_date']) {
                    $start_date = sanitize_text_field($_POST['wf_campaign_start_date']);
                }
                if ($_POST['wf_campaign_end_date']) {
                    $end_date = sanitize_text_field($_POST['wf_campaign_end_date']);
                }
                if ($_POST['wf_campaign_goal']) {
                    $campaign_goal = sanitize_text_field($_POST['wf_campaign_goal']);
                }
                if ($_POST['wf_campaign_min_amount']) {
                    $min_price = sanitize_text_field($_POST['wf_campaign_min_amount']);
                }
                if ($_POST['wf_campaign_max_amount']) {
                    $max_price = sanitize_text_field($_POST['wf_campaign_max_amount']);
                }
                if ($_POST['_wf_funding_recommended_price']) {
                    $recommended_price = sanitize_text_field($_POST['_wf_funding_recommended_price']);
                }
                if (isset($_POST['wf_show_contributor_table'])) {
                    $campaign_contributor_table = sanitize_text_field($_POST['wf_show_contributor_table']);
                }
                if ($_POST['wf_campaign_end_method']) {
                    $campaign_end_method = sanitize_text_field($_POST['wf_campaign_end_method']);
                }
                if (isset($_POST['wf_mark_contributors_as_anonymous'])) {
                    $campaign_contributor_show = sanitize_text_field($_POST['wf_mark_contributors_as_anonymous']);
                }
                if ($_POST['wf_campaign_country']) {
                    $campaign_country = sanitize_text_field($_POST['wf_campaign_country']);
                }

                if ($_POST['wf_campaign_location']) {
                    $campaign_location = sanitize_text_field($_POST['wf_campaign_location']);
                }





                $new_reward = array();
                $pledge_amount = $_POST['_wf_pledge_amount'];
                $reward_title = $_POST['_wf_reward_title'];
                $reward_description = $_POST['_wf_reward_description'];
                $reward_offer = $_POST['_wf_reward_offer'];
                $reward_estimated_delivery_date = $_POST['_wf_reward_estimated_delivery_date'];
                $reward_quantity = $_POST['_wf_reward_quantity'];
                $reward_ships_to = $_POST['_wf_reward_ships_to'];


                $count = count( $pledge_amount );

                for ( $i = 0; $i < $count; $i++ ) {
                    if ( $pledge_amount[$i] != '' ) :
                        $new_reward[$i]['_wf_pledge_amount'] = stripslashes($pledge_amount[$i] );
                        $new_reward[$i]['_wf_reward_title'] = stripslashes( $reward_title[$i] );
                        $new_reward[$i]['_wf_reward_description'] = stripslashes( $reward_description[$i] );
                        $new_reward[$i]['_wf_reward_offer'] = stripslashes( $reward_offer[$i]  );
                        $new_reward[$i]['_wf_reward_estimated_delivery_date'] = stripslashes( $reward_estimated_delivery_date[$i]  );
                        $new_reward[$i]['_wf_reward_quantity'] = stripslashes( $reward_quantity[$i] );
                        $new_reward[$i]['_wf_reward_ships_to'] = stripslashes( $reward_ships_to[$i] );
                    endif;
                }

                $user_id = get_current_user_id();

                
                $uploaddir = wp_upload_dir();

                $uploadfile = $uploaddir['path'] . '/' . basename( $image_id['name'] );
                move_uploaded_file( $image_id['tmp_name'] , $uploadfile );
                $filename = basename( $uploadfile );
                $wp_filetype = wp_check_filetype(basename($filename), null );

                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content' => '',
                    'post_status' => 'inherit',
                );
                $attach_id = wp_insert_attachment( $attachment, $uploadfile );



                if(isset($_GET['campaign_id'])){
                    $campaign_id = $_GET['campaign_id'];
                    $my_post = array(
                        'ID' => $campaign_id,
                        'post_type' => 'product',
                        'post_title' => $title,
                        'post_content'  => $description,
                        'post_excerpt'  => $short_description,
                        'post_author' => $user_id,
                        'post_status' => wf_get_option('_wf_frontend_campaign_submission_status', 'wf_advanced'),
                    );
                    wp_update_post( $my_post );

                }else{
                    $my_post = array(
                        'post_type' => 'product',
                        'post_title' => $title,
                        'post_content'  => $description,
                        'post_excerpt'  => $short_description,
                        'post_author' => $user_id,
                        'post_status' => wf_get_option('_wf_frontend_campaign_submission_status', 'wf_advanced'),
                    );
                    $post_id = wp_insert_post($my_post);
                    $campaign_id = $post_id;
                }


                if ($campaign_id) {

                    if( $category != '' ){
                        $cat = explode(' ',$category );
                        wp_set_object_terms( $campaign_id , $cat, 'product_cat',true );
                    }
                    if( $tag != '' ){
                        $tag = explode( ',',$tag );
                        wp_set_object_terms( $campaign_id , $tag, 'product_tag',true );
                    }

                    wp_set_object_terms($campaign_id, 'wp_fundraising', 'product_type', true);

                    update_post_meta($campaign_id,'_thumbnail_id',$attach_id);
                    set_post_thumbnail( $campaign_id, $attach_id );

                    update_post_meta($campaign_id, '_wf_funding_video', $video);
                    update_post_meta($campaign_id, '_wf_funding_goal', $campaign_goal);
                    update_post_meta($campaign_id, '_wf_duration_start', $start_date);
                    update_post_meta($campaign_id, '_wf_duration_end', $end_date);
                    update_post_meta($campaign_id, '_wf_funding_minimum_price', $min_price);
                    update_post_meta($campaign_id, '_wf_funding_maximum_price', $max_price);
                    update_post_meta($campaign_id, '_wf_funding_recommended_price', $recommended_price);
                    update_post_meta($campaign_id, '_wf_campaign_predefined_amount', $campaign_predefined_amount);


                    update_post_meta($campaign_id, '_wf_campaign_end_method', $campaign_end_method);
                    update_post_meta($campaign_id, '_wf_show_contributor_table', $campaign_contributor_table);
                    update_post_meta($campaign_id, '_wf_mark_contributors_as_anonymous', $campaign_contributor_show);
                    update_post_meta($campaign_id, '_wf_country', $campaign_country);
                    update_post_meta($campaign_id, '_wf_location', $campaign_location);

                    update_post_meta( $campaign_id, 'repeatable_reward_fields', $new_reward );

                }
            }
        }
    }
}

// Instantiate Class: WP_Fundraising_Frontend_Campaign_Submit_Form
WP_Fundraising_Frontend_Campaign_Submit_Form::instance();
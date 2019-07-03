<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


add_shortcode( 'wp_fundraising_form','wp_fundraising_campaign_form_shortcode' ); // Shortcode for Campaign Submit Form

// Shortcode for Forntend Submission Form
function wp_fundraising_campaign_form_shortcode( $atts ){
    global $post;
    $title = $campaign_goal = $description = $short_description  = $minimum_amount = $maximum_amount = $category = $tag = $image_id = $video = $start_date = '';
    $end_date = $recomended_amount = $countries = $country = $location = $type  = $image_url = '';
    $campaign_end_method = $campaign_contributor_table = $contributor_show = $campaign_country = $estimated_date = $campaign_location = '';
    $checked = $checked2 = '';
    $campaign_reward_offer = '';
    $html = '';
    $reward_fields = array();
    if(isset($_GET['action'])){
        if($_GET['action']=='edit'){
            $post_id = (int) sanitize_text_field(@$_GET['campaign_id']);


            $campaign_ids = wf_logged_in_user_campaign_ids();

            if ( ! in_array($post_id, $campaign_ids)){

                $html.= '<div class="woocommerce mb-30">';
                $html .= '<p class="woocommerce-info">'. esc_html__( 'You are not allowed to access this page.', 'wp-fundraising' ) .'</p>';
                $html .= '<p>'. esc_html__( 'Want to create a brand new campaign?', 'wp-fundraising' ) .' <a href="'.home_url('/').'wf-campaign-form">'. esc_html__( 'Click Here', 'wp-fundraising' ) .'</p>';
                $html .= '</div>';

                return $html;
            }

            $args = array(
                'p' => $post_id,
                'post_type' => 'product'
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    if( $post->post_author == get_current_user_id() ){

                        $title              = get_the_title();
                        $short_description  = get_the_excerpt();
                        $description        = get_the_content();
                        $category           = strip_tags(get_the_term_list( get_the_ID(), 'product_cat', '', ','));
                        $tag                = strip_tags( get_the_term_list( get_the_ID(), "product_tag","",", ") );
                        if ( has_post_thumbnail() ) {
                            $image_url          = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $image_url          = $image_url[0];
                            $image_id           = get_post_thumbnail_id( get_the_ID() );
                        }
                        $video              = get_post_meta( get_the_ID(), '_wf_funding_video', true );
                        $start_date         = get_post_meta( get_the_ID(), '_wf_duration_start', true );
                        $end_date           = get_post_meta( get_the_ID(), '_wf_duration_end', true );
                        $minimum_amount      = get_post_meta( get_the_ID(), '_wf_funding_maximum_amount', true );
                        $maximum_amount      = get_post_meta( get_the_ID(), '_wf_funding_minimum_amount', true );
                        $recomended_amount   = get_post_meta( get_the_ID(), '_wf_funding_recommended_price', true );
                        $campaign_goal       = get_post_meta( get_the_ID(), '_wf_funding_goal', true );
                        $campaign_end_method = get_post_meta(get_the_ID(), '_wf_campaign_end_method', true);
                        $campaign_contributor_table = get_post_meta( get_the_ID(), '_wf_show_contributor_table', true );
                        $contributor_show   = get_post_meta( get_the_ID(), '_wf_mark_contributors_as_anonymous', true );

                        $country            = get_post_meta( get_the_ID(), '_wf_country', true );
                        $location           = get_post_meta( get_the_ID(), '_wf_location', true );
                        $reward_fields             = get_post_meta( get_the_ID(), 'repeatable_reward_fields', true );

                    }
                }
            }
            wp_reset_postdata();
        }
    }

    if ( is_user_logged_in() ) {
        $html .= '<div class="row">';
        $html .= '<div class="container">';
        $html .= '<div class="xs-campaign-form">';

        $html .= '<form method="post" action="#" id="campaign_form" class="xs-campaign" enctype="multipart/form-data">';



        $html .= '<ul class="nav nav-tabs xs-nav-tabs" id="myTab" role="tablist">';
        $html .= ' <li class="nav-item">';
        $html .= '<a class="nav-link active" id="generalOptions-tab" data-toggle="tab" href="#generalOptions" role="tab" aria-controls="generalOptions" aria-selected="true">' . esc_html__("General Options", "wp-fundraising") . '</a>';
        $html .= '</li>';
        $html .= '<li class="nav-item">';
        $html .= '<a class="nav-link" id="rewardOptions-tab" data-toggle="tab" href="#rewardOptions" role="tab" aria-controls="rewardOptions" aria-selected="false">' . esc_html__("Reward Options", "wp-fundraising") . '</a>';
        $html .= '</li>';
        $html .= '</ul>';
        $html .= '<div class="tab-content" id="myTabContent">';

        $html .= '<div class="card tab-pane fade show active" id="generalOptions" role="tabpanel" aria-labelledby="generalOptions-tab">';

        //Title
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Title", "wp-fundraising") . '</span>';

        $html .= '<div class="help-tip">';
		$html .= '<p>' . esc_html__("Put the campaign title here", "wp-fundraising") . '</p>';
		$html .= '</div>';

        $html .= '<input type="text" class="form-control" name="wf_campaign_title" id="campaign_title" value="'.$title.'">';
        $html .= '</div>';


        $html .= '<div class="row">';

        //Category
        $html .= '<div class="col-lg-6">';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Category", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Select your campaign category", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<div class="wf-fields">';
        $html .= '<select class="form-control" name="wf_campaign_category" id="campaign_category" value="'.$category.'">';
        $all_cat = get_terms('product_cat',array( 'hide_empty' => false ) );
        foreach ($all_cat as $value) {
            $selected = ($category == $value->name) ? 'selected':'';
            $html .= '<option '.$selected.' value="'.$value->slug.'">'.$value->name.'</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';


        //Tag
        $html .= '<div class="col-lg-6">';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Tag", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Separate tags with commas eg: tag1,tag2", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="text" class="form-control" name="wf_campaign_tags" id="campaign_tags" placeholder="' . esc_attr__("Tag", "wp-fundraising") . '" value="'.$tag.'">';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        //Image
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Image", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Upload a campaign feature image", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<div class="custom-file">';
        $html .= '<input type="file" class="custom-file-input" name="wf_campaign_image_id" id="customFile" value="'.$image_url.'">';
        $html .= '<label class="custom-file-label" for="customFile"></label>';
        $html .= '<span class="file-name"></span>';
        $html .= '</div>';
        $html .= '</div>';


        //Video
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Video", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Put the campaign video URL here", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<div class="wf-fields">';
        $html .= '<input type="url" name="wf_campaign_video" class="form-control" id="campaign_video" placeholder="' . esc_html__("https://", "wp-fundraising") . '" value="'.$video.'">';
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="row">';
        $html .= '<div class="col-lg-6">';

        //Start Date
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Start Date", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Campaign start date (dd-mm-yy)", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="date" name="wf_campaign_start_date" class="form-control" id="campaign_start_date" value="'.$start_date.'">';
        $html .= '</div>';


        //Funding Goal
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Funding Goal ", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Campaign funding goal", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="text" class="form-control" name="wf_campaign_goal" id="campaign_goal" value="'.$campaign_goal.'">';
        $html .= '</div>';

        if (wf_get_option('_wf_hide_min_price', 'wf_basics') != "on") {
            //Minimum Amount
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Minimum Amount", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Minimum campaign funding amount", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="number" name="wf_campaign_min_amount" class="form-control" id="campaign_min_amount" value="'.$minimum_amount.'">';
            $html .= '</div>';
        }

        //Recomended Amount
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Recomended Amount", "wp-fundraising") . '</span>';

        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Recommended campaign funding amount", "wp-fundraising") . '</p>';
        $html .= '</div>';

        $html .= '<input type="number" name="_wf_funding_recommended_price" class="form-control" id="campaign_reco_amount" value="'.$recomended_amount.'">';
        $html .= '</div>';

        //Contributor Table
        if( $campaign_contributor_table == 'yes' )
            $checked = 'checked="checked"';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Contributor Table", "wp-fundraising") . '</span>';

        $html .= '<div class="custom-control">';
        $html .= '<input type="checkbox" class="custom-control-input"  '.$checked.' name="wf_show_contributor_table" id="customCheck1" value="yes">';
        $html .= '<label class="custom-control-label" for="customCheck1">' . esc_html__("Show contributor table on campaign single page", "wp-fundraising") . '</label>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<div class="col-lg-6">';


        //End Date
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("End Date", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Campaign end date (dd-mm-yy)", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="date" class="form-control" name="wf_campaign_end_date" id="campaign_end_date" value="'.$end_date.'" >';
        $html .= '</div>';

        //End Method
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("End Method", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Choose the stage when campaign will end", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<select class="form-control" name="wf_campaign_end_method" id="campaign_end_method">';

        if (wf_get_option('_wf_hide_target_goal', 'wf_basics') != "on") {
            $selected = $campaign_end_method == 'target_goal' ? 'selected="selected"' : '';
            $html .= '<option value="target_goal" '.$selected.'>' . esc_html__("Target Goal", "wp-fundraising") . '</option>';
        }
        if (wf_get_option('_wf_hide_target_date', 'wf_basics') != "on") {
            $selected = $campaign_end_method == 'target_date' ? 'selected="selected"' : '';
            $html .= '<option value="target_date" '.$selected.'>' . esc_html__("Target Date", "wp-fundraising") . '</option>';
        }
        if (wf_get_option('_wf_hide_target_goal_and_date', 'wf_basics') != "on") {
            $selected = $campaign_end_method == 'target_goal_and_date' ? 'selected="selected"' : '';
            $html .= '<option value="target_goal_and_date" '.$selected.'>' . esc_html__("Target Goal & Date", "wp-fundraising") . '</option>';
        }

        if (wf_get_option('_wf_hide_campaign_never_end', 'wf_basics') != "on") {
            $selected = $campaign_end_method == 'never_end' ? 'selected="selected"' : '';
            $html .= '<option value="never_end" '.$selected.'>' . esc_html__("Campaign Never Ends", "wp-fundraising") . '</option>';
        }

        $html .= '</select>';
        $html .= '</div>';
        if (wf_get_option('_wf_hide_min_price', 'wf_basics') != "on") {
            //Maximum Amount
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Maximum Amount", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Maximum campaign funding amount", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="number" name="wf_campaign_max_amount" class="form-control" id="campaign_max_amount" value="'.$maximum_amount.'">';
            $html .= '</div>';
        }
        //Predefined Pledge Amount
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Predefined Pledge Amount", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Predefined amount allow you to place the amount you donate box by click", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="number" class="form-control" name="wf_campaign_predefined_amount" id="campaign_predefined_amount">';
        $html .= '</div>';

        //Contributor Anonymity
        if( $contributor_show == 'yes' )
            $checked2 = 'checked="checked"';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Contributor Anonymity", "wp-fundraising") . '</span>';
        $html .= '<div class="custom-control">';
        $html .= '<input type="checkbox" class="custom-control-input" '.$checked2.' name="wf_mark_contributors_as_anonymous" id="customCheck2" value="yes">';
        $html .= '<label class="custom-control-label" for="customCheck2">' . esc_html__("Make contributors anonymous on the contributor table", "wp-fundraising") . '</label>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        //Country
        $html .= '<div class="col-lg-6">';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Country", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Select your country", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $countries_obj = new WC_Countries();
        $countries = $countries_obj->__get('countries');
        array_unshift($countries, 'Select a country');
        $html .= '<select class="xs-select2 form-control" name="wf_campaign_country" id="campaign-country">';
        foreach ($countries as $key => $value) {
            if( $country==$key ){
                $html .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
            }else{
                $html .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';


        //Location
        $html .= '<div class="col-lg-6">';
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Location", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Put the campaign location here", "wp-fundraising") . '</p>';
        $html .= '</div>';
        $html .= '<input type="text" class="form-control" value="'.$location.'" name="wf_campaign_location" id="campaign_location">';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';



        //Short Description
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Short Description", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Put the campaign short description here", "wp-fundraising") . '</p>';
        $html .= '</div>';
        ob_start();
        wp_editor($short_description, 'wf_campaign_short_description');
        $html .= ob_get_clean();
        $html .= '</div>';


        //Description
        $html .= '<div class="form-group">';
        $html .= '<span class="h3">' . esc_html__("Description", "wp-fundraising") . '</span>';
        $html .= '<div class="help-tip">';
        $html .= '<p>' . esc_html__("Put the campaign description here", "wp-fundraising") . '</p>';
        $html .= '</div>';
        ob_start();
        wp_editor($description, 'wf_campaign_description');
        $html .= ob_get_clean();
        $html .= '</div>';


        $html .= '</div>';

        $html .= '<div class="card tab-pane fade" id="rewardOptions" role="tabpanel" aria-labelledby="rewardOptions-tab">';

        //Reward Option
        $html .= '<div class="xs-reward-wraper">';


        if ($reward_fields) :

            foreach ($reward_fields as $reward) {
                $pledge_amount = $reward_title = $reward_description = $reward_offer = $reward_estimated_delivery_date= $reward_quantity = $reward_ships_to = '';
                if(isset($reward['_wf_pledge_amount']) && $reward['_wf_pledge_amount'] != '')
                    $pledge_amount =  esc_attr( $reward['_wf_pledge_amount'] );

                if(isset($reward['_wf_reward_title']) && $reward['_wf_reward_title'] != '')
                    $reward_title =  esc_attr( $reward['_wf_reward_title'] );

                if(isset($reward['_wf_reward_description']) && $reward['_wf_reward_description'] != '')
                    $reward_description =  esc_attr( $reward['_wf_reward_description'] );

                if(isset($reward['_wf_reward_offer']) && $reward['_wf_reward_offer'] != '')
                    $reward_offer =  esc_attr( $reward['_wf_reward_offer'] );

                if(isset($reward['_wf_reward_estimated_delivery_date']) && $reward['_wf_reward_estimated_delivery_date'] != '')
                    $reward_estimated_delivery_date =  esc_attr( $reward['_wf_reward_estimated_delivery_date'] );

                if(isset($reward['_wf_reward_quantity']) && $reward['_wf_reward_quantity'] != '')
                    $reward_quantity =  esc_attr( $reward['_wf_reward_quantity'] );

                if(isset($reward['_wf_reward_ships_to']) && $reward['_wf_reward_ships_to'] != '')
                    $reward_ships_to =  esc_attr( $reward['_wf_reward_ships_to'] );

                $html .= '<div class="xs-reward-input-filed">';


                //Pledge Amount
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Pledge Amount", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Enter Pledge amount", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="number" class="form-control" name="_wf_pledge_amount[]" id="reward_pledge" value="'.$pledge_amount.'">';
                $html .= '</div>';

                //Reward Title
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Reward Title", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Enter  Reward Title", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="text" class="form-control" name="_wf_reward_title[]" id="reward_title" value="'.$reward_title.'">';
                $html .= '</div>';


                //Reward
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Reward Description", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Enter Reward description", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<textarea class="form-control form-control-sm" name="_wf_reward_description[]" id="campaign_reward_description" rows="3">'.$reward_description.'</textarea>';
                $html .= '</div>';


                //Additional Reward Offer
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Additional Reward Offer", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Additional Reward Offer", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="text" class="form-control" name="_wf_reward_offer[]" id="campaign_reward_offer" value="'.$reward_offer.'">';
                $html .= '</div>';


                $html .= '<div class="row">';

                //Estimated Delivery Date
                $html .= '<div class="col-lg-6">';
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Estimated Delivery Date", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Estimated delivery Date of the Reward (dd-mm-yy)", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="date" class="form-control" name="_wf_reward_estimated_delivery_date[]" id="campaign_estimated_date" value="'.$reward_estimated_delivery_date.'" >';
                $html .= '</div>';
                $html .= '</div>';


                //Quantity
                $html .= '<div class="col-lg-6">';
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Quantity", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Enter Quantity of physical products", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="number" class="form-control" step="1" min="1" name="_wf_reward_quantity[]"  value="'.$reward_quantity.'"/>';
                $html .= '</div>';
                $html .= '</div>';

                $html .= '</div>';


                //Ships To
                $html .= '<div class="form-group">';
                $html .= '<span class="h3">' . esc_html__("Ships To", "wp-fundraising") . '</span>';
                $html .= '<div class="help-tip">';
                $html .= '<p>' . esc_html__("Enter Ships To", "wp-fundraising") . '</p>';
                $html .= '</div>';
                $html .= '<input type="text" class="form-control" placeholder="Anywhere in the world" name="_wf_reward_ships_to[]" value="'.$reward_ships_to.'"/>';
                $html .= '</div>';


                $html .= '<button type="reset" id="remove-btn" class="btn btn-danger float-right rounded">' . esc_html__("Remove", "wp-fundraising") . '</button>';
                $html .= '<div class="clearfix"></div>';
                $html .= '</div>';
                $html .= '<button type="submit" id="addMore-btn" class="btn btn-primary float-right rounded">' . esc_html__("Add more", "wp-fundraising") . '</button>';
                $html .= '<div class="clearfix"></div>';


            }

        else:
            $html .= '<div class="xs-reward-input-filed">';


            //Pledge Amount
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Pledge Amount", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Enter Pledge amount", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="number" class="form-control" name="_wf_pledge_amount[]" id="reward_pledge">';
            $html .= '</div>';

            //Reward Title
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Reward Title", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Enter  Reward Title", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="text" class="form-control" name="_wf_reward_title[]" id="reward_title">';
            $html .= '</div>';


            //Reward
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Reward Description", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Enter Reward description", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<textarea class="form-control form-control-sm" name="_wf_reward_description[]" id="campaign_reward_description" rows="3"></textarea>';
            $html .= '</div>';


            //Additional Reward Offer
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Additional Reward Offer", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Additional Reward Offer", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="text" class="form-control" name="_wf_reward_offer[]" id="campaign_reward_offer" value="'.$campaign_reward_offer.'" >';
            $html .= '</div>';



            $html .= '<div class="row">';
            //Estimated Delivery Date
            $html .= '<div class="col-lg-6">';
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Estimated Delivery Date", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Estimated delivery Date of the Reward (dd-mm-yy)", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="date" class="form-control" name="_wf_reward_estimated_delivery_date[]" id="campaign_estimated_date" value="'.$estimated_date.'" >';
            $html .= '</div>';
            $html .= '</div>';


            //Quantity
            $html .= '<div class="col-lg-6">';
            $html .= '<div class="form-group">';
            $html .= '<span class="h3">' . esc_html__("Quantity", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Enter Quantity of physical products", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="number" class="form-control" step="1" min="1" name="_wf_reward_quantity[]" />';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '</div>';

            //Ships To
            $html .= '<div class="form-group">';
            $html .= '<span class="h3" >' . esc_html__("Ships To", "wp-fundraising") . '</span>';
            $html .= '<div class="help-tip">';
            $html .= '<p>' . esc_html__("Enter Ships To", "wp-fundraising") . '</p>';
            $html .= '</div>';
            $html .= '<input type="text" class="form-control"  placeholder="Anywhere in the world" name="_wf_reward_ships_to[]" />';
            $html .= '</div>';


            $html .= '<button type="reset" id="remove-btn" class="btn btn-danger float-right rounded">' . esc_html__("Remove", "wp-fundraising") . '</button>';
            $html .= '<div class="clearfix"></div>';
            $html .= '</div>';
            $html .= '<button type="submit" id="addMore-btn" class="btn btn-primary float-right rounded">' . esc_html__("Add more", "wp-fundraising") . '</button>';
            $html .= '<div class="clearfix"></div>';


        endif;

        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<div class="xs-campaing-from-submit-wraper">';
        $html .= '<hr>';

        $html .= '<div class="form-group">';
        $html .= '<div class="custom-control">';
        $html .= '<input type="checkbox" class="custom-control-input" name="wp_fundraising_terms_agree" id="customCheck3">';
        $html .= '<label class="custom-control-label" for="customCheck3">' . _x("I agree with <a href='".get_the_permalink(wf_get_option('_wf_terms_page_id', 'wf_advanced'))."'>terms and conditions.</a>", "wp-fundraising") . '</label>';
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="clearfix">';
        $html .= '<button type="submit" name="campaign_submit" class="btn btn-primary float-right rounded">' . esc_html__("Submit", "wp-fundraising") . '</button>';
        $html .= '</div>';


        $html .= '</form>';


        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div> ';

    }else{
        $html = '<div class="xs-section-padding xs-login-btn-area">';
        $html .= '<div class="container">';
        $html .= '<p>'.esc_html__('Please ','wp-fundraising').'<a href="" data-toggle="modal" data-target=".'.wf_login_signup_modal_class().'">'.esc_html__('Log In','wp-fundraising').'</a>'.esc_html__(' to create a campaign','wp-fundraising').'</p>';
        $html .= '</div>';
        $html .= '</div> ';
    }
    return $html;
}
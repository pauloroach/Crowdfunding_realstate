<?php

class WF_VC_Mapping
{
    static function wf_vc_map()
    {

        vc_map(array(
            "name" => __("WP Fundraising Campaigns", "wp-fundraising"),
            "base" => "wf_vc_campaigns",
            "category" => __("WP Fundraising", "wp-fundraising"),
        
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Campaign Type", "wp-fundraising"),
                    "param_name" => "donation",
                    'value' => array(
                        esc_html__( "Select Campaign Type", "wp-fundraising" ) => 'no',
                        esc_html__( "Donation", "wp-fundraising" ) => 'yes',
                        esc_html__( "Crowdfunding", "wp-fundraising" ) => 'no',
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Style", "wp-fundraising"),
                    "param_name" => "style",
                    'value' => array(
                        esc_html__( 'style 1', 'wp-fundraising' ) => '1',
                        esc_html__( 'style 2', 'wp-fundraising' ) => '2',
                        esc_html__( 'style 3', 'wp-fundraising' ) => '3',
                        esc_html__( 'style 4', 'wp-fundraising' ) => '4',
                    ),
                    'save_always' => true,
                ),
                array(

                    "type"       => "textfield",

                    "heading"    => "Post Count",

                    "param_name" => "number",

                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Number of columns", "wp-fundraising"),
                    "param_name" => "col",
                    'value' => array(
                        esc_html__( '2', 'wp-fundraising' ) => '2',
                        esc_html__( '3', 'wp-fundraising' ) => '3',
                        esc_html__( '4', 'wp-fundraising' ) => '4',
                    ),
                    'save_always' => true,
                ),
                array(

                    "type"       => "textfield",

                    "heading"    => "Category",

                    "param_name" => "cat",

                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Show/Hide Author", "wp-fundraising"),
                    "param_name" => "author",
                    'value' => array(
                        esc_html__( "Show", "wp-fundraising" ) => 'yes',
                        esc_html__( "Hide", "wp-fundraising" ) => 'no',
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Show/Hide Filter", "wp-fundraising"),
                    "param_name" => "filter",
                    'value' => array(
                        esc_html__( "Show", "wp-fundraising" ) => 'yes',
                        esc_html__( "Hide", "wp-fundraising" ) => 'no',
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Status", "wp-fundraising"),
                    "param_name" => "status",
                    'value' => array(
                        esc_html__( "All", "wp-fundraising" ) => 'all',
                        esc_html__( "Successful", "wp-fundraising" ) => 'successful',
                        esc_html__( "Expired", "wp-fundraising" ) => 'expired',
                        esc_html__( "Valid", "wp-fundraising" ) => 'valid',
                    ),
                    'save_always' => true,
                ),

            )
    
        ));

        vc_map(array(
            "name" => __("WF Campaign Submit Form", "wp-fundraising"),
            "base" => "wf_vc_campaign_submit_form",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));

        vc_map(array(
            "name" => __("WF Login Button", "wp-fundraising"),
            "base" => "wf_vc_login_btn",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));

        vc_map(array(
            "name" => __("WF Donate Form", "wp-fundraising"),
            "base" => "wf_vc_donate_form",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));

        vc_map(array(
            "name" => __("WF Donate Button", "wp-fundraising"),
            "base" => "wf_vc_donate_btn",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));

        vc_map(array(
            "name" => __("WF Dashboard", "wp-fundraising"),
            "base" => "wf_vc_dashboard",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));

        vc_map(array(
            "name" => __("WF Login/Registration Form", "wp-fundraising"),
            "base" => "wf_vc_registration_form",
            "category" => __("WP Fundraising", "wp-fundraising"),
        ));
    }
}
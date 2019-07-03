<?php

// Single Campaign Filters

function wf_single_custom_backers_count_text() {
    return esc_html__( 'Backers', 'wp-fundraising' );
}
add_filter('wf_single_backers_count_text', 'wf_single_custom_backers_count_text');

function wf_single_custom_backers_tab_text() {
    return esc_html__( 'Backers Tab', 'wp-fundraising' );
}
add_filter('wf_single_backers_tab_text', 'wf_single_custom_backers_tab_text');


function wf_single_custom_update_tab_text() {
    return esc_html__( 'Update Tab', 'wp-fundraising' );
}
add_filter('wf_single_update_tab_text', 'wf_single_custom_update_tab_text');


function wf_single_custom_invest_now_button_text() {
    return esc_html__( 'Back Now', 'wp-fundraising' );
}
add_filter('wf_single_invest_now_button_text', 'wf_single_custom_invest_now_button_text');


function wf_single_custom_related_campaign_title()
{
    return  sprintf(
        '<h2 class="color-navy-blue">%s</h2><span class="xs-separetor dashed-separetor fundpress-separetor"></span>' ,
        esc_html__('Related Project', 'wp-fundraising')
    );
}
add_filter('wf_single_related_campaign_title', 'wf_single_custom_related_campaign_title');


function wf_single_custom_related_campaign_desc()
{
    return  sprintf(
        '<p>%s</p>' ,
        esc_html__('Related Project Desc', 'wp-fundraising')
    );
}
add_filter('wf_single_related_campaign_description', 'wf_single_custom_related_campaign_desc');


function wf_single_custom_fund_raised_percent_text() {
    return esc_html__( 'Fund Raised Percent', 'wp-fundraising' );
}
add_filter('wf_single_fund_raised_percent_text', 'wf_single_custom_fund_raised_percent_text');


function wf_single_custom_fund_raised_text() {
    return esc_html__( 'Fund Raised', 'wp-fundraising' );
}
add_filter('wf_single_fund_raised_text', 'wf_single_custom_fund_raised_text');


function wf_single_custom_fund_goal_text() {
    return esc_html__( 'Fund Goal', 'wp-fundraising' );
}
add_filter('wf_single_fund_goal_text', 'wf_single_custom_fund_goal_text');


function wf_single_custom_reward_estimated_delivery_text() {
    return esc_html__( 'Estimated Delivery', 'wp-fundraising' );
}
add_filter('wf_single_reward_estimated_delivery_text', 'wf_single_custom_reward_estimated_delivery_text');


function wf_single_custom_reward_ship_to_text() {
    return esc_html__( 'Ship To', 'wp-fundraising' );
}
add_filter('wf_single_reward_ship_to_text', 'wf_single_custom_reward_ship_to_text');



// Archive Campaign Filters

function wf_archive_custom_backers_count_text() {
    return esc_html__( 'My Backers Count Text', 'wp-fundraising' );
}
add_filter('wf_archive_backers_count_text', 'wf_archive_custom_backers_count_text');

function wf_archive_custom_fund_goal_text() {
    return esc_html__( 'Goal', 'wp-fundraising' );
}
add_filter('wf_archive_fund_goal_text', 'wf_archive_custom_fund_goal_text');

function wf_archive_custom_fund_raised_percent_text() {
    return esc_html__( 'Fund Raised Percent', 'wp-fundraising' );
}
add_filter('wf_archive_fund_raised_percent_text', 'wf_archive_custom_fund_raised_percent_text');

function wf_archive_custom_fund_raised_text() {
    return esc_html__( 'Fund Raised', 'wp-fundraising' );
}
add_filter('wf_archive_fund_raised_text', 'wf_archive_custom_fund_raised_text');

function wf_archive_custom_days_remaining_text() {
    if (wf_date_remaining()) {
        return esc_html__( 'Days to go', 'wp-fundraising' );
    }else{
        return  esc_html__('');
    }
}
add_filter('wf_archive_days_remaining_text', 'wf_archive_custom_days_remaining_text');


// Login Signup Filters

function wf_custom_login_signup_modal_class() {
    return 'bd-example-modal-lg';
}
add_filter('wf_login_signup_modal_class', 'wf_custom_login_signup_modal_class');

function wf_custom_login_label() {
    return esc_html__( 'Log In', 'wp-fundraising' );
}
add_filter('wf_login_label', 'wf_custom_login_label');

function wf_custom_login_button_text() {
    return esc_html__( 'Log In', 'wp-fundraising' );
}
add_filter('wf_login_button_text', 'wf_custom_login_button_text');

function wf_custom_signup_label() {
    return esc_html__( 'Log In', 'wp-fundraising' );
}
add_filter('wf_signup_label', 'wf_custom_signup_label');

function wf_custom_signup_button_text() {
    return esc_html__( 'Sign Up', 'wp-fundraising' );
}
add_filter('wf_signup_button_text', 'wf_custom_signup_button_text');


// Dashboard Filter

function wf_custom_add_new_campaign_text(){
    return esc_html__( 'Add New Campaign', 'wp-fundraising' );
}
add_filter('wf_signup_button_text', 'wf_custom_add_new_campaign_text');

function wf_custom_donate_modal_heading()
{
    return sprintf(
        '<div class="xs-heading xs-mb-30">
                    <h2 class="xs-title">%1s</h2>
                    <p class="small">%2s "<span class="color-green">%3s</span>" %4s<span class="color-green">%5s</span>.</p>
                    <span class="xs-separetor v2"></span>
                </div>' ,
        esc_html__('Make a donation', 'wp-fundraising'),
        esc_html__('To learn more about make donate charity with us visit our', 'wp-fundraising'),
        esc_html__('Contact us', 'wp-fundraising'),
        esc_html__('site. By calling ', 'wp-fundraising'),
        esc_html__('+44(0) 800 883 8450 ', 'wp-fundraising')
    );
}
add_filter('wf_donate_modal_heading', 'wf_custom_donate_modal_heading');

function wf_custom_donate_now_button_text(){
    return esc_html__( 'Add New Campaign', 'wp-fundraising' );
}
add_filter('wf_donate_now_button_text', 'wf_custom_donate_now_button_text');
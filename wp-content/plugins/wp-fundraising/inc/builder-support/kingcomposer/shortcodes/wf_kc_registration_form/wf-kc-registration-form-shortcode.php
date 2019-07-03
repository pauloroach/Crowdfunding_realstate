<?php

add_action('init', 'wf_kc_registration_form_shortcode_init', 99 );
 
function wf_kc_registration_form_shortcode_init(){
 
    global $kc;
    $kc->add_map(
        array(
            'wf_kc_registration_form' => array(
                'name' => 'WF Login/Registration Form',
                'icon' => 'fa-ellipsis-h',
                'css_box' => true,
                'category' => 'WP Fundraising',
            )
        )
    );
} 

// Register Before After Shortcode
function wf_kc_registration_form_shortcode( $atts, $content ){

    ob_start();
    echo do_shortcode('[wp_fundraising_registration_form]');
    $output = ob_get_clean();
    return $output;

}


add_shortcode('wf_kc_registration_form', 'wf_kc_registration_form_shortcode');

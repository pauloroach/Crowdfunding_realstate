<?php

if (!function_exists('wf_vc_campaign_submit_form')) {

    function wf_vc_campaign_submit_form($atts, $content = null)
    {
        echo do_shortcode('[wp_fundraising_form ]');
        $output = ob_get_clean(); 
        return $output;  

    }
}
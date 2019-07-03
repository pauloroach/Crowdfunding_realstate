<?php

if (!function_exists('wf_vc_donate_form')) {

    function wf_vc_donate_form($atts, $content = null)
    {
        echo do_shortcode('[wp_fundraising_donate_form ]');
        $output = ob_get_clean(); 
        return $output;  
        
    }
}
<?php

if (!function_exists('wf_vc_dashboard')) {

    function wf_vc_dashboard($atts, $content = null)
    {
        echo do_shortcode('[wp_fundraising_dashboard ]');
        $output = ob_get_clean(); 
        return $output;  
        
    }
}
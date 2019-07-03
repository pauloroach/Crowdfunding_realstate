<?php

if (!function_exists('wf_vc_donate_btn')) {

    function wf_vc_donate_btn($atts, $content = null)
    {
        echo do_shortcode('[wp_fundraising_donate_btn ]');
        $output = ob_get_clean(); 
        return $output;  
        
    }
}
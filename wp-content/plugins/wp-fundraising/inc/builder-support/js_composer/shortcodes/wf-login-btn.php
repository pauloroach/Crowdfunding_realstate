<?php

if (!function_exists('wf_vc_login_btn')) {

    function wf_vc_login_btn($atts, $content = null)
    {
        echo do_shortcode('[wp_fundraising_login_btn ]');
        $output = ob_get_clean(); 
        return $output;  
        
    }
}
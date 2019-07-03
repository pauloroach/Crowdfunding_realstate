<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'wf_register_hooks' ) ) {

    /**
     * Helper function for registering hooks
     *
     * @param array $hooks_callbacks
     * @param string $hook_name
     */
    function wf_register_hooks( $hooks, $type ) {

        // allow filtering the array with registered filters / actions
        if ( $type == 'filter' ) {
            $hooks = apply_filters( 'wf_filters', $hooks );
        } else if ( $type == 'action' ) {
            $hooks = apply_filters( 'wf_actions', $hooks );
        }

        foreach ( $hooks as $hook_name => $params ) {

            foreach ( $params as $callback => $val ) {

                if ( is_array( $val ) ) {

                    if ( count( $val ) == 2 ) {

                        $priority = $val[0];
                        $args = $val[1];
                    } else if ( count( $val ) == 1 ) {
                        $priority = $val[0];
                        $args = 1;
                    }

                    if ( $type == 'action' ) {

                        add_action( $hook_name, $callback, $priority, $args );
                    } else if ( $type == 'filter' ) {
                        add_filter( $hook_name, $callback, $priority, $args );
                    }
                } else {
                    if ( $type == 'action' ) {
                        add_action( $hook_name, $val );
                    } else if ( $type == 'filter' ) {
                        add_filter( $hook_name, $val );
                    }
                }
            }
        }

        // additional hook to allow changes after filters / actions are registered
        if ( $type == 'filter' ) {
            do_action( 'wf_after_filters_setup' );
        } else if ( $type == 'action' ) {
            do_action( 'wf_after_actions_setup' );
        }

    }

}


/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
if ( !function_exists( 'wf_get_option' ) ) {
    function wf_get_option($option, $section, $default = '')
    {

        $options = get_option($section);

        if (isset($options[$option])) {
            return $options[$option];
        }

        return $default;
    }
}


if (! function_exists('wf_get_published_pages')) {
    function wf_get_published_pages(){

        $page_array = array();
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'child_of' => 0,
            'parent' => -1,
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );

        $pages = get_pages($args);

        if (count($pages)>0) {
            foreach ($pages as $page) {
                $page_array[$page->ID] = $page->post_title;
            }
        }
        return $page_array;
    }
}


if (!function_exists('wp_fundraising_output_evaluated_charities')) {
    function wp_fundraising_evaluated_charities()
    {
        $user_id = get_current_user_id();
        $query_args = array(
            'post_type'   => 'product',
            'author'      => $user_id,
            'tax_query'   => array(
                array(
                    'taxonomy'  => 'product_type',
                    'field'     => 'slug',
                    'terms'     => 'wf_donation',
                ),
            ),
            'posts_per_page' => -1
        );
        $campaigns = array();
        query_posts($query_args);
        if (have_posts()):
            while (have_posts()) : the_post();
                $campaigns[get_the_ID()] = get_the_title();
            endwhile;
        endif;

        wp_reset_query();
        return $campaigns;
    }
}




if ( !function_exists( 'wf_enqueue_js_prefix' ) ) {

    /**
     * Prefix each javascript file url with url to the theme root directory
     *
     * @param string $url
     * @return string
     */
    function wf_enqueue_js_prefix( $url ) {

        if ( !filter_var( $url, FILTER_VALIDATE_URL ) ) {
            $js_dir = WP_FUNDRAISING_DIR_PATH . '/';

            if ( is_array( $url ) ) {
                $url[0] = $js_dir . $url[0];
            } else {
                $url = $js_dir . $url;
            }
        }

        return $url;
    }

}

if ( !function_exists( 'wf_enqueue_css_prefix' ) ) {

    /**
     * Prefix each css file url with url to the theme root directory
     *
     * @param string $url
     * @return string
     */
    function wf_enqueue_css_prefix( $url ) {

        if ( !filter_var( $url, FILTER_VALIDATE_URL ) ) {
            $css_dir = WP_FUNDRAISING_DIR_PATH . '/';

            if ( is_array( $url ) ) {
                $url[0] = $css_dir . $url[0];
            } else {
                $url = $css_dir . $url;
            }
        }

        return $url;
    }

}
if ( !function_exists( 'wf_wc_version_check' ) ) {
    function wf_wc_version_check($version = '3.0')
    {
        if (class_exists('WooCommerce')) {
            global $woocommerce;
            if (version_compare($woocommerce->version, $version, ">=")) {
                return true;
            }
        }
        return false;
    }
}

if ( !function_exists( 'wf_get_template_part' ) ) {
    function wf_get_template_part($slug, $name = null, $load = true)
    {
        // Execute code for this part
        do_action('get_template_part_' . $slug, $slug, $name);

        // Setup possible parts
        $templates = array();
        if (isset($name))
            $templates[] = $slug . '-' . $name . '.php';
        $templates[] = $slug . '.php';

        // Allow template parts to be filtered
        $templates = apply_filters('wf_get_template_part', $templates, $slug, $name);

        // Return the part that is found
        return wf_locate_template($templates, $load, false);
    }
}
if ( !function_exists( 'wf_locate_template' ) ) {
    function wf_locate_template($template_names, $load = false, $require_once = true)
    {
        // No file found yet
        $located = false;

        // Try to find a template file
        foreach ((array)$template_names as $template_name) {

            // Continue if template is empty
            if (empty($template_name))
                continue;

            // Trim off any slashes from the template name
            $template_name = ltrim($template_name, '/');

            // Check child theme first
            if (file_exists(trailingslashit(get_stylesheet_directory()) . 'wftemplate/' . $template_name)) {
                $located = trailingslashit(get_stylesheet_directory()) . 'wftemplate/' . $template_name;
                break;

                // Check parent theme next
            } elseif (file_exists(trailingslashit(get_template_directory()) . 'wftemplate/' . $template_name)) {
                $located = trailingslashit(get_template_directory()) . 'wftemplate/' . $template_name;
                break;

                // Check theme compatibility last
            } elseif (file_exists(trailingslashit(WP_FUNDRAISING_DIR_PATH . '/templates') . $template_name)) {
                $located = trailingslashit(WP_FUNDRAISING_DIR_PATH . '/templates') . $template_name;
                break;
            }
        }

        if ((true == $load) && !empty($located))
            load_template($located, $require_once);

        return $located;
    }
}

/**
 * Remove billing address from the checkout page
 */
if ( !function_exists( 'wf_override_checkout_fields' ) ) {
    function wf_override_checkout_fields($fields)
    {

        global $woocommerce;
        $fundraising_found = '';
        $items = $woocommerce->cart->get_cart();
        if ($items) {
            foreach ($items as $item => $values) {
                $product = wc_get_product($values['product_id']);
                if (($product->get_type() == 'wp_fundraising') || ($product->get_type() == 'wf_donation') ) {
                    if (wf_get_option('_wf_hide_address_from_checkout', 'wf_advanced') == 'on') {

                        unset($fields['billing']['billing_company']);
                        unset($fields['billing']['billing_address_1']);
                        unset($fields['billing']['billing_address_2']);
                        unset($fields['billing']['billing_postcode']);
                        unset($fields['billing']['billing_state']);
                        unset($fields['order']['order_comments']);
                        unset($fields['billing']['billing_address_2']);
                        unset($fields['billing']['billing_postcode']);
                        unset($fields['billing']['billing_company']);

                    }
                }
            }
        }
        return $fields;
    }
}

function get_wp_fundraising_product_cats(){
    $cats = array();
    $query_args = array(
        'post_type'     => 'product',
        'tax_query'     => array(
            'relation'  => 'OR',
            array(
                'taxonomy'  => 'product_type',
                'field'     => 'slug',
                'terms'     => 'wp_fundraising',
            ),
            array(
                'taxonomy'  => 'product_type',
                'field'     => 'slug',
                'terms'     => 'wf_donation',
            ),
        ),
        'posts_per_page' => -1,
    );
    //query_posts($query_args);
    $xs_cats = new WP_Query($query_args);
    while ($xs_cats->have_posts()) : $xs_cats->the_post();
        $id = get_the_ID();
        $categories = get_the_terms( $id, 'product_cat' );
        foreach($categories as $cat){

            if(!in_array($cat->name, $cats)){
                array_push($cats, $cat->name);
            }

        }

    endwhile;

    wp_reset_postdata();

    return $cats;
}
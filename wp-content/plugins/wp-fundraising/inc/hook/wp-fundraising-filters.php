<?php

/* ---------------------------------------------------------
 * Filters
 *
 * Class for registering filters
  ---------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit;
class WP_Fundraising_Filters
{

    static $hooks = array();

    /**
     * Initialize filters
     */
    static function init(){

        /**
         * Array of filter hooks
         *
         * When 'callback' value is empty (non-array) or any of values ommited,
         * default priority and accepted args will be used
         *
         * e.g.
         * priority = 10
         * accepted_args = 1
         */
        static::$hooks = array(
            // WORDPRESS FILTERS


            // WOOCOMMERCE FILTERS


            //Remove quantity and force item 1 cart per checkout if product is fundraising
            'template_include' => array(
                'WP_Fundraising_Filters::wf_include_template_function' => array(10, 2)
            ),
            'pre_get_posts' => array(
                'WP_Fundraising_Filters::wf_search_shortcode_filter' => array(10, 2),
                'WP_Fundraising_Filters::wf_campaign_search_shortcode_filter' => array(10, 2)
            ),
            'wc_get_template_part' => array(
                'WP_Fundraising_Filters::wf_get_template_part' => array(10, 3)
            ),
            'woocommerce_locate_template' => array(
                'WP_Fundraising_Filters::wf_wc_locate_template' => array(10, 3)
            ),
            'woocommerce_is_sold_individually' => array(
                'WP_Fundraising_Filters::wf_wc_remove_quantity_fields' => array(10, 2)
            ),
            // Removes 0’s on decimals if they end with .00
            'woocommerce_price_trim_zeros' => array(
                '__return_true' => array(10, 1)
            ),
        );

        // register filters
        wf_register_hooks(static::$hooks, 'filter');
    }

    static function wf_wc_remove_quantity_fields( $return, $product ) {
        if ($product->get_type() == 'wp_fundraising'){
            return true;
        }
    }


    // get path for templates used in loop ( like content-product.php )
    static function wf_get_template_part( $template, $slug, $name )
    {

        // Look in plugin/templates/slug-name.php or plugin/templates/slug.php
        if ( $name ) {
            $path = WP_FUNDRAISING_DIR_PATH . WC()->template_path() . "{$slug}-{$name}.php";
        } else {
            $path = WP_FUNDRAISING_DIR_PATH . WC()->template_path() . "{$slug}.php";
        }

        return file_exists( $path ) ? $path : $template;

    }


    // get path for all other templates.
    static function wf_wc_locate_template( $template, $template_name, $template_path )
    {

        $path = WP_FUNDRAISING_DIR_PATH . $template_path . $template_name;
        return file_exists( $path ) ? $path : $template;

    }

    static function wf_include_template_function( $template_path ) {

        if ( get_post_type() == 'product' ) {
            if ( is_single() ) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                if ( $theme_file = locate_template( array ( 'single-campaign.php' ) ) ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = WP_FUNDRAISING_DIR_PATH . 'templates/single-campaign.php';
                }
            }

            if ( is_archive() ) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                if ( $theme_file = locate_template( array ( 'archive-campaign.php' ) ) ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = WP_FUNDRAISING_DIR_PATH . 'templates/archive-campaign.php';
                }
            }
        }
        return $template_path;
    }

    static function wf_campaign_search_shortcode_filter($query){
        if (!empty($_GET['product_type'])) {
            $product_type = $_GET['product_type'];
            if ($product_type == 'wp_fundraising') {
                if ($query->is_search) {
                    $query->set('post_type', 'product');
                    $taxquery = array(
                        array(
                            'taxonomy' => 'product_type',
                            'field' => 'slug',
                            'terms' => 'wp_fundraising',
                        )
                    );
                    $query->set('tax_query', $taxquery);
                }
            }
        }
        return $query;
    }


    static function wf_search_shortcode_filter($query){
        if (!empty($_GET['product_type'])) {
            $product_type = $_GET['product_type'];
            if ($product_type == 'wf_donation') {
                if ($query->is_search) {
                    $query->set('post_type', 'product');
                    $taxquery = array(
                        array(
                            'taxonomy' => 'product_type',
                            'field' => 'slug',
                            'terms' => 'wf_donation',
                        )
                    );
                    $query->set('tax_query', $taxquery);
                }
            }
        }
        return $query;
    }


}

WP_Fundraising_Filters::init();
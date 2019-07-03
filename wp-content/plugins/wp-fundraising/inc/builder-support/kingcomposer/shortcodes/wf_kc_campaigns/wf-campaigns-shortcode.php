<?php

add_action('init', 'wf_campaigns_shortcode_init', 99 );
 
function wf_campaigns_shortcode_init(){
 
    global $kc;
    $kc->add_map(
        array(
            'wf_campaigns' => array(
                'name' => 'WF Campaigns',
                'icon' => 'fa-ellipsis-h',
                'css_box' => true,
                'category' => 'WP Fundraising',
                'params' => array(
                    array(
                        'name' => 'donation',
                        'label' => 'Campaign Type',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            'no' => esc_html__( "Select Campaign Type", "wp-fundraising" ),
                            'yes' => esc_html__( "Donation", "wp-fundraising" ),
                            'no' => esc_html__( "Crowdfunding", "wp-fundraising" ),
                        ),

                        'value' => 'no',
                    ),
                    array(
                        'name' => 'style',
                        'label' => 'Style',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            '1' => esc_html__( "Style 1", "wp-fundraising" ),
                            '2' => esc_html__( "Style 2", "wp-fundraising" ),
                            '3' => esc_html__( "Style 3", "wp-fundraising" ),
                            '4' => esc_html__( "Style 4", "wp-fundraising" ),
                        ),

                        'value' => '1',
                    ),
                    array(
                        'name' => 'number',
                        'label' => 'Post Count',
                        'type' => 'text',  // USAGE TEXT TYPE
                        'value' => '-1', // remove this if you do not need a default content
                    ),
                    array(
                        'name' => 'cat',
                        'label' => 'Category',
                        'type' => 'text',  // USAGE TEXT TYPE
                    ),
                    array(
                        'name' => 'col',
                        'label' => 'Number of columns',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            '2' => esc_html__( "2", "wp-fundraising" ),
                            '3' => esc_html__( "3", "wp-fundraising" ),
                            '4' => esc_html__( "4", "wp-fundraising" ),
                        ),

                        'value' => 'no',
                    ),
                    array(
                        'name' => 'author',
                        'label' => 'Show/Hide Author',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            'yes' => esc_html__( "Show", "wp-fundraising" ),
                            'no' => esc_html__( "Hide", "wp-fundraising" ),
                        ),

                        'value' => 'no',
                    ),
                    array(
                        'name' => 'filter',
                        'label' => 'Show/Hide Filter',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            'yes' => esc_html__( "Show", "wp-fundraising" ),
                            'no' => esc_html__( "Hide", "wp-fundraising" ),
                        ),

                        'value' => 'no',
                    ),
                    array(
                        'name' => 'status',
                        'label' => 'Status',
                        'type' => 'dropdown',  // USAGE SELECT TYPE
                        'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                            'all' => esc_html__( "All", "wp-fundraising" ),
                            'successful' => esc_html__( "Successful", "wp-fundraising" ),
                            'expired' => esc_html__( "Expired", "wp-fundraising" ),
                            'valid' => esc_html__( "Valid", "wp-fundraising" ),
                        ),

                        'value' => 'all',
                    ),
                )
            )
        )
    );
} 

// Register Before After Shortcode
function wf_campaigns_shortcode( $atts, $content ){
    extract( shortcode_atts( array(

        'cat'         => null,
        'number'      => -1,
        'col'      => '3',
        'style'      => '1',
        'filter'      => 'no',
        'donation'      => 'no',
        'author'      => 'yes',
        'show'      => '', // successful, expired, valid
        
    ), $atts) );

    ob_start();

    $xs_post_cat = $cat;
    $count_col = $col;
    $post_count = $number;
    $styles = $style . '"';
    $show_filter = $filter;
    $author = $author;
    $status = $show;
    $donation = $donation;

    ?>
    <div class="xs-wp-fundraising-listing-style-<?php echo esc_attr($styles);?>">
        <?php
        $style = ($styles == 4 ) ? $style = 1 : $style = $styles;
        echo do_shortcode('[wp_fundraising_listing cat="'.$xs_post_cat.'" number="' . $post_count . '" col="'.$count_col.'" style="'.$style.'" filter="'.$show_filter.'" "'.$author.'" donation="'.$donation.'" show="'.$status.'"]');
        ?>
    </div>
    <?php


    $output = ob_get_clean();
    return $output;

}


add_shortcode('wf_campaigns', 'wf_campaigns_shortcode');

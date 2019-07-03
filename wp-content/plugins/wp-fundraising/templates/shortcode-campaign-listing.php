<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function wp_fundraising_listing_shortcode($atts = array()){
    if( class_exists('WP_FundRaising') ){

        $args = shortcode_atts(array(
            'cat'         => '',
            'number'      => -1,
            'col'      => '3',
            'style'      => '1',
            'filter'      => 'no',
            'donation'      => 'no',
            'author'      => 'yes',
            'show'      => '', // successful, expired, valid
        ), $atts );

        if($args['donation'] == 'yes'):
            $c_type = 'wf_donation';
        else:
            $c_type = 'wp_fundraising';
        endif;
        $paged = 1;
        if (get_query_var('paged')){
            $paged = absint( get_query_var( 'paged' ) );
        }elseif (get_query_var('page')){
            $paged = absint( get_query_var( 'page' ) );
        }

        
        $categories = get_wp_fundraising_product_cats();
        ob_start();
        if($args['filter'] == 'yes'){ ?>

            <div class="<?php if($args['style'] !='3'){ echo 'xs-tab-wraper'; } ?> fundpress-tab-wraper">
            <?php if($args['style'] =='3'){ ?>
                <div class="fundpress-tab-nav-v3 xs-tab-nav wow fadeInUp" data-wow-duration="1.3s">
            <?php }else{ ?>
                <div class="fundpress-tab-nav xs-tab-nav">
            <?php } ?>

            <ul class="nav nav-tabs" role="tablist">
                <?php
                $i = 1;
                foreach($categories as $category) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($i==1) echo 'active';?>" href="#<?php echo sanitize_title($category); ?>" role="tab" data-toggle="tab"><?php echo $category; ?></a>
                    </li>
                    <?php $i++; } ?>
            </ul>
            </div>


            <?php

            $i = 1;
            ?><div class="tab-content"><?php
            foreach($categories as $category) { ?>
                <div role="tabpanel" class="tab-pane fade <?php if($i==1) echo 'in active show';?> " id="<?php echo sanitize_title($category); ?>">
                    <?php

                    $query_args = array(
                        'post_type'     => 'product',
                        'tax_query'     => array(
                            'relation'  => 'AND',
                            array(
                                'taxonomy'  => 'product_type',
                                'field'     => 'slug',
                                'terms'     => $c_type,
                            ),
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'name',
                                'terms'     => $category,
                            ),
                        ),
                        'posts_per_page' => $args['number'],
                        'paged' => $paged
                    );


                    if (!empty($_GET['author'])) {
                        $user_login     = sanitize_text_field( trim( $_GET['author'] ) );
                        $user           = get_user_by( 'login', $user_login );
                        if ($user) {
                            $user_id    = $user->ID;
                            $query_args = array(
                                'post_type'   => 'product',
                                'author'      => $user_id,
                                'tax_query'   => array(
                                    array(
                                        'taxonomy'  => 'product_type',
                                        'field'     => 'slug',
                                        'terms'     => $c_type,
                                    ),
                                ),
                                'posts_per_page' => -1
                            );
                        }
                    }

                    //query_posts($query_args);
                    $xs_post = new WP_Query($query_args);
                    if ($xs_post->have_posts()): 

                    ?>
                    <?php if($args['style'] == '4'){ ?>
                        <div class="row cause-card-v2 waypoint-tigger wp-fundraising-campains"> 
                    <?php }else{ ?>
                        <div class="row waypoint-tigger wp-fundraising-campains">
                    <?php } ?>
                            <?php while ($xs_post->have_posts()) : $xs_post->the_post();
                                if($args['show'] == 'successful'):
                                    if(is_reach_target_goal()):
                                        include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                                    endif;
                                elseif($args['show'] == 'expired'):
                                    if(wf_date_remaining() == false):
                                        include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                                    endif;
                                elseif($args['show'] == 'valid'):
                                    if(is_campaign_valid()):
                                        include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                                    endif;
                                else:
                                    include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                                endif;
                            endwhile; ?>
                        </div>
                    <?php
                    wp_reset_postdata();
                    else:
                        include WP_FUNDRAISING_DIR_PATH.'templates/loop/no-campaigns-found.php';
                    endif;
                    ?>
                </div>
                <?php $i++; }

            ?></div><?php
        }else{
            if ($args['cat']) {
                $cat_array = explode(',', $args['cat']);
                $query_args = array(
                'post_type'     => 'product',
                'tax_query'     => array(
                    'relation'  => 'AND',
                    array(
                        'taxonomy'  => 'product_type',
                        'field'     => 'slug',
                        'terms'     => $c_type,
                    ),
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' =>  $cat_array,
                    )
                ),
                'posts_per_page' => $args['number'],
                'paged' => $paged
            );
            }else{
                $query_args = array(
                    'post_type'     => 'product',
                    'tax_query'     => array(
                        'relation'  => 'AND',
                        array(
                            'taxonomy'  => 'product_type',
                            'field'     => 'slug',
                            'terms'     => $c_type,
                        ),
                    ),
                    'posts_per_page' => $args['number'],
                    'paged' => $paged
                );
            }


            if (!empty($_GET['author'])) {
                $user_login     = sanitize_text_field( trim( $_GET['author'] ) );
                $user           = get_user_by( 'login', $user_login );
                if ($user) {
                    $user_id    = $user->ID;
                    $query_args = array(
                        'post_type'   => 'product',
                        'author'      => $user_id,
                        'tax_query'   => array(
                            array(
                                'taxonomy'  => 'product_type',
                                'field'     => 'slug',
                                'terms'     => $c_type,
                            ),
                        ),
                        'posts_per_page' => -1
                    );
                }
            }
            //query_posts($query_args);
            $xs_posts = new WP_Query($query_args);
            if ($xs_posts->have_posts()): ?>
                <?php if($args['style'] == '4'){ ?>
                        <div class="row cause-card-v2 waypoint-tigger wp-fundraising-campains"> 
                    <?php }else{ ?>
                        <div class="row waypoint-tigger wp-fundraising-campains">
                    <?php } ?>
                    <?php while ($xs_posts->have_posts()) : $xs_posts->the_post();
                        if($args['show'] == 'successful'):
                            if(is_reach_target_goal()):
                                include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                            endif;
                        elseif($args['show'] == 'expired'):
                            if(wf_date_remaining() == false):
                                include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                            endif;
                        elseif($args['show'] == 'valid'):
                            if(is_campaign_valid()):
                                include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                            endif;
                        else:
                            include WP_FUNDRAISING_DIR_PATH.'templates/content-campaign-listing.php';
                        endif;
                    endwhile; ?>
                </div>
            <?php
            else:
                include WP_FUNDRAISING_DIR_PATH.'templates/loop/no-campaigns-found.php';
            endif;

        }

        $html = ob_get_clean();
        wp_reset_postdata();
        return $html;
    }
}
add_shortcode( 'wp_fundraising_listing', 'wp_fundraising_listing_shortcode');
<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$paged = 1;
if (get_query_var('paged')) {
    $paged = absint(get_query_var('paged'));
} elseif (get_query_var('page')) {
    $paged = absint(get_query_var('page'));
}
global $post;
$query_args = array(
    'post_type' => 'product',
    'post__not_in' => array(get_the_ID()),
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'product_type',
            'field' => 'slug',
            'terms' => 'wp_fundraising',
        ),
    ),
    'posts_per_page' => 3,
    'paged' => $paged
);

ob_start();

query_posts($query_args);
if (have_posts()): ?> 
    <section class="waypoint-tigger xs-gray-bg xs-section-padding">
        <div class="container">
            <div class="xs-section-heading row xs-margin-0">
                <div class="fundpress-heading-title xs-padding-0 col-xl-9 col-md-9">
                    <?php echo wf_single_related_campaign_title();?>
                    <?php echo wf_single_related_campaign_description();?>
                </div>
            </div>
            <div class="row">
                <?php while (have_posts()) : the_post();

                    $funding_goal   = wf_get_total_goal_by_campaign(get_the_ID());
                    $fund_raised_percent   = wf_get_fund_raised_percent(get_the_ID());
                    $image_link = wp_get_attachment_url(get_post_thumbnail_id());

                    $raised = 0;
                    $total_raised = wf_get_total_fund_raised_by_campaign(get_the_ID());

                    if ($total_raised){
                        $raised = $total_raised;
                    }

                    //Get order sales value by product

                    $days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
                    if (wf_date_remaining(get_the_ID())){
                        $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining(get_the_ID()), 'wp-fundraising'));
                    }



                    ?>
                    <div class="col-lg-4">
                        <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                            <div class="fundpress-item-header">
                                <img src="<?php echo $image_link; ?>" alt="">
                                <div class="xs-item-header-content">
                                    <div class="xs-skill-bar">
                                        <div class="xs-skill-track">
                                            <p><span class="number-percentage-count number-percentage" data-value="<?php echo $fund_raised_percent; ?>" data-animation-duration="3500">0</span>%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fundpress-item-content xs-content-padding bg-color-white">
                                <?php
                                $categories = get_the_terms( get_the_ID(), 'product_cat' );
                                ?>
                                <ul class="xs-simple-tag fundpress-simple-tag">
                                    <?php
                                    foreach($categories as $category){
                                        ?><li><a href="<?php echo get_category_link($category->term_id);?>"><?php echo $category->name; ?></a></li><?php
                                    }
                                    ?>
                                </ul>
                                <a href="<?php the_permalink();?>" class="d-block color-navy-blue fundpress-post-title"><?php the_title();?></a>
                                <ul class="xs-list-with-content fundpress-list-item-content">
                                    <?php if ($funding_goal) { ?>
                                        <li><?php echo wc_price($funding_goal); ?><span><?php echo wf_archive_fund_goal_text(); ?></span></li>
                                    <?php } ?>

                                    <?php if ($raised) { ?>
                                        <li><span class="number-percentage-count"><?php echo wc_price($raised); ?></span><span><?php echo wf_archive_fund_raised_text(); ?></span></li>
                                    <?php } ?>

                                    <?php if ($days_remaining) { ?>
                                        <li><?php echo $days_remaining; ?><span><?php echo wf_archive_days_remaining_text(); ?></span></li>
                                    <?php } ?>
                                </ul>
                                <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                                <div class="row xs-margin-0">
                                    <div class="full-round fundpress-avatar">
                                        <?php echo get_avatar( get_the_author_meta( get_the_ID() ), 100 ); ?>
                                    </div>
                                    <div class="xs-avatar-title">
                                        <a href="#"><span>By</span><?php the_author(); ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php
endif;


$html = ob_get_clean();
wp_reset_query();
echo $html;
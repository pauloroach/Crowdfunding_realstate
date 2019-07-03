<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<?php


$funding_goal   = wf_get_total_goal_by_campaign(get_the_ID());
$raised_percent   = wf_get_fund_raised_percent(get_the_ID());
$fund_raised_percent   = wf_get_fund_raised_percentFormat(get_the_ID());
$image_link = wp_get_attachment_url(get_post_thumbnail_id());
$backers_count = wf_backers_count(get_the_ID());
$wp_country  = get_post_meta( get_the_ID(), '_wf_country', true);
$total_sales    = get_post_meta( get_the_ID(), 'total_sales', true );
$enddate        = get_post_meta( get_the_ID(), '_wf_duration_end', true );
$show_end_date = wf_get_option('_wf_hide_campaign_expiry_from_listing', 'wf_basics');

$short_description = apply_filters( 'woocommerce_short_description', get_the_excerpt() );

//Get Country name from WooCommerce

$countries_obj  = new WC_Countries();
$countries      = $countries_obj->__get('countries');

$country_name = '';
if ($wp_country){
    $country_name = $countries[$wp_country];
}

$raised = 0;
$total_raised = wf_get_total_fund_raised_by_campaign(get_the_ID());

if ($total_raised){
    $raised = $total_raised;
}

//Get order sales value by product
$sales_value_by_product = 0;

$days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
if (wf_date_remaining(get_the_ID())){
    $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining(get_the_ID()), 'wp-fundraising'));
}
$cols = $args['col'];
$grid = 12/$cols;

?>
<div class="used-for-colors col-lg-<?php echo $grid;?> col-md-6 col-sm-6">
    <?php if($args['style'] == "1"){ ?>
        <div class="fundpress-grid-item-content">
            <div class="fundpress-item-header xs-mb-30">
                <a href="<?php the_permalink();?>"><img src="<?php echo $image_link; ?>" alt=""></a>
                <div class="xs-item-header-content">
                    <div class="xs-skill-bar-v3" data-percent="<?php echo $fund_raised_percent; ?>">
                        <div class="xs-skill-track">
                            <p><?php echo $fund_raised_percent; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fundpress-item-content">
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

                    <?php if ($show_end_date == 'off') { ?>
                        <?php if ($days_remaining) { ?>
                            <li><?php echo $days_remaining; ?><span><?php echo wf_archive_days_remaining_text(); ?></span></li>
                        <?php } ?>
                    <?php } ?>
                </ul>

                <?php if($args['author'] == 'yes'){ ?>
                    <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor xs-mb-20 xs-mt-30"></span>
                    <div class="row xs-margin-0">
                        <div class="full-round fundpress-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 );?>
                        </div>
                        <div class="xs-avatar-title">
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><span><?php esc_html_e('By', 'wp-fundraising'); ?></span><?php echo get_the_author(); ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    <?php }elseif($args['style'] == "2"){ ?>
        <div class="fundpress-grid-item-content-v2 xs-mb-30 wow fadeInUp" data-wow-duration="1.2s">
            <div class="fundpress-item-header">
                <a href="<?php the_permalink();?>"><img src="<?php echo $image_link; ?>" alt=""></a>
                <div class="xs-item-header-content">
                    <span class="badge badge-sm badge-v1 badge-pill badge-primary"><?php echo wc_price($funding_goal); ?></span>
                </div>
            </div>

            <div class="fundpress-item-content text-center border border-top-0">
                <?php if($args['author'] == 'yes'){ ?>
                    <div class="row xs-margin-0 justify-content-center xs-mb-20">

                        <?php
                        $user = wp_get_current_user();

                        if ( $user ) :
                            ?>
                            <div class="full-round fundpress-avatar">
                                <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" />
                            </div>
                        <?php endif; ?>
                        <div class="xs-avatar-title">
                            <a href="<?php echo get_the_author_link();?>"><span><?php esc_html_e('By', 'wp-fundraising'); ?></span><?php echo get_the_author(); ?></a>
                        </div>
                    </div>
                <?php } ?>
                <a href="<?php the_permalink();?>" class="d-block color-navy-blue fundpress-post-title"><?php the_title();?></a>
                <p><?php echo $short_description; ?></p>

                <span class="xs-separetor"></span>

                <ul class="xs-list-with-content fundpress-list-item-content-v2">
                    <li class="xs-pie-chart-v2" data-percent="<?php echo $raised_percent; ?>">
                        <div class="icon-position-center">
                            <div class="xs-pie-chart-percent"></div>
                            <span>%</span>
                        </div>
                    </li>
                    <li><?php echo $backers_count; ?><span><?php echo wf_archive_backers_count_text(); ?></span></li>
                    <li><span><?php echo wc_price($raised); ?></span> <span><?php echo wf_archive_fund_raised_percent_text(); ?></span></li>
                </ul>
            </div>
        </div>

    <?php }elseif($args['style'] == "3"){ ?>
        <div class="fundpress-grid-item-content-v2">
            <div class="fundpress-item-header">
                <a href="<?php the_permalink();?>"><img src="<?php echo $image_link; ?>" alt=""></a>
            </div>

            <div class="fundpress-item-content text-center">
                <?php if($args['author'] == 'yes'){ ?>
                    <div class="row xs-margin-0 justify-content-center xs-mb-20">

                        <?php
                        $user = wp_get_current_user();

                        if ( $user ) :
                            ?>
                            <div class="full-round fundpress-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 );?>
                            </div>
                        <?php endif; ?>
                        <div class="xs-avatar-title">
                            <a href="<?php echo get_the_author_link();?>"><span><?php esc_html_e('By', 'wp-fundraising'); ?></span><?php echo get_the_author(); ?></a>
                        </div>
                    </div>
                <?php } ?>
                <a href="<?php the_permalink();?>" class="d-block color-navy-blue fundpress-post-title"><?php the_title();?></a>
                <p><?php echo $short_description; ?></p>

                <span class="xs-separetor"></span>

                <div class="fundpress-list-cat">
                    <span><i class="icon icon-man"></i><?php echo $backers_count; ?> <?php echo wf_archive_backers_count_text(); ?></span>
                    <span><i class="icon icon-favorites"></i><?php echo $fund_raised_percent; ?> <?php echo wf_archive_fund_raised_percent_text(); ?></span>
                    <span class="badge badge-v2 badge-pill badge-primary"><?php echo wc_price($funding_goal); ?></span>
                </div>
            </div>
        </div>

    <?php }else{ ?> 
        <div class="xs-popular-item">
            <div class="xs-item-header">
                <img src="<?php echo $image_link; ?>" alt="img">
            </div>
            <div class="xs-item-content">
                <?php
                $categories = get_the_terms( get_the_ID(), 'product_cat' );
                ?>
                <ul class="xs-simple-tag">
                    <?php
                    foreach($categories as $category){
                        ?><li><a href="<?php echo get_category_link($category->term_id);?>"><?php echo $category->name; ?></a></li><?php
                    }
                    ?>
                </ul>
                <a href="<?php the_permalink();?>" class="xs-post-title"><?php the_title();?></a>
                <ul class="xs-list-with-content">
                    <li><strong><i class="icon-consult"></i><?php esc_html_e('Goal:','wp-fundraising');?></strong><span><?php echo wc_price($funding_goal); ?></span></li>
                    <li><strong><i class="icon-chart22"></i><?php esc_html_e('Raised:','wp-fundraising');?></strong><span><?php echo wc_price($raised); ?></span></li>
                </ul>
                <div class="xs-skill-bar">
                    <div class="xs-skill-track">
                        <p><span class="number-percentage-count number-percentage" data-value="<?php echo $raised_percent; ?>" data-animation-duration="3500">0</span>%</p>
                    </div>
                </div>
                <?php if($args['author'] == 'yes'){ ?>
                    <div class="media">
                    <?php
                        $user = wp_get_current_user();

                        if ( $user ) : ?>
                        
                        <div class="xs-round-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 );?>
                        </div>
                        <div class="xs-avatar-title">
                            <a href="<?php echo get_the_author_link();?>"><?php echo get_the_author(); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
                
    <?php } ?>

</div>
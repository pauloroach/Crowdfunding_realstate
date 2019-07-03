<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$args = array(
    'post_type' 		=> 'product',
    'post_status'		=> array('publish'),
    'author'    		=> get_current_user_id(),
    'tax_query' 		=> array(
        array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'wp_fundraising',
        ),
    ),
    'posts_per_page'    => 4,
);

$current_page = get_permalink();

?><div class="tab-pane slideUp active show" id="campaign" role="tabpanel"><?php
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
    global $post;
    $i = 1;
    while ( $the_query->have_posts() ) : $the_query->the_post();



        $funding_goal   = wf_get_total_goal_by_campaign(get_the_ID());
        $raised_percent   = wf_get_fund_raised_percent(get_the_ID());
        $fund_raised_percent   = wf_get_fund_raised_percentFormat(get_the_ID());
        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
        $total_sales    = get_post_meta( get_the_ID(), 'total_sales', true );
        $enddate        = get_post_meta( get_the_ID(), '_wf_duration_end', true );

        $total_raised = wf_get_total_fund_raised_by_campaign(get_the_ID());
        if($total_raised == null){
            $total_raised = 0;
        }
        $days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
        if (wf_date_remaining(get_the_ID())){
            $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining(get_the_ID()), 'wp-fundraising'));
        }
        ?>
        <div class="xs-campaign-info-card">
            <div class="xs-dashboard-header">
                <h3 class="dashboard-title"><?php echo get_the_title(); ?> <span><?php esc_html_e('by','wp-fundraising');?> <?php echo get_the_author();?></span></h3>
                <div class="xs-btn-wraper">
                    <a target="_blank" href="<?php echo home_url('/')?>wf-campaign-form/?action=edit&campaign_id=<?php the_ID();?>" class="btn btn-outline-success"><?php esc_html_e('Edit','wp-fundraising');?></a>
                    <a href="<?php the_permalink();?>" class="btn btn-outline-success"><?php esc_html_e('View','wp-fundraising');?></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="xs-pie-chart-v3" data-percent="<?php echo $raised_percent; ?>">
                        <div class="pie-chart-info">
                            <div class="xs-pie-chart-percent"></div>
                            <span>%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo wc_price($total_raised); ?></h5>
                        <h6><?php echo wf_dashboard_fund_raised_text(); ?></h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card card-primary">
                        <h5><?php echo wc_price($funding_goal); ?></h5>
                        <h6><?php echo wf_dashboard_fund_goal_text(); ?></h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo $days_remaining; ?></h5>
                        <h6><?php echo wf_dashboard_days_remaining_text(); ?></h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
else :
    ?><p> <?php esc_html_e( 'Sorry, no Campaign Found.','wp-fundraising' ); ?></p>
<?php endif; ?>

</div>
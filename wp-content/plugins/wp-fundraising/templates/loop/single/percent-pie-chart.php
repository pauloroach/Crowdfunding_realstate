<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $post;
$percent = wf_get_fund_raised_percent($post->ID);
?>
<div class="xs-single-sidebar xs-mb-20">
    <div class="xs-pie-chart-wraper fundpress-pie-chart-wraper">
        <div class="xs-pie-chart" data-percent="<?php echo $percent; ?>">
            <div class="xs-pie-chart-percent-wraper icon-position-center bold color-navy-blue xs-spilit-container">
                <div class="xs-pie-chart-percent"></div>
                <span>%</span>
            </div>
        </div>
        <div class="xs-pie-chart-label"><?php echo wf_single_fund_raised_percent_text(); ?></div>
    </div>
</div>
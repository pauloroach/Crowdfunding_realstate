<?php
$event_date = '';
if(defined('FW')){
    $event_date = fw_get_db_post_option( get_the_ID(), 'event_date' );
}
?>
<div class="fundpress-single-event-wraper row">
    <div class="col-md-3">
        <?php if(has_post_thumbnail()): ?>
            <?php
            $thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), '' );
            $img		 = xs_resize( $thumbnail[ 0 ], 243, 150 );
            ?>
            <div  class="fundpress-event-image">
               <a href="<?php echo esc_url(get_the_permalink()); ?>"> <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-6 fundpress-event-details">
        <a href="<?php echo esc_url(get_the_permalink()); ?>"><h3 class="color-white xs-post-title fundpress-post-title"><?php echo get_the_title(); ?></h3></a>
        <p><?php echo wp_kses_post(wp_trim_words(get_the_content(),19,'')) ?></p>
        <?php if(!empty($event_date)): ?>
            <div class="countdown-container xs-countdown-timer" data-countdown="<?php echo esc_attr($event_date); ?>"></div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <div class="fundpress-btn-wraper">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="xs-btn round-btn green-btn"><?php echo esc_html__('View Event','crowdmerc') ?></a>
        </div>
    </div>
</div>
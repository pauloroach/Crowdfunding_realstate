<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/header/content', 'page-header' ) ?>

<?php while ( have_posts() ) : the_post(); ?>
    <?php
    $event_organization = '';
    $event_date = '';
    $event_venue = '';
    $event_phone = '';
    $event_email = '';
    $event_map = '';
    $event_contact = '';
    $event_desc = '';
    $event_facilities = '';
    $event_latitude = '';
    $event_longitude = '';

    if ( defined( 'FW' ) ) {
        $event_organization = fw_get_db_post_option( get_the_ID(), 'event_organization' );
        $speaker = fw_get_db_post_option( get_the_ID(), 'speaker' );
        $event_date = strtotime (fw_get_db_post_option( get_the_ID(), 'event_date' ));
        $event_date_main = fw_get_db_post_option( get_the_ID(), 'event_date' );
        $event_time = fw_get_db_post_option( get_the_ID(), 'event_time' );
        $event_venue = fw_get_db_post_option( get_the_ID(), 'event_venue' );
        $event_phone = fw_get_db_post_option( get_the_ID(), 'event_phone' );
        $event_email = fw_get_db_post_option( get_the_ID(), 'event_email' );
        $event_map = fw_get_db_post_option( get_the_ID(), 'event_map' );
        $event_contact = fw_get_db_post_option( get_the_ID(), 'event_contact' );
        $event_sponsor = fw_get_db_post_option( get_the_ID(), 'event_sponsor' );
        $event_desc	= fw_get_db_post_option( get_the_ID(), 'event_desc' );
        $event_facilities = fw_get_db_post_option( get_the_ID(), 'event_facilities' );
        $event_latitude = fw_get_db_post_option( get_the_ID(), 'latitude' );
        $event_longitude = fw_get_db_post_option( get_the_ID(), 'longitude' );
    }

    ?>
    <main class="xs-all-content-wrapper">
    <div class="xs-content-section-padding xs-event-single" role="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-8 xs-event-wraper">
                            <?php if(has_post_thumbnail()): ?>
                                <?php
                                $thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), '' );
                                $img		 = xs_resize( $thumbnail[ 0 ], 730, 399 );
                                ?>
                                <div class="xs-event-banner">
                                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="xs-event-content">
                                <h4><?php echo esc_html__('Event Detalis','crowdmerc'); ?></h4>
                                <p><?php echo get_the_content(); ?></p>
                            </div>
                            <div class="xs-horizontal-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#facilities" role="tab"><?php echo esc_html__('Facilities','crowdmerc') ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#mapLocation" role="tab"><?php echo esc_html__('Map Location','crowdmerc') ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#contactUs" role="tab"><?php echo esc_html__('Contact us','crowdmerc') ?></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="facilities" role="tabpanel">
                                        <?php if(!empty($event_desc)):  ?>
                                            <p><?php echo esc_html($event_desc); ?></p>
                                        <?php endif; ?>

                                        <?php if(!empty($event_facilities) && is_array($event_facilities)):?>
                                            <ul class="xs-unorder-list circle green-icon">
                                                <?php foreach( $event_facilities as $facilities ):?>
                                                    <li><?php echo esc_html($facilities['title']); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tab-pane fade" id="mapLocation" role="tabpanel">
                                       <div id="xs-maps" class="xs-event-map" data-latitude="<?php echo esc_attr($event_latitude); ?>" data-longitude="<?php echo esc_attr($event_longitude); ?>"></div>
                                    </div>
                                    <div class="tab-pane fade" id="contactUs" role="tabpanel">
                                        <?php if(!empty($event_contact)): ?>
                                            <?php echo do_shortcode($event_contact); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-4">
                                <div class="xs-event-schedule-widget">
                                    <div class="media xs-event-schedule">
                                        <div class="d-flex xs-evnet-meta-date">
                                            <!--- This is event custom date.it's get from meta box.--->
                                            <?php if(!empty($event_date)): ?>
                                                <span class="xs-event-date"><?php echo date('d',$event_date); ?></span>
                                                <span class="xs-event-month"><?php echo date('M',$event_date); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <ul class="list-group xs-list-group">
                                        <?php if(!empty($speaker)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Speaker:','crowdmerc'); ?>
                                                <span><?php echo esc_html($speaker); ?></span>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(!empty($event_organization)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Organized by:','crowdmerc'); ?>
                                                <span><?php echo esc_html($event_organization); ?></span>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(!empty($event_time)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Start:','crowdmerc'); ?>
                                                <span><?php echo esc_html($event_time); ?></span>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(!empty($event_venue)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Venue:','crowdmerc'); ?>
                                                <span><?php echo esc_html($event_venue); ?></span>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(!empty($event_phone)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Phone:','crowdmerc'); ?>
                                                <span><?php echo esc_html($event_phone); ?></span>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(!empty($event_email)): ?>
                                            <li class="d-flex justify-content-between">
                                                <?php echo esc_html__('Email:','crowdmerc'); ?>
                                                <span><?php echo esc_html($event_email); ?></span>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                                <?php if(!empty( $event_date)): ?>
                                    <div class="countdown-container xs-countdown-timer timer-style-2 xs-mb-30" data-countdown="<?php echo esc_attr($event_date_main); ?>"></div>
                                <?php endif; ?>
                                <?php $i = 0; ?>
                                <?php if(!empty($event_sponsor) && is_array($event_sponsor)): ?>
                                    <div class="xs-event-schedule-widget">
                                        <h3 class="widget-title"><?php echo esc_html__('Event Sponsor','crowdmerc') ?></h3>
                                        <ul class="xs-event-sponsor clearfix">
                                            <?php foreach($event_sponsor as $sponsor): ?>
                                                <?php
                                                if($i == 4) break;
                                                $thumbnail	 = wp_get_attachment_image_src(($sponsor['attachment_id'] ), 'full' );
                                                ?>
                                            <li><a href="#"><img src="<?php echo esc_url($thumbnail[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a></li>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php endwhile; ?>
<?php get_footer(); ?>
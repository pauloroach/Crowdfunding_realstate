<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Event_Tab_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-event-tab';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Event Tab', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Event Tab', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'post_count',
            [
                'label'         => esc_html__( 'Post count', 'crowdmerc' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'crowdmerc' ),

            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $post_count = $settings['post_count'];
        $xs_cat = xs_category_list_slug( 'event_cat' );
        $xs_count_cat = 1;
        $xs_count_post = 1;

        ?>
        <div class="fundpress-tab-wraper">
            <div class="fundpress-tab-nav-v4 xs-tab-nav">
                <ul class="nav nav-tabs" role="tablist">
                    <?php if(!empty($xs_cat) && is_array($xs_cat)): ?>
                        <?php foreach($xs_cat as $xs_cats): ?>
                            <?php
                            $xs_date = '';
                            if(defined('FW')){
                                $xs_date = strtotime(fw_get_db_term_option($xs_cats->term_id , 'event_cat','event_date_cat'));
                                $xs_date = date('d F y',$xs_date);
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($xs_count_cat == 1 ) ? 'active' : ''; ?>" href="#<?php echo esc_html( $xs_cats->slug ) ?>" data-toggle="tab"><?php echo esc_html( $xs_cats->name ) ?><span><?php echo esc_html($xs_date); ?></span></a>
                            </li>
                            <?php $xs_count_cat++; ?>
                            <?Php if($xs_count_cat == $post_count) break; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="tab-content">
                <?php
                if(!empty($xs_cat) && is_array($xs_cat)):
                    foreach($xs_cat as $xs_catss):
                        $query_args = array(
                            'post_type'     => 'event',
                            'tax_query'     => array(
                                'relation'  => 'AND',

                                array(
                                    'taxonomy'  => 'event_cat',
                                    'field'     => 'slug',
                                    'terms'     => $xs_catss->slug
                                ),
                            ),
                            'posts_per_page' => -1,
                        );
                        $xs_query = new \WP_Query($query_args);
                        ?>
                        <div role="tabpanel" class="tab-pane fadeInRights fade <?php echo ($xs_count_post == 1 ) ? 'in active show' : ''; ?>" id="<?php echo esc_html( $xs_catss->slug ); ?>">
                            <?php
                            while ($xs_query->have_posts()) :
                                $xs_query->the_post();
                                $event_time = '';
                                $event_venue = '';
                                if(defined('FW')){
                                    $event_time = fw_get_db_post_option( get_the_ID(), 'event_time' );
                                    $event_venue = fw_get_db_post_option( get_the_ID(), 'event_venue' );
                                }
                                ?>
                                <div class="fundpress-single-event rounded">
                                    <div class="row xs-margin-0">
                                        <?php if(has_post_thumbnail()): ?>
                                            <?php
                                            $thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                            if(!empty($thumbnail)) {
                                                $img = $thumbnail[ 0 ];
                                            }
                                            ?>
                                            <div class="col-md-12 col-lg-4 xs-padding-0">
                                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-md-12 col-lg-8 row fundpress-event-wraper-v2">
                                            <div class="col-md-8 xs-padding-0">
                                                <div class="fundpress-event-content">
                                                    <?php if(!empty($event_time)): ?>
                                                        <h5><?php echo esc_html($event_time); ?></h5>
                                                    <?php endif; ?>
                                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 xs-padding-0">
                                                <div class="xs-btn-wraper text-right">
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="xs-btn btn btn-primary btn-lg round-btn"><?php echo esc_html__('View Event','crowdmerc') ?></a>
                                                </div>
                                            </div>
                                            <div class="col-md-5 xs-padding-0">
                                                <?php echo wp_kses_post(wp_trim_words(get_the_content(),15,'')) ?>
                                            </div>
                                            <div class="col-md-7 xs-padding-0">
                                                <div class="fundpress-event-text-content text-left">
                                                    <p class="xs-mb-10"><strong><?php echo esc_html__('Speaker:','crowdmerc') ?></strong> <?php echo esc_html__('WIlliam Hannah, CEO, Xpeedstudio','crowdmerc') ?></p>
                                                    <?php if(!empty($event_venue)): ?>
                                                        <p><strong><?php echo esc_html__('Vanue:','crowdmerc') ?></strong> <?php echo esc_html($event_venue); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $xs_count_post++;
                            endwhile;
                            ?>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        <?php

    }

    protected function _content_template() { }
}
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Event_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-event';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Event', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Event Post', 'crowdmerc'),
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
        $query = array(
            'post_type'      => 'event',
            'post_status'    => 'publish',
            'posts_per_page' => $post_count,
        );

        $xs_query = new \WP_Query( $query );
        if($xs_query->have_posts()):
            ?>
            <div class="fundpress-event-wraper">
                <?php
                while ($xs_query->have_posts()) :
                    $xs_query->the_post();
                    require CROWDMERC_SHORTCODE_DIR_STYLE.'/event/style1.php';
                endwhile;
                ?>
            </div>
            <?php
        endif;
        wp_reset_postdata();
    }
    protected function _content_template() { }
}
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Faq_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-faq';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Faq', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
      $this->start_controls_section(
          'section_tab',
          [
              'label' =>esc_html__('Crowdmerc Faq', 'crowdmerc'),
          ]
      );

      $this->add_control(
        'post_count',
        [
          'label'         => esc_html__( 'Post count', 'crowdmerc' ),
          'type'          => Controls_Manager::NUMBER,
          'default'       => 12,
        ]
      );

        $this->end_controls_section();
    }

    protected function render( ) {

        $settings = $this->get_settings();
        $post_count = $settings['post_count'];

        $filter_cat = array(
            'orderby'       => 'ID',
            'order'         => 'DESC', 
            'hide_empty'    => 1,
            'hierarchical'  => 1,
            'taxonomy'      => 'faq_cat'
        );


        $query = array(
              'post_type'      => 'faq',
              'post_status'    => 'publish',
              'posts_per_page'  => $post_count,
        );

          $xs_query = new \WP_Query( $query );
        ?>
        <?php if($xs_query->have_posts()): ?>
          <div class="row">
              <?php while ($xs_query->have_posts()) : $xs_query->the_post();?>
                <div class="fundpress-faq-wraper col-md-6">
                    <div class="fundpresss-ingle-faq">
                        <h4 class="color-navy-blue clearfix"><span class="xs-firstcharacter color-navy-blue">Q.</span><?php the_title(); ?></h4>
                        <p class="clearfix"><span class="xs-firstcharacter color-green">A.</span><?php echo get_the_content( ); ?></p>
                        <span class="xs-separetor border-color-green border-separetor xs-separetor-v2 fundpress-separetor"></span>
                    </div>
                </div>
              <?php endwhile; ?>
          </div>
          <?php
          ?>
        <?php endif; ?>
    <?php
        wp_reset_postdata();
    }

    protected function _content_template() { }
}
?>
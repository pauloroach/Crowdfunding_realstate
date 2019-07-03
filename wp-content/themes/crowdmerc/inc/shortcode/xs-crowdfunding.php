<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Crowdfunding_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'xs-crowdfunding-grid';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Crowdfunding Grid', 'crowdmerc' );
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
                'label' => esc_html__('Product element', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Style', 'crowdmerc' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 1,
                'options'   => [
                    '1'     => esc_html__( 'style 1', 'crowdmerc' ),
                    '2'     => esc_html__( 'style 2', 'crowdmerc' ),
                    '3'     => esc_html__( 'style 3', 'crowdmerc' ),
                    '4'     => esc_html__( 'style 4', 'crowdmerc' ),
                ],
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
        
        $this->add_control(
            'count_col',
            [
                'label'     => esc_html__( 'Select Column', 'crowdmerc' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                        '2'     => esc_html__( '2 Column', 'crowdmerc' ),
                        '3'     => esc_html__( '3 Column', 'crowdmerc' ),
                        '4'     => esc_html__( '4 Column', 'crowdmerc' ),
                    ],
            ]
        );

        $this->add_control(
            'xs_post_cat', [
                'label'			 =>esc_html__( 'Category', 'crowdmerc' ),
                'type'			 => Controls_Manager::TEXT,
                'label_block'	 => true,
                'placeholder'	 =>esc_html__('design,fashion', 'crowdmerc' ),
                'desc'          => esc_html__('add you multiple category use comma separator', 'crowdmerc')
            ]
        );
        $this->add_control(
            'show_author',
            [
                'label' =>esc_html__( 'Show Author', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
            ]
        );
        $this->add_control(
            'show_filter',
            [
                'label' =>esc_html__( 'Show Filter', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => esc_html__( 'Filter', 'crowdmerc' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                    'success'     => esc_html__( 'successful', 'crowdmerc' ),
                    'expired'     => esc_html__( 'expired', 'crowdmerc' ),
                    'valid'     => esc_html__( 'valid', 'crowdmerc' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
      $settings = $this->get_settings();
      $xs_post_cat = $settings['xs_post_cat'];
      $count_col = $settings['count_col'];
      $post_count = $settings['post_count'];
      $styles = $settings['style'];
      $show_filter = $settings['show_filter'];
      $author = $settings['show_author'];
      $filter = $settings['filter'];
      ?>
        <div class="xs-wp-fundraising-listing-style-<?php echo esc_attr($styles);?>">
            <?php
                $style = ($styles == 4 ) ? $style = 1 : $style = $styles;
                echo do_shortcode('[wp_fundraising_listing cat="'.$xs_post_cat.'" number="'.$post_count.'" col="'.$count_col.'" style="'.$style.'" filter="'.$show_filter.'" author="'.$author.'" show="'.$filter.'"]');
            ?>
        </div>
    <?php
    }

    protected function _content_template() { }
}
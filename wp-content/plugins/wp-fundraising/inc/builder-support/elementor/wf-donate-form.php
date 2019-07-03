<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WF_Donate_Form_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'wf-donate-modal';
    }


    public function get_categories() {
        return [ 'wf-elements' ];
    }
    public function get_title() {
        return esc_html__( 'WF Donate Form', 'wp-fundraising' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Donate Form element', 'wp-fundraising'),
            ]
        );
        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Style', 'wp-fundraising' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '1'     => esc_html__( 'Style 1', 'wp-fundraising' ),
                    '2'     => esc_html__( 'Style 2', 'wp-fundraising' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        echo do_shortcode('[wp_fundraising_donate_form style="'.$style.'"]');
    }

    protected function _content_template() { }
}
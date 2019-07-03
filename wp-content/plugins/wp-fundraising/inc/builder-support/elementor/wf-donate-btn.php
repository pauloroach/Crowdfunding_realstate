<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WF_Donate_Btn_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'wf-donate-btn';
    }


    public function get_categories() {
        return [ 'wf-elements' ];
    }
    public function get_title() {
        return esc_html__( 'WF Donate Button', 'wp-fundraising' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function _register_controls() {

    }

    protected function render( ) {

        echo do_shortcode('[wp_fundraising_donate_btn]');
    }

    protected function _content_template() { }
}
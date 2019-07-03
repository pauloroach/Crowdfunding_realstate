<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WF_Campaign_Submit_Form_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'wf-campaigns-submit-form';
    }


    public function get_categories() {
        return [ 'wf-elements' ];
    }
    public function get_title() {
        return esc_html__( 'WF Campaign Submit Form', 'wp-fundraising' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function _register_controls() {

    }

    protected function render( ) {

        echo do_shortcode('[wp_fundraising_form]');
    }

    protected function _content_template() { }
}
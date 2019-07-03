<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Shape_Background_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-background-animation';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Shade Background', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-insert-image';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function render( ) {

        ?>
        <div class="xs-shape-background">
            <div class="xs-waves">
                <div class="xs-wave xs-wave_1"></div>
                <div class="xs-wave xs-wave_2"></div>
                <div class="xs-wave xs-wave_3"></div>
                <div class="xs-wave xs-wave_4"></div>
                <div class="xs-wave xs-wave_5"></div>
            </div>
        </div>
        <?php
    }



    protected function _content_template() { }
}
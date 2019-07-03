<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Contact_Info_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-contact-info';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Contact Info', 'crowdmerc' );
    }

    public function get_icon() {
        return 'fa fa-user';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Crowdmerc Contact Info', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' =>esc_html__( 'Phone Number', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( '+88 00 11 22 33', 'crowdmerc' ),
                'default' =>esc_html__( '+88 00 11 22 33', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'email',
            [
                'label' =>esc_html__( 'Email Address', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'name@yourdomain.com', 'crowdmerc' ),
                'default' =>esc_html__( 'name@yourdomain.com', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'address',
            [
                'label' =>esc_html__( 'Address', 'crowdmerc' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Welington City, Beside Pull, Australia', 'crowdmerc' ),
                'default' =>esc_html__( 'Welington City, Beside Pull, Australia', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Image', 'crowdmerc' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tab_map',
            [
                'label' =>esc_html__('Map Setting', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'latitude',
            [
                'label' =>esc_html__( 'latitude', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( '37.4850753', 'crowdmerc' ),
                'default' =>esc_html__( '37.4850753', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'longitude',
            [
                'label' =>esc_html__( 'Longitude', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( '-122.1496129', 'crowdmerc' ),
                'default' =>esc_html__( '-122.1496129', 'crowdmerc' ),
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Icon Style
         *
         */

        $this->start_controls_section(
            'section_icon_styling',
            [
                'label' =>esc_html__('Icon', 'crowdmerc'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'icon_clolor',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fundpress-icon-with-text li i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Title Sytle
         *
         */

        $this->start_controls_section(
            'section_label_styling',
            [
                'label' =>esc_html__('Label', 'crowdmerc'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'	=>	[
                    'style'	=>	'style2',
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fundpress-contact-text b' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .fundpress-contact-text b',
            ]
        );

        $this->end_controls_section();

        /**
         *
         * value Sytle
         *
         */


        $this->start_controls_section(
            'section_value_styling',
            [
                'label' =>esc_html__('value', 'crowdmerc'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'value_color',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fundpress-icon-with-text li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fundpress-contact-text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_typography',
                'selector' => '{{WRAPPER}} .fundpress-icon-with-text li',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();

        $phone_number = $settings['phone_number'];

        $email = $settings['email'];

        $address =  $settings['address'];
        $tabs_id = uniqid('xs-multiple-map-').mt_rand(1000,9999);
        $map_data = array(
            'latitude' => $settings['latitude'],
            'longitude' => $settings['longitude'],
            'id'  => $tabs_id,
        );
        $this->add_render_attribute( 'map-data', 'data-map', json_encode( $map_data ) );
        ?>
        <div class="fundpress-contact-details">
            <div class="xs-box-shadow xs-mb-40 fundpress-widnow-wraper">
                <div class="fundpress-window-top">
                    <?php
                    printf(
                        '<div  class="xs-contactmap" %1$s></div>',
                        $this->get_render_attribute_string( 'map-data' ),
                        $tabs_id
                    );
                    ?>
                </div>
                <div class="fundpress-window-back">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                </div>
                <div class="fundpress-window-nav">
                    <a href="#" class="fundpress-window-opener">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <!-- xs-box-shadow xs-mb-40 fundpress-widnow-wraper -->
            <ul class="xs-list-item-icon-text">
                <?php if(!empty( $phone_number)): ?>
                    <li><i class="fa fa-phone color-green"></i><?php echo esc_html($phone_number); ?></li>
                <?php endif; ?>
                <?php if(!empty( $email)): ?>
                    <li><i class="fa fa-envelope-o color-green"></i><?php echo esc_html($email); ?></li>
                <?php endif; ?>
                 <?php if(!empty( $address)): ?>
                    <li><i class="fa fa-map-marker color-green"></i><?php echo esc_html($address); ?></li>
                 <?php endif; ?>
            </ul>
        </div>
        <?php
    }
    protected function _content_template() { }
}
?>
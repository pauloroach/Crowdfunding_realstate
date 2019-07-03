<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-button';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Button', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Crowdmerc Button', 'crowdmerc'),
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label' =>esc_html__( 'Label', 'crowdmerc' ),
				'type' => Controls_Manager::TEXT,
				'default' =>esc_html__( 'Learn more ', 'crowdmerc' ),
				'placeholder' =>esc_html__( 'Learn more ', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' =>esc_html__( 'Link', 'crowdmerc' ),
				'type' => Controls_Manager::URL,
				'placeholder' =>esc_html__('http://your-link.com','crowdmerc' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'crowdmerc' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' =>esc_html__( 'Icon Position', 'crowdmerc' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' =>esc_html__( 'Before', 'crowdmerc' ),
					'right' =>esc_html__( 'After', 'crowdmerc' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label' =>esc_html__( 'Alignment', 'crowdmerc' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' =>esc_html__( 'Left', 'crowdmerc' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'crowdmerc' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' =>esc_html__( 'Right', 'crowdmerc' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label' =>esc_html__( 'Button Style', 'crowdmerc' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'crowdmerc' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => 40,
					'right' => 40,
					'bottom' => 40 ,
					'left' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .xs-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' =>esc_html__( 'Padding', 'crowdmerc' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' =>esc_html__( 'Typography', 'crowdmerc' ),
				'selector' => '{{WRAPPER}} a.xs-btn',
			]
		);

		$this->start_controls_tabs( 'xs_tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' =>esc_html__( 'Normal', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' =>esc_html__( 'Text Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' =>esc_html__( 'Background Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' =>esc_html__( 'Text Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_hover_color',
			[
				'label' =>esc_html__( 'Background Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-btn:before' => 'border-bottom: 100px solid {{VALUE}};',
					'{{WRAPPER}} .xs-btn:after' => 'border-top: 100px solid {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_border_color',
			[
				'label' =>esc_html__( 'Border Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();

        $btn_text = $settings['btn_text'];

		$btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
		
		$btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
		
        $this->add_render_attribute( 'icon-align', 'class', 'fundpress-button-icon fundpress-align-icon-' . $settings['icon_align'] );
        ?>
		<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="xs-btn navy-blue-btn">
			<span <?php echo crowdmerc_kses($this->get_render_attribute_string( 'icon-align' )); ?> ><i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i></span>
			<span class="fundpress-button-text"><?php echo esc_html( $btn_text ); ?></span>
		</a>
        <?php
    }

    protected function _content_template() { }
}
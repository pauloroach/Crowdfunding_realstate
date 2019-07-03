<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor button widget.
 *
 * Elementor widget that displays a button with the ability to controll every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Xs_Button_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Crowdmerc Button', 'crowdmerc' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */
	public static function get_button_sizes() {
		return [
			'xs' => esc_html__( 'Extra Small', 'crowdmerc' ),
			'sm' => esc_html__( 'Small', 'crowdmerc' ),
			'md' => esc_html__( 'Medium', 'crowdmerc' ),
			'lg' => esc_html__( 'Large', 'crowdmerc' ),
			'xl' => esc_html__( 'Extra Large', 'crowdmerc' ),
		];
	}

	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
		'section_button', [
			'label' => esc_html__( 'Button', 'crowdmerc' ),
		]
		);

		$this->add_control(
		'button_type', [
			'label'			 => esc_html__( 'Type', 'crowdmerc' ),
			'type'			 => Controls_Manager::SELECT,
			'default'		 => '',
			'options'		 => [
				''			 => esc_html__( 'Default', 'crowdmerc' ),
				'info'		 => esc_html__( 'Info', 'crowdmerc' ),
				'success'	 => esc_html__( 'Success', 'crowdmerc' ),
				'warning'	 => esc_html__( 'Warning', 'crowdmerc' ),
				'danger'	 => esc_html__( 'Danger', 'crowdmerc' ),
			],
			'prefix_class'	 => 'elementor-button-',
		]
		);

		$this->add_control(
		'text', [
			'label'			 => esc_html__( 'Text', 'crowdmerc' ),
			'type'			 => Controls_Manager::TEXT,
			'default'		 => esc_html__( 'Click me', 'crowdmerc' ),
			'placeholder'	 => esc_html__( 'Click me', 'crowdmerc' ),
		]
		);

		$this->add_control(
		'link', [
			'label'			 => esc_html__( 'Link', 'crowdmerc' ),
			'type'			 => Controls_Manager::URL,
			'placeholder'	 => esc_html__( 'https://your-link.com', 'crowdmerc' ),
			'default'		 => [
				'url' => '#',
			],
		]
		);

		$this->add_responsive_control(
		'align', [
			'label'			 => esc_html__( 'Alignment', 'crowdmerc' ),
			'type'			 => Controls_Manager::CHOOSE,
			'options'		 => [
				'left'		 => [
					'title'	 => esc_html__( 'Left', 'crowdmerc' ),
					'icon'	 => 'fa fa-align-left',
				],
				'center'	 => [
					'title'	 => esc_html__( 'Center', 'crowdmerc' ),
					'icon'	 => 'fa fa-align-center',
				],
				'right'		 => [
					'title'	 => esc_html__( 'Right', 'crowdmerc' ),
					'icon'	 => 'fa fa-align-right',
				],
				'justify'	 => [
					'title'	 => esc_html__( 'Justified', 'crowdmerc' ),
					'icon'	 => 'fa fa-align-justify',
				],
			],
			'prefix_class'	 => 'fundpress%s-align-',
			'default'		 => '',
		]
		);

		$this->add_control(
		'size', [
			'label'		 => esc_html__( 'Size', 'crowdmerc' ),
			'type'		 => Controls_Manager::SELECT,
			'default'	 => 'sm',
			'options'	 => self::get_button_sizes(),
		]
		);

		$this->add_control(
		'icon', [
			'label'			 => esc_html__( 'Icon', 'crowdmerc' ),
			'type'			 => Controls_Manager::ICON,
			'label_block'	 => true,
			'default'		 => '',
		]
		);

		$this->add_control(
		'icon_align', [
			'label'		 => esc_html__( 'Icon Position', 'crowdmerc' ),
			'type'		 => Controls_Manager::SELECT,
			'default'	 => 'left',
			'options'	 => [
				'left'	 => esc_html__( 'Before', 'crowdmerc' ),
				'right'	 => esc_html__( 'After', 'crowdmerc' ),
			],
			'condition'	 => [
				'icon!' => '',
			],
		]
		);

		$this->add_control(
		'icon_indent', [
			'label'		 => esc_html__( 'Icon Spacing', 'crowdmerc' ),
			'type'		 => Controls_Manager::SLIDER,
			'range'		 => [
				'px' => [
					'max' => 50,
				],
			],
			'condition'	 => [
				'icon!' => '',
			],
			'selectors'	 => [
				'{{WRAPPER}} .elementor-button .elementor-align-icon-right'	 => 'margin-left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-button .elementor-align-icon-left'	 => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		]
		);

		$this->add_control(
		'view', [
			'label'		 => esc_html__( 'View', 'crowdmerc' ),
			'type'		 => Controls_Manager::HIDDEN,
			'default'	 => 'traditional',
		]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'section_style', [
			'label'	 => esc_html__( 'Button', 'crowdmerc' ),
			'tab'	 => Controls_Manager::TAB_STYLE,
		]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(), [
			'name'		 => 'typography',
			'scheme'	 => Scheme_Typography::TYPOGRAPHY_4,
			'selector'	 => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
		]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
		'tab_button_normal', [
			'label' => esc_html__( 'Normal', 'crowdmerc' ),
		]
		);

		$this->add_control(
		'button_text_color', [
			'label'		 => esc_html__( 'Text Color', 'crowdmerc' ),
			'type'		 => Controls_Manager::COLOR,
			'default'	 => '',
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		'background_color', [
			'label'		 => esc_html__( 'Background Color', 'crowdmerc' ),
			'type'		 => Controls_Manager::COLOR,
			'scheme'	 => [
				'type'	 => Scheme_Color::get_type(),
				'value'	 => Scheme_Color::COLOR_4,
			],
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
			],
		]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		'tab_button_hover', [
			'label' => esc_html__( 'Hover', 'crowdmerc' ),
		]
		);

		$this->add_control(
		'hover_color', [
			'label'		 => esc_html__( 'Text Color', 'crowdmerc' ),
			'type'		 => Controls_Manager::COLOR,
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		'button_background_hover_color', [
			'label'		 => esc_html__( 'Background Color', 'crowdmerc' ),
			'type'		 => Controls_Manager::COLOR,
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		'button_hover_border_color', [
			'label'		 => esc_html__( 'Border Color', 'crowdmerc' ),
			'type'		 => Controls_Manager::COLOR,
			'condition'	 => [
				'border_border!' => '',
			],
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		'hover_animation', [
			'label'	 => esc_html__( 'Hover Animation', 'crowdmerc' ),
			'type'	 => Controls_Manager::HOVER_ANIMATION,
		]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
		Group_Control_Border::get_type(), [
			'name'			 => 'border',
			'placeholder'	 => '1px',
			'default'		 => '1px',
			'selector'		 => '{{WRAPPER}} .elementor-button',
			'separator'		 => 'before',
		]
		);

		$this->add_control(
		'border_radius', [
			'label'		 => esc_html__( 'Border Radius', 'crowdmerc' ),
			'type'		 => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->add_group_control(
		Group_Control_Box_Shadow::get_type(), [
			'name'		 => 'button_box_shadow',
			'selector'	 => '{{WRAPPER}} .elementor-button',
		]
		);

		$this->add_control(
		'text_padding', [
			'label'		 => esc_html__( 'Padding', 'crowdmerc' ),
			'type'		 => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'	 => [
				'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'	 => 'before',
		]
		);

		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

		if ( !empty( $settings[ 'link' ][ 'url' ] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings[ 'link' ][ 'url' ] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link xs-btn round-btn navy-blue-btn' );

			if ( $settings[ 'link' ][ 'is_external' ] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings[ 'link' ][ 'nofollow' ] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button' );

		if ( !empty( $settings[ 'size' ] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings[ 'size' ] );
		}

		if ( $settings[ 'hover_animation' ] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings[ 'hover_animation' ] );
		}
		?>
		<div <?php echo bizipress_return( $this->get_render_attribute_string( 'wrapper' ) ); ?>>
			<a <?php echo bizipress_return( $this->get_render_attribute_string( 'button' ) ); ?>>
		<?php $this->render_text(); ?>
			</a>
		</div>
		<?php
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );
		#>
		<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-{{ settings.size }} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}">
				<span class="elementor-button-content-wrapper">
					<# if ( settings.icon ) { #>
					<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
						<i class="{{ settings.icon }}" aria-hidden="true"></i>
					</span>
					<# } #>
					<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
				</span>
			</a>
		</div>
		<?php
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings[ 'icon_align' ] );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-button-icon' );

		$this->add_render_attribute( 'text', 'class', 'elementor-button-text' );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo bizipress_return( $this->get_render_attribute_string( 'content-wrapper' ) ); ?>>
		<?php if ( !empty( $settings[ 'icon' ] ) ) : ?>
				<span <?php echo bizipress_return( $this->get_render_attribute_string( 'icon-align' ) ); ?>>
					<i class="<?php echo esc_attr( $settings[ 'icon' ] ); ?>" aria-hidden="true"></i>
				</span>
		<?php endif; ?>
			<span <?php echo bizipress_return( $this->get_render_attribute_string( 'text' ) ); ?>><?php echo esc_html($settings[ 'text' ]); ?></span>
		</span>
		<?php
	}

}

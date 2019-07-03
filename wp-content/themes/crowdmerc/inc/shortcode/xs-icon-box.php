<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class Xs_Icon_Widget extends Widget_Base {

	public function get_name() {
		return 'xs-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Crowdmerc Icon Box', 'crowdmerc' );
	}

	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'crowdmerc-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Crowdmerc Icon Box', 'crowdmerc' ),
			]
		);


		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Title', 'crowdmerc' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Add title', 'crowdmerc' ),
				'default'		 =>esc_html__( 'Add Title', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'sub_title', [
				'label'			 =>esc_html__( 'Sub Title', 'crowdmerc' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Description', 'crowdmerc' ),
				'default'		 =>esc_html__( 'Start fundraising in minutes.No goal requirements, no deadlines.', 'crowdmerc' ),
			]
		);

		$this->add_control(

            'use', [
                'type' => Controls_Manager::SELECT,
                'label' =>esc_html__('Choose Style', 'crowdmerc'),
                'default' => 'icon',
                'options' => [
                    'icon' =>esc_html__('Icon', 'crowdmerc'),
                    'image' =>esc_html__('Image', 'crowdmerc'),
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
				'condition'	 => [
					'use' => 'icon',
				],
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
                'condition'	 => [
					'use' => 'image',
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'thumbnail',
				'condition'	 => [
					'use' => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'title_align', [
				'label'			 =>esc_html__( 'Alignment', 'crowdmerc' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'crowdmerc' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'crowdmerc' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'crowdmerc' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => '',
				'prefix_class' => 'fundpress%s-align-',
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 =>esc_html__( 'Title', 'crowdmerc' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color', [
				'label'		 =>esc_html__( 'Color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service h5.color-white' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'title_margin_bottom', [
				'label'			 =>esc_html__( 'Margin Bottom', 'crowdmerc' ),
				'type'			 => Controls_Manager::SLIDER,
				'default'		 => [
					'size' => '',
				],
				'range'			 => [
					'px' => [
						'min'	 => 0,
						'step'	 => 5,
					],
				],
				'size_units'	 => ['px'],
				'selectors'		 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service h5'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .fundpress-icon-with-square-service h5',
			]
		);

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section(
			'section_subtitle_style', [
				'label'	 =>esc_html__( 'Sub Title', 'crowdmerc' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color', [
				'label'		 =>esc_html__( 'color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .fundpress-icon-with-square-service p',
			]
		);

		$this->end_controls_section();

		//Border style section

		$this->start_controls_section(
			'section_border_style', [
				'label'	 =>esc_html__( 'Border', 'crowdmerc' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_width', [
				'label'			 =>esc_html__( 'Border Width', 'crowdmerc' ),
				'type'			 => Controls_Manager::SLIDER,
				'default'		 => [
					'size' => '',
				],
				'range'			 => [
					'px' => [
						'min'	 => 0,
						'step'	 => 5,
					],
				],
				'size_units'	 => ['px'],
				'selectors'		 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service'	=> 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color', [
				'label'		 =>esc_html__( 'color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_hover_color', [
				'label'		 =>esc_html__( 'Hover color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Icon Style Section
		$this->start_controls_section(
			'section_icon_style', [
				'label'	 =>esc_html__( 'Icon/Image', 'crowdmerc' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color', [
				'label'		 =>esc_html__( 'Color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service i' => 'color: {{VALUE}};'
				],
				'condition'	 => [
					'use' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_margin_bottom', [
				'label'			 =>esc_html__( 'Margin Bottom', 'crowdmerc' ),
				'type'			 => Controls_Manager::SLIDER,
				'default'		 => [
					'size' => '',
				],
				'range'			 => [
					'px' => [
						'min'	 => 0,
						'step'	 => 5,
					],
				],
				'size_units'	 => ['px'],
				'selectors'		 => [
					'{{WRAPPER}} .fundpress-icon-with-square-service i'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fundpress-icon-with-square-service img'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_typography',
			'selector'	 => '{{WRAPPER}} .fundpress-icon-with-square-service i',
			'condition'	 => [
					'use' => 'icon',
				],
			]
		);
	}

	protected function render() {
		$settings = $this->get_settings();
		$title = $settings[ 'title_text' ];
		$use = $settings[ 'use' ];
		$sub_title = $settings[ 'sub_title' ];
	?>
	<div class="fundpress-icon-with-square-service">

		<?php if($use == 'image'): ?>
			<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
		<?php else: ?>
			<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
		<?php endif; ?>

		<?php if(!empty($title)): ?>
			<h5 class="color-white"><?php echo esc_html($title) ?></h5>
		<?php endif; ?>

		<?php if(!empty($sub_title)):?>
			<p><?php echo esc_html($sub_title) ?></p>
		<?php endif; ?>

	</div>
	<?php
	}

	protected function _content_template() {
		
	}
}

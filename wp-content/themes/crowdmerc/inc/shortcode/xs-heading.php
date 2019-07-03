<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class Xs_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'xs-heading';
	}

	public function get_title() {
		return esc_html__( 'Crowdmerc Heading', 'crowdmerc' );
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
				'label' =>esc_html__( 'Crowdmerc Heading', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'style', [
				'type'		 => Controls_Manager::SELECT,
				'label'		 =>esc_html__( 'Choose Style', 'crowdmerc' ),
				'default'	 => 'style1',
				'label_block'	 => true,
				'options'	 => [
					'style1' =>esc_html__( 'Styllish Title', 'crowdmerc' ),
					'style2' =>esc_html__( 'Watermark Title', 'crowdmerc' ),
				],
			]
		);

		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Heading Title', 'crowdmerc' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Add title', 'crowdmerc' ),
				'default'		 =>esc_html__( 'Add Title', 'crowdmerc' ),
			]
		);

		$this->add_control(
			'sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'crowdmerc' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Description', 'crowdmerc' ),
				'default'		 =>esc_html__( 'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly.', 'crowdmerc' ),
			]
		);

        $this->add_control(
            'water_title', [
                'label'			 =>esc_html__( 'Water Title', 'crowdmerc' ),
                'type'			 => Controls_Manager::TEXT,
                'label_block'	 => true,
                'placeholder'	 =>esc_html__( 'Add title', 'crowdmerc' ),
                'default'		 =>esc_html__( 'Add Title', 'crowdmerc' ),
                'condition'      => [
                    'style' => 'style2',
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
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'crowdmerc' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => '',
				'prefix_class' => 'xs-heading-text elementor%s-align-',
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
				'label'		 =>esc_html__( 'Title color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-heading-title .color-navy-blue' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .fundpress-heading-title h2'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .fundpress-heading-title h2',
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
					'{{WRAPPER}} .fundpress-heading-title p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .fundpress-heading-title p',
			]
		);

		$this->end_controls_section();

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
					'{{WRAPPER}} .fundpress-separetor.dashed-separetor'	=> 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_margin_bottom', [
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
					'{{WRAPPER}} .fundpress-separetor.dashed-separetor'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color', [
				'label'		 =>esc_html__( 'color', 'crowdmerc' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .fundpress-separetor.dashed-separetor' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_watertitle_style', [
                'label'	 =>esc_html__( 'Water Title', 'crowdmerc' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
                'condition' =>  [
                    'style' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'water_title_color', [
                'label'		 =>esc_html__( 'color', 'crowdmerc' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .parallax-title' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'water_opacity', [
                'label'		 =>esc_html__( 'Opacity', 'crowdmerc' ),
                'type'		 => Controls_Manager::SLIDER,
                'range'		 => [
                    'px' => [
                        'min'	 => 0,
                        'max'	 => 1,
                        'step'	 => .1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} .parallax-title'		 => 'opacity: {{SIZE}};',
                ],
            ]
        );
	}

	protected function render() {
		$settings = $this->get_settings();
		$style = $settings[ 'style' ];
		$title = $settings[ 'title_text' ];
		$sub_title = $settings[ 'sub_title' ];
        $water_title = $settings['water_title'];

		switch ( $style ) {
			case 'style1':
				require CROWDMERC_SHORTCODE_DIR_STYLE . '/heading/style1.php';
				break;

            case 'style2':
                require CROWDMERC_SHORTCODE_DIR_STYLE . '/heading/style2.php';
                break;
		}
	}

	protected function _content_template() {
		
	}
}

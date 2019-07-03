<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class XS_Video_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-video';
    }

    public function get_title() {
        return esc_html__( 'crowdmerc Video Box', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('crowdmerc Video Box', 'crowdmerc'),
            ]
        );

        $this->add_control(

            'style', [
                'type' => Controls_Manager::SELECT,
                'label' =>esc_html__('Choose Style', 'crowdmerc'),
                'default' => 'style1',
                'options' => [
                    'style1' =>esc_html__('With Thumbnail Image', 'crowdmerc'),
                    'style2' =>esc_html__('Without Thumbnail Image', 'crowdmerc'),
                ],
            ]
        );

        $this->add_control(
			'video_link',
			[
				'label' =>esc_html__( 'Link', 'crowdmerc' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' =>esc_html__('http://your-link.com','crowdmerc' ),

			]
		);

		$this->add_control(
			'image',
			[
				'label' =>esc_html__( 'Thumbnail Image', 'crowdmerc' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' =>  [
                    'style' => 'style1',
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' =>esc_html__( 'Image Size', 'crowdmerc' ),
                'default' => 'full',
                'condition' =>  [
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'xs_max_width',
            [
                'label' =>esc_html__( 'Image Max Width', 'crowdmerc' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '42',
                ],
                'range' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 10,
                ],
                'size_units' => [ '%'],

                'selectors'	=>	[
                    '{{WRAPPER}} .fundpress-popup-image' => 'max-width: {{SIZE}}%;',
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

        	'style_tab',
        	[
        		'label'	=>	__( 'Style', 'crowdmerc' ),
        		'tab' 	=> Controls_Manager::TAB_STYLE,
        	]
        );

        $this->add_control(
        	'border',
        	[
        		'label'	=>	__('Show Border','crowdmerc'),
        		'type'	=> Controls_Manager::SWITCHER,
        		'default' => 'no',
				'label_on' =>esc_html__( 'Yes', 'crowdmerc' ),
				'label_off' =>esc_html__( 'No', 'crowdmerc' ),

        	]

        );

	    $this->add_control(
		    'border_width',
		    [
		        'label' =>esc_html__( 'Border Width', 'crowdmerc' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => '1',
		        ],
		        'range' => [
		                'min' => 1,
		                'max' => 100,
		                'step' => 1,
		        ],
		        'size_units' => [ 'px'],
		        'condition'	=>	[
        			'border'	=> 'yes',
        		],
		        'selectors'	=>	[
        			'{{WRAPPER}} a.xs-video-popup' => 'border: {{SIZE}}px solid;',
        		],
                'condition' =>  [
                    'border' => 'yes',
                ],
		    ]
		);

        $this->add_control(
        	'border_color',
        	[
        		'label'	=>	__('Border Color','crowdmerc'),
        		'type'	=> Controls_Manager::COLOR,
        		'selectors'	=>	[
        			'{{WRAPPER}} a.xs-video-popup' => 'border-color: {{VALUE}};',
        		],
        		'condition'	=>	[
        			'border'	=> 'yes',
        		],
        	]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Button BG Color','crowdmerc'),
                'type'  => Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} a.xs-video-popup' => 'background-color: {{VALUE}} !important;'
                ],
                
            ]
        );

        $this->add_control(
            'btn_icon_color',
            [
                'label' => esc_html__('Icon Color','crowdmerc'),
                'type'  => Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} a.xs-video-popup i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();

        $style = $settings['style'];

        $video_link = $settings['video_link'];
        ?>
        <?php if($style == 'style1'): ?>
			<div class="fundpress-popup-image">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                <div class="xs-popup-content icon-position-center">
                    <a href="<?php echo esc_url( $video_link ); ?>" class="xs-video-popup full-round icon-identify-btn green-btn xs-box-shadow xs-big-button"><i class="fa fa-play"></i></a>
                </div>
			</div>
		<?php elseif($style == 'style2'): ?>
			
            <a href="<?php echo esc_url( $video_link ); ?>" class="xs-video-popup full-round icon-identify-btn green-btn xs-box-shadow xs-big-button"><i class="fa fa-play"></i></a>
        <?php
        endif;
    }

    protected function _content_template() { }
}
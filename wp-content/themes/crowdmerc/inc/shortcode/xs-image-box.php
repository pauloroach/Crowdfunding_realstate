<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Image_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-image-box';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Image Box', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-insert-image';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Crowdmerc Image Box 02', 'crowdmerc'),
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

        $this->add_control(
            'title',
            [
                'label' =>esc_html__( 'Title', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Add title', 'crowdmerc' ),
                'default' =>esc_html__( 'Add Title', 'crowdmerc' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' =>esc_html__( 'Sub Title', 'crowdmerc' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' =>esc_html__( 'When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries', 'crowdmerc' ),
                
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label' =>esc_html__( 'Label', 'crowdmerc' ),
				'type' => Controls_Manager::TEXT,
				'default' =>esc_html__( 'create a project', 'crowdmerc' ),
				'placeholder' =>esc_html__( 'create a project', 'crowdmerc' ),
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


        $this->end_controls_section();

        /**
		 *
		 *Title Style
		 *
		*/

        $this->start_controls_section(
			'section_title_tab',
			[
				'label' =>esc_html__( 'Title', 'crowdmerc' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' =>esc_html__( 'Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .fundpress-full-width-wraper-v2 .fundpress-sub-title h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' =>esc_html__( 'Hover Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .fundpress-full-width-wraper-v2:hover .fundpress-sub-title h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' =>esc_html__( 'Typography', 'crowdmerc' ),
				'selector' => '{{WRAPPER}} .fundpress-full-width-wraper-v2 .fundpress-sub-title h2',
			]
		);

		$this->end_controls_section();


		/**
		 *
		 *Sub Title Style
		 *
		*/

        $this->start_controls_section(
			'section_sub_title_tab',
			[
				'label' =>esc_html__( 'Sub Title', 'crowdmerc' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' =>esc_html__( 'Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .fundpress-full-width-wraper-v2 .fundpress-product-text-content p ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_hover_title_color',
			[
				'label' =>esc_html__( 'Hover Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .fundpress-full-width-wraper-v2:hover .fundpress-product-text-content p ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' =>esc_html__( 'Typography', 'crowdmerc' ),
				'selector' => '{{WRAPPER}} .fundpress-full-width-wraper-v2 .fundpress-product-text-content p',
			]
		);

		$this->end_controls_section();


		/**
		 *
		 *Button Style
		 *
		*/

        $this->start_controls_section(
			'section_icon_tab',
			[
				'label' =>esc_html__( 'Button', 'crowdmerc' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' =>esc_html__( 'Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' =>esc_html__( 'Button hover color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn:hover ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' =>esc_html__( 'Button BG Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn ' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_hover_color',
			[
				'label' =>esc_html__( 'Button BG hover color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn:before ' => 'border-bottom: 100px solid {{VALUE}};',
					'{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn:after ' => 'border-top: 100px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' =>esc_html__( 'Typography', 'crowdmerc' ),
				'selector' => '{{WRAPPER}} .fundpress-product-hover-content-v2 a.xs-btn',
			]
		);

		$this->end_controls_section();

		/**
		 *
		 * Background Section
		 *
		 */

		$this->start_controls_section(
			'section_bg_tab',
			[
				'label' =>esc_html__( 'Background', 'crowdmerc' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'bg_color',
			[
				'label' =>esc_html__( 'Overlay Color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-single-square-service-content:before ' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_hover_color',
			[
				'label' =>esc_html__( 'Overlay hover color', 'crowdmerc' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fundpress-single-square-service-content:hover:before, {{WRAPPER}} .fundpress-overlay-with-img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
        
    }

    protected function render( ) {
    	
        $settings = $this->get_settings();
        $image = $settings['image'];
        $title = $settings['title'];
        $sub_title = $settings['sub_title'];
        $btn_text = $settings['btn_text'];
		$btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
		$btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
        ?>
		<div class="fundpress-full-width-wraper-v2" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
			<div class="fundpress-product-hover-content-v2">

				<div class="fundpress-sub-title">
					<h2><?php echo esc_html( $title ); ?></h2>
				</div>

				<div class="fundpress-product-text-content">
					<p><?php echo esc_html( $sub_title ); ?></p>
				</div>

				<div class="xs-btn-wrapre">
					<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="xs-btn btn xs-box-shadow btn-primary btn-lg round-btn"><?php echo esc_html( $btn_text ); ?>
					</a>
				</div>

			</div><!-- .fundpress-product-hover-content-v2 END -->
			<div class="xs-solid-overlay xs-bg-black"></div>
		</div>
        <?php
    }



    protected function _content_template() { }
}
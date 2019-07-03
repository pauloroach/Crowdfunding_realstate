<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Testimonial', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'section_tab_style',
            [
                'label' =>esc_html__('Crowdmerc Testimonial', 'crowdmerc'),
            ]
        );

        /**
         *
         * Testimonial Style1 
         *
         */

        $this->add_control(
            'testimonial',
            [
                'label' =>esc_html__('Tetimonial', 'crowdmerc'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'client_name' =>esc_html__('Testimonial #1', 'crowdmerc'),
                        'review' =>esc_html__('The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked', 'crowdmerc'),
                        'designation' => esc_html__('CEO, Pranklin Agency','crowdmerc'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'client_name' =>esc_html__('Testimonial #1', 'crowdmerc'),
                        'review' =>esc_html__('The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked', 'crowdmerc'),
                        'designation' => esc_html__('CEO, Pranklin Agency','crowdmerc'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'client_name' =>esc_html__('Testimonial #1', 'crowdmerc'),
                        'review' =>esc_html__('The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked', 'crowdmerc'),
                        'designation' => esc_html__('CEO, Pranklin Agency','crowdmerc'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'client_name',
                        'label' =>esc_html__('Client Name', 'crowdmerc'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],

                    [
                        'name' => 'review',
                        'label' =>esc_html__('Testimonial', 'crowdmerc'),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],

                    [
                        'name' => 'designation',
                        'label' =>esc_html__('Designation', 'crowdmerc'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],

                    [
                        'name' => 'image',
                        'label' =>esc_html__('Image', 'crowdmerc'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                    
                ],
                
                'title_field' => '{{{ client_name }}}',
            ]
        );

        $this->end_controls_section();
        /**
         *
         * Client Name
         *
         */
        

        $this->start_controls_section(
            'section_name_style',
            [
                'label' =>esc_html__('Name', 'crowdmerc'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fundpress-best-reviewr-content h3 ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .fundpress-single-testimonial h2 ' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' =>esc_html__( 'Typography', 'crowdmerc' ),
                'selector' => '{{WRAPPER}} .fundpress-best-reviewr-content h3, 
                              {{WRAPPER}} .fundpress-single-testimonial h2',
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Testimonial
         *
         */
        

        $this->start_controls_section(
            'section_testimonial_style',
            [
                'label' =>esc_html__('Testimonial', 'crowdmerc'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tetimonial_color',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fundpress-best-reviewr-content p' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .fundpress-single-testimonial p ' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_typography',
                'label' =>esc_html__( 'Typography', 'crowdmerc' ),
                'selector' => '{{WRAPPER}} .fundpress-best-reviewr-content p,  
                              {{WRAPPER}} .fundpress-single-testimonial p',
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Rating
         *
         */

        $this->start_controls_section(
            'section_rating_style',
            [
                'label' =>esc_html__('Rating', 'crowdmerc'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' =>esc_html__( 'Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.fundpress-rating li a ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .fundpress-beauty-product-footer h3 ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rating_typography',
                'label' =>esc_html__( 'Typography', 'crowdmerc' ),
                'selector' => '{{WRAPPER}} ul.fundpress-rating li a, 
                              {{WRAPPER}} .fundpress-beauty-product-footer h3',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();


        $testimonials = $settings['testimonial'];

        ?>
        <div class="xs-testimonial-slider slider-double-item xs-owl-dot owl-carousel">
            <?php if(!empty($testimonials)): ?>
                <?php foreach($testimonials as $testimonial): ?>
                    <?php
                        if($testimonial['image'] != ''){
                            $img = xs_resize($testimonial['image']['id'] , 100,100,true);
                        }
                    ?>
                    <div class="xs-testimonial-item">
                        <blockquote class="xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote">
                            <span class="xs-blockquote-icon fundpress-blockquote-icon">
                                <img src="<?php echo CROWDMERC_IMAGES_DIR_URI. '/quote-left.png'?>">
                            </span>
                            <?php echo esc_html( $testimonial['review'] ); ?>
                        </blockquote>

                        <div class="xs-spilit-container xs-testimonial-bio content-center width-70">
                            <div class="xs-avatar full-round fundpress-avatar-big">
                                <?php if(!empty($img)): ?>
                                    <img src="<?php echo esc_url( $img ); ?>" class="xs-box-shadow-2">
                                <?php endif; ?>
                            </div>
                            <div class="xs-item-footer fundpress-team-details fundpress-testimonial-details text-left">
                                <a href="#" class="color-navy-blue">
                                    <?php echo esc_html( $testimonial['client_name'] ); ?>
                                </a>
                                <h5 class="color-green"><?php echo esc_html( $testimonial['designation'] ); ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php  
    }

    protected function _content_template() { }
}
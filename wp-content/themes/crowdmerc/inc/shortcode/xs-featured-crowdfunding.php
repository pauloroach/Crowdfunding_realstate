<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Featured_Crowdfunding_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-featured-crowdfunding';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Crowdfunding Featured', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {


        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Product element', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Select Style', 'crowdmerc' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'style1'     => esc_html__( 'Banner', 'crowdmerc' ),
                    'style2'     => esc_html__( 'Slider', 'crowdmerc' ),
                ],
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'slider_products',
            [
                'label' =>esc_html__('Product', 'crowdmerc'),
                'type' => Controls_Manager::REPEATER,
                'condition' =>  [
                    'style'  =>  'style2',
                ],
                'default' => [
                    [
                        'xs_featured_pro' => 0,
                        'btn_labels' =>esc_html__('see campaign', 'crowdmerc'),
                        'btn_links' => '#',
                        'xs_image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'xs_featured_pro' => 0,
                        'btn_labels' =>esc_html__('see campaign', 'crowdmerc'),
                        'btn_links' => '#',
                        'xs_image' => Utils::get_placeholder_image_src(),
                    ],

                ],
                'fields' => [
                    [
                        'name'      => 'xs_featured_pro',
                        'label'    =>  esc_html__( 'Select Product', 'crowdmerc' ),
                        'type'     => Controls_Manager::SELECT,
                        'options'  => xs_featured_product( ),
                        'default'  => '0',
                    ],

                    [
                        'name' => 'xs_image',
                        'label' =>esc_html__('Image', 'crowdmerc'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'btn_labels',
                        'label' =>esc_html__( 'Button Label One', 'crowdmerc' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'placeholder' =>esc_html__( 'see campaign', 'crowdmerc' ),
                        'default' =>esc_html__( 'see campaign', 'crowdmerc' ),
                    ],

                    [
                        'name' => 'btn_links',
                        'label' =>esc_html__( 'Link', 'crowdmerc' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' =>esc_html__('http://your-link.com','crowdmerc' ),
                        'default' => [
                            'url' => '#',
                        ],
                    ]

                ],
                'title_field' => '{{{ xs_featured_pro }}}',
            ]
        );

        $this->add_control(
            'xs_post',
            [
                'label'    =>esc_html__( 'Select Product', 'crowdmerc' ),
                'type'     => Controls_Manager::SELECT,
                'options'  => xs_featured_product( ),
                'default'  => '0',
                'condition' => [
                    'style' => 'style1',
                ],
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
                'condition' => [
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
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );

        $this->add_control(
            'btn_label',
            [
                'label' =>esc_html__( 'Button Label One', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'start a campaign', 'crowdmerc' ),
                'default' =>esc_html__( 'see campaign', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'external_link',
            [
                'label' =>esc_html__( 'Use External Link', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'crowdmerc' ),
                'label_off' =>esc_html__( 'No', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'xs_page',
            [
                'label'    =>esc_html__( 'Select Page', 'crowdmerc' ),
                'type'     => Controls_Manager::SELECT,
                'options'  => marketpress_page_list( ),
                'condition' => [
                    'style' => 'style1',
                    'external_link!' => 'yes'
                ],
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
                'condition' => [
                    'style' => 'style1',
                    'external_link' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'btn_label_two',
            [
                'label' =>esc_html__( 'Button Label Two', 'crowdmerc' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'invest Now', 'crowdmerc' ),
                'default' =>esc_html__( 'invest Now', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        
        $this->add_control(
            'show_fundbar',
            [
                'label' =>esc_html__( 'Show Funded Bar', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'show_funded_price',
            [
                'label' =>esc_html__( 'Show Funded Price', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'show_goal_price',
            [
                'label' =>esc_html__( 'Show Goal Price', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' =>esc_html__( 'Style', 'crowdmerc' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' =>esc_html__( 'Title Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fundpress-welcome-title h2.color-navy-blue' => 'color: {{VALUE}};',
                    '{{WRAPPER}} h2.xs-welcome-slider-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'title_typography',
                'selector'	 => '{{WRAPPER}} .fundpress-welcome-title h2.color-navy-blue, {{WRAPPER}} h2.xs-welcome-slider-title',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' =>esc_html__( 'Price Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.fundpress-welcome-list-content .woocommerce-Price-amount.amount' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.fundpress-welcome-list-content li span.woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'price_label_color',
            [
                'label' =>esc_html__( 'Price Label Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .fundpress-welcome-list-content li span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn_one_style',
            [
                'label' =>esc_html__( 'Button One Style', 'crowdmerc' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' =>esc_html__( 'Button Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.blue-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' =>esc_html__( 'Button Hover Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.blue-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' =>esc_html__( 'Button Bg Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.blue-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label' =>esc_html__( 'Button Bg Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.blue-btn:before' => 'border-bottom: 100px solid {{VALUE}};',
                    '{{WRAPPER}} .xs-btn.blue-btn:after' => 'border-top: 100px solid {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'show_border',
            [
                'label' =>esc_html__( 'Show Border', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
            ]
        );
        $this->add_control(
            'btn_text_color',
            [
                'label' =>esc_html__( 'Border Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.blue-btn.xs-outline' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_border' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn_two_style',
            [
                'label' =>esc_html__( 'Button Two Style', 'crowdmerc' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_two_color',
            [
                'label' =>esc_html__( 'Button Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.navy-blue-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_two_hover_color',
            [
                'label' =>esc_html__( 'Button Hover Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.navy-blue-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_two_bg_color',
            [
                'label' =>esc_html__( 'Button Bg Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.navy-blue-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_two_bg_hover_color',
            [
                'label' =>esc_html__( 'Button Bg Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-btn.navy-blue-btn:before' => 'border-bottom: 100px solid {{VALUE}};',
                    '{{WRAPPER}} .xs-btn.navy-blue-btn:after' => 'border-top: 100px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_border_two',
            [
                'label' =>esc_html__( 'Show Border', 'crowdmerc' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Show', 'crowdmerc' ),
                'label_off' =>esc_html__( 'Hide', 'crowdmerc' ),
            ]
        );
        $this->add_control(
            'btn_text_color_two',
            [
                'label' =>esc_html__( 'Border Color', 'crowdmerc' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.navy-blue-btn.xs-outline' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_border_two' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $xs_post = $settings['xs_post'];
        $style = $settings['style'];
        $slider_products = $settings['slider_products'];

        ?>
        <?php if($style == 'style1'): ?>
        <?php
            if($xs_post != 0){
                $xs_query = get_post($xs_post);
            }else{
                return;
            }
            $total_raised = wf_get_total_fund_raised_by_campaign($xs_post);
            $funding_goal   = wf_get_total_goal_by_campaign($xs_post);
            $image_link = wp_get_attachment_url(get_post_thumbnail_id($xs_post));
            $percent = wf_get_fund_raised_percent($xs_post);
            $btn_label = $settings['btn_label'];
            $btn_label_two = $settings['btn_label_two'];
            $btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
            $btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
            $show_border = $settings['show_border'];
            $show_border_two = $settings['show_border_two'];
            $show_fundbar = $settings['show_fundbar'];
            $show_funded_price = $settings['show_funded_price'];
            $show_goal_price = $settings['show_goal_price'];
            $external_link = $settings['external_link'];
            $xs_page = $settings['xs_page'];
            $wrapper_class = '';
            $wrapper_class_two = '';
            if($show_border == 'yes'){
                $wrapper_class = 'xs-outline';
            }
            if($show_border_two == 'yes'){
                $wrapper_class_two = 'xs-outline';
            }
        ?>
        <div class="xs-welcome-section xs-bg fundpress-welcome-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="xs-welcome-content fundpress-welcome-content">
                            <div class="fundpress-welcome-wraper">
                                <div class="xs-welcome-title fundpress-welcome-title">
                                    <h2 class="color-navy-blue"><?php echo esc_html($xs_query->post_title); ?></h2>
                                </div>
                                <?php if($show_fundbar == 'yes'): ?>
                                    <div class="xs-skill-bar-v2" data-percent="<?php echo esc_attr($percent); ?>%">
                                        <div class="xs-skill-track">
                                            <p><span class="number-percentage-count"><?php echo esc_attr($percent); ?></span>%</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <ul class="xs-list-with-content fundpress-welcome-list-content">
                                    <?php if($show_funded_price == 'yes'): ?>
                                        <li><?php echo wc_price( $total_raised );?><span><?php echo esc_html__( 'Recaudado','crowdmerc' );?></span></li>
                                    <?php endif; ?>
                                    <?php if($show_goal_price == 'yes'): ?>
                                        <li><?php echo  wc_price( $funding_goal ); ?><span><?php echo esc_html__( 'Meta', 'crowdmerc' ) ?></span></li>
                                    <?php endif; ?>
                                </ul>
                                <div class="xs-btn-wraper">
                                    <a href="<?php echo esc_url(get_the_permalink($xs_post)) ?>" class="xs-btn round-btn navy-blue-btn icon-btn <?php echo esc_attr($wrapper_class_two); ?>"><i class="fa fa-heart"></i><?php echo esc_html($btn_label_two); ?></a>
                                    <?php 
                                    if(!empty($btn_label)):
                                        if($external_link == 'yes'){
                                            $btn_link = $btn_link;
                                        }else{
                                            $btn_link = get_the_permalink( $xs_page );

                                        }
                                    ?>    
                                        <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="xs-btn round-btn blue-btn icon-btn <?php echo esc_attr($wrapper_class); ?>"><?php echo esc_html($btn_label); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="xs-welcome-content">
                            <div class="fundpress-animate text-center">
                                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>

            <div class="xs-welcome-section xs-bg fundpress-welcome-section xs-product-slider">
                <div class="xs-banner-slider owl-carousel">
                    <?php if(is_array($slider_products) && !empty($slider_products)): ?>
                    <?php foreach ($slider_products as $slider_product): ?>
                            <?php
                            $xs_post = $slider_product['xs_featured_pro'];
                            if($xs_post != 0){
                                $xs_query = get_post($xs_post);
                            }else{
                                return;
                            }
                            $total_raised = wf_get_total_fund_raised_by_campaign($xs_post);
                            $funding_goal   = wf_get_total_goal_by_campaign($xs_post);
                            $percent = wf_get_fund_raised_percent($xs_post);
                            $show_fundbar = $settings['show_fundbar'];
                            $btn_label = $slider_product['btn_labels'];
                            $img = '';
                            if(isset($slider_product['xs_image']['url'])){
                                $img = $slider_product['xs_image']['url'];
                            }
                            ?>
                            <div class="xs-banner-slider-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="xs-welcome-content version-3">
                                                <div class="xs-welcome-wraper">
                                                    <h2 class="xs-welcome-slider-title"><?php echo esc_html($xs_query->post_title); ?></h2>
                                                    <?php if($show_fundbar == 'yes'): ?>
                                                        <div class="xs-skill-bar-v2" data-percent="<?php echo esc_attr($percent); ?>%">
                                                            <div class="xs-skill-track">
                                                                <p><span class="number-percentage-count"><?php echo esc_attr($percent); ?></span>%</p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <ul class="fundpress-welcome-list-content list-inline">
                                                        <li><?php echo wc_price( $total_raised );?><span class="d-block"><?php echo esc_html__( 'Recaudado','crowdmerc' );?></span></li>
                                                        <li><?php echo  wc_price( $funding_goal ); ?><span class="d-block"><?php echo esc_html__( 'Meta', 'crowdmerc' ) ?></span></li>
                                                    </ul>
                                                    <?php if(!empty($btn_label)): ?>
                                                        <div class="xs-btn-wraper">
                                                            <a href="<?php echo esc_url(get_the_permalink($xs_post)) ?>" class="xs-btn navy-blue-btn round-btn"><?php echo esc_html($btn_label); ?></a>
                                                        </div>
                                                    <?php endif;  ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="xs-welcome-content">
                                                <div class="fundpress-animate text-center">
                                                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($xs_query->post_title); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php
        wp_reset_postdata();
    }

    protected function _content_template() { }
}
<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Partner_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-partner';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Logo Carousel', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Crowdmerc Logo Carousel', 'crowdmerc'),
            ]
        );
        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Select Style', 'crowdmerc' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                    'style1'     => esc_html__( 'Style 1', 'crowdmerc' ),
                    'style2'     => esc_html__( 'Style 2', 'crowdmerc' ),
                ],
                'default' => 'style1'
            ]
        );
        $this->add_control(
            'logo_partner',
            [
                'type' => Controls_Manager::REPEATER,
                'default'   => [
                    'partner_image' => Utils::get_placeholder_image_src(),
                    'btn_link'  => '#',
                    
                ],
                'fields' => [
                    [
                        'name'          => 'partner_image',
                        'label'         => esc_html__( 'Images', 'crowdmerc' ),
                        'type'          => Controls_Manager::MEDIA,
                        'default' => [
                                'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name'  =>  'btn_link',
                        'label' =>esc_html__( 'Link', 'crowdmerc' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' =>esc_html__('http://your-link.com','crowdmerc' ),
                        'default' => [
                            'url' => '#',
                        ],
                    ],

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
          $settings = $this->get_settings();
          $logo_partner = $settings['logo_partner'];
          $style = $settings['style'];
          ?>
          <?php if($style == 'style1'):?>
            <div class="content-center">
                <ul class="fundpress-partners">
                    <?php 
                    foreach($logo_partner as $logo_partners): 
                        $btn_link = (! empty( $logo_partners['btn_link']['url'])) ? $logo_partners['btn_link']['url'] : '';
                        $btn_target = ( $logo_partners['btn_link']['is_external']) ? '_blank' : '_self';
                        $image = $logo_partners['partner_image'];
                        if(isset($image['url']) && !empty($image['url'])){
                            $image = $image['url'];
                        }
                    ?>
                        <li><a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="full-round fundpress-single-partner"><img src="<?php echo esc_url($image); ?>"></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
          <?php else: ?>
        <div class="row">
            <?php
            foreach($logo_partner as $logo_partners):
                $btn_link = (! empty( $logo_partners['btn_link']['url'])) ? $logo_partners['btn_link']['url'] : '';
                $btn_target = ( $logo_partners['btn_link']['is_external']) ? '_blank' : '_self';
                $image = $logo_partners['partner_image'];
                if(isset($image['url']) && !empty($image['url'])){
                    $image = $image['url'];
                }
            ?>
                <div class="col-lg-3 text-center">
                    <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="fundpress-single-sponsor-v2">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
          <?php
        endif;
    }

    protected function _content_template() { }
}
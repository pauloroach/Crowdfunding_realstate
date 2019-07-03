<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Team_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-team';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Team', 'crowdmerc' );
    }

    public function get_icon() {
        return 'fa fa-user-o';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Crowdmerc Team', 'crowdmerc'),
            ]
        );

        /**
         *
         * Member Content Feild
         *
        */

        $this->add_control(

            'member_name', 
            [

                'label' =>esc_html__('Team Member', 'crowdmerc'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Team Member', 'crowdmerc'),
                
            ]
        );

        $this->add_control(

            'member_position', 
            [

                'label' =>esc_html__('Position', 'crowdmerc'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('CEO', 'crowdmerc'),
                
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
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' =>esc_html__( 'Image Size', 'crowdmerc' ),
                'default' => 'full',
            ]
        );

        $this->add_control(

            'member_show_social', 
            [
                'label'         =>esc_html__( 'Show Social', 'crowdmerc' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'label_on'      =>esc_html__( 'Yes', 'crowdmerc' ),
                'label_off'     =>esc_html__( 'No', 'crowdmerc' ),
                
            ] 
        );

        $this->add_control(
            'facebook_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Facebook URL', 'crowdmerc'),
                'description' =>esc_html__('URL of the Facebook of the team member.', 'crowdmerc'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
                
            ]
        );

        $this->add_control(
            'twitter_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Twitter URL', 'crowdmerc'),
                'description' =>esc_html__('URL of the Twitter of the team member.', 'crowdmerc'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
                
            ]
        );

        $this->add_control(
            'dribbble_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Dribbble URL', 'crowdmerc'),
                'description' =>esc_html__('URL of the Dribbble of the team member.', 'crowdmerc'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label'     =>esc_html__( 'Team Style', 'crowdmerc' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        /**
         *
         * Normal Style
         *
         */

        $this->add_control(
            'member_name_color',
            [
                'label'     =>esc_html__( 'Name color', 'crowdmerc' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fundpress-team-details p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'member_pos_color',
            [
                'label'     =>esc_html__( 'Possition color', 'crowdmerc' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fundpress-team-details h5' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {

        $settings = $this->get_settings();
        $member_name = $settings['member_name'];
        $member_position = $settings['member_position'];
        $member_show_social = $settings['member_show_social'];
        $dribbble = $settings['dribbble_url'];
        $fb = $settings['facebook_url'];
        $tw = $settings['twitter_url'];

        ?>
        <div class="xs-box-shadow  fundpress-single-team-member">
            <div class="fundpress-item-header">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                <?php if($member_show_social): ?>
                    <div class="xs-hover-content fundpress-hover-content text-center">
                        <ul class="xs-social-list fundpress-social-list xs-social-list-v2">
                            <?php if(!empty($fb)): ?>
                                <li><a href="<?php echo esc_url($fb); ?>" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($tw)): ?>
                                <li><a href="<?php echo esc_url($tw); ?>" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>    
                            <?php if(!empty($dribbble)): ?>
                                <li><a href="<?php echo esc_url($dribbble); ?>" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!--fundpress-item-header -->
            <div class="xs-item-footer xs-content-padding bg-color-white  fundpress-team-details text-center">
                <p class="color-navy-blue">
                    <?php echo esc_html( $member_name ); ?>
                </p>
                <h5 class="color-green"> <?php echo esc_html( $member_position ); ?></h5>
            </div>
        </div>
        <?php

    }

    protected function _content_template() { }
}
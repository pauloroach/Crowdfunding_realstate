<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Crowdfunding_Cat_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-crowdfunding-cat-grid';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Crowdfunding Category', 'crowdmerc' );
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
                'label' => esc_html__('Category element', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'xs_crowdfund_cat',
            [
                'label'    =>esc_html__( 'Select category', 'marketpress' ),
                'type'     => Controls_Manager::SELECT2,
                'options'  => xs_category_list( 'product_cat' ),
                'multiple'  => 'true'
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $xs_cats = $settings['xs_crowdfund_cat'];
        $color_array = array(
            '#0083d8',
            '#223d5b',
            '#F89201',
            '#00a439',
            '#00cec9',
            '#6c5ce7',
            '#ff4757',
            '#e17055',
        );
        ?>
        <?php if(is_array($xs_cats) && $xs_cats != ''): ?>
            <div class="row">
                <?php foreach($xs_cats as $key => $xs_cat): ?>
                    <?php
                    $bg_color = isset($color_array[$key]) ? $color_array[$key] : $color_array[rand(0,7)];
                    $xs_icon = '';
                    if(defined('FW')) {
                        $xs_icon = fw_get_db_term_option($xs_cat, 'product_cat', 'xs_product_cat');
                    }
                    ?>
                    <?php
                        $cat_name = get_term_by( 'id', $xs_cat, 'product_cat' );
                        $cat_desc = category_description( $xs_cat );
                    ?>

                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo esc_url(get_category_link($xs_cat)) ?>">
                            <div class="xs-category-wraper" >
                                <i class="<?php echo esc_attr($xs_icon); ?>" style="background-color:<?php echo esc_attr($bg_color); ?>"></i>
                                <h4 class="category-title" ><?php echo esc_html($cat_name->name); ?></h4>
                                <p><?php echo wp_kses_post($cat_desc); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php
    }

    protected function _content_template() {

    }
}
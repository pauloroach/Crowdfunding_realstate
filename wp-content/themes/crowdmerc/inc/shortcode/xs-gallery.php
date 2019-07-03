<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-gallery';
    }

    public function get_title() {
        return esc_html__( 'Crowdmerc Gallery', 'crowdmerc' );
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
                'label' =>esc_html__('Crowdmerc Gallery', 'crowdmerc'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Image', 'crowdmerc' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

		$this->end_controls_section();
        
    }

    protected function render( ) {
    	
        $settings = $this->get_settings();
        $images = $settings['image'];
        ?>
        <div class="xs-portfolio-isotope-grid">
        	<?php foreach($images as $image): ?>
                <?php $image = wp_get_attachment_image_src( $image['id'], 'full' ); ?>
	        	<div class="xs-portfolio-isotope-grid-item xs-padding-15">
					<a href="<?php echo esc_url($image[0]); ?>" class="xs-box-shadow  fundpress-portfolio-grid-item  xs-image-popup">
						<div class="xs-solid-overlay xs-bg-black"></div>
						<?php if(!empty($image)): ?>
							<img src="<?php echo esc_url($image[0]); ?>">
						<?php endif; ?>
					</a>
				</div>
			<?php endforeach; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}
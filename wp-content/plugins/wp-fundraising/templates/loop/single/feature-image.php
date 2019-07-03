<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $post, $woocommerce, $product;
?>
<div class="wf-product-preview clearfix">

    <div class="single-product-video">
        <?php
        if ($product->get_type() == 'wp_fundraising') { 
            $wf_funding_video = trim(get_post_meta($post->ID, '_wf_funding_video', true));
        }elseif ($product->get_type() == 'wf_donation') { 
            $wf_funding_video = trim(get_post_meta($post->ID, '_wfd_funding_video', true));
        }
        
        if (! empty($wf_funding_video)){
            getYoutubeImage($wf_funding_video);
            ?><div class="product-content">	
            <a href="<?php echo esc_url($wf_funding_video);?>" class="xs-video-popup video-popup-btn">
                <i class="icon-play"></i>
            </a>
        </div><?php
        } else {
            if (has_post_thumbnail()) {
                $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                
                /**
                 * WooCommerce deprecated support since @var 3.0
                 */
                if (wf_wc_version_check()) {
                    $attachment_count = $product->get_gallery_image_ids();
                }else{
                    $attachment_count = count($product->get_gallery_attachment_ids());
                }


                if ($attachment_count > 0) {
                    $gallery = '[product-gallery]';
                } else {
                    $gallery = '';
                }

                ?><img src="<?php echo esc_url($image_link);?>" alt=""><?php

            } else {
                echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), __('Placeholder', 'wp-fundraising')), $post->ID);
            }
        }
        ?>


    </div>
    <div class="wf-product-thumbnail">
        <ul class="product-thumbnail-lsit clearfix">
        <?php
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();
            if ( $attachment_ids && has_post_thumbnail() ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    $img_src = wp_get_attachment_image_src( $attachment_id  );
                    ?><li><a href="<?php echo esc_url($img_src[0]);?>" class="xs-image-popup"><img src="<?php echo esc_url($img_src[0]);?>" alt=""></a></li><?php
                }
            } ?>
        </ul>
    </div>
    <?php do_action( 'wf_after_feature_img' ); ?>
</div>
<?php
/**
 * Page Header
 *
 */

$header_title = crowdmerc_option('shop_heading_title', crowdmerc_defaults('shop_heading_title'));
$banner = crowdmerc_option('shop_header_image', '');
$show_breadcrumb = crowdmerc_option('shop_show_breadcrumb', crowdmerc_defaults('shop_show_breadcrumb'));
if(empty($banner)){
    $banner = CROWDMERC_IMAGES_DIR_URI.'/background/progress_bg.jpg';
}
if(is_single()){
    $header_title = get_the_title();
}

?>
<!-- welcome section -->
<section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url($banner); ?>">
    <div class="xs-solid-overlay xs-bg-black"></div>
    <div class="container">
        <div class="fundpress-inner-welcome-content">
                <h2 class="color-white shop-title"><?php echo esc_html($header_title); ?></h2>
            <?php
            if($show_breadcrumb) {
                echo crowdmerc_get_breadcrumbs(' / ');
            }
            ?>
        </div>
    </div>
</section>
<!-- End welcome section -->

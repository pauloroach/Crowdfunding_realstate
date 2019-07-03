<?php
/**
 * Page Header
 *
*/
$show_breadcrumb = crowdmerc_option('show_breadcrumb', crowdmerc_defaults('show_breadcrumb'));
$header_title = '';
$banner = CROWDMERC_IMAGES_DIR_URI.'/background/progress_bg.jpg';
$overlay = '';

if ( defined( 'FW' ) ) {
    $header_title	 = fw_get_db_post_option( get_the_ID(), 'header_title' );
    $image	 = fw_get_db_post_option( get_the_ID(), 'header_image' );
    $overlay = fw_get_db_post_option( get_the_ID(), 'overlay' );
    if(!empty($image)) {
        $banner = $image['url'];
    }
}
if(is_search()){
    $header_title = 'Search Results for: '.get_search_query();
}
if(get_post_type() == 'event'){
    $header_title = get_the_title();
}
?>
<!-- welcome section -->
<section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url($banner); ?>">
	<div class="xs-solid-overlay xs-bg-black"></div>
		<div class="container">
			<div class="fundpress-inner-welcome-content">
				<?php if(!empty($header_title)): ?>
					<h2 class="color-white"><?php echo esc_html($header_title); ?></h2>
				<?php endif; ?>
                <?php
                    if($show_breadcrumb) {
                        echo crowdmerc_get_breadcrumbs(' / ');
                    }
                ?>
			</div>
		</div>
</section>
<!-- End welcome section -->

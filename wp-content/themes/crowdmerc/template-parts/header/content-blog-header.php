<?php
/**
 * Blog Header
 *
 */
$heading_title =  $header_image = '';
if ( defined( 'FW' ) ) {
    $heading_title	 = fw_get_db_post_option( get_the_ID(), 'header_title' );
    $header_image    = fw_get_db_post_option(get_the_ID(), 'header_image' );
}
$blog_title = crowdmerc_option('blog_heading_title', crowdmerc_defaults('blog_heading_title'));
$banner = crowdmerc_option('blog_banner_img', '');
$show_breadcrumb = crowdmerc_option('blog_show_breadcrumb', crowdmerc_defaults('blog_show_breadcrumb'));

if ( is_single() ) {
    $heading = $heading_title != '' ? $heading_title : $blog_title;
    $banner = $header_image != '' ? $header_image['url'] : '';
}else{
    $heading = $blog_title;
}
if(empty($banner)){
    $banner = CROWDMERC_IMAGES_DIR_URI.'/background/progress_bg.jpg';
}
if(!empty($heading_title)){
	$heading_title = get_the_title( );
}
if(is_front_page()){
	$heading_title = esc_html__('Home','crowdmerc');
}
?>
<section class="xs-inner-welcome-section fundpress-inner-welcome-section parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $banner );?>">
	<div class="xs-solid-overlay xs-bg-black"></div>
	<div class="container">
		<div class="fundpress-inner-welcome-content fundpress-bolog">
			<h2 class="color-white"><?php echo esc_html( $heading ); ?></h2>
			<?php  
				if($show_breadcrumb) {
					echo crowdmerc_get_breadcrumbs(' / ');
				}
			?>
		</div>
	</div>
</section> 

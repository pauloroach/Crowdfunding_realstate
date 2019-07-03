<?php
/**
 * index.php
 *
 * The main template file.
 */
get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = crowdmerc_option('blog_sidebar', crowdmerc_defaults('blog_sidebar'));
$blog_style = crowdmerc_option('blog_style', crowdmerc_defaults('blog_style'));
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12';
$wrapper_class = '';
if($blog_style != 'style1'){
    $wrapper_class = 'row';
}
?>
<div id="main-container" class="xs-content-section-padding xs-all-content-wrapper" role="main">
	<div class="container">
		<div class="row">
			<?php
			if($sidebar == 2){
				get_sidebar();
			}
			?>
			<div class="<?php echo esc_attr($column); ?>">
				<!-- 1st post start -->
				<div class="xs-blog-details-wraper <?php echo esc_attr($wrapper_class); ?>">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/post/layout',  $blog_style ); ?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
					<?php endif; ?>
				</div>
				<?php crowdmerc_paging_nav(); ?>
			</div><!-- Content Col end -->
			<?php
			if($sidebar == 3){
				get_sidebar();
			}
			?>
		</div><!-- Main row end -->
	</div><!-- Container end -->
</div><!-- Main container end -->

<?php get_footer(); ?>


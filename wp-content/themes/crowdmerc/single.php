<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
$sidebar = crowdmerc_option('blog_single_sidebar', crowdmerc_defaults('blog_single_sidebar'));
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12';
?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/header/content', 'blog-header' ) ?>

<main class="xs-all-content-wrapper">
	<div class="xs-content-section-padding xs-blog-single" role="main">
		<div class="container">
			<div class="row">
				<?php
				if ( $sidebar == 2 ) {
					get_sidebar();
				}
				?>
				<div class="<?php echo esc_attr( $column ); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('post-layout'); ?>>
							<?php get_template_part( 'template-parts/post/content-single',  get_post_format() ); ?>
						</article>
						<?php
                        if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					<?php endwhile; ?>
				</div>
				<?php
				if ( $sidebar == 3 ) {
					get_sidebar();
				}
				?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
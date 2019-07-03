<?php
/**
 * template-full-width.php
 *
 * Template Name: Full Width Page
 */

?>

<?php
get_header();
get_template_part( 'template-parts/header/content', 'page-header' );
$show_fixed_footer = crowdmerc_option( 'show_fixed_footer',crowdmerc_defaults('show_fixed_footer') );
$fixed_footer = '';
if($show_fixed_footer){
    $fixed_footer = 'xs-all-content-wrapper';
}
?>
<div class="blog <?php echo esc_attr($fixed_footer); ?>" role="main">
    <div class="xs-content-section-padding main-content full-width">
		<?php while ( have_posts() ) : the_post(); ?>
				<!-- full-width-content -->
				<div id="post-<?php the_ID(); ?>" <?php post_class('full-width-content');?>>
					<?php the_content(); ?>

				</div> <!-- end full-width-content -->
		<?php endwhile; ?>
    </div> <!-- end main-content -->
</div> <!-- end main-content -->
<?php get_footer(); ?>
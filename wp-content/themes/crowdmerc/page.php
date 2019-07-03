<?php
/**
 * page.php
 *
 * The template for displaying all pages.
 */
?>

<?php get_header(); ?>

<?php
get_template_part( 'template-parts/header/content', 'page-header' );
$sidebar = crowdmerc_option('page_sidebar', crowdmerc_defaults('page_sidebar'));
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12';
?>
<div class="main-content xs-all-content-wrapper">
	<div class="xs-content-section-padding">
	    <div class="container">
	        <div class="row">
	        	<?php
				if($sidebar == 2){
					get_sidebar();
				}
				?>
	            <div class="<?php echo esc_attr($column); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <header class="entry-header"> <?php
                                if ( has_post_thumbnail() && !post_password_required() ) :
                                    ?>
                                    <figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
                                <?php endif; ?>

                                <h2><?php the_title(); ?></h2>
                            </header> <!-- end entry-header -->

							<!-- end entry-header -->

							<!-- Article content -->
							<div class="entry-content">
								<?php the_content(); ?>

								<?php crowdmerc_link_pages(); ?>
							</div> <!-- end entry-content -->
							<?php
	                        if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>
						</article>
					<?php endwhile; ?>
	            </div> <!-- end main-content -->
	            <?php
				if($sidebar == 3){
					get_sidebar();
				}
				?>
	        </div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>
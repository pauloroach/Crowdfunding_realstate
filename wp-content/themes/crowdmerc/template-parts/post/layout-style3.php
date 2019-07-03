<?php 
$count_col = crowdmerc_option('blog_grid_column', crowdmerc_defaults('blog_grid_column'));
$sidebar = crowdmerc_option('blog_sidebar', crowdmerc_defaults('blog_sidebar'));
if($sidebar != 1){
	$count_col = 6;
}
?>
<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
	<div class="xs-mb-30 xs-box-shadow fundpress-from-journal">
		<div class="fundpress-item-header entry-thumbnail">
			<?php
            if(has_post_thumbnail()):
              $img = \xs_resize( get_post_thumbnail_id( $wp_query->ID ), 360, 208 );
          	?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
          	<?php endif; ?>
		</div>
		<div class="fundpress-item-content xs-content-padding bg-color-white">
			<div class="entry-header">
				<div class="post-meta">
					<div class="xs_category">
						<?php echo get_the_category_list( ', '); ?>
					</div>
					
				</div>
				<h4 class="entry-title">
					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xs-post-title color-navy-blue fundpress-post-title"><?php echo get_the_title(); ?></a>
				</h4>
			</div>

			<div class="entry-content">
				<p class="xs-content-description fundpress-content-description"><?php echo wp_kses_post(wp_trim_words(get_the_content(),30,'')) ?></p>
			</div>
		</div><!-- .fundpress-item-content END -->
	</div>
</div>
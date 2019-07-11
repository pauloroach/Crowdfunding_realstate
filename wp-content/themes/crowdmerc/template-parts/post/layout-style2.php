<?php
$terms  = get_the_terms( get_the_ID(), 'category' );
if ( $terms && ! is_wp_error( $terms ) ) :
  $cat_temp = '';
  foreach ( $terms as $term ) {
      $cat_temp .= '<a href="'.get_category_link($term->term_id).'" class="xs-blog-meta-tag green-bg bold color-white xs-border-radius" rel="category tag">'.$term->name.'</a>';
  }
endif;

$count_col = crowdmerc_option('blog_grid_column', crowdmerc_defaults('blog_grid_column'));
$sidebar = crowdmerc_option('blog_sidebar', crowdmerc_defaults('blog_sidebar'));
if($sidebar != 1){
	$count_col = 6;
}
?>
<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
	<div class="xs-mb-30 xs-box-shadow fundpress-from-journal xs-border-radius">
		<div class="fundpress-item-header entry-thumbnail">
		    <?php
            if(has_post_thumbnail()):
              $img = \xs_resize( get_post_thumbnail_id(get_the_ID()), 360, 208 );
          	?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
          <?php endif; ?>
		</div><!-- .fundpress-item-header END -->
		<div class="fundpress-item-content xs-content-padding bg-color-white">
			<div class="entry-header xs-mb-30">
				<div class="post-author">
					<ul class="xs-simple-tag xs-simple-tag-v2 fundpress-simple-tag author-links">
						<li><span><?php echo esc_html__('Por','crowdmerc') ?></span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" rel="author"><?php echo get_the_author_meta( 'nickname' ); ?></a></li>
					</ul>
				</div>
				<h4 class="entry-title">
					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xs-mb-0 xs-post-title color-navy-blue fundpress-post-title"><?php echo get_the_title(); ?></a>
				</h4>
			</div>

			<span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor xs-mb-20"></span>

			<div class="entry-content xs-spilit-container xs-footer-content">
				<div class="xs-col-6 text-left">
					<span class="date">
						<span>
							<i class="fa fa-calendar"></i>
							<span class="entry-date xs-entry-date"><?php echo get_the_date(); ?></span>
						</span>
					</span>
				</div>
				<div class="xs-col-6 text-right">
					<span class="categories-links">
						<?php echo wp_kses_post($cat_temp); ?>
					</span>
				</div>
			</div>
		</div><!-- .fundpress-item-content END -->
	</div>
</div>
<article class="post format-standard">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-media post-image">
            <?php the_post_thumbnail( 'post-thumbnail' ); ?>
        </div>
    <?php endif; ?>

    <div class="post-body xs-content-padding xs-style-border">
		<div class="entry-header row xs-mb-30">
			<div class="col-md-2 xs-padding-0">
				<?php crowdmerc_post_meta_left(); ?>
			</div>
			<div class="col-md-10 xs-padding-0">
				<div class="post-meta xs-mb-20 xs-post-meta-list">

					<?php
					if ( get_post_type() === 'post' ) {
						if ( is_sticky() ) {
							echo '<span class="meta-featured-post"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Featured', 'crowdmerc' ) . ' </span>';
						}
					}
						$category_list = get_the_category_list( ', ' );
						if ( $category_list ) {
							echo '<span class="post-cat xs-font-alt"> <i class="fa fa-folder-open"></i>   ' . $category_list . ' </span>';
						}
					?>
				</div>
				<h2 class="entry-title"><a class="color-navy-blue bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="xs-entry-content entry-content xs-font-alt">
					<?php crowdmerc_content_read_more( '35' ); ?>
				</div>
			</div>
		</div>
		<div class="post-footer text-right">
			<a href="<?php echo get_the_permalink() ?>" class="xs-btn round-btn navy-blue-btn"><?php echo esc_html__( 'Continue Reading', 'crowdmerc' ); ?></a>
		</div>
	</div><!-- post-body end -->
</article><!-- post end -->
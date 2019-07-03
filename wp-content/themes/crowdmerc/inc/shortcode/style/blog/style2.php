<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
	<div class="xs-box-shadow fundpress-from-journal xs-border-radius">
		<div class="fundpress-item-header entry-thumbnail">
		    <?php
            if(has_post_thumbnail()):
                $img = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ),'full');
                $img = $img[0];
          	?>
                <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
          <?php endif; ?>
		</div><!-- .fundpress-item-header END -->
		<div class="fundpress-item-content xs-content-padding bg-color-white">
			<div class="entry-header">
				<div class="post-author">
					<ul class="xs-simple-tag xs-simple-tag-v2 fundpress-simple-tag author-links xs-style-2">
                        <li><span><i class="icon icon-user2" aria-hidden="true"></i></span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" rel="author"><?php echo get_the_author(); ?></a></li>
                        <li class="pull-right"><span class="date"><i class="fa fa-calendar"></i></span><span class="xs-date"><?php echo get_the_date(); ?></span></li>
					</ul>
				</div>
				<h4 class="entry-title">
					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xs-mb-0 xs-post-title color-navy-blue fundpress-post-title"><?php echo get_the_title(); ?></a>
				</h4>
                <p><?php echo wp_kses_post(wp_trim_words(get_the_content(),30,'')) ?></p>
			</div>
		</div><!-- .fundpress-item-content END -->
	</div>
</div>
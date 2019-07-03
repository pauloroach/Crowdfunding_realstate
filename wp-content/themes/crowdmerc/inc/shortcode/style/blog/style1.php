<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
    <div class="xs-box-shadow fundpress-from-journal">
        <div class="xs-item-header fundpress-item-header entry-thumbnail">
              <?php
                if(has_post_thumbnail()):
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id(  get_the_ID()  ),'full');
                    $img = $img[0];
              ?>
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
              <?php endif; ?>
        </div>
        <div class="xs-item-content fundpress-item-content xs-content-padding bg-color-white">
            <div class="entry-header">
                <div class="post-meta">
                  <div class="xs-simple-tag fundpress-simple-tag">
                      <?php echo the_category( ' '); ?>
                  </div>
                </div>
                <h4 class="entry-title">
                    <a href="<?php echo get_the_permalink();  ?>" class="xs-post-title color-navy-blue fundpress-post-title"><?php the_title(); ?></a>
                </h4>
            </div>
            <p><?php echo wp_kses_post(wp_trim_words(get_the_content(),25,'')) ?></p>
        </div>
    </div>
</div>
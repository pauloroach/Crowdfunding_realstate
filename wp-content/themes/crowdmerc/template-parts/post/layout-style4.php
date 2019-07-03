<?php 
$count_col = crowdmerc_option('blog_grid_column', crowdmerc_defaults('blog_grid_column'));
$sidebar = crowdmerc_option('blog_sidebar', crowdmerc_defaults('blog_sidebar'));
if($sidebar != 1){
  $count_col = 6;
}
?>
<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
    <div class="xs-box-shadow fundpress-from-journal">
        <div class="xs-item-header fundpress-item-header entry-thumbnail">
              <?php
                if(has_post_thumbnail()):
                  $img = \xs_resize( get_post_thumbnail_id( $wp_query->ID ), 360, 208 );
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
            <a href="<?php echo get_the_permalink(); ?>" class="xs-btn round-btn navy-blue-btn"><?php echo esc_html__('learn more','crowdmerc') ?></a>
        </div>
    </div>
</div>
<?php
/**
 * index.php
 *
 * The main template file.
 */
get_header();

get_template_part( 'template-parts/header/content', 'page-header' );
$sidebar = crowdmerc_option('blog_sidebar', crowdmerc_defaults('blog_sidebar'));
$column = ($sidebar == 1 ) ? 'col-md-12' : 'col-md-12 col-lg-8';
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
                <div class="xs-blog-details-wraper">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/post/content', 'search' ); ?>
                        <?php endwhile; ?>
                        <?php crowdmerc_paging_nav(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>
                </div>
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


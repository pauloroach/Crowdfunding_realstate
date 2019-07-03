<?php
/**
 * template-right-sidebar.php
 *
 * Template Name: Right Sidebar Template
 */
?>

<?php get_header(); ?>

<?php
get_template_part( 'template-parts/header/content', 'page-header' );
?>
    <div class="xs-content-section-padding">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <!-- Article header -->
                                <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
                                    <header class="entry-header">
                                        <figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
                                    </header>
                                <?php endif; ?>
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
                    </div>
                    <?php
                    get_sidebar( 'page' );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
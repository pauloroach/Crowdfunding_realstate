<?php
/**
 * template-wp-fundraising.php
 *
 * Template Name: WP Fundraising Template
 */

?>


<?php get_header(); ?>
<?php
    /**
     * wf_template_before_main_content hook.
     *
     */
    do_action( 'wf_template_before_main_content' );
?>
<div class="wp-fundraising-template">
    <div class="container">
        <?php
            /**
             * wf_template_before_loop hook.
             *
             */
            do_action( 'wf_template_before_loop' );
        ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>

        <?php
            /**
             * wf_template_after_loop hook.
             *
             */
            do_action( 'wf_template_after_loop' );
        ?>
    </div>
</div>
<?php
    /**
     * wf_template_after_main_content hook.
     *
     */
    do_action( 'wf_template_after_main_content' );
?>
<?php get_footer(); ?>
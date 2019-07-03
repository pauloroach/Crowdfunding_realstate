<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<?php
    /**
     * wf_wc_before_main_loop hook.
     *
     */
    do_action( 'wf_wc_before_main_loop' );
?>

<?php while ( have_posts() ) : the_post(); ?>
    <main class="xs-all-content-wrapper">
    <!-- fund details -->
        <section class="xs-content-section-padding xs-fund-details fundpress-fund-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-7">
                        <?php wf_get_template_part('content-single-campaign');?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-5">
                        <div class="xs-sidebar-wraper">
                            <?php
                            /**
                             * wf_wc_after_main_content hook.
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                            do_action( 'wf_wc_after_main_content' );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
            /**
             * wf_wc_related_campaign hook.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'wf_wc_related_campaign' );
        ?>
    </main>
<?php endwhile; // end of the loop. ?>
<?php
    /**
     * wf_wc_after_main_loop hook.
     *
     */
    do_action( 'wf_wc_after_main_loop' );
?>
<?php get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
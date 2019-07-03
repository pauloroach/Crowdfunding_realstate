
<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */
 
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header('shop');
get_template_part( 'template-parts/header/content', 'shop-header' );
$sidebar = crowdmerc_option('shop_sidebar', crowdmerc_defaults('shop_sidebar'));
$shop_grid_column = crowdmerc_option('shop_grid_column', crowdmerc_defaults('shop_grid_column'));
$show_fixed_footer = crowdmerc_option( 'show_fixed_footer',crowdmerc_defaults('show_fixed_footer') );
$column = ($sidebar == 1 ) ? 'col-md-12' : 'col-md-12 col-lg-8';
if($sidebar != 1){
    $shop_grid_column = 6;
}
$fixed_footer = '';
if($show_fixed_footer){
    $fixed_footer = 'xs-all-content-wrapper';
}
?>
<div class="xs-content-section-padding fundpress-shop-inner-section <?php echo esc_attr($fixed_footer); ?>">
	<div class="container">
        <div class="row">
            <?php
            if($sidebar == 2){
                get_sidebar();
            }
            ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="row">
                    <?php
                        if (have_posts()):
                            while (have_posts()) :
                                the_post();
                                ?>
                                <div class="col-md-<?php echo esc_attr($shop_grid_column); ?>">
                                    <div class="fundpress-single-shop">
                                        <?php wc_get_template_part('content','loop-product'); ?>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        endif;
                    ?>
                </div>
                <?php crowdmerc_paging_nav(); ?>
            </div>
            <?php
            if($sidebar == 3){
                get_sidebar();
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer('shop');		
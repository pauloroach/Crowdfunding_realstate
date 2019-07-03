<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
    return;
}
$related = wc_get_related_products($product->get_id());

if(!$related){
    return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
    'post_type'            => 'product',
    'ignore_sticky_posts'  => 1,
    'no_found_rows'        => 1,
    'posts_per_page'       => 4,
    'orderby'              => 'date',
    'post__in'             => $related,
    'post__not_in'         => array( $product->get_id() )
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) : ?>
    <ul class="products">
    <?php 
        while($products->have_posts()):
            $products->the_post();
            $tw_product = wc_get_product(get_the_ID());
    ?>    
            <li class="product">
                <div class="col-md-3 col-sm-6">
                    <div class="premix-product-grid">
                        <div class="premix-product-grid-hover">
                            <?php if(has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>" alt="<?php echo esc_attr(get_the_title()); ?>" >
                            <?php endif;?>
                            <div class="premix-product-grid-hover-content">
                                <a href="<?php echo get_the_permalink(); ?>" class="premix-btn orange-btn hover-top"><?php echo esc_html__('Details','crowdmerc' ); ?></a>
                                <?php if(function_exists('woocommerce_template_loop_add_to_cart')): ?>
                                    <?php echo woocommerce_template_loop_add_to_cart(array('class'=>'button product_type_simple add_to_cart_button ajax_add_to_cart premix-btn orange-btn hover-bottom')); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="premix-product-details text-center">
                            <a href="<?php echo get_the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                            <p><?php echo crowdmerc_kses($product->get_price_html()); ?></p>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        endwhile;
    ?>
    </ul>
<?php endif;

wp_reset_postdata();
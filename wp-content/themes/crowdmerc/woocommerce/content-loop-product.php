<?php
	global $product;
	$terms = get_the_terms(get_the_ID(),'product_cat');
?>					
<?php 
	if(has_post_thumbnail()):
        echo woocommerce_get_product_thumbnail();
	endif;
?>
<div class="fundpress-item-content">
	<?php if(is_array($terms) && !empty($terms)): ?>
		<ul class="fundpress-simple-tag xs-font-size-extra">
			<?php foreach ( $terms as $term ): ?>
				<li><a href="<?php echo get_category_link( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<a href="<?php echo get_the_permalink(); ?>" class="xs-post-title color-navy-blue fundpress-post-title"><?php echo get_the_title(); ?></a>
	<div class="xs-mb-40 xs-price">
		<?php echo crowdmerc_kses($product->get_price_html()); ?>
	</div>

	<div class="xs-spilit-container">
		<div class="xs-btn-wraper xs-mr-10 xs-woo-shop-product-action-wrapper">
			<?php if(function_exists('woocommerce_template_loop_add_to_cart')): ?>
            	<?php echo woocommerce_template_loop_add_to_cart(); ?>
        	<?php endif; ?>
		</div>
        <?php if(defined('YITH_WCWL')): ?>
            <div class="xs-wishlist-wrapper">
                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
            </div>
        <?php endif; ?>
	</div>
</div>


	        				
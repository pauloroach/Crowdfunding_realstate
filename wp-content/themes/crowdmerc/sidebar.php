<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>


<div class="col-md-12 col-lg-4">
	<div class="xs-sidebar-content">
		<div class="sidebar-right" id="sidebar">
			<?php
            if ( class_exists( 'woocommerce' ) ) {
                if ( is_cart() || is_checkout() || is_account_page() || is_shop ()) {
                    dynamic_sidebar( 'sidebar-3' );
                } else {
                    dynamic_sidebar( 'sidebar-1' );
                }
            }else{
                dynamic_sidebar( 'sidebar-1' );
            }
			?>
		</div>
	</div>
</div>


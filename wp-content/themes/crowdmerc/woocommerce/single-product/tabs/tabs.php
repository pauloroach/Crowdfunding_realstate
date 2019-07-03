<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $tabs ) ) : ?>
<div class="xs-tab-nav fundpress-tab-nav-v2 xs-mb-30">
    <ul class="nav nav-tabs" role="tablist">
        <?php $l = 1; foreach ( $tabs as $key => $tab ) : ?>
            <li class="nav-item">
               <a class="nav-link <?php echo esc_attr( $key ); ?>_tab <?php if($l == 1) { echo 'active'; } ?>" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
            </li>
        <?php $l++; endforeach; ?>
    </ul>
    <div class="tab-content xs-text-tab-content">
        <?php $i = 1; foreach ( $tabs as $key => $tab ) : ?>
            <div role="tabpanel"  id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane fadeInRights fade <?php if($i == 1) { echo 'in active show'; } ?>">
                <?php call_user_func( $tab['callback'], $key, $tab ); ?>
            </div>
        <?php $i++; endforeach; ?>
    </div>
    <?php endif; ?>
</div>
                    
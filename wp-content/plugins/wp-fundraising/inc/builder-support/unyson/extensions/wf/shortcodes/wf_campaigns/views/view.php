<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$xs_post_cat = $args['cat'];
$count_col = $args['col'];
$post_count = $args['number'];
$styles = $args['style'] . '"';
$show_filter = $args['filter'];
$author = $args['author'];
$status = $args['show'];
$donation = $args['donation'];
?>
<div class="xs-wp-fundraising-listing-style-<?php echo esc_attr($styles);?>">
    <?php
    $style = ($styles == 4 ) ? $style = 1 : $style = $styles;
    echo do_shortcode('[wp_fundraising_listing cat="'.$xs_post_cat.'" number="' . $post_count . '" col="'.$count_col.'" style="'.$style.'" filter="'.$show_filter.'" "'.$author.'" donation="'.$donation.'" show="'.$status.'"]');
    ?>
</div>
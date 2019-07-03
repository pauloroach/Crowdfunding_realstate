<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class="fundpress-tab-nav xs-tab-nav">
	<ul class="nav nav-tabs" role="tablist">
<?php $tax_args = array(
    'taxonomy' => 'product_cat',
);

$categories = get_terms( $tax_args );
$i = 1;
foreach($categories as $category) { ?>
    <li class="nav-item">
        <a class="nav-link <?php ($i==1)? 'active' : ''?>" href="#<?php echo $category->slug; ?>" role="tab" data-toggle="tab"><?php echo $category->name; ?></a>
    </li>
<?php $i++; } ?>
    </ul>
</div>
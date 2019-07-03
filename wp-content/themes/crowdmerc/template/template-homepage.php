<?php

/*
 * Template Name: HomePage Template
 *  */

get_header();
get_template_part( 'template-parts/header/content', 'home-header' );
$show_fixed_footer = crowdmerc_option( 'show_fixed_footer',crowdmerc_defaults('show_fixed_footer') );
$fixed_footer = '';
if($show_fixed_footer){
    $fixed_footer = 'xs-all-content-wrapper';
}
?>
<div class="<?php echo esc_attr($fixed_footer); ?>">
    <div class="xs-home-content-section ">
    <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    ?>
    </div>
</div>
<?php
get_footer();



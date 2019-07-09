<?php
/**
 * header.php
 *
 * The header for the theme.
 */
?>

<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> data-spy="scroll" data-target="#header">


		<div class="body-inner">
            <?php $preloader = crowdmerc_option( 'show_preloader',crowdmerc_defaults('show_preloader') ); ?>
            <?php if($preloader): ?>
            <div id="preloader">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
                <!--
                <div class="preloader-cancel-btn-wraper">
                    <a href="#" class="xs-btn btn btn-primary preloader-cancel-btn">Cancel Preloader</a>
                </div>
                #preloader -->
            </div> 
            <?php endif; ?>
			<?php
            $nav_style = crowdmerc_option('header_style', crowdmerc_defaults('header_style'));
			get_template_part( 'template-parts/navigation/content', $nav_style );
			?>



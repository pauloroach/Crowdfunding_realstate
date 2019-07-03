<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
/**
 * Enqueue all theme scripts and styles
 *

  /** --------------------------------------
 * ** REGISTERING THEME ASSETS
 * ** ------------------------------------ */
/**
 * Enqueue styles.
 *
 */
if ( !is_admin() ) {
	wp_enqueue_style( 'crowdmerc-fonts', crowdmerc_google_fonts_url(), null, CROWDMERC_VERSION );
	wp_enqueue_style( 'pe-icon-7-stroke', CROWDMERC_CSS . '/pe-icon-7-stroke.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'iconfont', CROWDMERC_CSS . '/iconfont.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'font-awesome', CROWDMERC_CSS . '/font-awesome.min.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'bootstrap', CROWDMERC_CSS . '/bootstrap.min.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'isotope', CROWDMERC_CSS . '/isotope.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'magnific-popup', CROWDMERC_CSS . '/magnific-popup.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'owl-carousel', CROWDMERC_CSS . '/owl.carousel.min.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'owl-theme-default', CROWDMERC_CSS . '/owl.theme.default.min.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'animate', CROWDMERC_CSS . '/animate.css', null, CROWDMERC_VERSION );

	wp_enqueue_style( 'crowdmerc-customs', CROWDMERC_CSS . '/customs.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-xs-main', CROWDMERC_CSS . '/xs_main.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-style', CROWDMERC_CSS . '/style.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-blog', CROWDMERC_CSS . '/blog-style.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-custom-style', CROWDMERC_CSS . '/custom.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-responsive', CROWDMERC_CSS . '/responsive.css', null, CROWDMERC_VERSION );
	wp_enqueue_style( 'crowdmerc-gutenberg', CROWDMERC_CSS . '/gutenberg.css', null, CROWDMERC_VERSION );
}



/**
 * Enqueue scripts.
 */
if ( !is_admin() ) {
	$map_api_code	 = crowdmerc_option( 'map_api', crowdmerc_defaults( 'map_api' ) );
    $api_key		 = ($map_api_code != '') ? '?key=' . $map_api_code : '';
	//Bootstrap Main JS
	wp_enqueue_script( 'crowdmerc-customs', CROWDMERC_SCRIPTS . '/customs.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'wow', CROWDMERC_SCRIPTS . '/wow.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'Popper', CROWDMERC_SCRIPTS . '/Popper.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'bootstrap', CROWDMERC_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'isotope-pkgd', CROWDMERC_SCRIPTS . '/isotope.pkgd.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'jquery-countdown', CROWDMERC_SCRIPTS . '/jquery.countdown.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'jquery-magnific-popup', CROWDMERC_SCRIPTS . '/jquery.magnific-popup.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'owl-carousel', CROWDMERC_SCRIPTS . '/owl.carousel.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	if(!empty($api_key)){
		wp_enqueue_script( 'map-googleapis', 'https://maps.googleapis.com/maps/api/js' . $api_key, array( 'jquery' ), '', TRUE );
	}
	
	wp_enqueue_script( 'jquery-easypiechart', CROWDMERC_SCRIPTS . '/jquery.easypiechart.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'jquery-waypoints', CROWDMERC_SCRIPTS . '/jquery.waypoints.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'scrollax', CROWDMERC_SCRIPTS . '/scrollax.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	wp_enqueue_script( 'parallax', CROWDMERC_SCRIPTS . '/parallax.min.js', array( 'jquery' ), CROWDMERC_VERSION, true );
	//Theme CSS FILES
	wp_enqueue_script( 'crowdmerc-main', CROWDMERC_SCRIPTS . '/main.js', array( 'jquery' ), CROWDMERC_VERSION, true );


	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}



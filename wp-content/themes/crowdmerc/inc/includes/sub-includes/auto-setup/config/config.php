<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
return array(
	/**
	 * Array for demos
	 */
	'demos'				 => array(),
	'plugins'			 => array(
		array(
			'name'		 => esc_html__( 'Unyson', 'crowdmerc' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Elementor', 'crowdmerc' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Kirki', 'crowdmerc' ),
			'slug'		 => 'kirki',
			'required'	 => true,
		),
        array(
            'name'		 => esc_html__( 'Woocommerce', 'crowdmerc' ),
            'slug'		 => 'woocommerce',
            'required'	 => true,
        ),
		array(
			'name'		 => esc_html__( 'fundpress Feature', 'crowdmerc' ),
			'slug'		 => 'fundpress-features',
			'required'	 => true,
			'source'	 =>  CROWDMERC_PLUGINS_DIR . '/fundpress-features.zip' ,
		),
		array(
			'name'		 => esc_html__( 'WP Fundraising', 'crowdmerc' ),
			'slug'		 => 'wp-fundraising',
			'required'	 => true,
			'source'	 =>  CROWDMERC_PLUGINS_DIR . '/wp-fundraising.zip' ,
		),
        array(
            'name'		 => esc_html__( 'Contact Form 7', 'crowdmerc' ),
            'slug'		 => 'contact-form-7',
            'required'	 => true,
        ),
	),
	'theme_id'			 => 'crowdmerc',
	'child_theme_source' => CROWDMERC_PLUGINS_DIR . '/crowdmerc-child.zip' ,
	'has_demo_content'	 => true,
);

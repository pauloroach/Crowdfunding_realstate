<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config( 'crowdmerc_customizer', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );


function crowdmerc_customizer_sections($wp_customize){
    $wp_customize->add_panel( 'theme_option', array(
        'priority'    => 10,
        'title'       => esc_attr__( 'Theme Options', 'crowdmerc' ),
    ) );

	$wp_customize->add_section( 'general_section', array(
		'title'			=> esc_html__( 'General Settings', 'crowdmerc' ),
		'priority'		=> 1,
		'description'	=> esc_html__( 'to change logo,favicon etc', 'crowdmerc' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'nav_section', array(
		'title'			=> esc_html__( 'Navigation Settings', 'crowdmerc' ),
		'priority'		=> 2,
		'description'	=> esc_html__( 'Setting Your Menu', 'crowdmerc' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'page_section', array(
        'title'			=> esc_html__( 'Page Settings', 'crowdmerc' ),
        'priority'		=> 3,
        'description'	=> esc_html__( 'Setting Your Page', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'blog_section', array(
        'title'         => esc_html__( 'Blog Settings', 'crowdmerc' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Blog', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'blog_single_section', array(
        'title'         => esc_html__( 'Single Blog Settings', 'crowdmerc' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Singel Blog', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'shop_section', array(
        'title'         => esc_html__( 'Shop Settings', 'crowdmerc' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Shop page', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'footer_section', array(
        'title'			=> esc_html__( 'Footer Settings', 'crowdmerc' ),
        'priority'		=> 6,
        'description'	=> esc_html__( 'Setting Your Footer', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'styling_section', array(
        'title'			=> esc_html__( 'Styling Settings', 'crowdmerc' ),
        'priority'		=> 6,
        'description'	=> esc_html__( 'Setting Your font', 'crowdmerc' ),
        'panel'          => 'theme_option',
    ) );
}

add_action( 'customize_register', 'crowdmerc_customizer_sections' );

require CROWDMERC_CUSTOMIZER_DIR . 'customizer-fields.php' ;


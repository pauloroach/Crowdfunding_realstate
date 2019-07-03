<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_style',
    'label'       => esc_html__( 'Select Style', 'crowdmerc' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
      'style1'     => esc_html__( 'Blog listing', 'crowdmerc' ),
      'style2'     => esc_html__( 'Blog Grid Style 1', 'crowdmerc' ),
      'style3'     => esc_html__( 'Blog Grid Style 2', 'crowdmerc' ),
      'style4'     => esc_html__( 'Blog Grid Style 3', 'crowdmerc' ),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_grid_column',
    'label'       => esc_html__( 'Grid Per Row', 'crowdmerc' ),
    'section'     => 'blog_section',
    'default'     => '4',
    'choices'     => array(
      '6'     => esc_html__( '2 Column', 'crowdmerc' ),
      '4'     => esc_html__( '3 Column', 'crowdmerc' ),
    ),
    'required'      => array( 
        array( 
            'setting'   => 'blog_sidebar',
            'operator'  => '==',
            'value'     => 1 
        )
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'crowdmerc' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','crowdmerc'),
      '2'      => esc_html__('Left Sidebar','crowdmerc'),
      '3'      => esc_html__('Right Sidebar','crowdmerc'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'blog_show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'crowdmerc' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);

$fields[] = array(
        'type'        => 'image',
        'settings'    => 'blog_banner_img',
        'label'       => esc_html__( 'Banner Image', 'crowdmerc' ),
        'section'     => 'blog_section',
        'default'     => '',
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'blog_heading_title',
    'label'       => esc_html__( 'Heading Title', 'crowdmerc' ),
    'section'     => 'blog_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.fundpress-bolog h2',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'News Feeds', 'crowdmerc' ),
);

<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_single_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'crowdmerc' ),
    'section'     => 'blog_single_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','crowdmerc'),
      '2'      => esc_html__('Left Sidebar','crowdmerc'),
      '3'      => esc_html__('Right Sidebar','crowdmerc'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_author',
    'label'       => esc_html__( 'Show Author', 'crowdmerc' ),
    'section'     => 'blog_single_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_social',
    'label'       => esc_html__( 'Show Social', 'crowdmerc' ),
    'section'     => 'blog_single_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_category',
    'label'       => esc_html__( 'Show Category', 'crowdmerc' ),
    'section'     => 'blog_single_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_comment',
    'label'       => esc_html__( 'Show Comment', 'crowdmerc' ),
    'section'     => 'blog_single_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);
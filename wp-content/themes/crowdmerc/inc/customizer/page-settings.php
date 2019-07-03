<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'page_sidebar',
    'label'       => esc_html__( 'Page Sidebar Position', 'crowdmerc' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','crowdmerc'),
      '2'      => esc_html__('Left Sidebar','crowdmerc'),
      '3'      => esc_html__('Right Sidebar','crowdmerc'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'crowdmerc' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);
$fields[]= array(
  'type'      => 'dimensions',
  'settings'  => 'banner_padding',
  'label'     => esc_html__( 'Padding', 'crowdmerc' ),
  'section'   => 'page_section',
  'transport' => 'auto',
  'choices'   => array(
    'paddingTop' => esc_attr__( 'Padding Top', 'crowdmerc' ),
    'paddingBottom' => esc_attr__( 'Padding Bottom', 'crowdmerc' ),
  ),
  'output'    => array(
    array(
      'choice'      => 'paddingTop',
      'element'     => '.fundpress-inner-welcome-section .fundpress-inner-welcome-content',
      'property'    => 'padding-top',
    ),
    array(
      'choice'      => 'paddingBottom',
      'element'     => '.fundpress-inner-welcome-section .fundpress-inner-welcome-content',
      'property'    => 'padding-bottom',
    ),

  ),
  'default' => array(
    'paddingTop' => '340px',
    'paddingBottom' => '240px',
  ),
);

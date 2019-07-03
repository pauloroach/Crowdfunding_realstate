<?php
$fields[] = array(
	'type'        => 'image',
	'settings'    => 'site_logo',
	'label'       => esc_html__( 'Logo', 'crowdmerc' ),
	'section'     => 'general_section',
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_preloader',
    'label'       => esc_html__( 'Show Preloader', 'crowdmerc' ),
    'section'     => 'general_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'map_api',
    'label'       => esc_html__( 'Google Map API Key', 'crowdmerc' ),
    'section'     => 'general_section',

    'default'     =>  'AIzaSyCy7becgYuLwns3uumNm6WdBYkBpLfy44k',
);
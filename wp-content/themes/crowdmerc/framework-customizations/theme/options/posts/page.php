<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'_page_meta' => array(
		'title'		 => esc_html__( 'Page Settings', 'crowdmerc' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'crowdmerc' ),
				'desc'	 => esc_html__( 'Add your Page hero title', 'crowdmerc' ),
			),
			'header_image'	 => array(
				'label'	 => esc_html__( ' Banner Image', 'crowdmerc' ),
				'desc'	 => esc_html__( 'Upload a Page header image', 'crowdmerc' ),
				'help'	 => esc_html__( "This default header image.", 'crowdmerc' ),
				'type'	 => 'upload'
			),
			'overlay'		 => array(
				'type'		 => 'color-picker',
				'value'		 => '',
				'label'		 => esc_html__( 'Overlay', 'crowdmerc' ),
				'desc'		 => esc_html__( 'This is optional Overlay', 'crowdmerc' ),
			),
		),
	),
);

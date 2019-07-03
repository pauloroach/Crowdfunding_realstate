<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
	'_post_meta' => array(
		'title'		 => esc_html__( 'Post Settings', 'crowdmerc' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'crowdmerc' ),
				'desc'	 => esc_html__( 'Add your post hero title', 'crowdmerc' ),
			),
			'header_image'	 => array(
				'label'	 => esc_html__( ' Banner Image', 'crowdmerc' ),
				'desc'	 => esc_html__( 'Upload a post header image', 'crowdmerc' ),
				'help'	 => esc_html__( "This default header image will be used for all your post.", 'crowdmerc' ),
				'type'	 => 'upload'
			),
		),
	),
);

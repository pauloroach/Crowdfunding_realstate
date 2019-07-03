<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg[ 'page_builder' ] = array(
	'title'			 => esc_html__( 'Slider', 'crowdmerc' ),
	'description'	 => esc_html__( 'Add a Slider', 'crowdmerc' ),
	'tab'			 => esc_html__( 'Media Elements', 'crowdmerc' ),
	'popup_size'	 => 'small',
);

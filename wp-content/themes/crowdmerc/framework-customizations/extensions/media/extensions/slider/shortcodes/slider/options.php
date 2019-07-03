<?php

if ( !defined( 'FW' ) )
	die( 'Forbidden' );

$choices = fw()->extensions->get( 'slider' )->get_populated_sliders_choices();

if ( !empty( $choices ) ) {
	$options = array(
		'slider_id'	 => array(
			'type'		 => 'select',
			'label'		 => esc_html__( 'Select Slider', 'crowdmerc' ),
			'choices'	 => fw()->extensions->get( 'slider' )->get_populated_sliders_choices()
		),
		'info'		 => array(
			'type'	 => 'html',
			'label'	 =>esc_html__( ' ', 'crowdmerc' ),
			'html'	 => 'Go to <a target="_blank" href="' . admin_url( 'edit.php?post_type=' . fw()->extensions->get( 'slider' )->get_post_type() ) . '"><b>Apperance-> Slider</b></a> menu to change slider and  settings',
		),
	);
} else {
	$options = array(
		'no_sliders' => array(
			'type'	 => 'html-full',
			'label'	 => false,
			'desc'	 => false,
			'html'	 => '<div style=""><h1 style="font-weight:100; text-align:center; margin-top:80px">' . esc_html__( 'No Sliders Available', 'crowdmerc' ) . '</h1>' .
			'<p style="text-align:center"><i>' . sprintf( esc_html__( 'No Sliders created yet. Please go to the %s Sliders page and %s create a new Slider', 'crowdmerc' ), '<br/>', '<a href="' . admin_url( 'post-new.php?post_type=' . fw()->extensions->get( 'slider' )->get_post_type() ) . '">', '</a> </i></p></div>' )
		)
	);
}

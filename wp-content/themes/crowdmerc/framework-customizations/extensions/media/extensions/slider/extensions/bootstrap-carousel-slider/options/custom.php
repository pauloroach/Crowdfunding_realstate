<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/*
 * {population-method}.php - extra options for concrete population method,
 *  shown after default options on edit slider page.
 *
 */
$options = array(
	'slider_subtitle'	 => array(
		'label'	 => esc_html__( 'Subtitle', 'crowdmerc' ),
		'desc'	 => esc_html__( 'This is the text that appears on your slider subtitle', 'crowdmerc' ),
		'type'	 => 'text',
		'value'	 => esc_html__( 'What you do today', 'crowdmerc' )
	),
	'slider_desc'		 => array(
		'label'	 => esc_html__( 'Descriptions', 'crowdmerc' ),
		'desc'	 => esc_html__( 'This is the text that appears on your button', 'crowdmerc' ),
		'type'	 => 'textarea',
		'value'	 => esc_html__( 'Nobodys more committed to connecting you with the exceptional', 'crowdmerc' )
	),
	'button_settings'	 => array(
		'type'				 => 'addable-popup',
		'size'				 => 'large',
		'label'				 => esc_html__( 'Button', 'crowdmerc' ),
		'add-button-text'	 =>esc_html__( 'Add Button', 'crowdmerc' ),
		'desc'				 => esc_html__( 'Add your slider button', 'crowdmerc' ),
		'template'			 => 'Button : {{- label }}',
		'popup-options'		 => array(
			'style'			 => array(
				'label'		 => esc_html__( 'Style', 'crowdmerc' ),
				'desc'		 => esc_html__( 'Choose button style', 'crowdmerc' ),
				'type'		 => 'image-picker',
				'value'		 => '',
				'choices'	 => array(
					'primary'	 => array(
						'small'	 => array(
							'height' => 70,
							'src'	 => CROWDMERC_IMAGES . '/image-picker/button-style2.png'
						),
						'large'	 => array(
							'height' => 208,
							'src'	 => CROWDMERC_IMAGES . '/image-picker/button-style2.png'
						),
					),
					'default'	 => array(
						'small'	 => array(
							'height' => 70,
							'src'	 => CROWDMERC_IMAGES . '/image-picker/button-style3.png'
						),
						'large'	 => array(
							'height' => 208,
							'src'	 => CROWDMERC_IMAGES . '/image-picker/button-style3.png'
						),
					),
				),
			),
			'label'			 => array(
				'label'	 => esc_html__( 'Button Label', 'crowdmerc' ),
				'desc'	 => esc_html__( 'This is the text that appears on your button', 'crowdmerc' ),
				'type'	 => 'text',
				'value'	 => esc_html__( 'Our Services', 'crowdmerc' )
			),
			'link'			 => array(
				'label'	 => esc_html__( 'Button Link', 'crowdmerc' ),
				'desc'	 => esc_html__( 'Where should your button link to', 'crowdmerc' ),
				'type'	 => 'text',
				'value'	 => '#'
			),
			'target'		 => array(
				'type'			 => 'switch',
				'label'			 => esc_html__( 'Open Link in New Window', 'crowdmerc' ),
				'desc'			 => esc_html__( 'Select here if you want to open the linked page in a new window', 'crowdmerc' ),
				'right-choice'	 => array(
					'value'	 => '_blank',
					'label'	 => esc_html__( 'Yes', 'crowdmerc' ),
				),
				'left-choice'	 => array(
					'value'	 => '_self',
					'label'	 => esc_html__( 'No', 'crowdmerc' ),
				),
			),
			'btn_icon_group' => array(
				'type'		 => 'group',
				'options'	 => array(
					'icon'			 => array(
						'type'	 => 'new-icon',
						'label'	 =>esc_html__( 'Icon', 'crowdmerc' )
					),
					'icon_position'	 => array(
						'type'			 => 'switch',
						'label'			 => esc_html__( '', 'crowdmerc' ),
						'desc'			 => esc_html__( 'Choose the icon position', 'crowdmerc' ),
						'right-choice'	 => array(
							'value'	 => 'pull-right',
							'label'	 => esc_html__( 'Right', 'crowdmerc' ),
						),
						'left-choice'	 => array(
							'value'	 => '',
							'label'	 => esc_html__( 'Left', 'crowdmerc' ),
						),
					),
				)
			)
		)
	),
	'slider_align'			 => array(
		'label'		 =>esc_html__( 'Alignment', 'crowdmerc' ),
		'desc'		 =>esc_html__( 'Select the alignment for your Slide', 'crowdmerc' ),
		'attr'		 => array( 'class' => 'fw-checkbox-float-left' ),
		'type'		 => 'radio',
		'choices'	 => array(
			'text-left'		 =>esc_html__( 'Left', 'crowdmerc' ),
			'text-center'	 =>esc_html__( 'Center', 'crowdmerc' ),
			'text-right'	 =>esc_html__( 'Right', 'crowdmerc' ),
		),
		'value'		 => 'left'
	),
);

<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'donation'      => array(
        "type" => "short-select",
        "label" => __("Campaign Type", "wp-fundraising"),
        'value'   => 'no',
        'choices' => array(
            'no' =>  esc_html__( "Select Campaign Type", "wp-fundraising" ),
            'yes' => esc_html__( "Donation", "wp-fundraising" ) ,
            'no' => esc_html__( "Crowdfunding", "wp-fundraising" ) ,
        ),
    ),
	'style'      => array(
        "type" => "short-select",
        "label" => __("Campaign Type", "wp-fundraising"),
        'value'   => 'no',
        'choices' => array(
            '1' => esc_html__( "Style 1", "wp-fundraising" ) ,
            '2' => esc_html__( "Style 2", "wp-fundraising" ) ,
            '3' => esc_html__( "Style 3", "wp-fundraising" ) ,
            '4' => esc_html__( "Style 4", "wp-fundraising" ) ,
        ),
    ),

	'number'     => array(
		'label' => __( 'Limit', 'wp-fundraising' ),
		'desc'  => __( 'Enter the limit', 'wp-fundraising' ),
		'type'  => 'short-text',
		'value' => '-1',
	),

	'col'   => array(
		'label'   => __( 'Columns', 'wp-fundraising' ),
		'desc'    => __( 'Enter the columns', 'wp-fundraising' ),
		'type'    => 'short-select',
		'value'   => '3',
		'choices' => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		)
	),

	'cat'  => array(
		'label'      => __( 'Categories', 'wp-fundraising' ),
		'desc'       => __( 'Select the categories', 'wp-fundraising' ),
		'type'       => 'multi-select',
		'value'      => '',
		'population' => 'taxonomy',
		'source'     => 'product_cat',
	),
    'author'   => array(
        'label'   => __( 'Show/Hide Author', 'wp-fundraising' ),
        'type'    => 'short-select',
        'value'   => '3',
        'choices' => array(
            esc_html__( "Show", "wp-fundraising" ) => 'yes',
            esc_html__( "Hide", "wp-fundraising" ) => 'no',
        )
    ),
	'filter'   => array(
		'label'   => __( 'Show/Hide Filter', 'wp-fundraising' ),
		'desc'    => __( 'Show/Hide Filter', 'wp-fundraising' ),
		'type'    => 'short-select',
		'value'   => 'no',
		'choices' => array(
            esc_html__( "Show", "wp-fundraising" )     =>  'yes',
            esc_html__( "Hide", "wp-fundraising" )     =>  'no',
		)
	),

	'status'   => array(
		'label'   => __( 'Status', 'wp-fundraising' ),
		'desc'    => __( 'Show/Hide Filter', 'wp-fundraising' ),
		'type'    => 'short-select',
		'value'   => 'no',
		'choices' => array(
            esc_html__( "Successful", "wp-fundraising" )     =>  'successful',
            esc_html__( "Expired", "wp-fundraising" )     =>  'expired',
            esc_html__( "Valid", "wp-fundraising" )     =>  'valid',
		)
	),
);
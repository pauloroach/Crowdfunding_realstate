<?php
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'body_font',
    'label'       => esc_html__( 'Body Font', 'crowdmerc' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => 'regular',
        'font-size'      => '14px',
        'line-height'    => '1.625',
        'color'          => '#626c84'
    ),
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
);
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'heading_font',
    'label'       => esc_html__( 'Heading Font', 'crowdmerc' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => 'regular',
    ),
    'output'      => array(
        array(
            'element' => 'h1',
        ),
        array(
            'element' => 'h2',
        ),
        array(
            'element' => 'h3',
        ),
        array(
            'element' => 'h4',
        ),
        array(
            'element' => 'h5',
        ),
        array(
            'element' => 'h6',
        ),
    ),
);

<?php
$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'header_style',
    'label'       => esc_html__( 'Header Style', 'crowdmerc' ),
    'section'     => 'nav_section',
    'default'     => 'nav',
    'choices'     => array(
        'nav'   => get_template_directory_uri() . '/assets/images/header/header_1.png',
        'nav1' => get_template_directory_uri() . '/assets/images/header/header_2.png',
        'nav2' => get_template_directory_uri() . '/assets/images/header/header_3.png',
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_border',
    'label'       => esc_html__( 'Show Border', 'crowdmerc' ),
    'section'     => 'nav_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'nav_section',
            'operator'  => '!=',
            'value'     => 'nav2'
        )
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'mav_border_color',
    'label'       => esc_html__( 'Border Color', 'crowdmerc' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.fundpress-header-main-version.xs-menu-style-border',
            'property'	=> 'border-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_border',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'nav_bg_color',
	'label'       => esc_html__( 'Background Color', 'crowdmerc' ),
	'section'     => 'nav_section',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' 	=> '.xs-header-section.xs-menu-style-transparent',
			'property'	=> 'background-color',
		),
        array(
            'element'  => '.xs-header-section.fundpress-header-main-version',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.fundpress-header-main-version.header-boxed .xs-menus',
            'property' => 'background-color',
        ),
	),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'menu_color',
	'label'       => esc_html__( 'Menu Color', 'crowdmerc' ),
	'section'     => 'nav_section',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' 	=> '.xs-header-section.color-navy-blue .fundpress-menu .nav-menu li a',
			'property'	=> 'color',
		),
        array(
            'element'  => '.xs-header-section.fundpress-header-main-version .nav-menu li a',
            'property' => 'color',
        ),
        array(
            'element'  => '.fundpress-header-main-version.color-navy-blue .fundpress-menu .nav-menu .submenu-indicator-chevron',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.fundpress-menu .xs-navs-button .fundpress-icon-menu li a, .fundpress-header-main-version.color-navy-blue .fundpress-menu .fundpress-icon-menu li a',
            'property' => 'color',
        ),
        array(
            'element'  => '.fundpress-header-main-version.header-boxed .xs-menus .nav-menu li a',
            'property' => 'color',
        ),
	),
);

$fields[] = array(
	'type'        => 'color',
	'settings'    => 'menu_hover_color',
	'label'       => esc_html__( 'Menu Hover Color', 'crowdmerc' ),
	'section'     => 'nav_section',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' 	=> '.xs-header-section.color-navy-blue .fundpress-menu .nav-menu li a:hover',
			'property'	=> 'color',
		),
        array(
            'element'  => '.xs-header-section.fundpress-header-main-version .nav-menu li a:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.fundpress-header-main-version.header-boxed .xs-menus .nav-menu li a:hover',
            'property' => 'color',
        ),
	),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sub_menu_color',
    'label'       => esc_html__( 'Sub Menu Color', 'crowdmerc' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-header-section.color-navy-blue .fundpress-menu .nav-menu .nav-submenu li a',
            'property'	=> 'color',
        ),
        array(
            'element'  => '.xs-header-section.fundpress-header-main-version .nav-menu .nav-submenu li a',
            'property' => 'color',
        ),
        array(
            'element'  => '.fundpress-header-main-version.header-boxed .xs-menus .nav-menu li .nav-submenu a',
            'property' => 'color',
        ),
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sub_page_hover_color',
    'label'       => esc_html__( 'Sub Page Color', 'crowdmerc' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.single .fundpress-header-main-version.color-navy-blue .fundpress-menu .nav-menu > li > a',
            'property'	=> 'color',
        ),
        array(
            'element'  => '.page:not(.home) .fundpress-header-main-version.color-navy-blue .fundpress-menu .nav-menu > li > a',
            'property' => 'color',
        ),
        array(
            'element'  => '.archive .fundpress-header-main-version.color-navy-blue .fundpress-menu .nav-menu > li > a',
            'property' => 'color',
        ),
        array(
            'element'  => '.blog .fundpress-header-main-version.color-navy-blue .fundpress-menu .nav-menu > li > a',
            'property' => 'color',
        ),
        array(
            'element'  => ' .page:not(.home) .fundpress-menu .xs-navs-button .fundpress-icon-menu li a, .fundpress-header-main-version.color-navy-blue .fundpress-menu .fundpress-icon-menu li a',
            'property' => 'color',
        ),
        
    ),
);
$fields[]= array(
	'type'        => 'switch',
	'settings'    => 'show_login',
	'label'       => esc_html__( 'Show Login', 'crowdmerc' ),
	'section'     => 'nav_section',
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
		'off' => esc_attr__( 'Disable', 'crowdmerc' ),
	),
);

$fields[]= array(
	'type'        => 'switch',
	'settings'    => 'show_login',
	'label'       => esc_html__( 'Show Login', 'crowdmerc' ),
	'section'     => 'nav_section',
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
		'off' => esc_attr__( 'Disable', 'crowdmerc' ),
	),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'crowdmerc_dashbord',
    'label'       =>esc_html__( 'Dashboard Url', 'crowdmerc' ),
    'section'     => 'nav_section',
    'default'     => esc_html__( '', 'crowdmerc' ),
    'required'      => array(
        array(
            'setting'   => 'show_login',
            'operator'  => '==',
            'value'     => true
        )
    ),
);

$fields[]= array(
	'type'        => 'switch',
	'settings'    => 'show_header_cta',
	'label'       =>esc_html__( 'Show CTA Button', 'crowdmerc' ),
	'section'     => 'nav_section',
	'default'     => '',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
		'off' => esc_attr__( 'Disable', 'crowdmerc' ),
	),
    'required'      => array(
        array(
            'setting'   => 'header_style',
            'operator'  => '==',
            'value'     => 'nav'
        )
    ),
);

$fields[]= array(
	'type'        => 'text',
	'settings'    => 'cta_btn_label',
	'label'       =>esc_html__( 'CTA Button Label', 'crowdmerc' ),
	'section'     => 'nav_section',
	'transport'   => 'postMessage',
    'js_vars'     => array(
      	array(
       		'element'  => '.fundpress-icon-menu .xs-btn',
       		'function' => 'html'
      	),
    ),
	'default'     => esc_html__( 'start a campaign', 'crowdmerc' ),
	'required'      => array( 
        array( 
            'setting'   => 'show_header_cta', // or simply without [image]
            'operator'  => '==',
            'value'     => true // and just have 'image' here
        )
    ),
);

$fields[]= array(
	'type'        => 'text',
	'settings'    => 'cta_btn_link',
	'label'       =>esc_html__( 'CTA Button Link', 'crowdmerc' ),
	'section'     => 'nav_section',
    'js_vars'     => array(
      	array(
       		'element'  => '.fundpress-icon-menu .xs-btn',
       		'function' => 'html'
      	),
    ),
	'default'     => esc_html__( '#', 'crowdmerc' ),
	'required'      => array( 
        array( 
            'setting'   => 'show_header_cta',
            'operator'  => '==',
            'value'     => true
        )
    ),
);
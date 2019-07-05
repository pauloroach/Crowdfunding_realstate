<?php

$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'footer_style',
    'label'       => esc_html__( 'Footer Style', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => get_template_directory_uri() . '/assets/images/header/footer_1.png',
        '2' => get_template_directory_uri() . '/assets/images/header/footer_2.png',
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_layout',
    'label'       => esc_html__( 'Footer Widget Per Row', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '4',
    'choices'     => array(
        '12' => esc_attr__( '1', 'crowdmerc' ),
        '6' => esc_attr__( '2', 'crowdmerc' ),
        '4' => esc_attr__( '3', 'crowdmerc' ),
        '3' => esc_attr__( '4', 'crowdmerc' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_fixed_footer',
    'label'       => esc_html__( 'Enable Fixed Footer', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'crowdmerc' ),
        'off' => esc_attr__( 'Disable', 'crowdmerc' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_bg_color',
    'label'       => esc_html__( 'Background Color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.fundpress-footer-section',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'widget_title_color',
    'label'       => esc_html__( 'Widget Title Color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget .xs-footer-title h4',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_text_color',
    'label'       => esc_html__( 'Footer text color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget .fundpress-single-footer p',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_link_color',
    'label'       => esc_html__( 'Footer link color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget .fundpress-single-footer a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.fundpress-footer-version-2 .fundpress-single-footer.widget_nav_menu ul li a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.fundpress-footer-version-2 .fundpress-single-footer.widget_nav_menu ul li a:before',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-footer-section .footer-widget .fundpress-single-footer a',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'custom',
    'settings' => 'custom_title_transparent',
    'label'       => '',
    'section'     => 'footer_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Copyright Section","crowdmerc").'</div>',
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'copyright_text',
    'label'       => esc_html__( 'Copyright text', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.fundpress-footer-bottom .fundpress-copyright-text p',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Copyrights crowdfunding® - 2019', 'crowdmerc' ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_bg_color',
    'label'       => esc_html__( 'Background color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section .xs-footer-bottom-layer',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.fundpress-footer-version-2 .fundpress-footer-bottom-v2',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_text_color',
    'label'       => esc_html__( 'Text color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.fundpress-footer-bottom .fundpress-copyright-text p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.fundpress-footer-bottom-v2 .fundpress-copyright-text-v2 p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list-v7 li.xs-text-content ',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color',
    'label'       => esc_html__( 'Link color', 'crowdmerc' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.fundpress-footer-bottom .fundpress-copyright-text p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.fundpress-footer-bottom-v2 .fundpress-copyright-text-v2 p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.fundpress-footer-bottom-v2 .fundpress-copyright-text-v2 p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list-v7 li a',
            'property'	=> 'color',
        ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'facebook',
    'label'       =>esc_html__( 'Facebook', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '#',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 2,
        ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'twitter',
    'label'       =>esc_html__( 'Twitter', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '#',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 2,
        ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'dribbble',
    'label'       =>esc_html__( 'Dribbble', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '#',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 2,
        ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'pinterest',
    'label'       =>esc_html__( 'Pinterest', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '#',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 2,
        ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'instagram',
    'label'       =>esc_html__( 'Instagram', 'crowdmerc' ),
    'section'     => 'footer_section',
    'default'     => '#',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 2,
        ),
    ),
);
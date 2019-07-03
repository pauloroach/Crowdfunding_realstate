<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( !function_exists( 'crowdmerc_widget_init' ) ) {

	function crowdmerc_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'			 => esc_html__( 'Blog Widget Area', 'crowdmerc' ),
					'id'			 => 'sidebar-1',
					'description'	 => esc_html__( 'Appears on posts.', 'crowdmerc' ),
					'before_widget'	 => '<div id="%1$s" class="sidebar xs-single-sidebar border xs-content-padding %2$s">',
					'after_widget'	 => '</div><!-- end widget -->',
					'before_title'	 => '<h3 class="widget-title xs-widget-title">',
					'after_title'	 => '</h3>',
				)
			);
            register_sidebar(
                array(
                    'name'			 => esc_html__( 'Page Widget Area', 'crowdmerc' ),
                    'id'			 => 'sidebar-2',
                    'description'	 => esc_html__( 'Appears on Pages.', 'crowdmerc' ),
                    'before_widget'	 => '<div id="%1$s" class="sidebar xs-single-sidebar border xs-content-padding %2$s">',
                    'after_widget'	 => '</div><!-- end widget -->',
                    'before_title'	 => '<h3 class="widget-title xs-widget-title">',
                    'after_title'	 => '</h3>',
                )
            );
            register_sidebar(
                array(
                    'name'			 => esc_html__( 'Shop Widget Area', 'crowdmerc' ),
                    'id'			 => 'sidebar-3',
                    'description'	 => esc_html__( 'Appears on Shop.', 'crowdmerc' ),
                    'before_widget'	 => '<div id="%1$s" class="sidebar xs-single-sidebar border xs-content-padding %2$s">',
                    'after_widget'	 => '</div><!-- end widget -->',
                    'before_title'	 => '<h3 class="widget-title xs-widget-title">',
                    'after_title'	 => '</h3>',
                )
            );
            if(class_exists('Xs_Main')){
                $xs_widget = Xs_Main::xs_get_instance();
                $xs_widget->get_footer_widget(true);
            }

		}
	}

	add_action( 'widgets_init', 'crowdmerc_widget_init' );
}



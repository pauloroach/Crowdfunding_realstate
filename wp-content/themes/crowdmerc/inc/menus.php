<?php

if ( !defined( 'ABSPATH' ) )
    die( 'Direct access forbidden.' );

/**
 * Register theme menus
 */
class crowdmerc_xs_navwalker extends Walker_Nav_Menu {

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown nav-submenu\">\n";
    }

}

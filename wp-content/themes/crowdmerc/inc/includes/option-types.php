<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

function crowdmerc_action_theme_include_custom_option_types() {
	if ( is_admin() ) {
		$dir = CROWDMERC_INC . '/includes';
		require_once $dir . '/option-types/new-icon/class-fw-option-type-new-icon.php';
	}
}

add_action( 'fw_option_types_init', 'crowdmerc_action_theme_include_custom_option_types' );


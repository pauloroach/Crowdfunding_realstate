<?php

/*
 * TGM REQUIRE PLUGIN
 * require or recommend plugins for your WordPress themes
 */

/** @internal */
function _action_crowdmerc_register_required_plugins() {
	$plugins	 = array(
		array(
			'name'		 => esc_html__( 'Unyson', 'crowdmerc' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Elementor', 'crowdmerc' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Kirki', 'crowdmerc' ),
			'slug'		 => 'kirki',
			'required'	 => true,
		),
        array(
            'name'		 => esc_html__( 'Woocommerce', 'crowdmerc' ),
            'slug'		 => 'woocommerce',
            'required'	 => true,
        ),
		array(
			'name'		 => esc_html__( 'fundpress features', 'crowdmerc' ),
			'slug'		 => 'fundpress-features',
			'required'	 => true,
			'source'	 =>  CROWDMERC_PLUGINS_DIR . '/fundpress-features.zip' ,
		),
		array(
			'name'		 => esc_html__( 'WP Fundraising', 'crowdmerc' ),
			'slug'		 => 'wp-fundraising',
			'required'	 => true,
            'version'    => '1.0.1',
			'source'	 =>  CROWDMERC_PLUGINS_DIR . '/wp-fundraising.zip' ,
		),
        array(
            'name'		 => esc_html__( 'Contact Form 7', 'crowdmerc' ),
            'slug'		 => 'contact-form-7',
            'required'	 => true,
        ),
		
	);


	$config = array(
		'id'			 => 'crowdmerc', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'crowdmerc-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', '_action_crowdmerc_register_required_plugins' );
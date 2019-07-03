<?php

function _wf_fw_extensions_locations( $locations ) {
	$locations[ dirname( __FILE__ ) . '/extensions' ] = WP_FUNDRAISING_DIR_URL.'inc/builder-support/unyson/extensions';

	return $locations;
}

add_filter( 'fw_extensions_locations', '_wf_fw_extensions_locations' );
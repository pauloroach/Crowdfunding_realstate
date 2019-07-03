<?php

if (!defined('ABSPATH'))
    die('Direct access forbidden.');
/**
 * Include static files: javascript and css for backend
 */
wp_enqueue_style('crowdmerc-admin', CROWDMERC_CSS . '/xs_admin.css', null, CROWDMERC_VERSION);
wp_enqueue_style( 'crowdmerc-icons', CROWDMERC_CSS . '/iconfont.css', null, CROWDMERC_VERSION );

wp_enqueue_script('crowdmerc-admin-js', CROWDMERC_SCRIPTS . '/xs-admin.js', null, CROWDMERC_VERSION);

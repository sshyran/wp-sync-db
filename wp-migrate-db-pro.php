<?php
/*
Plugin Name: WP Migrate DB
Plugin URI: http://deliciousbrains.com/wp-migrate-db-pro/
Description: Export, push, and pull to migrate your WordPress databases.
Author: Delicious Brains
Version: 1.3
Author URI: http://deliciousbrains.com
*/

if ( version_compare( PHP_VERSION, '5.2', '<' ) ) {
	// Thanks for this Yoast!
	if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
		wp_die( __('WP Migrate DB requires PHP 5.2 or higher, as does WordPress 3.2 and higher. The plugin has now disabled itself.', 'wp-migrate-db' ) );
	}
}

// Define the directory seperator if it isn't already
if( !defined( 'DS' ) ) {
	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
		define('DS', '\\');
	}
	else {
		define('DS', '/');
	}
}

function wp_migrate_db_pro_init() {
	if ( !is_admin() ) return;

	require_once 'class/wpmdbpro-base.php';
	require_once 'class/wpmdbpro-addon.php';
	require_once 'class/wpmdbpro.php';

	global $wpmdbpro;
	$wpmdbpro = new WPMDBPro( __FILE__ );
}

add_action( 'init', 'wp_migrate_db_pro_init', 5 );

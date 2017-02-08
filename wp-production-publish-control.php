<?php
/**
 * Plugin Name: Publish Control
 * Plugin URI:  https://github.com/technosailor/wp-production-publish-control
 * Description: Prevents Publishing without verification. Useful for Production environments where accidental publishing should be prevented.
 * Version:     0.2.0
 * Author:      Aaron Brazell
 * Author URI:  http://technosailor.com
 * Text Domain: wppc
 * Domain Path: /languages
 */

// Useful global constants
define( 'WPPC_VERSION', '0.2.0' );
define( 'WPPC_URL',     plugin_dir_url( __FILE__ ) );
define( 'WPPC_PATH',    dirname( __FILE__ ) . '/' );
define( 'WPPC_INC',     WPPC_PATH . 'includes/' );


require_once WPPC_INC . 'functions/capabilities.php';
require_once WPPC_INC . 'classes/class-admin.php';

require_once WPPC_INC . '/setup.php';


\WPPC\Setup\setup();
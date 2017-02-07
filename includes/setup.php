<?php
namespace WPPC\Setup;

/**
 * Execute all the bootstrapping
 */
function setup() {

    \WPPC\Setup\hooks();
}

/**
 * Execute WordPress hooks
 */
function hooks() {
    add_action( 'user_has_cap', '\WPPC\Capabilities\limit_publish_capability', 10, 3 );
    add_action( 'edit_user_profile', [ '\WPPC\Admin\WPPC_Admin', 'add_profile_meta' ] );
    add_action( 'show_user_profile', [ '\WPPC\Admin\WPPC_Admin', 'add_profile_meta' ] );
}

<?php

/**
 * @package Connect
 */

/**
 * load admin style
 */
function connect_wp_admin_style() {
    wp_enqueue_style( 'connect-admin-style', CONNECT_URI . '/inc/admin/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'connect_wp_admin_style' );

// Load the embedded Redux Framework
if ( file_exists( dirname( __FILE__ ) . '/redux-framework/framework.php' ) ) {
    require_once dirname( __FILE__ ) . '/redux-framework/framework.php';
}

// Load the options
if ( file_exists( dirname( __FILE__ ) . '/options-init.php' ) ) {
    require_once dirname( __FILE__ ) . '/options-init.php';
}

get_template_part( 'inc/admin/update' );

<?php

/**
 * @package Connect
 */
/**
 * defines connect directory constants
 */
define( 'CONNECT_DIR', get_template_directory() );
define( 'CONNECT_DIR_INC', CONNECT_DIR . '/inc' );
define( "CONNECT_DIR_LIB", CONNECT_DIR . '/lib' );

define( "CONNECT_URI", get_template_directory_uri() );
define( "CONNECT_URI_LIB", CONNECT_URI . '/lib' );
define( "CONNECT_URI_MEDIA", CONNECT_URI . '/media' );
define( "CONNECT_URI_IMAGES", CONNECT_URI_MEDIA . '/images' );

get_template_part( 'inc/basic' );
get_template_part( 'inc/admin/admin-init' );

<?php

function connect_transient_update_themes( $transient ) {
    $my_theme = wp_get_theme();
    $theme_name = $my_theme->stylesheet;
    $theme_version = $my_theme->get( 'Version' );

    if ( empty( $transient->checked[ $theme_name ] ) ) {
        return $transient;
    }
    $my_theme = wp_get_theme();
    $theme_name = $my_theme->stylesheet;

    $url = 'http://demo.mbkom.com/updates/connect/update.php';
    $request = wp_remote_request( $url );
    if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) !== 200 ) {
        return $transient;
    }
    $args = json_decode( $request[ 'body' ], true );

    if ( empty( $args ) ) {
        return $transient;
    }
    if ( version_compare( $theme_version, $args[ 'new_version' ], '<' ) ) {
        $args[ 'theme' ] = $theme_name;
        $transient->response[ $theme_name ] = $args;
    }

    return $transient;
}

add_filter( 'pre_set_site_transient_update_themes', 'connect_transient_update_themes' );

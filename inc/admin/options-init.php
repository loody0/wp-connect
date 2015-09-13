<?php

/**
 * @package Connect
 */
if ( !class_exists( 'Redux' ) ) {
    return;
}

$opt_name = "connect_opt";
$theme = wp_get_theme();

$args = array(
    'display_name' => $theme->get( 'Name' ),
    'display_version' => $theme->get( 'Version' ),
    'menu_type' => 'submenu',
    'menu_title' => __( 'Theme Options', 'connect' ),
    'page_title' => __( 'Theme Options', 'connect' ),
    'admin_bar' => true,
    'customizer' => true,
    'customizer_only' => true,
    'dev_mode' => false,
);

Redux::setArgs( $opt_name, $args );

$section = array(
    'title' => __( 'General', 'connect' ),
    'id' => 'con-tab-general',
    'desc' => '',
//    'icon'   => 'el el-home',
    'fields' => array(
        array(
            'id' => 'opt-text-example',
            'type' => 'text',
            'title' => 'Text Field',
            'subtitle' => 'Subtitle',
            'desc' => 'Field Description',
            'default' => 'Default Text',
        ),
    )
);
Redux::setSection( $opt_name, $section );

$section = array(
    'title' => __( 'Header', 'connect' ),
    'id' => 'con-tab-header',
    'desc' => '',
    'fields' => array(
        array(
            'subtitle' => __( 'Upload a logo for your theme', 'connect' ),
            'id' => 'connect_header_logo',
            'type' => 'media',
            'title' => __( 'Custom logo', 'connect' ),
            'url' => true,
        ),
        array(
            'subtitle' => __( 'Check this box if you don\'t want to display tagline of your blog', 'connect' ),
            'id' => 'connect_disable_tagline',
            'type' => 'checkbox',
            'title' => __( 'Disable Blog Tagline', 'connect' ),
        )
    )
);
Redux::setSection( $opt_name, $section );

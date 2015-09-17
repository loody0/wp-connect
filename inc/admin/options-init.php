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
//    'customizer_only' => true,
    'dev_mode' => false,
    'async_typography' => true,
);

Redux::setArgs( $opt_name, $args );

//  general section
//$section = array(
//    'title' => __( 'General', 'connect' ),
//    'id' => 'con-tab-general',
//    'desc' => '',
////    'icon'   => 'el el-home',
//    'fields' => array(
//        array(
//            'id' => 'opt-text-example',
//            'type' => 'text',
//            'title' => 'Text Field',
//            'subtitle' => 'Subtitle',
//            'desc' => 'Field Description',
//            'default' => 'Default Text',
//        ),
//    )
//);
//Redux::setSection( $opt_name, $section );
//  header section
$section = array(
    'title' => __( 'Header', 'connect' ),
    'id' => 'con-tab-header',
    'desc' => '',
    'icon' => 'el el-home',
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

// -> START Typography
$section = array(
    'title' => __( 'Typography', 'connect' ),
    'id' => 'con-tab-typography',
    'icon' => 'el el-font',
    'fields' => array(
        array(
            'id' => 'connect-typography-body',
            'type' => 'typography',
            'title' => __( 'Body Font', 'connect' ),
            'subtitle' => __( 'Specify the body font properties.', 'connect' ),
            'google' => true,
            'all_styles' => true,
            'line-height' => false,
            'font-weight' => false,
            'font-size' => false,
            'font-style' => false,
            'color' => false,
            'text-align' => false,
            'subsets' => false,
            'output' => array( 'body' ),
            'default' => array(
                'font-family' => "Open Sans",
            )
        )
    )
);
Redux::setSection( $opt_name, $section );

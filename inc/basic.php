<?php

/**
 * @package Connect
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function connect_setup() {

    load_theme_textdomain( 'connect', CONNECT_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // hide admin bar on front
    add_filter( 'show_admin_bar', '__return_false' );

    // menu
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'connect' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );


    // Set up the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'connect_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );
}

add_action( 'after_setup_theme', 'connect_setup' );

get_template_part( 'inc/navwalker' );

/**
 * Enqueue scripts and styles.
 */
function connect_scripts() {

    if ( is_admin() ) return;

    wp_enqueue_script( 'jquery' );
    // bootstrap
    wp_enqueue_style( 'bootstrap-style', CONNECT_URI_LIB . '/bootstrap/css/bootstrap.min.css' );
//    wp_enqueue_style( 'bootstrap-style-theme', CONNECT_URI_LIB . '/bootstrap/css/bootstrap-theme.min.css' );
    wp_enqueue_script( 'bootstrap-script', CONNECT_URI_LIB . '/bootstrap/js/bootstrap.min.js', false, false, true );
    // font awesome
    wp_enqueue_style( 'font-awesome', CONNECT_URI_LIB . '/font-awesome/css/font-awesome.min.css' );

    wp_enqueue_script( 'modernizr', CONNECT_URI . '/js/modernizr.js', false, false, true );
    wp_enqueue_script( 'wow', CONNECT_URI . '/js/wow.min.js', false, false, true );

    // custom scroll
    wp_enqueue_style( 'custom-scrollbar-style', CONNECT_URI_LIB . '/malihu-custom-scrollbar/jquery.mCustomScrollbar.min.css' );
    wp_enqueue_script( 'custom-scrollbar-js', CONNECT_URI_LIB . '/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js', false, false, true );

    wp_enqueue_script( 'connect-script', CONNECT_URI . '/js/main.js', false, false, true );
    wp_enqueue_style( 'connect-style', get_stylesheet_uri() );

    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}

add_action( 'wp_enqueue_scripts', 'connect_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function connect_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar', 'connect' ),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}

add_action( 'widgets_init', 'connect_widgets_init' );

get_template_part( 'inc/functions' );
get_template_part( 'inc/custom-login' );

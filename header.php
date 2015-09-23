<?php
/**
 * Template: header.php
 * 
 * @package Connect
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>-->

        <?php wp_head(); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body <?php body_class(); ?>>

        <div class="page-progress-bar"></div>
        <div class="page-progress-overlay"></div>

        <div class="site-page">
            <?php get_template_part( 'template-parts/side-menu' ); ?>
            <?php get_template_part( 'template-parts/side-left' ); ?>
            <?php get_template_part( 'template-parts/side-right' ); ?>
            <div class="page-wrap">
                <div class="page-overlay"></div>

                <header class="site-header" id="site-header">
                    <nav class="navbar navbar-default site-navbar navbar-fixed-top" id="site-navbar">
                        <?php
                        $left_bar = '<i class="fa fa-bars"></i>';
                        if ( is_user_logged_in() ) {
                            $my_avatar = bp_core_fetch_avatar( array ( 'item_id' => bp_loggedin_user_id(), 'type' => 'thumb', 'width' => '30', 'height' => '30' ) );
                            $count_notif = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
                            $count_messages = bp_get_total_unread_messages_count();
                            $count_total = $count_notif + $count_messages;
                            $badge = ($count_total > 0) ? '<span class="badge badge-border badge-empty">&nbsp;</span>' : '';
                            $left_bar = '<span class="badge-wrap badge-wrap-inline">' . $my_avatar . $badge . '</span>';
                        }
                        ?>
                        <span class="side-left-bar pull-left" id="side-left-bar"><?php echo $left_bar; ?></span>

                        <span class="side-right-bar pull-right" id="side-right-bar"><i class="fa fa-bars"></i></span>
                        <div class="container-fluid">


                            <div class="navbar-header">
                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                                    <?php
                                    // display header logo 
                                    $connect_header_logo = connect_get_option( 'connect_header_logo' );
                                    if ( $connect_header_logo && $connect_header_logo[ 'id' ] ) {
                                        $connect_header_logo_url = wp_get_attachment_image_src( $connect_header_logo[ 'id' ], 'medium' );
                                        $connect_header_logo_url = $connect_header_logo_url[ 0 ];
                                        echo '<div class="site-logo"><img src="' . $connect_header_logo_url . '" /></div>';
                                    } else {

                                        // display blogname and description
                                        $disable_tagline = connect_get_option( 'connect_disable_tagline' );
                                        ?>
                                        <div class="site-title-container<?php echo ( $disable_tagline ) ? '' : ' has-description'; ?>">
                                            <div class="site-title"><?php echo bloginfo( 'name' ); ?></div>
                                            <?php echo ( $disable_tagline ) ? '' : '<div class="site-description">' . get_bloginfo( 'description' ) . '</div>'; ?>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                </a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <!-- search form -->
                                <form class="navbar-form navbar-left site-navbar-search" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                                    <div class="input-group">
                                        <input type="text" class="form-control connect-input" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'connect' ) ?>" value="<?php echo get_search_query() ?>" name="s" >
                                        <span class="input-group-btn">
                                            <button class="btn btn-default connect-btn connect-btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        </span>
                                    </div>
                                </form>

                                <p class="navbar-text site-menu-bar"><span class="navbar-link" id="site-menu-bar"><i class="fa fa-bars"></i></span></p>

                                <?php
                                wp_nav_menu( array (
                                    'menu' => 'primary',
                                    'theme_location' => 'primary',
                                    'depth' => 1,
                                    'menu_class' => 'nav navbar-nav site-menu',
                                    'container' => false,
                                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                    'walker' => new wp_bootstrap_navwalker() )
                                );
                                ?>

                                <ul class="nav navbar-nav navbar-right navbar-nav-user">
                                    <?php
                                    if ( !is_user_logged_in() ) {
                                        connect_login_register_nav();
                                    } else {
                                        connect_user_nav();
                                    }
                                    ?>
                                </ul>

                            </div> <!-- .navbar-collapse -->
                        </div> <!-- .container-fluid -->
                    </nav>
                </header>



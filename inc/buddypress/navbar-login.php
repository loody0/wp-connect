<?php
/**
 * @package Connect
 */

/**
 * get login register navbar
 */
function connect_login_register_nav() {
    ?>
    <li>
        <a href="#">Sign in</a>
    </li>
    <li>
        <a href="#">Create an Account</a>
    </li>
    <?php
}

/**
 * get user navbar dropdown
 */
function connect_user_nav() {

    if ( !connect_is_buddypress_active() || !is_user_logged_in() ) return;

    $my_avatar = bp_core_fetch_avatar( array ( 'item_id' => bp_loggedin_user_id(), 'type' => 'thumb' ) );
    $my_name = bp_core_get_username( bp_loggedin_user_id() );

    $count_notif = ( bp_is_active( 'notifications' ) ) ? bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) : 0;
    $count_messages = ( bp_is_active( 'messages' ) ) ? bp_get_total_unread_messages_count() : 0;
    $count_total = $count_notif + $count_messages;

    $badge = ($count_total > 0) ? '<span class="badge badge-border badge-empty">&nbsp;</span>' : '';

    echo '<li class="dropdown nav-user-dropdown">';
    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' .
    '<span class="badge-wrap badge-wrap-inline">' . $my_avatar . $badge . '</span> <span class="username">' .
    $my_name . '</span> <span class="caret"></span></a>';

    echo '<ul class="dropdown-menu animated fadeInRight">';
    $menu = connect_get_user_options_nav();

    foreach ( $menu as $top ) {
        if ( $top[ 'submenu' ] ) {
            $class = "has-submenu";
        }
        echo '<li class="' . $class . '"><a href="' . $top[ 'link' ] . '">' . $top[ 'name' ];
        if ( $top[ 'count' ] > 0 ) {
            echo '<div class="badge pull-right">' . $top[ 'count' ] . '</div>';
        }
        echo '</a>';

        if ( $top[ 'submenu' ] ) {
            echo '<ul class="dropdown-menu dropdown-submenu animated fadeInRight">';
            foreach ( $top[ 'submenu' ] as $sub ) {
                echo '<li><a href="' . $sub[ 'link' ] . '">' . $sub[ 'name' ];
                if ( $sub[ 'count' ] > 0 ) {
                    echo '<div class="badge pull-right">' . $top[ 'count' ] . '</div>';
                }
                echo '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    echo '</ul>';

    echo '</li>';
}

/**
 * get array of user options menu
 * 
 * @return array
 */
function connect_get_user_options_nav() {
    if ( !connect_is_buddypress_active() ) return;
    global $bp;
    $nav = $bp->bp_options_nav;

    $menu = array ();

    foreach ( $nav as $top => $subs ) {
        $submenu = array ();
        $top_link = "#";
        $i = 0;
        $count_top = 0;
        foreach ( $subs as $sub ) {
            if ( $i == 0 ) $top_link = $sub[ 'link' ];
            $i++;
            $count = 0;
            if ( 'unread' == $sub[ 'slug' ] || 'inbox' == $sub[ 'slug' ] ) {
                $count = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
                $count_top = $count_top + $count;
            }
            array_push( $submenu, array (
                'name' => $sub[ 'name' ],
                'link' => $sub[ 'link' ],
                'slug' => $sub[ 'slug' ],
                'count' => $count
            ) );
        }
        $topmenu = array (
            'name' => $top,
            'link' => $top_link,
            'submenu' => $submenu,
            'count' => $count_top
        );
        array_push( $menu, $topmenu );
    }
    return $menu;
}

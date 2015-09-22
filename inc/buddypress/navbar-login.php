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
    
    if ( !is_user_logged_in() ) return;
    
    $my_avatar = bp_core_fetch_avatar( array( 'item_id' => bp_loggedin_user_id(), 'type' => 'thumb' ) );
    $my_name = bp_core_get_username( bp_loggedin_user_id() );

    echo '<li class="nav-user-dropdown">';
    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $my_avatar . '<span class="username">' . $my_name . '</span> <span class="caret"></span></a>';

    echo '<ul class="dropdown-menu animated fadeInRight">';
    $menu = connect_get_user_options_nav();

    foreach ( $menu as $top ) {
        echo '<li><a href="' . $top[ 'link' ] . '">' . $top[ 'name' ] . '</a>';

        if ( $top[ 'submenu' ] ) {
            echo '<ul class="dropdown-submenu animated fadeInRight">';
            foreach ( $top[ 'submenu' ] as $sub ) {
                echo '<li><a href="' . $sub[ 'link' ] . '">' . $sub[ 'name' ] . '</a></li>';
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
    global $bp;
    $nav = $bp->bp_options_nav;

    $menu = array();

    foreach ( $nav as $top => $subs ) {
        $submenu = array();
        $top_link = "#";
        $i = 0;
        foreach ( $subs as $sub ) {
            if ( $i == 0 ) $top_link = $sub[ 'link' ];
            $i++;
            array_push( $submenu, array(
                'name' => $sub[ 'name' ],
                'link' => $sub[ 'link' ],
            ) );
        }
        $topmenu = array(
            'name' => $top,
            'link' => $top_link,
            'submenu' => $submenu
        );
        array_push( $menu, $topmenu );
    }
    return $menu;
}

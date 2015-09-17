<?php
/**
 * buddypress functions
 * 
 * @package Connect
 */

/**
 * change member search form
 */
function connect_bp_directory_members_search_form() {
    $default_search_value = bp_get_search_default_text( 'members' );
    $search_value = !empty( $_REQUEST[ 's' ] ) ? stripslashes( $_REQUEST[ 's' ] ) : $default_search_value;

    $search_form_html = '<form action="" method="get" id="search-members-form">
		<div class="form-inline"><div class="input-group"><input type="text" name="s" class="form-control input-search"  id="members_search" placeholder="' . esc_attr( $search_value ) . '" size="30"/>
		<span class="input-group-btn">
                <button type="submit" class="btn btn-default" id="members_search_submit" name="members_search_submit"></button>
                </span></div></div>
                </form>';
    return $search_form_html;
}

add_filter( 'bp_directory_members_search_form', 'connect_bp_directory_members_search_form' );

// add class to add friend button
function connect_add_class_friend_button( $button ) {

    // pending, awaiting_response, is_friend, not_friends
    // $button['id'];

    $button[ 'link_class' ] = $button[ 'link_class' ] . ' btn btn-default btn-sm connect-btn connect-btn-primary';
    return $button;
}

add_filter( 'bp_get_add_friend_button', 'connect_add_class_friend_button' );

// custom display member pagination link
function connect_member_pagination_link( $pag_links ) {
    global $members_template;

    $total = ceil( ( int ) $members_template->total_member_count / ( int ) $members_template->pag_num );
    $cur_page = $members_template->pag_page;
    $label = '<label>' . sprintf( __( 'Page %s of %d', 'connect' ), $cur_page, $total ) . '</label>';

    return $label . $pag_links;
}

add_filter( 'bp_get_members_pagination_links', 'connect_member_pagination_link' );


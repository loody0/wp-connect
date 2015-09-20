<?php

/**
 * buddypress functions
 * 
 * @package Connect
 */

/**
 * change members search form
 */
function connect_bp_directory_members_search_form( $search_form_html ) {
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

/**
 * add class to add friend button
 */
function connect_add_class_friend_button( $button ) {

    // id : pending, awaiting_response, is_friend, not_friends
    $class = ' btn btn-default connect-btn';
    switch ( $button[ 'id' ] ) {
        case 'is_friend': $class .= ' connect-btn-default';
            break;
        case 'pending': $class .= ' connect-btn-default';
            break;
        case 'not_friends': $class .= ' connect-btn-primary';
            break;
        case 'awaiting_response': $class .= ' connect-btn-primary';
            break;
        default: $class .= ' connect-btn-primary';
            break;
    }
    $button[ 'link_class' ] = $button[ 'link_class' ] . $class;
    return $button;
}

add_filter( 'bp_get_add_friend_button', 'connect_add_class_friend_button' );

/**
 * custom members pagination link display
 */
function connect_members_pagination_link( $pag_links ) {
    global $members_template;

    $total = ceil( ( int ) $members_template->total_member_count / ( int ) $members_template->pag_num );
    $cur_page = $members_template->pag_page;
    $label = '<label>' . sprintf( __( 'Page %s of %d', 'connect' ), $cur_page, $total ) . '</label>';

    return $label . $pag_links;
}

add_filter( 'bp_get_members_pagination_links', 'connect_members_pagination_link' );

/**
 * change groups search form
 */
function connect_bp_directory_groups_search_form( $search_form_html ) {
    $default_search_value = bp_get_search_default_text( 'groups' );
    $search_value = !empty( $_REQUEST[ 's' ] ) ? stripslashes( $_REQUEST[ 's' ] ) : $default_search_value;
    $search_form_html = '<form action="" method="get" id="search-groups-form">
		<div class="form-inline"><div class="input-group"><input type="text" name="s" class="form-control input-search"  id="groups_search" placeholder="' . esc_attr( $search_value ) . '" size="30"/>
		<span class="input-group-btn">
                <button type="submit" class="btn btn-default" id="groups_search_submit" name="groups_search_submit"></button>
                </span></div></div>
                </form>';
    return $search_form_html;
}

add_filter( 'bp_directory_groups_search_form', 'connect_bp_directory_groups_search_form' );

/**
 * change group description excerpt length
 */
function connect_bp_get_group_description_excerpt( $desc, $group ) {
    $desc = bp_create_excerpt( $group->description, 120 );
    return $desc;
}

add_filter( 'bp_get_group_description_excerpt', 'connect_bp_get_group_description_excerpt', 20, 2 );

/**
 * add class to add group join button
 */
function connect_bp_group_join_button( $button ) {
    // id: join_group, leave_group, accept_invite, membership_requested, request_membership
    $class = ' btn btn-default connect-btn';
    switch ( $button[ 'id' ] ) {
        case 'membership_requested': $class .= ' connect-btn-default';
            break;
        case 'request_membership': $class .= ' connect-btn-default';
            break;
        case 'leave_group': $class .= ' connect-btn-default';
            break;
        case 'join_group': $class .= ' connect-btn-primary';
            break;
        case 'accept_invite': $class .= ' connect-btn-primary';
            break;
        default: $class .= ' connect-btn-primary';
            break;
    }
    $button[ 'link_class' ] = $button[ 'link_class' ] . $class;
    return $button;
}

add_filter( 'bp_get_group_join_button', 'connect_bp_group_join_button' );

/**
 * custom display groups pagination link
 */
function connect_groups_pagination_link( $pag_links ) {
    global $groups_template;
    $total = ceil( ( int ) $groups_template->total_group_count / ( int ) $groups_template->pag_num );
    $cur_page = $groups_template->pag_page;
    $label = '<label>' . sprintf( __( 'Page %s of %d', 'connect' ), $cur_page, $total ) . '</label>';

    return $label . $pag_links;
}

add_filter( 'bp_get_groups_pagination_links', 'connect_groups_pagination_link' );

/**
 * add class to send public message button
 */
function connect_bp_send_message_button( $button ) {
    $class = ' btn btn-default connect-btn connect-btn-default';
    $button[ 'link_class' ] = $button[ 'link_class' ] . $class;
    return $button;
}

add_filter( 'bp_get_send_public_message_button', 'connect_bp_send_message_button' );
add_filter( 'bp_get_send_message_button_args', 'connect_bp_send_message_button' );


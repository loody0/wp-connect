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

/**
 * Custom Output the Group members template
 *
 * @return string html output
 */
function connect_bp_groups_members_template_part() {
    ?>
    <div class="item-list-tabs" id="subnav" role="navigation">
        <ul>
            <li class="groups-members-search" role="search">
                <?php bp_directory_members_search_form(); ?>
            </li>

            <?php connect_bp_groups_members_filter(); ?>
            <?php
            /**
             * Fires at the end of the group members search unordered list.
             *
             * Part of bp_groups_members_template_part().
             *
             * @since BuddyPress (1.5.0)
             */
            do_action( 'bp_members_directory_member_sub_types' );
            ?>

        </ul>
    </div>

    <div id="members-group-list" class="group_members dir-list">

        <?php bp_get_template_part( 'groups/single/members' ); ?>

    </div>
    <?php
}

/**
 * Custom Output the Group members filters
 *
 * @return string html output
 */
function connect_bp_groups_members_filter() {
    ?>
    <li id="group_members-order-select" class="last filter">
        <div class="connect-order-select-wrap">

            <select id="group_members-order-by" class="form-control connect-order-select">
                <option value="last_joined"><?php _e( 'Newest', 'buddypress' ); ?></option>
                <option value="first_joined"><?php _e( 'Oldest', 'buddypress' ); ?></option>

                <?php if ( bp_is_active( 'activity' ) ) : ?>
                    <option value="group_activity"><?php _e( 'Group Activity', 'buddypress' ); ?></option>
                <?php endif; ?>

                <option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>

                <?php
                /**
                 * Fires at the end of the Group members filters select input.
                 *
                 * Useful for plugins to add more filter options.
                 *
                 * @since BuddyPress (2.0.0)
                 */
                do_action( 'bp_groups_members_order_options' );
                ?>

            </select>
        </div>
    </li>
    <?php
}

/**
 * add class to get_edit_field_html_elements ( profile edit fieleds )
 * 
 * @see BP_XProfile_Field_Type::get_edit_field_html_elements()
 * 
 * @param array $r html_elements
 * @param string $class Class name
 * 
 * @return array $r html elements
 */
function connect_bp_xprofile_field_edit_html_elements( $r, $class ) {
//    'checkbox' => 'BP_XProfile_Field_Type_Checkbox',
//    'datebox' => 'BP_XProfile_Field_Type_Datebox',
//    'multiselectbox' => 'BP_XProfile_Field_Type_Multiselectbox',
//    'number' => 'BP_XProfile_Field_Type_Number',
//    'url' => 'BP_XProfile_Field_Type_URL',
//    'radio' => 'BP_XProfile_Field_Type_Radiobutton',
//    'selectbox' => 'BP_XProfile_Field_Type_Selectbox',
//    'textarea' => 'BP_XProfile_Field_Type_Textarea',
//    'textbox' => 'BP_XProfile_Field_Type_Textbox',
    $fields = array(
        'BP_XProfile_Field_Type_Textbox',
        'BP_XProfile_Field_Type_Textarea',
        'BP_XProfile_Field_Type_Number',
        'BP_XProfile_Field_Type_URL',
        'BP_XProfile_Field_Type_Multiselectbox'
    );
    if ( in_array( $class, $fields ) ) {
        $r[ 'class' ] = 'form-control';
        return $r;
    }

    $fields = array(
        'BP_XProfile_Field_Type_Selectbox',
        'BP_XProfile_Field_Type_Datebox'
    );
    if ( in_array( $class, $fields ) ) {
        $r[ 'class' ] = 'form-control field-inline-block';
        return $r;
    }

    return $r;
}

add_filter( 'bp_xprofile_field_edit_html_elements', 'connect_bp_xprofile_field_edit_html_elements', 10, 2 );

/**
 * Output the form for changing the sort order of notifications
 *
 */
function connect_bp_notifications_sort_order_form() {

    // Setup local variables
    $orders = array( 'DESC', 'ASC' );
    $selected = 'DESC';

    // Check for a custom sort_order
    if ( !empty( $_REQUEST[ 'sort_order' ] ) ) {
        if ( in_array( $_REQUEST[ 'sort_order' ], $orders ) ) {
            $selected = $_REQUEST[ 'sort_order' ];
        }
    }
    ?>

    <form action="" method="get" id="notifications-sort-order">

        <select id="notifications-sort-order-list" name="sort_order" onchange="this.form.submit();" class="form-control">
            <option value="DESC" <?php selected( $selected, 'DESC' ); ?>><?php _e( 'Newest First', 'buddypress' ); ?></option>
            <option value="ASC"  <?php selected( $selected, 'ASC' ); ?>><?php _e( 'Oldest First', 'buddypress' ); ?></option>
        </select>

        <noscript>
        <input id="submit" type="submit" name="form-submit" class="submit" value="<?php esc_attr_e( 'Go', 'buddypress' ); ?>" />
        </noscript>
    </form>

    <?php
}

/**
 * Output the dropdown for bulk management of notifications.
 *
 */
function connect_bp_notifications_bulk_management_dropdown() {
    ?>
    <div class="form-inline">

        <label class="bp-screen-reader-text" for="notification-select"><?php _e( 'Select Bulk Action', 'buddypress' ); ?></label>
        <select name="notification_bulk_action" id="notification-select" class="form-control">
            <option value="" selected="selected"><?php _e( 'Bulk Actions', 'buddypress' ); ?></option>

            <?php if ( bp_is_current_action( 'unread' ) ) : ?>
                <option value="read"><?php _e( 'Mark read', 'buddypress' ); ?></option>
            <?php elseif ( bp_is_current_action( 'read' ) ) : ?>
                <option value="unread"><?php _e( 'Mark unread', 'buddypress' ); ?></option>
            <?php endif; ?>
            <option value="delete"><?php _e( 'Delete', 'buddypress' ); ?></option>
        </select>
        <input type="submit" id="notification-bulk-manage" class="button action btn btn-default connect-btn connect-btn-default" value="<?php esc_attr_e( 'Apply', 'buddypress' ); ?>">
    </div>
    <?php
}

get_template_part( 'inc/buddypress/navbar-login' );
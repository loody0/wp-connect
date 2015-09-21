<?php
/**
 * BuddyPress - Users Friends
 *
 * @package Connect
 * @subpackage buddypress
 */
?>

<div class="item-list-tabs no-ajax connect-item-list-tabs connect-single-item-list-tabs" id="subnav" role="navigation">
    <ul>
        <?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>

        <?php if ( !bp_is_current_action( 'requests' ) ) : ?>

            <li id="members-order-select" class="last filter">

                <select id="members-friends" class="form-control">
                    <option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
                    <option value="newest"><?php _e( 'Newest Registered', 'buddypress' ); ?></option>
                    <option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>

                    <?php
                    /**
                     * Fires inside the members friends order options select input.
                     *
                     * @since BuddyPress (2.0.0)
                     */
                    do_action( 'bp_member_friends_order_options' );
                    ?>

                </select>
            </li>

        <?php endif; ?>

    </ul>
</div>

<?php
switch ( bp_current_action() ) :

    // Home/My Friends
    case 'my-friends' :

        /**
         * Fires before the display of member friends content.
         *
         * @since BuddyPress (1.2.0)
         */
        do_action( 'bp_before_member_friends_content' );
        ?>

        <div class="members friends dir-list">

            <?php bp_get_template_part( 'members/members-loop' ) ?>

        </div><!-- .members.friends -->

        <?php
        /**
         * Fires after the display of member friends content.
         *
         * @since BuddyPress (1.2.0)
         */
        do_action( 'bp_after_member_friends_content' );
        break;

    case 'requests' :
        bp_get_template_part( 'members/single/friends/requests' );
        break;

    // Any other
    default :
        bp_get_template_part( 'members/single/plugins' );
        break;
endswitch;

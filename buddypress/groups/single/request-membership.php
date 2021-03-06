<?php
/**
 * Fires before the display of the group membership request form.
 *
 * @since BuddyPress (1.1.0)
 */
do_action( 'bp_before_group_request_membership_content' );
?>

<?php if ( !bp_group_has_requested_membership() ) : ?>
    <p><?php printf( __( "You are requesting to become a member of the group '%s'.", "buddypress" ), bp_get_group_name( false ) ); ?></p>

    <form action="<?php bp_group_form_action( 'request-membership' ); ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">
        <div class="form-group">
            <label for="group-request-membership-comments"><?php _e( 'Comments (optional)', 'buddypress' ); ?></label>
            <textarea name="group-request-membership-comments" id="group-request-membership-comments" class="form-control"></textarea>
        </div>

        <?php
        /**
         * Fires after the textarea for the group membership request form.
         *
         * @since BuddyPress (1.1.0)
         */
        do_action( 'bp_group_request_membership_content' );
        ?>

        <p><input type="submit" class="btn btn-primary connect-btn connect-btn-primary" name="group-request-send" id="group-request-send" value="<?php esc_attr_e( 'Send Request', 'buddypress' ); ?>" />

            <?php wp_nonce_field( 'groups_request_membership' ); ?>
    </form><!-- #request-membership-form -->
<?php endif; ?>

<?php
/**
 * Fires after the display of the group membership request form.
 *
 * @since BuddyPress (1.1.0)
 */
do_action( 'bp_after_group_request_membership_content' );
?>

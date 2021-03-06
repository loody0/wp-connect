<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_before_member_settings_template' ); ?>

<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/notifications'; ?>" method="post" class="standard-form" id="settings-form">
    <label style="margin-bottom: 15px;"><?php _e( 'Send an email notice when:', 'buddypress' ); ?></label>

	<?php

	/**
	 * Fires at the top of the member template notification settings form.
	 *
	 * @since BuddyPress (1.0.0)
	 */
	do_action( 'bp_notification_settings' ); ?>

	<?php

	/**
	 * Fires before the display of the submit button for user notification saving.
	 *
	 * @since BuddyPress (1.5.0)
	 */
	do_action( 'bp_members_notification_settings_before_submit' ); ?>

	<div class="submit">
		<input type="submit" name="submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto btn btn-primary connect-btn connect-btn-primary" />
	</div>

	<?php

	/**
	 * Fires after the display of the submit button for user notification saving.
	 *
	 * @since BuddyPress (1.5.0)
	 */
	do_action( 'bp_members_notification_settings_after_submit' ); ?>

	<?php wp_nonce_field('bp_settings_notifications' ); ?>

</form>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_after_member_settings_template' ); ?>

<?php
/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_before_member_settings_template' );
?>

<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

    <?php if ( !is_super_admin() ) : ?>
        <div class="form-group">
            <label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
            <input type="password" name="pwd" id="pwd" size="30" value="" class="settings-input small form-control" style="width: auto; max-width: 100%;" <?php bp_form_field_attributes( 'password' ); ?>/> 
            <a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>
        </div>

    <?php endif; ?>
    <div class="form-group">
        <label for="email"><?php _e( 'Account Email', 'buddypress' ); ?></label>
        <input type="email" name="email" id="email" size="30"  value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input form-control" style="width: auto; max-width: 100%;" <?php bp_form_field_attributes( 'email' ); ?>/>
    </div>

    <label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'buddypress' ); ?></label>
    <div class="form-group">
        <?php _e( 'New Password', 'buddypress' ); ?>
        <input type="password" name="pass1" id="pass1" size="30" value="" class="settings-input small password-entry form-control" style="width: auto; max-width: 100%;" <?php bp_form_field_attributes( 'password' ); ?>/>
    </div>
    <div id="pass-strength-result"></div>
    <div class="form-group">
        <?php _e( 'Repeat New Password', 'buddypress' ); ?>
        <input type="password" name="pass2" id="pass2" size="30" value="" class="settings-input small password-entry-confirm form-control" style="width: auto; max-width: 100%;" <?php bp_form_field_attributes( 'password' ); ?>/>
    </div>

    <?php
    /**
     * Fires before the display of the submit button for user general settings saving.
     *
     * @since BuddyPress (1.5.0)
     */
    do_action( 'bp_core_general_settings_before_submit' );
    ?>

    <div class="submit">
        <input type="submit" name="submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto btn btn-primary connect-btn connect-btn-primary" />
    </div>

    <?php
    /**
     * Fires after the display of the submit button for user general settings saving.
     *
     * @since BuddyPress (1.5.0)
     */
    do_action( 'bp_core_general_settings_after_submit' );
    ?>

    <?php wp_nonce_field( 'bp_settings_general' ); ?>

</form>

<?php
/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_after_member_settings_template' );
?>

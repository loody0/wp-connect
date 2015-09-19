<?php
/**
 * @package connect
 */
?>

<!-- Show logged out message if user just logged out -->
<?php if ( $attributes[ 'logged_out' ] ) : ?>
    <p class="login-info">
        <?php _e( 'You have signed out. Would you like to sign in again?', 'connect' ); ?>
    </p>
<?php endif; ?>

<!-- Show errors if there are any -->
<?php if ( count( $attributes[ 'errors' ] ) > 0 ) : ?>
    <?php foreach ( $attributes[ 'errors' ] as $error ) : ?>
        <p class="login-error">
            <?php echo $error; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>

<div class="login-form-container">
    <form method="post" action="<?php echo wp_login_url(); ?>">
        <p class="login-username">
            <label for="user_login"><?php _e( 'Email', 'connect' ); ?></label>
            <input type="text" name="log" id="user_login">
        </p>
        <p class="login-password">
            <label for="user_pass"><?php _e( 'Password', 'connect' ); ?></label>
            <input type="password" name="pwd" id="user_pass">
        </p>
        <p class="login-submit">
            <input type="submit" value="<?php _e( 'Sign In', 'connect' ); ?>">
            <?php if ( !empty( $attributes[ 'redirect' ] ) ) { ?>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( $attributes[ 'redirect' ] ); ?>">
                <?php
            }
            ?>
        </p>
    </form>
</div>
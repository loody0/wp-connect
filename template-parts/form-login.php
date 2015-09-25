<?php
/**
 * @package connect
 */
?>


<div class="login-form-container">
    <div class="panel panel-default panel-login animated fadeInUpLogin">
        <div class="panel-body">
            <!-- Show logged out message if user just logged out -->
            <?php if ( $attributes[ 'logged_out' ] ) : ?>
                <div class="alert alert-info login-info">
                    <?php _e( 'You have signed out. Would you like to sign in again?', 'connect' ); ?>
                </div>
            <?php endif; ?>

            <!-- Show errors if there are any -->
            <?php if ( count( $attributes[ 'errors' ] ) > 0 ) : ?>
                <?php foreach ( $attributes[ 'errors' ] as $error ) : ?>
                    <div class="alert alert-danger login-error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <form method="post" action="<?php echo wp_login_url(); ?>">
                <div class="form-group form-group-lg">
                    <input type="text" name="log" id="user_login" class="form-control input-login" placeholder="<?php _ex( 'Email', 'placeholder', 'connect' ); ?>">
                </div>
                <div class="form-group form-group-lg">
                    <input type="password" name="pwd" id="user_pass" class="form-control input-login" placeholder="<?php _ex( 'Password', 'placeholder', 'connect' ); ?>" >
                </div>
                <div class="form-group form-group-lg" style="margin: 20px 0;">
                    <div class="checkbox">
                        <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me </label>
                        <div class="pull-right" style="margin-left: 10px;">
                            <a href="<?php echo wp_lostpassword_url(); ?>">Forgot Password?</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <input type="submit" value="<?php _e( 'Sign In', 'connect' ); ?>" class="btn btn-primary btn-block btn-lg connect-btn connect-btn-primary">
                <?php if ( !empty( $attributes[ 'redirect' ] ) ) { ?>
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $attributes[ 'redirect' ] ); ?>">
                    <?php
                }
                ?>
            </form>
        </div>
        <div class="panel-footer">
            Don’t have an account? <a href="#">Sign Up</a>
        </div>
    </div>
</div>
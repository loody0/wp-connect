<?php
/**
 * @package connect
 */
?>


<div class="login-nav">
    <div class="panel panel-default panel-login" style="margin-bottom: 0;">
        <div class="panel-body">
            <!-- Show logged out message if user just logged out -->

            <form method="post" action="<?php echo wp_login_url(); ?>">
                <div class="form-group">
                    <input type="text" name="log" id="user_login" class="form-control input-login" placeholder="<?php _ex( 'Email', 'placeholder', 'connect' ); ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" id="user_pass" class="form-control input-login" placeholder="<?php _ex( 'Password', 'placeholder', 'connect' ); ?>" >
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input name="rememberme" type="checkbox" id="rememberme" value="forever" style="top: -3px;"> Remember me </label>
                        <div class="pull-right" style="margin-left: 10px;">
                            <a href="<?php echo wp_lostpassword_url(); ?>">Forgot Password?</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <input type="submit" value="<?php _e( 'Sign In', 'connect' ); ?>" class="btn btn-primary btn-block connect-btn connect-btn-primary">
                <?php
                $redirect = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ]
                ?>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect ); ?>">

            </form>
        </div>
        <div class="panel-footer">
            Don’t have an account? <a href="<?php echo wp_registration_url(); ?>">Sign Up</a>
        </div>
    </div>
</div>
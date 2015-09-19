<?php

/**
 * @package Connect
 * 
 * Connect_Custom_Login class for rendering login form
 */
class Connect_Custom_Login {

    public $login_page = 'member-login';

    /**
     * the constructor of Connect_Custom_Login
     */
    public function __construct() {
        add_shortcode( 'custom-login-form', array( $this, 'render_login_form' ) );

        add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );

        add_filter( 'login_redirect', array( $this, 'redirect_login' ), 10, 3 );

        add_filter( 'authenticate', array( $this, 'redirect_at_authenticate' ), 101, 3 );

        add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );
    }

    /**
     * A shortcode for rendering the login form.
     * 
     * @return string  The shortcode output
     */
    public function render_login_form() {

        if ( is_user_logged_in() ) {
            // show content or redirect page by js if user logged in
            return __( 'You are already signed in.', 'connect' );
        }

        // Pass the redirect parameter to the WordPress login functionality: by default,
        // don't specify a redirect, but if a valid redirect URL has been passed as
        // request parameter, use it.
        $attributes[ 'redirect' ] = '';
        if ( isset( $_REQUEST[ 'redirect_to' ] ) ) {
            $attributes[ 'redirect' ] = wp_validate_redirect( $_REQUEST[ 'redirect_to' ], $attributes[ 'redirect' ] );
        }

        // Error messages
        $errors = array();
        if ( isset( $_REQUEST[ 'login' ] ) ) {
            $error_codes = explode( ',', $_REQUEST[ 'login' ] );

            foreach ( $error_codes as $code ) {
                $errors [] = $this->get_error_message( $code );
            }
        }
        $attributes[ 'errors' ] = $errors;

        // Check if user just logged out
        $attributes[ 'logged_out' ] = isset( $_REQUEST[ 'logged_out' ] ) && $_REQUEST[ 'logged_out' ] == true;

        // Render the login form using an external template
        ob_start();

        require CONNECT_DIR . '/template-parts/form-login.php';

        return ob_get_clean();
    }

    /**
     * Redirect the user to the custom login page instead of wp-login.php.
     */
    function redirect_to_custom_login() {

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
            $redirect_to = isset( $_REQUEST[ 'redirect_to' ] ) ? $_REQUEST[ 'redirect_to' ] : null;

            // The rest are redirected to the login page
            $login_url = home_url( $this->login_page );
            if ( !empty( $redirect_to ) ) {
                $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
            }

            wp_redirect( $login_url );
            exit;
        }
    }

    /**
     * Redirect user after successful login.
     *
     * @param string $redirect_to URL to redirect to.
     * @param string $request URL the user is coming from.
     * @param object $user Logged user's data.
     * @return string
     */
    function redirect_login( $redirect_to, $request, $user ) {
        //is there a user to check?
        global $user;
        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            //check for admins
            if ( in_array( 'administrator', $user->roles ) ) {
                // redirect them to the default place
                return $redirect_to;
            } else {
                return home_url();
            }
        } else {
            return $redirect_to;
        }
    }

    /**
     * Redirect the user after authentication if there were any errors.
     *
     * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
     * @param string            $username   The user name used to log in.
     * @param string            $password   The password used to log in.
     *
     * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
     */
    function redirect_at_authenticate( $user, $username, $password ) {
        // Check if the earlier authenticate filter (most likely, 
        // the default WordPress authentication) functions have found errors
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            if ( is_wp_error( $user ) ) {
                $error_codes = join( ',', $user->get_error_codes() );

                $login_url = home_url( $this->login_page );
                $login_url = add_query_arg( 'login', $error_codes, $login_url );

                wp_redirect( $login_url );
                exit;
            }
        }
        return $user;
    }

    /**
     * Finds and returns a matching error message for the given error code.
     *
     * @param string $error_code    The error code to look up.
     *
     * @return string               An error message.
     */
    private function get_error_message( $error_code ) {
        switch ( $error_code ) {
            case 'empty_username':
                return __( 'You need to enter a email address or username to login.', 'connect' );

            case 'empty_password':
                return __( 'You need to enter a password to login.', 'connect' );

            case 'invalid_username':
                return __( "We don't have any users with that email address.", 'connect' );

            case 'incorrect_password':
                $err = __( "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?", 'connect' );
                return sprintf( $err, wp_lostpassword_url() );

            default:
                break;
        }

        return __( 'An unknown error occurred. Please try again later.', 'connect' );
    }

    /**
     * Redirect to custom login page after the user has been logged out.
     */
    public function redirect_after_logout() {
        $redirect_url = home_url( $this->login_page . '?logged_out=true' );
        wp_safe_redirect( $redirect_url );
        exit;
    }

}

// Initialize the plugin
$connect_custom_login = new Connect_Custom_Login();

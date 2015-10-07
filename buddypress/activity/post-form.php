<?php
/**
 * BuddyPress - Activity Post Form
 *
 * @package Connect
 * @subpackage buddypress
 */
?>


<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-for" name="whats-new-form" role="complementary">

    <?php
    /**
     * Fires before the activity post form.
     *
     * @since BuddyPress (1.2.0)
     */
    do_action( 'bp_before_activity_post_form' );
    ?>

    <div id="whats-new-content">
        <div class="post-box">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#postnews" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
                <?php do_action( 'bp_activity_post_form_nav' );//to enable plugins to inject links to other activity types?>
                <li role="presentation" class="dropdown more">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </a>
                    <ul class="dropdown-menu">
                    </ul>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <!--news-->
                <div role="tabpanel" class="tab-pane tab-home active" id="postnews">
                    <div class="form-group">   
                        <?php
                        $placeholder = (bp_is_group()) ?
                            sprintf( __( "What's new in %s, %s?", 'buddypress' ), bp_get_group_name(), bp_get_user_firstname( bp_get_loggedin_user_fullname() ) ) :
                            sprintf( __( "What's new, %s?", 'buddypress' ), bp_get_user_firstname( bp_get_loggedin_user_fullname() ) );
                        ?>
                        <div id="whats-new-textarea" >
                            <textarea id="whats-new" class="form-control post-box-text" name="whats-new"  placeholder="<?php esc_attr_e( $placeholder ); ?>"
                                      <?php if ( bp_is_group() ) : ?>data-suggestions-group-id="<?php echo esc_attr( ( int ) bp_get_current_group_id() ); ?>" <?php endif; ?>
                                      ><?php if ( isset( $_GET[ 'r' ] ) ) : ?>@<?php echo esc_textarea( $_GET[ 'r' ] ); ?> <?php endif; ?></textarea>
                        </div>

                    </div>
                </div>
                <?php do_action( 'bp_activity_post_form_tabs_' );//to enable plugins to inject other activity type forms?>

            </div>

            <div id="whats-new-options" class="post-options text-right form-inline">

                <?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

                    <div id="whats-new-post-in-box">

                        <select id="whats-new-post-in" name="whats-new-post-in" class="form-control">
                            <option selected="selected" value="0"><?php _e( 'My Profile', 'buddypress' ); ?></option>

                            <?php
                            if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0&update_meta_cache=0' ) ) :
                                while ( bp_groups() ) : bp_the_group();
                                    ?>

                                    <option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

                                    <?php
                                endwhile;
                            endif;
                            ?>

                        </select>
                    <input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
                    </div>

                <?php elseif ( bp_is_group_home() ) : ?>

                    <input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
                    <input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

                <?php endif; ?>
                
                <div id="whats-new-submit">
                    <input type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" class="btn btn-default connect-btn connect-btn-primary post-button" value="<?php esc_attr_e( 'Post Update', 'buddypress' ); ?>" disabled />
                </div>
                    
                <?php
                /**
                 * Fires at the end of the activity post form markup.
                 *
                 * @since BuddyPress (1.2.0)
                 */
                do_action( 'bp_activity_post_form_options' );
                ?>
            
            </div><!-- #whats-new-options -->
        </div>

    </div><!-- #whats-new-content -->

    <?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
    <?php
    /**
     * Fires after the activity post form.
     *
     * @since BuddyPress (1.2.0)
     */
    do_action( 'bp_after_activity_post_form' );
    ?>

</form><!-- #whats-new-form -->

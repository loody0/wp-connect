<?php
/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package Connect
 * @subpackage buddypress
 */
?>

<?php
/**
 * Fires before the display of an activity entry.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_activity_entry' );
?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">
    <div class="panel panel-default activity-panel">
        <div class="panel-body">


            <div class="activity-avatar">
                <a href="<?php bp_activity_user_link(); ?>">

                    <?php bp_activity_avatar(); ?>

                </a>
            </div>

            <div class="activity-header">

                <?php bp_activity_action(); ?>

            </div>
            <div class="clearfix"></div>


            <div class="activity-content">

                <?php if ( bp_activity_has_content() ) : ?>

                    <div class="activity-inner">

                        <?php bp_activity_content_body(); ?>

                    </div>

                <?php endif; ?>

                <?php
                /**
                 * Fires after the display of an activity entry content.
                 *
                 * @since BuddyPress (1.2.0)
                 */
                do_action( 'bp_activity_entry_content' );
                ?>

                <div class="activity-meta">

                    <?php if ( bp_get_activity_type() == 'activity_comment' ) : ?>

                        <a href="<?php bp_activity_thread_permalink(); ?>" class="button view bp-secondary-action" title="<?php esc_attr_e( 'View Conversation', 'buddypress' ); ?>"><?php _e( 'View Conversation', 'buddypress' ); ?></a>

                    <?php endif; ?>

                    <?php if ( is_user_logged_in() ) : ?>

                        <?php if ( bp_activity_can_comment() ) : ?>

                            <a href="<?php bp_activity_comment_link(); ?>" class="button acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id(); ?>"><i class="fa fa-comment"></i> <?php echo bp_activity_get_comment_count(); ?></a>

                        <?php endif; ?>

                        <?php if ( bp_activity_can_favorite() ) : ?>

                            <?php if ( !bp_get_activity_is_favorite() ) : ?>

                                <a href="<?php bp_activity_favorite_link(); ?>" class="button fav bp-secondary-action" title="<?php esc_attr_e( 'Mark as Favorite', 'buddypress' ); ?>"><i class="fa fa-heart"></i></a>

                            <?php else : ?>

                                <a href="<?php bp_activity_unfavorite_link(); ?>" class="button unfav bp-secondary-action" title="<?php esc_attr_e( 'Remove Favorite', 'buddypress' ); ?>"><?php _e( 'Remove Favorite', 'buddypress' ); ?></a>

                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( bp_activity_user_can_delete() ) bp_activity_delete_link(); ?>

                        <?php
                        /**
                         * Fires at the end of the activity entry meta data area.
                         *
                         * @since BuddyPress (1.2.0)
                         */
                        do_action( 'bp_activity_entry_meta' );
                        ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

    <?php
    /**
     * Fires before the display of the activity entry comments.
     *
     * @since BuddyPress (1.2.0)
     */
    do_action( 'bp_before_activity_entry_comments' );
    ?>

    <?php if ( ( bp_activity_get_comment_count() || bp_activity_can_comment() ) || bp_is_single_activity() ) : ?>

        <div class="activity-comments panel panel-default activity-comment-panel">


            <?php bp_activity_comments(); ?>

            <?php if ( is_user_logged_in() && bp_activity_can_comment() ) : ?>

                <form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>


                    <div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=40&height=40' ); ?></div>

                    <div class="ac-reply-content">
                        <div class="ac-textarea form-group">
                            <textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input bp-suggestions form-control" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
                        </div>
                        <input type="submit" name="ac_form_submit" class="btn btn-primary connect-btn connect-btn-primary" value="<?php esc_attr_e( 'Post', 'buddypress' ); ?>" /> &nbsp; <a href="#" class="ac-reply-cancel"><?php _e( 'Cancel', 'buddypress' ); ?></a>
                        <input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
                    </div>
                    <div class="clearfix"></div>



                    <?php
                    /**
                     * Fires after the activity entry comment form.
                     *
                     * @since BuddyPress (1.5.0)
                     */
                    do_action( 'bp_activity_entry_comments' );
                    ?>

                    <?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>

                </form>

            <?php endif; ?>

        </div>

    <?php endif; ?>

    <?php
    /**
     * Fires after the display of the activity entry comments.
     *
     * @since BuddyPress (1.2.0)
     */
    do_action( 'bp_after_activity_entry_comments' );
    ?>

</li>

<?php
/**
 * Fires after the display of an activity entry.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_activity_entry' );
?>

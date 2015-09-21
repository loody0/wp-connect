<?php
/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
?>

<?php
/**
 * Fires before the display of groups from the groups loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_groups_loop' );
?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

    <?php
    /**
     * Fires before the listing of the groups list.
     *
     * @since BuddyPress (1.1.0)
     */
    do_action( 'bp_before_directory_groups_list' );
    ?>

    <ul id="groups-list" class="item-list row">

        <?php $groups_ind = 0; ?>
        <?php while ( bp_groups() ) : bp_the_group(); ?>
            <?php global $groups_template; ?>
            <li <?php bp_group_class( array( 'col-lg-6' ) ); ?>>
                <div class="panel panel-default group-panel">
                    <?php if ( !bp_disable_group_avatar_uploads() ) : ?>

                        <div class="item-avatar">
                            <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=150&height=150' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="panel-body">

                        <div class="item">

                            <div class="meta"><?php bp_group_type(); ?> / <?php bp_group_member_count(); ?></div>

                            <div class="item-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>

                            <div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

                            <?php
                            /**
                             * Fires inside the listing of an individual group listing item.
                             *
                             * @since BuddyPress (1.1.0)
                             */
                            do_action( 'bp_directory_groups_item' );
                            ?>

                        </div>
                        <div class="action">

                            <div class="item-meta"><span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span></div>

                            <?php
                            /**
                             * Fires inside the action section of an individual group listing item.
                             *
                             * @since BuddyPress (1.1.0)
                             */
                            do_action( 'bp_directory_groups_actions' );
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </li>
            <?php
            $groups_ind++;
            if ( $groups_ind % 2 == 0 ) {
                echo '<li class="clearfix"></li>';
            }
            ?>

        <?php endwhile; ?>
    </ul>


    <?php
    /**
     * Fires after the listing of the groups list.
     *
     * @since BuddyPress (1.1.0)
     */
    do_action( 'bp_after_directory_groups_list' );
    ?>

    <div id="pag-bottom" class="pagination connect-pagination clearfix">

        <div class="pag-count pull-left" id="group-dir-count-bottom">
            <label>
                <?php bp_groups_pagination_count(); ?>
            </label>
        </div>

        <div class="pagination-links pull-right" id="group-dir-pag-bottom">

            <?php bp_groups_pagination_links(); ?>

        </div>

    </div>

<?php else: ?>

    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
    </div>

<?php endif; ?>

<?php
/**
 * Fires after the display of groups from the groups loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_groups_loop' );
?>

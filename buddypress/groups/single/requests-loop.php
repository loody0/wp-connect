<?php if ( bp_group_has_membership_requests( bp_ajax_querystring( 'membership_requests' ) ) ) : ?>

    <div id="pag-top" class="pagination connect-pagination connect-pagination-top clearfix">

        <div class="pag-count pull-left" id="group-mem-requests-count-top">

            <?php bp_group_requests_pagination_count(); ?>

        </div>

        <div class="pagination-links pull-right" id="group-mem-requests-pag-top">

            <?php bp_group_requests_pagination_links(); ?>

        </div>

    </div>
    <div class="members dir-list">

        <ul id="request-list" class="item-list">
            <?php while ( bp_group_membership_requests() ) : bp_group_the_membership_request(); ?>

                <li>
                    <div class="item-avatar">
                        <?php bp_group_request_user_avatar_thumb(); ?>
                    </div>
                    <div class="item">
                        <div class="item-name">
                            <?php bp_group_request_user_link(); ?> 
                        </div>
                        <span class="activity"><?php bp_group_request_time_since_requested(); ?></span>
                        <div class="item-content comments"><?php bp_group_request_comment(); ?></div>

                        <?php
                        /**
                         * Fires inside the groups membership request list loop.
                         *
                         * @since BuddyPress (1.1.0)
                         */
                        do_action( 'bp_group_membership_requests_admin_item' );
                        ?>
                    </div>

                    <div class="action">

                        <?php bp_button( array( 'wrapper' =>'span', 'id' => 'group_membership_accept', 'component' => 'groups', 'wrapper_class' => 'accept', 'link_href' => bp_get_group_request_accept_link(), 'link_title' => __( 'Accept', 'buddypress' ), 'link_text' => __( 'Accept', 'buddypress' ), 'link_class' => ' btn btn-primary connect-btn connect-btn-primary' ) ); ?>

                        <?php bp_button( array( 'wrapper' =>'span', 'id' => 'group_membership_reject', 'component' => 'groups', 'wrapper_class' => 'reject', 'link_href' => bp_get_group_request_reject_link(), 'link_title' => __( 'Reject', 'buddypress' ), 'link_text' => __( 'Reject', 'buddypress' ), 'link_class' => ' btn btn-default connect-btn connect-btn-default' ) ); ?>

                        <?php
                        /**
                         * Fires inside the list of membership request actions.
                         *
                         * @since BuddyPress (1.1.0)
                         */
                        do_action( 'bp_group_membership_requests_admin_item_action' );
                        ?>

                    </div>
                </li>

            <?php endwhile; ?>
        </ul>
    </div>

    <div id="pag-bottom" class="pagination connect-pagination clearfix">

        <div class="pag-count pull-left" id="group-mem-requests-count-bottom">

            <?php bp_group_requests_pagination_count(); ?>

        </div>

        <div class="pagination-links pull-right" id="group-mem-requests-pag-bottom">

            <?php bp_group_requests_pagination_links(); ?>

        </div>

    </div>

<?php else: ?>

    <div id="message" class="info">
        <p><?php _e( 'There are no pending membership requests.', 'buddypress' ); ?></p>
    </div>

<?php endif; ?>

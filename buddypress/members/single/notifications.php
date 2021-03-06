<?php

/**
 * BuddyPress - Users Notifications
 *
 * @package Connect
 * @subpackage buddypress
 */

?>

<div class="item-list-tabs connect-item-list-tabs connect-single-item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php bp_get_options_nav(); ?>

		<li id="members-order-select" class="last filter">
			<?php connect_bp_notifications_sort_order_form(); ?>
		</li>
	</ul>
</div>

<?php
switch ( bp_current_action() ) :

	// Unread
	case 'unread' :
		bp_get_template_part( 'members/single/notifications/unread' );
		break;

	// Read
	case 'read' :
		bp_get_template_part( 'members/single/notifications/read' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;

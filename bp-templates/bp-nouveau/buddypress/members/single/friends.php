<?php
/**
 * BuddyPress - Users Friends
 *
 * @since  1.0.0
 *
 * @package BP Nouveau
 */

?>

<nav class="bp-navs bp-subnavs user-subnav no-ajax" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Friends menu', 'buddypress' ); ?>">
	<ul class="subnav">
		<?php if ( bp_is_my_profile() ) : ?>

			<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>

		<?php endif ; ?>
	</ul>
</nav><!-- .bp-navs -->

<?php bp_get_template_part( 'common/search-&-filters-bar' ); ?>

<?php
switch ( bp_current_action() ) :

	// Home/My Friends
	case 'my-friends' :

		bp_nouveau_member_hook( 'before', 'friends_content' ); ?>

		<div class="members friends" data-bp-list="members">

			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-friends-loading' ) ;?></div>

		</div><!-- .members.friends -->

		<?php bp_nouveau_member_hook( 'after', 'friends_content' );
		break;

	case 'requests' :
		bp_get_template_part( 'members/single/friends/requests' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;

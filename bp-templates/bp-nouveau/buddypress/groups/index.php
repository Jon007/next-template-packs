<?php
/**
 * BuddyPress - Groups
 *
 * @package BuddyPress
 * @subpackage bp-nouveau
 */

?>

<div id="buddypress" class="buddypress">

<?php
/**
 * Fires at the begining of the templates BP injected content.
 *
 * @since 2.3.0
 */

	do_action( 'bp_before_directory_groups_page' ); ?>

	<?php

	/**
	 * Fires before the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups' ); ?>

	<?php

	/**
	 * Fires before the display of the groups content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups_content' ); ?>

	<?php bp_nouveau_template_notices(); ?>

	<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

		<?php bp_get_template_part( 'common/nav/directory-nav' ); ?>

	<?php endif; ?>

	<div class="item-list-tabs" id="subnav" role="navigation">

		<ul type="list" class="subnav clearfix">
				<?php bp_get_template_part( 'common/search/dir-search-form' ); ?>
		</ul>

			<?php

			/**
			 * Fires inside the groups directory group types.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_groups_directory_group_types' ); ?>

			<?php bp_get_template_part( 'common/filters/directory-filters' ); ?>

	</div>

	<div id="groups-dir-list" class="groups dir-list" data-bp-list="groups">
		<div id="bp-ajax-loader">loading</div>
	</div><!-- #groups-dir-list -->

	<?php

	/**
	 * Fires and displays the group content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_directory_groups_content' ); ?>

	<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

	<?php

	/**
	 * Fires after the display of the groups content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups_content' ); ?>

	<?php

	/**
	 * Fires after the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups' ); ?>

	<?php

	/**
	 * Fires at the bottom of the groups directory template file.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_directory_groups_page' ); ?>

</div><!-- //.buddypress -->

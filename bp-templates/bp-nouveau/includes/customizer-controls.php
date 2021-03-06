<?php
/**
 * Customizer controls
 *
 * @since 1.0.0
 *
 * @package BP Nouveau
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * This control let users change the order of the BuddyPress
 * single items navigation items.
 *
 * NB: this is a first pass to improve by using Javascript templating as explained here:
 * https://developer.wordpress.org/themes/advanced-topics/customizer-api/#putting-the-pieces-together
 *
 *
 * @since  1.0.0
 */
class BP_Nouveau_Nav_Customize_Control extends WP_Customize_Control {
	public $type = '';

	/**
	 * Render the control's content.
	 *
	 * @since  1.0.0
	 */
	public function render_content() {
		$id       = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class    = 'customize-control customize-control-' . $this->type;
		$setting  = "bp_nouveau_appearance[{$this->type}_nav_order]";
		$item_nav = array();

		// It's a group
		if ( 'group' === $this->type ) {
			$guide = __( 'Customizing the Groups navivation order needs you create at least one group first.', 'bp-nouveau' );

			// Try to fetch any random group:
			$random = groups_get_groups( array( 'type' => 'random', 'per_page' => 1, 'show_hidden' => true ) );

			if ( ! empty( $random['groups'] ) ) {
				$group    = reset( $random['groups'] );
				$nav      = new BP_Nouveau_Customizer_Group_Nav( $group->id );
				$item_nav = $nav->get_group_nav();
			}

			if ( $item_nav ) {
				$guide = __( 'All the possible group nav items are listed below, in some groups some of these nav items might not be active.', 'bp-nouveau' );
			}

		// It's a user!
		} else {
			$item_nav = bp_nouveau_member_customizer_nav();
		}
		?>

		<?php if ( isset( $guide ) ) : ?>
			<p class="description">
				<?php echo esc_html( $guide ); ?>
			</p>
		<?php endif ; ?>

		<?php if ( ! empty( $item_nav ) ) : ?>

			<ul id="<?php echo esc_attr( $id ); ?>" class="ui-sortable" style="margin-top: 0px; height: 500px;" data-bp-type="<?php echo esc_attr( $this->type ) ; ?>">

				<?php
				$i = 0;
				foreach ( $item_nav as $item) :
					$i += 1;
				?>
					<li class="<?php echo esc_attr( $class ); echo ( 1 === $i ) ? ' ui-sortable-disabled' : ''; ?>" data-bp-nav="<?php echo esc_attr( $item->slug ); ?>">
						<div class="menu-item-bar">
							<div class="menu-item-handle ui-sortable-handle">
								<span class="item-title" aria-hidden="true">
									<span class="menu-item-title"><?php echo esc_html( _bp_strip_spans_from_title( $item->name ) ) ; ?></span>
								</span>
							</div>
						</div>
					</li>
				<?php endforeach ; ?>

			</ul>

		<?php endif; ?>

			<input id="bp_item_<?php echo esc_attr( $this->type ) ; ?>" type="hidden" value="" data-customize-setting-link="<?php echo esc_attr( $setting );?>" />

		<?php
	}
}

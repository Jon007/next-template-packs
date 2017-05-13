<?php
/**
 * BP Nouveau Blogs
 *
 * @since 1.0.0
 *
 * @package BP Nouveau
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BP_Nouveau_Blogs' ) ) :
/**
 * Blogs Loader class
 *
 * @since 1.0.0
 */
class BP_Nouveau_Blogs {
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->setup_globals();
		$this->includes();

		// Setup list of add_action() hooks
		$this->setup_actions();

		// Setup list of add_filter() hooks
		$this->setup_filters();
	}

	/**
	 * Globals
	 *
	 * @since 1.0.0
	 */
	private function setup_globals() {
		$this->dir = dirname( __FILE__ );
	}

	/**
	 * Include needed files
	 *
	 * @since 1.0.0
	 */
	private function includes() {
		require( trailingslashit( $this->dir ) . 'functions.php'     );
		require( trailingslashit( $this->dir ) . 'template-tags.php' );

		// Load AJAX code only on AJAX requests.
		add_action( 'admin_init', function() {
			if ( defined( 'DOING_AJAX' ) && true === DOING_AJAX && 0 === strpos( $_REQUEST['action'], 'blogs_' ) ) {
				require( trailingslashit( $this->dir ) . 'ajax.php' );
			}
		} );
	}

	/**
	 * Register do_action() hooks
	 *
	 * @since 1.0.0
	 */
	private function setup_actions() {
		if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			// Avoid Notices for BuddyPress Legacy Backcompat
			remove_action( 'bp_blogs_directory_blog_types', 'bp_blog_backcompat_create_nav_item', 1000 );
		}
	}

	/**
	 * Register add_filter() hooks
	 *
	 * @since 1.0.0
	 */
	private function setup_filters() {
		if ( is_multisite() ) {
			// Add settings into the Blogs sections of the customizer.
			add_filter( 'bp_nouveau_customizer_settings', 'bp_nouveau_blogs_customizer_settings', 11, 1 );

			// Add controls into the Blogs sections of the customizer.
			add_filter( 'bp_nouveau_customizer_controls', 'bp_nouveau_blogs_customizer_controls', 11, 1 );
		}
	}
}

endif;

/**
 * Launch the Blogs loader class.
 *
 * @since 1.0.0
 */
function bp_nouveau_blogs( $bp_nouveau = null ) {
	if ( is_null( $bp_nouveau ) ) {
		return;
	}

	$bp_nouveau->blogs = new BP_Nouveau_Blogs();
}
add_action( 'bp_nouveau_includes', 'bp_nouveau_blogs', 10, 1 );

<?php
/**
 * Simple Social Sharer.
 *
 * @since   1.0.0
 * @package Simple_Social_Sharer
 */

/**
 * Simple Social Sharer class.
 *
 * @since 1.0.0
 */
class SSS_Sharer {
	/**
	 * Parent plugin class.
	 *
	 * @var    Simple_Social_Sharer
	 * @since  1.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 *
	 * @param  Simple_Social_Sharer $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  1.0.0
	 */
	public function hooks() {
	}

	public function links( $post_id = null ) {
		if ( ! empty( $post_id ) ) {
			$url = get_permalink( $post_id );
		} else {
			$url = $this->current_url();
		}

	}

	private function current_url() {
		global $wp;

		$current_url = trailingslashit( home_url( $wp->request ) );

		if ( ! empty( $_GET ) ) {
			$current_url = add_query_arg( $_GET, $current_url );
		}

		return $current_url;
	}
}

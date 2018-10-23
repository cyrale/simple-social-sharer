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
		$args = [];

		if ( ! empty( $post_id ) ) {
			$args['url'] = get_permalink( $post_id );
		} else {
			$args['url'] = $this->current_url();
		}

		$links = [];
		foreach ( $this->social_networks() as $network_slug => $network_class ) {
			$network = new $network_class();

			$links[ $network->slug ] = [
				'url'  => $network->get_share_url( $args ),
				'name' => $network->name,
				'slug' => $network->slug,
			];
		}

		return $links;
	}

	private function current_url() {
		global $wp;

		$current_url = trailingslashit( home_url( $wp->request ) );

		if ( ! empty( $_GET ) ) {
			$current_url = add_query_arg( $_GET, $current_url );
		}

		return $current_url;
	}

	private function social_networks() {
		return apply_filters( 'sss_social_networks', [
			'facebook'   => 'SSS_Networks_Facebook',
			'twitter'    => 'SSS_Networks_Twitter',
			'googleplus' => 'SSS_Networks_GooglePlus',
			'linkedin'   => 'SSS_Networks_LinkedIn',
			'pinterest'  => 'SSS_Networks_Pinterest',
			'email'      => 'SSS_Networks_Email',
			'link'       => 'SSS_Networks_Link',
		] );
	}
}

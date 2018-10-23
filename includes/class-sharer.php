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

	/**
	 * Get share links for the current page or a particular post.
	 *
	 * @param int|null $post_id A post ID, the current page if it's null.
	 *
	 * @return array Share links.
	 */
	public function links( $post_id = null ) {
		if ( ! empty( $post_id ) ) {
			$args = [
				'url'       => get_permalink( $post_id ),
				'title'     => get_the_title( $post_id ),
				'excerpt'   => has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '',
				'thumbnail' => has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : null,
			];
		} else {
			$args = $this->current_args();
		}

		return $this->share_links( $args );
	}

	/**
	 * Get share links from basic information like url, title, excerpt and thumbnail.
	 *
	 * @param array $args Basic information: url, title, excerpt and thumbnail.
	 *
	 * @return array Share links.
	 */
	public function share_links( $args ) {
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

	/**
	 * Get arguments (information) about the current URL.
	 *
	 * @return array Arguments
	 */
	private function current_args() {
		global $wp_locale, $wp_query;

		if ( is_front_page() || is_home() || is_singular() ) {
			$post_id = get_the_ID();

			$args = [
				'url'       => get_permalink( $post_id ),
				'title'     => get_the_title( $post_id ),
				'excerpt'   => has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '',
				'thumbnail' => has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : null,
			];
		} elseif ( is_post_type_archive() ) {
			$post_type = $wp_query->get( 'post_type' );

			$args = [
				'url'     => get_post_type_archive_link( $post_type ),
				'title'   => get_the_archive_title(),
				'excerpt' => get_the_archive_description(),
			];
		} elseif ( is_tax() || is_tag() || is_category() ) {
			$term = $wp_query->get_queried_object();

			$args = [
				'url'     => get_term_link( $term ),
				'title'   => $term->name,
				'excerpt' => $term->description,
			];
		} elseif ( is_date() ) {
			$url = $this->current_url();

			if ( is_day() ) {
				$args = [
					'url'   => $url,
					'title' => get_query_var( 'day' ) . ' ' . $wp_locale->get_month( get_query_var( 'monthnum' ) ) . ' ' . get_query_var( 'year' ),
				];
			} elseif ( is_month() ) {
				$args = [
					'url'   => $url,
					'title' => $wp_locale->get_month( get_query_var( 'monthnum' ) ) . ' ' . get_query_var( 'year' ),
				];
			} elseif ( is_year() ) {
				$args = [
					'url'   => $url,
					'title' => get_query_var( 'year' ),
				];
			}
		} elseif ( is_author() ) {
			$user = $wp_query->get_queried_object();

			$args = [
				'url'     => $this->current_url(),
				'title'   => get_the_author_meta( 'display_name', $user->ID ),
				'excerpt' => get_the_author_meta( 'description', $user->ID ),
			];
		} elseif ( is_search() ) {
			// translators: placeholder is the search term.
			$title = sprintf( __( 'Search %s', 'simple-social-sharer' ), get_search_query() );

			$args = [
				'url'   => $this->current_url(),
				'title' => $title,
			];
		} else {
			$args = [
				'url' => $this->current_url(),
			];
		}

		if ( apply_filters( 'sss_apply_get_parameters', true ) ) {
			// phpcs:disable WordPress.Security.NonceVerification.NoNonceVerification
			$args['url'] = add_query_arg( rawurlencode_deep( $_GET ), $args['url'] );
			// phpcs:enable
		}

		return $args;
	}

	/**
	 * Get current URL without parameters.
	 *
	 * @return string Current URL without parameters.
	 */
	private function current_url() {
		global $wp;

		$current_url = trailingslashit( home_url( $wp->request ) );

		return $current_url;
	}

	/**
	 * Get the list of supported social networks.
	 *
	 * @return array List of supported social networks.
	 */
	private function social_networks() {
		return apply_filters(
			'sss_social_networks',
			[
				'facebook'   => 'SSS_Networks_Facebook',
				'twitter'    => 'SSS_Networks_Twitter',
				'googleplus' => 'SSS_Networks_GooglePlus',
				'linkedin'   => 'SSS_Networks_LinkedIn',
				'pinterest'  => 'SSS_Networks_Pinterest',
				'email'      => 'SSS_Networks_Email',
				'link'       => 'SSS_Networks_Link',
			]
		);
	}
}

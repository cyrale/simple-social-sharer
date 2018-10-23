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
	 * Twig loader.
	 *
	 * @var Twig_Loader_Filesystem
	 */
	protected $loader;

	/**
	 * Twig.
	 *
	 * @var Twig_Environment
	 */
	protected $twig;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param Simple_Social_Sharer $plugin Main plugin object.
	 *
	 * @throws Twig_Error_Loader Twig error.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		$this->loader = new Twig_Loader_Filesystem();

		$locations = apply_filters( 'simple_social_sharer_views_path', [ Simple_Social_Sharer::dir( 'views' ) ] );
		if ( is_array( $locations ) && ! empty( $locations ) ) {
			foreach ( $locations as $location ) {
				if ( ! is_string( $location ) ) {
					continue;
				}

				$this->loader->addPath( $location );
			}
		}

		$this->twig = new Twig_Environment( $this->loader, [ 'autoescape' => false ] );
		$this->twig->addExtension( new Twig_Extension_StringLoader() );
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  1.0.0
	 */
	public function hooks() {
		add_action( 'init', [ $this, 'shortcode' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_and_styles' ] );

		add_filter( 'timber_context', [ $this, 'add_to_context' ] );
	}

	/**
	 * Declare shortcode.
	 */
	public function shortcode() {
		add_shortcode( 'sharer', [ $this, 'display' ] );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts_and_styles() {
		if ( is_admin() ) {
			return;
		}

		wp_enqueue_script(
			'tooltipster',
			'https://cdn.jsdelivr.net/npm/tooltipster@4.2.6/dist/js/tooltipster.bundle.min.js',
			[ 'jquery' ],
			'4.2.6',
			true
		);

		wp_enqueue_script(
			'simple-social-sharer',
			Simple_Social_Sharer::url( 'dist/js/app.js' ),
			[ 'jquery', 'tooltipster' ],
			substr( sha1( filemtime( Simple_Social_Sharer::dir( 'dist/js/app.js' ) ) ), 0, 8 ),
			true
		);

		wp_enqueue_style(
			'tooltipster',
			'https://cdn.jsdelivr.net/npm/tooltipster@4.2.6/dist/css/tooltipster.bundle.min.css',
			[],
			'4.2.6'
		);

		wp_enqueue_style(
			'tooltipster-theme-light',
			'https://cdn.jsdelivr.net/npm/tooltipster@4.2.6/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css',
			[ 'tooltipster' ],
			'4.2.6'
		);

		wp_enqueue_style(
			'simple-social-sharer',
			Simple_Social_Sharer::url( 'dist/css/app.css' ),
			[ 'tooltipster' ],
			substr( sha1( filemtime( Simple_Social_Sharer::dir( 'dist/css/app.css' ) ) ), 0, 8 )
		);
	}

	/**
	 * Add sharer to the context of Timber.
	 *
	 * @param array $context Context.
	 *
	 * @return array New context with sharer inside.
	 *
	 * @throws Twig_Error_Loader Twig error.
	 * @throws Twig_Error_Runtime Twig error.
	 * @throws Twig_Error_Syntax Twig error.
	 */
	public function add_to_context( $context ) {
		if ( apply_filters( 'simple_social_sharer_add_to_context', true ) ) {
			$context['simple_social_sharer'] = [
				'links'  => $this->links(),
				'render' => $this->render(),
			];
		}

		return $context;
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

		$args = apply_filters( 'simple_social_sharer_links_args', $args, $post_id );

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
				'url'  => $network->share_url( $args ),
				'name' => $network->name,
				'slug' => $network->slug,
				'icon' => $network->icon,
			];
		}

		return apply_filters( 'simple_social_sharer_share_links', $links, $args );
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

		if ( apply_filters( 'simple_social_sharer_apply_get_parameters', true ) ) {
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
			'simple_social_sharer_social_networks',
			[
				'facebook'    => 'SSS_Networks_Facebook',
				'twitter'     => 'SSS_Networks_Twitter',
				'google-plus' => 'SSS_Networks_GooglePlus',
				'linkedin'    => 'SSS_Networks_LinkedIn',
				'pinterest'   => 'SSS_Networks_Pinterest',
				'email'       => 'SSS_Networks_Email',
				'link'        => 'SSS_Networks_Link',
			]
		);
	}

	/**
	 * Render the sharer.
	 *
	 * @param array $atts Attributes.
	 *
	 * @return string
	 *
	 * @throws Twig_Error_Loader Twig error.
	 * @throws Twig_Error_Runtime Twig error.
	 * @throws Twig_Error_Syntax Twig error.
	 */
	public function render( $atts = [] ) {
		$atts = shortcode_atts(
			[
				'post_id' => null,
			],
			$atts
		);

		$template = $this->twig->load( 'sharer.twig' );

		return $template->render(
			[
				'links'           => $this->links( $atts['post_id'] ),
				'tooltip_content' => __( 'Copied!', 'simple-social-sharer' ),
			]
		);
	}

	/**
	 * Display the rendered HTML.
	 *
	 * @param array $attr Attributes.
	 *
	 * @throws Twig_Error_Loader Twig error.
	 * @throws Twig_Error_Runtime Twig error.
	 * @throws Twig_Error_Syntax Twig error.
	 */
	public function display( $attr = [] ) {
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->render( $attr );
		// phpcs:enable
	}
}

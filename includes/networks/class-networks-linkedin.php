<?php
/**
 * Simple Social Sharer LinkedIn.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks LinkedIn.
 *
 * @since 1.0.0
 */
class SSS_Networks_LinkedIn extends SSS_Networks_Network {

	public function __construct() {
		$this->name = 'LinkedIn';
		$this->slug = 'linkedin';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://www.linkedin.com/shareArticle';
		$url = add_query_arg( rawurlencode_deep( [
			'mini'    => true,
			'url'     => $args['url'],
			'title'   => $args['title'],
			'summary' => $args['excerpt'],
		] ), $url );

		return $url;
	}
}

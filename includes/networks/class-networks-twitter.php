<?php
/**
 * Simple Social Sharer Twitter.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Twitter.
 *
 * @since 1.0.0
 */
class SSS_Networks_Twitter extends SSS_Networks_Network {

	public function __construct() {
		$this->name = 'Twitter';
		$this->slug = 'twitter';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://twitter.com/intent/tweet';
		$url = add_query_arg( [
			'text' => rawurlencode( $args['url'] ),
		], $url );

		return $url;
	}
}

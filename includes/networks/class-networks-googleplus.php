<?php
/**
 * Simple Social Sharer Google Plus.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Google Plus.
 *
 * @since 1.0.0
 */
class SSS_Networks_GooglePlus extends SSS_Networks_Network {

	public function __construct() {
		$this->name = 'Google+';
		$this->slug = 'googleplus';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://plus.google.com/share';
		$url = add_query_arg( [
			'url' => rawurlencode( $args['url'] ),
		], $url );

		return $url;
	}
}

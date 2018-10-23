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

	/**
	 * SSS_Networks_GooglePlus constructor.
	 */
	public function __construct() {
		$this->name = 'Google+';
		$this->slug = 'googleplus';
	}

	/**
	 * Get share URL for Google+.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://plus.google.com/share';
		$url = add_query_arg( rawurlencode_deep( [ 'url' => $args['url'] ] ), $url );

		return $url;
	}
}

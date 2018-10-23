<?php
/**
 * Simple Social Sharer Facebook.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Facebook.
 *
 * @since 1.0.0
 */
class SSS_Networks_Facebook extends SSS_Networks_Network {

	/**
	 * SSS_Networks_Facebook constructor.
	 */
	public function __construct() {
		$this->name = 'Facebook';
		$this->slug = 'facebook';
	}

	/**
	 * Get share URL for Facebook.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://www.facebook.com/sharer.php';
		$url = add_query_arg( rawurlencode_deep( [ 'u' => $args['url'] ] ), $url );

		return $url;
	}
}

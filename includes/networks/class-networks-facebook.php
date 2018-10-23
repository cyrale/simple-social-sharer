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

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M367.53 193.67v137.68H266.66V499.7h100.87V1000h207.21V499.72h139s13-80.73 19.34-169H575.52v-115.1c0-17.21 22.59-40.35 44.92-40.35h112.9V0h-153.5C362.41 0 367.53 168.51 367.53 193.67z"/></svg>';
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

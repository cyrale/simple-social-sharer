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
		$this->slug = 'google-plus';

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M875 437.5v-125h-62.5v125h-125V500h125v125H875V500h125v-62.5H875zM312.5 437.5v125h176.81c-25.81 72.75-95.31 125-176.81 125C209.12 687.5 125 603.38 125 500s84.12-187.5 187.5-187.5a184.72 184.72 0 0 1 121.44 45.25l82.12-94.25a309.69 309.69 0 0 0-203.56-76C140.19 187.5 0 327.69 0 500s140.19 312.5 312.5 312.5S625 672.31 625 500v-62.5z"/></svg>';
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

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

	/**
	 * SSS_Networks_Twitter constructor.
	 */
	public function __construct() {
		$this->name = 'Twitter';
		$this->slug = 'twitter';

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M1000 190a409.76 409.76 0 0 1-117.79 32.31 206 206 0 0 0 90.17-113.42A413.49 413.49 0 0 1 842 158.66a204.56 204.56 0 0 0-149.72-64.8c-113.3 0-205.15 91.85-205.15 205.08a205.79 205.79 0 0 0 5.31 46.75C322 337.12 170.84 255.45 69.67 131.35a205.39 205.39 0 0 0 63.49 273.82 205.12 205.12 0 0 1-92.92-25.74V382c0 99.36 70.74 182.28 164.53 201.15a207.9 207.9 0 0 1-54.05 7.19 196.9 196.9 0 0 1-38.62-3.82C138.22 668.06 214 727.36 303.69 729a411.55 411.55 0 0 1-254.76 87.66A436.5 436.5 0 0 1 0 813.85a579.89 579.89 0 0 0 314.44 92.29c377.37 0 583.64-312.56 583.64-583.64l-.68-26.5A409.69 409.69 0 0 0 1000 190z"/></svg>';
	}

	/**
	 * Get share URL for Twitter.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://twitter.com/intent/tweet';
		$url = add_query_arg( rawurlencode_deep( [ 'text' => $args['url'] ] ), $url );

		return $url;
	}
}

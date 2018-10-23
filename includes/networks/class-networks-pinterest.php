<?php
/**
 * Simple Social Sharer Pinterest.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Pinterest.
 *
 * @since 1.0.0
 */
class SSS_Networks_Pinterest extends SSS_Networks_Network {

	/**
	 * SSS_Networks_Pinterest constructor.
	 */
	public function __construct() {
		$this->name = 'Pinterest';
		$this->slug = 'pinterest';
	}

	/**
	 * Get share URL for Pinterest.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://pinterest.com/pin/create/button/';
		$url = add_query_arg(
			rawurlencode_deep(
				[
					'url'         => $args['url'],
					'media'       => $args['thumbnail'],
					'description' => $args['title'],
				]
			),
			$url
		);

		return $url;
	}
}

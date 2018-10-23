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

	public function __construct() {
		$this->name = 'Pinterest';
		$this->slug = 'pinterest';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://pinterest.com/pin/create/button/';
		$url = add_query_arg( rawurlencode_deep( [
			'url'         => $args['url'],
			'media'       => $args['thumbnail'],
			'description' => $args['title'],
		] ), $url );

		return $url;
	}
}

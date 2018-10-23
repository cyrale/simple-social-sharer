<?php
/**
 * Simple Social Sharer Link.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Link.
 *
 * @since 1.0.0
 */
class SSS_Networks_Link extends SSS_Networks_Network {

	public function __construct() {
		$this->name = 'Link';
		$this->slug = 'link';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		return $args['url'];
	}
}

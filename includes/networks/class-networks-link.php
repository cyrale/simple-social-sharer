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

	/**
	 * SSS_Networks_Link constructor.
	 */
	public function __construct() {
		$this->name = 'Link';
		$this->slug = 'link';
	}

	/**
	 * Get a simple link to copy to clipboard.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		return $args['url'];
	}
}

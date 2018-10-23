<?php
/**
 * Simple Social Sharer Email.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks Email.
 *
 * @since 1.0.0
 */
class SSS_Networks_Email extends SSS_Networks_Network {

	/**
	 * SSS_Networks_Email constructor.
	 */
	public function __construct() {
		$this->name = 'Email';
		$this->slug = 'mail';
	}

	/**
	 * Get share URL for emails.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		return 'mailto:?Body=' . rawurlencode( $args['url'] );
	}
}

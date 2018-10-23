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

	public function __construct() {
		$this->name = 'Email';
		$this->slug = 'mail';
	}

	public function get_share_url( $args ) {
		$args = $this->parse_args( $args );

		return 'mailto:?Body=' . rawurlencode( $args['url'] );
	}
}

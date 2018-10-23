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
		$this->slug = 'email';

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M79.08 191.35l360.2 285.32c16.33 12.92 38.84 18.66 60.7 17.59 21.83 1.07 44.34-4.63 60.67-17.59l360.2-285.32c28.86-22.72 22.32-41.35-14.29-41.35H93.48c-36.65 0-43.19 18.63-14.4 41.35z"/><path d="M946.87 266.63L553.25 565.48c-14.71 11-34 16.44-53.2 16.19-19.24.25-38.51-5.17-53.23-16.19L53.13 266.63C23.91 244.48 0 256.36 0 293v490.34A66.87 66.87 0 0 0 66.66 850h866.68a66.87 66.87 0 0 0 66.66-66.66V293c0-36.64-23.91-48.52-53.13-26.37z"/></svg>';
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

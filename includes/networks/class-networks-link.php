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
		$this->name = __( 'Copy link', 'simple-social-sharer' );
		$this->slug = 'link';

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M122.87 962.15a129.21 129.21 0 0 0 182.73 0l224.93-225a129.32 129.32 0 0 0 0-182.7l-8.79-8.79 24-24 8.82 8.81a129.2 129.2 0 0 0 182.68 0l225-225c50.37-50.36 50.37-132.33 0-182.67l-85-85.07a129.2 129.2 0 0 0-182.72 0l-225 225c-50.34 50.37-50.34 132.33 0 182.69l8.78 8.78-23.95 23.95-8.78-8.78a129.21 129.21 0 0 0-182.72 0l-225 225c-50.35 50.38-50.35 132.34 0 182.68zm414-631.87l225-225a33.79 33.79 0 0 1 47.79 0l85 85.06a33.83 33.83 0 0 1 0 47.75l-225 224.94c-12.77 12.77-35 12.75-47.74 0l-8.8-8.8 66.72-66.73-67.46-67.47-66.72 66.74-8.8-8.78a33.85 33.85 0 0 1 .03-47.71zM105.31 761.86l225-224.93a33.76 33.76 0 0 1 47.73 0l8.78 8.78-43.5 43.49 67.47 67.45 43.49-43.49 8.8 8.79a33.81 33.81 0 0 1 0 47.76l-224.94 225c-12.74 12.74-35 12.76-47.75 0l-85.05-85.08a33.79 33.79 0 0 1-.03-47.77z"/></svg>';
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

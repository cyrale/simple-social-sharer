<?php
/**
 * Simple Social Sharer Network.
 *
 * @since   1.0.0
 * @package Simple_Social_Sharer
 */

/**
 * Simple Social Sharer Networks.
 *
 * @since 1.0.0
 */
abstract class SSS_Networks_Network {

	/**
	 * The name of the social network.
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * The slug of the social network.
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * Magic getter for our object.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $field Field to get.
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'name':
			case 'slug':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}

	/**
	 * Parse args to get default values.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return array Arguments parsed.
	 */
	protected function parse_args( $args ) {
		$defaults = [
			'url'       => '',
			'title'     => '',
			'excerpt'   => '',
			'thumbnail' => '',
		];

		return wp_parse_args( $args, $defaults );
	}

	/**
	 * Get share URL for a network.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	abstract public function share_url( $args );
}

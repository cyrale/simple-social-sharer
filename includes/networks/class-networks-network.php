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

	protected $name;
	protected $slug;

	abstract public function get_share_url( $args );

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

	protected function parse_args( $args ) {
		$defaults = [
			'url'       => '',
			'title'     => '',
			'excerpt'   => '',
			'thumbnail' => '',
		];

		return wp_parse_args( $args, $defaults );
	}
}

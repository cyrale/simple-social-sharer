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

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M791.05 102.47C722.22 36.39 627 0 522.82 0c-159.07 0-256.91 65.21-311 119.9C145.22 187.31 107 276.82 107 365.47c0 111.32 46.58 196.76 124.55 228.53a41.12 41.12 0 0 0 15.66 3.23c16.45 0 29.49-10.77 34-28 2.63-9.91 8.73-34.34 11.38-45 5.68-20.95 1.09-31-11.28-45.61-22.56-26.68-33.06-58.24-33.06-99.3 0-122 90.83-251.61 259.16-251.61C641 127.74 724 203.65 724 325.85 724 403 707.34 474.38 677.17 527c-20.97 36.48-57.83 80-114.43 80-24.47 0-46.45-10-60.32-27.58-13.11-16.57-17.43-38-12.16-60.28 6-25.2 14.07-51.49 21.93-76.9 14.33-46.4 27.88-90.24 27.88-125.24 0-59.83-36.78-100-91.52-100-69.55 0-124.06 70.64-124.06 160.84 0 44.23 11.76 77.32 17.08 90-8.77 37.13-60.85 257.87-70.73 299.5-5.71 24.3-40.12 216.22 16.84 231.52 64 17.2 121.19-169.72 127-190.84C419.41 790.86 435.92 725.9 446 686c30.89 29.75 80.63 49.87 129 49.87 91.24 0 173.29-41.06 231-115.61 56-72.3 86.86-173.08 86.86-283.75.14-86.51-37.03-171.84-101.81-234.04z"/></svg>';
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

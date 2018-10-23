<?php
/**
 * Simple Social Sharer LinkedIn.
 *
 * @since   1.0.0
 * @package Simpe_Social_Sharer
 */

/**
 * Simple Social Sharer Networks LinkedIn.
 *
 * @since 1.0.0
 */
class SSS_Networks_LinkedIn extends SSS_Networks_Network {

	/**
	 * SSS_Networks_LinkedIn constructor.
	 */
	public function __construct() {
		$this->name = 'LinkedIn';
		$this->slug = 'linkedin';

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M1000 608.07v369.71H785.67V632.83c0-86.65-31-145.79-108.58-145.79-59.23 0-94.47 39.86-110 78.41-5.65 13.78-7.11 33-7.11 52.26v360.07H345.6s2.89-584.22 0-644.76H560v91.4c-.43.68-1 1.42-1.41 2.08H560v-2.08c28.49-43.87 79.35-106.54 193.21-106.54C894.25 317.88 1000 410 1000 608.07zM121.32 22.22C48 22.22 0 70.33 0 133.6c0 61.89 46.59 111.46 118.48 111.46h1.43c74.77 0 121.27-49.57 121.27-111.46-1.41-63.27-46.5-111.38-119.86-111.38zM12.73 977.78h214.33V333H12.73z"/></svg>';
	}

	/**
	 * Get share URL for LinkedIn.
	 *
	 * @param array $args Arguments (url, title, excerpt and thumbnail).
	 *
	 * @return string Share url.
	 */
	public function share_url( $args ) {
		$args = $this->parse_args( $args );

		$url = 'https://www.linkedin.com/shareArticle';
		$url = add_query_arg(
			rawurlencode_deep(
				[
					'mini'    => 'true',
					'url'     => $args['url'],
					'title'   => $args['title'],
					'summary' => $args['excerpt'],
				]
			),
			$url
		);

		return $url;
	}
}

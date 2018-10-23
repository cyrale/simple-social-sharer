/**
 * Internal dependencies
 */
import './sass/app.scss';

/**
 * External dependencies
 */
import ClipboardJS from 'clipboard';

const $ = window.jQuery;

$( () => {
	const $links = $( '.simple-social-sharer__link.link' );

	$links.each( ( index, item ) => {
		const $item = $( item );

		$item.tooltipster( {
			theme: 'tooltipster-light',
			trigger: 'custom',
			content: $item.data( 'tooltip-content' ),
		} );
	} );

	$links.on( 'click', ( e ) => {
		e.preventDefault();
	} );

	const clipboard = new ClipboardJS( '.simple-social-sharer__link.link' );

	clipboard.on( 'success', ( e ) => {
		$( e.trigger ).tooltipster( 'open' );

		setTimeout( () => {
			$( e.trigger ).tooltipster( 'close' );
		}, 800 );
	} );
} );


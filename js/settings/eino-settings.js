( function( $ ) {
	
	/* FitVids. */
	$('#container').fitVids();
	
	/* Enables menu toggle for small screens. */
	( function() {
		var nav = $( '#menu-primary' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		menu   = nav.find( '.menu-items' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

} )( jQuery );
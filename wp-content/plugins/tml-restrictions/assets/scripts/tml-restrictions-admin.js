( function( $ ) {

	$( initCheckbox );

	function initCheckbox() {
		$( '#require_login' ).on( 'click', function() {
			if ( $( this ).is( ':checked' ) ) {
				$( '#tml-restrictions-required-roles' ).show();
			} else {
				$( '#tml-restrictions-required-roles' ).hide();
			}
		} );
	}
} )( jQuery );

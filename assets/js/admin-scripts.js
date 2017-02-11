jQuery( document ).ready( function( $ ) {

	// Display the media upload screen on click.
	$( '.dorzki_image_upload' ).on( 'click', function() {

		tb_show( 'Upload a logo', 'media-upload.php?referer=custom_branding&type=image&TB_iframe=true&post_id=0', false );

		return false;

	} );

	// Assign the uploaded file url to the input.
	window.send_to_editor = function( html ) {

		var botImage = $( 'img', html );

		$( '.dorzki_image_src' ).val( botImage.attr( 'src' ) );
		$( '.dorzki_image_preview' ).html( botImage );

		tb_remove();

	};

	// Dismiss the admin notices.
	$( document ).on( 'click', '.dorzki-slack-notice .notice-dismiss', function() {

		$.ajax( {
			url: ajaxurl,
			data: {
				action: 'dorzki-slack-dismiss-notice'
			}
		} );

	} );

	// Test notification.
	$( '#dorzki-test-integration' ).on( 'click', function() {

		$( this ).prop( 'disabled', true );
		$( '#test-spinner' ).show();

		$.ajax( {
			url: ajaxurl,
			dataType: 'json',
			data: {
				action: 'dorzki-slack-test-integration'
			},
			success: function( data ) {

				$( '#test-spinner' ).hide();

				if( data.success ) {
					$( '#dorzki-test-integration' ).after( '<span class="dashicons dashicons-yes test-success"></span>' );
				} else {
					$( '#dorzki-test-integration' ).after( '<span class="dashicons dashicons-no-alt test-fail"></span>' );
				}

			}
		} )

	} );

	// Tabs logic
	$( '.dorzki-tabs-nav a.nav-tab' ).on( 'click', function( e ) {
		e.preventDefault();

		$( this ).addClass( 'nav-tab-active' ).siblings().removeClass( 'nav-tab-active' );
		$( '.dorzki-tabs-wrapper .dorzki-tab' + $( this ).attr( 'href' ) ).addClass( 'active' ).siblings().removeClass( 'active' );

	} );

	// Accordion logic
	$( '.dorzki-collapse-header' ).on( 'click', function() {

		$( this ).parents( '.dorzki-collapse' ).toggleClass( 'open' );
		$( this ).next().slideToggle();

	} );

	// Populate select with dynamic options.
	function populateOptions( _select, _data ) {

		_select.find( 'option' ).remove();

		for( var key in _data ) {

			var val = ( typeof _data[ key ] === 'object' ) ? _data[ key ].name : _data[ key ];

			$( '<option>' ).val( key ).text( val ).appendTo( _select );
		}

		_select.trigger( 'change' );

	}

	// Notification category change
	$( '.notification-cat' ).on( 'change', function() {

		var _select = $( this ).parents( '.dorzki-collapse' ).find( '.notification-type' );
		var _cat = $( this ).val().trim();


		if( _cat.length > 0 ) {

			data = dorzki_slack_notif_types[ _cat ].types;

			if( Object.keys( data ).length > 0 ) {

				_select.show();
				populateOptions( _select, data );

			} else {
				_select.hide();
			}

		}

	} );

	// Notification type change
	$( '.notification-type' ).on( 'change', function() {

		var _select = $( this ).parents( '.dorzki-collapse' ).find( '.notification-status' );
		var _cat = $( this ).parents( '.dorzki-collapse' ).find( '.notification-cat' ).val().trim();
		var _type = $( this ).val().trim();

		if( _type.length > 0 ) {

			data = dorzki_slack_notif_types[ _cat ].types[ _type ].statuses;

			if( typeof data === 'object' && Object.keys( data ).length > 0 ) {

				_select.show();
				populateOptions( _select, data );

			} else {
				_select.hide();
			}

		}

	} );

} );
var idle_interval;
var mouse_idle_time = 0;
var fullscrenn_hidden_elements = false;

jQuery( document ).ready( function(){
	jQuery( this ).mousemove( function( event ){
		mouse_idle_time = 0;
		show_fullscreen_elements();
	});
	
	jQuery( this ).on( 'fullscreenchange', HS_as_after_fullscreenchange );
	jQuery( this ).on( 'mozfullscreenchange', HS_as_after_fullscreenchange );
	jQuery( this ).on( 'webkitfullscreenchange', HS_as_after_fullscreenchange );
});

function HS_as_strech_imgs(){
	jQuery( '#activity_slider .HS_as_fullscreen_img' ).each( function(){
		if( ( jQuery( '#activity_slider' ).height() - jQuery( this ).height() ) < ( jQuery( '#activity_slider' ).width() - jQuery( this ).width() ) ){
			jQuery( this ).removeClass( 'fillwidth' ).addClass( 'fillheight' );
		}
		else{
			jQuery( this ).removeClass( 'fillheight' ).addClass( 'fillwidth' );
		}
	});
}

jQuery( window ).resize( function(){ HS_as_strech_imgs(); } );

function HS_as_after_fullscreenchange(){
	var fullscreenEnabled = document.mozFullScreen || document.webkitIsFullScreen || false;
	
	if( fullscreenEnabled ){
		idle_interval = setInterval( check_mouse_idle, 500 );
		jQuery( '#activity_slider' ).addClass( 'HS_as_fullscreen' );
	}
	else{
		clearInterval( idle_interval );
		jQuery( '#activity_slider' ).removeClass( 'HS_as_fullscreen' );
	}
}

function HS_as_fullscreen( e ){
	var jQuery_elem = jQuery( e.target ).parent();
	var elem = jQuery_elem[0];
	var fullscreenEnabled = document.mozFullScreen || document.webkitIsFullScreen || false;
	
	if( !fullscreenEnabled ){
		if ( elem.requestFullscreen ) {
			elem.requestFullscreen();
		}
		else if ( elem.msRequestFullscreen ) {
			elem.msRequestFullscreen();
		}
		else if ( elem.mozRequestFullScreen ) {
			elem.mozRequestFullScreen();
		}
		else if ( elem.webkitRequestFullscreen ) {
			elem.webkitRequestFullscreen();
		}
	}
	else{
		if ( document.exitFullscreen ) {
			document.exitFullscreen();
		} else if ( document.msExitFullscreen ) {
			document.msExitFullscreen();
		} else if ( document.mozCancelFullScreen ) {
			document.mozCancelFullScreen();
		} else if ( document.webkitExitFullscreen ) {
			document.webkitExitFullscreen();
		}
	}
}

function check_mouse_idle(){
	var fullscreenEnabled = document.mozFullScreen || document.webkitIsFullScreen || false;
	
	if( fullscreenEnabled ){
		if( mouse_idle_time >= 1000 ){
			jQuery( '#activity_slider .carousel-indicators' ).hide( 500 );
			jQuery( '#activity_slider .carousel-control' ).hide( 500 );
			jQuery( '#activity_slider .HS_FullScreen_button' ).hide( 500 );
			jQuery( '#activity_slider' ).addClass( 'hide-courser' );
			fullscrenn_hidden_elements = true;
		}
		else{
			mouse_idle_time = mouse_idle_time + 500;
		}
	}
}

function show_fullscreen_elements(){
	if( fullscrenn_hidden_elements ){
		jQuery( '#activity_slider .carousel-indicators' ).show( 500 );
		jQuery( '#activity_slider .carousel-control' ).show( 500 );
		jQuery( '#activity_slider .HS_FullScreen_button' ).show( 500 );
		window.setTimeout( jQuery( '#activity_slider' ).removeClass( 'hide-courser' ), 500 );
		fullscrenn_hidden_elements = false;
	}
}
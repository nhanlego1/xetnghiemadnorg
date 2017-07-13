/**
 * Handles toggling the navigation menu for small screens and
 * accessibility for submenu items.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), button, menu;
	if ( ! nav ) {
		return;
	}

	button = nav.getElementsByTagName( 'h3' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	if ( ! button ) {
		return;
	}

	// Hide button if menu is missing or empty.
	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function() {
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className = 'nav-menu';
		}

		if ( -1 !== button.className.indexOf( 'toggled-on' ) ) {
			button.className = button.className.replace( ' toggled-on', '' );
			menu.className = menu.className.replace( ' toggled-on', '' );
		} else {
			button.className += ' toggled-on';
			menu.className += ' toggled-on';
		}
	};
} )();

// Better focus for hidden submenu items for accessibility.
( function( $ ) {
	$( '.main-navigation' ).find( 'a' ).on( 'focus.twentytwelve blur.twentytwelve', function() {
		$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
	} );
} )( jQuery );

function clock() {
    var currentTime = new Date();
    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
    currentHours = (currentHours < 10 ? "0" : "") + currentHours;
    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
    jQuery('#hours').text(currentHours);
    jQuery('#min').text(currentMinutes);
    jQuery('#sec').text(currentSeconds);
}

var days = ['Sunday - ', 'Monday - ', 'Tuesday - ', 'Wednesday - ', 'Thursday - ', 'Friday - ', 'Saturday - '];
var months = ['January, ', 'February, ', 'March, ', 'April, ', 'May, ', 'June, ', 'July, ', 'August, ', 'September, ', 'October, ', 'November, ', 'December, '];

jQuery(document).ready(function() {
    var currentTime = new Date();
    var currentDay = days[currentTime.getDay()];
    var currentDate = currentTime.getDate();
    var currentMonth = months[currentTime.getMonth()];
    var currentYear = currentTime.getFullYear();
    jQuery('#Date').text(currentDay + ' ' + currentDate + ' ' + currentMonth + ' ' + currentYear);
    clock();
    window.setInterval(clock, 1000);
});
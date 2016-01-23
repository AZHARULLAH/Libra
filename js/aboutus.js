$(document).ready(function(){

	function sticky_relocate() {
	    var window_top = $(window).scrollTop();
	    var div_top = $('#sticky-anchor').offset().top - 50;
	    if (window_top > div_top) {
	        $('#sticky').addClass('stick');
	        $('#header_top').addClass('background');
	    } else {
	        $('#sticky').removeClass('stick');
	        $('#header_top').removeClass('background');
	    }
	}

	$(function () {
	    $(window).scroll(sticky_relocate);
	    sticky_relocate();
	});

	// ===== Scroll to Top ==== 
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	        $('#return-to-top').fadeIn(200);    // Fade in the arrow
	    } else {
	        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
	    }
	});
	$('#return-to-top').click(function() {      // When arrow is clicked
	    $('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});
	
})
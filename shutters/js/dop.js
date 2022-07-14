jQuery(document).ready(function($) { 
	$('.nav-links a.next').append('<i class="fas fa-forward"></i>');
	$('.nav-links a.prev').prepend('<i class="fas fa-backward"></i>');
	$('.nav-links a, .nav-links span').wrap('<li></li>');

	$('#popup-quote .step-1').before('<h6>' + $('.content h1').text() + '</h6>');

	$('li.fancybox-li a').addClass('fancybox');
});
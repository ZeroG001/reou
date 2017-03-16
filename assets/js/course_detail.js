( function($) {

	$('.course_schedule--show-calendar').click(function() {
		$('.course_schedule--calendar').hide();
		$(this).parent().parent().next('.course_schedule--calendar').slideToggle();
	});

}) ( jQuery );

( function($) {

	$('.course_schedule--show-calendar').click(function() {

// --------------- Animation for schedulede details button --------------- //

	if ( $(this).hasClass('show-calendar_selected') ) {
		$(this).removeClass('show-calendar_selected');
		$('.course_schedule--show-calendar').removeClass('show-calendar_selected');

	} 
	else {
		$('.course_schedule--show-calendar').removeClass('show-calendar_selected');
		$(this).toggleClass('show-calendar_selected');
	}
	

	

// --------------- Animation for schedulede details button --------------- //

		$schedule_calendar = $(this).parent().parent().next('.course_schedule--calendar');
	
		// If the calendar is showing
		if ( $schedule_calendar.css('display') == "block" ) {

			// Hide the calendar
			$('.course_schedule--calendar').slideUp(200);
			$schedule_calendar.slideUp(200);

		} 
		else {
			// Show the calendar
			$('.course_schedule--calendar').slideUp(200);
			$schedule_calendar.slideDown(200);
		}
		// $schedule_calendar.slideToggle();
		
	});

}) ( jQuery );

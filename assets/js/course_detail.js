( function($) {

	$('.course_schedule--show-calendar').click(function() {
		$schedule_calendar = $(this).parent().parent().next('.course_schedule--calendar');
		
		// $schedule_calendar.toggle();
		// If the calendar is showing
		if($schedule_calendar.css('display') == "table-row") {

			// Hide the calendar
			$('.course_schedule--calendar').hide();
			$schedule_calendar.css('display', 'none');

		} else {

			// Show the calendar
			$('.course_schedule--calendar').hide();
			$schedule_calendar.css('display', 'table-row');
			setTimeout(function(){
				alert('this is a test');
			}, 1000);
		}
		
	});

}) ( jQuery );

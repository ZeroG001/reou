$('#search_courses_form').submit(function(e) {

	e.preventDefault();


	keyword = $('#course_search_input').val();

	$.ajax({

		type : "POST",
		url : "/reou/helpers/ajax_actions/getCourses.php",
		data : { "keyword" : keyword },
		success: function(response) {

			console.log(response);

			json_response = JSON.parse(response);
			console.log(json_response[0]);


			tableHtml = "";
			tableHtml += '<tr>';
			tableHtml += '<th>Course Name</th>';
			tableHtml += '<th></th>';
			tableHtml += '</tr>';


			for (var i = json_response.length - 1; i >= 0; i--) {

				tableHtml += '<tr class="user_table--row">';	
				tableHtml += '<td class="user_table--cell">' + json_response[i].course_name  + '</td>';
				tableHtml += '<td class="user_table--cell"> <a href="/reou/admin/edit-course/' + json_response[i].course_id + '"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
			 	tableHtml += '</tr>'
			 	 ;

			};


			$('.show_user_table').html(tableHtml);


		},
		error: function(){
			alert("it didn't work");
		}
	})


})







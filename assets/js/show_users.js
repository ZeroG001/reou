
$('#search_users_form').submit(function(e){
	e.preventDefault();


	keyword = $('#users_search_input').val();

	$.ajax({
		type : "POST",
		url : "/reou/helpers/ajax_actions/getUsers.php",
		data : {"keyword" : keyword},
		success: function(response) {

			console.log(response);

			json_response = JSON.parse(response);
			console.log(json_response[0]);

			tableHtml = "";
			tableHtml += '<tr>';
			tableHtml += '<th>Email/Username</th>';
			tableHtml += '<th> Full Name </th>';
			tableHtml += '<th> Type </th>';
			tableHtml += '<th> Active </th>';
			tableHtml += '<th></th>';
			tableHtml += '</tr>';


			for (var i = json_response.length - 1; i >= 0; i--) {

				tableHtml += '<tr class="user_table--row">';	
				tableHtml += '<td class="user_table--cell">' + json_response[i].email  + '</td>';
				tableHtml += '<td class="user_table--cell">' + json_response[i].first_name + ' ' + json_response[i].last_name + '</td>';
			 	tableHtml += '<td class="user_table--cell">' + json_response[i].role + '</td>';
			 	tableHtml += '<td class="user_table--cell">';
			 	tableHtml += json_response[i].active == 1 ? "Yes" : "No";
			 	tableHtml += '<td class="user_table--cell"> <a href="/reou/edit-profile?userId=' + json_response[i].id + '"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
			 	tableHtml += '</tr>';

			};


			$('.show_user_table').html(tableHtml);



		},
		error: function(){
			alert("it didn't work");
		}
	})


})


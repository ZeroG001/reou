$.ajax({
	type : "GET",
	url : "/reou/helpers/ajax_actions/getUsers.php",
	success: function(response){
		console.log(response.toString());

		json_response = JSON.parse(response);

		for(i in json_response) {
			console.log(i);
		}

	},
	error: function(){
		alert("it didn't work");
	}
})
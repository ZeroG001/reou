$.ajax({
	type : "GET",
	url : "/reou/helpers/ajax_actions/getUsers.php",
	success: function(response){
		alert("it worked");
		alert(response);
	},
	error: function(){
		alert("it didn't work");
	}
})
(function($){

	alert("hello world");

	// Remember that ajax calls from the current page so you may have to use php to fill in the location of the ajax call.
	$.ajax({
		method : "POST",
		url : "",
		data : {userId : "guy", profilePicture : "title"},
		success : function(response) {
			alert("the response was" + response);
		}
	})

})(jQuery); 
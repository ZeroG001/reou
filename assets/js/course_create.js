(function() {

	// =====================================
	//			  	Variables
	// =====================================

	function serialToObj( formInputs ) {

		console.log(formInputs);

		obj = {};

		for ( i = 0; i < formInputs.length; i++ ) {

			console.log(formInputs[i]); // Log the inputs submittd for debugging
			obj[formInputs[i].name] = formInputs[i].value; // Convert searlized items to jobject

		}

		console.log("Results from serialToObj()")
		console.log(obj);

		return obj;
	}

	// =====================================
	//			  	Functions
	// =====================================



	// =====================================
	//			  	Ajax Action
	// =====================================


	var opt = {
		"url" : "www.test.com",
		"data" : {"name" : "serialized data "}
	}

	$.ajax({ 

		Data: {}, 
		Method : "POST", 
		Url: "jaxme.html", 
		Success : function(reponse) {
			alert("hellow");
		} 

	});


})()
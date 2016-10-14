( function($) {


	// Take All Elements Passed in and serialize the values
	function serialToObj( formInputs ) {

		console.log(formInputs);

		obj = {};

		for ( i = 0; i < formInputs.length; i++ ) {

			console.log(formInputs[i]);
			obj[formInputs[i].name] = formInputs[i].value;

		}

		console.log("Results from serialToObj()");
		console.log(obj);

		return obj;
	}


	$(".profile__password-reset").click(function() {

		// Open The Password Reset Modal
		console.log("opening password reset modal");
		$(".profile__password-reset-modal").css("display", "inline");


		//Ensure that the new password matches the confirm password



		// When the user clicks the submit button check to seee if the passwords match
		$('.profile__submit-button').click(function() {

			// Check to make sure the new passowrd and confirm password are the same
			//Send Ajax request to helpers/ajax_actions/updatePassword.php	
		});



		// Close the modal window
		$('.profile__modal-close').click( function() {

			console.log("closing the modal");
			$(".profile__password-reset-modal").css("display", "none");

		});



		// on form submit. show the serialized data
		$(".profile__password-form").submit( function(event) {

			// Check to make sure the passwords match

			event.preventDefault();

			$formItems = $( this ).serializeArray();
			$data = serialToObj($formItems);
			console.log("this is the result");
			console.log($data);
			
		});


	});




	$.ajax({

		data: {},
		type : "post",
		url: "helpers/ajax_actions/updatePassword.php",
		success : function(response) {
			console.log("we've got a response" + response);
		},
		error: function(response, error){}

	});


	// When you click the modal close button then close the modal window.
	// Whats the harm, there is only one
	//


})(jQuery)
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

			// Check to make sure the passwords match

			event.preventDefault();

			$formItems = $('.profile__password-form').serializeArray();
			$data = serialToObj($formItems);
			console.log("this is the result");
			console.log($data);

			// Submit the from if the passwords If the passwords eneterd do not mactch then show an alert
			if( $data['new-password'] != $data['confirm-password'] ) {
				$('.profile__modal-alert').css('display', 'inline');
				// Hopefully this stop the ajax from running
				return false;
			} else {
				check_credentials();
				console.log("The passwords match. Closing the modal and continueing.");
				$(".profile__password-reset-modal").css("display", "none");
				$('.profile__modal-alert').css('display', 'none');
			}


			// If unable to verify the passworr


			function update_password() {

				// What we need to do now is serialize the array into something I can use.

				// $.ajax({
				// 	data: {"email": "ZeroG001@hotmail.com", "password" : "sonic001", "new_password" : "sonic002"},
				// 	type: "POST",
				// 	// url: "helpers/ajax_actions/updatePassword.php",
				// 	url: "",
				// 	success: function(response) {
				// 		alert(response);
				// 	}
				// })				
			}


			function check_credentials() {
				$.ajax({
					data: {"email": "ZeroG001@hotmail.com", "password" : "sonic001", "new_password" : "sonic001"},
					type: "POST",
					url: "helpers/ajax_actions/checkCredentials.php",
					success: function(response) {
						alert(response);
					}
				})
			}


			// What we need to do now is serialize the array into something I can use.

			// Check to make sure the new passowrd and confirm password are the same
			//Send Ajax request to helpers/ajax_actions/updatePassword.php	
		});



		// Close the modal window
		$('.profile__modal-close').click( function() {

			console.log("closing the modal");
			$(".profile__password-reset-modal").css("display", "none");

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
( function($) {


				// If unable to verify the password

	function password_reset_fields_valid() {

		console.log("running the password_reset_fields_valid_function");

		fields_valid_result = true;

		$password_reset_fields = {
			"current_password" : $('#modal-password'),
			"new_password" : $('#modal-new-password'),
			"confirm_password" : $('#modal-confirm-password')
		}

		for(i in $password_reset_fields) {

			if($password_reset_fields[i].val() == "") {
				$password_reset_fields[i].css('border', '1px solid red');
				fields_valid_result = false;
			} else {
				$password_reset_fields[i].css('border', '1px solid #dfdfdf');
			}

		}

		if( $password_reset_fields.new_password.val() != $password_reset_fields.confirm_password.val() ) {

			console.log("New and confirm passwords do not match");

			$('.profile__modal-alert').css("display", "inline");
			$('#modal-alert-message').text("Passwords do not match");
			fields_valid_result = false;
		} 
		else {
			$('.profile__modal-alert').css("display", "none");
			$('#modal-alert-message').text("");
		}

		return fields_valid_result;

	}

	function close_modal() {

		$(".profile__password-reset-modal").css("display", "none");
		$('.profile__modal-alert').css('display', 'none');
		
	}



	function update_password() {


		$.ajax({
			data: {"email": "ZeroG001@hotmail.com", "password" : "sonic002", "newPassword" : "sonic002"},
			type: "POST",
			url: "helpers/ajax_actions/updatePassword.php",
			url: "",
			success: function(response) {
				close_modal();
				alert(response);


			}
		})				
	}

	// Checks to see if the username/, I feel like update password should do everything.
	// It should check to make sure that you're updating the right user, if it fails then return a message.
	// If you're updating the right user then return a message that says the user was updateed.

	function check_credentials() {
		$.ajax({
			data: {"email": "ZeroG001@hotmail.com", "password" : "sonic002", "new_password" : "sonic002"},
			type: "POST",
			url: "helpers/ajax_actions/updatePassword.php",
			success: function(response) {

				alert(response);

				if(response == "true") {
					alert("the login was successful");
				} else {
					alert("the login was not successufl");
				}
			}
		})
	}


			// What we need to do now is serialize the array into something I can use.

			// Check to make sure the new passowrd and confirm password are the same
			//Send Ajax request to helpers/ajax_actions/updatePassword.php	


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


		// Close the modal window
		$('.profile__modal-close').click( function() {

			console.log("closing the modal");
			$(".profile__password-reset-modal").css("display", "none");

		});

	});


	// When the user clicks the submit button check to seee if the passwords match
	$('#profile__submit-button-modal').click(function(event) {

		// Check to make sure the passwords match

		event.preventDefault();

		$formItems = $('.profile__password-form').serializeArray();
		$data = serialToObj($formItems);

		// remove this when finished
		console.log("this is the result");
		console.log($data);



		// if(password_reset_fields()) {
		// 	update_password();
		// }

		// Submit the from if the passwords If the passwords entered do not match then show an alert
		if( password_reset_fields_valid() ) {

			console.log("first phase field validation passed");
			update_password();
		}

	});



})(jQuery)
( function($) {


	// Functions //
	// -------------------------------------- //

	function password_reset_fields_valid() {

		console.log("running the password_reset_fields_valid_function");

		fields_valid_result = true;

		$password_reset_fields = {
			// "current_password" : $('#form-password')
			"new_password" : $('#form-new-password'),
			"confirm_password" : $('#form-confirm-password')
		}

		for(i in $password_reset_fields) {

			if($password_reset_fields[i].val() == "" || $password_reset_fields[i].val().length < 8) {
				$password_reset_fields[i].addClass('field-invalid');
				fields_valid_result = false;
			} else {
				$password_reset_fields[i].removeClass('field-invalid');
			}

		}


		// Mark fields if they are incorrect
		if( $password_reset_fields.new_password.val() != $password_reset_fields.confirm_password.val() ) {

			console.log("New and confirm passwords do not match");

			$('.profile__modal-alert').css("display", "inline");
			$('#modal-alert-message').text("Passwords do not match");
			$password_reset_fields.new_password.addClass('field-invalid');
			$password_reset_fields.confirm_password.addClass('field-invalid');
			fields_valid_result = false;

		}
		else if ($password_reset_fields["new_password"].val().length < 8 || $password_reset_fields["confirm_password"].val().length < 8 ) {

			$('.profile__modal-alert').css("display", "inline");
			$('#modal-alert-message').text("Passwords must be 8 characters long");
			$password_reset_fields.new_password.addClass('field-invalid');
			$password_reset_fields.confirm_password.addClass('field-invalid');
			fields_valid_result = false;

		}
		else {
			$('.profile__modal-alert').css("display", "none");
			$('#modal-alert-message').text("");
		}


		return fields_valid_result;

	}


	function show_password_modal_message(message) {
		$('.profile__modal-alert').css("display", "inline");
		$('#modal-alert-message').text(message);
	}




	function update_password(form_data) {

		$.ajax({

			// for now there is a fake userid and token entered
			data: {"userId" : "14", "token" : "72453864082aaef9e37dc0790b413643", "newPassword" : "sonic001", "confirmPassword" : "sonic001"},
			//data: form_data,
			type: "POST",
			url: "../../helpers/ajax_actions/emailResetPassword.php",
			success: function(response) {
				// Get rid of any whitespace.
				response = response.replace(/\s/, "");
				 alert(response);
				$('.modal-alert-message').text(response);
			}
		})

	}



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





	// Main Event //
	// -------------------------------------- //





	// When the user clicks the submit button. send the form dataa through ajax
	$('#profile__submit-password-reset').click(function(event) {

		event.preventDefault();

		$formItems = $('#profile__password-email-update-form').serializeArray();
		$data = serialToObj($formItems);

		// remove this when finished
		console.log($data);



		// if(password_reset_fields()) {
		// 	update_password();
		// }

		// Submit the from if the passwords If the passwords entered do not match then show an alert
		if( password_reset_fields_valid() ) {

			console.log("first phase field validation passed");

			if($data.hasOwnProperty('form-confirm-password')) {
				delete $data['form-confirm-password'];
			}

			update_password($data);
		}


	});


})(jQuery)
<?php
	require_once("../../includes/const.php");
	require_once("../../includes/mailer/mailerconst.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);


		$params = $_POST;

		//Get logg in user's email and ID from session.
	
		$db_result = $user->create_password_reset_token($params);

			if($db_result) {

				// Get the email template and add to email body

				// $template = requireToVar("mailer_templates/reset_password_email_template.php");
				// $reoumail->body = $template;

				// Attempt to send the email
				if(!$reoumail->send()) {
					 $trimmedMessage = str_replace("https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting", "", $reoumail->ErrorInfo);
				     add_message("alert", "Error occured when sending email: " . $trimmedMessage);
				} 
				else {

				    add_message("alert", "Message has been successfully send");

				}
							
			} else {

				add_message("alert", "Error occured when attempting to generate email");

			}

		if( $db_result ) {

			echo " Entry sucessfully added to the database.";

		} else {

			echo "Entry to database failed";
			
		}
	}
 ?>
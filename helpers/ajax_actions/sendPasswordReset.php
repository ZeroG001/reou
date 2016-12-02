<?php
	require_once("../../includes/const.php");
	require_once("../../includes/mailer/mailerconst.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


	session_start();


	if($_SERVER['REQUEST_METHOD'] == "POST"  ) {

		$user = new User($db);
		$params = $_POST;

		// Prepare email address
		// $reoumail->addAddress($_SESSION['email']);
		$reoumail->addReplyTo('info@realestateone.com', 'Info - RealEstateOne');
		$reoumail->Subject = 'Email Mailer Test';
		$mailerBody = requireToVar( "mailer_templates/reset_email_email_template.php" );

// $reoumail->Body  = $mailerBody;
		var_dump($_POST);

		

		

		//Get logg in user's email and ID from session.
		$db_result = $user->create_reset_token($params, "pass");
		var_dump($db_result);

		die();

			if($db_result) {

				// Get the email template and add to email body
				// $template = requireToVar("mailer_templates/reset_password_email_template.php");
				// $reoumail->body = $template;

				// Attempt to send the email
				// !$reoumail->send()
				if( False ) {
					 $trimmedMessage = str_replace("https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting", "", $reoumail->ErrorInfo);
				     add_message("alert", "Error occured when sending email: " . $trimmedMessage);
				} 
				else {
				    add_message("alert", "Message has been successfully sent");
				}
							
			} 
			else {
				add_message("alert", "Error occured when attempting to generate email");
			}

	}
 ?>

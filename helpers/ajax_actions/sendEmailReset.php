<?php
	require_once("../../includes/const.php");
	require_once("../../includes/mailer/mailerconst.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


	session_start();

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

		$user = new User($db);
		$params = $_POST;



		// Check if email already exists in the system
		if($user->unique_user_exists($params['email'])) {
			die("account_exists");
		}


		// Create Token
		$token_result = $user->create_reset_token($params, "email");


		if( $token_result ) {

			// Prepare the email
			// -----------------------------------
			$_POST['token'] = $token_result; // careful, this mailer is used in mailer template.
			$reoumail->addAddress($_SESSION['email']);
			$reoumail->addReplyTo('info@realestateone.com', 'Info - RealEstateOne');
			$reoumail->Subject = 'Email Reset Request';
			$mailerBody = requireToVar( "mailer_templates/reset_email_email_template.php" );
			$reoumail->Body = $mailerBody;


			// Send the email
			// -----------------------------------
			// !$reoumail->send()
			if( !$reoumail->send() ) {
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
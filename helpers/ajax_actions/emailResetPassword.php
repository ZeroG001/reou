<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");




	if( $_SERVER['REQUEST_METHOD'] == "POST" && isset( $_POST['token'] ) ) {

		$params = $_POST;
		$user_token = $_POST['token'];

		// Use the token to get the user ID
		// Use the User ID to update the password

		$user = new User($db);

		unset($params['confirmPassword']);
                                   
		// Attemt to get the token information
		try {

			$token_info = $user->get_token_info($params);

		} 
		catch (Exception $e) {

			// Instead show a flash message
			echo "unable to retrieve token info. Reason: " . $e->getMessage();

		}

		if(!empty($token_info)) {

			// The the expire token
			if(False) {
			// if( time() > $token_info['expire_time'] ) {

				echo "this token has expired";
				die();

			}

		}
		else {
			// dont run the code and quit  
			echo "the incorrect code was provided";            
		}

	} 
	else {
		die("password update failed.");
	}


?>

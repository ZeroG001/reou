<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	echo "Password successfuly updated";

	if( $_REQUEST_METHOD['POST'] && isset($_POST['token']) ) {

		// Use the token to get the user ID
		// Use the User ID to update the password

		$user = new $User;
	} 
	else {
		die("password update failed.")
	}
?>

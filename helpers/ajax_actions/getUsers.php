<?php

	#This returns JSON format of search results

	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


	$user = new User($db);
	$result = $user->get_users_info('search_users', 'ZeroG001@hotmail.com');
	
	echo json_encode($result);

	if( $_SERVER['REQUEST_METHOD'] == "POST" && isset( $_POST['token'] ) ) {} 


?>

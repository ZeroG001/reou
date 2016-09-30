<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");


		
		$user = new User($db);
		$user->dbsanitycheck();
	

	if( $_SERVER['REQUEST_METHOD'] == "POST" ) {}

 ?>
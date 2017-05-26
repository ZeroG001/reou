<?php
	require_once("../../includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	$user = new User($db);
	$result = $user->get_users_info('search_users', 'ZeroG001@hotmail.com');

	echo json_encode($result);
?>

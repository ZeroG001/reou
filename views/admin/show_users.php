<?php


	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$users = show_users($db);


?>


<ul>
	<?php foreach ($users as $k => $user) { ?>
		<li> <?php echo $user["email"] ?> </li>
	<?php  } ?>
	
</ul>
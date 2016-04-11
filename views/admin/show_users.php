<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$users = show_users($db);
	var_dump($_SESSION);
?>


<table id="table" class="user-list-table">
	<tr class="user-list--header"> 
		<th> Email </th>
		<th> Name </th>
		<th> Role </th>
		<th> Status </th>
	</tr>

	<?php foreach ($users as $k => $user) { ?>

			<tr>
				<td> <?php echo $user["email"] ?> 
					<form method="POST" action="<?php echo admin_route('edit') ?>" >
						<input type="submit" value="Go">		
						<input type="hidden" name="userId" value="<?php echo $user['id'] ?>" />
					</form> 
				</td>

				<td> <?php echo $user["first_name"]  . " " . $user["last_name"] ?> </td>
				<td> <?php echo $user["role"] ?> </td>
				<td> <?php var_dump($user['active'])?> </td>
			</tr>

	<?php  } ?>

</table>

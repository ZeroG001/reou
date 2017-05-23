<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$users = show_users($db);

	# If the method is path then update the user
	 // update_user($db, $_POST);
	
	# Or show edit profile like normal
	// $user = edit_profile($db);


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

	if( !userIsAdmin() ) {
		redirectHome();
	}


?>

<head>
	<title> Edit Profile </title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
</head>


<div class="profile-container">

	<!-- Sidebar -->
	<div class="profile__sidebar-container">

		<div class="profile__sidebar">

			<div class="profile__logo">
				<div class="profile__logo-image"> </div>
				<a href=""> Change Photo </a>
			</div>

			<a class="profile__sidebar-item" href="<?php ?>"> Users </a>
			<a class="profile__sidebar-item" href="<?php ?>"> Courses </a>
			<a class="profile__sidebar-item" href="<?php ?>"> Payments </a>

		</div>

	</div>


	<div class="profile__form-container">

		<!-- Alert Message  -->
		<div class="alert">
			<?php display_alert('error') ?>
			<?php display_alert('alert') ?>
			<?php clear_alert(); ?>
		</div>


		<!--- TEMP STYLES and HTML FOR ADMIN CENTER -->

		<style> 


		</style>

		<!--- ** END ** TEMP STYLES and HTMl FOR ADMIN CENTER -->

		<!-- ===== Main Main Admin Category Section ===== -->
		<table>
			<?php foreach ($users as $k => $user) { ?>
					<tr>
						
						<td> <?php echo $user["email"] ?> </td>
						<td> <?php echo $user["first_name"]  . " " . $user["last_name"] ?> </td>
						<td> <?php echo $user["role"] ?> </td>
						<td> <?php var_dump($user['active'])?> </td>
						<td> <a href="<?php echo user_route( 'edit',"?userId=${user['id']}" ) ?> "> Edit </a> </td>
					</tr>
			<?php  } ?>
		</table>



	</div>

</div>




<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "edit_profile.js" ?>"> </script>
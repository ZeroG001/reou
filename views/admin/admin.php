<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

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



		<!-- Courses -->
		<div class="admin_category--container">

			<div class="admin_category--header">
				<h3> Courses </h3>
			</div>

			<div class="admin_category--body">
				<!-- Body Section -->
				<a href=""> View Courses </a>
				<a href=""> Create Course </a>	
				<a href=""> Create Course Category </a>
			</div>

			<div class="admin_--footer">
				<!-- footer section -->
			</div>

		</div>


		<!-- Users Category -->
		<div class="admin_category--container">

			<div class="admin_category--header">
				<h3> Users </h3>
			</div>

			<div class="admin_category--body">
				<!-- Body Section -->
				<a href="<?php echo user_route('show-users') ?>"> View Users </a>
				<a href=""> Add Users </a>
				<a href=""> Create Course Category </a>
			</div>

			<div class="admin_--footer">
				<!-- footer section -->
			</div>

		</div>



		<!-- Payments Category -->
		<div class="admin_category--container">

			<div class="admin_category--header">
				<h3> Payments </h3>
			</div>

			<div class="admin_category--body">
				<!-- Body Section -->
				<a href=""> Enter Payment System </a>
			</div>

			<div class="admin_--footer">
				<!-- footer section -->
			</div>

		</div>



	</div>

</div>




<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "edit_profile.js" ?>"> </script>
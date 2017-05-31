<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/courses_controller.php");
	$courses = course_show($db);

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

			<a class="profile__sidebar-item" href="<?php echo admin_route('show-users') ?>"> Users </a>
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


		<!--- ** END ** TEMP STYLES and HTMl FOR ADMIN CENTER -->

		<div class="users_search_container">
			<form id="search_users_form">
				<input type="text" id="users_search_input" class="users_search_input" name="q" placeholder="Search">
				<button class="users_search_button"><i class="fa fa-search fa-lg"></i></button>
			</form>
		</div>

		<!-- ===== Main Main Admin Category Section ===== -->
		<table class="show_user_table">

			<tr>
				<th>Course Name</th>
				<th></th>
			</tr>

			<?php foreach ($courses as $k => $course) { ?>
				<tr class="user_table--row">
					
					<td class="user_table--cell"> <?php echo $course['course_name'] ?> </td>
					</td>
					<td class="user_table--cell"> <a href="<?php echo "fakeRoute" ?> "> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				 	</a> 
					</td>
				</tr>
			<?php  } ?>
		</table>

	</div>

</div>




<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "show_users.js" ?>"> </script>

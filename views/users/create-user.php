<!DOCTYPE html>


	<?php

		# For security reasons. I don't think admins should have the ability to create new users. There might be someone who creates a user using another person's name and end up buying classes they don't want.

		require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
		require_once(D_ROOT . "/reou/controllers/users_controller.php");

		create_user($db, $_POST);
		// $user = create_user($db);

	?>


	<head>
		<title> Sign In </title>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	</head>


	<?php
		# ----------------- Header HTML --------------------
		require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
	?>


	<div class="profile-container">

		<div class="profile__sidebar-container">

			<div class="profile__sidebar">

				<div class="profile__logo">
					<div class="profile__logo-image"> </div>
					<a href=""> Change Photo </a>
				</div>

				<a class="profile__sidebar-item" href="<?php ?>"> My Course </a>
				<a class="profile__sidebar-item" href="<?php ?>"> Schedule </a>
				<a class="profile__sidebar-item" href="<?php ?>"> ConEd Hours </a>
				<a class="profile__sidebar-item" href="<?php ?>"> Account and Invoice </a>
				
			</div>
			
		</div>


		<div class="profile__form-container">

			<!-- Alert Message  -->
			<div class="alert">
				<?php display_alert('error') ?>
				<?php display_alert('alert') ?>
				<?php clear_alert(); ?>
			</div>


			<form class="update_user--form" method="POST" enctype="multipart/form-data">

				<h2> Create New User profile. </h2>


				<input type="hidden" id="action" name="_method" value="post">


				<!-- Bulletproof Photo upload system -->
				<!-- Uncomment this when you're ready to upload images
			    <input type="hidden" id="image-upload--size" name="MAX_FILE_SIZE" value="1000000"/>
			    <input type="file" id="image-upload--file" name="profilePicture"/>
				-->

				<div class="profile__input-group">
					<label for="firstName"> First Name </label>
					<input type="text" class="profile__input" id="firstName" name="firstName" value="" />
				</div>


				<div class="profile__input-group">
					<label for="lastName"> Last Name </label>
					<input type="text" class="profile__input"  id="lastName" name="lastName" value="" />
				</div>


				<div class="profile__input-group">
					<!-- For this you need a way for the user to confirm their new email address. Dont make this site live until you can do that -->
					<label for="lastName"> Email Address ( needs work see comments ) </label>
					<input type="text" class="profile__input" id="email" name="email" value="" /> 
				</div>


				<div class="profile__input-group">

					<label for="password"> Password </label>
					<input type="password" class="profile__input" id="password" name="password" value="">

				</div>


				<div class="profile__input-group">
					<label for="bio"> About Yourself </label>
					<textarea title="bio" class="profile__input" name="bio"> </textarea>
				</div>

				<!-- ===== Possably for instructor info ===== -->


				<!-- ===== Admin Functions ===== -->
				<div class="profile__input-group">
					<label for="role"> Role </label>
					<select id="role" name="role">
						<option value="student"> Student </option>
						<option value="instructor"> Instructor </option>
						<option value="admin"> Administrator </option>
					</select>
				</div>


				<div class="profile__input-group">
					<label for="active"> User Active </label>
					<input type="checkbox" name="active" id="active" value="1" checked  />
				</div>


				<div class="profile__input-group">
					<label> Date Created </label>
					<span> 12/20/2015 (filler text) </span>
				</div>


				<div class="profile__input-group">
					<label> Last Updated On </label>
					<span> 1/20/2016 (filler text) </span>
				</div>

				<div class="profile__input-group">
					<input type="submit" class="profile__submit-button" value="Create User" />
				</div>

				<?php // Please do not erase the required_hp div. This is a honeypot field to help reduce spam ?>
				<div class="required_hp">
					<input type="hidden" name="hpUsername" />
				</div>

			</form>


		</div>

	</div>

</html>


<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "app.js" ?>"> </script>
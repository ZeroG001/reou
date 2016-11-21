<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	# If the method is path then update the user
	update_user($db, $_POST);
	
	# Or show edit profile like normal
	$user = edit_profile($db);


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

	var_dump($user);

?>

<head>
	<title> Edit Profile </title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
</head>



<div class="profile-container">

	<div class="profile__sidebar-container">

		<div class="profile__sidebar">

			<div class="profile__logo">
				<div class="profile__logo-image"> </div>
				<a href=""> Change Photo </a>
			</div>

			<a class="profile__sidebar-item" href="<?php ?>"> My Courses </a>
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

			<!-- <h2> My Profile Information ( REO Academy ) </h2> -->


			<input type="hidden" id="action" name="_method" value="patch">


			<!-- Bulletproof Photo upload system -->
			<!-- Uncomment this when you're ready to upload images
		    <input type="hidden" id="image-upload--size" name="MAX_FILE_SIZE" value="1000000"/>
		    <input type="file" id="image-upload--file" name="profilePicture"/>
			-->

			<div class="profile__input-group">
				<label for="firstName"> First Name </label>
				<input type="text" class="profile__input" id="firstName" name="firstName" value="<?php echo $user['first_name'] ?>" />
			</div>


			<div class="profile__input-group">
				<label for="lastName"> Last Name </label>
				<input type="text" class="profile__input"  id="lastName" name="lastName" value="<?php echo $user['last_name'] ?>" />
			</div>


			<div class="profile__input-group">
				<!-- 
					Need a way for a user to confirm their email address.
					A user can change their email address to that of another user. (which they shouldn't)
				 Dont make this site live until you can do that -->
				<label for="lastName"> Email Address ( needs work see comments ) <a href="edit"> Edit </a> </label>
				<input type="text" class="profile__input" id="email" name="email" disabled
				 value="<?php echo $user['email'] ?>" /> 
			</div>


			<div class="profilt__input-group">
				<input type="button" class="profile__password-reset" value="Reset Password">
			</div>


			<div class="profile__input-group">
				<label for="bio"> About Yourself </label>
				<textarea title="bio" class="profile__input" name="bio"><?php echo $user['bio'] ?> </textarea>
			</div>


			<!-- ===== Possably for instructor info ===== -->


			<!-- ===== Admin Functions ===== -->
			<div class="profile__input-group">
			
				<?php if(userIsAdmin()) { ?>
					<label for="role"> Role </label>
					<select id="role" name="role">
						<option value="student" <?php echo displaySelected("student", $user['role']) ?>   > Student </option>
						<option value="instructor" <?php echo displaySelected("instructor", $user['role']) ?> > Instructor </option>
						<option value="admin" <?php echo displaySelected("admin", $user['role']) ?> > Administrator </option>
					</select>
				<?php } ?>

			</div>


			<?php if(userIsAdmin()) { ?>
				<div class="profile__input-group">
					<label for="active"> User Active </label>
					<input type="checkbox" name="active" id="active" value="1" <?php echo displayChekbox($user['active']) ?> />
				</div>
			<?php } ?>


			<div class="profile__input-group profile__other-stats">
				<span> Member Since: <?php echo $user['created_at'] ?> </span>
				<span> Last Updated on: <?php echo $user['updated_at']?> </span>
			</div>

			<div class="profile__input-group">
				<input type="submit" class="profile__submit-button" value="Save Settings" />
			</div>

			<?php // Please do not erase the required_hp div. This is a honeypot field to help reduce spam ?>
			<div class="required_hp">
				<input type="hidden" name="hpUsername" />
			</div>


			<!-- use the hiddent field to tell which user needs to be updated -->
			<input type="hidden" id="userId" name="userId" value="<?php echo $user['id'] ?>">
		</form>


		
			<div style="display: none" class="profile__password-reset-modal">

				<div class="profile__password-reset-well">


					<?php if(userIsAdmin()) { ?>

					<form action="#" method="POST" class="profile__send-password-reset-form">

						<input type="hidden" name="userId" value="<?php echo $user['id'] ?>">

						<div class="profile__modal-header">
							<h2> Reset User Password </h2>
							<span class="profile__modal-close"> X </span>
						</div>

						<div class="profile__modal-body">	
							<div class="profile__admin-reset-container">
								<i class="fa fa-envelope-o"></i>
								<input type="submit" class="profile__send-password-reset-button" id="profile__send-password-reset-button" value="Send Password Reset Email">

							</div>		

						</div>

					</form>


					<?php } else { ?>


					<form action="#" method="POST" class="profile__password-form">

						<div class="profile__modal-header">
							<h2> Change your password. </h2>
							<span class="profile__modal-close"> X </span>
						</div>


						<div class="profile__modal-alert alert">
							<span id="modal-alert-message"> <!-- Alert message here  --> </span>
						</div>


						<div class="profile__modal-body">			

							<div class="profile__input-group">
								<label for="password"> Current Password </label>
								<input type="password" id="modal-password" class="profile__input modal-password-input" name="password" required="true" /> 
							</div>
							

							<div class="profile__input-group">
								<label for="modal-new-password"> New Password </label>
								<input type="password" id="modal-new-password" class="profile__input modal-new-password-input" name="newPassword" required="true" />
							</div>


							<div class="profile__input-group">
								<label for="confirm-password"> Confirm New Password </label>
								<input type="password" class="profile__input" id="modal-confirm-password" name="modal-confirm-password" required="true" />
							</div>

							<input type="submit" class="profile__password-submit-button-modal" id="profile__password-submit-button-modal" value="Change Password">
							
						</div>

					</form>

					<?php } ?>

				</div>

			</div>		


	</div>

</div>




<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "edit_profile.js" ?>"> </script>
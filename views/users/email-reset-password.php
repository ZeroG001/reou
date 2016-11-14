
<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	# If the method is path then update the user
	# update_user($db, $_POST);
	
	# Or show edit profile like normal
	# $user = edit_profile($db);


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>

<head>
	<title> Edit Profile </title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
</head>



<div class="main-content">

	<div class="password-email-reset-container">
s0n!cb00m

		<h2> Reset Your Password </h2>
		<h5> Please enter your new password below </h5>


		<form class="password-email-update-form" action="">

			<div class="reou-form__input-group">
				<label for="password"> Current Password </label>
				<input type="password" id="modal-password" class="reou-form__input modal-password-input" name="password" required="true" /> 
			</div>
			

			<div class="reou-form__input-group">
				<label for="modal-new-password"> New Password </label>
				<input type="password" id="modal-new-password" class="reou-form__input  modal-new-password-input" name="newPassword" required="true" />
			</div>


			<div class="reou-form__input-group">
				<label for="confirm-password"> Confirm New Password </label>
				<input type="password" class="reou-form__input" id="modal-confirm-password" name="modal-confirm-password" required="true" />
			</div>
			

			<div class="reou-form__input-group">
				<input type="button" class="reou-form__submit-button" value="Reset Password">
			</div>

		</form>

	</div>



</div>



<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<!-- <script type="text/javascript" src="<?php # echo asset_route('js') . "" ?>"> </script> -->
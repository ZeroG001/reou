
<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	user_mail_reset_password($db, $_POST);


	$token = $_GET['a'];



	# If the method is path then update the user
	# update_user($db, $_POST);
	
	# Or show edit profile like normal
	# $user = edit_profile($db);


	# ****IMPORTANT IF SESSION ALREADY EXISTS DUMP THE SESSION*****

	# ** If the session already exists make sure tha the requires is GET and that there is athe Toekn Parameter added


	// ----------------- Header HTML --------------------
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

?>

<head>
	<title> Edit Profile </title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
</head>



<div class="main-content">



	<div class="password-email-reset-container">

		<?php display_alert('alert') ?>

		<h2> Reset Your Password </h2>
		<h5> Please enter your new password below </h5>


		<div class="profile__modal-alert alert">
			<span id="modal-alert-message"> </span>
		</div>


		<form class="password-email-update-form" method="POST" id="profile__password-email-update-form" action="">

			<input type="hidden" name="token" value="<?php echo $token ?>" />
			<input type="hidden" name="_method" value="patch" /> 	

			<div class="reou-form__input-group">
				<label for="modal-new-password"> New Password </label>
				<input type="password" id="form-new-password" class="reou-form__input  modal-new-password-input" name="newPassword" required="true" />
			</div>


			<div class="reou-form__input-group">
				<label for="confirm-password"> Confirm New Password </label>
				<input type="password" class="reou-form__input" id="form-confirm-password" name="confirmPassword" required="true" />
			</div>
			

			<div class="reou-form__input-group">
				<input type="submit" class="reou-form__submit-button" id="profile__submit-password-reset" value="Reset Password">
			</div>

		</form>

	</div>



</div>



<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "email-reset-password.js" ?>"> </script>
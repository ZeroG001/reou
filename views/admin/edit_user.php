<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");

	update_user($db, $_POST);
	

	var_dump($_SESSION);	
?>




<div class="container">

	<!-- Alert Message  -->
	<div class="alert">
		<?php display_alert('error') ?>
		<?php display_alert('alert') ?>
	</div>


	<form class="update_user__form" method="POST">


		<input type="hidden" id="action" name="_method" value="patch">


		<!-- Bulletproof -->
	    <input type="hidden" id="image-upload--size" name="MAX_FILE_SIZE" value="1000000"/>
	    <input type="file" id="image-upload--file" name="profilePicture"/>

		
		<label for="firstName"> First Name </label>
		<input type="text" id="firstName" name="firstName" value="<?php echo $user['first_name'] ?>">

		<label for="lastName"> Last Name </label>
		<input type="text"  id="lastName" name="lastName" value="<?php echo $user['last_name'] ?>">

		<!-- For this you need a way for the user to confirm their new email address. Dont make this site live until you can do that -->
		<label for="lastName"> Email Address(see comments) </label>
		<input type="text" id="email" name="email" value="<?php echo $user['email'] ?>"> 


		<label for="bio"> About Yourself </label>
		<textarea title="bio" name="bio"> <?php echo $user['bio'] ?>  </textarea>

		<!-- ===== Possably for instructor info ===== -->

		<!-- <label for="lastName"> Phone Number </label>
		<input type="text" id="phone" /> -->

		<!-- ===== Admin Functions ===== -->

		<label for="role"> Role </label>

		<select id="role" name="role">
			<option value="student" <?php echo displaySelected("student", $user['role']) ?>   > Student </option>
			<option value="instructor" <?php echo displaySelected("instructor", $user['role']) ?> > Instructor </option>
			<option value="admin" <?php echo displaySelected("admin", $user['role']) ?> > Administrator </option>
		</select>

		<label for="active"> User Active </label>
		<input type="checkbox" name="active" id="active" checked>

		<label> Date Created </label>
		<span> <?php echo user['created_at'] ?> (filler text) </span>

		<label> Last Updated On </label>
		<span><?php echo user['updated_at'] ?> </span>

		

		<?php // Please do not erase the required_hp div. This is a honeypot field to help reduce spam ?>
		<div class="required_hp">
			<input type="text" name="hpUsername" />
		</div>


		<!-- use the hiddent field to tell which user needs to be updated -->
		<input type="hidden" id="userId" name="userId" value="<?php echo $user['id'] ?>">
		
		<input type="submit"> Update User </input>
	</form>


</div>


<script type="text/javascript" src="<?php echo asset_route('js') . "jquery/dist/jquery.min.js" ?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . "app.js" ?>"> </script>
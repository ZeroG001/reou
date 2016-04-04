<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
	require_once(D_ROOT . "/reou/controllers/users_controller.php");
	$user = edit_user($db);

	var_dump($user);
?>


<div class="container">

	<form class="update_user--form">

		<label for="firstName"> First Name </label>
		<input type="text" id="firstName" name="firstName" value="<?php echo $user['first_name'] ?>">

		<label for="lastName"> Last Name </label>
		<input type="text" id="lastName" value="<?php echo $user['last_name'] ?>">

		<!-- For this you need a way for the user to confirm their new email address. Dont make this site live until you can do that -->
		<label for="lastName"> Email Address(see comments) </label>
		<input type="text" id="email" value="<?php echo $user['email'] ?>"> 


		<label for="password"> Change Password </label>
		<input type="text" id="password" name="password" />

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
		<input type="checkbox" name="active" id="active" <?php echo displayChekbox($user['active']) ?> >

		<label> Date Created </label>
		<span> 12/20/2015 (filler text) </span>

		<label> Last Updated On </label>
		<span> 1/20/2016 (filler text) </span>


		<!-- use the hiddent field to tell which user needs to be updated -->
		<input type="hidden" id="userId" value="userIDfromPHP">

		<input type="submit"> Update User </input>
	</form>


</div>
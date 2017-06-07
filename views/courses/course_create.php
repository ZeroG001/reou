<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

	// Course is only created on submit
	$params = course_create($db);

	course_create($db);

	// if ( isset($params) ) {
	// 	echo "the params are....." ;
	// 	var_dump($params);
	// }

?>


<!-- Courses. Thisgs we would liek to update -->

<!-- 

	- The Goal today is to be able to create a course then create a schedule for that course
	- You should also be able to create and submit multiple schedules for the corse
	- Multiple forms will be submitted using ajax



	General Course Information
	
	- course_name
	- course_desc
	- category_id
	- course_number
	- course_cost (this might get complicated fast)
	- course_location
	- course_credits
	- course_notes
	- instructor_id
	- min_class_size
	- max_class_size (change from)



	Timing and Scheduling

	- course_hours ( defines what time the course startes and begins. This might need to be defined separately )
	- course_duration



	Other

	- course_id
	- active


-->

	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_route('css') ?>main.css">
	</head>


	<div class="profile__form-container">

		<!-- Sidebar -->
		<?php require( D_ROOT . layout_route('admin-sidebar') ) ?>

		<?php display_alert('error'); ?>
		<?php display_alert('alert'); ?>


		<!-- Action should be the course acc place -->
		<form method="POST" action="">

			<h1> Loreum ipsum title </h1>

			<input type="hidden" id="action" name="_method" value="patch">


			<!-- Items Related to course details -->
			<fieldset>


				<h3> Loreum Ipsum Info </h3>

				<!-- Course Name -->
				<label for="courseName"> Course Name </label>
				<input type="text" name="courseName" id="courseName" value="<?php if( isset( $_POST['courseName']) ) { echo $_POST['courseName']; } ?>"> </input>


				<!-- Course Description -->
				<label for="courseDesc"> Course Descirption </label>
				<input type="text" name="courseDesc" id="courseDesc" value="<?php if( isset( $_POST['courseName']) ) { echo $_POST['courseDesc']; } ?>">
				

				<!-- This information will have to pull in from the course category query -->
				<label for="categoryId"> Category </label>
				<select name="categoryId">
					<option value="1"> Category One </option>
					<option value="2"> Category Two </option>
					<option value="3"> Category Three </option>
				</select>


				<!-- Course Number -->
				<div class="reou-form__input-group">
					<label for="courseNumber"> Course Number </label>
					<input type="text" class="reou-form__input" name="courseNumber" id="courseNumber" value="<?php if( isset( $_POST['courseName']) ) { echo $_POST['courseNumber']; } ?>">
				</div>

				<!-- Course Cost (Number Only) -->
				<div class="reou-form__input-group">
					<label for="courseCost"> Course Cost </label>
					<input type="text" class="reou-form__input" name="courseCost" id="courseCost" value="<?php if( isset( $_POST['courseCost']) ) { echo $_POST['courseCost']; } ?>">
				</div>

				<!-- Course Location -->
				<div class="reou-form__input-group">
					<label for="courseLocation"> Course Location </label>
					<input type="text" class="reou-form__input" name="courseLocation" id="courseLocation" value="<?php if( isset( $_POST['courseLocation']) ) { echo $_POST['courseLocation']; } ?>">
				</div>

				<!-- Course Credits (Number Only) -->
				<div class="reou-form__input-group">
					<label for="courseCredits"> Course Credits </label>
					<input type="text" class="reou-form__input" name="courseCredits" id="courseCredits" value="<?php if( isset( $_POST['courseCredits']) ) { echo $_POST['courseCredits']; } ?>">
				</div>


				<!-- Course Notes -->
				<div class="reou-form__input-group">
					<label for="courseNotes"> Course Notes </label>
					<textarea id="courseNotes" name="courseNotes"></textarea>
				</div>


				<!-- Instructor ID-->
				<div class="reou-form__input-group">
					<label for="instructorId"> Instructor </label>
					<input type="text" name="instructorId" value="<?php if( isset( $_POST['instructorId']) ) { echo $_POST['instructorId']; } ?>">
				</div>


				<!-- Min Class Size -->
				<div class="reou-form__input-group">
				<label for="minClassSize"> Min Class Size </label>
				<input type="text" name="minClassSize" id="minClassSize" value="<?php if( isset( $_POST['minClassSize']) ) { echo $_POST['minClassSize']; } ?>"> 
				</div>


				<!-- Max Class Size -->
				<label for="maxClassSize"> Max Class Size </label>
				<input type="text" name="maxClassSize" id="maxClassSize" value="<?php if( isset( $_POST['maxClassSize']) ) { echo $_POST['maxClassSize']; } ?>">


				<!-- Course Active? -->
				<label for="active"> Course Active </label>
				<span> Yes </span>
				<input type="radio" name="active" value="1" <?php if( isset( $_POST['active'] ) && $_POST['active'] == '1' ) { echo "checked"; } elseif ( !isset( $_POST['active'] ) ) { echo "checked"; } ?>>

				<span> No </span>
				<input type="radio" name="active" value="0" <?php if( isset( $_POST['active'] ) && $_POST['active'] == '0' ) { echo "checked"; } ?>>

				<input type="hidden" name="_method" value="post">
				<input type="submit" value="Create Page">

			</fieldset>

		</form>

	</div>


	<!-- Javasript Sources -->
	<script type="text/javascript" src="<?php echo asset_route('js') . 'jquery/dist/jquery.min.js'?>"> </script>
	<script type="text/javascript" src="<?php echo asset_route('js') . 'course_create.js' ?>"> </script> 

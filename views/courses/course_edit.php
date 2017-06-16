<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');

	// We are going to update or edit course
	update_course($db, $_POST);
	# Or #
	list(
		$course_details, 
		$course_schedules,
		$course_categories,
		$instructors) = course_edit($db);


	$weekdays = array("Sunday", "Monday", "Tuesday", "Wedesday", "Thursday", "Friday", "Saturday");


	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');

	// Load course_schedule result to be used in javascript variable.

?>
	<script>
		var course_schedules = <?php echo json_encode($course_schedules); ?>;
		console.log(course_schedules);
		console.log("variable - course_schedules");
	</script>



<!-- Courses. Thisgs we would liek to update -->

<!-- 

	- The Goal today is to be able to create a course then create a schedule for that course.

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

	<?php display_alert('error') ?>
	<?php display_alert('alert') ?>


	<div class="profile-container"> 

		<!-- Sidebar -->
		<?php require( D_ROOT . layout_route('admin-sidebar') ) ?>


		<div class="profile__form-container">


			<!-- Action should be the course acc place -->
			<form method="POST" action="#" id="course-edit-form">


				<h1> Edit Course </h1>

				<?php #Tells form that we are updating the course ?>
				<input type="hidden" id="action" name="_method" value="patch">


				<!-- Items Related to course details -->

					<h3> Course Info </h3>

					<!-- Course Name -->
					<div class="reou-form__input-group">
						<label for="courseName"> Course Name </label>
						<input type="text" class="reou-form__input" name="courseName" id="courseName" value="<?php echo $course_details["course_name"] ?>"> </input>
					</div>



					<!-- Course Description -->
					<div class="reou-form__input-group">
						<label for="courseDesc"> Course Descirption </label>
						<input type="text" class="reou-form__input" name="courseDesc" id="courseDesc" value="<?php echo $course_details['course_desc'] ?>">
					</div>
					


					<!-- This information is pulling in from the course category table i the database.  -->
					<label for="categoryId"> Category </label>

					<select name="categoryId">
						<?php foreach( $course_categories as $course_category ) { ?>
							<option value="<?php echo $course_category['category_id']?>" <?php echo displayOption($course_category['category_id'], $course_details['category_id']) ?> >
								<?php echo $course_category['category_name']; ?>
							</option>
						<?php } ?>
					</select>



					<!-- Course Number -->
					<div class="reou-form__input-group">
						<label for="courseNumber"> Course Number </label>
						<input type="text" class="reou-form__input" name="courseNumber" id="courseNumber" value="<?php echo $course_details['course_name'] ?>">
					</div>



					<!-- Course Cost (Number Only) -->
					<div class="reou-form__input-group">
						<label for="courseCost"> Course Cost </label>
						<input type="text" class="reou-form__input" name="courseCost" id="courseCost" value="<?php echo $course_details['course_cost'] ?>">
					</div>



					<!-- Course Location -->
					<div class="reou-form__input-group">
						<label for="courseLocation"> Course Location </label>
						<input type="text" class="reou-form__input" name="courseLocation" id="courseLocation" value="<?php echo $course_details['course_location'] ?>">
					</div>



					<!-- Course Credits (Number Only) -->
					<div class="reou-form__input-group">
						<label for="courseCredits"> Course Credits </label>
						<input type="text" class="reou-form__input" name="courseCredits" id="courseCredits" value="<?php echo $course_details['course_credits'] ?>">
					</div>



					<!-- Course Notes -->
					<div class="reou-form__input-group">
						<label for="courseNotes"> Course Notes </label>
						<textarea id="courseNotes" class="reou-form__input" name="courseNotes"><?php echo $course_details['course_notes'] ?></textarea>
					</div>



					<!-- Min Class Size -->
					<div class="reou-form__input-group">
						<label for="minClassSize"> Min Class Size </label>
						<input type="text" name="minClassSize" class="reou-form__input" id="minClassSize" value="<?php echo $course_details['min_class_size'] ?>">
					</div>



					<!-- Max Class Size -->
					<div class="reou-form__input-group">
						<label for="maxClassSize"> Max Class Size </label>
						<input type="text" name="maxClassSize" class="reou-form__input" id="maxClassSize" value="<?php echo $course_details['max_class_size']  ?> ">
					</div>


					<div class="reou-form__input-group">
						<label for="active"> User Active </label>
						<input type="checkbox" name="active" id="active" class="reou-form__input" value="1" <?php echo displayChekbox($course_details['active']) ?> />
					</div>

				<?php // Please do not erase the required_hp div. This is a honeypot field to help reduce spam ?>
				<div class="required_hp">
					<input type="hidden" name="hpUsername" />
				</div>

				<input type="hidden" value="<?php echo $course_details['course_id'] ?>">

				<input type="submit" class="reou-form__submit-button" value="Submit" >

			</form>

		</div>

	</div>





<!-- Javasript Sources -->
<script type="text/javascript" src="<?php echo asset_route('js') . 'jquery/dist/jquery.min.js'?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . 'course_create.js' ?>"> </script> 
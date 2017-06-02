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


	<!-- Action should be the course acc place -->
	<form method="POST" action="">


		<h1> Creating a new class </h1>

		<?php #Tells form that we are updating the course ?>
		<input type="hidden" id="action" name="_method" value="patch">


		<!-- Items Related to course details -->
		<fieldset>


			<h3> Course Info </h3>

			<!-- Course Name -->
			<label for="courseName"> Course Name </label>
			<input type="text" name="courseName" id="courseName" value="<?php echo $course_details["course_name"] ?>"> </input>


			<!-- Course Description -->
			<label for="courseDesc"> Course Descirption </label>
			<input type="text" name="courseDesc" id="courseDesc" value="<?php echo $course_details['course_desc'] ?>">
			

			<!-- This information is pulling in from the course category table i the database.  -->
			<label for="categoryId"> Category </label>
			<select name="categoryId">
				<?php foreach( $course_categories as $course_category ) { ?>
					<option value="<?php echo $course_category['category_id'] ?>">
						<?php echo $course_category['category_name']; ?>
					</option>
				<?php } ?>
			</select>


			<!-- Course Number -->
			<label for="courseNumber"> Course Number </label>
			<input type="text" name="courseNumber" id="courseNumber" value="<?php echo $course_details['course_name'] ?>">

			<!-- Course Cost (Number Only) -->
			<label for="courseCost"> Course Cost </label>
			<input type="text" name="courseCost" id="courseCost" value="<?php echo $course_details['course_cost'] ?>">


			<!-- Course Location -->
			<label for="courseLocation"> Course Location </label>
			<input type="text" name="courseLocation" id="courseLocation" value="<?php echo $course_details['course_location'] ?>">


			<!-- Course Credits (Number Only) -->
			<label for="courseCredits"> Course Credits </label>
			<input type="text" name="courseCredits" id="courseCredits" value="<?php echo $course_details['course_credits'] ?>">


			<!-- Course Notes -->
			<label for="courseNotes"> Course Notes </label>
			<textarea id="courseNotes" name="courseNotes"><?php echo $course_details['course_notes'] ?></textarea>

			<!-- Instructor ID-->
			<!-- this information is going to be pulled in from the database. -->
			<label for="instructorId"> Instructor </label>

			<select>

				<?php foreach ($instructors as $instructor) { ?>
					<option value="<?php echo $instructor['id'] ?>"> 
						<?php echo $instructor["first_name"] . " " . $instructor['last_name'] ?>
					</option>
				<?php } ?>

			</select>


			<!-- Min Class Size -->
			<label for="minClassSize"> Min Class Size </label>
			<input type="text" name="minClassSize" id="minClassSize" value="<?php echo $course_details['min_class_size'] ?>"> 


			<!-- Max Class Size -->
			<label for="maxClassSize"> Max Class Size </label>
			<input type="text" name="maxClassSize" id="maxClassSize" value="<?php echo $course_details['max_class_size']  ?> ">


			<div class="profile__input-group">
				<label for="active"> User Active </label>
				<input type="checkbox" name="active" id="active" value="1" <?php echo displayChekbox($course_details['active']) ?> />
			</div>

		</fieldset>

		<?php // Please do not erase the required_hp div. This is a honeypot field to help reduce spam ?>
		<div class="required_hp">
			<input type="hidden" name="hpUsername" />
		</div>

		<input type="hidden" value="<?php echo $course_details['course_id'] ?>">

		<input type="Submit" value="Submit" >

	</form>





<!-- Javasript Sources -->
<script type="text/javascript" src="<?php echo asset_route('js') . 'jquery/dist/jquery.min.js'?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . 'course_create.js' ?>"> </script> 


<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');

	// Course is only created on submit
	$params = course_create($db);

	// if ( isset($params) ) {
	// 	echo "the params are....." ;
	// 	var_dump($params);
	// }

	//Header HTML
	 require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');



?>



<!-- Courses. Thisgs we would liek to update -->

<!-- 

	The Goal today is to be able to create a course then create a schedule for that course.

	- There will be multiple forms that will be submitted via ajax. They will be timed submits. 
		So they will be executed one after another.

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

	<input type="hidden" id="action" name="_method" value="patch">


	<!-- Items Related to course details -->
	<fieldset>


		<h3> Course Info </h3>

		<!-- Course Name -->
		<label for="courseName"> Course Name </label>
		<input type="text" name="courseName" id="courseName" value="<?php echo htmlentities($params['courseName']) ?>"> </input>


		<!-- Course Description -->
		<label for="courseDesc"> Course Descirption </label>
		<input type="text" name="courseDesc" id="courseDesc" value="<?php echo htmlentities($params['courseDesc']) ?>">
		

		<!-- This information will have to pull in from the course category query -->
		<label for="categoryId"> Category </label>
		<select name="categoryId">
			<option value="1"> Category One </option>
			<option value="2"> Category Two </option>
			<option value="3"> Category Three </option>
		</select>


		<!-- Course Number -->
		<label for="courseNumber"> Course Number </label>
		<input type="text" name="courseNumber" id="courseNumber" value="<?php echo htmlentities($params['courseNumber']) ?>">

		<!-- Course Cost (Number Only) -->
		<label for="courseCost"> Course Cost </label>
		<input type="text" name="courseCost" id="courseCost" value="<?php echo htmlentities($params['courseCost']) ?>">


		<!-- Course Location -->
		<label for="courseLocation"> Course Location </label>
		<input type="text" name="courseLocation" id="courseLocation" value="<?php echo htmlentities($params['courseLocation']) ?>">


		<!-- Course Credits (Number Only) -->
		<label for="courseCredits"> Course Credits </label>
		<input type="text" name="courseCredits" id="courseCredits" value="<?php echo htmlentities($params['courseCredits']) ?>">


		<!-- Course Notes -->
		<label for="courseNotes"> Course Notes </label>
		<textarea id="courseNotes" name="courseNotes"><?php echo htmlentities($params['courseNotes']) ?></textarea>

		<!-- Instructor ID-->
		<label for="instructorId"> Instructor </label>
		<input type="text" name="instructorId" value="<?php echo htmlentities($params['instructorId']) ?> ">


		<!-- Min Class Size -->
		<label for="minClassSize"> Min Class Size </label>
		<input type="text" name="minClassSize" id="minClassSize" value="<?php echo htmlentities($params['minClassSize']) ?>"> 


		<!-- Max Class Size -->
		<label for="maxClassSize"> Max Class Size </label>
		<input type="text" name="maxClassSize" id="maxClassSize" value="<?php echo htmlentities($params['maxClassSize']) ?> ">

		<label for="active"> User Active </label>

		<span> Yes </span>
		<input type="radio" name="active" value="1" checked>

		<span> No </span>
		<input type="radio" name="active" value="0">

	</fieldset>


	<!-- Items related to course timing -->
	<fieldset>

		<h3> Course Schedule </h3>

		<!-- Course Hours -->
		<label for="courseHours"> Course Hours </label>
		<input type="text" name="courseHours" value="<?php echo htmlentities($params['courseHours']) ?> ">


		<!-- Course Duration -->
		<label for="courseDuration"> Course Duration </label>
		<input type="text" name="courseDuration" value="<?php echo htmlentities($params['courseDuration']) ?> ">

	</fieldset>

	<input type="Submit" value="Submit">

</form>



<!-- ==================== Course Schedule ==================== -->


<form method="POST" action="">

	<h1> Create Class Schedule </h1>

	<input type="hidden" id="action" name="_method" value="patch">

		<!-- Items related to course timing -->
		<fieldset>

			<h3> Course Schedule </h3>


			<!-- Course ID -->
			<label for="courseId"> Course ID </label>
			<input type="text" name="courseId" value=""> <br /><br />


			<!-- class_begin_date -->
			<label for="classBeginDate"> Class Begin Date </label>
			<input type="text" name="classBeginDate" value=""> <br /><br />


			<!-- class_end_date -->
			<label for="classEndDate"> Class End Date </label>
			<input type="text" name="classEndDate" id="staffId" value=""> <br /><br />


			<!-- Days Availible -->
			<label for="daysAvailable"> Days Available </label>
			<input type="text" name="daysAvailable" id="daysAvailable" value=""> <br /><br />


			<!-- Location -->
			<label for="location"> Location </label>
			<input type="text" name="location" id="location" value=""> <br /><br />


		</fieldset>

	<input type="Submit" value="Submit">

</form>



<!-- Javasript Sources -->
<script type="text/javascript" src="<?php echo asset_route('js') . 'jquery/dist/jquery.min.js'?>"> </script>
<script type="text/javascript" src="<?php echo asset_route('js') . 'course_create.js' ?>"> </script> 

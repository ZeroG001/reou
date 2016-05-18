<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');

	// Course is only created on submit
	//course_create($db);

	//Header HTML
	 require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/views/layouts/header.php');
?>



<!-- Courses. Thisgs we would liek to update -->

<!-- 

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
	

<form>

	<!-- Items Related to course details -->
	<fieldset>

		<!-- Course Name -->
		<label for="courseName"> Course Name </label>
		<input type="text" name="course_name" id="courseName"> </input>


		<!-- Course Description -->
		<label for="courseDesc"> Course Descirption </label>
		<input type="text" name="course_desc" id="courseDesc">
		

		<!-- This information will have to pull in from the course category query -->
		<label for="categoryId"> Category </label>
		<select if="categoryId">
			<option value="one"> Category One </option>
			<option value="two"> Category Two </option>
			<option value="three"> Category Three </option>
		</select>


		<!-- Course Number -->
		<label for="courseNumber"> Course Number </label>
		<input type="text" name="courseNumber" id="courseNumber">

		<!-- Course Cost (Number Only) -->
		<label for="courseCost"> Course Cost </label>
		<input type="text" name="courseCost" id="courseCost">


		<!-- Course Location -->
		<label for="courseLocation"> Course Location </label>
		<input type="text" name="courseLocation" id="courseLocation">


		<!-- Course Credits (Number Only) -->
		<label for="courseCredits"> Course Credits </label>
		<input type="text" name="courseCredits" id="courseCredits">


		<!-- Course Credits (Number Only) -->
		<label for="courseCredits"> Course Credits </label>
		<input type="text" name="courseCredits" id="courseCredits">


		<!-- Course Notes -->
		<label for="courseNotes"> Course Notes </label>
		<textarea id="courseNotes" name="courseNotes"></textarea>

		<!-- Instructor ID-->
		<label for="instructorId"> Instructor </label>
		<input type="text" name="instructorId">


		<!-- Min Class Size -->
		<label for="minClassSize"> Min Class Size </label>
		<input type="text" name="minClassSize" id="minClassSize">


		<!-- Max Class Size -->
		<label for="maxClassSize"> Max Class Size </label>
		<input type="text" name="maxClassSize" id="maxClassSize">

	</fieldset>


	<!-- Items related to course timing -->
	<fieldset>

		<!-- Course Hours -->
		<label for="courseHours"> Course Hours </label>
		<input type="text" name="courseHours">


		<!-- Course Duration -->
		<label for="courseDuration"> Course Duration </label>
		<input type="text" name="courseDuration">		

	</fieldset>

</form>


</form>

<?php
	require('../includes/const.php');
	require(D_ROOT . '/reou/includes/database.php');

	$course = new Course($db);
	$courses = $course->get_course_classes("1");	

	foreach ($courses as $v) {
		echo $v['course_name'];
		echo $v['course_number'];
		echo $v['course_hours_day'];
		echo $v['course_duration_day'];
	}
?>

<style type="text/css">

	.wrap {
		position: relative;
		display:block;
		max-width: 500px;
		margin:0px auto;
	}

	.box {
		display: inline-block;
		height: 300px;
		width: 100%;
		margin-bottom: 10px;
		border: 1px solid black;
	}
</style>

<div class="wrap">

<?php
	
	foreach ($courses as $v) {
		echo "<div class='box'>";
		echo $v['course_name'];
		echo "<br />";
		echo "Course Number";
		echo $v['course_number'];
		echo "<br />";
		echo "Hours";
		echo $v['course_hours_day'];
		echo "<br />";
		echo $v['course_duration_day'];
		echo "</div>";
	}

	

?>

</div>

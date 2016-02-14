<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class Course {

	public static $message = array(
		"alert" => "",
		"error" => "",
		"success" => "",
		"notice" => ""
	);

	// Class Dependencies
	 public $db;
	 public function __construct(PDO $db) {
	 	$this->db = $db;
	 }



	 // -------- Get Corse Information -------- //
	 public function get_course_category() {

	 	$query = "SELECT * FROM course_category";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->execute();
	 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result;
	 }



	 public function get_course_classes($course_id) {
	 	$cols = array(
	 		"course_id",
			"course_name",
			"course_number",
			"course_duration_day",
			"course_duration_evening",
			"course_location",
			"course_hours_day",
			"course_credits",
			"course_cost_day",
			"course_cost_evening",
			"course_hours_evening",
			"course_duration_day",
			"course_notes"
	 	);

	 	$cols = implode(", ", $cols);
	
	 	$query = "SELECT $cols FROM courses c 
	 	INNER JOIN course_category cc 
	 	ON c.category_id=cc.category_id
	 	WHERE c.category_id = ? AND active = 1";
	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $course_id);
	 	$stmt->execute();
	 	$result_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $result_array;
	 }


	 public function get_class_details($class_id) {

	 	$query = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $class_id);

	 	try {
	 		$stmt->execute();
	 	} 
	 	catch (Exception $e) {
	 		echo "There was a problem getting the class details";
	 	}
	 	
	 	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $results;

	 }



	 public function get_course_schedule($course_id) {
	 	$cols = array(
	 		"location",
	 		"staff_id",
	 		"class_date",
	 		"active",
	 		"class_begin_time",
	 		"class_end_time",
	 		"course_id",
	 		"course_number",
	 		"course_name",
	 		"course_desc",
	 	);

	 	$query = "SELECT * FROM course_schedules cs 
		INNER JOIN courses c 
		ON cs.course_id=c.course_id 
		WHERE cs.course_id = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $course_id);
		$stmt->execute();

		$resutls = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $resutls;
	 }




	// ---------- edit courses ---------- //



	 public function register_course($params) {

	 	// Check if the Params are in the accepted params List
		foreach ($params as $param => $value) {
		 	if(!in_array($param, $this->accepted_params())) {
		 		die("Form Field " . $param . " is not accepted");	
		 	}
		}

		if($this->userRegisteredforClass($params['student_id'], $params['course_id'], $params['schedule_id'])) {
			die("You are already registered for this class (make a popup?)");
		}


	 	$query = "INSERT INTO students_courses (student_id, course_id, schedule_id) 
	 	VALUES (:student_id, :course_id, :schedule_id)";

	 	$stmt = $this->db->prepare($query);
		$stmt->bindParam(':student_id', $params['student_id'], PDO::PARAM_INT);
		$stmt->bindParam(':course_id', $params['course_id'], PDO::PARAM_INT);
		$stmt->bindParam(':schedule_id', $params['schedule_id'], PDO::PARAM_INT);

		try {

			$stmt->execute();

		} catch (Exception $e) {

			echo "There was a problem registering for the course";
			echo $e->getMessage();
		}
	 }


	 // ------------- Show all classes a student is registered for ----------------------
	 public function get_registered_courses($student_id) {

	 	$query = "SELECT DISTINCT(course_name), sc.course_id from reou.courses c INNER JOIN students_courses sc ON c.course_id = sc.course_id WHERE sc.student_id = ?";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $student_id);
	 	$stmt->execute();

	 	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	return $results;

	 }



	 // Check to see if a user is already registered for a class
	 public function userRegisteredforClass($student_id, $course_id, $schedule_id) {

	 	$query = "SELECT * FROM students_courses 
	 	WHERE student_id = :student_id
	 	AND course_id = :course_id
	 	AND schedule_id = :schedule_id LIMIT 1";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
		$stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
		$stmt->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	 }



	 public function edit_course() {}

	 public function edit_course_category() {}


	// ---------- remove courses (admin) ---------- //


	// Remove a course
	public function remove_course() {
		$query = "DELETE FROM courses WHERE course_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $course_id);
	}

	// Remove Course category
	public function remove_course_category() {
	 	$quert = "DELETE FROM courses_category WHERE course_id = ?";
	 	$stmt = $this->db->prepare($query);
	}


	// Accepted params from courses forms.
	function accepted_params() {
		return array( 
	 		"course_id",
	 		"student_id",
	 		"schedule_id", 
	 		"id"
	 	);
	}
	
}

?>

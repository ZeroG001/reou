<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/reou/includes/const.php");
require_once(D_ROOT . "/reou/models/database.php");
// This is the corse class. Please do not erase it again

class Course {

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

	 	$query = "SELECT * FROM courses WHERE course_id = ?";

	 	$stmt = $this->db->prepare($query);
	 	$stmt->bindParam(1, $class_id);
	 	$stmt->execute();

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

	 public function edit_course() {}

	 public function edit_course_category() {}


	// ---------- remove courses ---------- //

	public function remove_course() {
		$query = "DELETE FROM courses WHERE course_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $course_id);
	}

	public function remove_course_category() {
	 	$quert = "DELETE FROM courses_category WHERE course_id = ?";
	 	$stmt = $this->db->prepare($query);
	}
	
}

?>

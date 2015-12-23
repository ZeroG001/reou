<?php
	require_once 'const.php';



class Course {


	// Class Dependencies
	 public $db;

	 public function __construct(PDO $db) {
	 	$this->db = $db;
	 }


	 // -------- Get Corse Information -------- //

	 public function get_all_corses() {
	 	$query

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

	 public function get_course_schedule($course_id) {

	 	$cols = array(
	 		"location",
	 		"class_date",
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

		$stmt->$this->db->prepare($query);

		$stmt->bindParam(1, $course_id);
	 }


	// ---------- edit courses ---------- //	

	 public function edit_course() {

	 }

	 public function edit_course_category() {

	 }

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

try {

	$db = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT."; dbname=".DB_NAME."", "root", "s0n!crush");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Turns on error reporting and catches the exception
	$db->exec("SET NAMES 'utf8'");
} 

catch (Exception $e) {

	echo "There was a problem connecting to the database";
	
}










	// $query = 'SELECT * FROM course_category';


	// $stmt = $db->prepare($query);
	// $stmt->execute();


	// $results_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// foreach ($results_array as $value) {
	// 	echo $value['category_name'];
	// }


?>
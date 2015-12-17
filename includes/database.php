<?php
	require_once 'const.php';



class Course {

	// Class Dependencies
	 public $db;

	 public function construct(PDO $db) {
	 	$this->db = $db;
	 }


	 public function get_all_corses() {
	 
	 }

	 public function get_course_classes($course_id) {
	
	 	$query = "SELECT * FROM courses c INNER JOIN course_category cc ON c.category_id=cc.categoty = ?";

	 	$stmt = $this->db->prepare($query);

	 	$stmt->bindParam(1, $course_id);
	 	$stmt->execute();

	 	$result_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 	foreach ($result_array as $value) {
	 		echo $value;
	 	}

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

	 	$stmt = $this->db->prepare($query)
	}

}


try {

	$db = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT."; dbname=".DB_NAME."", "root", "s0n!crush");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Turns on error reporting and catches the exception
	$db->exec("SET NAMES 'utf8'");
	
	echo "dadatanase loaded";
} 

catch (Exception $e) {

	echo "There was a problem connecting to the database";
	
}

$test = new Course($db);

$test->get_course_classes(4);









	// $query = 'SELECT * FROM course_category';


	// $stmt = $db->prepare($query);
	// $stmt->execute();


	// $results_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// foreach ($results_array as $value) {
	// 	echo $value['category_name'];
	// }


?>
<?php 

	

	function scrub_data() {

	}

	function is_arrayEmpty($arr) {
		return count($arr) == 0;
	}

	function format_date($timestamp) {
		echo date('m/d/Y', strtotime($timestamp));
	}

	function day_or_night() {
		//returns boolean value
	}

	function verify_get($id) {

		if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[$id])) {
			return $_GET[$id];
		} else {
			die("nope");
		}
	}

	function get_class_detail($course_array) {
		
		$results = array();

		foreach ($course_array[0] as $key => $value) {
			$results[$key] = $value;
		}
		return $results;

	}

?>
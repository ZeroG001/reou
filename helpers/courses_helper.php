<?php 

	


	/**
	 * numExtract()
	 *
	 * Removes all letters from a string, leaving only the numbers
	 *
	 * @param $String) The string that is to be cleaned
	 * @return (String)
	 */
	function numExtract($string) {
		if (function_exists("filter_var")) {
			$string = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
		} else {
			$string = preg_replace("[^0-9\$]","",$string);
		}

		if (empty($string)) {
			return "0";
		} else {
			return $string;
		}

	}


	/**
	 * makeArrayHtmlSafe();
	 *
	 * Takes all array elements and runs htmlEntities() on each item
	 *
	 * @param (array) The ONE DIMENTIONAL Array you need cleaned
	 * @return (array)
	 */
	function makeArrayHtmlSafe($arr) {

		foreach ($arr as $key => $item) {
			$arr[$key] = htmlentities($item);
		}

		return $arr;
	}



	
	/**
	 * is_arrayEmpty()
	 *
	 * Check if array is empty
	 *
	 * @param (Array) The Array that is to be checked
	 * @return (Void)
	 */
	function is_arrayEmpty($arr) {
		return count($arr) == 0;
	}




	/**
	 * format_date()
	 *
	 * Turns a timestamp into a human readable date mm/dd/yyyy
	 *
	 * @param (String) Unix timestamp to be converted
	 * @return (String)
	 */
	function format_date($timestamp) {
		return date('m/d/Y', strtotime($timestamp));
	}




	/**
	 * verify_get()
	 *
	 * Mainly used for Course controller. Used to verify string of 'id' is actually set
	 *
	 * @param (String) Name of the GET variable
	 * @return (String)
	 */
	function verify_get($id) {

		if ( $_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[$id]) ) {

			return $_GET[$id];
		} else {

			//Instead of dieing just return false
			return false;
			die("nope");
		}
	}


	/**
	 * makeStringHtmlSafe
	 *
	 * Function meant to be used with the array_walk_reursive function
	 * Takes each item in a multidimentional array and scrubs the items
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function makeStringHtmlSafe(&$arr, $key) {
		$myarr = htmlentities($arr);
	}

	/**
	 * course_clean_output
	 *
	 * Cleans the values of the given array so that it can safely be output to the screen; 
	 * ** Please dont.
	 * dont what?
	 * dont erase this function...
	 * ok but no.
	 *
	 * @param (Array) 
	 * @return (Array)
	 */
	function scrub_array_output($items) {

		array_walk_recursive($items, 'makeStringHtmlSafe');
		
		// // Array Dimention 1
		// foreach ($items as $key => $item) {

		// 	if( is_array($item) ) {

		// 		//Array Dimention 2
		// 		foreach ($item as $k => $v) {

		// 			if ( is_array($v) ) {

		// 				echo $k;

		// 				foreach ($v as $key => $value) {

		// 					$v[$key] = htmlentities($value);

		// 				}
		// 			} else {
						
		// 				$item[$k] = htmlentities($v);
		// 			}

		// 		}

		// 		$items[$key] = $item;
		// 	} else {
		// 		$items[$key] = htmlentities($item);
		// 	}
		// }

		// return $items;
	}




	/**
	 * decToBinArray()
	 *
	 * Converts a decimal to binary then separates each number into an array
	 * This is used to help display the weeks for the schedules
	 * Accepts comma separated string with numbers
	 * TODO - work on corder casese for function 
	 * returns array( 1,1,1,0,0,0,0 )
	 *
	 * @param (String) 
	 * @return (Array)
	 */
	function decToBinArray($num, $len = 7) {

		
		$decArray = explode(",", $num);

		foreach ($decArray as $key => $dec) {
			
			//conver decimal to binary
			$dec = decbin($dec);
			
			//Conver the devimal to an array
			$dec = str_split(str_pad($dec, $len, "0", STR_PAD_LEFT));
			
			//replace index value with that number
			$decArray[$key] = $dec;
			
		}

		return $decArray;
	}




	function getCalDayOffset($dateObj) {
	    $offset = 0;
	    if($dateObj->format("w") == 0) {
	        $offset = 0;
	    } elseif ($dateObj->format("w") > 0) {
	        $offset = $dateObj->format("w");
	    }
	    
	   return $offset;
	}



	/**
	 * decToBinArray()
	 *
	 * Used to help display the calendars on the course detail page.
	 * @param (String) dateCode - a comma-separated string of 1s and 0s (ie "1,1,0,0,1,1")
	 * @param (String) startDate - the starting date string in mm/dd/yyyy formay
	 * @return (String) the HTML to be displayed
	 */
	function createCalendarHTML($startDateStr, $endDateStr, $dateCode) {

		$startDate = new DateTime($startDateStr);
		$endDate = new DateTime($endDateStr);
		$endDate->modify('+1 day');
		$diff = $endDate->diff($startDate);
		// $dateCode = array("1","0","1","1","1","0","1","0");
		$newDaterange = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
		$diffInDays = $diff->format("%a");
		$html = "";

	    $curMonth1 = $startDate->format("F");
	    $curMonth = "";
	    $finalHtml = "";

    
    foreach($newDaterange as $k => $newDate) {

	    if( $curMonth != $newDate->format("F") ) {
	        $curMonth = $newDate->format("F");


	       	if($k > 0) {
	       		$finalHtml .= "</table>";
	       		$finalHtml .= "</div>";
	       	} 
	       	$finalHtml .= "<div class='course-detail-schedule__container'>";
			$finalHtml .= "<table class='course-detail-schedule'>";
			$finalHtml .= "<div class='schedule__title'><h3>" . $newDate->format("F") . "</h3></div>";
			$finalHtml .=" 
			<tr>
			        <th> S </th>
			        <th> M </th>
			        <th> T </th>
			        <th> W </th>
			        <th> T </th>
			        <th> F </th>
			        <th> S </th>
			    	</tr>
		            <tr>";
	         
	        $offsetCount = 0; 
		    while( $offsetCount < getCalDayOffset($newDate)) {
		        $finalHtml .= "<td> &nbsp; </td>";
		        $offsetCount++;                        
		    }
	            $offsetCount = 0;
	                
	    }
            
       	// If day is sunday start a new row on calendar table
      	if ( $newDate->format('w') == 6 ) {
	        if(isset($dateCode[$k]) && $dateCode[$k] == 1) {
	        	$finalHtml .= "<td class='course-detail-date__selected'>" . $newDate->format('d') . "</td>";
	        } 
	        else {
	            $finalHtml .= "<td>" . $newDate->format('d') . "</td>";

	        }
	        $finalHtml .= "</tr>";	
	    } 
	    else {      

	    	if(isset($dateCode[$k]) && $dateCode[$k] == 1) {
	           	$finalHtml .= "<td class='course-detail-date__selected'>" . $newDate->format('d') . "</td>";
	       		 } 
	       		 else {
	           $finalHtml .=  "<td>"  . $newDate->format('d') . "</td>";
	        }
	    }
        
        if ( $diffInDays - 1 == $k ) {
           $finalHtml .= "</table>"; 
           $finalHtml .= "</div>";
        }

   }
 		return $finalHtml;

	}

?>
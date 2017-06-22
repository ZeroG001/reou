( function() {

	// =====================================
	//			  	Variables
	// =====================================


	// =====================================
	//			  	Objects
	// =====================================


	// Diff Date Object
	var DateDiff = { 
		inDays: function(d1, d2) { 
	  	var t2 = d2.getTime(); 
	    var t1 = d1.getTime(); 
	    return parseInt((t2-t1)/(24*3600*1000)); 
	  }, 
	   
	  inWeeks: function(d1, d2) { 
	  	var t2 = d2.getTime(); 
	    var t1 = d1.getTime(); 
	    return parseInt((t2-t1)/(24*3600*1000*7)); 
	  },
	}


	// =====================================
	//			  	Functions
	// =====================================


	function serialToObj( formInputs ) {

		console.log(formInputs);

		obj = {};

		for ( i = 0; i < formInputs.length; i++ ) {

			console.log(formInputs[i]); // Log the inputs submittd for debugging
			obj[formInputs[i].name] = formInputs[i].value; // Convert searlized items to jobject

		}

		console.log("Results from serialToObj()");
		console.log(obj);

		return obj;
	}


	// Cool helper function that acts like the range function in python.
	// Hope I don't run into any problems with this.
	function _range(myNum) {
		result_array = [];
		for (i = 0; i < myNum; i++) {
			result_array.push(i);
		}
		return result_array;
	}


	// Takes String as arguement
	// Ensure that date format mm/dd/yyyy or yyyy-mm-dd is used
	function verifyDateFormat(dateString) {

	  match_found = false;

	  dateFormats = [
	    /^\d{1,2}\/\d{1,2}\/\d{4}$/i,
	    /^\d{4}\-\d{1,2}\-\d{1,2}$/i
	  ];

	  // If the Day is greater than 31 then return false;
	  splitDate = dateString.split("/");
	  if (splitDate[1] > 31) {
	    return false;
	  }

	  for (i in dateFormats) {

	    if ( dateString.match(dateFormats[i]) ) {

	        match_found = true;
	    }
	  }

	    return match_found;
	}



	//Veridy Date Order
	// Takes 2 date objects as parameters
	function verifyDateOrder( startDateObj, endDateObj ) {
	  
	  startDateTime = startDateObj.getTime();
	  endDateTime = endDateObj.getTime();

	  if ( startDateTime > endDateTime ) {
	    return false;
	  } 
	  else {
	    return true;
	  }

	}


	// Code provided from the internet (tested)
	// Checks to see if the date in mm/dd/yyyy format is an existing date
	function dateIsValid(dateString) {

	  // convert date string to string that can be parsed
	  dateString = new Date(dateString).toLocaleDateString();

	  var comp = dateString.split('/');

	  var m = parseInt(comp[0], 10);
	  var d = parseInt(comp[1], 10);
	  var y = parseInt(comp[2], 10);
	  var date = new Date(y,m-1,d);
	  if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
	      return true;
	  } else {
	      return false;
	  }

	}


	// THIS NEEDS TO BE REFACTORED. Relies too much on dom elements.
	// Do not use! Relies on form elements having certain name
	function verifyDates(startDateObj, endDateObj) {

	  startDateString = document.getElementById("schedule_start_date").value;
	  endDateString = document.getElementById("schedule_end_date").value;

	  if(!verifyDateFormat(startDateString)) {return false;}
	  if(!verifyDateFormat(endDateString)) {return false;}

	  if(!dateIsValid(startDateString)) {return false;}
	  if(!dateIsValid(endDateString)) {return false;}

	  if(!verifyDateOrder(startDateObj, endDateObj)) {return false;}



	}



	// REFACTOR THIS...relies on dom element...actually nevermind, you're good...
	// Takes the number of weeks and outputs them to a specifed htmlElement ID on the page.
	function displayWeek(numberOfWeeks, htmlElement) {

	  // Make it so that the week number is shown above each week

	  //Clear the contents of the htmlElement
		document.getElementById(htmlElement).innerHTML = "";

		weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
	  
		final_text = "";
	  
	  template = '<div class="weekday-container {{disabled?}}">';
	  template += '<label for="{{day}}"> {{label}} </label>';
	  template += '<input type="checkbox" value="1" id="{{day}}" class="dateBoxes" {{disabled?}}>';
	  template += '</div>';
	  
	  
	  for (i in weekdays) {

	    // Add attributes
	   	abbrday = weekdays[i].slice(0,3).toLowerCase();
			final_text += template.replace(/\{\{day\}\}/g, abbrday );
	    

	   	// Add Label Text
	   	final_text = final_text.replace(/\{\{label\}\}/g, weekdays[i] );

	    //make in put disabled
	    final_text = final_text.replace(/\{\{disabled\?\}\}/g, "");

		}
	  
	  // Print the number of weeks onto the page
	  for (i = 0; i < numberOfWeeks; i++) {

	  	document.getElementById(htmlElement).innerHTML += "<div class='week-wrap'> <h3> Week " + (i + 1) + "</h3>" + final_text + "</div>";
	    
	    // Stop to prevent too many weeks from being added.
	    if ( i > 10 ) {
	    	alert("too many weeks");
	    	return final_text;
	    }
	  }
	  return final_text;
	}



	// REFACTOR THIS...relies on dom element...actually nevermind, you're good...
	// Takes the number of weeks and outputs them to a specifed htmlElement ID on the page.
	// Would have it accept the binary array. Rathe than another tyoe if array
	function displayWeekFromResult(obj, htmlElement) {

	  // Make it so that the week number is shown above each week

	  //Clear the contents of the htmlElement
		document.getElementById(htmlElement).innerHTML = "";

		weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
	  
		final_text = "";

		template = '<div class="weekday-container {{disabled?}}">';
		template += '<label for="{{day}}"> {{label}} </label>';
		template += '<input type="checkbox" value="1" id="{{day}}" class="dateBoxes" {{disabled?}}>';
		template += '</div>';
	  
	  
	  for (i in weekdays) {

		    // Add attributes
		   	abbrday = weekdays[i].slice(0,3).toLowerCase();
				final_text += template.replace(/\{\{day\}\}/g, abbrday );

		   	// Add Label Text
		   	final_text = final_text.replace(/\{\{label\}\}/g, weekdays[i] );

		    //make in put disabled
		    final_text = final_text.replace(/\{\{disabled\?\}\}/g, "");

		}
		
	  
	  // Print the number of weeks onto the page
	  for (i = 0; i < arr.length; i++) {

	  	document.getElementById(htmlElement).innerHTML += "<div class='week-wrap'> <h3> Week " + (i + 1) + "</h3>" + final_text + "</div>";
	    
	    // Stop to prevent too many weeks from being added.
	    // if ( i > 10 ) {
	    // 	alert("too many weeks");
	    // 	return final_text;
	    // }
	  }

	  //return final_text; why was I returning a value
	
	}


	function calculateWeeks(startDate, endDate, dateDiff) {

		// Goal - Output the proper number of weeks based on the time period entered.
	  // Get the difference in dats
	  dayDiff = dateDiff.inDays(startDate, endDate);
	  weeks = 1;
	  dayCounter = startDate.getDay();

	  for (i = 0; i < dayDiff; i++) {
	    if(dayCounter == 6) {
	      weeks++;
	      dayCounter = 0;
	    } else {
	      dayCounter++;
	    }

	  }

	  return weeks

	}



	// Returns array instead of string
	function getCheckboxValues() {

	  checkboxClass = "dateBoxes";
	  result = [];

	  checkboxes = document.getElementsByClassName(checkboxClass);

	  for (i = 0; i < checkboxes.length; i++) {
	    if (checkboxes[i].checked) {
	      result.push(checkboxes[i].value);
	    } else {
	      result.push("0");
	    }
	  }

	  // uncomment to Return result as string
	  //result = result.join(",");

	  return result;

	}



	// Create a binary arry that will be used in dtabase.
	//returns a string that consists of numbers between 1 and 127. This represent the binary version of the week.
	function createDateBinString(arr) {

	  // If the array is not divisible by 7 then quit the program
	  if(arr.length % 7 != 0) {
	    alert("there is something wrong with the array");
	    return false;
	  }
	  result = [];
	  
	  for (i = 0; i < ( arr.length / 7 ); i++) {
	    weekStartIndex = i * 7;
	    weekEndIndex = weekStartIndex + 7
	    slicedarray = arr.slice(weekStartIndex, weekEndIndex);
	    binValue = parseInt(slicedarray.join(""), 2);
	    result.push(binValue);
	  }

	  //uncomment this to return an array instad of a string
	  //return result;

	  //Return a string instead of an array
	  return result.join(",");

	  
	}



	// Disable the weekday checkboxes depending on which day the date starts on
	function disabledays(startDateObj, endDateObj) {

	  checkboxClass = "dateBoxes";

	  checkboxes = document.getElementsByClassName(checkboxClass);

	  startDayVal = startDateObj.getDay();
	  endDayVal = endDateObj.getDay();


	  // Disabled Start Dates
	  for (i = 0; i < startDayVal; i++) {
	    checkboxes[i].disabled = true;
	  }

	  // Disabled end dates
	  endCounter = checkboxes.length - (7 - endDayVal);
	  for (i = endCounter + 1; i < checkboxes.length; i++) {
	    checkboxes[i].disabled = true;
	  }

	}




	// =====================================
	//			  	Ajax Action
	// =====================================


	var opt = {
		"url" : "jaxme.php",
		"data" : {"name" : "serialized data "}
	}



	// Get the form data
	function submitFormViaAjax() {

		$.ajax({ 

			data: {}, 
			method: "POST", 
			url: "http://10.9.63.40/reou/views/courses/jaxme.html", 
			success: function(response) {
				console.log(response);
			},
			error: function() {

			}
		});

	}
	

	// This will allow us to get schedule date using ajax. This method is currently not being used.
	function getScheduleData() {

		$.ajax({
			data: {},
			method: "POST",
			url: "http://10.9.63.40/reou/views/courses/getSchedules.php",
			success: function(response) {
				console.log(response)
			},
			error: function(response, error) {
				console.log("Type of ajax error was - " + error);
			}
		});

	}


// =====================================
//		    Parsley Validation
// =====================================


	// $('#course-create-form').parsley();


})()
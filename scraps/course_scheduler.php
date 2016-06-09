<?php
    
    # Create a one week schedule tha is 

    ## New Plan....

    ## Set a start date, set the days and for how many weeks.
    ## Repeat until finished.




        try {
            $db = new PDO("mysql:host=localhost;port=3306;dbname=reou", "root", "s0n!crush");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Turns on error reporting and catches the exception
            $db->exec("SET NAMES 'utf8'");
        } 
        catch (Exception $e) {
            die("There was a problem connecting to the database.");
        }

        // Database Connection
        $query = "SELECT * FROM users LIMIT 10";
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if(empty($_POST['startDate']) || empty($_POST['endDate']) ) { 
            die();
        }

        date_default_timezone_set("America/Detroit");

        var_dump($_POST);

        $start_date_input = $_POST['startDate'];
        $end_date_input = $_POST['endDate'];

        $startDate = DateTime::createFromFormat('m/d/Y', $start_date_input);
        $endDate = Datetime::createFromFormat("m/d/Y", $end_date_input);

        $diff = $endDate->diff($startDate);

        echo $diff->format("Difference is %d days");

        $interval = DateInterVal::createFromDateString('1 day');
        $schedule = new DatePeriod($startDate, $interval, $endDate);

        var_dump($schedule);

        $result = serialize($schedule);
        var_dump(base64_encode($result));

        # In the array you're going to need to find the time in days between the first date and the second date.

        echo "You Submitted the form";
    }


?>

<!DOCTYPE html>
<html>


<head>
	<title> Schedule Creator </title>
</head>


<body>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Recurrence Pattern -->

    <!-- Select the start and end date the dates fall on -->

    <!-- Select Days the Events fall on -->

    <!-- Select how many weeks the schedules occurs for -->

    <!-- If the weeks overlap whats given then truncate -->

    <!-- Ability to add other weeks -->

	<h1>  </h1>


	<form method="POST" action="#">


		<label for="date-pick"> Start Date </label>
		<input type="text" id="start-date" name="startDate" class="date-picker" />



        <label for="date-pick"> Start Time </label>
        <input type="text" id="start-time" name="startTime" />


        <label for="date-pick"> End Time </label>
        <input type="text" id="end-time" name="endTime" />



        <!-- 
        <label for="end-date"> End Date </label>
        <input type="text" id="end-date" name="endDate" class="date-picker" /> -->

        <!--
        <label for="date-pick"> Start Time </label>
        <input type="text" id="start-time" name="startTime" class="date-picker" />


        <label for="date-pick"> End Time </label>
        <input type="text" id="end-time" name="endTime" class="date-picker" />
        -->



        <h3> Days Availible </h3>

        <label for="recur-daily"> Monday </label>
        <input type="checkbox" id="recur-daily">


        <label for="recur-daily"> Tuesday </label>
        <input type="checkbox" id="recur-daily">


        <label for="recur-daily"> Wedensday </label>
        <input type="checkbox" id="recur-daily">


        <label for="recur-daily"> Thursday </label>
        <input type="checkbox" id="recur-daily">


        <label for="recur-daily"> Friday </label>
        <input type="checkbox" id="recur-daily">

        <label for="recur-daily"> Saturday </label>
        <input type="checkbox" id="recur-daily">


        <label for="recur-daily"> Sunday </label>
        <input type="checkbox" id="recur-daily">

        <label for="recur-weeks"> for how many weeks </label>
        <input type="text" id="recur-weeks" />



        <br />
        <input type="submit" value="Submit" />

	</form>

</body>
</html>


<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/Pikaday-master/pikaday.js"></script>
<script>

    // Loop Trhough all fields with the date Picker class
    var fields = document.getElementsByClassName("date-picker");

    for(var i = 0; i < fields.length; i++) {
        new Pikaday({ 
            field: fields[i],
            bound: true,
            format: 'MM/D/YYYY'
        });  
    }
</script>


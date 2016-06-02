<?php


?>

<!DOCTYPE html>
<html>
<head>
	<title> Schedule Creator </title>
</head>
<body>

<style>
/* You Date Picker Styles. */

.pika-single.is-hidden {
	/* display: none; */
}

.pika-button {
	background-color: #AFAFAF;
	width:45px;
	padding: 5px;
}

.pika-single.dark-theme {
    color: #fff;
    background: #333;
    border: 1px solid #666;
    border-bottom-color: #999;
}

.dark-theme .pika-label {
    background-color: #333;
}

.dark-theme .pika-prev,
.dark-theme .is-rtl .pika-next {
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAeCAQAAACGG/bgAAAAQ0lEQVR4Ae3KIQ4AIBTD0N0/IeHGI3UIRA3ut/Zl+ltXc5++htVAmIAwAWECwgSEKbgthEoIlRAqIVRCqINQB9nDgQd7ktwFo6UpWQAAAABJRU5ErkJggg==');
}

.dark-theme .pika-next,
.dark-theme .is-rtl .pika-prev {
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAeCAQAAACGG/bgAAAAP0lEQVQ4y+3TMQoAMAgEwfwfAvvjTZ1uGzuvHhBPPGczEG+FRqqRaqQaqUaqkX6QBmmjacvQ6qEVTjsh+xizebvlaWptGXZAAAAAAElFTkSuQmCC');
}

.dark-theme .pika-table th {
    color: #999;
}

.dark-theme .pika-button {
    color: #fff;
    background: #222;
}

.dark-theme .pika-week {
    color: #999;
}

.dark-theme .is-today .pika-button {
    color: #33aaff;
}

.dark-theme .is-selected .pika-button {
    color: #fff;
    background: #33aaff;
    box-shadow: inset 0 1px 3px #178fe5;
}

.dark-theme .is-disabled .pika-button {
    color: #999;
    opacity: .3;
}

.dark-theme .pika-button:hover {
    color: #fff !important;
    background: #ff8000 !important;
}

</style>


	


	<h1> Course Scheduler </h1>


	<form>
		<label for="date-pick"> Pick a Date </label>
		<input type="text" id="date-pick">
	</form>

</body>
</html>


<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/Pikaday-master/pikaday.js"></script>
<script>
    var picker = new Pikaday({ 
    	field: document.getElementById('date-pick'),
    	bound: true,
    	format: 'MM/D/YYYY'
    });
</script>


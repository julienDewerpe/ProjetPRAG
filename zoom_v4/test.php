<?php
include 'Calendar.php';

$hostname="localhost";
$username="root";
$password="";
$databaseName="prag";

$connect=mysqli_connect($hostname,$username,$password,$databaseName);

$query="SELECT * from reunion";

$result=mysqli_query($connect,$query);
$calendar = new Calendar();


if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {

				$titre=$row['sujet'];
				$date=$row['date'];
				$output = substr($date, 0, 10);
				$var = $output;
				$date = str_replace('/', '-', $var);
				$newDate= date('Y-m-d', strtotime($date));
				$calendar->add_event($titre,$newDate, 1, 'red');

		}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Calendrier</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Calendrier des rencontres</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>
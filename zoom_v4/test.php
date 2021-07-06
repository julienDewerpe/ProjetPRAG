<!DOCTYPE html>
<html lang="fr" style="background-image: url('images/fondcouleur.jpg'); background-position: center;
background-repeat: no-repeat;
background-size: cover; height: 90%;">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Mon calendrier</title>
	
	<?php 
	include("includes/font.html");
	include("includes/bootstrap.html");
	?>
</head>
<?php 
include("includes/navbar.html")
?>

<br>

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
	    		<h2>Calendrier des rencontres</h2>
	    	</div>
	    </nav>
		<div class="content home" style="width:90%;">
			<?=$calendar?>
		</div>
	</body>
</html>
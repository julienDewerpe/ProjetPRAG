<?php
	include_once 'Zoom_Api.php';

	$hostname="localhost";
	$username="root";
	$password="";
	$databaseName="prag";
	
	
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query = "SELECT * FROM reunion";
	
	$result=mysqli_query($connect,$query);
	
	/*$zoom_meeting = new Zoom_Api();
	try {
		$res4 = $zoom_meeting->sendRequest2();   
		echo "<pre>";
		print_r ($res4);
		echo "</pre>";
		foreach($res4['meetings'] as $test) {
    echo $test['topic'], '<br>';
}
	}
	catch (Exception $ex) {
    echo $ex;
}*/

if ($result->num_rows > 0) {
  // output data of each row
  echo "<table border='1'>";
  echo "<tr><td>sujet</td><td>difficulté</td><td>date</td><td>description</td><td>lien</td></td>\n";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['sujet']}</td><td>{$row['difficulte']}</td><td>{$row['date']}</td><td>{$row['description']}</td><td><a href='{$row['lien']}'>{$row['lien']}</a></td></tr>\n";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>
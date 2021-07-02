<?php 
 
include_once 'Zoom_Api.php';

$zoom_meeting = new Zoom_Api();

$originalDate = $_POST['date'];
//original date is in format YYYY-mm-dd
$timestamp = strtotime($originalDate); 
$newDate = date("Y-m-d h:i:s", $timestamp );

$data = array();
$data['topic'] = $_POST['topic'];
//$data['start_date'] = date("Y-m-d h:i:s", strtotime('tomorrow'));
$data['start_date'] = $newDate;
$data['duration'] 	= $_POST['duree'];;
$data['type'] 		= 2;
$data['password'] 	= $_POST['mdp'];


try {
	$response = $zoom_meeting->createMeeting($data);
	
	//echo "<pre>";
	//print_r($response);
	//echo "<pre>";
	
	echo "Meeting ID: ". $response->id;
	echo "<br>";
	echo "Topic: "	. $response->topic;
	echo "<br>";
	echo "Join URL: ". $response->join_url ."<a href='". $response->join_url ."'>Open URL</a>";
	echo "<br>";
	echo "Meeting Password: ". $response->password;
    
	
} catch (Exception $ex) {
    echo $ex;
}


?>
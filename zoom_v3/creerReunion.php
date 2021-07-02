<?php 
 
if(isset($_POST["insert"]))
{
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
	
	/*echo "<pre>";
	print_r($response);
	echo "<pre>";
		
	echo "Meeting ID: ". $response->id;
	echo "<br>";
	echo "Topic: "	. $response->topic;
	echo "<br>";
	echo "Join URL: ". $response->join_url ."<a href='". $response->join_url ."'>Open URL</a>";
	echo "<br>";
	echo "Meeting Password: ". $response->password;*/
    
	
} catch (Exception $ex) {
    echo $ex;
}
	
	$hostname="localhost";
	$username="root";
	$password="";
	$databaseName="prag";
	
	$topic=$_POST['topic'];
	$date=$_POST['date'];
	$duree=$_POST['duree'];
	$story=$_POST['story'];
	$mdp=$_POST['mdp'];
	$difficulte=$_POST['diff'];

	
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query = "INSERT INTO `reunion`(`id_zoom`, `sujet`, `difficulte`, `date`, `duree`, `description`, `mdp`, `lien`) VALUES ('$response->id','$topic','$difficulte','$date','$duree','$story','$mdp','$response->join_url')";
	
	$result=mysqli_query($connect,$query);
	
	if ($result)
	{
		echo 'Réunion crée : '. $response->join_url;
	}
	else{
		echo 'echec';
	}
}
 
echo "<form action='creerReunion.php' method='post'>
 <p>Sujet : <input type='text' name='topic' required/></p>
 <p>Date : <input type='datetime-local' name='date' required/></p>
 <p>Durée : <input type='number' name='duree' min='30' max='120' step='15' required/></p>
 <p>Description : <textarea id='story' name='story' rows='5' cols='33' ></textarea></p>
 <p>Difficulté : 	
	<select name='diff' id='diff-select'>
    <option value='debutant'>Débutant</option>
    <option value='intermédiare'>Intermédiaire</option>
    <option value='expert'>Expert</option>
	</select>
</p>
 <p>Mot de passe : <input type='text' name='mdp' /></p>


 <p><input type='submit' name='insert' value='OK'></p>
</form>";




?>
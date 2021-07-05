<?php 
include('database_connection.php');

if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
}


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
	$theme=$_POST['theme'];
	$niveau=$_POST['niv'];
	$date=$_POST['date'];
	$duree=$_POST['duree'];
	$story=$_POST['story'];
	$mdp=$_POST['mdp'];
	$difficulte=$_POST['diff'];

	
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query = "INSERT INTO `reunion`(`id_zoom`, `sujet`,`theme`,`niveau`, `difficulte`, `date`, `duree`, `description`, `mdp`, `lien`) VALUES ('$response->id','$topic','$theme','$niveau','$difficulte','$date','$duree','$story','$mdp','$response->join_url')";
	
	$req = $connect->query("SHOW TABLE STATUS FROM prag LIKE 'reunion' ");
	$donnees = $req->fetch_assoc();
	$id_session=$_SESSION['user_id'];
	$id_reunion=$donnees['Auto_increment'];
	$query2 = "INSERT INTO `creation`(`register_user_id`, `reunion_id`) VALUES ($id_session,$id_reunion)";
	
	$create=mysqli_query($connect,$query2);
	
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
 <p>Thème : <input type='text' name='theme' required/></p>
 <p>Sujet : <input type='text' name='topic' required/></p>
 <p>Niveau d'étude :
 	<select name='niv' id='niv-select'>
    <option value='Post-BAC'>PostBAC</option>
    <option value='Bac+2+3'>Bac+2+3</option>
    <option value='Bac+4+5'>Bac+4+5</option>
	<option value='Autre'>Autre</option>
	</select>
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
</form>
<form action='choix.php' method='post'>
	<input type='submit' value='accueil'>
</form>

";




?>
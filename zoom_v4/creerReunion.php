<!DOCTYPE html>
<html lang="fr" style="background-image: url('images/fondcouleur.jpg'); background-position: center;
background-repeat: no-repeat;
background-size: cover; height: 90%;">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/creerReunion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

	<title>Créer une réunion</title>
    <link rel="icon" href="./favicon.png" />
</head>


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
	$difficulte=$_POST['diff'];

	
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query = "INSERT INTO `reunion`(`id_zoom`, `sujet`,`theme`,`niveau`, `difficulte`, `date`, `duree`, `description`, `lien`) VALUES ('$response->id','$topic','$theme','$niveau','$difficulte','$date','$duree','$story','$response->join_url')";
	
	$req = $connect->query("SHOW TABLE STATUS FROM prag LIKE 'reunion' ");
	$donnees = $req->fetch_assoc();
	$id_session=$_SESSION['user_id'];
	$id_reunion=$donnees['Auto_increment'];
	$query2 = "INSERT INTO `creation`(`register_user_id`, `reunion_id`) VALUES ($id_session,$id_reunion)";
	
	$create=mysqli_query($connect,$query2);
	
	$result=mysqli_query($connect,$query);
	
	if ($result)
	{
		$msg_creation=  $response->join_url;
	}
	else{
		echo 'Echec';
	}
}
 
echo "<body style='background-color: transparent;'>

<nav class='navbar navbar-expand-lg' style='background-color: #E5E5E5;'>
	<a class='navbar-brand' href='choix.php' style='margin-left: 10px;'>
		<img src='images/txtlogo.png' class='d-inline-block align-top' style='width: 120px;'>
	  </a>

	<div class='collapse navbar-collapse' id='navbarSupportedContent'>
	<ul class='navbar-nav mr-auto'>
		<li class='nav-item active'>
			<input class='form-control' type='search' placeholder='Rechercher' aria-label='Search' style='width: 1000px;'>
		</li>
	</ul>
	</div>
	<form class='form-inline'>
	
		<a href='./choix.php'><button class='btn btn-dark' type='submit' style='background-color: #755FF0; color:white; font-weight: bold; border: none;'><img src='images/calendrier.svg' style='width: 30px;'></button></a>
		<button class='btn btn-dark' type='submit' style='background-color: #755FF0; color:white; font-weight: bold; border: none;'><img src='images/profil.png' style='width: 27px;'></button>
		<button class='btn btn-dark' type='submit' style='background-color: #755FF0; color:white; font-weight: bold; border: none; margin-right: 5px;'><img src='images/deco.svg' style='width: 33px;'></button>
	</form>
</nav>
<br>



<form id='formulaire' action='creerReunion.php' method='post'>
	<div id='baniere'>
		<h2>Créer une rencontre </h2>
		<input type='submit' name='insert' value='Créer la rencontre' class='btn btn-warning'>
	</div>
	<div id='formu'>
		<div id='corps' class='card'>
			<label for='topic'>Thème</label>
			<input type='text' name='theme' placeholder='Thème de la rencontre' required/>
			<label for='topic'>Titre</label>
			<input type='text' name='topic' placeholder='Titre de la rencontre' required/>
			
			<div class='elements'>
				<div class='child'>
					<label for='date'>Date</label>
					<input type='datetime-local' name='date' required />    
				</div>
				<div class='child'>
					<label for='diff'>Difficulté</label>                    	
					<select name='diff' id='diff-select' required>
						<option value='' disabled selected>Choix de la difficulté</option>
						<option value='debutant'>Débutant</option>
						<option value='intermédiare'>Intermédiaire</option>
						<option value='expert'>Expert</option>
					</select>
				</div>
			</div>

			<div class='elements'>
				<div class='child'>
					<label for='duree'>Durée</label>
					<input placeholder='Durée en minutes' type='number' name='duree' min='30' max='120' step='15' required/>
				</div>
				
				<div class='child'>
					<label for='niveau'>Niveau d'étude</label>
					<select name='niv' id='niv-select' required>
						<option value='' disabled selected>Choix du niveau</option>
						<option value='Post_BAC'>Post BAC</option>
						<option value='BAC+2/+3'>BAC+2/+3</option>
						<option value='BAC+4/+5'>BAC+4/+5</option>
						<option value='Autres'>Autres</option>
					</select>
				</div>
				

			</div>
			<label for='story'>Description</label>
			<textarea id='story' name='story' placeholder='Résumez en quelques lignes le but de la rencontre'></textarea>  
		
		
		</div>
		<div id='image'>
			<img src='images/imgrencontre.png'>
		</div>
	</div>";
		if(isset($_POST["insert"])){
			echo "<p id='message_lien'>Reunion créée : <a href='$msg_creation' >$msg_creation </a></p>";
			}		

echo "</form>
</body>
</html>";
?>
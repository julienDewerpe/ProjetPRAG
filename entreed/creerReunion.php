<!--
... PARTIE HTML ... 
-->

<!DOCTYPE html>
<html lang="fr" style="background-image: url('images/fondcouleur.jpg'); background-position: center;
background-repeat: no-repeat;
background-size: cover; height: 90%;">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/creerReunion.css">

	<title>Créer une rencontre</title>

	<?php 
	include("includes/font.html");
	include("includes/bootstrap.html");
	?>
</head>
<?php 
include("includes/navbar.html")
?>


<?php 
//==============================================
// Page de création de réunions - creerReunion.php
//==============================================


/*
* On vérifie si l'utilisateur est déjà connecté, si non alors il est renvoyé
* au login.php où il pourra s'inscrire ou se connecté
*/

include('database_connection.php');

if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
}

/*
* Si l'utilisateur clique sur "Créer la rencontre", on ajoute les champs suivant dans notre table reunion: 
* thème,titre,date,durée,description,difficulte,niveau d'étude,lien zoom et l'id_zoom
*/
if(isset($_POST["insert"]))
{
	include_once 'Zoom_Api.php';

$zoom_meeting = new Zoom_Api();

$originalDate = $_POST['date'];
$timestamp = strtotime($originalDate); 
$newDate = date("Y-m-d h:i:s", $timestamp );

$data = array();
$data['topic'] = $_POST['topic'];
$data['start_date'] = $newDate;
$data['duration'] 	= $_POST['duree'];;
$data['type'] 		= 2;


try {
	$response = $zoom_meeting->createMeeting($data);
    
	
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

/*
* On associe également grâce à la table creation : l'id de l'utilisateur et l'id de la réunion
*/	
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
};
 
?>
<br>

<!--
... PARTIE HTML ... + AFFICHAGE DU LIEN DE LA REUNION LORS DE LA CREATION
-->

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
	</div>
		<?php if(isset($_POST["insert"])){
			echo "<p id='message_lien'>Reunion créée : <a href='$msg_creation' >$msg_creation </a></p>";
			};	
		?>
</form>
</body>
</html>

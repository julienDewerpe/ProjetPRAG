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


	<link rel="stylesheet" href="css/accueilCSS.css">
	<title>Mes rencontres</title>
	
	<?php 
	include("includes/font.html");
	include("includes/bootstrap.html");
	?>
</head>
<?php 
include("includes/navbar.html")
?>

		

	<div id="page">
		<div id="banniere">
			<?php 
			
//==============================================
// Page d'accueil - choix.php
//==============================================

				include('database_connection.php');

/*
* On vérifie si l'utilisateur est déjà connecté, si non alors il est renvoyé
* au login.php où il pourra s'inscrire ou se connecté
*/				

				if(!isset($_SESSION["user_id"]))
				{
					header("location:login.php");
				}
				$id_session=$_SESSION['user_id'];
				
/*
* On récupère alors le role de l'utilisateur connecté  :
* si il n'en a toujours pas, il est renvoyé a la page de choix de role page_premiere_co.php
*/

				$role = array ();	
				$query = "
					SELECT role FROM register_user 
						WHERE register_user_id = :user_id
					";
					$statement = $connect->prepare($query);
					$statement->execute(
						array(
								'user_id'	=>	$_SESSION["user_id"]
							)
					);
					$count = $statement->rowCount();
					if($count > 0)
					{
						$result = $statement->fetchAll();
						foreach($result as $row)
						{
							$role['role']= $row['role'];
						}
					}
				if ($role['role'] == null)
				{
					header("location:page_premiere_co.php");
				}
				
/*
* Si il est Entre'Edien, on récupère les réunions auxquelles il n'est pas inscrit, avec l'id de la session
*/
				if ($role['role'] == 'entreedien')
				{
					echo"
					<h1>Toutes les rencontres</h1>";
					$query="SELECT * FROM reunion r where r.id not in (select reunion_id from inscription where register_user_id=$id_session)";

/*
* Alors si il veut voir les réunions auxquelles il est inscrit, on change la requête
*/
					if(isset($_POST["show_insc"]))
					{
											
					echo "<form name='form1' action='choix.php' method='post'>
					<input type='submit' name='retour' class='btn btn-warning' value='Retour aux rencontres'>
					</form>";
					$query = "SELECT * FROM reunion r  INNER JOIN inscription i ON r.id=i.reunion_id and i.register_user_id=$id_session";
						if (isset($_POST["retour"])){
								header("location:choix.php");
						}
					}
					else {
											
					echo "<form name='form1' action='' method='post'>
					<input type='submit' name='show_insc' class='btn btn-warning' value='Mes inscriptions'>
					</form>";
					}
				}
				
/*
* Enfin, si il est Entre'Edeur, on récupère les réunions qu'il a créées
*/
				if ($role['role'] == 'entreedeur')
				{
					echo"
					<h1>Mes rencontres</h1>
					<form name='form1' action='' method='post'>
					<input type='submit' name='creer' class='btn btn-warning' value='Creer'>
					</form>";
					$query = "SELECT * FROM reunion r  INNER JOIN creation c ON r.id=c.reunion_id and c.register_user_id=$id_session";
					if(isset($_POST["creer"]))
					{
						header('Location:creerReunion.php');
					}
				}
				?>
			</form>
		</div>
		
		<div id="cartes">	
			<?php
			
//=================================================================================
// Récupération et affichage des données de réunions - base de données phpmyadmin
//=================================================================================
				$hostname="localhost";
				$username="root";
				$password="";
				$databaseName="prag";
				
				$connect=mysqli_connect($hostname,$username,$password,$databaseName);

				
				$result=mysqli_query($connect,$query);
				

				if ($result->num_rows > 0) {
				// output data of each row

				while($row = $result->fetch_assoc()) {
					echo "
					<div class='card'>
						<div class='card-body'>
							<div class='element1'>
								<img src='images/rencontre.jpg' alt='rencontre'>
							</div>
							<div class='element2'>
								<h4>{$row['theme']}</h4>
								<h5 class='card-title'>{$row['sujet']}</h5>
								<div class='groupement'>
									<p>{$row['difficulte']}</p>
									<p>{$row['date']}</p>
									<p>{$row['niveau']}</p>
								</div>";
								$reunion_id=$row['id'];
								$resulta=mysqli_query($connect,"SELECT count(*) as total from inscription where reunion_id= $reunion_id");
								$data=mysqli_fetch_assoc($resulta);
								$cpt= $data['total'];
								echo "<p>$cpt</p>
								<a href='{$row['lien']}'>{$row['lien']}</a>
								<p>{$row['description']}</p>
							</div>
							";
							if ($role['role'] == 'entreedeur'):
							echo "<form class='element3' method='post' action='delete.php?id={$row['id']}'>
								<input id='supp' type='submit' class='btn btn-warning' value='supprimer'>
							</form>";
							
							endif;
							if ($role['role'] == 'entreedien' && !isset($_POST["show_insc"])):
						
										echo "<form class='element3' method='post' action='inscription.php?id={$row['id']}'>
											<input type='submit' class='btn btn-warning' value='inscription'>
										</form>";
							endif;
							if (($role['role'] == 'entreedien') && (isset($_POST["show_insc"]))):
										echo "<form class='element3' method='post' action='desinscription.php?id={$row['id']}'>
											<input type='submit' class='btn btn-warning' value='se désinscrire'>
										</form>";
							endif;
							
						echo"</div>
						
					</div>";
				}
					echo "</table>";
				} else {
					echo "0 results";
				}
			?>
		</div>
	</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/accueilCSS.css">

	<title>Mes rencontres</title>
	
	<link rel="icon" href="images/favicon.png">
</head>
<body id="body">
	 <header>

		<nav class="navbar navbar-expand-lg" style="background-color: #E5E5E5;">
				<a class="navbar-brand" href="#" style="margin-left: 10px;">
					<a href='choix.php'><img src="images/txtlogo.png" class="d-inline-block align-top" alt="" style="width: 120px;"></a>
				</a>
		
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<input onclick="" class="form-control" type="search" placeholder="Rechercher" aria-label="Search" style="width: 1000px;">
					</li>

				</ul>
				</div>
				<form class="form-inline">
					<button class="btn btn-dark" type="submit" style="background-color: #755FF0; color:white; font-weight: bold; border: none;"><img src="images/calendrier.svg" style="width: 30px;"></button>
					<button class="btn btn-dark" type="submit" style="background-color: #755FF0; color:white; font-weight: bold; border: none;"><img src="images/profil.png" style="width: 27px;"></button>
					<button class="btn btn-dark" type="submit" style="background-color: #755FF0; color:white; font-weight: bold; border: none; margin-right: 5px;" ><img src="images/deco.svg" style="width: 33px;"></button>
				</form>
		</nav>
	 </header>
		

	<div id="page">
		<div id="banniere">
			<?php 
				include('database_connection.php');

				

				if(!isset($_SESSION["user_id"]))
				{
					header("location:login.php");
				}
				$id_session=$_SESSION['user_id'];

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
				if ($role['role'] == 'candidat')
				{
					echo"
					<h1>Toutes les rencontres</h1>";
					$query="SELECT * FROM reunion r where r.id not in (select reunion_id from inscription where register_user_id=$id_session)";

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
				if ($role['role'] == 'intervenant')
				{
					echo"
					<h1>Mes rencontres</h1>
					<form name='form1' action='' method='post'>
					<input type='submit' name='submit1' class='btn btn-warning' value='Creer'>
					</form>";
					$query = "SELECT * FROM reunion r  INNER JOIN creation c ON r.id=c.reunion_id and c.register_user_id=$id_session";
					if(isset($_POST["submit1"]))
					{
						header('Location:creerReunion.php');
					}
					if(isset($_POST["submit2"])) {
						header('Location:listeReunion.php');
					}
					if(isset($_POST["submit3"])) {
						header('Location:supprimerReunion.php');
					}
				}
				?>
			</form>
		</div>
		
		<div id="cartes">	
			<?php
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
								<h5>Catégorie</h5>
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
							if ($role['role'] == 'intervenant'):
							echo "<form class='element3' method='post' action='delete.php?id={$row['id']}'>
								<input id='supp' type='submit' class='btn btn-warning' value='supprimer'>
							</form>";
							
							endif;
							if ($role['role'] == 'candidat' && !isset($_POST["show_insc"])):
						
										echo "<form class='element3' method='post' action='inscription.php?id={$row['id']}'>
											<input type='submit' class='btn btn-warning' value='inscription'>
										</form>";
							endif;
							if (($role['role'] == 'candidat') && (isset($_POST["show_insc"]))):
										echo "<form class='element3' method='post' action='inscription.php?id={$row['id']}'>
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
<?php

//==============================================
// Page de connexion - login.php
//==============================================

/*
* On vérifie si l'utilisateur est déjà connecté, si oui alors il est renvoyé
* au menu choix.php où il pourra s'inscrire ou créer une réunion
*/
include('database_connection.php');

if(isset($_SESSION['user_id']))
{
	header("location:choix.php");
}

/*
* On récupérera le message pour l'afficher à l'utilisateur si la connexion s'est bien établie ou pas
*/
$message = '';

/*
* Si l'utilisateur clique sur le bouton Connexion, on vérifie :
* si l'utilisateur a son mail vérifié (pour l'instant oui pour tous, fonctionnalité à développé),
* si le mail et le mdp sont correctements saisis,
* et enfin si le mail est présent dans notre base de données
*/
if(isset($_POST["login"]))
{
	$query = "
	SELECT * FROM register_user 
		WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_email'	=>	$_POST["user_email"]
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_email_status'] == 'verified')
			{
				if(password_verify($_POST["user_password"], $row["user_password"]))
				//if($row["user_password"] == $_POST["user_password"])
				{
					$_SESSION['user_id'] = $row['register_user_id'];
					header("location:choix.php");
				}
				else
				{
					$message = "<label>Mot de passe erronée</label>";
				}
			}
			else
			{
				$message = "<label class='text-danger'>Veuillez confirmer votre adresse mail, merci.</label>";
			}
		}
	}
	else
	{
		$message = "<label class='text-danger'>Adresse mail inexistante</label>";
	}
}

?>

<!--
... PARTIE HTML ... + AFFICHAGE DU MESSAGE EN PHP
-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="CSS/connexionCSS.css">
    
    <title>Connexion</title>
</head>
<body id="body">

  <header>
  <img src="images/logo.png" alt="logo">
    <div id="nav">
      <ul id="menu">
        <a href=""><li>A propos</li></a>
        <a href=""><li>Contact</li></a>
        <a href="register.php"><li>S'inscrire</li></a>
      </ul>
    </div>
  </header>

<div id="page">
  <form  id="formulaire" method="POST">
      <p id="inscription">Tu n'as toujours pas de compte ?! <a href="register.php"> Inscris-toi !</a></p>
      <div class="entree">
        <input type="email" name="user_email" id="email" autofocus required placeholder="E-Mail"/>
        <input type="password" name="user_password" id="mdp" required placeholder="Mot de Passe"/>
      </div>
      <p id="oubli"><a href=""> Mot de passe oublié ?</a></p>
      <div id="button">
        <input type="submit" name="login" value="Connexion">
	  		<?php echo '<span style="font-weight: bold;font-size:15px;font-style:italic;text-align:center;width:100%;margin-top:30px;display:block">'. $message . '</span>'; ?>
      </div>
    </form>

    <img src="./images/Cours.png" alt="ca ne marche pas cette merde !">

</div>

  <footer id="footer">
  </footer>

</body>
</html>
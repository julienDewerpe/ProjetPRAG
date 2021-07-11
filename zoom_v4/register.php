<?php

//==============================================
// Page d'inscription - register.php
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
* si l'utilisateur a saisi un mail déjà utilisé,
* puis on crypte son mdp et on l'ajoute à notre BD
*/

if(isset($_POST["register"]))
{
	$query = "
	SELECT * FROM register_user 
	WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_email'	=>	$_POST['user_email']
		)
	);
	$no_of_row = $statement->rowCount();
	if($no_of_row > 0)
	{
		$message = 'Cet email est déjà utilisé !';
	}
	else
	{
		$message = 'Compte créer';
		$user_password = $_POST['user_password'];
		$user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
		$user_activation_code = md5(rand());
		$insert_query = "
		INSERT INTO register_user 
		(user_name, user_email, user_password, user_activation_code, user_email_status) 
		VALUES (:user_name, :user_email, :user_password, :user_activation_code, :user_email_status)
		";
		$statement = $connect->prepare($insert_query);
		$statement->execute(
			array(
				':user_name'			=>	$_POST['user_name'],
				':user_email'			=>	$_POST['user_email'],
				':user_password'		=>	$user_encrypted_password,
				':user_activation_code'	=>	$user_activation_code,
				':user_email_status'	=>	'verified'
			)
		);
		$result = $statement->fetchAll();
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
        <a href="login.php"><li>Se connecter</li></a>
      </ul>
    </div>
  </header>

<div id="page">
  <form  id="formulaire" method="POST">
      <p id="inscription">Tu as déjà un compte ?! <a href="login.php"> Connectes-toi !</a></p>
      <div class="entree">
		<input type="text" name="user_name" class="form-control" pattern="[a-zA-Z ]+" autofocus placeholder="Username"required />
		<input type="email" name="user_email" class="form-control" placeholder="E-mail" required />
		<input type="password" name="user_password" class="form-control" placeholder="Mot de passe" required />

      </div>
      <div id="button">
        <input type="submit" name="register" id="register" value="Inscription">

      </div>
	  		<?php echo '<span style="font-weight: bold;font-size:15px;font-style:italic;text-align:center;width:100%;margin-top:30px;display:block">'. $message . '</span>'; ?>

    </form>

    <img src="./images/Cours.png" alt="ca ne marche pas cette merde !">

</div>

  <footer id="footer">
  </footer>

</body>
</html>

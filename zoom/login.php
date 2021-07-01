<?php
//login.php

include('database_connection.php');

if(isset($_SESSION['user_id']))
{
	header("location:choix.php");
}

$message = '';

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

<!--<!DOCTYPE html>
<html>
	<head>
		<title>PHP Register Login Script with Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container" style="width:100%; max-width:600px">
			<h2 align="center">PHP Register Login Script with Email Verification</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Login</h4></div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>User Email</label>
							<input type="email" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="login" value="Login" class="btn btn-info" />
						</div>
					</form>
					<p align="right"><a href="register.php">Register</a></p>
				</div>
			</div>
		</div>
	</body>
</html>-->
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
      <p id="oubli"><a href=""> Mot de passe oubié ?</a></p>
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
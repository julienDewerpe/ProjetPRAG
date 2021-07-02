<?php

include('database_connection.php');

if(isset($_SESSION['user_id']))
{
	header("location:index.php");
}

$message = '';

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
		$message = 'Email envoyé';
		$user_password = rand(100000,999999);
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
				':user_email_status'	=>	'not verified'
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
try {
				require 'class/class.phpmailer.php';
				require 'class/class.smtp.php';
				
			$base_url = "http://localhost:1234/zoom/";  //change this baseurl value as per your file path
			$mail_body = "
			<p>Hi ".$_POST['user_name'].",</p>
			<p>Thanks for Registration. Your password is ".$user_password.", This password will work only after your email verification.</p>
			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$user_activation_code."
			<p>Best Regards,<br />Webslesson</p>
			";
	$mail = new PHPMailer(true);

    $mail->IsSMTP();
    $mail->Host = 'smtp.mailtrap.io'; // host
    $mail->SMTPAuth = true;
    $mail->Username = '3dd9ed3f23f101'; //username
    $mail->Password = '1ab21e5a6e2bf5'; //password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25; //smtp port
    
    $mail->setFrom('jon@gmail.com', 'entreed');
    $mail->addAddress($_POST['user_email'], $_POST['user_name']);
  
    $mail->IsHTML(true);
    $mail->Subject = 'Email Subject';
    $mail->Body    = $mail_body;
  
    $mail->send();
	
	echo $mail;
//ici, la suite du code utile
} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
}

		}
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
				<div class="panel-heading"><h4>Register</h4></div>
				<div class="panel-body">
					<form method="post" id="register_form">
						<?php echo $message; ?>
						<div class="form-group">
							<label>User Name</label>
							<input type="text" name="user_name" class="form-control" pattern="[a-zA-Z ]+" required />
						</div>
						<div class="form-group">
							<label>User Email</label>
							<input type="email" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="register" id="register" value="Register" class="btn btn-info" />
						</div>
					</form>
					<p align="right"><a href="login.php">Login</a></p>
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

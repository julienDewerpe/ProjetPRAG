<!DOCTYPE html>
<html lang="fr" style="background-image: url('images/fondcouleur.jpg'); background-position: center;
background-repeat: no-repeat;
background-size: cover; height: 90%;">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link rel="stylesheet" href="css/paiement.css">
	<title>Bienvenue sur Entre'ed</title>
	
	<?php 
	include("includes/font.html");
	include("includes/bootstrap.html");
	?>
</head>



<h2 class="text-center text-warning">Bienvenue sur <img src="images/txtlogo.png" alt="" style="width:200px;"></h2> 
<p> Pour quelle raison souhaitez-vous nous rejoindre ?</p>

<div class="text-center">
<form action="" method="post">
    <div style="diplay:flex;">
<button type ="button" class=" btn-secondary btn-outline-warning"><input type="submit" name="role" value="Entre'edeur" required/></button>
<button type ="button" class="btn-secondary btn-outline-warning"><input type="submit" name="role" value="Entre'edien"  /></button><br><br>
</div>
    
</form>
</div>
<?php

if (isset($_POST["role"])){
	if ($_POST["role"] == "Entre'edeur") {  
		echo '
	
		<body style="background-color:transparent;">
		<div class="card mt-50 mb-50 text-white" style="background-color:#755FF0;">
    <div class="nav">
        <ul class="mx-auto">
            <li><a href="#">Compte</a></li>
            <li class="active"><a href="#">Paiement</a></li>
        </ul>
    </div>
    <form> <span id="card-header">Cartes sauvegardées:</span>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 3193"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Retirer carte</a> </div>
        </div>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 4296"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Retirer carte</a> </div>
        </div> <span id="card-header">Add new card:</span>
        <div class="row-1">
            <div class="row row-2"> <span id="card-inner">Nom du propriétaire de la carte</span> </div>
            <div class="row row-2"> <input type="text" placeholder="Bojan Viner"> </div>
        </div>
        <div class="row three">
            <div class="col-7">
                <div class="row-1">
                    <div class="row row-2"> <span id="card-inner">Numéro de carte</span> </div>
                    <div class="row row-2"> <input type="text" placeholder="5134-5264-4"> </div>
                </div>
            </div>
            <div class="col-2"> <input type="text" placeholder="Date expiration"> </div>
            <div class="col-2"> <input type="text" placeholder="CVV"> </div>
        </div> <button class="btn d-flex mx-auto text-white bg-dark" style="width:100px;"<><b>Ajouter carte</b></button>
    </form>
</div>';      
	}
	else {
		echo "Voici le formulaire d'intervenant :";
	}      
}    
?>
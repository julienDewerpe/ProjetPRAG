<!DOCTYPE html>
<html 
    lang="fr" style="background-image: url('images/fondcouleur.jpg'); background-position: center;
    background-repeat: no-repeat;
    background-size: cover; height: 90%;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="css/paiement.css">
        <title>Bienvenue sur Entre'ed</title>
        <link rel="stylesheet" href="css/creerReunion.css">
        
        <?php 
        include("includes/font.html");
        include("includes/bootstrap.html");
        ?>
    </head>
	

    <body style="background-color:transparent;">
    <body>

        <h2 class="text-center text-warning" id="titre">Bienvenue sur <a href="page_premiere_co.php"><img src="images/txtlogo.png" alt="" style="width:200px;"></a></h2> 
       <?php if (!isset($_POST["role"])) : ?>

		<p class="text-center text-dark"> Pour quelle raison souhaitez-vous nous rejoindre ?</p>
        
        <div class="text-center">
            <form id="jsp" action="" method="post">
                <div>
                    <input type="submit" class=" btn btn-warning" name="role" value="Entre'edeur" required/>
                </div>
                <div>
                    <input type="submit" class="btn btn-warning" name="role" value="Entre'edien"  />
                </div>
            </form>
        </div>
<?php endif; ?>

    <?php 

        if (isset($_POST["role"])){
            if ($_POST["role"] == "Entre'edien") {
                echo '		
                <div class="card mt-50 mb-50 text-white" style="background-color:#755FF0;">
                    <div class="nav">
                        <ul class="mx-auto">
                            <li><a href="#">Compte</a></li>
                            <li class="active"><a href="#">Paiement</a></li>
                        </ul>
                    </div>
                    <form id="formulaire2" action="modif_role.php?role=entreedien" method="post"> 
					<span id="card-header">Cartes sauvegardées:</span>
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
                echo 
                '
                <form id="formulaire" action="modif_role.php?role=entreedeur" method="post">
                    
                    <div id="formu">
                        <div id="corps" class="card">
                            <div id="baniere">
                                <h2>Créer un profil </h2>
                                <input type="submit" name="insert" value="Créer mon profil" class="btn btn-warning">
                            </div>
                            <label for="topic">Université d\'origine</label>
                            <input type="text" name="universite" required/>
                            <label for="topic">Dernier diplôme obtenu</label>
                            <input type="text" name="diplome"required/>
                            <label for="topic">Situation professionnelle actuelle</label>
                            <input type="text" name="situation"required/>
                            <label for="topic">Niveau d\'études</label>
                            <input type="text" name="niveau"required/>
                            
                            <label for="story">Vos compétences</label>
                            <textarea id="story" name="story" placeholder="Résumez en quelques lignes vos compétences téchniques"></textarea>  
                        
                        
                        </div>
                        <div id="image">
                            <img src="images/imgintervenant.png">
                        </div>
                    </div>
                </form>
                ';
            }      
        }    
        ?>

    </body>

</html>

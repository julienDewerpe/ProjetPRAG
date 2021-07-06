<p>Choisissez un rôle :</p>

<form action="" method="post">
  Entre'Edeur <input type="radio" name="role" value="entreedeur" required/><br />
  Entre'Edien <input type="radio" name="role" value="entreedien"  /><br />
<input type="submit" value="submit" />
</form>
<?php

if (isset($_POST["role"])){
	if ($_POST["role"] == "entreedeur") {  
		echo '
		
		<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/paiement.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		</head>
		<body>
		<div class="card mt-50 mb-50">
    <div class="card-title mx-auto"> Settings </div>
    <div class="nav">
        <ul class="mx-auto">
            <li><a href="#">Account</a></li>
            <li class="active"><a href="#">Payment</a></li>
        </ul>
    </div>
    <form> <span id="card-header">Saved cards:</span>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 3193"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Remove card</a> </div>
        </div>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 4296"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Remove card</a> </div>
        </div> <span id="card-header">Add new card:</span>
        <div class="row-1">
            <div class="row row-2"> <span id="card-inner">Card holder name</span> </div>
            <div class="row row-2"> <input type="text" placeholder="Bojan Viner"> </div>
        </div>
        <div class="row three">
            <div class="col-7">
                <div class="row-1">
                    <div class="row row-2"> <span id="card-inner">Card number</span> </div>
                    <div class="row row-2"> <input type="text" placeholder="5134-5264-4"> </div>
                </div>
            </div>
            <div class="col-2"> <input type="text" placeholder="Exp. date"> </div>
            <div class="col-2"> <input type="text" placeholder="CVV"> </div>
        </div> <button class="btn d-flex mx-auto"><b>Add card</b></button>
    </form>
</div>';      
	}
	else {
		echo "Voici le formulaire d'intervenant :";
	}      
}    
?>
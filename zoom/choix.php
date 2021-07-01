<?php 

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
echo "<form name='form1' action='' method='post'>
<input type='submit' name='submit1' value='Creer'>
<input type='submit' name='submit2' value='Rejoindre'>
<input type='submit' name='submit3' value='Supprimer'>

</form>";
?>

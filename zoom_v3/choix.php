<?php 
include('database_connection.php');

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
if ($role['role'] == 'test')
{
	echo "bienvenu";
}
if ($role['role'] == 'intervenant')
{
	echo"
	<input type='submit' name='submit1' value='Creer'>
	<input type='submit' name='submit3' value='Supprimer'>";
}
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
/*echo "<form name='form1' action='' method='post'>
<input type='submit' name='submit1' value='Creer'>
<input type='submit' name='submit2' value='Rejoindre'>
<input type='submit' name='submit3' value='Supprimer'>

</form>";*/
?>

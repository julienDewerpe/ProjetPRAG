<?php
//=================================================================================
// Page index - index.php
//=================================================================================
include('database_connection.php');

if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
}

?>

<?php
include ('logout.php');
?>


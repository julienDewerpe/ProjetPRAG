<?php
//=================================================================================
// Inscription à une réunion, ajout dans la BD puis redirection - inscription.php
//=================================================================================

include('database_connection.php');

$hostname="localhost";
$username="root";
$password="";
$databaseName="prag";
$sess=$_SESSION['user_id'];
$id = $_GET['id']; // get id through query string
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query="INSERT INTO `inscription`(`register_user_id`, `reunion_id`) VALUES ($sess,$id)";
$del = mysqli_query($connect,$query); // delete query

if($del)
{
    mysqli_close($connect); // Close connection
    header("location:choix.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error inserting record"; // display error message if not delete
}
?>
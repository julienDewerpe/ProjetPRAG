<?php

$hostname="localhost";
$username="root";
$password="";
$databaseName="prag";

$id = $_GET['id']; // get id through query string
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query="delete from reunion where id = '$id'";
$del = mysqli_query($connect,$query); // delete query

if($del)
{
    mysqli_close($connect); // Close connection
    header("location:supprimerReunion.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
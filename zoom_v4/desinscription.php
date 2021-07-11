<?php
include('database_connection.php');

$hostname="localhost";
$username="root";
$password="";
$databaseName="prag";
$sess=$_SESSION['user_id'];
$id = $_GET['id']; // get id through query string
	$connect=mysqli_connect($hostname,$username,$password,$databaseName);
	$query="DELETE FROM `inscription` WHERE reunion_id=$id and register_user_id=$sess";
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
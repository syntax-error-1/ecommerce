<?php 
session_start();
include "../../connection.php";

if(!isset($_SESSION["admin"])){
	header('location: ../login');
}

$id = $_GET["id"];

$sql = "DELETE FROM customer WHERE id='$id'";


if (mysqli_query($connection, $sql)) {
 echo '<script>alert("User Deleted!");window.location.href = "./";</script>';

} else {
	  
   echo '<script>alert("This user cannot be deleted because this user already have placed orders, Delete the orders first to delete this user.");window.location.href = "./";</script>';
 
}
 
?>
 
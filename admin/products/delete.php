<?php 
session_start();
include "../../connection.php";

if(!isset($_SESSION["admin"])){
	header('location: ../login');
}

$id = $_GET["id"];

$sql = "DELETE FROM products WHERE product_id='$id'";


if (mysqli_query($connection, $sql)) {
 echo '<script>alert("Product Deleted!");window.location.href = "./";</script>';

} else {
	  
   echo '<script>alert("Error occured!");window.location.href = "./";</script>';
 
}
 
?>
 
<?php 
session_start();
include "connection.php";

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

if (isset($_POST['addtocartbutton'])) {
    $id = $_GET['product_id'];
    $quantity = $_POST['quantity'];
 
    $customer_id = $_SESSION['id'];
    $query = "INSERT INTO cart(customer_id , product_id, quantity ) ";
    $query .= "VALUES ( '$customer_id' , '$id' ,'$quantity') ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Query failed : " . mysqli_error($connection));
    }
    header("Location: usercart.php");
}
?>


<?php 
session_start();
include "connection.php";

if (isset($_GET['customerid'])) {
    $customer_id = $_GET['customerid'];}
$query = "SELECT * FROM cart WHERE customer_id = $customer_id ";
$select_userproducts_query = mysqli_query($connection, $query);
// $serialnumberdepictor = 1;
while ($row = mysqli_fetch_array($select_userproducts_query)) {
  $product = $row["product_id"];
  $name = $row["customer_id"];
  $quantity = $row["quantity"];
  $id  = $row['id'];
  $currentdate = date('d-m-y') ;
  $query = "SELECT * from products WHERE product_id = $product ";
  $get_product_name = mysqli_query($connection, $query); //
  while ($row = mysqli_fetch_array($get_product_name)) {
    $productname = $row['name'];
    $price = $row['price'];
  }
  $grosstotal = $quantity * $price;

//   $totalprice = $totalprice + $grosstotal;
$addtoorderquery = "INSERT INTO orders (customer_id , product_id, quantity, date, price ) ";
$addtoorderquery .= "VALUES ('$customer_id', '$product', '$quantity', '$currentdate' , '$grosstotal') ";
$add_query = mysqli_query($connection, $addtoorderquery);

if (!$add_query) {
	die (mysqli_error($connection));
}
	header("Location:index.php");
}

$delqueryfromcarts = "DELETE FROM cart WHERE customer_id = '{$customer_id}' ";
$delquery = mysqli_query($connection, $delqueryfromcarts);
header("Location:order_success.php");
?>
    <!-- when buy order succesful , decrement stock of that product by one  -->
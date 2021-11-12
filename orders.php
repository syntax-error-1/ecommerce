<?php 
session_start();
include "connection.php";
?>


<?php
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

?>
<?php
$username = $_SESSION['name'];
$customer_id = $_SESSION['id'];
$totalprice = 0;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>My Orders</title>
  
</head>

<body>
  <?php
  if (isset($_SESSION['email'])) {
    include "navigationwhenuserloggedin.php";
  } else {
    include "navigationwhenusernotloggedin.php";
  }
  ?>
  <div class="container  ">
    <center><h2>My Orders</h2></center><br>
     <table class="table">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Date</th>
 
    </tr>
  </thead>
  <tbody>
<?php 
 
 
$query = "SELECT id,customer_id,product_id,quantity,date FROM orders WHERE customer_id = '$customer_id'  LIMIT 25 ";
 
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  $count = 0;
  while($row = mysqli_fetch_assoc($result)) {
   $customer_id = $row["customer_id"];
   $product_id = $row["product_id"];
 
   $pquery = "SELECT name FROM products WHERE product_id= '$product_id'";
   $productName =  mysqli_fetch_assoc(mysqli_query($connection, $pquery))["name"];
   echo '<tr>
      <th scope="row">'.$row["id"].'</th>
 
      <td title="'.$productName.'">'.substr($productName,0,20).'</td>
      <td>'.$row["quantity"].'</td>
      <td>'.$row["date"].'</td>
 
    </tr>';
  }
}
 
?>
  </tbody>
</table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
       window.onbeforeunload = function() { return "Your work will be lost."; };

</script>
</html>
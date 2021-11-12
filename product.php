<?php 
session_start();
include "connection.php";
?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <?php
  if (isset($_SESSION['email'])) {
    
    include "navigationwhenuserloggedin.php";
  } else {
    include "navigationwhenusernotloggedin.php";
  }
  ?>
  <?php
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "SELECT * from products WHERE product_id = '{$product_id}'";
    $select_product_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_product_query)) {
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      $stock = $row['stock'];
      $image = $row['image'];
  ?> 
  <title><?php echo $name ; ?></title>
</head>

<body>
<div class="container">
        <div class="row">
          <div class="col mx-3">
            <img src="images/<?php echo $image; ?>" alt="Card image cap" height="400px" width="400px" class="mt-3">
          </div>
          <div class="col  mx-3 py-3">
            <h2 class="text-center mb-4"><?php echo $name; ?></h2>
            <h3>$ <?php echo $price; ?></h3>
            <small><?php echo $stock; ?> left in stock</small>
            <p class="my-3"><?php echo $description; ?> </p>
            <form method="post" action="addtocart.php?product_id=<?php echo $product_id; ?>">
              <div class="row">
                <div class="col-md-3">
                  <input type="number" value="1" class="form-control border border-warning  border-2" id="inputZip" placeholder="quantity" name="quantity" required>
                </div>
                <div class="col-md-9">
                  <button type="submit" class="btn btn-warning btn-block" name="addtocartbutton"> Add to cart</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  <?php }
  } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</body>

</html>
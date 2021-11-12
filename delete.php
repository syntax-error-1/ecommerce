<?php
include "connection.php";

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $query = "DELETE FROM cart WHERE id = {$id} ";
    $delete_cartitem_query = mysqli_query($connection, $query);
    if (!$delete_cartitem_query) {
        die("something failed " . mysqli_error($connection));
    }
    header("Location: usercart.php");
}
?>



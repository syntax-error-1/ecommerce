<?php 
session_start();
include "connection.php";

if (isset($_POST['loginbtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userexists = false;
    $query = "SELECT * FROM customer WHERE email = '$email' AND password = '$password' ";
    $check_user_query = mysqli_query($connection, $query);
    if (mysqli_num_rows($check_user_query) > 0) {
        $userexists = true;
        while ($row = mysqli_fetch_array($check_user_query)) {
            $db_id = $row['id'];
            $db_name = $row['name'];
            $db_surname = $row['surname'];
            $db_email = $row['email'];
            $db_password = $row['password'];
            $db_contact_info = $row['contact_info'];
            $db_address = $row['address'];
        }
    }
    if ($userexists) {
        $_SESSION['id'] = $db_id;
        $_SESSION['name'] = $db_name;
        $_SESSION['surname'] = $db_surname;
        $_SESSION['email'] = $db_email;
        $_SESSION['password'] = $db_password;
        $_SESSION['contact_info'] = $db_contact_info;
        $_SESSION['address'] = $db_address;
        header("Location: index.php");
        echo '<div class="alert alert-success">Login Success!</div>';
    } else {
        echo '<div class="alert alert-danger">Invalid Credentials!</div>';
    }
}
?>
<?php
if (isset($_SESSION['email'])) {
    echo $_SESSION['name'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login - Admin Panel</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <br><br><br><br><br><br><br><br>
                <!-- <?php if ($LoginFail) {
                            echo '<div class="alert alert-danger">Invalid Credentials.</div>';
                        } ?>   -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header"><b>User Login</b></div>
                    <div class="card-body">

                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input required type="email" class="form-control" name="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light" id="inputGroup-sizing-default">Password</span>
                                <input required type="password" class="form-control" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <input type="submit" class="btn btn-success" name="loginbtn" value="Login">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>
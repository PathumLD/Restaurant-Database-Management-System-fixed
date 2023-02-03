<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="./css/style1.css">
    <title>registration</title>
</head>

<body>
<?php
require('db.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['email'])) {
    $name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
    $address = filter_var($_REQUEST['address'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_REQUEST['phone'], FILTER_SANITIZE_STRING);

    $stmt = $con->prepare("INSERT INTO `customer` (name, password, email, address, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $password, $email, $address, $phone);
    $result = $stmt->execute();

    if ($result) {
        echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
    }
} else {
?>



    <div class="container" id="container">
        <div class="">
            <form action="" name="registration" method="post">
                <h1 style="padding-bottom: 20px">Create Account</h1>
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <textarea rows="3" col="30" name="address" placeholder="Address" required /></textarea>
                <input type="text" name="phone" placeholder="Phone Number" required />
                <input type="password" name="password" placeholder="Password" required />
                <p style="font-weight:bold">Want to login? <a href='login.php' style="color:#FF0000">Login here</a></p>
                <span><button>Sign Up</button></span>
            </form>
        </div>
    </div>

    <div class="landing">
        <!---background-->
        <div class="opac">
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="index.html">Foodilite</a>
        </p>
    </footer>
    <?php } ?>
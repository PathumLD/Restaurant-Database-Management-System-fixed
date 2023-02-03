<?php
require('db.php');
session_start();

if (isset($_POST['username'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $stmt = mysqli_prepare($con, "SELECT * FROM `admin` WHERE username=? and password=?");
    mysqli_stmt_bind_param($stmt, "ss", $username, md5($password));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        $_SESSION['username'] = $username;
        header("Location: control.php");
    } else {
        echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
    }
    mysqli_stmt_close($stmt);
} else {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="admin">
<input type="text" name="username" placeholder="username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
<br /><br />
</div>
</body>
</html>
<?php } mysqli_close($con); ?>

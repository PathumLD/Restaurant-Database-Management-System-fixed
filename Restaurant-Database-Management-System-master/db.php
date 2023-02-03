<?php
$con = mysqli_connect("localhost","root","","food");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$stmt = mysqli_prepare($con, "INSERT INTO users (username, password) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

mysqli_close($con);
?>

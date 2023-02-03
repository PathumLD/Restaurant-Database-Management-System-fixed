<?php
 
require('db.php');
include("adminauth.php");

session_start();

$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $submittedby = $_SESSION["username"];

    $query = "INSERT INTO customer (name, email, password, address, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, password_hash($password, PASSWORD_DEFAULT), $address, $phone);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $status = "New Record Inserted Successfully.</br></br><a href='adview.php'>View Inserted Record</a>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Insert New Record</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <p><a href="control.php">Dashboard</a> | <a href="adview.php">View Records</a> | <a href="logout.php">Logout</a>
        </p>

        <div>
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <textarea rows="3" col="30" name="address" placeholder="Address" required /></textarea>
                <input type="text" name="phone" placeholder="Phone Number" required />
                <input type="password" name="password" placeholder="Password" required />
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            <p style="color:#FF0000;"><?php echo $status; ?></p>

            <br /><br /><br /><br />
            <a
                href="https://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/">Tutorial
                Link</a> <br /><br />
            For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/">AllPHPTricks.com</a>
        </div>
    </div>
</body>

</html>
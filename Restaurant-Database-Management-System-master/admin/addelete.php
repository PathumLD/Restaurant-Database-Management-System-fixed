<?php
require('db.php');
$cust_id = mysqli_real_escape_string($con, $_REQUEST['cust_id'] ?? '');
$query = "DELETE FROM customer WHERE cust_id='$cust_id'"; 
$result = mysqli_query($con, $query);
if (!$result) {
    echo "Query error: " . mysqli_error($con);
    exit;
}
header("Location: adview.php"); 
?>

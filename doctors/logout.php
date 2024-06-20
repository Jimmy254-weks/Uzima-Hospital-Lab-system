<?php
session_start();
include('../includes/db_connect.php');
$_SESSION['dlogin'] = ""; // Use assignment operator to clear session
date_default_timezone_set('Africa/Nairobi'); // Set timezone to Nairobi
$ldate = date('d-m-Y h:i:s A', time());
$did = $_SESSION['id'];
mysqli_query($conn, "UPDATE doctorslog SET logout = '$ldate' WHERE uid = '$did' ORDER BY id DESC LIMIT 1");
session_unset();
//session_destroy();
$_SESSION['errmsg'] = "You have successfully logged out";
?>
<script language="javascript">
document.location = "../index.php";
</script>

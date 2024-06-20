<?php
session_start(); // Start the PHP session.

include('db_connect.php');

$_SESSION['login'] = ""; // Set the session variable 'login' to an empty string, effectively logging the user out.

date_default_timezone_set('Africa/Nairobi');

$ldate = date('d-m-Y h:i:s A', time()); // Get the current date and time in the format 'day-month-year hour:minute:second AM/PM' using the date() function and store it in the variable $ldate.

// Update the 'logout' field in the 'userlog' table of the database.
// Set the 'logout' field to the current date and time ($ldate) for the row where the 'uid' matches the value stored in $_SESSION['id'].
// The ORDER BY id DESC LIMIT 1 ensures that only the most recent entry for the current user is updated.
mysqli_query($conn, "UPDATE userlog SET logout = '$ldate' WHERE uid = '" . $_SESSION['id'] . "' ORDER BY id DESC LIMIT 1");

session_unset(); // Unset all session variables, effectively logging the user out and clearing any stored session data.

$_SESSION['errmsg'] = "You have successfully logged out";

header("Location: ../index.php"); 

exit();
?>

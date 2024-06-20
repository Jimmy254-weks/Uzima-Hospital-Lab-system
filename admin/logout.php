<?php
// Start a new session
session_start();

// Set the value of 'login' session variable to an empty string
$_SESSION['login'] == "";

// Unset/clears all session variables
session_unset();

// Destroy the session
session_destroy();
?>

<script language="javascript">
// Redirect the user to the homepage using JavaScript
document.location="../index.php";
</script>


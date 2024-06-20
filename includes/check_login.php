<?php 
// Define a function named check_login
// This function checks if the user is logged in. If not, it redirects them to the login page.
function check_login()
{
    // Start the session
    session_start();

    // Check if the 'id' session variable is set
    if(!isset($_SESSION['id']) || empty($_SESSION['id']))
    {   
        // If the 'id' session variable is not set or empty, redirect the user to the login page
        
        // Construct the URL to the login page
        $login_page = "user-login.php";
        
        // Redirect the user to the login page
        header("Location: $login_page");
        exit; // Terminate script execution after redirection
    }
}
?> 

<?php
session_start(); // Initialize session

// Include database connection parameters
include_once("db_connect.php");

// Check if form is submitted and the "change" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {
    // Check if session variables for contact number and email are set
    if (isset($_SESSION['contactno']) && isset($_SESSION['email'])) {
        // Retrieve contact number and email from session
        $contactno = $_SESSION['contactno']; 
        $email = $_SESSION['email']; 

        // Validate new password
        if ($_POST['password'] === $_POST['confirm_password']) { // Check if the new password matches the confirmation password
            $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the new password for security

            // Prepare the SQL statement
            $stmt = $conn->prepare("UPDATE doctors SET password=? WHERE contactno=? AND email=?");
            
            // Bind the parameters
            $stmt->bind_param("sss", $newpassword, $contactno, $email);

            // Execute the statement
            if ($stmt->execute()) {
                // Password updated successfully, redirect to login page
                $_SESSION['successmsg'] = "Password updated successfully. You can now login with your new password.";
                $stmt->close(); // Close the statement before redirecting
                header("Location: index.php");
                exit; // Ensure no further code execution after redirect
            } else {
                // Error updating password, display error message
                $_SESSION['errmsg'] = "Error updating password. Please try again.";
                $stmt->close(); // Close the statement before redirecting
                header("Location: reset-password.php");
                exit; // Ensure no further code execution after redirect
            }
        } else {
            // Passwords do not match, display error message
            $_SESSION['errmsg'] = "Passwords do not match. Please try again.";
            header("Location: reset-password.php");
            exit; // Ensure no further code execution after redirect
        }
    } else {
        // Session variables not set, redirect to login page
        header("Location: index.php");
        exit; // Ensure no further code execution after redirect
    }
}

// Close database connection outside of conditionals to ensure it's always closed
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php
    // Display success message if set
    if (isset($_SESSION['successmsg'])) {
        echo '<div class="success">' . $_SESSION['successmsg'] . '</div>';
        unset($_SESSION['successmsg']); // Clear success message
    }
    
    // Display error message if set
    if (isset($_SESSION['errmsg'])) {
        echo '<div class="error">' . $_SESSION['errmsg'] . '</div>';
        unset($_SESSION['errmsg']); // Clear error message
    }
    ?>
    <!-- Password Reset Form -->
    <form method="POST" onsubmit="return valid();">
    <h2>UHL | Reset Password</h2>
        <label>New Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your new password" required><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required><br>
        <input type="submit" name="change" value="Change Password"><br>
    </form>
    <!-- Include JavaScript file for form validation -->
    <script src="script.js"></script>
    <script>
        function valid() {
            // JavaScript validation to ensure new password is not empty and matches confirm password
            var newPassword = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (newPassword == "" || confirmPassword == "") {
                alert("Please enter a new password and confirm it.");
                return false;
            } else if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

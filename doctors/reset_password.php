<?php
session_start(); // Initialize session

// Include database connection parameters
include_once("db_connect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {
    // Check if session variables are set
    if (isset($_SESSION['contactno']) && isset($_SESSION['email'])) {
        $contactno = $_SESSION['contactno']; // Retrieve contact number from session
        $email = $_SESSION['email']; // Retrieve email from session

        // Validate new password
        if ($_POST['password'] === $_POST['confirm_password']) {
            $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the new password using default method

            // Update password in the database
            $query = "UPDATE doctors SET password='$newpassword' WHERE contactno='$contactno' AND email='$email'";
            $result = $conn->query($query);

            if ($result) {
                // Password updated successfully, redirect to login page
                $_SESSION['successmsg'] = "Password updated successfully. You can now login with your new password.";
                header("Location: index.php");
                exit;
            } else {
                // Error updating password, display error message
                $_SESSION['errmsg'] = "Error updating password. Please try again.";
                header("Location: reset-password.php");
                exit;
            }
        } else {
            // Passwords do not match, display error message
            $_SESSION['errmsg'] = "Passwords do not match. Please try again.";
            header("Location: reset-password.php");
            exit;
        }
    } else {
        // Session variables not set, redirect to login page
        header("Location: index.php");
        exit;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Reset Password</h2>
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
    <form method="POST" onSubmit="return valid();">
        <label>New Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your new password" required><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required><br>
        <input type="submit" name="change" value="Change Password"><br>
    </form>
    <script src="script.js"></script>
</body>
</html>

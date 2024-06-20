<?php
// Include database connection parameters
include_once("db_connect.php");

// Check if session variable is set
session_start();
error_reporting(0);
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $newPassword = $_POST["newPassword"]; // Retrieve new password from form

    // Validate new password
    if (!empty($newPassword)) {
        // Encrypt the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $_SESSION['reset_email']);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Password successfully updated.');</script>";
            // Redirect to login page
            header("Location: patient_login.php");
            exit;
        } else {
            echo "<script>alert('Error updating password.');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // New password is empty
        echo "<script>alert('Please enter a new password.');</script>";
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet"  href="styles.css">
    <script>
        function valid() {
            // JavaScript validation to ensure new password is not empty and matches confirm password
            var newPassword = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
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
</head>
<body>
    
    <form method="POST">

    <h2>UHL | Reset Password</h2>

        <label>New Password:</label>
        <input type="password" id="newPassword" name="newPassword" placeholder="Enter your new password" required><br>
      
        <label>Confirm New Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" required><br>

        <input type="submit" value="Reset Password">
        <p>Remembered your password? <a href="patient_login.php">Log in</a></p>
    </form>

</body>
</html>

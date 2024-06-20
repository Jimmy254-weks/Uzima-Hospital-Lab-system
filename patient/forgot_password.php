<?php
// Include database connection parameters
include_once("db_connect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"]; // Retrieve full name from form
    $email = $_POST["email"]; // Retrieve email from form

    // Validate email and full name
    if (!empty($email) && !empty($fullName)) {
        // Prepare SQL statement to check if user exists
        $sql = "SELECT * FROM users WHERE email = ? AND fullName = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $fullName); // Bind parameters
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, redirect to password reset page
            session_start();
            $_SESSION['reset_email'] = $email;
            header("Location: reset_password.php");
            exit;
        } else {
            // User not found
            echo "<script>alert('No user found with the provided information.');</script>";
        }
    } else {
        // Email or full name is empty
        echo "<script>alert('Please enter your full name and email.');</script>";
    }
    $stmt->close(); // Close statement
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <form method="POST">

    <h2>UHL | Forgot Password</h2>
    <p>Please enter your full name and password to recover your password.</p>

        <label>Full Name:</label>
        <input type="text" name="fullName" placeholder="Enter your full name" required><br>
      
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required><br>

        <input type="submit" value="Reset Password">
        <p>Remembered your password? <a href="patient_login.php">Log in</a></p>
    </form>

</body>
</html>

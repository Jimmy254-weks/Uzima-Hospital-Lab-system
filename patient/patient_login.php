<?php
session_start(); // Start or resume a session
error_reporting(E_ALL);
include_once("db_connect.php"); // Include the file that establishes the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST
    $email = $_POST["email"]; // Get the value of the "email" input field from the form
    $password = $_POST["password"]; // Get the value of the "password" input field from the form

    if (!empty($email) && !empty($password)) { // Check if both email and password are not empty
        // Used prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); // Prepare a SQL statement with a placeholder for the email
        $stmt->bind_param("s", $email); // Bind the value of the email variable to the prepared statement parameter
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result(); // Get the result set from the executed statement

        if ($result->num_rows > 0) { // Check if there is at least one row in the result set
            $row = $result->fetch_assoc(); // Fetch a row from the result set as an associative array. Each element's key is a column name, and its value is the data in that column for the current row.
            if (password_verify($password, $row['password'])) { // Verify if the hashed password matches the provided password
                $_SESSION['id'] = $row['id']; // Set the session variable 'id' with the user ID upon successful login
                header("Location: dashboard.php");
                exit; // Exit the script to prevent further execution
            } else {
                echo "<script>alert('Incorrect email or password.');</script>"; // Display an alert message for incorrect email or password
            }
        } else {
            echo "<script>alert('User not found.');</script>"; // Display an alert message for user not found
        }
    } else {
        echo "<script>alert('Please enter email and password.');</script>"; // Display an alert message for missing email or password
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <form method="POST">
        <h2>UHL | Patient Login</h2>
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required><br>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required><br>
        <p><a href="forgot_password.php">Forgot Password?</a></p>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="patient_reg.php">Create an account</a></p>
    </form>
</body>
</html>

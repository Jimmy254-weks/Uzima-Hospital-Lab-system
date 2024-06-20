<?php
error_reporting(E_ALL);
// Include database connection parameters
include_once("db_connect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"]; // Retrieve full name from form
    $address = $_POST["address"];
    $city = $_POST["city"]; 
    $gender = $_POST["gender"]; 
    $email = $_POST["email"]; 
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

 
    if ($password !== $confirmPassword) { // Check if password and confirm password match
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (strlen($password) < 6) { // Check if password length is less than 6 characters
        echo "<script>alert('Password must be at least 6 characters long.');</script>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists in the database using prepared statement
        $emailCheckSql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($emailCheckSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) { // If email already exists
            echo "<script>alert('Email already in use.');</script>";
        } else {
            // Insert data into users table with hashed password using prepared statement
            $sql = "INSERT INTO users (fullName, address, city, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $fullName, $address, $city, $gender, $email, $hashedPassword);
            if ($stmt->execute()) { // If query executed successfully
                // Redirect to login page
                header("Location: patient_login.php");
                exit; // Ensure no further code is executed
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error; // Display error message if query fails
            }
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet"  href="styles.css">
</head>
<body>
   
    <form method="POST">

    <h2>UHL | Patient Registration</h2>

        <label>Full Name:</label>
        <input type="text" name="fullName" placeholder="Enter your full name" required>

        <label>Address:</label>
        <input type="text" name="address" placeholder="Enter your address" required>

        <label>City:</label>
        <input type="text" name="city" placeholder="Enter your city" required>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required checked> Male
        <input type="radio" name="gender" value="Female" required> Female<br>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <label>Confirm Password:</label>
        <input type="password" name="confirmPassword" placeholder="Confirm your password" required>

        <input type="submit" value="Submit">
        <p>Already have an account? <a href="patient_login.php">Log in</a></p>
    </form>
</body>
</html>

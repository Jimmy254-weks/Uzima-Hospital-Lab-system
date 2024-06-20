<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

if(isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $upassword = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $uname, $upassword);

    // Execute the statement
    $stmt->execute();

    // Bind the result to a variable
    $stmt->bind_result($id);

    // Fetch the result
    $stmt->fetch();

    if($id) {
        $_SESSION['login'] = $uname;
        $_SESSION['id'] = $id;
        header("location:dashboard.php");
        exit(); // Ensure no further code execution after redirect
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UHL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: white;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
        }
        .login-form {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px DarkGray;
            width: 400px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 80%;
            padding: 10px;
            border: 1px solid LightSlateGray;
            border-radius: 5px;
        }
        .btn {
            background-color: DodgerBlue;
            color: White;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: DeepSkyBlue;
        }
        a {
            color: DarkBlue;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Admin Login</h2>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" name="submit">Login</button>
                </div>
                <div>
                    <a href="../index.php">Back to Home Page</a>
                </div>
            </form>
            <div class="error-message">
                <?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?>
            </div>
        </div>
    </div>
</body>
</html>

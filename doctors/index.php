<?php
session_start();
include("db_connect.php");
error_reporting(0); // surpress all the errors, to avoid them being displayed
if(isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];  // No need to hash here

    $stmt = mysqli_prepare($conn, "SELECT id, password FROM doctors WHERE docEmail=?");
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if(password_verify($password, $hashed_password)) {
        $_SESSION['dlogin'] = $uname;
        $_SESSION['id'] = $id;
        $uid = $id;
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        // Code Logs
        $log = mysqli_query($conn, "INSERT INTO doctorslog(uid, username, userip, status) VALUES ('$uid', '$uname', '$uip', '$status')");
        header("location:dashboard.php");
    } else {
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        mysqli_query($conn, "INSERT INTO doctorslog(username, userip, status) VALUES ('$uname', '$uip', '$status')");
        $_SESSION['errmsg'] = "Invalid username or password";
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login">
    <div class="row">
        <div class="main-login">
                <form class="form-login" method="post">
                    <h2> UHL | Doctor Login</h2>
                    <p>Please enter your username and password to log in.<br />
                        <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
                    </p>
                   
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <a href="forgot-password.php">Forgot Password?</a><br>
                    
                        <button type="submit" class="btn primary" name="submit" style="background-color: seagreen; width:80px; padding: 5px; border-radius: 5px;">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

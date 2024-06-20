<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

if(strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
    date_default_timezone_set('Africa/Nairobi');
    $currentTime = date('d-m-Y h:i:s A', time());

    if (isset($_POST['submit'])) {
        $cpass = $_POST['cpass'];
        $uname = $_SESSION['login'];

        // Prepare the SELECT statement
        $stmt = $conn->prepare("SELECT password FROM admin WHERE username=?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row && $cpass == $row['password']) {
                $npass = $_POST['npass'];

                // Prepare the UPDATE statement
                $stmt = $conn->prepare("UPDATE admin SET password=?, updationDate=? WHERE username=?");
                $stmt->bind_param("sss", $npass, $currentTime, $uname);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $_SESSION['msg1'] = "Password Changed Successfully !!";
                } else {
                    $_SESSION['msg1'] = "Failed to change password";
                }
            } else {
                $_SESSION['msg1'] = "Old Password does not match !!";
            }
        } else {
            $_SESSION['msg1'] = "User not found";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UHL</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="styles.css">


    <script type="text/javascript">
function valid() {  //Declares a function  valid()

    // Checks if the value of the current password field (cpass) in the form named chngpwd is empty.
    if(document.chngpwd.cpass.value=="") {

        // Display an alert message if the current password field is empty
        alert("Current Password field is Empty !!");

        // Set focus back to the current password field. Focus Ensures that the user's attention is directed to the field where there's an issue. This can be helpful especially if the form is long and the user might have scrolled away from the field.
        document.chngpwd.cpass.focus();
        
        // Return false to stop form submission
        return false;
    }
    // checks if the value of the new password field (npass) in the form named chngpwd is empty.
    else if(document.chngpwd.npass.value=="") {

        // Display an alert message if the new password field is empty
        alert("New Password field is Empty !!");

        // Set focus back to the new password field
        document.chngpwd.npass.focus();

        // Return false to stop form submission
        return false;
    }

    // Check if the confirm password field is empty
    else if(document.chngpwd.cfpass.value=="") {

        // Display an alert message if the confirm password field is empty
        alert("Confirm Password field is Empty !!");

        // Set focus back to the confirm password field
        document.chngpwd.cfpass.focus();

        // Return false to stop form submission
        return false;
    }
    // Check if the new password and confirm password fields match
    else if(document.chngpwd.npass.value != document.chngpwd.cfpass.value) {

        // Display an alert message if the passwords do not match
        alert("Password and Confirm Password Field do not match  !!");

        // Set focus back to the confirm password field
        document.chngpwd.cfpass.focus();

        // Return false to stop form submission, indicating that the form submission should be stopped because the validation failed.
        return false;
    }

    //If none of the above conditions are met, it returns true, indicating that the form submission should proceed as the validation passed.
    return true;
}
</script>


</head>
  
    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            background-color: gray;
            padding: 40px;
            margin-bottom: 0;
        }

        .dropdown_1 {
            position: absolute;
            right: 80px;
        }

        .dropdown-content_1 a {
            color: black;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
            font-size: 15px;
            border-bottom: 1px solid black;
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }

        .dropbtn_1 {
            background-color: white;
            border-radius: 10px;
            cursor: pointer;
            color: black;
            padding: 10px;
            font-size: 17px; 
            font-weight: bold;
        }
        /* Styling of the headers content in the dashboard ends */

        /* Adjusting footer padding */
        footer {
            background-color: gray;
            padding: 15px; /* Remove padding */
            text-align: center;
            color: black;
        }
        p {
            font-size: 17px;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        
        .main-nav ul {
            display: flex;
            list-style-type: none;
            padding: 0;
        }

        .main-nav ul li {
            margin-right: 20px;
        }

        .dropdown-container {
            position: relative;
        }

        .dropdown-button a {
            cursor: pointer;
            font-weight: bold;
            margin-right: 20px;
            color: black;
        }

        li a {
            color: blue;
            text-decoration: none;
        }

        .dropdown-button {
            margin-right: 30px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Styles for dropdown content */
        .dropdown-content {
            visibility: hidden; /* Initially hidden */
            position: absolute;
            min-width: 160px;
            box-shadow: 0 8px 16px 0;
            z-index: 1;
            background-color: white;
            top: 100%; /* Position below the dropdown button */
            left: 0; /* Align with the left edge of the dropdown button */
            display: none;
        }

        /* Show dropdown content on hover */
        .dropdown-container:hover .dropdown-content {
            visibility: visible; /* Display when parent is hovered */
            display: block;
        }

        /* Dropdown container */
        .dropdown-container {
            display: inline-block; /* Align elements horizontally */
            position: relative; /* Ensure dropdown content is positioned relative to the container */
        }
        .dropdown-content_1 {
        display: none; /* Initially hidden */
        position: absolute;
        background-color: white !important;
        min-width: 160px;
        z-index: 1;
        right: calc(100% - 120px); /* Position to the left  */
        margin-right: 10px; /* Add margin for spacing between content and edge */
       }
        .dropdown-container:hover .dropdown-content_1 {
            display: block; /* Display when parent is hovered */
        }

            /* Dropdown container */
            .dropdown {
                display: inline-block;
            }

            /* Dropdown button */
            .dropbtn {
                background-color: darkcyan;
                color: white;
                padding: 7px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                width: 100%;
                border-radius: 10px;
                margin-left: 10px;
                margin-top: 10px;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                margin-top: 15px;
                margin-bottom: 10px;
                display: block;
                text-decoration: none;
            }  
    </style>

<body>

<header>
    <nav class="main-nav">
        <ul>
            <li class="dropdown-container">
                <div class="dropdown-button">Doctors</div>
                <ul class="dropdown-content">
                    <li><a href="doctor-specialization.php">Doctor Specialization</a></li>
                    <li><a href="add-doctor.php">Add Doctor</a></li>
                    <li><a href="manage-doctors.php">Manage Doctors</a></li>
                </ul>
            </li>

            <li class="dropdown-container">
                <div class="dropdown-button">Users</div>
                <ul class="dropdown-content">
                    <li><a href="manage-users.php">Manage Users</a></li>
                </ul>
            </li>

            <li class="dropdown-container">
                <div class="dropdown-button">Patients</div>
                <ul class="dropdown-content">
                    <li><a href="manage-patient.php">Manage Patients</a></li>
                </ul>
            </li>

            <li><a href="appointment-history.php">Appointment history</a></li>
            
            <li class="dropdown-container">
                <div class="dropdown-button">Contact Us Queries</div>
                <ul class="dropdown-content">
                    <li><a href="unread-queries.php">Unread Query</a></li>
                    <li><a href="read-query.php">Read Query</a></li>
                </ul>
            </li>

            <li><a href="doctor-logs.php">Doctor Session Logs</a></li>
            <li><a href="user-logs.php">User Session Logs</a></li>

            <li class="dropdown-container">
                <div class="dropdown-button">Reports</div>
                <ul class="dropdown-content">
                    <li><a href="between-dates-reports.php">B/w dates reports</a></li>
                </ul>
            </li>
            <li><a href="patient-search.php">Search Patient</a></li>
        </ul>
    </nav>
    <!-- My Profile Dropdown -->
    <div class="dropdown-container">
        <button class="dropbtn_1">My Profile</button>
        <div class="dropdown-content_1">
            <a href="dashboard.php">Dashboard</a>
            <a href="change-password.php">Change Password</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</header>

<div class="container">
    <main>
        <div class="panel-white">
            <div class="panel-body">
                <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?>
                    <?php echo htmlentities($_SESSION['msg1']="");?></p>  
                    <form role="form" name="chngpwd" method="post"> 
                          <div class="form-group">
                                <div>
                                   <h5 style="font-size: 20px; font-weight: bold;">Change Password</h5>
                                </div>
                                <label for="exampleInputEmail1">Current Password</label>
                                <input type="password" name="cpass" class="form-control" placeholder="Enter Current Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" name="npass" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password">
                            </div>
                            <button type="submit" name="submit" style="background-color: dodgerblue; border-radius: 5px; padding: 5px; width: 80px; border: none; cursor: pointer">Submit</button>

                    </form><br><br>
            </div>
        </div>

    </main>
</div>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> UHL | Designed by James Wekesa</p>
    </div>
</footer>
</body>
</html>
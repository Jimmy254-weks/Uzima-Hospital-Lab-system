<?php
// Start a session
session_start();

// Include the database connection file
include('db_connect.php');

// Set the default timezone to Africa/Nairobi
date_default_timezone_set('Africa/Nairobi');

// Get the current date and time in the format: day-month-year hour:minute:second AM/PM
$currentTime = date('d-m-Y h:i:s A', time());

// Initialize the message variable
$msg = "";

// Check if the form with the name 'submit' has been submitted
if(isset($_POST['submit'])) {
    // Prepare a statement to select the password of the user with the current session ID
    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $_SESSION['id']); // Bind the session ID
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    // Verify if the hashed password from the database matches the password entered by the user
    if ($row && password_verify($_POST['cpass'], $row['password'])) {
        // Hash the new password using password_hash() function
        $newHashedPassword = password_hash($_POST['npass'], PASSWORD_DEFAULT);
        
        // Prepare a statement to update the user's password in the database with the new hashed password and current timestamp
        $stmt = $conn->prepare("UPDATE users SET password=?, updationDate=? WHERE id=?");
        $stmt->bind_param("ssi", $newHashedPassword, $currentTime, $_SESSION['id']); // Bind parameters
        $stmt->execute();
        
        // Set a success message
        $msg = "Password Changed Successfully !!";
    } else {
        // Set an error message
        $msg = "Password does not match !!";
    }
}

// Set the message in the session. checking if the msg1 exists before trying to access it
$_SESSION['msg1'] = $msg;

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient | Edit Profile</title>
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


    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            position: fixed; /* Fix the header position */
            top: 0; /* Position it at the top */
            width: 100%; /* Full width */
            background-color: gray; /* Set background color */
            padding: 60px; 
            z-index: 1000;
            margin-bottom: 0;
        }

        .dropdown_1 {
            position: absolute;
            right: 150px; /* Align to the right */
        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 163px;
            background-color: gray;
            padding: 10px;
            padding-top: 10px;
            z-index: 1;
        }

        .dropdown-content_1 a {
            color: white;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
            font-size: 15px;
            border-bottom: 1px solid black; /* Add border between links */
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }

        .dropbtn_1 {
            background-color: transparent; /* Remove background color */
            border: none; /* Remove border */
            cursor: pointer;
            color: white; /* Add color to the button text */
            padding: 0; /* Remove padding */
            font-size: 17px;
            font-weight: bold;
        }

        .dropbtn_1:hover {
            background-color: transparent; /* Remove background color */
        }

        /* Sidebar styling */
        aside {
            width: 20%;
            background-color: LightGray;
            padding: 20px; 
            position: fixed; 
            left: 0; 
            top: 90px; 
            bottom: 0; 
            margin-left: 9px;
        }

        aside ul {
            list-style: none; /* Remove default bullet points for list */
            align-items: center;
        }

        aside ul li {
            margin-bottom: 10px; /* Add bottom margin for spacing between items */
            display: flex; /* Use flexbox for alignment */
            align-items: center;
        }

        aside ul li a {
            color: black;
            text-decoration: none;
            font-size: 18px;
            display: inline-block; /* links and images align horizontally */
            margin-top: 50px;
            position: relative; /* Set position to relative */
            padding-bottom: 5px; /* Add padding for spacing between links and lines */
        }

        aside ul li img {
            width: 25px;
            height: 25px;
            margin-right: 10px; /* Add some space between the logos and the text */
        }

        .main-content {
            padding: 20px; 
            margin-left: 25%;
            margin-top: 90px; 
            position: fixed; 
            top: 0; 
            bottom: 0;
            overflow-y: auto; /* Allow vertical scrolling */
            width: 75%; /* Set the width of the main content */
        }

        .panel-body {
            padding: 20px; /* Add padding for spacing */
        }

        /* Footer styling */
        footer {
            position: fixed; 
            bottom: 0; /* Position it at the bottom */
            width: 100%; /* Full width */
            background-color: gray;
            padding: 10px; /* Add padding for spacing */
            text-align: center; 
            color: black;
        }
    </style>
</head>
<body>

<div id="app">

    <?php
    $conn = mysqli_connect("localhost", "root", "", "lab"); // Establish database connection

    // Check if session ID is set
    if(isset($_SESSION['id'])) {
        $query = mysqli_query($conn, "SELECT fullName FROM users WHERE id='" . $_SESSION['id'] . "'");
        while ($row = mysqli_fetch_array($query)) {
            $fullName = $row['fullName'];
        }
    } else {
        $fullName = "Guest"; // Default value if session ID is not set
    }
    ?>

    <header>
        <h1 style="text-align: center; color: black; margin: 5px;">Uzima Hospital Lab</h1>
        <div class="dropdown_1" style="text-align: center;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="img/images.jpg" style="margin-right: 10px; width: 50px; height: 50px;">
                <span class="username" style="color: white; text-decoration: none; margin-bottom: 30px;">
                    <?php echo $fullName; ?>
                </span>
            </a>
            <div class="dropdown-content_1">
                <a href="edit-profile.php">My profile</a>
                <a href="change-password.php">Change Password</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </header>

    <aside>
        <ul>
            <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
            <li><a href="book-appointment.php"><img src="img/book_appointment.png">Book Appointment</a></li>
            <li><a href="appointment-history.php"><img src="img/history.png">Appointment History</a></li>
            <li><a href="manage-medhistory.php"><img src="img/edit-profile.jpg">Medical History</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <div class="wrap-content" id="container">
            <!-- start: PAGE TITLE -->
            <section id="page-title">
                <div class="row">
                    <div class="col-sm-8"><br>
                        <h1 class="mainTitle" style="margin-top: 50px;">Patient | Change Password</h1>
                    </div>
                </div>
            </section>
            <div>
                <div>
                    <div>
                        <div>
                            <!-- Display session message if it exists -->
                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?>
                            <!-- Clear the session message after displaying it -->
                            <?php echo htmlentities($_SESSION['msg1']="");?></p>
                            <form role="form" name="chngpwd" method="post" onSubmit="return valid();"> 
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
                                <button type="submit" name="submit" class="btn btn-o btn-primary" style="background-color: dodgerblue; border-radius: 5px; padding: 5px; width: 80px; border: none; cursor: pointer">Submit</button>
                            </form><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>Copyright &copy; <?php echo date("Y"); ?> Designed by James Wekesa</p>
        </div>
    </footer>
</div>
</body>
</html>

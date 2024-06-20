<?php
session_start();
error_reporting(0);
include('db_connect.php');
$msg = ""; // Define $msg variable to avoid undefined variable error

// Check if $_SESSION['id'] is set
if(isset($_SESSION['id'])) {
    // Debugging
    // echo "Session ID: ".$_SESSION['id']; // Output session ID for debugging

    if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        
        // Check if 'gender' key exists in $_POST array
        if(isset($_POST['gender'])) {
            $gender = $_POST['gender'];
        } else {
            $gender = ''; // Set a default value if 'gender' key is not set
        }
    
        // Check if $_SESSION['id'] is set before using it
        if(isset($_SESSION['id'])) {
            // Prepare a statement to update user information
            $stmt = $conn->prepare("UPDATE users SET fullName=?, address=?, city=?, gender=? WHERE id=?");
            $stmt->bind_param("ssssi", $fname, $address, $city, $gender, $_SESSION['id']); // Bind parameters
            $stmt->execute();
            
            // Check if the update was successful
            if($stmt->affected_rows > 0) {
                $msg = "Your email updated Successfully";
            } else {
                $msg = "No records updated"; // Set message if no records were updated
            }
            $stmt->close();
        } else {
            $msg = "User ID is not set";
        }
    }
    
    // Debugging
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id='".$_SESSION['id']."'");
    if(mysqli_num_rows($result) > 0) {
        
    } else {
        // echo "User not found";
        $msg = "User not found";
    }
} else {
    // Redirect or handle the case when $_SESSION['id'] is not set
    header("Location: patient_login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            position: fixed; /* Fix the header position */
            top: 0; /* Position it at the top */
            width: 100%;
            background-color: gray; 
            padding: 40px; /* Add padding for spacing */
            z-index: 1000; /* Ensure it's above other elements */
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
            width: 20%; /* Set sidebar width */
            background-color: LightGray; /* Set background color */
            padding: 20px; /* Add padding for spacing */
            position: fixed; /* Fix the sidebar position */
            left: 0; /* Position it at the left */
            top: 90px; /* Add top margin to clear the header */
            bottom: 0; /* Stretch it to the bottom */
        
            margin-left: 9px;
        }

        aside ul {
            list-style: none; /* Remove default bullet points for the list */
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
            margin-top: 35px;
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
        position: fixed; /* Fix the main content position */
        top: 0; /* Position it at the top of the viewport */
        bottom: 0; /* Stretch it to the bottom of the viewport */
        overflow-y: auto; /* Allow vertical scrolling */
        width: 75%; 
        }


        .panel-body {
            padding: 20px; /* Add padding for spacing */
        }

        /* Footer styling */
        footer {
            position: fixed; /* Fix the footer position */
            bottom: 0; /* Position it at the bottom */
            width: 100%; 
            background-color: gray; 
            padding: 10px;
            text-align: center; 
            color: black;
        }

    </style>
</head>
<body>
<div id="app">
    <header>
        <h1 style="text-align: center; color: black; margin: 5px;">Uzima Hospital Lab</h1>
        <div class="dropdown_1" style="text-align: center;">
            <button class="dropbtn_1" style="padding-left: 30px;">my profile</button>
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
            <li><a href="edit-profile.php"><img src="img/edit-profile.jpg">Update Profile</a></li>
        </ul>
    </aside>
    <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8"><br>
                            <h1 class="mainTitle">User | Edit Profile</h1>
                        </div>
                       
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="color: green; font-size:18px; ">
                                <?php if($msg) { echo htmlentities($msg);}?> </h5>
                            <div class="row margin-top-30">
                                <div class="col-lg-8 col-md-12">
                                    <div class="panel panel-white">
                                        
                                        <div class="panel-body">
                                            <form name="registration" id="updatemail"  method="post">
                                                <div class="form-group">

                                                <div class="panel-heading">
                                                 <h5 class="panel-title" style="font-weight: bold; font-size: 20px; margin-bottom: 20px;">Edit Profile</h5><br>
                                                </div>

                                                    <label for="fess">
                                                        User Email
                                                    </label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                                </div>
                                                <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary" style="background-color: dodgerblue; border-radius: 5px; padding: 5px; width: 80px; border: none; cursor: pointer;">
                                                    Update
                                                </button>
                                            </form><br><br><br>
                                        </div>
                                    </div>
                                </div>
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

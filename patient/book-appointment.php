<?php
session_start();
error_reporting(0);
include('db_connect.php');
include('../includes/check_login.php');

$msg1 = isset($_SESSION['msg1']) ? htmlentities($_SESSION['msg1']) : '';

$specializations = array();
$result_specializations = mysqli_query($conn, "SELECT DISTINCT specilization FROM doctorspecilization");
if ($result_specializations) {
    while ($row = mysqli_fetch_assoc($result_specializations)) {
        $specializations[] = $row['specilization'];
    }
}

$doctors = array();
$consultancy_fees = array();

if(isset($_POST['submit'])) {
    $specilization = $_POST['Doctorspecialization'];
    $doctor_id = $_POST['doctor'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['date'];
    $time = $_POST['time'];
    $userstatus = 1;
    $docstatus = 1;

    // Prepare a statement to insert appointment data
    $stmt = $conn->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiisssi", $specilization, $doctor_id, $userid, $fees, $appdate, $time, $userstatus, $docstatus); // Bind parameters
    $query = $stmt->execute();

    // Check if the query was successful
    if($query) {
        echo "<script>alert('Your appointment successfully booked');</script>";
    } else {
        echo "<script>alert('Failed to book appointment');</script>";
    }
    
    $stmt->close(); // Close the statement
    unset($_SESSION['msg1']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UHL</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            background-color: gray;
            padding: 60px;
            margin-bottom: 0;
        }

        .dropdown_1 {
            position: absolute;
            right: 150px;
        }
        h5{
          font-size: 30px;
        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 170px;
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
            border-bottom: 1px solid black;
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }

        .dropbtn_1 {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: white;
            padding: 0;
            font-size: 17px; 
            font-weight: bold;
        }

        .dropbtn_1:hover {
            background-color: transparent;
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
        /* Reduce padding of the footer */
        footer {
            padding: 20px;
        }

        /* Fix header position */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: gray;
            z-index: 1000; /* Ensure header is above other content */
        }

        /* Fix footer position */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: gray;
            z-index: 1000; /* Ensure footer is above other content */
        }

        /* Make main content scrollable */
        .container {
            margin-top: 60px;
            margin-bottom: 30px;
            padding-bottom: 30px; /* Add padding to prevent content from being hidden behind footer */
            overflow-y: auto; /* Allow vertical scrolling */
        }

        /* Style the sidebar */
        aside {
            position: fixed;
            top: 60px; /* Adjust to account for header height */
            left: 0;
            width: 200px;
            height: calc(100% - 90px); /* Adjust to account for header and footer height */
            background-color: lightgray;
            padding: 20px;
            overflow-y: auto;
            margin-top: 65px;
            margin-top: 100px;
        }

        .form-container {
            border: 1px solid lightgray;
            padding: 20px;
            border-radius: 5px;
            width: 700px;
            margin: 0 auto;
            margin-left: 250px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-size: 17px;
        }

        .form-container select,
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="time"] {
            width: 90%;
            padding: 10px;
            border: 1px solid lightgray;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: dodgerblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Media query for devices with a maximum width of 768 pixels */
@media only screen and (max-width: 768px) {
    /* Adjustments for smaller screens */

    /* Center align the header text */
    header h1 {
        text-align: center;
    }

    /* Center align the profile dropdown */
    .dropdown_1 {
        text-align: center;
    }

    /* Adjust the spacing of the table */
    table {
        margin-top: 10px;
    }

    /* Adjust the font size of the table headings and content */
    th, td {
        font-size: 14px;
    }

    /* Center align the footer text */
    footer p {
        text-align: center;
    }

    /* Adjust the size of the profile image */
    .dropdown_1 img {
        width: 30px;
        height: 30px;
    }

    /* Adjust the width of the aside */
    aside {
        width: 200px; /* Set a specific width */
        position: fixed; /* Ensure it stays fixed */
        top: 60px; /* Adjust top position to avoid overlap with header */
        bottom: 0; /* Align to bottom of viewport */
        background-color: lightgray;
        padding: 20px;
        overflow-y: auto; /* Allow scrolling */
    }

    /* Adjust the positioning and width of the main content */
    main {
        margin-left: 220px; /* Leave space for aside */
        padding: 20px; /* Add padding for content */
        box-sizing: border-box; /* Include padding in width calculation */
    }

    /* Adjust the styling of the form container */
    .form-container {
        border: 1px solid lightgray;
        padding: 20px;
        border-radius: 5px;
        width: calc(100% - 40px); /* Adjust width to fit available space */
        margin: 20px auto; /* Center the form container */
    }

    /* Adjust the width of form input elements */
    .form-container select,
    .form-container input[type="text"],
    .form-container input[type="date"],
    .form-container input[type="time"],
    .form-container button {
        width: 100%; /* Make input elements fill the container width */
    }
}


    </style>

    <!-- Add this script to the <head> section of your HTML -->
    <script>
        // Function to fetch available doctors for the selected specialization
        function getDoctors() {
            // Get the selected specialization value
            var specialization = document.getElementById("Doctorspecialization").value;
            
            // Send AJAX request to get_doctor.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_doctor.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the doctor dropdown list with the retrieved options
                    document.getElementById("doctor").innerHTML = xhr.responseText;
                }
            };
            xhr.send("specilizationid=" + specialization);
        }


        // Function to fetch consultancy fee for the selected doctor
        function getConsultancyFee() {
            // Get the selected doctor value
            var doctor = document.getElementById("doctor").value;
            
            // Send AJAX request to get_doctor.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_doctor.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the consultancy fee dropdown list with the retrieved option
                    document.getElementById("fees").innerHTML = xhr.responseText;
                }
            };
            xhr.send("doctor=" + doctor);
        }
    </script>
</head>
<body>

<?php

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

<div class="container">
    <aside>
        <ul>
            <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
            <li><a href="book-appointment.php"><img src="img/book_appointment.png">Book Appointment</a></li>
            <li><a href="appointment-history.php"><img src="img/history.png" >Appointment History</a></li>
            <li><a href="manage-medhistory.php"><img src="img/edit-profile.jpg">Medical History</a></li>
        </ul>
    </aside>

    <main><br><br>
        <div class="container">
            <div class="panel white">
                <div class="panel-body">
                <p style="color:red;">
                  <?php echo isset($_SESSION['msg1']) ? htmlentities($_SESSION['msg1']) : ''; ?>
                   <?php $_SESSION['msg1'] = ''; ?>
                </p>


                    <form role="form" name="book" method="post">
                        <div class="form-container">
                            <div class="panel-heading">
                                <h5 class="panel-title">Book Appointment Here</h5>
                            </div>
                            <label for="Doctorspecialization">Doctor Specialization:</label>
                            <!-- Update your specialization dropdown list -->
                            <select name="Doctorspecialization" id="Doctorspecialization" onChange="getDoctors();" required="required">
                                <option value="">Select Specialization</option>
                                <?php 
                                $ret = mysqli_query($conn, "SELECT * FROM doctorspecilization");
                                while($row = mysqli_fetch_array($ret)) {
                                ?>
                                <option value="<?php echo htmlentities($row['specilization']);?>">
                                    <?php echo htmlentities($row['specilization']);?>
                                </option>
                                <?php } ?>
                            </select>

                            <!-- Update your doctor dropdown list -->
                            <label for="doctor">Doctors:</label>
                            <select name="doctor" id="doctor" onChange="getConsultancyFee();" required="required">
                                <option value="">Select Doctor</option>
                                <?php foreach ($doctors as $doctor_id => $doctor_name): ?>
                                    <option value="<?php echo htmlentities($doctor_id); ?>"><?php echo htmlentities($doctor_name); ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="fees">Consultancy Fees:</label>
                            <select name="fees" id="fees" readonly>
                                <!-- Consultancy fees options will be populated dynamically -->
                            </select>

                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" required>

                            <label for="time">Time:</label>
                            <input type="time" id="time" name="time" required>

                            <button type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> Designed by James Wekesa</p>
    </div>
</footer>
</body>
</html>

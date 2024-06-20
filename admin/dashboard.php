<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');
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
            padding: 40px;
            margin-bottom: 0;
        }

        .dropdown_1 {
            position: absolute;
            right: 80px;
        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 170px;
            background-color: white  !important;
            padding: 10px;
            padding-top: 10px;
            z-index: 1;
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
            padding: 40px; /* Remove padding */
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

        .dropdown-container:hover .dropdown-content {
            visibility: visible; /* Display when parent is hovered */
            display: block;
        }

        .dropdown-container {
            display: inline-block; /* Align elements horizontally */
            position: relative; /* Ensure dropdown content is positioned relative to the container */
        }

        .dropdown-content_1 {
        display: none; /* Initially hidden */
        position: absolute;
        background-color: darkgray;
        min-width: 160px;
        z-index: 1;
        right: calc(100% - 120px); /* Position to the left  */
        margin-right: 10px; /* Add margin for spacing between content and edge */
        }

        .dropdown-container:hover .dropdown-content_1 {
            display: block; /* Display when parent is hovered */
        }

        main {
                flex-grow: 1;
                background-color: lightseagreen;
                background-color: fill;
            }

            .custom-panel-container {
                display: flex;
                flex-wrap: wrap; /* Allow panels to wrap to the next line */
                justify-content: space-between; /* Distribute panels evenly */
                padding: 20px;
            }

            .custom-panel {
                background-color: whitesmoke;
                padding: 20px;
                margin-right: 20px; /* Add margin between panels */
                margin-bottom: 20px;
            }

            .panel-body {
                flex-grow: 1; /* Allow the panel body to grow to fill remaining space */
            }

            .panel-body a {
                display: block; /* Make links block-level elements */
                text-align: center; /* Center the text horizontally */
                color: blue;
                text-decoration: none;
            }

            .panel-body a:hover {
                color: dodgerblue;
            }

            .container {
                display: flex; /* Use flexbox to align the main content and sidebar */
            }

            @media screen and (max-width: 768px) {
                .custom-panel {
                    width: 100%; /* Set full width for panels on smaller screens */
                }
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
</head>
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
        <h2 style="text-align: center;">ADMIN | DASHBOARD</h2><br>

        <div class="custom-panel-container">
            <div class="custom-panel">
                <div class="panel-body">
                    <h2>Manage Users</h2>
                    <p><a href="manage-users.php"><?php $result = mysqli_query($conn,"SELECT * FROM users ");  $num_rows = mysqli_num_rows($result); echo "Total users: " . htmlentities($num_rows) ; ?> </a></p>
                </div>
            </div>

            <div class="custom-panel">
                <div class="panel-body">
                    <h2>Manage Doctors</h2>
                    <p><a href="manage-doctors.php"><?php  $result1 = mysqli_query($conn,"SELECT * FROM doctors ");  $num_rows1 = mysqli_num_rows($result1);  echo "Total Doctors: " . htmlentities($num_rows1); ?>  </a></p>
                </div>
            </div>

            <div class="custom-panel">
                <div class="panel-body">
                    <h2>Appointments</h2>
                    <p><a href="book-appointment.php"><a href="appointment-history.php"><?php $sql= mysqli_query($conn,"SELECT * FROM appointment");   $num_rows2 = mysqli_num_rows($sql);   echo "Total Appointments: " . htmlentities($num_rows2);  ?></a></a></p>
                </div>
            </div>

            <!-- Second Row of Panels -->
            <div class="custom-panel">
                <div class="panel-body">
                    <h2>Manage Patients</h2>
                    <p><a href="manage-patient.php"><?php  $result = mysqli_query($conn,"SELECT * FROM tblpatient "); $num_rows = mysqli_num_rows($result); echo "Total Patients: " . htmlentities($num_rows); ?></a></p>
                </div>
            </div>

            <div class="custom-panel">
                <div class="panel-body">
                    <h2>New Queries</h2>
                    <p><a href="book-appointment.php"><a href="unread-queries.php"><?php  $sql= mysqli_query($conn,"SELECT * FROM tblcontactus where  IsRead is null");  $num_rows22 = mysqli_num_rows($sql); echo "Total New Queries: " . htmlentities($num_rows22); ?></a></a></p>
                </div>
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

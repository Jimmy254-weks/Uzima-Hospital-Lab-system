<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UHL</title>
    <link rel="stylesheet" href="dashboard.css">

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
        margin-right: 40px;
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

/* Reduce margin-bottom of the header */
header {
    margin-bottom: 10px;
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
    width: 95%;
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
    padding-bottom: 30px; 
    overflow-y: auto; /* Allow vertical scrolling */
}

h5 {
    font-size: 25px;
    margin-left: 15px;
}

/* Basic form styling */
.form-group {
    border: 1px solid black; /* Add border styling here */
    border-radius: 5px; /* Add border radius here */
    padding: 20px; /* Add padding here */
    width: 80%;
    margin-top: 90px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="date"] {
    width: 70%;
    padding: 10px;
    border: 1px solid gray;
    border-radius: 5px;
    margin-bottom: 10px;
}

button[type="submit"] {
    width: 100px;
    padding: 10px 20px;
    background-color: seagreen; 
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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
        <div class="form-group">
            <div class="panel">
                <h5 class="title">Between Dates Reports</h5>
            </div>
            <form role="form" method="post" action="betweendates-detailsreports.php">
                <label for="fromdate">From Date:</label>
                <input type="date" name="fromdate" id="fromdate" required>
                <label for="todate">To Date:</label>
                <input type="date" name="todate" id="todate" required>
                <button type="submit" name="submit" id="submit" class="btn primary">
                    Submit
                </button>
            </form>
        </div>
    </main>
</div>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?>  UHL | Designed by James Wekesa</p>
    </div>
</footer>
</body>
</html>
<?php } ?>

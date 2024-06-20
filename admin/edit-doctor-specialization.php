<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

// Initialize $_SESSION['msg']
$_SESSION['msg'] = '';

if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Ensure no further script execution
}

$id = intval($_GET['id']); // Get the value and ensure it's an integer

if(isset($_POST['submit'])) {
    $docspecialization = $_POST['doctorspecilization'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE doctorspecilization SET specilization=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("si", $docspecialization, $id);
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Doctor Specialization updated successfully !!";
        }
        $stmt->close();
    }
}

if(isset($_GET['del'])) {
    $sid = intval($_GET['id']); // Ensure id is an integer

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM doctorspecilization WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("i", $sid);
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Data deleted successfully !!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    padding: 15px; 
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

/* Dropdown content */
.dropdown-content_1 {
    display: none; /* Initially hidden */
    position: absolute;
    background-color: white !important;
    min-width: 160px;
    z-index: 1;
    right: calc(100% - 120px);
    margin-right: 10px; /* Add margin for spacing between content and edge */
}

/* Show dropdown content on hover */
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
    z-index: 1000;
}

/* Fix footer position */
.dropdown_1:hover footer {
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

/* styling the form (specialization) */
.form-group {
    border: 1px solid gray; 
    padding: 10px; 
    margin-bottom: 20px; 
    margin-left: 20px;
    width: 600px;
}

label {
    display: block; 
    margin-bottom: 5px; 
}

input[type="text"] {
    width: 90%; 
    padding: 8px; 
    border-radius: 5px; 
    margin-bottom: 10px;
    border: 1px solid gray; 
}

button[type="submit"] {
    background-color: seagreen;
    color: white;
    border: none;
    padding: 7px 14px;
    border-radius: 5px;
    cursor: pointer;
}

h5 {
    text-align: left;
    font-size: 30px;
    margin-bottom: 50px;
}
/* styling the form (specialization) ends */  
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
        <div class="panel">
            <div class="panel-heading"><br><br><br>
                <h5 class="panel-title">Edit Doctor Specialization</h5>
            </div>
            <div class="panel-body">
                <p style="color:red;">
                    <?php echo htmlentities($_SESSION['msg']);?>
                    <?php echo htmlentities($_SESSION['msg']="");?>
                </p>	
                <form role="form" name="doctorSpecializationForm" method="post">
                    <div class="form-group">
                        <label for="specializationInput">Edit Doctor Specialization</label>
                        <?php 
                        $id = intval($_GET['id']);
                        // Execute an SQL query to select all columns from the table 'doctorspecialization' based on a specific 'id' value
                        $sql = mysqli_query($conn, "select * from doctorspecilization where id='$id'");
                        
                        // Check if the SQL query execution was successful
                        if (!$sql) {
                            // If the query fails, terminate the script execution and output the error message
                            die('Error: connection failed ' . mysqli_error($conn));
                        }
                        
                        while($row=mysqli_fetch_array($sql)) { ?>  
                            <input type="text" name="doctorSpecialization" class="form-control" value="<?php echo $row['specilization'];?>" >
                        <?php } ?><br>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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

<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');
// Initialize $_SESSION['msg']
$_SESSION['msg'] = '';

// Redirect to logout page if session ID is not set
if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Ensure no further code execution
}

if(isset($_POST['submit'])) {
    $doctorspecilization = $_POST['doctorspecilization'];

    // Prepare the SQL statement for inserting data
    $stmt = $conn->prepare("INSERT INTO doctorspecilization (specilization, creationDate, updationDate) VALUES (?, current_timestamp(), current_timestamp())");
    $stmt->bind_param("s", $doctorspecilization);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Doctor Specialization added successfully !!";
    } else {
        $_SESSION['msg'] = "Error adding Doctor Specialization.";
    }

    // Close the statement
    $stmt->close();
}

if(isset($_GET['del'])) {
    $sid = $_GET['id'];

    // Prepare the SQL statement for deleting data
    $stmt = $conn->prepare("DELETE FROM doctorspecilization WHERE id = ?");
    $stmt->bind_param("i", $sid);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Data deleted successfully!";
    } else {
        $_SESSION['msg'] = "Error deleting data.";
    }

    // Close the statement
    $stmt->close();
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

    main {
        flex-grow: 1;
    }

    .custom-panel-container {
        display: flex;
        flex-wrap: wrap; /* Allow panels to wrap to the next line */
        justify-content: space-between; /* Distribute the panels evenly */
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
        display: block;
        text-align: center;
        color: blue;
        text-decoration: none;
    }

    .panel-body a:hover {
        color: dodgerblue;
        text-decoration: underline;
    }

    .container {
        display: flex; /*flexbox to align the main content and sidebar */
    }

    @media screen and (max-width: 768px) {
        .custom-panel {
            width: 100%; /* Setting full width for panels on smaller screens */
        }
    }

    .dropdown {
        display: inline-block;
    }

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

    .dropdown-content a {
        color: black;
        margin-top: 15px;
        margin-bottom: 10px;
        display: block;
        text-decoration: none;
    }

    /* styling the form (specialization)*/
    .form-group {
        border: 1px solid gray;
        padding: 10px;
        margin-bottom: 20px;
        margin-left: 20px;
        width: 600px;
    }

    label {
        display: block; /* Display label on a separate line */
        margin-bottom: 5px; /* Add margin between label and input */
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

    /*  table styling starts */
    table {
        width: 100%;
        border-collapse: collapse; /* Collapse border spacing */
        margin-bottom: 20px; /* Add margin to bottom of table */
    }

    /* Add padding to table cells */
    table th,
    table td {
        padding: 10px; /* Add padding to all table cells */
    }

    /* Style table header cells */
    table th {
        background-color: lightgray;
        font-weight: bold;
        text-align: left;
    }

    /* Style table data cells */
    table td {
        border-bottom: 1px solid gray; /* Add bottom border to separate rows */
    }

    table td,
    table th {
        line-height: 1.5; /* Adjust line height */
    }

    /*  table styling ends */

    /* Reduce margin-bottom of the header */
    header {
        margin-bottom: 10px;
    }

    /* Reduce padding of the footer */
    footer {
        padding: 10px;
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
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading"><br>
                        <h2 style="text-align: center;">Admin | Add Doctor Specialization</h2>
                    </div>
                    <div class="panel-body">
                        <p style="color:red;"><?php echo !empty($_SESSION['msg']) ? htmlentities($_SESSION['msg']) : ''; ?></p>
                        <form role="form" name="doctor_specialization" method="post">
                            <div class="form-group">
                                <h3 class="panel-title">Doctor Specialization</h3><br>
                                <label>Doctor Specialization</label><br>
                                <input type="text" name="doctorspecilization" placeholder="Enter Doctor Specialization">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">Manage Doctor Specializations</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Updation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM doctorspecilization");
                        $cnt = 1;
                        while($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo isset($row['specilization']) ? $row['specilization'] : ''; ?></td>
                            <td><?php echo isset($row['creationDate']) ? $row['creationDate'] : ''; ?></td>
                            <td><?php echo isset($row['updationDate']) ? $row['updationDate'] : ''; ?></td>
                            <td>
                                <a href="edit-doctor-specialization.php?id=<?php echo $row['id'];?>" class="btn btn-info">Edit</a> || 
                                <a href="doctor-specialization.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            $cnt = $cnt + 1;
                        }?>
                    </tbody>
                </table>
            </div>
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

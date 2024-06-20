<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
    if(isset($_GET['del'])) {
        $docid = $_GET['id'];

        // Prepare the SQL statement for deletion
        $stmt = $conn->prepare("DELETE FROM doctors WHERE id = ?");
        $stmt->bind_param("i", $docid);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Doctor deleted successfully!";
        } else {
            $_SESSION['msg'] = "Failed to delete doctor";
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
        right: calc(100% - 120px); /* Position to the left  */
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
        margin-top: 60px; /* Adjust to account for header height */
        margin-bottom: 30px; /* Adjust to account for footer height */
        padding-bottom: 30px; /* Add padding to prevent content from being hidden behind footer */
        overflow-y: auto; /* Allow vertical scrolling */
    }

    .form-group {
        margin-bottom: 20px;
        border: 1px solid lightgrey;
        border-radius: 5px;
        padding: 20px;
        background-color: whitesmoke;
        width: 50%;
        margin-left: 30px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    select {
        width: 80%;
        padding: 10px;
        border: 1px solid lightgrey;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    input[type="password"] {
        width: 80%;
        padding: 10px;
        border: 1px solid lightgrey;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: seagreen;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    h5 {
        text-align: left;
        font-size: 30px;
        margin-bottom: 20px;
        margin-left: 30px;
    }

    /* Table style */
    .table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    /* Table header */
    .table th {
        background-color: whitesmoke;
        border: 1px solid lightgrey;
        padding: 8px;
        text-align: left;
        font-size: 14px;
    }

    /* Table body */
    .table td {
        border: 1px solid lightgrey;
        padding: 8px;
        font-size: 14px;
    }

    /* Action buttons */
    .btn {
        padding: 6px 12px;
        margin: 2px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
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
    <div class="row">
        <div class="col-md-12">
            <h5 class="title">Manage Doctors</h5>
                     <p style="color:red;">
                        <?php echo isset($_SESSION['msg']) ? htmlentities($_SESSION['msg']) : ''; ?>
                        <?php $_SESSION['msg'] = ""; ?>
                    </p>
            <table class="table" id="doctors-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Specialization</th>
                        <th>Doctor Name</th>
                        <th>Creation Date </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($conn, "select * from doctors");
                    $cnt = 1;
                    while($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['specilization'];?></td>
                        <td><?php echo $row['doctorName'];?></td>
                        <td><?php echo $row['creationDate'];?></td>
                        <td>
                            <div class="actions">
                                <a href="edit-doctor.php?id=<?php echo $row['id'];?>" class="btn btn-edit" data-tooltip="Edit">Edit</a>
                                <a href="manage-doctors.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                    $cnt = $cnt + 1;
                    } ?>
                </tbody>
            </table>
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
<?php  ?>

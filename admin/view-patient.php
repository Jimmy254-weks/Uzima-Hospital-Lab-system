<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

// Check if session ID is not set or empty
if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
  

    if(isset($_POST['submit'])) { 
        $vid = $_GET['viewid'];
        $bp = $_POST['bp'];
        $bs = $_POST['bs'];
        $weight = $_POST['weight'];
        $temp = $_POST['temp'];
        $pres = $_POST['pres'];

        // Prepare the SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $vid, $bp, $bs, $weight, $temp, $pres);

        if ($stmt->execute()) {
            echo '<script>alert("Medical history has been added.")</script>';
            echo "<script>window.location.href ='manage-patient.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
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
        margin-top: 60px; 
        margin-bottom: 30px;
        padding-bottom: 30px; 
        overflow-y: auto; /* Allow vertical scrolling */
    }

    /* Table style */
    .patient-details-table,
    .medical-history-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    /* Table header */
    .patient-details-table th,
    .medical-history-table th {
        border: 1px solid lightgray;
        padding: 8px;
        text-align: left;
    }

    /* Table body */
    .patient-details-table td,
    .medical-history-table td {
        border: 1px solid lightgray;
        padding: 8px;
    }

    h5 {
        font-size: 25px;
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
                <div class="col">
                    <h5 class="title">Manage Patients</h5>
                    <?php
                    $vid=$_GET['viewid'];
                    $ret=mysqli_query($conn,"select * from tblpatient where ID='$vid'");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                    ?>
                    <table class="patient-details-table" style="border: 1px">
                        <tr style="text-align: center;">
                        <!-- colspan="4" specifies the number of columns the cell should span. In this case, it spans across 4 columns.-->
                            <td colspan="4" style="font-size:20px;color:blue">
                                Patient Details
                            </td>
                        </tr>
                        <tr>
                            <th>Patient Name</th>
                            <td><?php  echo $row['PatientName'];?></td>
                            <th>Patient Email</th>
                            <td><?php  echo $row['PatientEmail'];?></td>
                        </tr>
                        <tr>
                            <th>Patient Mobile Number</th>
                            <td><?php  echo $row['PatientContno'];?></td>
                            <th>Patient Address</th>
                            <td><?php  echo $row['PatientAdd'];?></td>
                        </tr>
                        <tr>
                            <th>Patient Gender</th>
                            <td><?php  echo $row['PatientGender'];?></td>
                            <th>Patient Age</th>
                            <td><?php  echo $row['PatientAge'];?></td>
                        </tr>
                        <tr>
                            <th>Patient Medical History (if any)</th>
                            <td><?php  echo $row['PatientMedhis'];?></td>
                            <th>Patient Reg Date</th>
                            <td><?php  echo $row['CreationDate'];?></td>
                        </tr>
                    </table>
                    <?php }?>

                    <?php  
                    $ret=mysqli_query($conn,"select * from tblmedicalhistory  where PatientID='$vid'");
                    ?>
                    <table class="medical-history-table">
                        <tr style="text-align: center;">
                            <th colspan="8">Medical History</th> 
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Blood Pressure</th>
                            <th>Weight</th>
                            <th>Blood Sugar</th>
                            <th>Body Temperature</th>
                            <th>Medical Prescription</th>
                            <th>Visit Date</th>
                        </tr>
                        <?php  
                        while ($row=mysqli_fetch_array($ret)) { 
                        ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php  echo $row['BloodPressure'];?></td>
                            <td><?php  echo $row['Weight'];?></td>
                            <td><?php  echo $row['BloodSugar'];?></td> 
                            <td><?php  echo $row['Temperature'];?></td>
                            <td><?php  echo $row['MedicalPres'];?></td>
                            <td><?php  echo $row['CreationDate'];?></td> 
                        </tr>
                        <?php $cnt=$cnt+1;} ?>
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

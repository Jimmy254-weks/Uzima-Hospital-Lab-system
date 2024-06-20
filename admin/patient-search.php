<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');

if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
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
        cursor: pointer;
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
        background-color: white;
        min-width: 160px;
        z-index: 1;
        right: calc(100% - 120px); /* Position to the left  */
        margin-right: 10px; /* Add margin for spacing between content and edge */
    }

    .dropdown-container:hover .dropdown-content_1 {
        display: block; /* Display when parent is hovered */
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

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        margin-top: 15px;
        margin-bottom: 10px;
        display: block;
        text-decoration: none;
    }

    header {
        margin-bottom: 10px;
    }
    
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

    /* Style for the form container */
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Style for the form starts */
    form {
        margin-top: 80px;
    }

    /* Style for form inputs */
    .form-control {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid gray;
        border-radius: 4px;
    }

    /* Style for the search button */
    button {
        background-color: seagreen;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }

    /* Style for the table */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Style for table header */
    .table th {
        color: black;
        border: 1px solid gray;
        padding: 8px;
        text-align: left;
    }

    /* Style for table body */
    .table td {
        border: 1px solid gray;
        padding: 8px;
    }

    /* Center-align text in the 'center' column */
    .table .center {
        text-align: center;
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
                <div class="col-12"><br><br>
                    <form role="form" method="post" name="search">
                        <div class="form-group">
                            <label for="doctorname">Search by Name/Mobile No. </label>
                            <input type="text" name="searchdata" class="form-control" value="" required='true'>
                        </div>
                        <button type="submit" name="search" id="submit">Search</button>
                    </form>
                    <?php
                    if(isset($_POST['search'])) { 
                        $sdata=$_POST['searchdata'];
                    ?>
                        <h4 style="text-align: center;">Result against "<?php echo $sdata;?>" keyword </h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Patient Name</th>
                                    <th>Patient Contact Number</th>
                                    <th>Patient Gender </th>
                                    <th>Creation Date </th>
                                    <th>Updation Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql=mysqli_query($conn,"select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
                                $num=mysqli_num_rows($sql);
                                if($num>0){
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($sql)) {
                                ?>
                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td class="hidden-xs"><?php echo $row['PatientName'];?></td>
                                            <td><?php echo $row['PatientContno'];?></td>
                                            <td><?php echo $row['PatientGender'];?></td>
                                            <td><?php echo $row['CreationDate'];?></td>
                                            <td><?php echo $row['UpdationDate'];?></td>
                                            <td>
                                                <a href="view-patient.php?viewid=<?php echo $row['ID'];?>">view</a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $cnt=$cnt+1;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="8"> No record found against this search</td>
                                    </tr>
                                <?php } 
                            }?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </main>
</div>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?>UHL | Designed by James Wekesa</p>
    </div>
</footer>
</body>
</html>
<?php ?>

<?php
session_start();
// Setting error reporting to display all errors
error_reporting(0);
include('../includes/db_connect.php');

// Redirecting user to logout page if user ID is not set
if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        // Sanitizing and validating user inputs(helps prevent SQL injection attacks,  attackers can manipulate SQL queries through input fields to access or modify database content)
        $docspecialization = $_POST['Doctorspecialization'];
        $docname = $_POST['docname'];
        $docaddress = $_POST['clinicaddress'];
        $docfees = $_POST['docfees'];
        $doccontactno = $_POST['doccontact'];
        $docemail = $_POST['docemail'];
        $password = password_hash($_POST['npass'], PASSWORD_DEFAULT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO doctors (specilization, doctorName, address, docFees, contactno, docEmail, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssssss", $docspecialization, $docname, $docaddress, $docfees, $doccontactno, $docemail, $password);

        // Execute the statement
        if($stmt->execute()) {
            // Displaying success message if insertion is successful
            echo "<script>alert('Doctor info added Successfully');</script>";
            echo "<script>window.location.href ='manage-doctors.php'</script>"; // Redirecting to manage-doctors.php
        } else {
            // Handling SQL query error
            echo "Error: " . $stmt->error;
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

    .dropdown-content {
        visibility: hidden; /* Initially its hidden */
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
        visibility: visible; /* Display/seen when parent is hovered */
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
        right: calc(100% - 120px); /* Positions to the left  */
        margin-right: 10px; /* Add margin for spacing between content and edge */
    }

    .dropdown-container:hover .dropdown-content_1 {
        display: block;
    }

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
        z-index: 1000; /* Ensure footer is above other content when scrolling*/
    }

    /* Make main content scrollable */
    .container {
        margin-top: 60px;
        margin-bottom: 30px;
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

<div class="add-doctor-container">
    <div class="add-doctor-panel">
        <div class="add-doctor-heading"><br><br>
            <h5 class="panel-title">Add Doctor</h5>
        </div>
        <div class="add-doctor-body">
        <form role="form" name="adddoc" method="post">
    <div class="form-group">
        <label for="doctor-specialization">Doctor Specialization</label>
        <select name="Doctorspecialization" class="form-control" required="true">
            <option value="">Select Specialization</option>
            <?php
            $ret = mysqli_query($conn, "SELECT * FROM doctorspecilization");
            // Execute SQL query to select all records from the 'doctorspecilization' table and store the result set in the variable $ret.
            while ($row = mysqli_fetch_array($ret)) {
                // Start a loop to iterate through each row of the result set stored in $ret. Fetches the current row as an associative array and assigns it to $row.
                // Set the value and display text directly inside the <option> element
                echo '<option value="' . htmlentities($row['specilization']) . '">' . htmlentities($row['specilization']) . '</option>';
                // Output an <option> element for each row in the result set. The value and text of the option are both set to the value of the 'specilization' column in the current row, after HTML entity encoding.
            }
            ?>
        </select><br><br>

        <label for="doctor-name">Doctor Name</label>
        <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true"><br><br>

        <label for="clinic-address">Doctor Clinic Address</label>
        <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea><br><br>

        <label for="consultancy-fees">Doctor Consultancy Fees</label>
        <input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true"><br><br>

        <label for="contact-no">Doctor Contact no</label>
        <input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true"><br><br>

        <label for="doctor-email">Doctor Email</label>
        <input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true"><br><br>

        <label for="new-password">Password</label>
        <input type="password" name="npass" class="form-control" placeholder="New Password" required="required"><br><br>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required"><br><br>

        <button type="submit" name="submit">Submit</button>
    </div><br>
</form>

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


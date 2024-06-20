<?php
session_start();
error_reporting(0);
include('db_connect.php');

// Check if session ID is not set or empty
if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
    if(isset($_POST['submit'])) {
        $docid = $_SESSION['id'];
        $patname = $_POST['patname'];
        $patcontact = $_POST['patcontact'];
        $patemail = $_POST['patemail'];
        $gender = $_POST['gender'];
        $pataddress = $_POST['pataddress'];
        $patage = $_POST['patage'];
        $medhis = $_POST['medhis'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO tblpatient(Docid, PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("isssssis", $docid, $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis);

        // Execute the statement
        if($stmt->execute()) {
            // JavaScript alert to display the success message
            echo "<script>alert('Patient info added Successfully');</script>";
            // Redirect after the alert is shown
            echo "<script>window.location.href='add-patient.php';</script>";
            exit; // Ensure no further code execution after redirect
        } else {
            // Display an error message if the insert query fails
            echo "<script>alert('Failed to add patient info');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>

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

    /* Dropdown content (hidden by default) */
    .dropdown-content {
        display: none;
        background-color: whitesmoke;
        min-width: 160px;
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        margin-top: 15px;
        margin-left: 20px;
        margin-bottom: 10px;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        border-radius: 5px;
        text-decoration: underline;
        text-decoration-color: black;
        color: black;
        padding: 4px;
    }

    /* Show the dropdown menu when the user clicks on the dropdown button */
    .show {
        display: block;
    }


    /*styling of the headers content in the dashboard starts*/

    .dropdown_1 {
        position: absolute;
        right: 135px; /* Align to the right */
    }

    .dropdown-content_1 {
        display: none;
        position: absolute;
        min-width: 160px;
        background-color: DarkSlateGray;
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
        border-bottom: 1px solid black; /* Add border line between links */
    }


    .dropdown_1:hover .dropdown-content_1 {
        display: block;
    }

    .dropbtn_1 {
        background-color: transparent; /* Remove background color */
        border: none; /* Remove border */
        cursor: pointer;
        color: white; 
        padding: 0; 
        font-size: 17px;
        font-weight: bold;
    }

    .dropbtn_1:hover {
        background-color: transparent; /* Remove background color */
    }
    /*styling of the headers content in the dashboard ends*/


    /* styling of the dashboard starts*/

    .custom-panel-container {
        display: flex; /* Use flexbox layout to arrange child panels horizontally */
    }

    .custom-panel {
        flex: 1; /* Distribute space equally among child elements */
        background-color: whitesmoke;
        padding: 20px;
        margin-right: 20px; /* Add margin between panels */
        display: flex; /* Use flexbox layout for panel content */
        flex-direction: column; /* Arrange content in a column */
        justify-content: center;
    }

    .panel-body {
        flex-grow: 1; /* Allow the panel body to grow to fill remaining space */
    }

    .panel-body a {
        display: block; /* Make links block-level elements */
        text-align: center;
        color: blue;
        text-decoration: none;
    }

    .panel-body a:hover {
        color: dodgerblue;
        text-decoration: underline
    }

    /* Header */
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 60px;
        z-index: 1000; /* Ensure it's above other content on scrolling */
    }

    /* Container */
    .container {
        display: flex;
        flex-direction: row;
        margin-top: 60px;
    }

    /* Sidebar */
    aside {
        width: 250px; 
        position: fixed;
        top: 60px; 
        bottom: 0;
        overflow-y: auto; /* Enable vertical scroll if content exceeds sidebar height */
        margin-top: 110px;
    }

    /* Main content */
    main {
        flex: 1; /* Take remaining width */
        margin-left: 250px; 
        padding: 20px;
        overflow-y: auto; /* Enable vertical scroll if content exceeds main content height */
        margin-top: 60px
    }

    /* Footer */
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 10px 0;
        z-index: 1000; /* Ensure it's above other content */
    }

    /* Panel container */
    .panel {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: whitesmoke;
        margin-left: 30px;
    }

    /* Panel header */
    .panel-heading {
        background-color: darkblue;
        color: white;
        padding: 10px 15px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    /* Panel body */
    .panel-body {
        padding: 15px;
    }

    /* Form group */
    .form-group {
        margin-bottom: 20px;
    }

    /* Labels */
    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Inputs */
    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid black;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Radio buttons */
    input[type="radio"] {
        margin-right: 5px;
    }

    /* Buttons */
    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: seagreen;
        color: white;
    }
    </style>
</head>
<body>

<?php
// Check if session ID is set
if (isset($_SESSION['id'])) {
    $stmt = $conn->prepare("SELECT doctorName FROM doctors WHERE id = ?"); //This prepares the SQL query with a placeholder ? for the id parameter.
    $stmt->bind_param("i", $_SESSION['id']); //This binds the session id to the placeholder in the query. The i indicates that the parameter is an integer.
    $stmt->execute(); //This executes the prepared statement.
    $stmt->bind_result($doctorName); //This binds the result of the query to the variable $doctorName.
    $stmt->fetch(); //This fetches the result and assigns it to $doctorName.
    $stmt->close(); //This closes the prepared statement.
} else {
    $doctorName = "Guest"; // Default value if session ID is not set
}
?>
<header>
    <h1 style="text-align: center; color: black; margin: 5px;">Uzima Hospital Lab</h1>
    <div class="dropdown_1" style="text-align: center;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="img/images.jpg" style="margin-right: 10px; width: 50px; height: 50px;">
            <span class="username" style="color: white; text-decoration: none; margin-bottom: 30px;">
                <?php echo $doctorName; ?>
            </span>
        </a>
        <div class="dropdown-content_1">
            <a href="edit-profile.php">My profile</a>
            <a href="change-password.php">Change Password</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</header><br>

<div class="container">
    <!-- This section defines a navigation menu -->
    <aside>
        <ul>
            <!-- Menu item for the dashboard -->
            <li><a href="dashboard.php">Dashboard</a></li>

            <!-- Menu item for viewing appointment history -->
            <li><a href="appointment-history.php">Appointment history</a></li>

            <!-- Dropdown menu for managing patients -->
            <li class="dropdown">
                <!-- Button to toggle the patient submenu -->
                <div class="toggle-submenu dropbtn" onclick="toggleDropdown()">Patients</div>

                <!-- Submenu for managing patients, initially hidden -->
                <ul id="patientDropdown" class="submenu dropdown-content">
                    <!-- Submenu item for adding a new patient -->
                    <li><a href="add-patient.php">Add Patient</a></li>

                    <!-- Submenu item for managing existing patients -->
                    <li><a href="manage-patient.php">Manage Patient</a></li>
                </ul>
            </li>

            <!-- Menu item for searching -->
            <li><a href="search.php">Search patient</a></li>
        </ul>
    </aside>

    <main>
        <h2>PATIENT | ADD PATIENT</h2><br>

        <div class="panel panel-default">
            <div class="panel-heading">Patient Information</div>
            <div class="panel-body">
                <form role="form" name="" method="post">

                    <div class="form-group">
                        <label for="doctorname">Patient Name:</label>
                        <input type="text" name="patname" class="form-control" placeholder="Enter Patient Name" required="true">
                    </div>

                    <div class="form-group">
                        <label for="fess">Patient Contact no:</label>
                        <input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
                    </div>

                    <div class="form-group">
                        <label for="fess">Patient Email:</label>
                        <input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
                    </div>

                    <div class="form-group">
                        <label class="block">Gender:</label>
                        <div class="radio">
                            <label><input type="radio" name="gender" value="female"> Female</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="gender" value="male"> Male</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Patient Address:</label>
                        <textarea name="pataddress" class="form-control" placeholder="Enter Patient Address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fess">Patient Age:</label>
                        <input type="text" name="patage" class="form-control" placeholder="Enter Patient Age">
                    </div>

                    <div class="form-group">
                        <label for="fess">Medical History:</label>
                        <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn-primary">Add</button>

                </form>
            </div>
        </div>
    </main>
</div><br>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?>UHL | Designed by James Wekesa</p>
    </div>
</footer>

<!-- JavaScript function to toggle the visibility of the patient submenu -->
<script>
    // Function to toggle the visibility of the patient submenu
    function toggleDropdown() {
        // Get the patient submenu element by its ID
        var dropdown = document.getElementById("patientDropdown");

        // Toggle the "show" class to display or hide the patient submenu
        dropdown.classList.toggle("show");
    }

    // Close the patient submenu if the user clicks outside of it
    window.onclick = function (event) {
        // Check if the clicked target is not the patient dropdown button
        if (!event.target.matches('.dropbtn')) {
            // Get all patient submenu elements by their class name
            var dropdowns = document.getElementsByClassName("dropdown-content");

            // Loop through each patient submenu
            for (var i = 0; i < dropdowns.length; i++) {
                // Get the current patient submenu
                var openDropdown = dropdowns[i];

                // Check if the current patient submenu is displayed
                if (openDropdown.classList.contains('show')) {
                    // Remove the "show" class to hide the patient submenu
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
</body>
</html>


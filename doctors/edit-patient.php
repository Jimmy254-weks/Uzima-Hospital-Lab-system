<?php
session_start();
error_reporting(0);
include('db_connect.php');

if(empty($_SESSION['id'])) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $patname = $_POST['patname'];
        $patcontact = $_POST['patcontact'];
        $patemail = $_POST['patemail'];
        $gender = $_POST['gender'];
        $pataddress = $_POST['pataddress'];
        $patage = $_POST['patage'];
        $medhis = $_POST['medhis'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE tblpatient SET PatientName=?, PatientContno=?, PatientEmail=?, PatientGender=?, PatientAdd=?, PatientAge=?, PatientMedhis=? WHERE ID=?");

        // Bind the parameters
        $stmt->bind_param("sssssssi", $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis, $eid);

        // Execute the statement
        if($stmt->execute()) {
            // JavaScript alert to display the success message
            echo "<script>alert('Patient info updated Successfully');</script>";
            // Redirect after the alert is shown
            echo "<script>window.location.href='manage-patient.php';</script>";
            exit; // Ensure no further code execution after redirect
        } else {
            // Display an error message if the update query fails
            echo "<script>alert('Failed to update patient info');</script>";
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

        /* styling of the headers content in the dashboard starts*/
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
            border-bottom: 1px solid black; /* Add border between links */
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }

        .dropbtn_1 {
            background-color: transparent; /* Remove background color */
            border: none; /* Remove border */
            cursor: pointer;
            color: white; /* Add color to the button text */
            padding: 0; /* Remove padding */
            font-size: 17px; /* Inherit font size */
            font-weight: bold;
        }

        .dropbtn_1:hover {
            background-color: transparent; /* Remove background color */
        }
        /* styling of the headers content in the dashboard ends*/

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
            justify-content: center; /* Center content vertically */
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
            text-decoration: underline
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 60px;
            z-index: 1000; /* Ensure it's above other content */
        }

        /* Container */
        .container {
            display: flex;
            flex-direction: row;
            margin-top: 60px; /* Adjust for header height */
        }

        /* Sidebar */
        aside {
            width: 250px; /* Adjust width as needed */
            position: fixed;
            top: 60px; /* Adjust for header height */
            bottom: 0;
            overflow-y: auto; /* Enable vertical scroll if content exceeds sidebar height */
            margin-top: 110px;
        }

        /* Main content */
        main {
            flex: 1; /* Take remaining width */
            margin-left: 250px; /* Adjust for sidebar width */
            padding: 20px;
            overflow-y: auto; /* Enable vertical scroll if content exceeds main content height */
            margin-top: 80px;
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

        /* Form group */
        .form-group {
            margin-bottom: 20px;
            margin-left: 30px;
        }

        /* Labels */
        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            font-size: 15px;
        }

        /* Input fields and textareas */
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid lightgrey;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px; /* Add some space between input fields */
        }

        /* Radio buttons */
        input[type="radio"] {
            margin-right: 5px;
        }

        /* Submit button */
        button {
            background-color: dodgerblue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
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

    <style>

    </style>
    <main>
        <h2>PATIENT | ADD PATIENT</h2><br>

        <div class="container">
            <div class="panel-body">

                <div class="form-group">
                    <form role="form" name="" method="post">
                        <?php
                        $eid=$_GET['editid'];
                        $ret=mysqli_query($conn,"select * from tblpatient where ID='$eid'");
                        $cnt=1;
                        if ($row=mysqli_fetch_array($ret)) {
                            ?>
                            <label>Patient Name:</label>
                            <input type="text" name="patname" class="form-control" value="<?php echo $row['PatientName'];?>" required="true">

                            <label>Patient Contact no:</label>
                            <input type="text" name="patcontact" class="form-control" value="<?php echo $row['PatientContno'];?>" required="true" maxlength="10" pattern="[0-9]+">

                            <label>Patient Email:</label>
                            <input type="email" id="patemail" name="patemail" class="form-control"><br>

                            <label>Gender:</label>
                            <?php if($row['PatientGender']=="Female"){ ?>
                                <input type="radio" name="gender" id="gender" value="Female" checked="true">Female
                                <input type="radio" name="gender" id="gender" value="male">Male
                            <?php } else { ?>
                                <input type="radio" name="gender" id="gender" value="Male" checked="true">Male
                                <input type="radio" name="gender" id="gender" value="Female">Female
                            <?php } ?>

                            <label>Patient Address:</label>
                            <textarea name="pataddress" class="form-control" required="true"><?php echo $row['PatientAdd'];?></textarea>

                            <label>Patient Age:</label>
                            <input type="text" name="patage" class="form-control" value="<?php echo $row['PatientAge'];?>" required="true">

                            <label>Medical History:</label>
                            <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"><?php echo $row['PatientMedhis'];?></textarea>

                            <label>Creation Date:</label>
                            <input type="text" class="form-control" value="<?php echo $row['CreationDate'];?>" readonly='true'>
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div><br>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> Designed by James Wekesa</p>
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

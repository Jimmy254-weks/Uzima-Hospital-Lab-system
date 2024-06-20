<?php
session_start();
error_reporting(0);
include('db_connect.php');

// Check if user is logged in
if (empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further execution
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vid = $_GET['viewid'];
    $bp = $_POST['bp'];
    $bs = $_POST['bs'];
    $weight = $_POST['weight'];
    $temp = $_POST['temp'];
    $pres = $_POST['pres'];

    // Insert data into the database using a prepared statement
    $stmt = $conn->prepare("INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $vid, $bp, $bs, $weight, $temp, $pres);

    // Check if query was successful
    if ($stmt->execute()) {
        echo '<script>alert("Medical history has been added.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
        exit(); // Stop further execution
    } else {
        // Display error message
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }

    // Close the statement
    $stmt->close();
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
            border: none;/* Remove border */
            cursor: pointer;
            color: white;/* Add color to the button text */
            padding: 0;/* Remove padding */
            font-size: 17px;/* Inherit font size */
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
            margin-top: 60px;
        }

        /* Sidebar */
        aside {
            width: 250px;
            position: fixed;
            top: 60px;/* Adjust for header height */
            bottom: 0;
            overflow-y: auto; /* Enable vertical scroll if content exceeds sidebar height */
            margin-top: 110px;
        }

        /* Main content */
        main {
            flex: 1;/* Take remaining width */
            margin-left: 250px;/* Adjust for sidebar width */
            padding: 20px;
            overflow-y: auto;/* Enable vertical scroll if content exceeds main content height */
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

        /* Centering container */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px; /* Add some spacing between tables */
            margin-left: 30px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid gray;
            text-align: left;
            padding-right: 5px;
        }

        /* Modal styling */
        .modal-body table {
            width: 100%;
        }

        .modal-body th {
            width: 50%;
        }

        .modal-body td {
            width: 70%;
        }

        /* Button styling */
        button {
            padding: 8px 16px;
            border: none;
            background-color: cornflowerblue;
            color: white;
            cursor: pointer;
        }

        /* Button style */
        .btn {
            padding: 10px 20px;
            background-color: dodgerblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 30px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid darkgray;
            width: 80%;
            max-width: 600px;
        }

        /* Close Button */
        .close {
            color: gray;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form Label */
        label {
            margin-bottom: 5px;
            display: block;
        }

        /* Form Input */
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid gray;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Button */
        button {
            background-color: royalblue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

            <div class="center-container">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $vid=$_GET['viewid'];
                                $ret=mysqli_query($conn,"select * from tblpatient where ID='$vid'");
                                $cnt=1;
                                while ($row=mysqli_fetch_array($ret)) {
                                ?>
                                <table style="border: 1;">
                                    <tr style="text-align: center;">
                                        <td colspan="4" style="font-size:20px;color:black">
                                            Patient Details
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope>Patient Name</th>
                                        <td><?php  echo $row['PatientName'];?></td>
                                        <th scope>Patient Email</th>
                                        <td><?php  echo $row['PatientEmail'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope>Patient Mobile Number</th>
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
                                        <th>Patient Medical History(if any)</th>
                                        <td><?php  echo $row['PatientMedhis'];?></td>
                                        <th>Patient Reg Date</th>
                                        <td><?php  echo $row['CreationDate'];?></td>
                                    </tr>
                                <?php }?>
                                </table>
                                <?php  
                                $ret=mysqli_query($conn,"select * from tblmedicalhistory  where PatientID='$vid'");
                                ?>
                                <table>
                                    <tr style="text-align: center;">
                                        <th colspan="8" >Medical History</th> 
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Blood Pressure</th>
                                        <th>Weight(kg)</th>
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
                                <button class="btn" id="openModalBtn">Add Medical History</button>
                            </div>
                        </div>
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

    <!-- Modal dialog -->
    <div id="myModal" class="modal">
        <div class="modal-content">

            <!--&times;: T represents multiplication sign (×), close symbol (×) for modal close buttons.-->
            <span class="close">&times;</span>
            <h2>Add Medical History</h2>
            <form id="medicalHistoryForm" method="post">
                <label for="bp">Blood Pressure:</label>
                <input type="text" id="bp" name="bp" placeholder="Enter Blood Pressure" required><br><br>
                <label for="bs">Blood Sugar:</label>
                <input type="text" id="bs" name="bs" placeholder="Enter Blood Sugar" required><br><br>
                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" placeholder="Enter Weight" required><br><br>
                <label for="temp">Body Temperature:</label>
                <input type="text" id="temp" name="temp" placeholder="Enter Body Temperature" required><br><br>
                <label for="pres">Prescription:</label><br>
                <textarea id="pres" name="pres" rows="4" cols="50" placeholder="Enter Prescription" required></textarea><br><br>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modal element by its ID "myModal"
        var modal = document.getElementById("myModal");

        // Get the button element that opens the modal by its ID "openModalBtn"
        var btn = document.getElementById("openModalBtn");

        // Get the close button element inside the modal by its class "close"
        var span = modal.getElementsByClassName("close")[0];

        // When the button is clicked, set the modal's display style to "block" to make it visible
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the close button (span) is clicked, set the modal's display style to "none" to hide it
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            // Check if the clicked element is the modal itself
            if (event.target == modal) {
                // If so, set the modal's display style to "none" to hide it
                modal.style.display = "none";
            }
        }

    </script>
</body>

</html>

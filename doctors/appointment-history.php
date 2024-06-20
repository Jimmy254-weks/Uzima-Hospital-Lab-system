<?php
session_start();
error_reporting(0);
include('db_connect.php');

// Check if $_SESSION['id'] is set and not empty
if(empty($_SESSION['id'])) {
    header('location:logout.php');
} else {
    // Check if $_SESSION['msg'] is set
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";

    if(isset($_GET['cancel'])) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE appointment SET doctorStatus='0' WHERE id=?");
        
        // Bind the parameter
        $stmt->bind_param("i", $_GET['id']);
        
        // Execute the statement
        $stmt->execute();
        
        // Set the session message
        $_SESSION['msg'] = "Appointment canceled !!";

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

/*styling of the headers content in the dashboard starts*/

.dropdown_1 {
    position: absolute;
    right: 135px;
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
    border: none;
    cursor: pointer;
    color: white;
    padding: 0; /* Remove padding */
    font-size: 17px; /* Inherit font size */
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
    margin-right: 20px; 
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
    top: 60px; 
    bottom: 0;
    overflow-y: auto; /* Enable vertical scroll if content exceeds sidebar height */
    margin-top: 110px;
}

/* Main content */
main {
    flex: 1; /* Take remaining width */
    margin-left: 270px;
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

/* Table styles */
.table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

.table th,
.table td {
    border: 1px solid gray;
    padding: 8px;
    text-align: center;
    padding-right: 20px;
    background-color: lightgrey;
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
        <h2>DOCTOR | APPOINTMENT HISTORY</h2>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="color:red;"><?php echo isset($_SESSION['msg']) ? htmlentities($_SESSION['msg']) : ""; ?>
                    <?php $_SESSION['msg'] = ""; ?></p>

                    <?php echo htmlentities($_SESSION['msg']="");?></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="hidden-xs">Patient Name</th>
                                <th>Specialization</th>
                                <th>Consultancy Fee</th>
                                <th>Appointment Date / Time</th>
                                <th>Appointment Creation Date</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql=mysqli_query($conn,"select users.fullName as fname,appointment.*  from appointment join users on users.id=appointment.userId where appointment.doctorId='".$_SESSION['id']."'");
                                $cnt=1;
                                while($row=mysqli_fetch_array($sql))
                                {
                            ?>
                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>
                                <td class="hidden-xs"><?php echo $row['fname'];?></td>
                                <td><?php echo $row['doctorSpecialization'];?></td>
                                <td><?php echo $row['consultancyFees'];?></td>
                                <td><?php echo $row['appointmentDate'];?> / <?php echo $row['appointmentTime'];?></td>
                                <td><?php echo $row['postingDate'];?></td>
                                <td>
                                    <?php 
                                        if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                                        {
                                            echo "Active";
                                        }
                                        if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
                                        {
                                            echo "Cancel by Patient";
                                        }
                                        if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
                                        {
                                            echo "Cancel by you";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div>
                                        <?php 
                                            if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                                            {
                                        ?>
                                        <a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')" class="btn tooltips" title="Cancel Appointment" tooltip="Remove">Cancel</a>
                                        <?php 
                                            } 
                                            else 
                                            {
                                                echo "Canceled";
                                            } 
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                $cnt=$cnt+1;
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div><br>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> UHL | Designed by James Wekesa</p>
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
<?php ?>
<?php } ?>
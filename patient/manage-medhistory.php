<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');
include('../includes/check_login.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UHL</title>

    <style>
    /* Styling of the headers content in the dashboard starts */
    header {
        background-color: gray;
        padding: 40px;
        margin-bottom: 0;
    }

    .dropdown_1 {
        position: absolute;
        right: 60px;
    }

    .dropdown-content_1 a {
        color: white;
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
        background-color: darkgray;
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
        padding: 60px;
        margin-bottom: 0;
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
        margin-left: 200px;
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

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    main {
    margin-left: 350px;
    }


    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid gray;
    }

    th.center, td.center {
        text-align: center;
    }

   /* Table header styles */
    th {
    background-color: gainsboro;
    color: dimgray;
    }

    /* Table title styles */
    .title {
        margin-bottom: 20px;
    }

     /* Sidebar styling */
     aside {
            width: 20%;
            background-color: LightGray;
            padding: 20px;
            position: fixed; /* Fix the sidebar position */
            left: 0; /* Position it at the left */
            top: 90px; /* Add top margin to clear the header */
            bottom: 0; /* Stretch it to the bottom */
            overflow-y: auto; /* Allow vertical scrolling */
            margin-left: 9px;
        }

        aside ul {
            list-style: none; /* Remove default bullet points for list */
            align-items: center;
        }

        aside ul li {
            margin-bottom: 10px; /* Add bottom margin for spacing between items */
            display: flex; /* Use flexbox for alignment */
            align-items: center;
        }

        aside ul li a {
            color: black;
            text-decoration: none;
            font-size: 18px;
            display: inline-block; /* links and images align horizontally */
            margin-top: 50px;
            position: relative; /* Set position to relative */
        }

        aside ul li img {
            width: 25px;
            height: 25px;
            margin-right: 10px; /* Add some space between the logos and the text */
        }

        /* Media Query for Small Devices */
@media only screen and (max-width: 768px) {
    /* Adjust header padding */
    header {
        padding: 20px;
    }

    /* Adjust header title font size */
    header h1 {
        font-size: 24px;
    }

    /* Adjust dropdown position */
    .dropdown_1 {
        right: 10px;
    }

    /* Adjust main content margin */
    main {
        margin-left: 0;
    }

    /* Adjust aside width and margin */
    aside {
        width: 100%; /* Occupy full width */
        margin-left: 0; /* Remove left margin */
        position: static; /* Remove fixed positioning */
        top: auto; /* Remove top positioning */
        bottom: auto; /* Remove bottom positioning */
    }

    /* Adjust form group width */
    .form-group {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Adjust table margin */
    table {
        display: flex;
        flex-direction: column;
        margin-top: 10px; /* Add margin to separate from the aside */
    }

    tbody {
        display: flex;
        flex-direction: column;
    }

    tr {
        display: flex;
        flex-direction: row;
    }

    td {
        flex: 1;
        text-align: left;
        border-bottom: 1px solid gray;
    }

    /* Adjust footer padding */
    footer {
        padding: 10px;
    }
}

</style>


</head>

<body>

<?php
    // Check if session ID is set
    if(isset($_SESSION['id'])) {
        $query = mysqli_query($conn, "SELECT fullName FROM users WHERE id='" . $_SESSION['id'] . "'");
        while ($row = mysqli_fetch_array($query)) {
            $fullName = $row['fullName'];
        }
    } else {
        $fullName = "Guest"; // Default value if session ID is not set
    }
    ?>
    <header>
        <h1 style="text-align: center; color: black; margin: 5px;">Uzima Hospital Lab</h1>
        <div class="dropdown_1" style="text-align: center;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="img/images.jpg" style="margin-right: 10px; width: 50px; height: 50px;">
                <span class="username" style="color: white; text-decoration: none; margin-bottom: 30px;">
                    <?php echo $fullName; ?>
                </span>
            </a>
            <div class="dropdown-content_1">
                <a href="edit-profile.php">My profile</a>
                <a href="change-password.php">Change Password</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </header>

    <aside>
        <ul>
            <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
            <li><a href="book-appointment.php"><img src="img/book_appointment.png">Book Appointment</a></li>
            <li><a href="appointment-history.php"><img src="img/history.png">Appointment History</a></li>
            <li><a href="manage-medhistory.php"><img src="img/edit-profile.jpg">Medical History</a></li>
        </ul>
    </aside>

<div class="container">
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">View Medical History</h5>

                    <table class="table-hover">
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
                        $uid = $_SESSION['id'];
                        // Using prepared statement to prevent SQL injection
                        $stmt = $conn->prepare("SELECT tblpatient.*, users.id FROM tblpatient JOIN users ON users.email = tblpatient.PatientEmail WHERE users.id = ?");
                        $stmt->bind_param("i", $uid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $cnt = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="center"><?php echo $cnt; ?>.</td>
                                <td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
                                <td><?php echo $row['PatientContno']; ?></td>
                                <td><?php echo $row['PatientGender']; ?></td>
                                <td><?php echo $row['CreationDate']; ?></td>
                                <td><?php echo $row['UpdationDate']; ?></td>
                                <td>
                                    <a href="view-medhistory.php?viewid=<?php echo $row['ID']; ?>"></a>
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
        <p>Copyright &copy; <?php echo date("Y"); ?> Designed by James Wekesa</p>
    </div>
</footer>
</body>
</html>
<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">

    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            background-color: gray;
            padding: 60px;
            margin-bottom: 0;
        }

        .dropdown_1 {
            position: absolute;
            right: 50px;

        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 170px;
            background-color: gray;
            padding: 5px;
            padding-top: 10px;
            z-index: 1;
        }

        .dropdown-content_1 a {
            color: white;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
            font-size: 15px;
            border-bottom: 1px solid black;
        }
        .dropbtn_1{
            background-color: transparent;/*removes background color of the button*/
        }
        .dropbtn_1:hover{
            background-color: transparent/*removes background color on hover*/
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }
        /* Styling of the headers content in the dashboard ends */

        /* Adjusting footer padding */
        footer {
            background-color: gray;
            padding: 20px; /* Remove padding */
            text-align: center;
            color: black;
        }
        p{
            font-size: 17px;
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
    $fullName = "My profile"; // Default value if session ID is not set
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

    <div class="container">
        <aside>
            <ul>
                <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
                <li><a href="book-appointment.php"><img src="img/book_appointment.png">Book Appointment</a></li>
                <li><a href="appointment-history.php"><img src="img/history.png" >Appointment History</a></li>
                <li><a href="manage-medhistory.php"><img src="img/edit-profile.jpg">Medical History</a></li>

            </ul>
        </aside>

        <main>
            <!-- h2 em italicized -->
            <h2>PATIENT | DASHBOARD</em></h2>

            <!-- used grid to avoid the floating and positioning of divs. Grid layout offers Grid-based layout system, with rows and columns-->
            <div class="grid-container">
                
            <div class="grid-item Update-Profile">
                    <img src="img/edit-profile.jpg" alt="edit-profile">
                    <a href="edit-profile.php">Update Profile</a>
                </div>

                <div class="grid-item book">
                    <img src="img/book_image.png" alt="Book img">
                    <a href="book-appointment.php">Book Appointment</a>
                </div>
                
                <div class="grid-item history">
                    <img src="img/history.png" alt="History img">
                    <a href="appointment-history.php">View Appointment History</a>
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

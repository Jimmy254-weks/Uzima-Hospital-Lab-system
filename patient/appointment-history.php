<?php
session_start();
error_reporting(0);
include('db_connect.php');

if(empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Stop further script execution
} else {
    if(isset($_GET['cancel'])) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE appointment SET userStatus='0' WHERE id = ?");

        // Bind parameters
        $stmt->bind_param("i", $_GET['id']);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();

        $_SESSION['msg'] = "Your appointment is canceled successfully!";
    }
}
?>

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
            right: 160px;
        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 170px;
            background-color: gray;
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
            border-bottom: 1px solid black;
        }

        .dropdown_1:hover .dropdown-content_1 {
            display: block;
        }


        /* Styling of the headers content in the dashboard ends */


        footer {
            background-color: gray;
            padding: 15px;
            text-align: center;
            color: black;
        }

        p{
            font-size: 17px;
        }

        /* Fix header position */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
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

        /* Add margin to the sidebar */

        aside {
            position: fixed;
            top: 60px;
            left: 0;
            width: 200px;
            height: calc(100% - 90px);
            background-color: lightgray;
            padding: 20px;
            overflow-y: auto;
            margin-top: 65px;
            margin-right: 20px;
            margin-top: 100px;
        }

        /* Add margin to the main content */
        main {
            margin-left: 220px;
            margin-top: 40px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Add margin to separate from the heading */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid gray; /* Add border bottom for each row */
        }

        th.center, td.center {
            text-align: center;
        }

        /* Table header styles */
        th {
            background-color: gainsboro;
            color: dimgray;
            padding: 15px;
        }

        /* Button style */
        .btn {
            padding: 6px 12px;
            background-color: darkcyan;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
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
        <h2>PATIENT | APPOINTMENT HISTORY</em></h2>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="color:red;">
                        <?php
                        if(isset($_SESSION['msg'])) {
                            echo htmlentities($_SESSION['msg']);
                            $_SESSION['msg'] = ""; // Clear the session variable after displaying the message
                        }
                        ?>
                    </p>

                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Doctor Name</th>
                            <th>Specialization</th>
                            <th>Consultancy Fee</th>
                            <th>Appointment Date / Time </th>
                            <th>Appointment Creation Date  </th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql=mysqli_query($conn,"select doctors.doctorName as docname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId where appointment.userId='".$_SESSION['id']."'");
                        $cnt=1;
                        while($row=mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>
                                <td class="hidden-xs"><?php echo $row['docname'];?></td>
                                <td><?php echo $row['doctorSpecialization'];?></td>
                                <td><?php echo $row['consultancyFees'];?></td>
                                <td><?php echo $row['appointmentDate'];?> / <?php echo $row['appointmentTime'];?></td>
                                <td><?php echo $row['postingDate'];?></td>
                                <td>
                                    <?php
                                    if(($row['userStatus']==1) && ($row['doctorStatus']==1)) {
                                        echo "Active";
                                    }
                                    if(($row['userStatus']==0) && ($row['doctorStatus']==1)) {
                                        echo "Cancel by You";
                                    }
                                    if(($row['userStatus']==1) && ($row['doctorStatus']==0)) {
                                        echo "Cancel by Doctor";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div>
                                        <?php
                                        if(($row['userStatus']==1) && ($row['doctorStatus']==1)) {
                                            ?>
                                            <a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')" title="Cancel Appointment" tooltip="Remove">Cancel</a>
                                            <?php
                                        } else {
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
</div>

<footer>
    <div class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> Designed by James Wekesa</p>
    </div>
</footer>

</body>
</html>
<?php ?>

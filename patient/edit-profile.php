<?php
session_start();
error_reporting(0);
include('db_connect.php');
$msg = ""; // Define $msg variable to avoid undefined variable error

// Check if $_SESSION['id'] is set
if(isset($_SESSION['id'])) {
    if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $gender = $_POST['gender'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE users SET fullName=?, address=?, city=?, gender=? WHERE id=?");
        $stmt->bind_param("ssssi", $fname, $address, $city, $gender, $_SESSION['id']);

        // Execute the statement
        if($stmt->execute()) {
            $msg = "Your Profile updated Successfully";
        } else {
            $msg = "Failed to update profile";
        }

        // Close the statement
        $stmt->close();
    }

    // Debugging
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // User found
    } else {
        $msg = "User not found";
    }

} else {
    // Redirect or handle the case when $_SESSION['id'] is not set
    header("Location: patient_login.php");
    exit(); // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styling of the headers content in the dashboard starts */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: gray;
            padding: 60px;
            z-index: 1000;
        }

        .dropdown_1 {
            position: absolute;
            right: 150px; /* Align to the right */
        }

        .dropdown-content_1 {
            display: none;
            position: absolute;
            min-width: 163px;
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
            font-size: 17px;
            font-weight: bold;
        }

        .dropbtn_1:hover {
            background-color: transparent; /* Remove background color */
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

        /* Main content styling */
        .main-content {
            padding: 20px; /* Add padding for spacing */
            margin-left: 25%; /* Add left margin to accommodate the sidebar */
            margin-top: 90px;
            overflow-y: auto;
        }

        .panel-body {
            padding: 20px; /* Add padding for spacing */
        }

        /* Footer styling */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: gray;
            padding: 10px;
            text-align: center;
            color: black;
        }

    </style>
</head>
<body>

<div id="app">
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

    <div class="app-content">
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8"><br>
                            <h1 class="mainTitle" style="margin-top: 50px;">Patient | Edit Profile</h1>
                        </div>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="color: green; font-size:18px; ">
                                <?php echo htmlentities($msg); ?> </h5> <!-- Print $msg variable -->
                            <div class="row margin-top-30">
                                <div class="col-lg-8 col-md-12">
                                    <div class="panel panel-white">
                                        <div class="panel-body">
                                            <?php
                                            if(isset($_SESSION['id'])) { // Check if $_SESSION['id'] is set before using it
                                                $sql = mysqli_query($conn, "SELECT * FROM users WHERE id='".$_SESSION['id']."'");
                                                while($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                    <h4><?php echo htmlentities($data['fullName']);?>'s Profile</h4>
                                                    <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['regDate']);?></p>
                                                    <?php if($data['updationDate']){?>
                                                        <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
                                                    <?php } ?>
                                                    <hr style="border: 1px solid black;"/> <!-- creates a visual divider/line in the user profile section, making it easier to distinguish between different pieces of information -->
                                                    <form role="form" name="edit" method="post">
                                                        <div class="panel-heading">
                                                            <h5 class="panel-title">Edit Profile</h5>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <label for="fname">User Name:</label>
                                                            <input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']);?>" style="margin-top: 5px; margin-bottom: 5px;">
                                                        </div>
                                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <label for="address">Address:</label>
                                                            <textarea name="address" class="form-control" style="margin-top: 5px; margin-bottom: 5px;"><?php echo htmlentities($data['address']);?></textarea>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <label for="city">City:</label>
                                                            <input type="text" name="city" class="form-control" required="required"  value="<?php echo htmlentities($data['city']);?>" style="margin-top: 5px; margin-bottom: 5px;">
                                                        </div>
                                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <label for="gender">Gender:</label>
                                                            <select name="gender" class="form-control" required="required" style="margin-top: 5px; margin-bottom: 5px; width: 380px; height: 35px; border-radius: 5px;">
                                                                <option value="<?php echo htmlentities($data['gender']);?>"><?php echo htmlentities($data['gender']);?></option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <label for="fess">User Email:</label>
                                                            <input type="email" name="uemail" class="form-control" readonly="readonly"  value="<?php echo htmlentities($data['email']);?>" style="margin-top: 5px; margin-bottom: 5px;">
                                                            <a href="change-emaild.php" style="margin-top: 5px; display: block; text-decoration: none;">Update your email id</a>
                                                        </div>
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary" style="background-color: dodgerblue; border-radius: 5px; padding: 5px; width: 80px; border: none; cursor: pointer;">Update</button>
                                                    </form>
                                                    <br><br>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <footer>
        <div class="footer">
            <p>All Rights reserved &copy; 2024 - Uzima Hospital Lab</p>
        </div>
    </footer>
</div>
</body>
</html>

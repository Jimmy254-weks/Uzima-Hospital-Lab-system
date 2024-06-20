<?php
session_start();
error_reporting(0);
include('../includes/db_connect.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

//updating Admin Remark
if(isset($_POST['update']))
		  {
$qid=intval($_GET['id']);
$adminremark=$_POST['adminremark'];
$isread=1;
$query=mysqli_query($conn,"update tblcontactus set  AdminRemark='$adminremark',IsRead='$isread' where id='$qid'");
if($query){
echo "<script>alert('Admin Remark updated successfully.');</script>";
echo "<script>window.location.href ='read-query.php'</script>";
}
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
        font-size: 16px;
        cursor: pointer;
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

    /* Table style */
    .patient-table {
        width: 100%;
        border-collapse: collapse;
    }

    .patient-table th {
        background-color: LightGray;
        border: 1px solid LightGray;
        padding: 8px;
        text-align: left;
    }

    /* Table body */
    .patient-table td {
        border: 1px solid LightGray;
        padding: 8px;
    }

    /* Action button */
    .view-button {
        background-color: RoyalBlue;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .view-button:hover {
        background-color: DarkBlue;
    }

    /* Table style */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    /* Table header */
    .custom-table th {
        border: 1px solid gray;
        padding: 8px;
        text-align: left;
    }

    /* Table body */
    .custom-table td {
        border: 1px solid gray;
        padding: 8px;
    }

    /* Center-align text in the 'center' column */
    .custom-table .center {
        text-align: center;
    }

    /* Hide cells with the 'hidden' class */
    .custom-table .hidden {
        display: none;
    }

    /* Style for the 'visible' class */
    .custom-table .visible {
        display: block;
    }

    /* Adjust spacing */
    .container {
        padding-top: 20px;
    }

    /* Style for the form control */
    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid lightgray;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
    }

    /* Style for the button */
    .btn-primary {
        background-color: seagreen;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    h5 {
        font-size: 25px;
        margin-left: 15px;
        margin-top: 20px;
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
                    <div class="col">
                        <h5 class="title">Manage Query Details</h5>
                        <hr />
                        <table class="custom-table">
                            <tbody>
                                <?php
                                $qid=intval($_GET['id']);
                                $sql=mysqli_query($conn,"select * from tblcontactus where id='$qid'");
                                $cnt=1;
                                while($row=mysqli_fetch_array($sql))
                                {
                                ?>
                                <tr>
                                    <th>Full Name</th>
                                    <td><?php echo $row['fullname'];?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $row['email'];?></td>
                                </tr>
                                <tr>
                                    <th>Contact No.</th>
                                    <td><?php echo $row['contactno'];?></td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td><?php echo $row['message'];?></td>
                                </tr>
                                <tr>
                                    <th>Query Date</th>
                                    <td><?php echo $row['PostingDate'];?></td>
                                </tr>
                                <?php if($row['AdminRemark']==""){?>
                                <form name="query" method="post">
                                    <tr>
                                        <th>Admin Remark</th>
                                        <td><textarea name="adminremark" required="true"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>    
                                            <button type="submit" class="btn-primary" name="update">
                                                Update 
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                                <?php } else {?>
                                <tr>
                                    <th>Admin Remark</th>
                                    <td><?php echo $row['AdminRemark'];?></td>
                                </tr>
                                <tr>
                                    <th>Last Update Date</th>
                                    <td><?php echo $row['LastupdationDate'];?></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
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
<?php } ?>

<?php
// Including the database connection file
include('db_connect.php');

// Checking if the specilizationid is not empty (isset and not null)
if (!empty($_POST["specilizationid"])) {
    // Assigning the value of specilizationid to a variable
    $specilizationid = $_POST["specilizationid"];
    // Preparing a SQL statement with a placeholder for the specilizationid
    $stmt = $conn->prepare("SELECT doctorName, id FROM doctors WHERE specilization = ?");
    // Binding the value of specilizationid to the prepared statement. 's' repr string parameter
    $stmt->bind_param("s", $specilizationid);
    // Executing the prepared statement
    $stmt->execute();
    // Getting the result set from the executed statement
    $result = $stmt->get_result();
    ?>
    <!-- Outputting a default option for the dropdown -->
    <option selected="selected">Select Doctor</option>
    <?php
    // Looping through the result set and outputting options for the dropdown
    while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Outputting options for the dropdown with doctor names and IDs -->
        <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['doctorName']); ?></option>
        <?php
    }
    // Closing the prepared statement
    $stmt->close();
}

// Checking if the doctor ID is not empty (isset and not null)
if (!empty($_POST["doctor"])) {
    // Assigning the value of the doctor ID to a variable
    $doctor_id = $_POST["doctor"];
    // Preparing a SQL statement with a placeholder for the doctor ID
    $stmt = $conn->prepare("SELECT docFees FROM doctors WHERE id = ?");
    // Binding the value of the doctor ID to the prepared statement 'i' repr interger
    $stmt->bind_param("i", $doctor_id);
    // Executing the prepared statement
    $stmt->execute();
    // Getting the result set from the executed statement
    $result = $stmt->get_result();
    // Looping through the result set and outputting options for the dropdown
    while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Outputting options for the dropdown with doctor fees -->
        <option value="<?php echo htmlentities($row['docFees']); ?>"><?php echo htmlentities($row['docFees']); ?></option>
        <?php
    }
    // Closing the prepared statement
    $stmt->close();
}
?>

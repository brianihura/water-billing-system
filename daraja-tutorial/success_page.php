<?php
session_start();

// Check if the user is logged in and the sensor ID is set in the session
if(isset($_SESSION['user_id']) && isset($_SESSION['sensor_id'])) {
    // Connect to the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "waterbilllng";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update the amount and readings_value to 0 where sensor_id matches the one in the session
    $sensor_id = $_SESSION['sensor_id'];
    $sql = "UPDATE sensor_readings SET amount = 0, readings_value = 0 WHERE sensor_id = '$sensor_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Amount and readings_value updated successfully";
        header("readme.md/client.html"); // Redirect to dashboard or another authenticated page
        exit();
    } else {
        echo "Error updating amount and readings_value: " . $conn->error;
    }

    $conn->close();
} else {
    echo "User not logged in or sensor ID not set in session";
}
?>

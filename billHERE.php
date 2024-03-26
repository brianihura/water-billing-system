<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "waterbilllng"; // Corrected database name

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is okay";

if (isset($_POST["sensor_id"]) && isset($_POST["sensor_value"])) {

    $sensor_id = mysqli_real_escape_string($conn, $_POST["sensor_id"]); // Sanitize user input
    $sensor_value = floatval($_POST["sensor_value"]); // Convert to float
    $sensor_value = mysqli_real_escape_string($conn, $sensor_value); // Sanitize user input

    // Check if a row with the sensor_id already exists in the sensor_readings table
    $sql_check = "SELECT * FROM sensor_readings WHERE sensor_id = '$sensor_id'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // If a row exists, update the existing row
        $amount = $sensor_value * 10; // Assuming $12 per unit
        $sql_update = "UPDATE sensor_readings SET readings_value = '$sensor_value', amount = '$amount' WHERE sensor_id = '$sensor_id'";
        if (mysqli_query($conn, $sql_update)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}

?>

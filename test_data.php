<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "waterbilllng";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is okay";

if (isset($_POST["sensor_id"]) && isset($_POST["sensor_value"])) {

    $sensor_id = mysqli_real_escape_string($conn, $_POST["sensor_id"]); // Sanitize user input
    $sensor_value = floatval($_POST["sensor_value"]); // Convert to float
    $sensor_value = mysqli_real_escape_string($conn, $sensor_value); // Sanitize user input
    
    // Calculate amount to pay (assuming $12 per unit)

    $sql = "INSERT INTO sensor_readings (sensor_id, readings_value) VALUES ('$sensor_id', '$sensor_value')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>
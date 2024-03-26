<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "waterbilllng";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from ESP32
$data = json_decode(file_get_contents('php://input'), true);

// Insert data into the database
$sql = "INSERT INTO sensor_data (sensor_readings) VALUES ('" . $data['sensor_readings'] . "')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>

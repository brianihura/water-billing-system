<?php
// Database connection parameters
$servername = "local host";
$username = "root";
$password = "";
$dbname = "waterbilling";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve water usage data
$sql = "SELECT * FROM water_usage";
$result = $conn->query($sql);

// HTML report header
echo "<h2>Water Usage Report</h2>";
echo "<table border='1'><tr><th>Customer ID</th><th>Date</th><th>Usage Volume</th></tr>";

// Loop through the result set
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["date"] . "</td><td>" . $row["usage_volume"] . "</td></tr>";
}

// HTML report footer
echo "</table>";

// Close the database connection
$conn->close();
?>

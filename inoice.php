<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database (replace with your actual query)
$customerId = 1; // Replace with the actual customer ID
$sql = "SELECT * FROM water_usage WHERE customer_id = $customerId";
$result = $conn->query($sql);

// HTML invoice header
echo "<h2>Water Usage Invoice</h2>";
echo "<table border='1'><tr><th>Date</th><th>Usage Volume</th></tr>";

// Loop through the result set
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["date"] . "</td><td>" . $row["usage_volume"] . "</td></tr>";
}

// HTML invoice total (replace with your own calculation logic)
echo "<tr><td>Total</td><td>" . calculateTotalUsage($result) . "</td></tr>";

// HTML invoice footer
echo "</table>";

// Close the database connection
$conn->close();

// Function to calculate total usage (replace with your own logic)
function calculateTotalUsage($result) {
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += $row["usage_volume"];
    }
    return $total;
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $location = $_POST["location"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $servername = "localhost";
    $username = "root"; // Replace with your database username 
    $password_db = ""; // Replace with your database password
    $database = "waterbilllng"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password_db, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        // Email already exists, redirect to exists.html
        header("Location: signup.html");
        exit();
    }

    // Email doesn't exist, proceed with the registration
    $insert_user_sql = "INSERT INTO users (phone, user_name, email, user_location, pass_w) VALUES ('$phone', '$name', '$email', '$location', '$hashed_password')";

    if ($conn->query($insert_user_sql) === TRUE) {
        // Get the user_id of the inserted user
        $user_id = $conn->insert_id;

        // Insert a new row in the sensors table associated with the user_id
        $insert_sensor_sql = "INSERT INTO sensors (sensor_name, user_id) VALUES ('$name Sensor', '$user_id')";
        if ($conn->query($insert_sensor_sql) === TRUE) {
            // Get the sensor_id of the inserted sensor
            $sensor_id = $conn->insert_id;

            // Insert a new row in the sensor_readings table with the corresponding sensor_id
            $insert_reading_sql = "INSERT INTO sensor_readings (sensor_id, readings_value) VALUES ('$sensor_id', 0)";
            if ($conn->query($insert_reading_sql) === TRUE) {
                $_SESSION["username"] = $name;
                $_SESSION["email"] = $email;
                header("Location: login.html"); // Redirect to dashboard or another authenticated page
                exit();
            } else {
                echo "Error inserting sensor reading: " . $conn->error;
            }
        } else {
            echo "Error inserting sensor: " . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $conn->error;
    }

    $conn->close();
}
?>

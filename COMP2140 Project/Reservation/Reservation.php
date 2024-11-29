<?php
// Database credentials
$servername = 'localhost'; 
$username = 'root'; 
$password = ''; 
$dbname = 'EAGLE'; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get Date from post request

// Retrieve and sanitize inputs
$date = isset($_POST['date']) ? filter_var($_POST['date'], FILTER_SANITIZE_STRING) : '';
$time = isset($_POST['time']) ? filter_var($_POST['time'], FILTER_SANITIZE_STRING) : '';

// Validate date format (Y-m-d)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    $date = ''; // Invalid date format, reset to empty
}

// Validate time format (H:i)
if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
    $time = ''; // Invalid time format, reset to empty
}

// Prepare the SQL query
$sql = "INSERT INTO eaglereservation (ResDate, ResTime) VALUES ('$date', '$time')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    $response = [
        "status" => "200",
        "status1" => "success",
        "message" => "Feedback saved successfully!"
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => "error",
        "message" => "Error: " . $sql . "<br>" . $conn->error
    ];
    echo json_encode($response);
}

$conn->close();

?>
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

// Get feedback from POST request
$feedback = isset($_POST['feedback']) ? $_POST['feedback'] : '';
$date = date("Y-m-d");  // Current date
$time = date("H:i:s");  // Current time

// Sanitize the feedback input to prevent SQL injection
$feedback = $conn->real_escape_string($feedback);

// Prepare the SQL query
$sql = "INSERT INTO eaglefeedback (FeedBack, FeedDate, FeedTime) VALUES ('$feedback', '$date', '$time')";

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

<?php
$servername = "localhost";
$username = "root";
$password = ""; // Empty by default in XAMPP
$dbname = "eagle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful!";
}
?>

<?php

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$month = $input['month'];
$year = $input['year'];

if (!$month || !$year || $month < 1 || $month > 12) {
    echo json_encode(['error' => 'Invalid month or year']);
    exit;
}

$host = "localhost";
$username = "users";
$password = "password123";
$dbname = "EAGLE";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Call the stored procedure
$sql = "CALL GenerateFinancialReport(?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $month, $year);
$stmt->execute();

// Fetch the results
$reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->next_result(); // Move to the next result set
$totalRevenue = $stmt->get_result()->fetch_assoc();

// Close the connection
$stmt->close();
$conn->close();

// Return the report data as JSON
echo json_encode([
    'ReportMonthYear' => $totalRevenue['ReportMonthYear'],
    'TotalRevenue' => $totalRevenue['TotalRevenue'],
    'Reservations' => $reservations
]);
?>

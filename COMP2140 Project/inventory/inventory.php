<?php
// Database connection setup
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";      // Default for XAMPP (empty password)
$dbname = "Eagle";   // Make sure this matches the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Handle requests based on the method (GET, POST, PUT, DELETE)
switch ($method) {
    case 'GET':
        // Fetch inventory items
        $query = "SELECT InvID, Item, Colour, Grade, Price FROM Eagle.EagleInventory";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $inventory = [];
            while ($row = $result->fetch_assoc()) {
                $inventory[] = $row;
            }
            echo json_encode($inventory);
        } else {
            echo json_encode([]);
        }
        break;

    case 'POST':
        // Add new item to inventory
        $data = json_decode(file_get_contents("php://input"));
        $item = $data->Item;
        $colour = $data->Colour;
        $grade = $data->Grade;
        $price = $data->Price;

        $query = "INSERT INTO Eagle.EagleInventory (Item, Colour, Grade, Price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $item, $colour, $grade, $price);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Item added successfully']);
        } else {
            echo json_encode(['error' => 'Error adding item']);
        }
        $stmt->close();
        break;

    case 'PUT':
        // Update existing item in inventory
        $invID = $_GET['InvID'];  // Get InvID from the URL
        $data = json_decode(file_get_contents("php://input"));
        $item = $data->Item;
        $colour = $data->Colour;
        $grade = $data->Grade;
        $price = $data->Price;

        $query = "UPDATE Eagle.EagleInventory SET Item = ?, Colour = ?, Grade = ?, Price = ? WHERE InvID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssiii", $item, $colour, $grade, $price, $invID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Item updated successfully']);
        } else {
            echo json_encode(['error' => 'Error updating item']);
        }
        $stmt->close();
        break;

    case 'DELETE':
        // Delete item from inventory
        $invID = $_GET['InvID'];  // Get InvID from the URL

        $query = "DELETE FROM Eagle.EagleInventory WHERE InvID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $invID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Item deleted successfully']);
        } else {
            echo json_encode(['error' => 'Error deleting item']);
        }
        $stmt->close();
        break;

    default:
        echo json_encode(['error' => 'Invalid HTTP method']);
        break;
}

// Close connection
$conn->close();
?>

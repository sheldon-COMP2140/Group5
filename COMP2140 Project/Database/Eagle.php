<!-- <?php
// mysql_connect(
//     string $server = ini_get("mysql.default_host"),
//     string $username = ini_get("mysql.default_user"),
//     string $password = ini_get("mysql.default_password"),
//     bool $new_link = false,
//     int $client_flags = 0
// ): resource|false

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE Eagle";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

// sql to create table
$sql = "CREATE TABLE `Eagle`.EagleAccount (UserID int NOT NULL, Fname varchar(255) NOT NULL, Lname varchar(255) not null, DOB date, Telephone varchar(11) not null, email varchar(255) not null, Password varchar(255) not null, IsAdmin boolean not null, IsOwner boolean not null, KEY (UserID)";
    if ($conn->query($sql) === TRUE) {
      echo "Table MyGuests created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.EagleGeneratedCost (TransactionID int not null, Price int NOT NULL, KEY (TransactionID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.EagleReservation (ResID int not null, ResDate date not null, ResTime Time not null, Key (ResID;";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.EagleInventory (InvID int not null, Item varchar(255), Colour varchar(255), Grade int not null, Price int not null, Key (InvID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.EgleFeedback (FeedID int not null, FeedBack text not null, FeedDate date not null, FeedTime time not null, Key (FeedID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.Book (ResID int not null, UserID int NOT NULL, KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE  `Eagle`.Needs (ResID int not null, TransactionID int NOT NULL, KEY (ResID, TransactionID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
$sql = "CREATE TABLE  `Eagle`.Generate (TransactionID int not null, UserID int NOT NULL, KEY (TransactionID, UserID ), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE  `Eagle`.Gives (ResID int not null, UserID int NOT NULL, KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE  `Eagle`.Adds (InvID int not null, UserID int NOT NULL, KEY (InvID, UserID), FOREIGN KEY (InvID) REFERENCES EagleInventory(InvID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID)";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$conn->close();
?> -->
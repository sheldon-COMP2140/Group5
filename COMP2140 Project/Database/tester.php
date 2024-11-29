<?php
$host = "localhost";
$adminUser = "root";
$adminPassword = "";

// Connect as an admin
try {
    $pdo = new PDO("mysql:host=$host", $adminUser, $adminPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create Database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS my_database");
    
    // Create User
    $pdo->exec("CREATE USER 'new_user'@'localhost' IDENTIFIED BY 'password123'");
    $pdo->exec("GRANT ALL PRIVILEGES ON my_database.* TO 'new_user'@'localhost'");

    // Connect to the new database
    $pdo = new PDO("mysql:host=$host;dbname=my_database", "new_user", "password123");

    // Create Table
    $pdo->exec("CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    echo "Database, user, and table created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
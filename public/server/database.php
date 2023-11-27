<?php

// Use environment variables for sensitive information
$host = 'invite-db';
$database = 'invite';
$username = 'admin';
$password = 'password_here';

function createDatabaseConnection($host, $database, $username, $password) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Log the error instead of displaying it
        error_log('Connection failed: ' . $e->getMessage());
        // Display a generic error message to the user
        echo 'Database connection error. Please try again later.';
    }
}

function checkAndCreateTable($pdo, $database) { // Added $database parameter
    $query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = :database AND table_name = 'waitlist'";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute(['database' => $database]); // Use the passed parameter
        $tableExists = $stmt->fetchColumn();

        if (!$tableExists) {
            $createQuery = "CREATE TABLE waitlist (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                x_username VARCHAR(255) NOT NULL UNIQUE,
                                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                status ENUM('pending', 'accepted', 'invited') NOT NULL DEFAULT 'pending',
                                invite_code VARCHAR(255) UNIQUE,
                                invited_at TIMESTAMP NULL
                            )";
            $pdo->exec($createQuery);
            echo "Table 'waitlist' created successfully.";
        }
    } catch (PDOException $e) {
        // Log and display error message
        error_log('Check/Create table failed: ' . $e->getMessage());
        echo 'Error checking or creating table. Please try again later.';
    }
}

$pdo = createDatabaseConnection($host, $database, $username, $password);
checkAndCreateTable($pdo, $database);
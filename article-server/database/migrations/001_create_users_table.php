<?php
require_once __DIR__ . '/../connection.php';

function migrate_users() {
    global $conn;
    
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        FN VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Users table created successfully\n";
        return true;
    } else {
        echo "Error creating users table: " . $conn->error . "\n";
        return false;
    }
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    migrate_users();
}
?>

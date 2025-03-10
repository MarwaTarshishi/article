<?php
require_once __DIR__ . '/../connection.php';

function migrate_questions() {
    global $conn;
    
    $sql = "CREATE TABLE IF NOT EXISTS questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question TEXT NOT NULL,
        answer TEXT NOT NULL ,
        category varchar NOT NULL ,
        
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Questions table created successfully\n";
        return true;
    } else {
        echo "Error creating questions table: " . $conn->error . "\n";
        return false;
    }
}


if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    migrate_questions();
}
?>

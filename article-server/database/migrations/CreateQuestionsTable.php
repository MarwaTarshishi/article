<?php

    require("../../Connection/connection.php");

    class CreateQuestionTable{

        public static function create_questions_table($conn) {

            $query = "CREATE TABLE IF NOT EXISTS questions (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      question TEXT NOT NULL,
                      answer TEXT NOT NULL
            );";
            
            if($conn->query($query))
                echo 'table "questions" was successfully created';
            else
                echo 'table "questions" was not successfully created' . $conn->error . "\n";
        }

    }

?>

<?php

    require("../../Connection/connection.php");

    class CreateUsersTable{

        public static function create_users_table($conn) {

            $query = "CREATE TABLE IF NOT EXISTS users (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      FN VARCHAR(50) NOT NULL,
                      email VARCHAR(255) NOT NULL UNIQUE,
                      password TEXT NOT NULL
            );";
            
            if($conn->query($query))
                echo 'table "users" was successfully created';
            else
                echo 'table "users" was not successfully created';
        }

    }

?>

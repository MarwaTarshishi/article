<?php

    require_once("UserSkeleton.php");
    require_once(__DIR__ . '/../utils/utilities.php');


    class User {

        public static function checkEmail($email, $conn) {
            //checking if email already exists
            $query = $conn->prepare("SELECT email FROM users WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $query->store_result();
            $result = $query->num_rows > 0; //result is a boolean and it's true if there are rows in the query
            $query->close();
            return $result;
        }

        public static function checkPassword($password) {
                
            return strlen($password) >= 8;
        }

        public static function createUser($UserSkeleton, $conn) {
            //checking if the email already exists and if the password meets the conditions
            if(User::checkEmail($UserSkeleton->get_email(), $conn) === false 
                && User::checkPassword($UserSkeleton->get_password()) === true) {
                //inserting the data of the user object into the db
                $full_name = $UserSkeleton->get_fullName();
                $email = $UserSkeleton->get_email();
                $password = $UserSkeleton->get_password();
                $query = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES(?, ?, ?);");
                $query->bind_param("sss", $full_name, $email, $password);
                $query->execute();
                $query->close();
            }else
                Utilities::response("Failed", "Couldn't create user");    
        }

        public static function updateUser($UserSkeleton, $conn) {
            //checks for the password then updates both the password and the fullname
            //where email stays the same and user can't update the email
            if(User::checkPassword($UserSkeleton->get_password()) === true) {

                $full_name = $UserSkeleton->get_fullName();
                $email = $UserSkeleton->get_email();
                $password = $UserSkeleton->get_password();

                $query = $conn->prepare("UPDATE users SET full_name = ?, password = ? WHERE email = ?");
                $query->bind_param("sss", $full_name,
                                        $password,
                                        $email);
                $query->execute();
                $query->close();
            }
        }

        public static function readUser($UserSkeleton, $conn) {

            $email = $UserSkeleton->get_email();

            $query = $conn->prepare("SELECT full_name, email FROM users WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user;
            }
            $query->close();
            return null;
        }

        public static function deleteUser($UserSkeleton, $conn) {

            $email = $UserSkeleton->get_email();

            //chose to delete by email to take advantage of the userskeleton class and use it.
            $query = $conn->prepare("DELETE FROM users WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $query->close();
        }
    }

?>

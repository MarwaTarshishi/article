<?php

    class UserSkeleton{

        private $FN;
        private $email;
        private $password;

        function __construct($FN, $email, $password) {
            $this->FN = $FN;
            $this->set_email($email);
            $this->password = hash('sha256', $password);
        }
        
        function get_FN() {
            return $this->FN;
        }

        function get_email() {
            return $this->email;
        }
        
        function get_password() {
            return $this->password;
        }

        function set_FN($FN) {
            $this->full_name = $full_name;
        }

        private function checkEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        function set_email($email) {
            if($this->checkEmail($email))
                $this->email = $email;
            else
                throw new Exception("Invalid email format");
        }

        function set_password($password) {
            $this->password = $password;
        }
    }
?>

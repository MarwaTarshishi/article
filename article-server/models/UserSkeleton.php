<?php
class UserSkeleton {
    public $id;
    public $FN; 
    public $email;
    public $password;
    
    public function __construct($FN = "", $email = "", $password = "") {
        $this->FN = $FN;
        $this->email = $email;
        $this->password = $password;
    }
}
?>

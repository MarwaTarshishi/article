<?php
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/UserSkeleton.php';

class User extends UserSkeleton {
    
    public function save() {
        global $conn;
        
        //hash password for security 
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (FN, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->FN, $this->email, $hashed_password);
        
        if ($stmt->execute()) {
            $this->id = $stmt->insert_id;
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
    
    public static function findById($id) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT id, FN, email FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user = new User($row['FN'], $row['email']);
            $user->id = $row['id'];
            $stmt->close();
            return $user;
        } else {
            $stmt->close();
            return null;
        }
    }
    
    
    public static function findByEmail($email) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT id, FN, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user = new User($row['FN'], $row['email']);
            $user->id = $row['id'];
            $user->password = $row['password'];
            $stmt->close();
            return $user;
        } else {
            $stmt->close();
            return null;
        }
    }
    
    
    public static function authenticate($email, $password) {
        $user = self::findByEmail($email);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        
        return null;
    }
    
    
    public static function getAll() {
        global $conn;
        
        $result = $conn->query("SELECT id, FN, email FROM users");
        $users = [];
        
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['FN'], $row['email']);
            $user->id = $row['id'];
            $users[] = $user;
        }
        
        return $users;
    }
    
    
    public function update() {
        global $conn;
        
        $stmt = $conn->prepare("UPDATE users SET FN = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $this->FN, $this->email, $this->id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
    public function delete() {
        global $conn;
        
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}
?>

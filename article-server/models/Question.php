<?php
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/QuestionSkeleton.php';

class Question extends QuestionSkeleton {
    
    public function save() {
        global $conn;
        
        $stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->question, $this->answer);
        
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
        
        $stmt = $conn->prepare("SELECT id, question, answer FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $question = new Question($row['question'], $row['answer']);
            $question->id = $row['id'];
            $stmt->close();
            return $question;
        } else {
            $stmt->close();
            return null;
        }
    }
    
    
    public static function getAll() {
        global $conn;
        
        $result = $conn->query("SELECT id, question, answer FROM questions");
        $questions = [];
        
        while ($row = $result->fetch_assoc()) {
            $question = new Question($row['question'], $row['answer']);
            $question->id = $row['id'];
            $questions[] = $question;
        }
        
        return $questions;
    }
    
    
    public function update() {
        global $conn;
        
        $stmt = $conn->prepare("UPDATE questions SET question = ?, answer = ? WHERE id = ?");
        $stmt->bind_param("ssi", $this->question, $this->answer, $this->id);
        
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
        
        $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
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

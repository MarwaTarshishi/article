<?php
    require_once("QuestionSkeleton.php");
    class Question{

        public static function createQuestion($QuestionSkeleton, $conn) {
            $query = $conn->prepare("INSERT INTO questions (question, answer, category ) VALUES(?, ?, ? );");
            $query->bind_param("ss", $QuestionSkeleton->get_question(),
                                      $QuestionSkeleton->get_answer());
                                      $QuestionSkeleton->get_category());
            $query->execute();
            $query->close();
        }

        public static function readQuestion($QuestionSkeleton, $conn) {
            $query = $conn->prepare("SELECT question, answer  FROM questions WHERE question = ? AND answer = ?");
            $query->bind_param("ss", $QuestionSkeleton->get_question(),
                                      $QuestionSkeleton->get_answer());
                                      $QuestionSkeleton->get_category());
            $query->execute();
            $result = $query->get_result();
            if($result->num_rows > 0)
                return $result->fetch_assoc();

            $query->close();
            return null;
        }

        public static function deleteQuestion($QuestionSkeleton, $conn) {
            $query = $conn->prepare("DELETE FROM questions WHERE question = ? AND answer = ?");
            $query->bind_param("ss", $QuestionSkeleton->get_question(),
                                      $QuestionSkeleton->get_answer());
                                      $QuestionSkeleton->get_category());
            
            $query->execute();
            $query->close();
        }
    }
?>

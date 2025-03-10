<?php
    class QuestionSkeleton{
        private $question;
        private $answer;
        private $category;
        
        function __construct($question, $answer) {
            $this->question = $question;
            $this->answer = $answer;
            $this->category = $category;
        }
        function get_question() {
            return $this->question;
        }
        function get_answer() {
            return $this->answer;
        }
        function get_category() {
            return $this->category;
        }
          function set_question($question) {
            $this->question = $question;
        }
        function set_answer($answer) {
            $this->question = $answer;
        }
        function set_category($category) {
            $this->category = $category;
        }
    }
?>

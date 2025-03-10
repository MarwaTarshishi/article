<?php
    class QuestionSkeleton{
        private $question;
        private $answer;
        
        function __construct($question, $answer) {
            $this->question = $question;
            $this->answer = $answer;
        }
        function get_question() {
            return $this->question;
        }
        function get_answer() {
            return $this->answer;
        }
        function set_question($question) {
            $this->question = $question;
        }
        function set_answer($answer) {
            $this->answer = $answer;
        }
    }
?>

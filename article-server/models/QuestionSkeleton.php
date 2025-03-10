<?php
class QuestionSkeleton {
    public $id;
    public $question;
    public $answer;
    
    public function __construct($question = "", $answer = "") {
        $this->question = $question;
        $this->answer = $answer;
    }
}
?>

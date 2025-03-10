<?php
    require("../../Connection/connection.php");
    require_once("../../Models/QuestionSkeleton.php");
    require("../../utils/utilities.php");
    require("../../Models/Question.php");

    if(empty($_GET["question"]) || empty($_GET["answer"])) {
        http_response_code(400);

        Utilities::response("Failed", "Question and answer are required");
    }

    $question = $_GET["question"];
    $answer = $_GET["answer"];
    $category =$_GET["category"]

    try {
        $question_obj = new QuestionSkeleton($question, $answer);
        Question::createQuestion($question_obj, $conn);

        Utilities::response("Succeed", "Question got inserted into the Database");
    } catch (Throwable $e) {
        http_response_code(400);

        Utilities::response("Failed", $e->getMessage());
    }

?>

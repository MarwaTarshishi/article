<?php

    require("../../Connection/connection.php");
    require("../../utils/utilities.php");
    require("../../Models/Question.php");

    if(!isset($_GET["question"]) || empty(trim($_GET["question"]))) {
        try {
            $query = $conn->prepare("SELECT * FROM questions");
            $query->execute();

            $result = $query->get_result();
            $questions = $result->fetch_all(MYSQLI_ASSOC);

            Utilities::response("Succeed got all", $questions);
        } catch(Throwable $e) {
            http_response_code(401);

            Utilities::response("Failed", "error while getting questions: " . $e);
        }
    } else if(isset($_GET["question"])) {
        $search = "%" . $_GET["question"] . "%";

        $query = $conn->prepare("SELECT * FROM questions WHERE question LIKE ?");
        $query->bind_param("s", $search);
        $query->execute();

        $result = $query->get_result();
        $questions = $result->fetch_all(MYSQLI_ASSOC);

        if($result->num_rows > 0)
            Utilities::response("Succeed got searched", $questions);
        else
            Utilities::response("Failed", "Couldn't find question");

    }
?>

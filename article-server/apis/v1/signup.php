<?php

    require("../../Connection/connection.php");
    require_once("../../Models/UserSkeleton.php");
    require("../../utils/utilities.php");
    require("../../Models/User.php");

    $body = json_decode(file_get_contents("php://input"), true);

    if(!isset($body["full_name"]) || !isset($body["email"]) || !isset($body["password"])) {
        http_response_code(400);

        Utilities::response("Failed", "missing input");
    }

    try {
        $user_object = new UserSkeleton($body["full_name"], $body["email"], $body["password"]);
        User::createUser($user_object, $conn);

        Utilities::response("Succeed", $user);
    } catch(Throwable $e) {
        http_response_code(400);

        Utilities::response("Failed", $e);
    }

?>

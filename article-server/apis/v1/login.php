<?php

    require("../../Connection/connection.php");
    require("../../utils/utilities.php");

    
    $body = json_decode(file_get_contents("php://input"), true);

    if(!isset($body["email"]) || !isset($body["password"])) {
        http_response_code(400);
        
        Utilities::response("Failed", "email and password are required");
    }

    $email = $body["email"];
    $password = $body["password"];

    try {
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();

        $result = $query->get_result();
        $user = $result->fetch_assoc();
        $hashed_password = hash('sha256', $password);

        if($hashed_password === $user["password"])
            Utilities::response("Succeed", $user);
        else {
            http_response_code(401);

            Utilities::response("Failed", "invalid credentials");
        }
    } catch(Throwable $e) {
        http_response_code(400);

        Utilities::response("Failed", $e);
    }

?>

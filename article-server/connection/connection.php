<?php

    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "article";
    $port = 3307;

    $conn = new mysqli($host, $user, $password, $db_name, $port);

    if($conn->connect_error)
        die("connection failed" . mysqli_connect_error());

?>

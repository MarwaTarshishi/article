<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../models/User.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}


$data = json_decode(file_get_contents("php://input"), true);


if (empty($data['fullName']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Please provide full name, email, and password"]);
    exit;
}


$existingUser = User::findByEmail($data['email']);
if ($existingUser) {
    http_response_code(409); 
    echo json_encode(["status" => "error", "message" => "User with this email already exists"]);
    exit;
}


$user = new User($data['fullName'], $data['email'], $data['password']);


if ($user->save()) {
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "User registered successfully",
        "user" => [
            "id" => $user->id,
            "fullName" => $user->FN, 
            "email" => $user->email
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to register user"]);
}
?>

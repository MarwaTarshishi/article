<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../models/Question.php';
require_once __DIR__ . '/../../utils/auth_utils.php';

session_start(); 


function isLoggedIn() {
    return isset($_SESSION['user_id']); 
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}


if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "You must be logged in to add questions"
    ]);
    exit;
}

// Decode the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['question']) || empty($data['question']) || !isset($data['answer']) || empty($data['answer'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid input. Both question and answer are required."]);
    exit;
}

// Create a new question object
$question = new Question($data['question'], $data['answer']);

// Attempt to save the question
if ($question->save()) {
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Question created successfully",
        "question" => [
            "id" => $question->id,
            "question" => $question->question,
            "answer" => $question->answer
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to create question"]);
}
?>

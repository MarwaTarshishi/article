<?php

require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Question.php';

class DatabaseSeeder {
    
    public function seedUsers() {
        $users = [
            new User("John Doe", "john@example.com", "password123"),
            new User("Jane Smith", "jane@example.com", "password456"),
            new User("Bob Johnson", "bob@example.com", "password789")
        ];
        
        foreach ($users as $user) {
            if ($user->save()) {
                echo "User {$user->FN} created successfully\n";
            } else {
                echo "Error creating user {$user->FN}\n";
            }
        }
    }
    
   
    public function seedQuestions() {
        $questions = [
            new Question("how r u?", "fine"),
            new Question(" is sustainability found in architucture ?", " yes and it creates a comfortable environment"),
            new Question(" what is meant by light in architucture design ?", " it can highlight design features"),
            new Question("what is the role of building in architecture ?", "it define its overall shape and structure")
        ];
        
        foreach ($questions as $question) {
            if ($question->save()) {
                echo "Question '{$question->question}' created successfully\n";
            } else {
                echo "Error creating question '{$question->question}'\n";
            }
        }
    }
    
    
    public function run() {
        echo "Starting database seeding...\n";
        $this->seedUsers();
        $this->seedQuestions();
        echo "Database seeding completed\n";
    }
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    $seeder = new DatabaseSeeder();
    $seeder->run();
}
?>

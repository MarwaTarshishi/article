<?php

echo "Running database migrations...\n";

require_once __DIR__ . '/migrations/CreatrQuestionsTable.php';
require_once __DIR__ . '/migrations/CreateUserTable.php';

migrate_users();
migrate_questions();

echo "All migrations completed\n";
?>

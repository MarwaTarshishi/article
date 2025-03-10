<?php

echo "Running database migrations...\n";

require_once __DIR__ . '/migrations/001_create_users_table.php';
require_once __DIR__ . '/migrations/002_create_questions_table.php';

migrate_users();
migrate_questions();

echo "All migrations completed\n";
?>

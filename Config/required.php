<?php 

$dotenv->required('DB_ENGINE')->allowedValues(['mysql', 'sqlite']);

match($_ENV['DB_ENGINE']) {
    'mysql' => $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']),
    'sqlite' => $dotenv->required('DB_PATH')
};


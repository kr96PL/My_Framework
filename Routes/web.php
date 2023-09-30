<?php 

declare(strict_types = 1);

use Framework\Controllers\AboutController;

$router->get('/', fn() => 'Home Page');
$router->get('/about', [AboutController::class, 'index']);
<?php 

declare(strict_types = 1);

use Framework\Controllers\AboutController;
use Framework\Controllers\AuthController;
use Framework\Controllers\HomeController;
use Framework\Core\View;

$router->get('/', [HomeController::class, 'index']);
$router->post('/', [HomeController::class, 'store']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/login', function() {
    return (new View())->show('login');
});
$router->post('/login', [AuthController::class, 'login']);
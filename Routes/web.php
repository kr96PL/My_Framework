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
})->middleware('loggedIn');

$router->post('/loggedIn', [AuthController::class, 'login'])->middleware('auth');

$router->get('/register', function() {
    return (new View())->show('register');
})->middleware('loggedIn');

$router->post('/register', [AuthController::class, 'register'])->middleware('loggedIn');
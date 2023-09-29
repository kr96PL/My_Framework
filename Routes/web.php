<?php 

declare(strict_types = 1);

$router->get('/', fn() => 'Home Page');
$router->get('/about', fn() => 'About');
$router->get('/contact', function() {
    return '
        <form method="POST" action="">
            <label>Name: </label>
            <input type="text" name="name" />
            <button type="submit">Send</button>
        </form>';
});

$router->post('/contact', function() {
    $data = $_POST;
    var_dump($data);
});
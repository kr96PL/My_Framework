<?php 

declare(strict_types = 1);

require_once('./vendor/autoload.php');

use Framework\Core\App;
use Framework\Core\Router;

$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once('./Config/required.php');

$router = new Router();

require_once('./Routes/web.php');

$app = new App($router);
$app->run();
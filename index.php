<?php 

declare(strict_types = 1);

require_once('./vendor/autoload.php');

use Framework\Core\App;

$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once('./Config/required.php');

$app = new App();
echo($app->run());
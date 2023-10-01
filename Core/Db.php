<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\DbProviders\MysqlProvider;
use Framework\Core\DbProviders\SqliteProvider;
use PDO;

class Db 
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::getProvider()->getConfig();
        } 
        return self::$instance;
    }

    private static function getProvider(): DbProviderInterface
    {
        return match($_ENV['DB_ENGINE']) {
            'mysql' => new MysqlProvider(),
            'sqlite' => new SqliteProvider()
        };
    }
}
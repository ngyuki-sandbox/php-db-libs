<?php
namespace Example\Doctrine;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Example\Config;

class ConnectionManager
{
    public static function getConnection()
    {
        $connectionParams = Config::get() + array(
            'driver' => 'pdo_mysql',
            'driverOptions' => [],
        );

        $conn = DriverManager::getConnection($connectionParams);

        return $conn;
    }
}

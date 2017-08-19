<?php
namespace Example\Zend;

use Example\Config;
use Zend\Db\Adapter\Adapter;

class DbManager
{
    public static function getAdapter()
    {
        $cfg = Config::get();
        $db = new Adapter([
            'driver'   => 'pdo',
            'dsn'      => "mysql:dbname={$cfg['dbname']};host={$cfg['host']};charset=utf8",
            'username' => $cfg['user'],
            'password' => $cfg['password'],
        ]);
        return $db;
    }

    public static function getAdapterWithResultSet()
    {
        $cfg = Config::get();
        $db = new Adapter([
            'driver'   => 'pdo',
            'dsn'      => "mysql:dbname={$cfg['dbname']};host={$cfg['host']};charset=utf8",
            'username' => $cfg['user'],
            'password' => $cfg['password'],
        ], null, new MyResultSet());
        return $db;
    }
}

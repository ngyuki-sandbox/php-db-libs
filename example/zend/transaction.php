<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

$db = DbManager::getAdapter();

$connection = $db->getDriver()->getConnection();
$connection->beginTransaction();

try {
    $db->query('insert into xxx (no) values (?)', [4]);

    $rows = $db->query('select * from xxx', []);
    p('first', $rows->count());

    if ($rows->count()) {
        throw new \RuntimeException("!!!");
    }
    $connection->commit();
} catch (\Exception $ex) {
    $connection->rollback();
    p('catch', $ex->getMessage());
}

$rows = $db->query('select * from xxx', []);
p('final', $rows->count());

<?php
namespace Example\Doctrine;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();

try {
    p('begin', count($conn->fetchAll('select * from xxx')));
    $conn->transactional(function () use ($conn) {
        $conn->insert('xxx', ['no' => 44]);
        p('insert', count($conn->fetchAll('select * from xxx')));
        throw new \RuntimeException();
    });
} catch (\RuntimeException $ex) {
    //
}

p('rollback', count($conn->fetchAll('select * from xxx')));

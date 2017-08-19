<?php
namespace Example\Doctrine;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();

$q = new ScopedQueryBuilder($conn, 'disabled = 1');
$q->select('*')
    ->from('xxx')
    ->orWhere('id = 2')
    ->orWhere('id = 3')
    ->orWhere('id = 4')
;

print_r($q->execute()->fetchAll());

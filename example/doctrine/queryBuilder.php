<?php
namespace Example\Doctrine;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();

$conn->insert('xxx', ['no' => 4]);

$q = $conn->createQueryBuilder();
$q->select(['id'])
    ->from('xxx')
    ->andWhere('no = ?')
    ->setParameters([4]);

$sql = $q->getSQL();
p('select()->getSQL()', $sql);

$stmt = $q->execute();
p('select()->execute()', $stmt);

p('select()->execute()->fetch()', $stmt->fetch());

$q = $conn->createQueryBuilder();
$q->delete('zzz');
p('delete()->getSQL()', $q->getSQL());

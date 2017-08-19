<?php
namespace Example\Zend\ScopedTableGateway;

require __DIR__ . '/../../bootstrap.php';

use Example\Zend\DbManager;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

$db = DbManager::getAdapterWithResultSet();

///

$table = (new ScopedTableGateway('xxx', $db))->scope('disabled = 1');

$results = $table->select(function (Select $select) {
    $select->where
        ->or->equalTo('id', 2)
        ->or->equalTo('id', 3)
        ->or->equalTo('id', 4)
    ;
});

print_r($results->toArray());


///

$results = $table->scope('id > 2')->select(function (Select $select) {
    $select->where
        ->or->equalTo('id', 2)
        ->or->equalTo('id', 3)
        ->or->equalTo('id', 4)
    ;
});

print_r($results->toArray());

///

$sql = new Sql($db);

$select = $sql->select('xxx');
$select->where
    ->or->equalTo('id', 2)
    ->or->equalTo('id', 3)
    ->or->equalTo('id', 4);

$table->selectWith($select);
$table->selectWith($select);
$table->selectWith($select);

echo $sql->buildSqlString($select) . PHP_EOL;

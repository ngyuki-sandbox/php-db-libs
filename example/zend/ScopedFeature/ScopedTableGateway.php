<?php
namespace Example\Zend\ScopedFeature;

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
        ->or->equalTo('id', 4);
});

print_r($results->toArray());

///
///
$results = $table->scope('id > 2')->select();
print_r($results->toArray());

///

$sql = new Sql($db);

$select = $sql->select('xxx');
$scope = $table->scope('id > 2');

$scope->selectWith($select);
$scope->selectWith($select);
$scope->selectWith($select);
$scope->selectWith($select);

echo $sql->buildSqlString($select);

<?php
namespace Example\Zend\ScopedFeature;

require __DIR__ . '/../../bootstrap.php';

use Example\Zend\DbManager;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapterWithResultSet();

///

$table = new TableGateway('xxx', $db, new ScopedFeature('disabled = 1'));

$results = $table->select(function (Select $select) {
    $select->where
        ->or->equalTo('id', 2)
        ->or->equalTo('id', 3)
        ->or->equalTo('id', 4);
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

$results = $table->selectWith($select);
print_r(iterator_to_array($results));

echo $sql->buildSqlString($select);

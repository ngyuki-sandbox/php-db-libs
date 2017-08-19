<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapter();

$table = new TableGateway('xxx', $db);

$select = $table->getSql()->select();
$select->columns(['id'])->where->equalTo('id', 2);

$rows = $table->selectWith($select);
var_dump(get_class($rows)); // Zend\\Db\\ResultSet\\ResultSet

foreach ($rows as $row) {
    var_dump($row); // ArrayObject ['id' => 2]
}

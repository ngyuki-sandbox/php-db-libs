<?php
namespace Example\Zend;

require __DIR__ . '/../../bootstrap.php';

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapter();
$db->getDriver()->getConnection()->beginTransaction();

///

h("TableGateway");

$table = new TableGateway('xxx', $db);
$rows = $table->select(function (Select $select) {
    $select->where->equalTo('id', 1);
    $select->limit(1);
});
p("select()", $rows);

foreach ($rows as $row) {
    p("select()->foreach()", $row);
}

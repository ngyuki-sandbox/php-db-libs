<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapter();
$db->getDriver()->getConnection()->beginTransaction();

///

h("TableGateway");

$table = new TableGateway('xxx', $db);
$rows = $table->select(['id' => 2]);
p("select()", $rows);

foreach ($rows as $row) {
    p("select()->foreach()", $row);
}

///

h("TableGateway with ArrayObjectPrototype");

$resultSetPrototype = new ResultSet();
$resultSetPrototype->setArrayObjectPrototype(new MyRow());

$table = new TableGateway('xxx', $db, null, $resultSetPrototype);
$rows = $table->select(['id' => 2]);
p("select()", $rows);

foreach ($rows as $row) {
    p("select()->foreach()", $row);
}


///

h("TableGateway with ResultSetPrototype");

$table = new TableGateway('xxx', $db, null, new MyResultSet());
$rows = $table->select(['id' => 2]);
p("select()", $rows);

foreach ($rows as $row) {
    p("select()->foreach()", $row);
}

///

h("TableGateway missing column");

$table = new TableGateway('xxx', $db, null, new MyResultSet());
e('insert()', function () use ($table) { $table->insert(['no' => 123, 'xxx' => 999]); });

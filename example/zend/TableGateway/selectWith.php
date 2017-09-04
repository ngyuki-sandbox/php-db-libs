<?php
namespace Example\Zend;

require __DIR__ . '/../../bootstrap.php';

use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapter();

$table = new TableGateway('xxx', $db);

h("TableGateway selectWith");

$select = $table->getSql()->select();
$select->columns(['id'])->where->equalTo('id', 2);

$rows = $table->selectWith($select);
p('selectWith()', $rows);

foreach ($rows as $row) {
    /* @var $row \ArrayObject */
    p('selectWith().foreach()', $row);
}

<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

$db = DbManager::getAdapter();
$db->getDriver()->getConnection()->beginTransaction();

$no = 0;

///

h("TableGateway insert/update/delete");

$table = new TableGateway('xxx', $db, null, new MyResultSet());

p("insert()", $table->insert(['no' => 0]));

p("getLastInsertValue()", $id = $table->getLastInsertValue());

p("update()", $table->update(['no' => 1], ['id' => $id]));

p("update() all", $table->update(['no' => 2], []));

p("delete()", $table->delete(['id' => $id]));

p("delete() all", $table->delete([]));

///

h("TableGateway unknown column");

e("insert()", function () use ($table) { $table->insert(['no' => 0, 'xxx' => '9']); });
e("update()", function () use ($table) { $table->update(['no' => 9, 'xxx' => '9'], ['id' => 2]); });
e("delete()", function () use ($table) { $table->delete(['id' => 2, 'xxx' => 9]); });

///

h('TableGateway $where');

$table = new TableGateway('xxx', $db, null, new MyResultSet());

$table->insert(['no' => ++$no]);
$id = $table->getLastInsertValue();

p('update($where) with string', $table->update(['no' => ++$no], "id = $id"));

p('update($where) with callback', $table->update(['no' => ++$no], function (Where $where) use ($id) {
    $where->equalTo('id', $id);
}));

$where = $table->getSql()->update()->where->equalTo('id', $id);
p('update($where) with $where', $table->update(['no' => ++$no], $where));

$where = (new Where())->equalTo('id', $id);
p('update($where) with $where', $table->update(['no' => ++$no], $where));

///

h('TableGateway getSql()');

$table = new TableGateway('xxx', $db, null, new MyResultSet());

$table->insert(['no' => ++$no]);
$id = $table->getLastInsertValue();

$update = $table->getSql()->update()->set(['no' => ++$no]);
$update->where->equalTo('id', $id);
p('query($sql)', $table->updateWith($update));

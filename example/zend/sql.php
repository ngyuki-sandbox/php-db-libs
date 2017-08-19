<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

use Zend\Db\Sql\Sql;

$db = DbManager::getAdapterWithResultSet();

///

h('select() prepareStatementForSqlObject()');

$sql = new Sql($db);
$select = $sql->select();
$select->from('xxx')->where(['id' => 2]);

$results = $sql->prepareStatementForSqlObject($select)->execute();
p('execute()', $results);
p('execute()->current()', $results->current());
p('execute()->current().id', $results->current()['id']);

///

h('select() buildSqlString()');

$sql = new Sql($db);
$select = $sql->select();
$select->from('xxx')->where(['id' => 2]);

$selectString = $sql->buildSqlString($select);
p('buildSqlString()', $selectString);

$results = $db->query($selectString, []);
p('query()', $results);
p('query()->current()', $results->current());
p('query()->current().id', $results->current()['id']);

///

h('insert() prepareStatementForSqlObject()');

$sql = new Sql($db);
$insert = $sql->insert();
$insert->into('xxx')->values(['no' => 2]);

$results = $sql->prepareStatementForSqlObject($insert)->execute();
p('execute()', $results);
p('execute()->getAffectedRows()', $results->getAffectedRows());


///

h('insert() buildSqlString()');

$sql = new Sql($db);
$insert = $sql->insert();
$insert->into('xxx')->values(['no' => 2]);

$selectString = $sql->buildSqlString($insert);
p('buildSqlString()', $selectString);

$results = $db->query($selectString)->execute();
p('query()', $results);
p('query()->getAffectedRows()', $results->getAffectedRows());

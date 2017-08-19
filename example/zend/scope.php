<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

use Zend\Db\Sql\Predicate\Predicate;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

$db = DbManager::getAdapterWithResultSet();

///

function scope(Select $select)
{
    $select = clone $select;
    $select->where((new Where())
        ->addPredicates('disabled = 1')
        ->addPredicates($select->where)
    );
    return $select;
}

$sql = new Sql($db);
$select = $sql->select();

$select->from('xxx')->where(function (Where $where) {
    $where->or->equalTo('id', 1);
    $where->or->nest()->addPredicates(function (Predicate $p) {
        $p->equalTo('no', 1);
        $p->equalTo('no', 2);
        $p->equalTo('no', 3);
        $p->nest->addPredicates(function (Predicate $p) {
            $p->or->equalTo('xx', 1);
            $p->or->equalTo('xx', 2);
            $p->or->equalTo('xx', 3);
        });
    });
    $where->or->equalTo('id', 2);
});
$select = scope($select);

dump_parentheses($sql->buildSqlString($select));

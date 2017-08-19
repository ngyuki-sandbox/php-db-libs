<?php
namespace Example\Zend\ScopedTableGateway;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

class ScopedTableGateway extends TableGateway
{
    /**
     * @var TableGateway
     */
    private $delegate;

    private $predicates;

    /**
     * @param $predicates
     *
     * @return static
     */
    public function scope($predicates)
    {
        $obj = clone $this;
        $obj->delegate = $this;
        $obj->predicates = $predicates;
        return $obj;
    }

    protected function executeSelect(Select $select)
    {
        if ($this->predicates) {
            $select = clone $select;
            if ($select->where->count()) {
                $select->where((new Where())
                    ->addPredicates($this->predicates)
                    ->addPredicates($select->where)
                );
            } else {
                $select->where((new Where())
                    ->addPredicates($this->predicates)
                );
            }
        }
        if ($this->delegate) {
            return $this->delegate->executeSelect($select);
        }
        return parent::executeSelect($select);
    }
}

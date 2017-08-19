<?php
namespace Example\Zend\ScopedFeature;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\Feature\AbstractFeature;

class ScopedFeature extends AbstractFeature
{
    private $predicates;

    public function __construct($predicates)
    {
        $this->predicates = $predicates;
    }

    public function preSelect(Select $select)
    {
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
}

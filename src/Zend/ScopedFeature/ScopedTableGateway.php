<?php
namespace Example\Zend\ScopedFeature;

use Zend\Db\TableGateway\TableGateway;

class ScopedTableGateway extends TableGateway
{
    /**
     * @param $predicates
     *
     * @return static
     */
    public function scope($predicates)
    {
        $obj = clone $this;
        $obj->featureSet = clone $this->featureSet;
        $obj->featureSet->addFeature(new ScopedFeature($predicates));
        return $obj;
    }
}

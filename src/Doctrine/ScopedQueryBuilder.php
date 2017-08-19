<?php
namespace Example\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class ScopedQueryBuilder extends QueryBuilder
{
    private $predicates;

    public function __construct(Connection $connection, $predicates)
    {
        parent::__construct($connection);

        $this->predicates = $predicates;
    }

    public function execute()
    {
        if (($this->getType() == self::SELECT) && $this->predicates) {
            $obj = (clone $this)->where(
                $this->getQueryPart('where'),
                $this->predicates
            );
            $obj->predicates = null;
            return $obj->execute();
        }
        return parent::execute();
    }
}

<?php
namespace Example\Doctrine;

use Doctrine\DBAL\Query\QueryBuilder;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();

function scope(QueryBuilder $q)
{
    $q = clone $q;
    return $q->andWhere('disabled = 1');
}

function scope2(QueryBuilder $q)
{
    $q = clone $q;
    return $q->where(
        $q->getQueryPart('where'),
        'disabled = 1'
    );
}


$q = $conn->createQueryBuilder();
$q->select('*')
    ->from('user')
    ->orWhere('name = ?')
    ->andWhere('id = ?')
    ->orWhere('name = ?')
    ->andWhere('id = ?')
;

$q = scope2($q);

dump_parentheses($q->getSQL());

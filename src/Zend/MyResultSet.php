<?php
namespace Example\Zend;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;

class MyResultSet extends ResultSet implements ResultSetInterface
{
    public function __construct()
    {
        parent::__construct(self::TYPE_ARRAYOBJECT, new MyRow());
    }
}

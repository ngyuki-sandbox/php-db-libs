<?php
namespace Example\Zend;

use ArrayObject;

/**
 * @property string $id
 */
class MyRow extends ArrayObject
{
    public function __construct()
    {
        parent::__construct([], self::ARRAY_AS_PROPS);
    }
}

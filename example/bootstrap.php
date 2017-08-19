<?php
return require __DIR__ . '/../vendor/autoload.php';

function h($msg)
{
    echo "\n=== $msg\n";
}

function p($msg, $obj)
{
    if (is_object($obj)) {
        $obj = get_class($obj);
    } elseif(is_array($obj)) {
        $obj = gettype($obj);
    } elseif(is_string($obj)) {
        ;
    } else {
        $obj = var_export($obj, true);
    }
    printf("%s ... %s\n", $msg, $obj);
}

function e($msg, callable $callable)
{
    try {
        $ret = $callable();
    } catch (\Exception $ex) {
        //$ret = get_class($ex) . ": " . $ex->getMessage();
        $ret = $ex->getMessage();
    }

    p($msg, $ret);
}

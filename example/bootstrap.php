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

function dump_parentheses($sql)
{
    $ws = "";

    while (strlen($sql)) {
        if (preg_match('/[()]/', $sql, $m) == 0) {
            echo $ws . $sql . PHP_EOL;
            $sql = "";
            continue;
        }
        $c = $m[0];
        list ($pre, $sql) = explode($c, $sql, 2);

        if ($c === '(') {
            if (trim($pre)) {
                echo $ws . trim($pre) . PHP_EOL;
            }
            echo $ws . $c . PHP_EOL;
            $ws .= "  ";
        } else {
            if (trim($pre)) {
                echo $ws . trim($pre) . PHP_EOL;
            }
            $ws = substr($ws, 2);
            echo $ws . $c . PHP_EOL;
        }
    }
}

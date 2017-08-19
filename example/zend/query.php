<?php
namespace Example\Zend;

require __DIR__ . '/../bootstrap.php';

$db = DbManager::getAdapter();
$sql = 'select * from xxx where id = ?';
$params = [2];

///

echo "\n=== query()\n";

$stmt = $db->query($sql, $params);
printf("query() ... %s\n", get_class($stmt));

foreach ($stmt as $row) {
    printf("query().foreach() ... %s\n", get_class($row));
}

///

echo "\n=== createStatement()\n";

$stmt = $db->createStatement($sql, $params);
printf("createStatement() ... %s\n", get_class($stmt));

$result = $stmt->execute();
printf("createStatement()->execute() ... %s\n", get_class($result));

foreach ($result as $row) {
    printf("createStatement()->execute()->foreach() ... %s\n", gettype($row));
}

///

echo "\n=== query() with ArrayObjectPrototype\n";

$results = $db->query($sql, $params);

$results->setArrayObjectPrototype(new MyRow());
foreach ($results as $row) {
    printf("query().foreach() ... %s\n", get_class($row));
}

///

echo "\n=== query() with ResultSetInterface\n";

$results = $db->query($sql, $params, new MyResultSet());
printf("query() ... %s\n", get_class($results));
foreach ($results as $row) {
    printf("query().foreach() ... %s\n", get_class($row));
}

///

echo "\n=== query()->current() with ResultSetInterface\n";

$result = $db->query($sql, $params, new MyResultSet())->current();
printf("query()->current() ok ... %s\n", get_class($result));

$result = $db->query($sql, [999], new MyResultSet())->current();
printf("query()->current() no ... %s\n", gettype($result));

///

h("Adapter with ResultSet");

$db = DbManager::getAdapterWithResultSet();

p('query()', $result = $db->query($sql, $params));

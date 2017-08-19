<?php
namespace Example\Doctrine;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();
$conn->beginTransaction();

$res = $conn->insert('xxx', ['no' => 4]);
p('insert', $res);

$id = $conn->lastInsertId();
p('lastInsertId', $id);

$res = $conn->update('xxx', ['no' => 5], ['id' => $id]);
p('insert', $res);

$res = $conn->delete('xxx', ['id' => $id]);
p('insert', $res);

try {
    $conn->insert('xxx', ['no' => 4, 'xxx' => 4]);
} catch (\Exception $ex) {
    p('insert missing', $ex);
}

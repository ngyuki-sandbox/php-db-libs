<?php
namespace Example\Doctrine;

require __DIR__ . '/../bootstrap.php';

$conn = ConnectionManager::getConnection();

$rows = $conn->fetchAll("select * from xxx where id = ?", [2]);
p('fetchAll', $rows);
//var_dump($rows);

$stmt = $conn->executeQuery("select * from xxx where id = ?", [2]);
p('executeQuery()', $stmt);
p('executeQuery()->fetch()', $stmt->fetch());
//var_dump(iterator_to_array($stmt));

$num = $conn->exec("update xxx set no = 5");
p('exec("update ~")', $num);

$num = $conn->executeUpdate("update xxx set no = ?", [6]);
p('executeUpdate("update ~")', $num);

$stmt = $conn->executeQuery("update xxx set no = ?", [7]);
p('executeQuery("update ~")', $stmt->rowCount());

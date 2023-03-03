<?php
$sql_select = <<<SQL
    SELECT * FROM notes WHERE id=:id;
    SQL;
    $pdo_st = $connection->prepare($sql_select);
    $pdo_st->execute([
    ":id" => 1,
    ]);
    $data = $pdo_st->fetch();
    var_dump($data);
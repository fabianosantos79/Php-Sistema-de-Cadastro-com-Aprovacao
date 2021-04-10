<?php
    $dbname = "mysql:dbname=blog;host=localhost";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO($dbname, $user, $pass);
    } catch (PDOException $erro) {
        die($erro->getMessage());
    }
?>
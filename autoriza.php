<?php
    require_once 'config.php';

    $h = $_GET['h'];

    if(isset($h))
    {
        $sql = $pdo->prepare("UPDATE pessoas SET status = '1' WHERE MD5(id) = :h");
        $sql->bindValue(':h', $h);
        $sql->execute();

        echo "Cadastro confirmado com sucesso";

    }
?>
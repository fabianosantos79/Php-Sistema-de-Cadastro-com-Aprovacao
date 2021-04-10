<?php
    require_once 'config.php';

    if(isset($_POST['btn-enviar']))
    {
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');

        $sql = $pdo->prepare("SELECT * FROM email = :e");
        $sql->bindValue(':e', $email);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            header('Location:index.php');
            exit;
        }
        else
        {
            $sql = $pdo->prepare("INSERT INTO pessoas SET nome = :n AND email = :e");
            $sql->bindValue(':n', $nome);
            $sql->bindValue(':e', $email);
            $sql->execute();

            $id = $pdo->lastInsertId();

            $md5 = md5($id);

            echo $md5;

            $link = 'http://localhost/cadastro_com_aprovacao/autoriza.php?h='.$md5;

            $assunto = "Confirme seu cadastro";
            $msg = "Para confirmar seu acesso, entre no link:\r\n".$link;
            $headers = "From:fabiano.ssantos@gmail.com"."\r\n"."X-Mailer: PHP/".phpversion();

            mail($email, $assunto, $msg, $headers);

            echo "<h2>Ok, Confirme seu cadastro agora</h2>";
            exit;

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cadastro com Aprovação</h2>
    <form method="POST">
        Nome:<br>
        <input type="text" name="nome" id=""><br><br>
        Email:<br>
        <input type="text" name="email" id=""><br><br>
        <input type="submit" name="btn-enviar" id=""><br><br>
    </form>
</body>
</html>
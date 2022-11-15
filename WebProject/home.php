<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='css/homepage.css'>
    <title>home</title>
</head>

<body>
    <header>
        <div id='menu'>menu</div>
        <div id='logo'>
            <img src='img/img1.png'>
        </div>
        <div id='chat'>chat</div>
    </header>
    <section>
        <?php

        if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {
            echo "<div id='welcome'>Bem-vindo, " . $_SESSION['nome'] . "!</div>";
            /*echo "<a href='perfil.php'>Perfil</a> - ";
            echo "<a href='listar.php'>Minhas Mensagens</a> - ";
            echo "<a href='listar_mensagens.php'>Mensagens</a> - ";
            echo "<a href='sair.php'>Sair</a><br>";*/

            include_once "conexao.php";

            $query_usuario = "SELECT id, nome, email, usuario FROM users WHERE id=:id LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            $result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
            $result_usuario->execute();

            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                extract($row_usuario);

                echo "<div id='container'>
                        <img src='img/img1.png'>
                        <div id='usuario'>$usuario</div>
                        <div id='email'>$email</div>;
                      </div>";
            } else {
                $_SESSION['msg'] = "Erro: Necessário realizar o login para acessar a página 1!";
                header("Location: loginDev.php");
            }
        } else {
            $_SESSION['msg'] = "Erro: Necessário realizar o login para acessar a página!";
            header("Location: loginDev.php");
        }
        ?>
        <div class='Welcome'></div>
        <section>
</body>

</html>
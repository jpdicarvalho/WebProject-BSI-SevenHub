<?php
session_start();
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='css/homeEmp.css'>
    <title>home</title>
</head>

<body>
    <h1>teste</h1>
        <?php
        //verificando se existe uma sessão
        if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {
            echo "<div id='welcome'>Bem-vindo, " . $_SESSION['nome'] . "!</div>";

            include_once "conexao.php";
            // Selecionando os Dados do Usuário no BD
            $query_usuario = "SELECT id, nome, email, usuario FROM empresas WHERE id=:id LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            //Substituindo o link da Seleção sql pelo valor que está na variável global '$result_usuario'
            $result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
            $result_usuario->execute();
            //verficando se o id do usuário logado ainda é o mesmo
            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                extract($row_usuario);
                /*echo "<div id='container'>
                        <img src='img/img1.png'>
                        <div id='usuario'>$usuario</div>
                        <div id='email'>$email</div>
                      </div>";*/
                      echo"<a href='sair.php'> Sair</a>";
            } else {
                echo"<script> alert('Usuário não encontrado. Realize o Login!');
                window.location.href='loginEmp.php';
                </script>";
            }
        } else {
            echo"<script> alert('Usuário não encontrado. Realize o Login!');
            window.location.href='loginEmp.php';
            </script>";
        }
        ?>
</body>

</html>
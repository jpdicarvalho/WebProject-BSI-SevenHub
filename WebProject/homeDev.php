<?php
session_start();
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='css/homeDev.css'>
    <title>home</title>
</head>

<body>
        <?php
        //verificando se existe uma sessão
        if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {

            include_once "conexao.php";
            // Selecionando os Dados do Usuário no BD
            $query_usuario = "SELECT id, nome, email, usuario FROM users WHERE id=:id LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            //Substituindo o link da Seleção sql pelo valor que está na variável global '$result_usuario'
            $result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
            $result_usuario->execute();
            //verficando se o id do usuário logado ainda é o mesmo
            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                extract($row_usuario);
                echo "<header>
                    <img id='img' src='img/img1.png'>
                    <div class='box'>
                        <div class='usuario'>Olá, " . $_SESSION['nome'] . "!</div>
                        <div class='usuario'>$usuario</div>
                    </div>
                    <div id='sair'><a href='sair.php'>Sair</a></div>
                 </header>";
                 echo"<section class='wrapper'>
                        <div class='container'>
                            <h3>Seja bem vindo!</h3>
                            <div class='btn'><p id='key'>{</p><a href='loginEmp.php'>Editar Perfil</a><p id='key'>}</p></div>
                            <div class='btn'><p id='key'>{</p><a href='loginDev.php'>Visualizar Perfil</a><p id='key'>}</p></div>
                        </div>
                    </section>
                 
                 
                 ";
            } else {
                echo"<script> alert('Usuário não encontrado. Realize o Login!');
                window.location.href='loginDev.php';
                </script>";
            }
        } else {
            echo"<script> alert('Usuário não encontrado. Realize o Login!');
            window.location.href='loginDev.php';
            </script>";
        }
        ?>
</body>

</html>
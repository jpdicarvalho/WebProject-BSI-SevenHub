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
        <?php
        //verificando se existe uma sessão
        if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {

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
                echo "<header>
                    <div class='container'>
                        <img id='img' src='img/img1.png'>
                        <div class='box'>
                            <div class='usuario'>Olá, " . $_SESSION['nome'] . "!</div>
                            <div class='usuario'>$usuario</div>
                        </div>
                        <div id='sair'><a href='sair.php'>Sair</a></div>
                     </div>
                     
                     </header>";
                      
                      echo"<div class='section'>
                            <div class='developer'>
                                <p id='web'> Web Developer</p>
                                <div class='btn'><a href='Frontend-page.php'><p id='key'>{</p>FrontEnd<p id='key'>}</p></a></div>
                                <div class='btn'><a href='#'><p id='key'>{</p>BackEnd<p id='key'>}</p></a></div>
                                <div class='btn'><a href='#'><p id='key'>{</p>FullStack<p id='key'>}</p></a></div>
                            </div>
                            <div class='developer'>
                                <p id='web'> Mobile Developer</p>
                                <div class='btn'><a href='#'><p id='key'>[</p>Android<p id='key'>]</p></a></div>
                                <div class='btn'><a href='#'><p id='key'>[</p>IOS<p id='key'>]</p></a></div>
                            </div>
                        </div>";
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
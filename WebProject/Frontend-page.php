<?php
session_start();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Frontend-page.css">
    <title>Card UI</title>
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
                                <div id='welcome'>Olá, " . $_SESSION['nome'] . "!</div>
                                <div id='usuario'>$usuario</div>
                            </div>
                            <a href='sair.php'> Sair</a>
                         </div>
                         </header>";
                        //Aqui vai o Select
                        //criar tabela dcom os tipos de desenvolvedores
                         echo"<div class='section'>
                                <h1>Web Developes</h1>
                                <div class='card'>
                                    <div class='ImgBox'>
                                        <img src='img/img1.png' alt='foto do desenvolvedor'>
                                    </div>
                                    <div class='content'>
                                    <div class='details'>
                                        <h2>João Pedro<br><span>Front-End Developer</span></h2>
                                        <div class='actionBtn'>
                                            <button>Perfil</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                         
                         ";
                       
                        


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
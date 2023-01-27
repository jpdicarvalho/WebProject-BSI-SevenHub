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
        ?>
                        <header>
                        <img id='img' src='img/img1.png'>
                        <div class='box'>
                            <div class='usuario'>Olá, <?php echo $_SESSION['nome'];?></div>
                            <div class='usuario'><?php echo $usuario;?></div>
                        </div>
                        <div id='sair'><a href='sair.php'>Sair</a></div>
                 </header>
                 <?php
                            //selecionando apenas os Devs Front-End do Banco de dados
                            $query_dev = "SELECT id, nome, email, usuario, desenvolvedor, FotoUsuario FROM users WHERE desenvolvedor='Front-End'";
                            $result_dev = $conn->prepare($query_dev);
                            $result_dev->execute();
                            if (($result_dev) and ($result_dev->rowCount() != 0))
                                echo"<div class='section'>
                                        <h1>Web Developes</h1>";
                                    while($row_dev = $result_dev->fetch(PDO::FETCH_ASSOC)){
                                            extract($row_dev);
                ?>                              <div class='card'>
                                                    <div class='ImgBox'>
                                                    <?php
                                                        if((!empty($FotoUsuario)) AND (file_exists("img/$id/$FotoUsuario"))){
                                                            echo "<img class='imgUsuario' src='img/$id/$FotoUsuario'>";
                                                        }else{
                                                            echo "<img src='img/img1.png'>";
                                                        }?>
                                                    </div>
                                                    <div class='content'>
                                                        <div class='details'>
                                                            <h2><?php echo $usuario;?><br></h2>
                                                                <p>Front-End Developer</p>
                                                                <div class='actionBtn'>
                                                                    <button><a href="visualizar.php?<?php echo "id=$id";?>">Visualizar Perfil</a></button> 
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                <?php
                                    }
                                ?>
                                </div>
                    <?php
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
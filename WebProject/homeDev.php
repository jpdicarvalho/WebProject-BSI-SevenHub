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
    <link rel="stylesheet" href="css/cube.css">
    <title>home</title>
</head>

<body>
<div class="cube">
        <div class="top"></div>
        <div>
            <span style="--i:0;"></span>
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
        </div>
    </div>
        <?php
        //verificando se existe uma sessão
        if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {

            include_once "conexao.php";
            // Selecionando os Dados do Usuário no BD
            $query_usuario = "SELECT id, nome, email, usuario, FotoUsuario FROM users WHERE id=:id LIMIT 1";
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
                    <div class="box">
                        <?php
                        if((!empty($FotoUsuario)) AND (file_exists("img/$id/$FotoUsuario"))){
                            echo "<img class='imgUsuario' src='img/$id/$FotoUsuario'>";
                        }else{
                            echo "<img src='img/img1.png' style='width: 60px;>";
                        }?>
                    </div>
                    <div class="boxusuario">
                        <div class='usuario'>Olá, <?php echo $_SESSION['nome'];?></div>
                        <div class='usuario'><?php echo $usuario;?></div>
                    </box>
                    <div id='sair'><a href="sair.php">Sair</a></div>
                 </header>
                <section class='wrapper'>
                        <div class='container'>
                            <h3>Seja bem vindo!</h3>
                            <div class='btn'><p id='key'>{</p><a href="editar.php?<?php echo "id=$id";?>">Editar Perfil</a><p id='key'>}</p></div>
                        <div class='btn'><p id='key'>{</p><a href="visualizar.php?<?php echo "id=$id";?>">Visualizar Perfil</a><p id='key'>}</p></div>
                        </div>
                    </section>
            <?php
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
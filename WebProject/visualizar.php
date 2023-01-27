<?php
session_start();
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
    echo"<script> alert('Usuário não encontrado!');
    window.location.href='index.html';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='css/visualizar.css'>
    <title>Visualizar Perfil</title>
</head>
<body>
    <?php
    $query_usuario = "SELECT id, nome, email, usuario, desenvolvedor, descricao, instagram, html, css, php, javascript, perfilgithub, FotoUsuario FROM users WHERE id=$id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();

    if(($result_usuario) AND ($result_usuario->rowCount() !=0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);
        ?>
        <header>
            <div class='box'>
                <p id='key'>>></p><div class='usuario'>Modo visitante</div>
            </div>
            <div id='sair'><a href='sair.php'>Sair</a></div>
        </header>
        <section class='wrapper'>
        <?php
                if((!empty($FotoUsuario)) AND (file_exists("img/$id/$FotoUsuario"))){
                    echo "<img class='imgUsuario' src='img/$id/$FotoUsuario'>";
                }else{
                    echo "<img src='img/img1.png'>";
                }
        ?>
            <span id='nome'><?php echo $nome; ?></span>
            <div class='container'>
                <h2>Descrição</h2>
                    <div id=descricao>
                        <span id='nome'><?php echo $descricao?></span>  
                            </div>
                            <h2>Skill</h2>
                            <div class='Skillfilde'>
                                <?php
                                    if($html == 1){
                                        echo"<div id='html'>";
                                        echo "<p style='position: absolute; top: 10px; color: #fff; font-size: 26px; font-weight: bold;'>HTML</P>";
                                        echo "<p style='position: absolute; top: 35px; color: #fff; font-size: 35px; font-weight: bold;'>5</P>";
                                        echo"</div>";
                                    }else{}
                                ?>
                                <?php
                                    if($css == 1){
                                        echo"<div id='css'>";
                                        echo "<p style='position: absolute; top: 10px; color: #000; font-size: 26px; font-weight: bold;'>CSS</P>";
                                        echo "<p style='position: absolute; top: 35px; color: #fff; font-size: 35px; font-weight: bold;'>3</P>";
                                        echo"</div>";
                                    }else{}
                                ?>
                                <?php
                                    if($php == 1){
                                        echo"<div class='SkillBox' style='background: rgb(119,123,179);'>";
                                        echo "<p style='color: #000; font-size: 35px; font-weight: bold;'>PHP</P>";
                                        echo"</div>";
                                    }else{}
                                ?>
                                <?php
                                    if($javascript == 1){
                                        echo"<div class='SkillBox' style='background: yellow;'>";
                                        echo "<p style='position: absolute; top: 35px; right: 7px; color: #000; font-size: 35px; font-weight: bold; '>JS</P>";
                                        echo"</div>";
                                    }else{}
                                ?>
                            </div>
                            <h2>Perfil do GitHub</h2>
                            <div class='Skillfilde'>
                                <div class='GitHubBox'>
                                    <span id='nome'><a href="" style="color: aliceblue; text-decoration: underline;"><?php echo $perfilgithub?></a></span>
                                </div>
                            </div>
                            <h2>Contato</h2>
                            <div class='contato'>
                                    <p>Instagram: <?php echo $instagram;?></p>
                                    <p>E-mail: <?php echo $email;?></p>
                            </div>
                            <div class='Skillfilde'>
                                <div id='voltar'><a href="homeDev.php">Voltar</a></div>
                            </div>    
                    </section>
    <?php
    }else{
        echo"<script> alert('Usuário não encontrado!');
                window.location.href='index.html';
            </script>";
        exit();
    }
    ?>
</body>
<!--<textarea id='descricao' name='descricao' rows='5' cols='33'>
                                Fale um pouco sobre você...
                            </textarea>-->
</html>
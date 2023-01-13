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
    <title>Editar Perfil</title>
</head>
<body>
    <?php
    $query_usuario = "SELECT id, nome, email, usuario, desenvolvedor FROM users WHERE id=$id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();

    if(($result_usuario) AND ($result_usuario->rowCount() !=0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);
        echo "<header>
                    <div class='box'>
                    <p id='key'>>></p><div class='usuario'>Modo Edição de Perfil</div>
                    </div>
                    <div id='sair'><a href='sair.php'>Sair</a></div>
                 </header>";
                 echo"<section class='wrapper'>
                        <img id='img' src='img/img1.png'>
                        <span id='nome'>$nome</span>
                        <div class='container'>
                            <h2>Descrição</h2>
                            <div id=descricao>
                                <span id='nome'>Lorem ipsum dolor sit amet.
                                    Aut fugit necessitatibus est molestiae Quis ut minima voluptates?
                                    Non rerum corporis 
                                </span>  
                            </div>
                            <h2>Skill</h2>
                            <div class='Skillfilde'>
                                <div class='SkillBox'>HTML</div>
                                <div class='SkillBox'>CSS</div>
                                <div class='SkillBox'>java</div>
                            </div>
                            <h2>Projetos</h2>
                            <div class='Skillfilde'>
                                <div class='SkillBox'>web site</div>
                                <div class='SkillBox'>plataformas</div>
                                <div class='SkillBox'>Mobile</div>
                            </div>
                            <h2>Contato</h2>
                            <div class='Skillfilde'>
                                <div class='SkillBox'>LinkedIn</div>
                                <div class='SkillBox'>Instagram</div>
                                <div class='SkillBox'>WhatsApp</div>
                            </div>
                            <div class='Skillfilde'>
                                <div id='voltar'><a href='homeDev.php'>Voltar</a></div>
                            </div>    
                    </section>";
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
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
    //recebendo dados do formulário alterado
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // verificando se o usuário clicou no botão 'Salvar'
    if(!empty($dados['EditarUsuario'])){
        $empty_input = false;
        $dados = array_map('trim', $dados);
        //verificando se o usuário preencheu todos os campos
        if(in_array("", $dados)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Necessário preencher todos os campos</p>";
        }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Formato de e-mail inválido</p>";
        }if(!$empty_input){
            $query_up_usuario = "UPDATE users SET nome=:nome, descricao=:descricao, linkedin=:linkedin, instagram=:instagram, email=:email WHERE id=:id";
            $edit_usuario = $conn->prepare($query_up_usuario);
            $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':linkedin', $dados['linkedin'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':instagram', $dados['instagram'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
            if($edit_usuario->execute()){
                echo"<script> alert('Suas informações foram alteradas com sucesso!');
                                    window.location.href='homeDev.php';
                    </script>";
            }else{
                echo"<script> alert('Erro: Não foi possível alterar suas informações, verifique os campos e tente novamente!');
                                    window.location.href='editar.php';
                    </script>";
            }
        }
    }
    ?>
    <?php
    //buscando os dados já cadastrados pelo usuário
    $query_usuario = "SELECT id, nome, email, usuario, desenvolvedor, descricao, linkedin, instagram FROM users WHERE id=$id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();
    ?>
    <?php
    //verificando se existe algum dado cadastrado
    if(($result_usuario) AND ($result_usuario->rowCount() !=0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);
    ?>
    <header>
        <div class="box">
            <p id="key">>></p><div class="usuario">Modo Edição de Perfil</div>
        </div>
        <div id="sair"><a href="sair.php">Sair</a></div>
        </header>
        <section class="wrapper">
            <form id="edit-usuario" method="POST" action="">
                <img id="img" src="img/img1.png">
                <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
                                    if(isset($dados['nome'])){
                                        echo $dados['nome'];
                                    }elseif(isset($row_usuario['nome'])){
                                        echo $row_usuario['nome'];
                                    }?>">
                <div class="container">
                    <h2>Descrição</h2>
                    <textarea style="color: aliceblue;" name='descricao'  id='descricao'><?php
                                    if(isset($dados['descricao'])){
                                        echo $dados['descricao'];
                                    }elseif(isset($row_usuario['descricao'])){
                                        echo $row_usuario['descricao'];
                                    }?>
                    </textarea>
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
                        <div class='SkillBox'>
                            <input type='text' name='linkedin' id='linkedin' placeholder='Informe seu LinkedIn' value="<?php
                                    if(isset($dados['linkedin'])){
                                        echo $dados['linkedin'];
                                    }elseif(isset($row_usuario['linkedin'])){
                                        echo $row_usuario['linkedin'];
                                    }?>">
                        </div>
                        <div class='SkillBox'>
                            <input type='text' name='instagram' id='instagram' placeholder='Informe seu Instagram' value="<?php
                                    if(isset($dados['instagram'])){
                                        echo $dados['instagram'];
                                    }elseif(isset($row_usuario['instagram'])){
                                        echo $row_usuario['instagram'];
                                    }?>">
                        </div>   
                        <div class='SkillBox'>
                            <input type='text' name='email' id='email' placeholder='Informe seu e-mail' value="<?php
                                    if(isset($dados['email'])){
                                        echo $dados['email'];
                                    }elseif(isset($row_usuario['email'])){
                                        echo $row_usuario['email'];
                                    }?>">
                        </div>
                    </div>
                    <div class='Skillfilde'>
                        <div id='voltar'>
                            <input type='submit' value='Salvar' name='EditarUsuario'>
                        </div>
                        <div id='voltar'>
                            <a href='homeDev.php'>Voltar</a>
                        </div>
                    </div>
            </form> 
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
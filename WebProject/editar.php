<?php
session_start();
include_once "conexao.php";

//error_reporting(0);

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
    <link rel='stylesheet' type='text/css' href='css/editar.css'>
    <title>Editar Perfil</title>
</head>
<body>
    <?php
    //recebendo dados do formulário alterado
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // verificando se o usuário clicou no botão 'Salvar'
    if(!empty($dados['EditarUsuario'])){
        $empty_input = false;
        $arquivo = $_FILES['FotoUsuario'];
        $dados = array_map('trim', $dados);
        //verificando se o usuário preencheu todos os campos
        if(in_array("", $dados)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Necessário preencher todos os campos</p>";
        }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Formato de e-mail inválido</p>";
        }if(!$empty_input){
            $query_up_usuario = "UPDATE users SET nome=:nome, usuario=:usuario, senha=:senha, descricao=:descricao, instagram=:instagram, email=:email, html=:html, css=:css, php=:php, javascript=:javascript, perfilgithub=:perfilgithub, FotoUsuario=:FotoUsuario  WHERE id=:id";
            $edit_usuario = $conn->prepare($query_up_usuario);
            $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':instagram', $dados['instagram'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':html', $dados['html'], PDO::PARAM_INT);
            $edit_usuario->bindParam(':css', $dados['css'], PDO::PARAM_INT);
            $edit_usuario->bindParam(':php', $dados['php'], PDO::PARAM_INT);
            $edit_usuario->bindParam(':javascript', $dados['javascript'], PDO::PARAM_INT);
            $edit_usuario->bindParam(':perfilgithub', $dados['perfilgithub'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':FotoUsuario', $arquivo['name'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
            $edit_usuario->execute();
            if($edit_usuario->rowCount()){
                if((isset($arquivo['name'])) AND (!empty($arquivo['name']))){
                    //Diretorio onde a imagem será salva
                    $diretorio = "img/$id/";
                    //verificar se o diretorio existe
                    if((!file_exists($diretorio)) AND (!is_dir($diretorio))){
                        //criando diretorio
                        mkdir($diretorio, 0755);
                    }
                    //fazendo o up load da imagem
                    $nome_img = $arquivo['name'];
                    if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_img)){
                        if(((!empty($row_usuario['FotoUsuario'])) or ($row_usuario['FotoUsuario'] != null)) AND ($row_usuario['FotoUsuario'] != $arquivo['name'])){
                            $endereco_imagem = "img/$id/". $row_usuario['FotoUsuario'];
                            if(file_exists($endereco_imagem)){
                                unlink($endereco_imagem);
                            }
                        }
                    }
                    echo"<script> alert('Suas informações foram alteradas com sucesso!');
                                    window.location.href='homeDev.php';
                    </script>";
                }
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
    $query_usuario = "SELECT id, nome, email, usuario, senha, desenvolvedor, descricao, instagram, html, css, php, javascript, perfilgithub, FotoUsuario FROM users WHERE id=$id LIMIT 1";
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
            <form id="edit-usuario" method="POST" action="" enctype="multipart/form-data">
                <?php
                if((!empty($FotoUsuario)) AND (file_exists("img/$id/$FotoUsuario"))){
                    echo "<img class='imgUsuario' src='img/$id/$FotoUsuario'>";
                }else{
                    echo "<img src='img/img1.png'>";
                }
                ?>
                
                <input type="file" name="FotoUsuario" id="FotoUsuario">
                <input class="input" type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
                                    if(isset($dados['nome'])){
                                        echo $dados['nome'];
                                    }elseif(isset($row_usuario['nome'])){
                                        echo $row_usuario['nome'];
                                    }?>">
                <input class="input" type="text" name="usuario" id="usuario" placeholder="Nome de usuário" value="<?php
                                    if(isset($dados['usuario'])){
                                        echo $dados['usuario'];
                                    }elseif(isset($row_usuario['usuario'])){
                                        echo $row_usuario['usuario'];
                                    }?>">
                <input class="input" type="password" name="senha" id="senha" placeholder="informe sua senha"  value="<?php
                                    if(isset($dados['senha'])){
                                        echo $dados['senha'];
                                    }elseif(isset($row_usuario['senha'])){
                                        echo $row_usuario['senha'];
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
                    <div class='SkillBox'>
                        <?php
                            if(isset($row_usuario['html']) AND ($row_usuario['html'] == 1)){
                                $selecionado = "checked";
                            }else{
                                $selecionado = "";
                            }
                        ?>
                        <input class="checkbox" type='checkbox' name='html' id='html' value="1" <?php echo $selecionado?>><p style='color: #f00;'>HTML</p>
                        <?php
                            if(isset($row_usuario['css']) AND ($row_usuario['css'] == 1)){
                                $selecionado = "checked";
                            }else{
                                $selecionado = "";
                            }
                        ?>
                        <input class="checkbox" type='checkbox' name='css' id='css' value="1" <?php echo $selecionado?>><p style='color: #000080;'>CSS</p>
                        <?php
                            if(isset($row_usuario['php']) AND ($row_usuario['php'] == 1)){
                                $selecionado = "checked";
                            }else{
                                $selecionado = "";
                            }
                        ?>
                        
                        <input class="checkbox" type='checkbox' name='php' id='php' value="1" <?php echo $selecionado?>><p style='color: aqua;'>PHP</p>
                        <?php
                            if(isset($row_usuario['javascript']) AND ($row_usuario['javascript'] == 1)){
                                $selecionado = "checked";
                            }else{
                                $selecionado = "";
                            }
                        ?>
                        
                        <input type='checkbox' name='javascript' id='javascript' value="1" <?php echo $selecionado?>><p style='color: yellow;'>JavaScript</p>
                    </div>
                    </div>
                    <h2>Perfil do GitHub</h2>
                        <div class='Skillfilde'>
                        <input class="input" type='text' name='perfilgithub' id='perfilgithub' placeholder='Informe seu GitHub' style="width: 255px; text-decoration: underline;" value="<?php
                                    if(isset($dados['perfilgithub'])){
                                        echo $dados['perfilgithub'];
                                    }elseif(isset($row_usuario['perfilgithub'])){
                                        echo $row_usuario['perfilgithub'];
                                    }?>">
                    </div>
                    <h2>Contato</h2>
                    <div class='Skillfilde-contato'>
                            <input class="input" type='text' name='instagram' id='instagram' placeholder='Informe seu Instagram' value="<?php
                                    if(isset($dados['instagram'])){
                                        echo $dados['instagram'];
                                    }elseif(isset($row_usuario['instagram'])){
                                        echo $row_usuario['instagram'];
                                    }?>">
                          
                        
                            <input class="input" type='text' name='email' id='email' placeholder='Informe seu e-mail' style="width: 250px;" value="<?php
                                    if(isset($dados['email'])){
                                        echo $dados['email'];
                                    }elseif(isset($row_usuario['email'])){
                                        echo $row_usuario['email'];
                                    }?>">
                        
                    </div>
                    <div class='Skillfilde'>
                        <div class="btn">
                        <a href='homeDev.php' style="font-size: 14px; font-weight: bold; cursor: pointer;" >Voltar</a>
                        </div>
                        <div class="btn">
                            <input id="submit" type='submit' value='Salvar' name='EditarUsuario'>
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
</html>
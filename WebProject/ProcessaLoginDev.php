<?php
session_start();
include_once('conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['usuario'])){
    echo"<script> alert('Preencha o campo Usuário!');
    window.location.href='loginDev.php';
    </script>";
}elseif(empty($dados['senha'])){
    echo"<script> alert('Preencha o campo Senha!');
    window.location.href='loginDev.php';
    </script>";
}else{
    $query_usuario = "SELECT id, nome, usuario, senha
                FROM users
                WHERE senha=:senha
                LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            echo"<script>
                    window.location.href='homeDev.php';
                </script>";
            $_SESSION['id'] =  $row_usuario['id'];
            $_SESSION['nome'] =  $row_usuario['nome'];
    }else{
        echo"<script> alert('Dados de Login incorreto!');
        window.location.href='loginDev.php';
        </script>";
    }    
}
?>
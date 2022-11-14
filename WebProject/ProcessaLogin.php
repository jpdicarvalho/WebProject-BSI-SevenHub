<?php
include_once('conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['usuario'])){
    echo"<script> alert('Preencha o campo Usuário');
    window.location.href='login.php';
    </script>";
}elseif(empty($dados['senha'])){
    echo"<script> alert('Preencha o campo Senha');
    window.location.href='login.php';
    </script>";
}else{
    $query_usuario = "SELECT id, nome, usuario, senha
                FROM users
                WHERE usuario=:usuario
                LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        if(($dados['senha'] == $row_usuario['senha'])){
            echo"<script>
                    window.location.href='home.php';
                </script>";
            //$_SESSION['id'] =  $row_usuario['id'];
            //$_SESSION['nome'] =  $row_usuario['nome'];
           //$retorna = ['erro'=> false, 'dados' => $row_usuario];
        }else{
            echo"<script> alert('Senha Incorreta');
            window.location.href='login.php';
            </>";
        }        
    }else{
        echo"<script> alert('Usuário Incorreto');
        window.location.href='login.php';
        </script>";
    }    
}
?>
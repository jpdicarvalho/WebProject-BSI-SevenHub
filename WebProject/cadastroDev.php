<?php
include_once('conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['nome'])){
    echo"<script> alert('Preencha o campo Nome!');
    window.location.href='cadastro.html';
    </script>";
}elseif(empty($dados['email'])){
    echo"<script> alert('Preencha o campo E-mail!');
    window.location.href='cadastro.html';
    </script>";
}elseif(empty($dados['usuario'])){
    echo"<script> alert('Preencha o campo Usuário!');
    window.location.href='cadastro.html';
    </script>";
}elseif(empty($dados['senha'])){
    echo"<script> alert('Preencha o campo Senha!');
    window.location.href='cadastro.html';
    </script>";
}elseif(empty($dados['desenvolvedor'])){
    echo"<script> alert('Selecione uma opção de Desenvolvedor!');
    window.location.href='cadastro.html';
    </script>";
}else{
    $query_consulta = "SELECT id FROM users WHERE email=:email LIMIT 1";
    $result_consulta = $conn->prepare($query_consulta);
    $result_consulta->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_consulta->execute();

    if(($result_consulta) and ($result_consulta->rowCount() !=0)){
        echo"<script> alert('E-mail já cadastrado na plataforma!');
        window.location.href='cadastro.html';
        </script>";
    }

    $query_usuario = "INSERT INTO users (nome, email, usuario, senha, desenvolvedor) VALUES
    (:nome, :email, :usuario, :senha, :desenvolvedor)";

    $cadastro = $conn->prepare($query_usuario);

    $cadastro->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cadastro->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cadastro->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $cadastro->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    $cadastro->bindParam(':desenvolvedor', $dados['desenvolvedor'], PDO::PARAM_STR);

    $cadastro->execute();

    if($cadastro->rowCount()){
    echo"<script> alert('Usuário cadastrado com sucesso!');
    window.location.href='loginDev.php';
    </script>";
    }else{
        echo"<script> alert('Não foi possivél realizar o cadastro');
    window.location.href='loginDev.php';
    </script>";
    }
}
?>
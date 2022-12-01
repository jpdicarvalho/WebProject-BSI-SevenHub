<?php
include_once('conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['nome'])){
    echo"<script> alert('Preencha o campo Nome!');
    window.location.href='cadastroEmp.html';
    </script>";
}elseif(empty($dados['email'])){
    echo"<script> alert('Preencha o campo E-mail!');
    window.location.href='cadastroEmp.html';
    </script>";
}elseif(empty($dados['usuario'])){
    echo"<script> alert('Preencha o campo Usuário!');
    window.location.href='cadastroEmp.html';
    </script>";
}elseif(empty($dados['senha'])){
    echo"<script> alert('Preencha o campo Senha!');
    window.location.href='cadastroEmp.html';
    </script>";
}else{
    $query_consulta = "SELECT id FROM empresas WHERE email=:email LIMIT 1";
    $result_consulta = $conn->prepare($query_consulta);
    $result_consulta->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_consulta->execute();

    if(($result_consulta) and ($result_consulta->rowCount() !=0)){
        echo"<script> alert('E-mail já cadastrado na plataforma!');
        window.location.href='cadastroEmp.html';
        </script>";
    }

    $query_usuario = "INSERT INTO empresas (nome, email, usuario, senha) VALUES
    (:nome, :email, :usuario, :senha)";

    $cadastro = $conn->prepare($query_usuario);

    $cadastro->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cadastro->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cadastro->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $cadastro->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);

    $cadastro->execute();

    if($cadastro->rowCount()){
    echo"<script> alert('Usuário cadastrado com sucesso!');
    window.location.href='loginEmp.php';
    </script>";
    }else{
        echo"<script> alert('Não foi possivél realizar o cadastro');
    window.location.href='loginEmp.php';
    </script>";
    }
}
?>
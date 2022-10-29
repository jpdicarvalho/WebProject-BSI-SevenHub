<?php
include_once('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$user = $_POST['user'];
$password = $_POST['password'];
$desenvolvedor = $_POST['desenvolvedor'];

$sql_cadastro = mysqli_query($conexao, "INSERT INTO users (nome, email, usuario, senha, desenvolvedor) values ('$nome','$email',
'$user','$password','$desenvolvedor') ");

if($sql_cadastro==true){
    echo"<script>
    alert('Cadastro realizado com sucesso!');
    window.location.href='Login.html';
    </script>";
}else{
    echo"<script>
    alert('Cadastro não realizado, verifique os dados informados.);
    window.location.href='cadastro.html';
    </script>";
}

?>
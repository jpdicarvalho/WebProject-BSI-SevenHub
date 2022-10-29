<?php
include_once('conexao.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql_logar=mysqli_query($conexao,"SELECT * FROM users WHERE usuario='$usuario' and senha='$senha'");

if(mysqli_num_rows($sql_logar) !=0){
    header('location:index.html');
}else{
    echo"<script>
    alert('Usuário não registrado.');
    window.location.href='Login.html';
    </script>";
}
?>
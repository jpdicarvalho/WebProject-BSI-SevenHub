<?php
$conexao=mysqli_connect('localhost','root','', 'cadastro');
if($conexao==true){
    echo'foi';
}else{
    echo'não foi';
}
?>
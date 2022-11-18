<?php
session_start();
//Destruindo as variáveis globais para encerrar a sessão
unset($_SESSION['id'], $_SESSION['nome']);
header("Location: index.html");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LoginEmp</title>

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
    <p id="key">{</p><p>SevenHub</p><p id="key">}</p>
    </header>
        <div class="container">
            <form method="POST" action="ProcessaLoginEmp.php">
            <h3>Login</h3>
                <div class="inputBox">
                    <span>Usuário</span>
                    <div class="box">
                        <input type="text" name="usuario" placeholder="Digite aqui...">
                    </div>
                </div>
                <div class="inputBox">
                    <span>Senha</span>
                    <div class="box">
                        <input type="password" name="senha" placeholder="Digite aqui...">
                    </div>
                </div> 
                <div class="inputBox">
                    <div class="box">
                        <input type="submit" value="login">
                    </div>
                </div>
                <a href="cadastroEmp.html" class="forgot">Criar conta</a><br>
            </form>
            
        </div>
    <span>[Copyright © SevenHub 2022. Todos os direitos reservados];</span>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
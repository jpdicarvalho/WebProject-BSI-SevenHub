<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LoginDev</title>

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <img src="img/logo-SevenHub.png" alt="logo da Plataforma SevenHub">
    </header>
    <section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
        <div class="container">
            <form method="POST" action="ProcessaLoginDev.php">
                <h3>Login</h3>
                <div class="inputBox">
                    <span>Usuário</span>
                    <div class="box">
                        <div class="icon">
                            <ion-icon name="person"></ion-icon>
                        </div>
                        <input type="text" name="usuario">
                    </div>
                </div>
                <div class="inputBox">
                    <span>Senha</span>
                    <div class="box">
                        <div class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </div>
                        <input type="password" name="senha">
                    </div>
                </div>
                <label>
                    <input type="checkbox">Lembre-me</label>
                <div class="inputBox">
                    <div class="box">
                        <input type="submit" value="login">
                    </div>
                </div>
                <a href="cadastro.html" class="forgot">Criar conta</a><br>
            <a href="#" class="forgot">Esqueci minha senha</a>
            </form>
            <span>[Copyright © SevenHub 2022. Todos os direitos reservados];</span>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
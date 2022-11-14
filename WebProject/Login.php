<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/Login.css">
    <title>Login</title>
</head>
<html>

<body>
    <div class="container">
        <form method="POST" action="ProcessaLogin.php">
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
    </div>
    <div class="BarraLogin">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
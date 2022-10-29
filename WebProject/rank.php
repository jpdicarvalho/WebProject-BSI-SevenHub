<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/rank.css">
    <title>rankphp</title>
</head>
<body>
    <div id="progressbar"></div>
    <div id="scrollPath"></div>
    <?php
        include_once('conexao.php');

        $sql = "SELECT nome, usuario, desenvolvedor FROM users";
        $resultado = $conexao->query($sql);
    ?>
    <div class="box">
    <?php
        while($registro = mysqli_fetch_assoc($resultado)){
            echo"<div class='list'>
                    <div class='imgBx'>
                        <img src='img/img1.png'>
                    </div>
                        <div id='DivNome'>".$registro['nome']."</div>
                        <div id='DivDev'>".$registro['desenvolvedor']."</div>
                </div>";
        }
    ?>        
    </div>
    <script type="text/javascript">
    let progress = document.getElementById('progressbar'
      );
    let totalHeight = document.body.scrollHeight - window.innerHeight;
    window.onscroll = function(){
        let progressHeight = (window.pageYOffset / totalHeight) * 100;
        progress.style.height = progressHeight + "%";
    }
</script>
</body>
</html>
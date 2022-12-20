<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <title>Confeitaria CMC - Login</title>
</head>
<body>
    <div id="page-home">
        <div class="content">
            <header>
                <h3><img src="../../imagens/icone.jpeg" alt="Logomarca" height="42" width="42"></h3>
                <a href="../../../index.php"><h1>Bolos CMC</h1></a>
                <h4></h4>
            </header>
            <main>
                <br>
                <h1 style="text-align: center">Login</h1>
                <br>
                <center>
                <form method="post" action="../../../Controller/UsuarioController.php?acao=efetuarLogin">
                    <input type="text" id="loginInserido" name="loginInserido" placeholder="insira o login (email)">
                    <input type="password" id="senhaLogin" name="senhaLogin" placeholder="insira a senha">
                    <input type="submit" value="Logar">
                </form>

                    <h3>Se não tiver uma conta <a href="cadastro_usuario.php">Cadatre-se</a>.</h3>
                </center>
            </main>

    <?php
    include_once("../fixos/rodape.html");
    ?>
        </div>
    </div>
</body>
</html>
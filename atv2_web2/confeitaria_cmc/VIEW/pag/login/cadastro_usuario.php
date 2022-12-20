<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <title>Confeitaria CMC - Cadastro</title>
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
                <?php if (isset($_SESSION['mensagemSistema'])): 
                    $mensagem = isset($_SESSION['mensagemSistema']) ? $_SESSION['mensagemSistema'] : "";
                    ?>
                
                    <div>
                        <strong><?php echo $mensagem; ?></strong> 
                    </div>

                <?php
                unset($_SESSION['mensagemSistema']);
                endif; ?>
                
                <br>
                <h1 style="text-align: center">Cadastro</h1>
                <br>
                <center>
                    <form method="post" action="../../../Controller/UsuarioController.php?acao=cadastroUsuario">
                        <input type="text" id="nome" name="nome" placeholder="Insira o nome" required>
                        <input type="email" id="email" name="email" placeholder="Insira o email" required>
                        <input type="password" id="senha" name="senha" placeholder="Insira a senha" required>
                        <input type="submit" value="Cadastrar">
                    </form>
                    <br>
                    <h3>Se já tiver uma conta efetue o <a href="../../../Controller/UsuarioController.php?acao=login">Login</a></h3>
                </center>
            </main>

            <footer>
                Desenvolvido no IFMS - Meyson Freitas & Carlos Santos & Caio Melo &copy; 2020 <br>
                <p>Todos os Direitos Reservados</p>
            </footer>
        </div>
    </div>
</body>
</html>
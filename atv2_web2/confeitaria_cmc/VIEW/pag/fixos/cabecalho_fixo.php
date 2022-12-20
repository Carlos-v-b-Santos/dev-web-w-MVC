<!DOCTYPE html>

<html>

    <head>
        <?php
        include_once '../../../config/Constantes.php';
        require_once __RAIZ__ . '/MODEL/Usuario.php';
        require_once __RAIZ__ . '/MODEL/Encomenda.php';
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ?>

    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">


    </head>

    <header>

        <?php if (!isset($_SESSION['usuario_logado'])): ?>
            <header>
                <h4><a href="../../../Controller/UsuarioController.php?acao=login">Login</a>|<a href="../../login/cadastro_usuario.php">Cadatre-se</a> </h4>
            </header>

            <main>
                <center><img src="../../imagens/icone.jpeg" alt="Logomarca" height="400" width="400"></center>
                <h1 style="text-justify: auto; text-indent: 30px;">A melhor confeitaria do Mato Grosso do Sul</h1>
                <center><h3> Faça o <a href="../../../Controller/UsuarioController.php?acao=login">Login</a> na sua conta para fazer pedidos.
                <br>ou<br>
                Se não tiver uma conta <a href="../login/cadastro_usuario.php">Cadatre-se</a>.</h3></center>
            </main>

        <?php elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "ADMIN"): ?>
            <div class="content">
            <header>
                <h3><img src="../../imagens/icone.jpeg" alt="Logomarca" height="42" width="42"></h3>
                <h1>Bolos CMC</h1>
                <h4><a href="../../../Controller/UsuarioController.php?acao=logout">Logout</a></h4>
            </header>
            <nav>
                <a href="../../../Controller/AdminController.php?acao=listarEncomendasUsuarios" style=" border-top-left-radius: 8px; border-bottom-left-radius: 8px">Gerenciar Encomendas</a>
                <a href="../../../Controller/BoloController.php?acao=listarTodos">Gerenciar Cardápio</a>
                <a href="../sobre/sobre.php"; style=" border-top-right-radius: 8px;border-bottom-right-radius: 8px";>Sobre a Página</a>
                
            </nav>
            </div>
        <?php elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "CLIENTE"): ?>

                <div class="content">
                    <header>
                <h3><img src="../../imagens/icone.jpeg" alt="Logomarca" height="42" width="42"></h3>
                <h1>Bolos CMC</h1>
                <h4><a href="../../../Controller/UsuarioController.php?acao=logout">Logout</a></h4>
            </header>
                    <nav>
                    <a href="../carrinho/gerenciar_carrinho.php" style=" border-top-left-radius: 8px; border-bottom-left-radius: 8px">Faça seu pedido</a>
                    <a href="../sobre/sobre.php"; style=" border-top-right-radius: 8px;border-bottom-right-radius: 8px";>Sobre a Pagina</a>         
            </nav>
                </div>
        <?php endif; ?>        




    </header>


</html>

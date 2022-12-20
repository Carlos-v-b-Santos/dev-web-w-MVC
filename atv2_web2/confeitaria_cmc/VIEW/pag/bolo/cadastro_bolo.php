<!DOCTYPE html>
<html lang="en">

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">

</head>

<body>
    <div id="page-home">
    <?php
    include_once("../fixos/cabecalho_fixo.php");
    require_once __RAIZ__ . '/Model/Bolo.php';

    $id_opcao = unserialize($_SESSION['editar_bolo'])->getId_opcao();
    $nome = unserialize($_SESSION['editar_bolo'])->getNome();
    $tipo = unserialize($_SESSION['editar_bolo'])->getTipo();
    $preco = unserialize($_SESSION['editar_bolo'])->getPreco();
?>
    <div id="page-home">
        <div class="content">
            <header>
                <h3><img src="../../imagens/icone.jpeg" alt="Logomarca" height="42" width="42"></h3>
                
                <h4></h4>
            </header>
            <main>
                
                <div>
                    <center><h3><?php echo $id_opcao==null?"Cadastro":"Edição" ?> de opções</h3></center>
                </div>

                <center>
                    <form method="post" action="../../../Controller/BoloController.php?acao=cadastrarBolo">


                    <div>
                        <div>
                            <input type="hidden" id="id_opcao" name="id_opcao"  value="<?php echo $id_opcao; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="tipo">Tipo:</label>
                        <div>

                            <select name="tipo" id="tipo">
                                <option value="tamanho">Tamanho</option>
                                <option value="cobertura">Cobertura</option>
                                <option value="recheio">Recheio</option>
                                <option value="massa">Massa</option>
                            </select>                            

                        </div>
                    </div>

                    <div>
                        <label for="nome">Nome:</label>
                        <div>
                            <input type="text" id="nome" name="nome" placeholder="Insira o nome" value="<?php echo $nome; ?>">
                        </div>
                    </div>

                    <div>
                        <label for="preco">Preço:</label>
                        <div>
                            <input type="number" min="1" step="any"  id="preco" name="preco" placeholder="Insira o preço (xx.xx)"  value="<?php echo $preco; ?>">
                        </div>
                    </div>

                    <input type="submit" value="<?php echo $id_opcao==null?"Cadastrar":"Editar" ?>" />

            </div>
        </form>
                    <br>
                </center>
            </main>
</div>

        </div>
    </div>
                <?php
    include_once("../fixos/rodape.html");
    ?>
    
</body>
</html>
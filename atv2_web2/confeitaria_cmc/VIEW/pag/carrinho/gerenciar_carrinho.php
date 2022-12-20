<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<!-- Include cabeçalho -->


<head

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      

<!--css criado para paginas desse estilo de gerenciamento-->
<link rel="stylesheet" type="text/css" href="../css/tabelas.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!--Icones-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="../css/menu.css" rel="stylesheet">



<script>
    $(document).ready(function () {
                // Activate tooltip
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>



    </head>

    <body>
<div id="page-home">
    <?php
include_once "../fixos/cabecalho_fixo.php";
require_once __RAIZ__ . '/MODEL/Bolo.php';
?>



        <div class="container">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-7">
                                <h2><b>Encomendar</b></h2>
                            </div>

                        </div>
                    </div>

    <form method="post" action="../../../Controller/CarrinhoController.php?acao=finalizarCompra">



        <table class="table table-striped table-hover">

                            <tbody>

                                <tr>Tamanho:
                                    <select name="tamanho" id="tamanho" class="form-control">
                                        <?php
                                        $registrosObtidos = unserialize($_SESSION['listaBolos']);
                                        foreach ($registrosObtidos as $boloOBJ) {

                                            if ($boloOBJ->getTipo() == 'tamanho') {
                                                ?>
                                                <option value="<?php echo $boloOBJ->getId_opcao(); ?>"><?php echo $boloOBJ->getNome(); echo ', R$ ' . $boloOBJ->getPreco(); ?></option>
                                                <?php
                                            }
                                        }?>

                                    </select> 
                                </tr>
                                <tr>Cobertura:
                                    <select name="cobertura" id="cobertura" class="form-control">
                                        <?php
                                        $registrosObtidos = unserialize($_SESSION['listaBolos']);
                                        foreach ($registrosObtidos as $boloOBJ) {

                                            if ($boloOBJ->getTipo() == 'cobertura') {
                                                ?>
                                                <option value="<?php echo $boloOBJ->getId_opcao(); ?>"><?php echo $boloOBJ->getNome(); echo ', R$ ' . $boloOBJ->getPreco(); ?></option>
                                                <?php
                                            }
                                        }?>

                                    </select> 
                                </tr>

                                <tr>Recheio:
                                    <select name="recheio" id="recheio" class="form-control">
                                        <?php
                                        $registrosObtidos = unserialize($_SESSION['listaBolos']);
                                        foreach ($registrosObtidos as $boloOBJ) {

                                            if ($boloOBJ->getTipo() == 'recheio') {
                                                ?>
                                                <option value="<?php echo $boloOBJ->getId_opcao(); ?>"><?php echo $boloOBJ->getNome(); echo ', R$ ' . $boloOBJ->getPreco(); ?></option>
                                                <?php
                                            }
                                        }?>

                                    </select> 
                                </tr>

                                <tr>Massa:
                                    <select name="massa" id="massa" class="form-control">
                                        <?php
                                        $registrosObtidos = unserialize($_SESSION['listaBolos']);
                                        foreach ($registrosObtidos as $boloOBJ) {

                                            if ($boloOBJ->getTipo() == 'massa') {
                                                ?>
                                                <option value="<?php echo $boloOBJ->getId_opcao(); ?>"><?php echo $boloOBJ->getNome(); echo ', R$ ' . $boloOBJ->getPreco(); ?></option>
                                                <?php
                                            }
                                        }?>

                                    </select> 
                                </tr>
                        </table>
                        <input type="submit" class="fadeIn second" value="Finalizar compra" />
                    </form>

                </div>

                <?php
                if (isset($_SESSION['mensagemSistema'])):
                    $mensagem = isset($_SESSION['mensagemSistema']) ? $_SESSION['mensagemSistema'] : "";
                    unset($_SESSION["carrinho"]);
                    ?>

                    <div class = "alert alert-info">
                        <strong><?php echo $mensagem; ?></strong> 
                    </div>

                    <?php
                    unset($_SESSION['mensagemSistema']);
                endif;
                ?>

            </div>        
        </div>


</div>
<?php
    include_once("../fixos/rodape.html");
    ?>
    </body>
    
    </html>

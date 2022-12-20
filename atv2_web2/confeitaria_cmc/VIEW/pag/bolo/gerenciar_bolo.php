<!DOCTYPE html>
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




        <script>
            $(document).ready(function () {
                // Activate tooltip
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>



    </head>

    <body background-image="../../imagens/background.svg">
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
                                <h2>Gerenciar <b>Bolos</b></h2>
                            </div>
                            <div class="col-xs-7">
                                <a href="../../../Controller/BoloController.php?acao=adicionar"   class="btn btn-success" data-toggle='tooltip' title="Adicionar nova opção" >
                                    <i class="material-icons" data-toggle="tooltip" >&#xE147;</i> <span>Adicionar nova opção</span></a>
                                <a href="../../../Controller/BoloController.php?acao=listarTodos"   class="btn btn-success" data-toggle='tooltip' title="Listar Todos" >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir Todos</span></a>      

                                <a href="../../../Controller/BoloController.php?acao=listarTamanhos"    class="btn btn-success" data-toggle='tooltip' title="Listar Tamanhos"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir Tamanhos</span></a>    


                                <a href="../../../Controller/BoloController.php?acao=listarCoberturas"    class="btn btn-success" data-toggle='tooltip' title="Listar Coberturas"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir Coberturas</span></a>

                                <a href="../../../Controller/BoloController.php?acao=listarRecheios"    class="btn btn-success" data-toggle='tooltip' title="Listar Recheios"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir Recheios</span></a>    

                                <a href="../../../Controller/BoloController.php?acao=listarMassas"    class="btn btn-success" data-toggle='tooltip' title="Listar Massas"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir Massas</span></a>
                            </div>
                        </div>

                    </div>
                    <?php
                    if (isset($_SESSION['mensagemSistema'])):
                        $mensagem = isset($_SESSION['mensagemSistema']) ? $_SESSION['mensagemSistema'] : "";
                        ?>

                        <div class = "alert alert-info">
                            <strong><?php echo $mensagem; ?></strong> 
                        </div>

                        <?php
                        unset($_SESSION['mensagemSistema']);
                    endif;
                    ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $registrosObtidos = unserialize($_SESSION['listaBolos']);

                            foreach ($registrosObtidos as $boloOBJ) {
                                ?>

                                <tr>
                                    <td><?php echo $boloOBJ->getId_opcao(); ?></td>
                                    <td><?php echo $boloOBJ->getTipo(); ?></td>
                                    <td><?php echo $boloOBJ->getNome(); ?></td>
                                    <td><?php echo 'R$ ' . $boloOBJ->getPreco(); ?></td>
                                    <td>
                                        <a href="../../../Controller/BoloController.php?acao=editar&id=<?php echo $boloOBJ->getId_opcao(); ?>"  class="edit" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>         
                                        <a href="../../../Controller/BoloController.php?acao=remover&id=<?php echo $boloOBJ->getId_opcao(); ?>" class="delete" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>                  
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>       
                </div>
            </div>        
        </div>


</div>
    </body>

    <!-- Include rodapé -->
    <?php
    include_once("../fixos/rodape.html");
    ?>
</html>

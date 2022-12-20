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
                
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>



    </head>

    <body>
        <div id="page-home">
        <?php
        include_once "../fixos/cabecalho_fixo.php";
        ?>

        <div class="container">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-7">
                                <h2>Gerenciar <b>Encomendas</b></h2>
                            </div>

                            <div class="col-xs-7">
                                <a href="../../../Controller/AdminController.php?acao=listarCancelados"   class="btn btn-success" data-toggle='tooltip' title="Listar Encomendas Cancelados" >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir "Cancelados"</span></a>      

                                <a href="../../../Controller/AdminController.php?acao=listarFinalizados"    class="btn btn-success" data-toggle='tooltip' title="Listar Encomendas Finalizados"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir "Finalizados"</span></a>    


                                <a href="../../../Controller/AdminController.php?acao=listarEncomendasUsuarios"    class="btn btn-success" data-toggle='tooltip' title="Listar Encomendas Em Andamento"  >
                                    <i class="material-icons" data-toggle="tooltip" >search</i> <span>Exibir "Em Andamento"</span></a>    

                            </div>

                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Descrição</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $registrosObtidos = unserialize($_SESSION['listaEncomendas']);
                            foreach ($registrosObtidos as $encomendaOBJ) {
                                ?>

                                <tr>
                                    <td><?php echo $encomendaOBJ->getData(); ?></td>
                                    <td><?php echo $encomendaOBJ->getUsuario()->getNome(); ?></td>
                                    <td><?php echo $encomendaOBJ->getUsuario()->getEmail(); ?></td>
                                    <td><?php ?></td>
                                    <td><?php echo 'R$ ' . $encomendaOBJ->getValorTotal(); ?></td>
                                    <td><?php echo $encomendaOBJ->getStatus(); ?></td>
                                    <td>
                                        <a href="../../../Controller/AdminController.php?acao=finalizarEncomenda&id=<?php echo $encomendaOBJ->getId_encomenda(); ?>"  class="edit" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Finalizar Encomenda">done</i></a>                                              
                                        <a href="../../../Controller/AdminController.php?acao=cancelarEncomenda&id=<?php echo $encomendaOBJ->getId_encomenda(); ?>" class="delete" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Cancelar Encomenda">remove_circle</i></a>                                  

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>


</div>
    <?php
    include_once("../fixos/rodape.html");
    ?>
    </body>

</html>

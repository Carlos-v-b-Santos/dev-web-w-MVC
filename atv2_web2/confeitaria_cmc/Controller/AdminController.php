<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../config/ControleConexao.php");
include_once("../DAO/BoloDAO.php");
include_once("../DAO/EncomendaDAO.php");
include_once("../MODEL/Bolo.php");
include_once("../MODEL/Usuario.php");
include_once("../config/conexao.php");
include_once("../config/Constantes.php");


$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$boloDAO = new BoloDAO();
$encomendaDAO = new EncomendaDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);


switch ($acao) {

    case $acao == "listarEncomendasUsuarios":


        $listaEncomendas = $encomendaDAO->buscarEncomendasStatus("EM ANDAMENTO");

        $_SESSION['listaEncomendas'] = serialize($listaEncomendas);
        header('location: ../VIEW/pag/encomendas/gerenciar_encomendas.php');
        exit();
        break;


    case $acao == "listarFinalizados":

        $listaEncomendas = $encomendaDAO->buscarEncomendasStatus("FINALIZADO");

        $_SESSION['listaEncomendas'] = serialize($listaEncomendas);
        header('location: ../VIEW/pag/encomendas/gerenciar_encomendas.php');
        exit();
        break;

    case $acao == "listarCancelados":

        $listaEncomendas = $encomendaDAO->buscarEncomendasStatus("CANCELADO");

        $_SESSION['listaEncomendas'] = serialize($listaEncomendas);
        header('location: ../VIEW/pag/encomendas/gerenciar_encomendas.php');
        exit();
        break;





    case $acao == "cancelarEncomenda":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $encomendaDAO->cancelarEncomenda($id);

        $listaEncomendas = $encomendaDAO->buscarEncomendasStatus("EM ANDAMENTO");

        $_SESSION['listaEncomendas'] = serialize($listaEncomendas);
        header('location: ../VIEW/pag/encomendas/gerenciar_encomendas.php');
        exit();

        break;

    case $acao == "finalizarEncomenda":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $encomendaDAO->finalizarEncomenda($id);

        $listaEncomendas = $encomendaDAO->buscarEncomendasStatus("EM ANDAMENTO");

        $_SESSION['listaEncomendas'] = serialize($listaEncomendas);
        header('location: ../VIEW/pag/encomendas/gerenciar_encomendas.php');
        exit();
        
        break;

    default:

        break;
}



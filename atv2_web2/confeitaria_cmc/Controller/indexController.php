<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("config/ControleConexao.php");
include_once("DAO/BoloDAO.php");
include_once("MODEL/Bolo.php");
include_once("config/conexao.php");
include_once("config/Constantes.php");

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);


$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

$boloDAO = new BoloDAO();
switch ($acao) {
    case $acao == "mostrarMenu":

        $resultados = $boloDAO->buscarTodos();
        unset($_SESSION['listaBolos']);
        $_SESSION['listaBolos'] = serialize($resultados);

        header('location: indexSite.php');
        exit();
        break;

    default:
        break;
}



function menu() {
    global $boloDAO;
    
    $resultados = $boloDAO->buscarTodos();
    unset($_SESSION['listaBolos']);
    $_SESSION['listaBolos'] = serialize($resultados);

    header('location: ../indexSite.php');
    exit();
}

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../config/ControleConexao.php");
include_once("../DAO/BoloDAO.php");
include_once("../MODEL/Bolo.php");
include_once("../config/conexao.php");
include_once("../config/Constantes.php");

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$boloDAO = new BoloDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);


switch ($acao) {

    case $acao == "adicionarCarrinho":
        $idBolo = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $resultado = $boloDAO->buscarRegistro($idBolo);

        $boloOBJ = (object) $resultado[0];
        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }


        $_SESSION["carrinho"][$boloOBJ->getId_opcao()] = serialize($boloOBJ);

        unset($_SESSION['mensagemSistema']);
        $_SESSION['mensagemSistema'] = "" . $boloOBJ->getNome() . " foi adicionado ao carrinho";


        header('location: ../index.php#menu');
        exit();
        break;



    case $acao == "listarTodos":
        atualizarListaAdmin();
        break;

    case $acao == "listarTamanhos":

        $listaBolos = $boloDAO->buscarBolosTipo("tamanho");

        $_SESSION['listaBolos'] = serialize($listaBolos);
        header('location: ../VIEW/pag/bolo/gerenciar_bolo.php');
        exit();
        break;

    case $acao == "listarCoberturas":

        $listaBolos = $boloDAO->buscarBolosTipo("cobertura");

        $_SESSION['listaBolos'] = serialize($listaBolos);
        header('location: ../VIEW/pag/bolo/gerenciar_bolo.php');
        exit();
        break;

    case $acao == "listarRecheios":

        $listaBolos = $boloDAO->buscarBolosTipo("recheio");

        $_SESSION['listaBolos'] = serialize($listaBolos);
        header('location: ../VIEW/pag/bolo/gerenciar_bolo.php');
        exit();
        break;

    case $acao == "listarMassas":

        $listaBolos = $boloDAO->buscarBolosTipo("massa");

        $_SESSION['listaBolos'] = serialize($listaBolos);
        header('location: ../VIEW/pag/bolo/gerenciar_bolo.php');
        exit();
        break;

    case $acao == "remover":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $boloDAO->remover($id);

        unset($_SESSION['mensagemSistema']);
        $_SESSION['mensagemSistema'] = 'Bolo removido com sucesso!';

        atualizarListaAdmin();
        break;

    case $acao == "editar":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['editar_bolo']);

        $resultado = $boloDAO->buscarRegistro($id);
        $_SESSION['editar_bolo'] = serialize($resultado[0]);


        header('location: ../VIEW/pag/bolo/cadastro_bolo.php');
        exit();
        break;

    case $acao == "adicionar":
        $_SESSION['editar_bolo'] = serialize(new Bolo());
        header('location: ../VIEW/pag/bolo/cadastro_bolo.php');
        exit();
        break;

    case $acao == "cadastrarBolo":


        if ($REQUEST == "POST") {
            $id_opcao = filter_input(INPUT_POST, 'id_opcao', FILTER_DEFAULT);
            $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);


            // Instanciar um novo Bolo e setar informações
            $boloNovo = new Bolo();

            $boloNovo->setId_opcao($id_opcao);
            $boloNovo->setNome($nome);
            $boloNovo->setPreco($preco);
            $boloNovo->setTipo($tipo);


            // Chamar o método inserir criado no DAO.
            if ($boloNovo->getId_opcao() == null) {
                $boloDAO->inserir($boloNovo);
                unset($_SESSION['mensagemSistema']);
                $_SESSION['mensagemSistema'] = 'Bolo Adicionado com sucesso!';
            } else {
                $boloDAO->atualizar($boloNovo);
                unset($_SESSION['mensagemSistema']);
                $_SESSION['mensagemSistema'] = 'Bolo Editado com sucesso!';
            }

            atualizarListaAdmin();
        }
        break;




    default:

        break;
}

function atualizarListaAdmin() {
    buscarTodos();
    header('location: ../VIEW/pag/bolo/gerenciar_bolo.php');
    exit();
}

//busca todos os bolos e insere na session

function buscarTodos() {
    // Chamar o método buscarTodos() criado no DAO.
    global $boloDAO;
    $resultados = $boloDAO->buscarTodos();
    unset($_SESSION['listaBolos']);
    $_SESSION['listaBolos'] = serialize($resultados);
}

<?php

/**/
session_start();
include_once("../config/ControleConexao.php");
include_once("../DAO/BoloDAO.php");
include_once("../DAO/EncomendaDAO.php");
include_once("../MODEL/Bolo.php");
include_once("../MODEL/Usuario.php");
include_once("../MODEL/Encomenda.php");
include_once("../MODEL/EncomendaBolo.php");
include_once("../config/conexao.php");
include_once("../config/Constantes.php");

//pega o fuso horário local de campo grande
date_default_timezone_set('America/Campo_Grande');

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$boloDAO = new BoloDAO();
$encomendaDAO = new EncomendaDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {
    case $acao == "finalizarCompra":

        

$idTamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_NUMBER_INT);

        $resultado = $boloDAO->buscarRegistro($idTamanho); 
        $boloOBJ = (object) $resultado[0];
        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }
        $_SESSION["carrinho"][$boloOBJ->getId_opcao()] = serialize($boloOBJ);


        $idCobertura = filter_input(INPUT_POST, 'cobertura', FILTER_SANITIZE_NUMBER_INT);

        $resultado = $boloDAO->buscarRegistro($idCobertura);
        $boloOBJ = (object) $resultado[0];
        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }
        $_SESSION["carrinho"][$boloOBJ->getId_opcao()] = serialize($boloOBJ);


        $idRecheio = filter_input(INPUT_POST, 'recheio', FILTER_SANITIZE_NUMBER_INT);

        $resultado = $boloDAO->buscarRegistro($idRecheio);
        $boloOBJ = (object) $resultado[0];
        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }
        $_SESSION["carrinho"][$boloOBJ->getId_opcao()] = serialize($boloOBJ);


        $idMassa = filter_input(INPUT_POST, 'massa', FILTER_SANITIZE_NUMBER_INT);

        $resultado = $boloDAO->buscarRegistro($idMassa);
        $boloOBJ = (object) $resultado[0];
        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
        }
        $_SESSION["carrinho"][$boloOBJ->getId_opcao()] = serialize($boloOBJ);

        unset($_SESSION['mensagemSistema']);

        if (!isset($_SESSION["carrinho"]) || empty($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = array();
            $_SESSION['mensagemSistema'] = "Carrinho vazio!";
        } else {
            
            $dataAtual = date('Y-m-d H:i:s');
            $encomenda = new Encomenda();

            $encomenda->setData($dataAtual);

            //realizamos a verificação do usuário na sessão e pegamos o seu ID
            if (isset($_SESSION['usuario_logado'])) {
                $usuarioLogado = unserialize($_SESSION['usuario_logado']);
                $encomenda->setFk_id_usuario($usuarioLogado->getId_usuario());
            }
            $encomenda->setStatus("EM ANDAMENTO");

            $inserido = $encomendaDAO->inserir($encomenda);
            $encomenda->setId_encomenda($inserido);

            $valorEncomenda = 0;
            foreach ($_SESSION["carrinho"] as $bolo) {
                $bolo = unserialize($bolo);
                $encomendaBolo = new EncomendaBolo();

                $encomendaBolo->setFk_id_encomenda($encomenda->getId_encomenda());
                $encomendaBolo->setFk_id_opcao($bolo->getId_opcao());
                $valorEncomenda += $bolo->getPreco();

                $encomendaDAO->adicionarBolos($encomendaBolo);
            }
            $encomenda->setValorTotal($valorEncomenda);
            $encomendaDAO->atualizar($encomenda);
            
             $_SESSION['mensagemSistema'] = "Encomenda realizado com sucesso! <br> Total a ser pago: " . $valorEncomenda;
        }




       

        header('location: ../VIEW/pag/carrinho/gerenciar_carrinho.php');
         exit();
        break;


    default:

        break;
}
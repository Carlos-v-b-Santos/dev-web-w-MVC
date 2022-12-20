<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../config/ControleConexao.php");
include_once("../config/conexao.php");
include_once("../config/Constantes.php");

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);


$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);


switch ($acao) {
    case $acao == "enviarEmail":
        if ($REQUEST == "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
            $emailUsuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT);

            enviarEmail($emailUsuario, $mensagem, $nome);
        }

        break;

    default:
        break;
}



function enviarEmail($emailUsuario, $mensagem, $nome) {

    //substituir aqui pelo e-mail do dona pizzaria
    $destino = "emailsenderifms@gmail.com";
    $assunto = "Contato Pizzaria";


    $cabecalhos = array(
        'From' => $emailUsuario,
        'Reply-To' => 'emailsenderifms@gmail.com',
        'Cc' => 'emailsenderifms@gmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    $mensagem = $nome . "\r\n" . $mensagem;
//mensagens devem possuir no máximo 70 caracteres em cada linha, desta forma garantiremos que não ocorrerá um problema
    $mensagem = wordwrap($mensagem, 70, "\r\n");

    $resposta = mail($destino, $assunto, $mensagem, $cabecalhos);

    if ($resposta == true) {
        echo 'email enviado com sucesso!';
    } else {
        echo 'email não foi enviado!';
    }
}

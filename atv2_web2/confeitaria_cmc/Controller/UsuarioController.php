<?php

session_start();
include_once("../config/ControleConexao.php");
include_once("../DAO/UsuarioDAO.php");
include_once("../MODEL/Usuario.php");
include_once("../config/conexao.php");
$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$usuarioDAO = new UsuarioDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
switch ($acao) {
    case $acao == "cadastroUsuario":
        if ($REQUEST == "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);



            // Instanciar um novo Usuário e setar informações
            $usuarioNovo = new Usuario();
            $usuarioNovo->setEmail($email);
            $usuarioNovo->setNome($nome);
            $usuarioNovo->setSenha($senha);
            $usuarioNovo->setTipo("CLIENTE");

            // Chamar o método inserir criado no DAO.
            $usuarioDAO->inserir($usuarioNovo);



            $_SESSION['mensagemSistema'] = 'Usuário cadastrado com sucesso!';

            header("location: ../VIEW/pag/login/cadastro_usuario.php");
            exit();
        }
        break;

    case $acao == "listarUsuarios":
        break;
    case $acao == "logout":
        unset($_SESSION['usuario_logado']);
        header("location: ../index.php");
        exit();
        break;

    case $acao == "login":
        header("location: ../VIEW/pag/login/login.php");
        break;
    case $acao == "efetuarLogin":
        $login = filter_input(INPUT_POST, 'loginInserido', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senhaLogin', FILTER_UNSAFE_RAW);

        // Chamar o método validarLogin criado no DAO. Os dados obtidos do usuário são inseridos na variável $resultados
        $resultado = $usuarioDAO->validarLogin($login, $senha);

        //pegamos o primeiro resultado, como é um login é o único que deve retornar!
        //processo para armazenar o objeto usuário retornado na sessão, também é utilizado o serialize para garantir que o objeto será inserido totalmente
        //para realizar o processo inverso basta utilizar o comando unserialize()
        unset($_SESSION['usuario_logado']);

        if (!empty($resultado)) {
            $_SESSION['usuario_logado'] = serialize($resultado[0]);
            //redirecionamento para a página inicial após realizar o login
            header("location: ../index.php");
            exit();
        } else if (empty($resultado)) {
            $_SESSION['mensagemSistema'] = 'Login ou Senha Inválidos!';
            header("location: ../VIEW/pag/login/login.php");
            exit();
        }

        break;


    default:
        break;
}
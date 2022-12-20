<?php

class Usuario {
 
    private $id_usuario;
    private $nome;
    private $senha;
    private $email;
    private $tipo;


    function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }     
    function getId_usuario() {
        return $this->id_usuario;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }
    function getNome() {
        return $this->nome;
    }

    function setEmail($email): void {
        $this->email = $email;
    }
    function getEmail() {
        return $this->email;
    }

    function setSenha($senha): void {
        $this->senha = $senha;
    }
    function getSenha() {
        return $this->senha;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    function getTipo() {
        return $this->tipo;
    }

    
}
?>


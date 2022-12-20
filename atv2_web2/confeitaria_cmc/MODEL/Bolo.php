<?php

class Bolo {
 
    private $id_opcao;
    private $nome;
    private $preco;
    private $tipo;
 

    function setId_opcao($id_opcao): void {
        $this->id_opcao = $id_opcao;
    }
    function getId_opcao() {
        return $this->id_opcao;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }
    function getNome() {
        return $this->nome;
    }

    function setPreco($preco): void {
        $this->preco = $preco;
    }
    function getPreco() {
        return $this->preco;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    function getTipo() {
        return $this->tipo;
    }

}



<?php

class EncomendaBolo {
 
    private $fk_id_encomenda;
    private $fk_id_opcao;

    function setFk_id_encomenda($fk_id_encomenda): void {
        $this->fk_id_encomenda = $fk_id_encomenda;
    }
    function getFk_id_encomenda() {
        return $this->fk_id_encomenda;
    }

    function setFk_id_opcao($fk_id_opcao): void {
        $this->fk_id_opcao = $fk_id_opcao;
    }
    function getFk_id_opcao() {
        return $this->fk_id_opcao;
    }
 
}



<?php

class Encomenda {
 
    private $id_encomenda;
    private $fk_id_usuario;
    private $data;
    private $status;
    private $valorTotal;
    private Usuario $usuario;
    

    function setUsuario(Usuario $usuario): void {
        $this->usuario = $usuario;
    }    
    function getUsuario(): Usuario {
        return $this->usuario;
    }
    
    function setValorTotal($valorTotal): void {
        $this->valorTotal = $valorTotal;
    }        
    function getValorTotal() {
        return $this->valorTotal;
    }

    function setStatus($status): void {
        $this->status = $status;
    }
    function getStatus() {
        return $this->status;
    }

    function setId_encomenda($id_encomenda): void {
        $this->id_encomenda = $id_encomenda;
    }
    function getId_encomenda() {
        return $this->id_encomenda;
    }

    function setFk_id_usuario($fk_id_usuario): void {
        $this->fk_id_usuario = $fk_id_usuario;
    }
    function getFk_id_usuario() {
        return $this->fk_id_usuario;
    }

    function setData($data): void {
        $this->data = $data;
    }
    function getData() {
        return $this->data;
    }
 
}



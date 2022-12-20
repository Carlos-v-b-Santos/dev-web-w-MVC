<?php

include_once("../MODEL/Encomenda.php");
include_once("../MODEL/Usuario.php");

class EncomendaDAO {

    private $conn;

    public function __construct() {
        $controle = ControleConexao::getInstance();
        $this->conn = $controle->get('Connection');
    }

    public function inserir(Encomenda $encomenda) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'INSERT INTO confeitaria_cmc.encomenda (fk_id_usuario, data, status)  VALUES (:idUsuario, :dataHora, :status)'
            );

            $stmt->bindValue(':idUsuario', $encomenda->getFk_id_usuario());
            $stmt->bindValue(':status', $encomenda->getStatus());
            $stmt->bindValue(':dataHora', $encomenda->getData());
            $stmt->execute();

            $id_insert = $this->conn->lastInsertId();
            $this->conn->commit();

            return $id_insert;
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    public function adicionarBolos(EncomendaBolo $encomendaBolo) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'INSERT INTO confeitaria_cmc.encomenda_bolo (fk_id_encomenda, fk_id_opcao)  VALUES (:idEncomenda, :idOpcao)'
            );

            $stmt->bindValue(':idEncomenda', $encomendaBolo->getFk_id_encomenda());
            $stmt->bindValue(':idOpcao', $encomendaBolo->getFk_id_opcao());
            $stmt->execute();

            $id_insert = $this->conn->lastInsertId();
            $this->conn->commit();

            return $id_insert;
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function cancelarEncomenda($id) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE confeitaria_cmc.encomenda SET status=:status WHERE id_encomenda=:idEncomenda'
            );


            $stmt->bindValue(':status', "CANCELADO");
            $stmt->bindValue(':idEncomenda', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function finalizarEncomenda($id) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE confeitaria_cmc.encomenda SET status=:status WHERE id_encomenda=:idEncomenda'
            );


            $stmt->bindValue(':status', "FINALIZADO");
            $stmt->bindValue(':idEncomenda', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function atualizar(Encomenda $encomenda) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE confeitaria_cmc.encomenda SET  valorTotal=:valorTotal, status=:status WHERE id_encomenda=:idEncomenda'
            );

            $stmt->bindValue(':valorTotal', $encomenda->getValorTotal());
            $stmt->bindValue(':status', $encomenda->getStatus());
            $stmt->bindValue(':idEncomenda', $encomenda->getId_encomenda());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function remover(int $id) {
        $this->conn->beginTransaction();

        try {


            $stmti = $this->conn->prepare(
                    'DELETE FROM confeitaria_cmc.encomenda_bolo WHERE  fk_id_encomenda=:idInserido'
            );

            $stmti->bindValue(':idInserido', $id);
            $stmti->execute();





            $stmt = $this->conn->prepare(
                    'DELETE FROM confeitaria_cmc.encomenda WHERE  id_encomenda=:idInserido'
            );

            $stmt->bindValue(':idInserido', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
        public function buscarEncomendasStatus($status) {


        $statement = $this->conn->query(
                'SELECT confeitaria_cmc.encomenda.*, confeitaria_cmc.usuario.nome,confeitaria_cmc.usuario.email 
                    FROM confeitaria_cmc.encomenda 
                    INNER JOIN confeitaria_cmc.usuario ON confeitaria_cmc.encomenda.fk_id_usuario=confeitaria_cmc.usuario.id_usuario 
                    WHERE confeitaria_cmc.encomenda.status='." '".$status ."';"
        );


        return $this->processaResultadosJoinUsuario($statement);
    }

    public function buscarEncomendasUsuario() {


        $statement = $this->conn->query(
                'SELECT confeitaria_cmc.encomenda.*, confeitaria_cmc.usuario.nome,confeitaria_cmc.usuario.email
                    FROM confeitaria_cmc.encomenda 
                    INNER JOIN confeitaria_cmc.usuario ON confeitaria_cmc.encomenda.fk_id_usuario=confeitaria_cmc.usuario.id_usuario;'
        );


        return $this->processaResultadosJoinUsuario($statement);
    }

    private function processaResultadosJoinUsuario($statement) {
        $resultados = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $encomenda = new Encomenda();
                $usuario = new Usuario();

                $usuario->setNome($row->nome);
                $usuario->setEmail($row->email);

                $encomenda->setId_encomenda($row->id_encomenda);
                $encomenda->setFk_id_usuario($row->fk_id_usuario);
                $encomenda->setData($row->data);
                $encomenda->setStatus($row->status);
                $encomenda->setValorTotal($row->valorTotal);
                $encomenda->setUsuario($usuario);

                $resultados[] = $encomenda;
            }
        }

        return $resultados;
    }

    public function buscarTodos() {
        $statement = $this->conn->query(
                'SELECT * FROM confeitaria_cmc.encomenda'
        );

        return $this->processaResultados($statement);
    }

    public function buscarEncomenda(int $id) {

        $statement = $this->conn->query(
                'SELECT * FROM confeitaria_cmc.encomenda WHERE id_encomenda=' . $id
        );

        return $this->processaResultados($statement);
    }

    private function processaResultados($statement) {
        $resultados = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $encomenda = new Encomenda();

                $encomenda->setId_encomenda($row->id_encomenda);
                $encomenda->setFk_id_usuario($row->fk_id_usuario);
                $encomenda->setData($row->data);
                $encomenda->setStatus($row->status);
                $encomenda->setValorTotal($row->valorTotal);


                $resultados[] = $encomenda;
            }
        }

        return $resultados;
    }

}

?>
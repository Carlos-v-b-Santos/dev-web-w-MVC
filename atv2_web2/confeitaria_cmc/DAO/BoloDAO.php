<?php

include_once("../MODEL/Bolo.php");

class BoloDAO {

    private $conn;

    public function __construct() {
        $controle = ControleConexao::getInstance();
        $this->conn = $controle->get('Connection');
    }

    public function buscarTodos() {
        $statement = $this->conn->query(
                'SELECT * FROM confeitaria_cmc.bolo'
        );

        return $this->processaResultados($statement);
    }

    public function buscarBolosTipo($tipo) {


        $statement = $this->conn->query(
                'SELECT * FROM confeitaria_cmc.bolo
                    WHERE confeitaria_cmc.bolo.tipo='." '".$tipo ."';"
        );


        return $this->processaResultados($statement);
    }

    public function buscarRegistro(int $id) {

        $statement = $this->conn->query(
                'SELECT * FROM confeitaria_cmc.bolo WHERE id_opcao=' . $id
        );

        return $this->processaResultados($statement);
    }

    public function inserir(Bolo $bolo) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO bolo (nome, preco, tipo)  VALUES (:nome, :preco, :tipo)'
            );


            $stmt->bindValue(':nome', $bolo->getNome());
            $stmt->bindValue(':preco', $bolo->getPreco());
            $stmt->bindValue(':tipo', $bolo->getTipo());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function atualizar(Bolo $bolo) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE confeitaria_cmc.bolo SET nome=:nome, preco=:preco, tipo=:tipo WHERE id_opcao=:id_opcao'
            );

            $stmt->bindValue(':nome', $bolo->getNome());
            $stmt->bindValue(':preco', $bolo->getPreco());
            $stmt->bindValue(':tipo', $bolo->getTipo());
            $stmt->bindValue(':id_opcao', $bolo->getId_opcao());

            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    private function processaResultados($statement) {
        $resultados = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $bolo = new Bolo();

                $bolo->setId_opcao($row->id_opcao);
                $bolo->setNome($row->nome);
                $bolo->setPreco($row->preco);
                $bolo->setTipo($row->tipo);


                $resultados[] = $bolo;
            }
        }

        return $resultados;
    }

    public function remover(int $id) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'DELETE FROM confeitaria_cmc.bolo WHERE  id_opcao=:idInserido'
            );

            $stmt->bindValue(':idInserido', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

}

?>
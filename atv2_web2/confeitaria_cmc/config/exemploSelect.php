<?php

include_once("conexao.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    //exibindo somente um
    $id = 2;
    $stmt = $conn->prepare('SELECT * FROM usuario WHERE id_usuario = :id');
    //Opção manual
    //$stmt->execute(array('id' => $id));
    //Opção mais elegante
   // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //ou
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (count($result)) {
        foreach ($result as $row) {
            print_r($row);
        }
    } else {
        echo "Nenhum resultado retornado.";
    }

 
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
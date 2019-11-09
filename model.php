<?php

include('connection.php');

class Dados{
    public function listarProdutos($conn){
        $id_produto = '1';
            
        try{
            $stmt = $conn->prepare('SELECT * FROM tb_produto WHERE id_produto = ' . $id_produto);
            $stmt->execute();
            $resultFinal = $stmt -> fetchAll();

            return $resultFinal;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        } 
    
    }
}
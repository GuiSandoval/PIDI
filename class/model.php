<?php

include('connection.php');

class Dados
{

    public function insereMaterial($conn, $query)
    {
        $nomeMat = $query['nomeMaterial'];
        $descricao = $query['descricao'];
        $preco = $query['precoMaterial'];
        $qtdMat = $query['qtdMaterial'];
        $sql = "INSERT INTO tb_material (nome_material,descricao,preco) VALUES(:nomeMat,:descricao,:preco)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':nomeMat' => $nomeMat,
            ':descricao' => $descricao,
            ':preco' => $preco
        ));

        if ($stmt->rowCount() > 0) {
            $stmtb = $conn->prepare("SELECT id_material FROM tb_material where nome_material = '$nomeMat';");
            // $id_mat = $stmtb->execute();
            $id_mat = $stmtb->execute() ? $stmtb->fetch(PDO::FETCH_ASSOC) : false;

            $sqlc = "Insert into tb_estoque (id_item,qtd_item) values (:id_item,:qtd_item);";
            $stmtc = $conn->prepare($sqlc);
            $stmtc->execute(array(
                ':id_item' => $id_mat['id_material'],
                ':qtd_item' => $qtdMat
            ));
            if ($stmtc->rowCount() > 0) {
                $resultFinal = true;
            }
        } else {
            $resultFinal = false;
        }
        return $resultFinal;
    }
    public function deletaMaterial($conn, $query)
    {
        try {
            $stmt = $conn->prepare('DELETE FROM tb_material WHERE id_material = :id');
            $stmt->bindParam(':id', $query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $resultFinal = true;
            } else {
                $resultFinal = false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function pesquisaMaterial($conn, $query)
    {
        try {

            $sql = "SELECT * FROM tb_material LEFT JOIN tb_estoque ON tb_material.id_material = tb_estoque.id_item where tb_material.id_material = :id;";
            // $sql ="'SELECT * FROM tb_material WHERE id_material = :id'";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $query);
            $resultFinal = $stmt->execute() ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function alteraMaterial($conn, $query)
    {
        $id_mat = $query['id'];
        $nomeMat = $query['nomeMaterial'];
        $descricao = $query['descricao'];
        $preco = $query['precoMaterial'];
        $qtdMat = $query['qtdMaterial'];
        try {
            // $sql ="UPDATE tb_material INNER JOIN tb_estoque ON tb_estoque.id_item = tb_material.id_material SET tb_estoque.qtd_item = 55 where tb_material.id_material = 15;";
            $stmt = $conn->prepare('UPDATE tb_material SET nome_material  = :nome , descricao = :descricao, preco = :preco WHERE id_material = :id');
            $stmt->execute(array(
                ':id'   => $id_mat,
                ':nome' => $nomeMat,
                ':descricao' => $descricao,
                ':preco' => $preco
            ));

            if ($stmt->rowCount() > 0) {
                $sql = "UPDATE tb_material INNER JOIN tb_estoque ON tb_estoque.id_item = tb_material.id_material SET tb_estoque.qtd_item = :qtdMat where tb_material.id_material = :id;";
                $stmtb = $conn->prepare($sql);
                $stmtb->execute(array(
                    ':id'   => $id_mat,
                    ':qtdMat' => $qtdMat
                ));
                // echo $stmtb->rowCount();
                if ($stmtb->rowCount() > 0) {
                    $resultFinal = true;
                }
            } else {
                $resultFinal = false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function insereProduto($conn, $query)
    {
        $nomeProd = $query['nomeProduto'];
        $descricao = $query['descricao'];
        $preco = $query['precoProduto'];
        $qtdProd = $query['qtdProduto'];
        $sql = "INSERT INTO tb_produto (nome,descricao,preco) VALUES(:nome,:descricao,:preco)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':nome' => $nomeProd,
            ':descricao' => $descricao,
            ':preco' => $preco
        ));

        if ($stmt->rowCount() > 0) {
            $stmtb = $conn->prepare("SELECT id_produto FROM tb_produto where nome = '$nomeProd';");
            // $id_mat = $stmtb->execute();
            $id_mat = $stmtb->execute() ? $stmtb->fetch(PDO::FETCH_ASSOC) : false;

            $sqlc = "Insert into tb_estoque (id_item,qtd_item) values (:id_item,:qtd_item);";
            $stmtc = $conn->prepare($sqlc);
            $stmtc->execute(array(
                ':id_item' => $id_mat['id_produto'],
                ':qtd_item' => $qtdProd
            ));
            if ($stmtc->rowCount() > 0) {
                $resultFinal = true;
            }
        } else {
            $resultFinal = false;
        }
        return $resultFinal;
    }
    public function loginUsuario($conn, $cpf, $senha)
    {
        try{
        $sql = "SELECT nome FROM tb_usuario WHERE id_cpf = ? AND hashSenha = ?";
        $rs = $conn->prepare($sql);
        $rs->bindParam(1, $cpf);
        $rs->bindParam(2, $senha);
        $resultFinal = $rs->execute() ? $rs->fetch(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function cadastraUsuario($conn, $query, $hashSenha)
    {   $cpf = $query['cpf'];
        $nome = $query['nomeUsuario'];
        $tipoUsuario = $query['tipoUsuario'];
        $sql = "INSERT INTO tb_usuario (id_cpf,nome,tipo_usuario,hashSenha) VALUES(:id_cpf,:nome,:tipoUsuario,:hashSenha)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':id_cpf' => $cpf,
            ':nome' => $nome,
            ':tipoUsuario' => $tipoUsuario,
            ':hashSenha' => $hashSenha
        ));

        if ($stmt->rowCount() > 0) {      
                $resultFinal = true;
        } else {
            $resultFinal = false;
        }
        return $resultFinal;
    }
    public function deletaUsuario($conn, $query)
    {
        try {
            $stmt = $conn->prepare('DELETE FROM tb_usuario WHERE id_cpf = :id');
            $stmt->bindParam(':id', $query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $resultFinal = true;
            } else {
                $resultFinal = false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function pesquisaUsuario($conn, $query)
    {
        try {

            $sql = "SELECT * FROM tb_usuario where id_cpf = :id;";
            // $sql ="'SELECT * FROM tb_material WHERE id_material = :id'";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $query);
            $resultFinal = $stmt->execute() ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    public function alteraUsuario($conn, $query, $hashSenha)
    {
        $id_cpf = $query['cpf'];
        $nome = $query['nomeUsuario'];
        $tipoUsuario = $query['tipoUsuario'];
        try {
            // $sql ="UPDATE tb_material INNER JOIN tb_estoque ON tb_estoque.id_item = tb_material.id_material SET tb_estoque.qtd_item = 55 where tb_material.id_material = 15;";
            $stmt = $conn->prepare('UPDATE tb_usuario SET nome  = :nome , tipo_usuario = :tipo_usuario ,hashSenha = :senha WHERE id_cpf = :id');
            $stmt->execute(array(
                ':id'   => $id_cpf,
                ':nome' => $nome,
                ':senha' => $hashSenha,
                ':tipo_usuario' => $tipoUsuario
            ));

            if ($stmt->rowCount() > 0) {
               
                    $resultFinal = true;
                
            } else {
                $resultFinal = false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $resultFinal;
    }
    
}

<?php

//Importar classes e conexao com o banco
include('class/connection.php');
include('class/model.php');
$dat = new Dados();
if (isset($_GET['excluir'])) {
    $id_excl = $_GET['excluir'];
    $dadosMat = $dat->deletaMaterial($conn, $id_excl);
    if ($dadosMat == true) {
        echo "<script type='javascript'>alert('Material deletado com Sucesso!');";
        echo "javascript:window.location='listaMaterial.php';</script>";
    }
}

//Header
include('includes/header.php'); ?>



<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Material</th>
            <th scope="col">Preço</th>
            <th scope="col">Quantidade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = $conn->query("SELECT * FROM tb_material LEFT JOIN tb_estoque ON tb_material.id_material = tb_estoque.id_item;");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <th scope="row"><?php echo $linha['id_material']; ?></th>
                <td><?php echo $linha['nome_material']; ?></td>
                <td><?php echo "R$" . $linha['preco']; ?></td>
                <td><?php echo $linha['qtd_item']; ?></td>
                <td><a href="alterarMat.php?id=<?php echo $linha['id_material'];?>"><button type="submit" class="btn btn-warning">Alterar</button></a><a href="?excluir=<?php echo $linha['id_material']; ?>"><button type="submit" class="btn btn-danger">Excluir</button></a>
                <td>
            </tr>
        <?php } ?>
    </tbody>
</table>




<?php
//footer
include('includes/footer.php') ?>
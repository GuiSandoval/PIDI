<?php

//Importar classes e conexao com o banco
include('class/connection.php');
include('class/model.php');
$dat = new Dados();
if (isset($_GET['excluir'])) {
    $id_excl = $_GET['excluir'];
    $dadosMat = $dat->deletaUsuario($conn, $id_excl);
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
            <th scope="col">CPF</th>
            <th scope="col">Nome Usuario</th>
            <th scope="col">Tipo Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = $conn->query("SELECT * FROM tb_usuario;");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <th scope="row"><?php echo $linha['id_cpf']; ?></th>
                <td><?php echo $linha['nome']; ?></td>
                <td><?php if($linha['tipo_usuario'] == 3){echo 'administrador';}elseif($linha['tipo_usuario'] == 2){echo 'Gerente';}else{echo 'usuario';} ?></td>
                <td><a href="alterarUsuario.php?id=<?php echo $linha['id_cpf'];?>"><button type="submit" class="btn btn-warning">Alterar</button></a><a href="?excluir=<?php echo $linha['id_cpf']; ?>"><button type="submit" class="btn btn-danger">Excluir</button></a>
                <td>
            </tr>
        <?php } ?>
    </tbody>
</table>




<?php
//footer
include('includes/footer.php') ?>
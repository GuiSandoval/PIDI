<?php
//Importar classes e conexao com o banco
// include('class/connection.php');
include('class/model.php');
//Header
include('includes/header.php');
?>
<div class="container mt-3">
    <div class="row">
        <h1 class="mx-auto">CADASTRO Material</h1>
    </div>
    <form name="formCadastro" id="idFormCadastro" method="POST" action="controller/controllerCadastro.php">
        <div class="form-group">
            <label for="nomeMaterial">Nome Material</label>
            <input type="text" class="form-control" id="idNomeMaterial" name="nomeMaterial" placeholder="">
        </div>
        <div class="form-row align-items-center">
            <div class="col-md-8">
                <label for="precoMaterial">Preço Material</label>
                <input type="number" step="any" class="form-control" name="precoMaterial" placeholder="">
            </div>
            <div class="col-md-4">
                <label for="qtdMaterial">Quantidade</label>
                <input class="form-control form-control-sm" name="qtdMaterial"type="number" min="0" placeholder="1">
            </div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="idDescricao" name="descricao" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-dark btn-lg btn-block">Cadastrar</button>
    </form>
</div>


<?php
//footer
include('includes/footer.php') ?>
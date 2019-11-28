<?php 
$erro = null;
$valido = false;

//Importar classes e conexao com o banco
include('class/connection.php');
include('class/model.php');
//Header
include('includes/header.php');
$dat = new Dados();
if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true){
    /*if(strlen(utf8_decode($_POST["nomeMaterial"])) < 5)
    {
        $erro = "Preencha o campo nome corretamente (5 ou mais caracteres)";
    }
    else if(is_numeric($_POST["qtdMaterial"]) == false)
    {
        $erro = "Campo quantidade deve ser numérico";  
    }
    else
    {*/
        $valido = true;

        $query = $_POST;
        // print_r($query);
        // echo $id_mat;
        $altMat = $dat->alteraMaterial($conn,$query);
        if($altMat ==true){
            echo 'deu certo';
            header('location:listaMaterial.php');
        }else {
            echo 'deu ruim'; 
        }
        exit;
    // }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $dadMat = $dat->pesquisaMaterial($conn,$id);
    if($dadMat==false){
        echo 'não existe esse material no banco';
        exit;
    }else{
        // print_r($dadMat);
         $_POST['nome'] = $dadMat['nome_material'];
         $_POST['descricao'] = $dadMat['descricao'];
         $_POST['preco'] = $dadMat['preco'];
         $_POST['qtd_material'] = $dadMat['qtd_item'];
         $_POST['id'] = $dadMat['id_material']; 
        //  echo $dadMat['qtd_item']; ;
        //  exit;
    }
}
// $id_mat = $_POST['id'];

?>
<div class="container mt-3">
    <div class="row">
        <h1 class="mx-auto">ALTERAR Material</h1>
    </div>
    <form name="formCadastro" id="idFormCadastro" method="POST" action="?validar=true">
        <div class="form-group">
            <label for="nomeMaterial">Nome Material</label>
            <input type="text" 
            <?php if(isset($_POST["nome"])) { echo "value='" . $_POST["nome"] . "'"; } ?>
            class="form-control" id="idNomeMaterial" name="nomeMaterial" placeholder="">
        </div>
        <div class="form-row align-items-center">
            <div class="col-md-8">
                <label for="precoMaterial">Preço Material</label>
                <input type="number" 
                <?php if(isset($_POST["preco"])) { echo "value='" . $_POST["preco"] . "'"; } ?>
                step="any" class="form-control" name="precoMaterial" placeholder="">
            </div>
            <div class="col-md-4">
                <label for="qtdMaterial">Quantidade</label>
                <input class="form-control form-control-sm" 
            <?php if(isset($_POST["qtd_material"])) { echo "value='" . $_POST["qtd_material"] . "'"; } ?>
                name="qtdMaterial"type="number" min="0" placeholder="1">
            </div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="idDescricao" name="descricao" rows="3">
            <?php if(isset($_POST["descricao"])) { echo  $_POST["descricao"]; } ?>

            </textarea>
        </div>
        <INPUT type=HIDDEN name=id value="<?php echo $_REQUEST["id"]; ?>">
        <button type="submit" class="btn btn-dark btn-lg btn-block">Alterar</button>
    </form>
</div>


<?php
//footer
include('includes/footer.php') ?>
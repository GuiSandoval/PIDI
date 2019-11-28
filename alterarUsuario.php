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
        $hashDaSenha = md5($_POST["senha"]);
        $query = $_POST;
        // print_r($query);
        // echo $id_mat;
        $altMat = $dat->alteraUsuario($conn,$query,$hashDaSenha);
        if($altMat ==true){
            echo 'deu certo';
            header('location:listaUsuario.php');
        }else {
            echo 'deu ruim'; 
        }
        exit;
    // }
}
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $dadMat = $dat->pesquisaUsuario($conn,$id);
    if($dadMat==false){
        echo 'não existe esse material no banco';
        exit;
    }else{
        // print_r($dadMat);
         $_POST['nome'] = $dadMat['nome'];
         $_POST['id_cpf'] = $dadMat['id_cpf'];
         $_POST['tipo_usuario'] = $dadMat['tipo_usuario'];
         $_POST['senha'] = $dadMat['hashSenha'];
        //  echo $dadMat['qtd_item']; ;
        //  exit;
    }
}
// $id_mat = $_POST['id'];
?>
<div class="container mt-3">
<div class="row">
    <h1 class="mx-auto">ALTERAR USUARIO</h1>
</div>
<form name="formCadastro" id="idFormCadastro" method="POST" action="?validar=true">
    <div class="form-row">
        <div class="col-md-4">
            <label for="cpf">CPF</label>
            <input type="text" 
            <?php if(isset($_POST["id_cpf"])) { echo "value='" . $_POST["id_cpf"] . "'"; } ?>
            class="form-control" id="idcpf" name="cpf" placeholder="" readonly>
        </div>
        <div class="col-md-8">
        <label for="nomeUsuario">Nome</label>
        <input type="text" 
        <?php if(isset($_POST["nome"])) { echo "value='" . $_POST["nome"] . "'"; } ?>
        
        class="form-control" id="idnomeUsuario" name="nomeUsuario" placeholder="">
    </div>
    </div>
    <div class="form-row align-items-center mb-3">
        <div class="col-md-8">
            <label for="senha">SENHA</label>
            <input type="password" 
        <?php if(isset($_POST["senha"])) { echo "value='" . $_POST["senha"] . "'"; } ?>
            
            class="form-control" id="idsenha" name="senha" placeholder="">
        </div>
        <div class="col-md-4">
            <label for="tipoUsuario">Tipo Usuario</label>
            <input class="form-control form-control-sm" 
        <?php if(isset($_POST["tipo_usuario"])) { echo "value='" . $_POST["tipo_usuario"] . "'"; } ?>
            
            name="tipoUsuario" type="number" min="0" placeholder="1">
        </div>
    </div>
    <INPUT type=HIDDEN name=id value="<?php echo $_REQUEST["id"]; ?>">
    <button type="submit" class="btn btn-dark btn-lg btn-block">Alterar</button>
</form>
</div>


<?php
//footer
include('includes/footer.php') ?>
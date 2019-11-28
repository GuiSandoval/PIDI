<?php
//Importar classes e conexao com o banco
// include('class/connection.php');
include('class/model.php');
$dat = new Dados();
if (isset($_REQUEST['validar']) && $_REQUEST['validar'] == true) {
    $hashDaSenha = md5($_POST["senha"]);
    if (strlen(utf8_decode($_POST["nomeUsuario"])) < 5) {
        $erro = "Preencha o campo nome corretamente (5 ou mais caracteres)";
    } else {
        $valido = true;
        $query = $_POST;
        print_r ($_POST);
        echo $hashDaSenha;
        // exit;
        $validar = $dat->cadastraUsuario($conn,$query,$hashDaSenha);
        if($validar == true){
            echo 'deu certo';
        }else{
            echo'deu ruim';
        }
    }
} else { }
//Header
include('includes/header.php');
?>
<div class="container mt-3">
    <div class="row">
        <h1 class="mx-auto">CADASTRO USUARIO</h1>
    </div>
    <form name="formCadastro" id="idFormCadastro" method="POST" action="?validar=true">
        <div class="form-row">
            <div class="col-md-4">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="idcpf" name="cpf" placeholder="">
            </div>
            <div class="col-md-8">
            <label for="nomeUsuario">Nome</label>
            <input type="text" class="form-control" id="idnomeUsuario" name="nomeUsuario" placeholder="">
        </div>
        </div>
        <div class="form-row align-items-center mb-3">
            <div class="col-md-8">
                <label for="senha">SENHA</label>
                <input type="password" class="form-control" id="idsenha" name="senha" placeholder="">
            </div>
            <div class="col-md-4">
                <label for="tipoUsuario">Tipo Usuario</label>
                <input class="form-control form-control-sm" name="tipoUsuario" type="number" min="0" placeholder="1">
            </div>
        </div>
        <button type="submit" class="btn btn-dark btn-lg btn-block">Cadastrar</button>
    </form>
</div>


<?php
//footer
include('includes/footer.php') ?>
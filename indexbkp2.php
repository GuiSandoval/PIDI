<?php

ob_start();

include('class/model.php');
$dat = new Dados();

if(isset($_REQUEST["autenticar"]) && $_REQUEST["autenticar"] == true)
{
    $hashDaSenha = md5($_POST["senha"]);
    $cpf = $_POST['cpf'];
    $validar = $dat->loginUsuario($conn,$cpf,$hashDaSenha);
  
    
    if($validar != false)
    {
        if(count($validar))
        {
            session_start();
            $_SESSION["usuario"] = $validar['nome'];
            // echo $_SESSION['usuario'];
            // exit;
            header("location: listaMaterial.php");
        }
        else
        {
            echo "Dados inválidos.";
        }
    }
    else
    {
        echo "Falha no acesso.";
    }
    
    
    
    
}
//Header
// include('includes/header.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="login mt-5">
            <form action="?autenticar=true" method="post">
                <div class="form-row align-items-center">
                    <!-- <div class="col-md-4">dsadsa</div> -->
                    <div class="col-md-4 mx-auto">
                        <label for="idCpf">CPF:</label>
                        <input type="text" name="cpf" id="idCpf" class="form-control" placeholder="" aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <!-- <div class="col-md-4">dsadsa</div> -->
                    <div class="offset-6 col-md-4 mx-auto">
                        <label for="idSenha">Senha:</label>
                        <input type="password" name="senha" id="idSenha" class="form-control" placeholder="" aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
                    </div>
                </div>
                <div class="row">
                    <div class="offset-5 col-md-4 mt-3">

                        <input type="submit" class="btn btn-primary mx-auto" value="Autenticar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php

//footer
include('includes/footer.php');
ob_flush();
?>
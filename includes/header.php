<?php     
ob_start();
// echo "Olá " . $_SESSION["usuario"];

?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>SCV</title>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>

<body>
    <?php 
    session_start();
    if(isset($_REQUEST['logout']) && $_REQUEST["logout"] == true){
        // echo $_SESSION['usuario'];
        session_destroy();
        header("location:index.php");
        exit();
        // echo $_SESSION['usuario'];
        // exit;
    }
    if(!isset($_SESSION["usuario"]))
    {
        echo "Erro você deve logar primeiro clicando <a href='index.php'>aqui</a>";
        exit();
    }

    // echo "Olá " . $_SESSION["usuario"];
    // echo "<BR><BR>";
    ?>
    <!-- MENU NAVBAR -->
    <nav class="navbar meuNav navbar-expand-lg navbar-dark  ">
        <a class="navbar-brand" href="#">SCV</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- MATERIAL -->
                <li class="nav-item dropdown meuNav ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MATERIAL
                    </a>
                    <div class="dropdown-menu meuNav " aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-white menuDrop" href="cadastroMaterial">Cadastrar</a>
                        <a class="dropdown-item text-white menuDrop" href="listaMaterial">Listar</a>
                        <a class="dropdown-item text-white menuDrop" href="#">Something else here</a>
                    </div>
                </li>
                <!-- PRODUTOS -->
                <li class="nav-item dropdown meuNav ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        PRODUTOS
                    </a>
                    <div class="dropdown-menu meuNav " aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-white menuDrop" href="cadastroProduto">Cadastrar</a>
                        <a class="dropdown-item text-white menuDrop" href="listaMaterial">Listar</a>
                        <a class="dropdown-item text-white menuDrop" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown meuNav ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        USUARIOS
                    </a>
                    <div class="dropdown-menu meuNav " aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-white menuDrop" href="cadastroProduto">Cadastrar</a>
                        <a class="dropdown-item text-white menuDrop" href="listaUsuario">Listar</a>
                        <a class="dropdown-item text-white menuDrop" href="#">ALTERAR</a>
                    </div>
                </li>
            </ul>
            <ul class="ml-auto navbar-nav">
            <li class="nav-item dropdown meuNav ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['usuario'];?>
                </a>
                <div class="dropdown-menu meuNav " aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-white menuDrop" href="?logout=true">SAIR</a>
                    </div>
            </li>
            </ul>
        </div>
    </nav>
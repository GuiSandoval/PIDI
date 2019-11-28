<?php
include('../class/connection.php');
include('../class/model.php');

$nomeMat = filter_input(INPUT_POST,'nomeMaterial',FILTER_SANITIZE_SPECIAL_CHARS);
$qtdMat = filter_input(INPUT_POST,'qtdMaterial',FILTER_SANITIZE_SPECIAL_CHARS);
$precoMat = filter_input(INPUT_POST,'precoMaterial',FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST,'descricao',FILTER_SANITIZE_SPECIAL_CHARS);

$dados = new Dados();
// print_r($_POST);
$query = $_POST;
// print_r($query);
// echo '<br>';
// echo $query['nomeMaterial'];
// $conn = new Dados();
$dados->insereMaterial($conn, $query);
if($dados == true){
    header('Location: ../listaMaterial.php');

}else{
    'deu ruim';
}
// $conn->insertDB("tb_material","nome_material,descricao,preco,qtd_material",array($nomeMat,$descricao,$precoMat,$qtdMat));

// echo 'cadastro realizado com sucesso!';
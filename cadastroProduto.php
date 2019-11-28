<?php
//Importar classes e conexao com o banco
// include('class/connection.php');
include('class/model.php');
//Header
include('includes/header.php');

#seleciona os dados da tabela produto
// if(isset($_REQUEST['validar'])){
//     print_r($_POST);
//     print_r($_POST['produtoId']);
//     exit;
// }

# abaixo montamos um formulário em html
# e preenchemos o select com dados
?>
<div class="container">
    <h1 class="text-center my-3">CADASTRO DE PRODUTOS</h1>
    <form name="produto" method="post" action="">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nomeProd">Nome</label>
                <input type="text" class="form-control" id="nomeProd">
            </div>
            <div class="form-group col-md-4">
                <label for="selectMat">Selecione um Material</label>
                <select class="form-control" id="selectMat">
                    <option>Selecione...</option>
                    <?php
                    $consulta = $conn->query("SELECT * FROM tb_material LEFT JOIN tb_estoque ON tb_material.id_material = tb_estoque.id_item;");
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $linha['nome_material'] ?>"><?php echo $linha['nome_material'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="precoProduto">Preço</label>
                <input type="number" class="form-control" id="precoProduto">
            </div>
            <div class="form-group col-md-2">
                <label for="qtdProd">Quantidade</label>
                <input type="number" class="form-control" id="qtdProd">
            </div>

        </div>
        <div class="form-group">
            <label for="descProd">Descrição do Produto</label>
            <textarea class="form-control" id="descProd" rows="3"></textarea>
        </div>

    </form>
</div>
<form action="?validar=true" method="post" id="formulario">
    <input type="button" id="novoMat" value="Adicionar Material" />
    <input type="submit" value="enviar" />
    <div id="item" class="item">
        <label>Selecione o produto:</label>
        <select name="produtoId[]">
            <?php
            $consulta = $conn->query("SELECT * FROM tb_material LEFT JOIN tb_estoque ON tb_material.id_material = tb_estoque.id_item;");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $linha['id_material'] ?>"><?php echo $linha['nome_material'] ?></option>

            <?php } ?>
        </select>
        <label>Quantidade:</label>
        <input type="number" name="cpvalor" onblur="calcular()" />
    </div>
    <b>Quantidade:</b>
    <span id="cpqtde">10</span><br>
    <b>Valor:</b> <input id="cpvalor" onblur="calcular()" type="number"><br>

    <b>Resultado:</b>
    <div id="cpliqu"></div>
</form>
<script>
    $(document).ready(function() {
        $("#novoMat").click(function() {
            var novoItem = $("#item").clone().removeAttr('id'); // para não ter id duplicado
            novoItem.children('input').val(''); //limpa o campo quantidade
            $("#formulario").append(novoItem);
        });
    });

    function calcular() {
        var cpqtde = $('#cpqtde').text();
        var cpvalor = $('#cpvalor').val();

        $('#cpliqu').text(cpqtde * cpvalor);
    }
</script>
<?php
//footer
include('includes/footer.php') ?>
<?php
include '../conexao.php';

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("ID do imóvel não foi fornecido.");
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM imoveis WHERE inscricao_municipal = $id";
$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro na consulta SQL: " . mysqli_error($conexao));
}

$imovel = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/editar.css">
    <title>Editar Imóvel</title>  
</head>
<body>

<h2>Editar Imóvel</h2>

<form action="atualizar_imovel.php" method="post">
    <!-- Corrigido o ID oculto -->
    <input type="hidden" name="id" value="<?php echo $imovel['inscricao_municipal']; ?>">

    <label>Logradouro:</label>
    <input type="text" name="logradouro" required value="<?php echo $imovel['logradouro']; ?>">

    <label>Número:</label>
    <input type="text" name="numero" required value="<?php echo $imovel['numero']; ?>">

    <label>Bairro:</label>
    <input type="text" name="bairro" required value="<?php echo $imovel['bairro']; ?>">

    <label>Complemento:</label>
    <input type="text" name="complemento" value="<?php echo $imovel['complemento']; ?>">

    <label>ID do Contribuinte (Proprietário):</label>
    <input type="number" name="id_contribuinte" required value="<?php echo $imovel['id_contribuinte']; ?>">

    <input type="submit" value="Atualizar Imóvel">
</form>

</body>
</html>

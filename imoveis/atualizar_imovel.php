<?php
include '../conexao.php';

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$id = intval($_POST['id']);
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];
$id_contribuinte = intval($_POST['id_contribuinte']);

// Verifica se o contribuinte existe
$verifica = mysqli_query($conexao, "SELECT id FROM pessoas WHERE id = $id_contribuinte");

if (mysqli_num_rows($verifica) == 0) {
    die("Erro: O ID do contribuinte informado não existe.");
}

// Atualiza o imóvel
$sql = "UPDATE imoveis SET 
            logradouro = '$logradouro',
            numero = '$numero',
            bairro = '$bairro',
            complemento = '$complemento',
            id_contribuinte = $id_contribuinte
        WHERE inscricao_municipal = $id";

if (mysqli_query($conexao, $sql)) {
    echo "Imóvel atualizado com sucesso!";
} else {
    echo "Erro ao atualizar: " . mysqli_error($conexao);
}
?>

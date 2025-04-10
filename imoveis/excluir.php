<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

include '../conexao.php';

if (!isset($_GET['id'])) {
    echo "ID do imóvel não informado!<br>";
    echo '<a href="listar_imoveis.php">← Voltar à lista de imóveis</a>';
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM imoveis WHERE inscricao_municipal = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar.php");
    exit;
} else {
    echo "Erro ao excluir: " . $stmt->error . "<br>";
    echo '<a href="listar.php">← Voltar à lista de imóveis</a>';
}
?>

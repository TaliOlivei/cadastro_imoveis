<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

include '../conexao.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID da pessoa não informado!'); window.location.href = 'listar.php';</script>";
    exit;
}

$id = $_GET['id'];

// Verifica se a pessoa está vinculada a algum imóvel
$sqlVerifica = "SELECT * FROM imoveis WHERE id_contribuinte = ?";
$stmtVerifica = $conexao->prepare($sqlVerifica);
$stmtVerifica->bind_param("i", $id);
$stmtVerifica->execute();
$resultado = $stmtVerifica->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>
        alert('❌ Não é possível excluir esta pessoa. Ela está vinculada a um ou mais imóveis.');
        window.location.href = 'listar.php';
    </script>";
    exit;
}

// Se não estiver vinculada, pode excluir
$sqlDelete = "DELETE FROM pessoas WHERE id = ?";
$stmtDelete = $conexao->prepare($sqlDelete);
$stmtDelete->bind_param("i", $id);

if ($stmtDelete->execute()) {
    echo "<script>
        alert('✅ Pessoa excluída com sucesso!');
        window.location.href = 'listar.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao excluir pessoa: " . $stmtDelete->error . "');
        window.location.href = 'listar.php';
    </script>";
}
?>

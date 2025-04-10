<?php
session_start();
include '../conexao.php'; // ajustado para a pasta correta

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta segura usando prepared statement
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $dados = $resultado->fetch_assoc();

    // Comparação direta (em produção use password_hash e password_verify)
    if ($senha === $dados['senha']) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $dados['usuario'];
        header("Location: ../dashboard.php");
        exit();
    }
}

echo "Usuário ou senha inválidos.";
?>

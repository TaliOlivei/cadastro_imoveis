<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

include '../conexao.php';

if (!isset($_GET['id'])) {
    echo "ID do imóvel não informado!<br>";
    echo '<a href="../index.php">← Voltar</a>';
    exit;
}

$inscricao = $_GET['id'];

$sql = "SELECT i.*, p.nome, p.cpf, p.sexo, p.telefone, p.email
        FROM imoveis i
        JOIN pessoas p ON i.id_contribuinte = p.id
        WHERE i.inscricao_municipal = ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação: " . $conexao->error);
}

$stmt->bind_param("i", $inscricao);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Imóvel não encontrado!<br>";
    echo '<a href="../index.php">← Voltar</a>';
    exit;
}

$imovel = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/detalhes.css">
    <title>Detalhes do Imóvel</title>
</head>
<body>
    <h2>Detalhes do Imóvel</h2>

    <p><strong>Inscrição Municipal:</strong> <?= htmlspecialchars($imovel['inscricao_municipal']) ?></p>
    <p><strong>Logradouro:</strong> <?= htmlspecialchars($imovel['logradouro']) ?></p>
    <p><strong>Número:</strong> <?= htmlspecialchars($imovel['numero']) ?></p>
    <p><strong>Bairro:</strong> <?= htmlspecialchars($imovel['bairro']) ?></p>
    <p><strong>Complemento:</strong> <?= htmlspecialchars($imovel['complemento']) ?></p>

    <h3>Proprietário</h3>
    <p><strong>Nome:</strong> <?= htmlspecialchars($imovel['nome']) ?></p>
    <p><strong>CPF:</strong> <?= htmlspecialchars($imovel['cpf']) ?></p>
    <p><strong>Sexo:</strong> <?= htmlspecialchars($imovel['sexo']) ?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($imovel['telefone']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($imovel['email']) ?></p>

    <br>
    <br><br>
    <a href="../dashboard.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">⬅️ Voltar ao Menu</a>

</body>
</html>

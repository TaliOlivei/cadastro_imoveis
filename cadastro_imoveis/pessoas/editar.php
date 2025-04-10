<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}
include '../conexao.php';

if (!isset($_GET['id'])) {
    echo "ID da pessoa não informado!";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM pessoas WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "Pessoa não encontrada!";
    exit;
}

$pessoa = $resultado->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'] ?? null;
    $email = $_POST['email'] ?? null;

    if (empty($nome) || empty($data_nascimento) || empty($cpf) || empty($sexo)) {
        echo "❌ Por favor, preencha os campos obrigatórios.";
    } else {
        $sqlAtualiza = "UPDATE pessoas 
                        SET nome = ?, data_nascimento = ?, cpf = ?, sexo = ?, telefone = ?, email = ?
                        WHERE id = ?";
        $stmt = $conexao->prepare($sqlAtualiza);
        $stmt->bind_param("ssssssi", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email, $id);

        if ($stmt->execute()) {
            header("Location: listar.php");
            exit;
        } else {
            echo "Erro ao atualizar: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/editar.css">
    <title>Editar Pessoa</title>
</head>
<body>
<h2>Editar Pessoa</h2>
    
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($pessoa['nome']) ?>" required>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" value="<?= $pessoa['data_nascimento'] ?>" required>

        <label>CPF:</label>
        <input type="text" name="cpf" value="<?= htmlspecialchars($pessoa['cpf']) ?>" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="Masculino" <?= $pessoa['sexo'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
            <option value="Feminino" <?= $pessoa['sexo'] == 'Feminino' ? 'selected' : '' ?>>Feminino</option>
            <option value="Outro" <?= $pessoa['sexo'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
        </select>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($pessoa['telefone']) ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($pessoa['email']) ?>">

        <input type="submit" value="Salvar Alterações">
    </form>

    <div style="text-align: center;">
        <a class="voltar" href="listar.php">← Voltar à Lista</a><br><br>
        <a class="voltar" href="../dashboard.php">⬅️ Voltar ao Menu</a>
    </div>
</body>
</html>


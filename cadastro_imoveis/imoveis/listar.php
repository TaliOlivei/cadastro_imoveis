<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

include '../conexao.php';

// Verifica se há um filtro
$filtro_logradouro = isset($_GET['logradouro']) ? $_GET['logradouro'] : '';

$sql = "SELECT im.*, p.nome AS nome_contribuinte 
        FROM imoveis im
        LEFT JOIN pessoas p ON im.id_contribuinte = p.id";

if ($filtro_logradouro !== '') {
    $sql .= " WHERE im.logradouro LIKE ?";
    $stmt = $conexao->prepare($sql);
    $like = "%" . $filtro_logradouro . "%";
    $stmt->bind_param("s", $like);
} else {
    $stmt = $conexao->prepare($sql);
}

$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/listar.css">
    <title>Lista de Imóveis</title>
</head>
<body>

    <h2>Lista de Imóveis</h2>

    <!-- Formulário de busca -->
    <form method="get">
        <label for="logradouro">Buscar por Logradouro:</label>
        <input type="text" name="logradouro" id="logradouro" value="<?= htmlspecialchars($filtro_logradouro) ?>">
        <input type="submit" value="Buscar">
        <a href="listar.php">Limpar</a>
    </form>

    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Inscrição</th>
            <th>Logradouro</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Complemento</th>
            <th>Proprietário</th>
            <th>Ações</th>
        </tr>

        <?php while ($imovel = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $imovel['inscricao_municipal'] ?></td>
                <td><?= htmlspecialchars($imovel['logradouro']) ?></td>
                <td><?= htmlspecialchars($imovel['numero']) ?></td>
                <td><?= htmlspecialchars($imovel['bairro']) ?></td>
                <td><?= htmlspecialchars($imovel['complemento']) ?></td>
                <td><?= htmlspecialchars($imovel['nome_contribuinte']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $imovel['inscricao_municipal'] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $imovel['inscricao_municipal'] ?>" onclick="return confirm('Deseja excluir este imóvel?')">Excluir</a> |
                    <a href="detalhes_imovel.php?id=<?= $imovel['inscricao_municipal'] ?>">Ver Detalhes</a>            
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="cadastrar.php">+ Novo Imóvel</a>
    <a href="../dashboard.php">Voltar para o menu</a>

</body>
</html>

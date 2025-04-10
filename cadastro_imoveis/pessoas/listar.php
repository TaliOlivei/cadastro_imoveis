<?php
include '../conexao.php';

$sql = "SELECT id, nome FROM pessoas";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar pessoas: " . $conexao->error);
}
?>

<h2>Lista de Pessoas</h2>
<link rel="stylesheet" href="../css/listar.css">
<a class="link-superior" href="cadastrar.php">➕ Cadastrar Nova Pessoa</a>

<table>
    <thead>
        <tr>
            <th>ID</th><th>Nome</th><th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pessoa = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $pessoa['id'] ?></td>
                <td><?= htmlspecialchars($pessoa['nome']) ?></td>
                <td>
                    <a class="botao-acao editar" href="editar.php?id=<?= $pessoa['id'] ?>">Editar</a>
                    <a class="botao-acao excluir" href="excluir.php?id=<?= $pessoa['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<br><br>
<div style="text-align: center;">
    <a class="voltar" href="../dashboard.php">Voltar ao Menu</a>
</div>
</body>
</html>
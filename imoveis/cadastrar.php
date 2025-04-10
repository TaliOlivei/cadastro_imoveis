<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cadastrar.css">
    <title>Cadastro de Imóvel</title>
</head>
<body>
    <h2>Cadastro de Imóvel</h2>

    <form action="cadastrar_imoveis.php" method="post">
        <label>Logradouro:</label>
        <input type="text" name="logradouro" required><br><br>

        <label>Número:</label>
        <input type="text" name="numero" required><br><br>

        <label>Bairro:</label>
        <input type="text" name="bairro" required><br><br>

        <label>Complemento:</label>
        <input type="text" name="complemento"><br><br>

        <label for="id_contribuinte">Numeração Proprietário:</label>
        <input type="number" name="id_contribuinte" id="id_contribuinte" required><br><br>

        <input type="submit" value="Cadastrar Imóvel">
    </form>
    <br><br>
    <a href="../dashboard.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">⬅️ Voltar ao Menu</a>


</html>

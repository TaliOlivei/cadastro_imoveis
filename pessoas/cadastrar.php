<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "../css/cadastrar.css">
    <title>Cadastro de Pessoas</title>
</head>
<body>
    <h2>Cadastro de Pessoas</h2>
    <form action="cadastrar_pessoa.php" method="POST">
        <label for="nome">Nome*</label><br>
        <input type="text" name="nome" required><br><br>

        <label for="data_nascimento">Data de Nascimento*</label><br>
        <input type="date" name="data_nascimento" required><br><br>

        <label for="cpf">CPF*</label><br>
        <input type="text" name="cpf" required><br><br>

        <label for="sexo">Sexo*</label><br><br>
        <select name="sexo" required>
            <option value="">Selecione</option>
            <option value="Feminino">Feminino</option>
            <option value="Masculino">Masculino</option>
            <option value="Outro">Outro</option>
        </select><br><br>
        <label for="telefone">Telefone</label><br>
        <input type="text" name="telefone"><br><br>

        <label for="email">Email</label><br>
        <input type="email" name="email"><br><br>

        <button type="submit">Cadastra</button><br>

    </form>
    <br><br>
<a href="../dashboard.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">⬅️ Voltar ao Menu</a>

</body>
</html>
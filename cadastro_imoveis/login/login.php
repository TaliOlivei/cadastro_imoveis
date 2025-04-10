<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <link rel="stylesheet" href="login.css">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="validar.php" method="post">
        <label>Usuário:</label>
        <input type="text" name="usuario" placeholders="Usuário" required><br><br>
        <label>Senha:</label>
        <input type="password" name="senha" placeholders="Senha" required><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>

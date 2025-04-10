<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h1>Bem-vindo, <?= $_SESSION['usuario_nome'] ?? 'usuário' ?>!</h1>

<nav>
    <ul>
        <li><a href="pessoas/listar.php">Gerenciar Pessoas</a></li>
        <li><a href="imoveis/listar.php">Gerenciar Imóveis</a></li>
        <li><a href="login/logout.php">Sair</a></li>
    </ul>
</nav>

<h2>Sistema de Cadastro</h2>
<ul class="menu-opcoes">
    <li><a class="botao" href="pessoas/cadastrar.php">Cadastrar Pessoa</a></li>
    <li><a class="botao" href="imoveis/cadastrar.php">Cadastrar Imóvel</a></li>
</ul>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login/login.php");
    exit;
}
include 'conexao.php';
$sql = "SELECT id, nome FROM pessoas";
$res = $conexao->query($sql);
while ($row = $res->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['id']} - {$row['nome']}</option>";
}
?>
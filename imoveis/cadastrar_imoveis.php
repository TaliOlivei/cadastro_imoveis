<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

// Inclui a conexão com o banco de dados
include '../conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados enviados do formulário
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'] ?? null;
    $id_contribuinte = $_POST['id_contribuinte'];

    // Validação simples para garantir que campos obrigatórios foram preenchidos
    if (empty($logradouro) || empty($numero) || empty($bairro) || empty($id_contribuinte)) {
        echo "❌ Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Prepara o SQL com placeholders
        $sql = "INSERT INTO imoveis (logradouro, numero, bairro, complemento, id_contribuinte)
                VALUES (?, ?, ?, ?, ?)";

        // Prepara o comando
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            // Associa os parâmetros (5 valores: s = string, i = inteiro)
            $stmt->bind_param("ssssi", $logradouro, $numero, $bairro, $complemento, $id_contribuinte);

            // Executa
            if ($stmt->execute()) {
                echo "✅ Imóvel cadastrado com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar o imóvel: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ Erro na preparação da consulta: " . $conexao->error;
        }
    }
}
?>

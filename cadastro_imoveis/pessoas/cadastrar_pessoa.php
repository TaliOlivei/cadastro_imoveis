<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

// Inclui a conexão com o banco
include '../conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados do formulário
    $nome = $_POST['nome']; //pega o nome do HTML e atribuir para a varivel nome
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'] ?? null; //Se for null ele vai manda o valor null para variavel telefone. Senão, ele vai manda o valor. 
    $email = $_POST['email'] ?? null;

    // Validação básica
    if (empty($nome) || empty($data_nascimento) || empty($cpf) || empty($sexo)) { // Se forrem null terá uma mensagem de erro. 
        echo "❌ Por favor, preencha os campos obrigatórios.";// essa mensagem 
    } else {
        // Prepara o comando SQL com placeholders
        $sql = "INSERT INTO pessoas (nome, data_nascimento, cpf, sexo, telefone, email)
                VALUES (?, ?, ?, ?, ?, ?)"; // para evita o injete do SQL do banco de dados.

        // Prepara o statement
        $stmt = $conexao->prepare($sql);

        // Verifica se o prepare deu certo
        if ($stmt) {
            // Associa os parâmetros à consulta
            // as ssssss está dizendo "Ei, banco de dados estou passando seis valores, ok?"
            $stmt->bind_param("ssssss", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email);

            // Executa a consulta
            if ($stmt->execute()) {// Vai me mostra se funcionou :) 
                echo "✅ Pessoa cadastrada com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar: " . $stmt->error; // ou não :(  
            }

            $stmt->close(); // Fecha o statement
        } else {
            echo "❌ Erro na preparação da consulta: " . $conexao->error;
        }
    }
}
?>

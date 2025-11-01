<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = $_POST['nome_completo'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $logradouro = $_POST['logradouro'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $uf = $_POST['uf'] ?? '';
    $telefone_fixo = $_POST['telefone_fixo'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';

    if (empty($nome_completo) || empty($cep) || empty($telefone) || empty($cpf)) {
        die("Erro: Preencha os campos obrigatórios.");
    }

    // Verifica se o número foi desabilitado (caso o usuário marque "Não tenho número")
    if (isset($_POST['noNumber']) && $_POST['noNumber'] == 'on') {
        $numero = ''; // Define o número como vazio
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO clientes (nome_completo, cep, logradouro, bairro, cidade, uf, telefone_fixo, telefone, cpf, cnpj, numero, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome_completo, $cep, $logradouro, $bairro, $cidade, $uf, $telefone_fixo, $telefone, $cpf, $cnpj, $numero, $complemento]);

        header("Location: banco_dados.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar cliente: " . $e->getMessage());
    }
} else {
    die("Acesso inválido.");
}
?>
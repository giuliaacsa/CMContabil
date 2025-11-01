<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui os contratos associados ao cliente
    $stmt = $pdo->prepare("DELETE FROM contratos WHERE cliente_id = ?");
    $stmt->execute([$id]);

    // Exclui o cliente
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: banco_dados.php");
    exit;
} else {
    die("ID do cliente não fornecido.");
}
?>
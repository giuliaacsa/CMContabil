<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM contratos WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: banco_dados.php");
    exit;
} else {
    die("ID do contrato não fornecido.");
}
?>
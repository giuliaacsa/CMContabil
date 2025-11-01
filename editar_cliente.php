<?php
$pageTitle = "Editar Cliente";
include 'header.php';
require 'connection.php';

if (!isset($_GET['id'])) {
    die("ID do cliente não fornecido.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    die("Cliente não encontrado.");
}

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

    if(empty($nome_completo) || empty($cep) || empty($telefone) || empty($cpf)) {
        die("Erro: Preencha os campos obrigatórios.");
    }

    $stmt = $pdo->prepare("UPDATE clientes SET nome_completo = ?, cep = ?, logradouro = ?, bairro = ?, cidade = ?, uf = ?, telefone_fixo = ?, telefone = ?, cpf = ?, cnpj = ?, numero = ?, complemento = ? WHERE id = ?");
    $stmt->execute([$nome_completo, $cep, $logradouro, $bairro, $cidade, $uf, $telefone_fixo, $telefone, $cpf, $cnpj, $numero, $complemento, $id]);

    header("Location: banco_dados.php");
    exit;
}
?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Editar Cliente</h3>
    <form action="editar_cliente.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
            <label>Nome Completo:</label>
            <input type="text" class="form-control" name="nome_completo" value="<?php echo $cliente['nome_completo']; ?>" required>
        </div>
        <div class="mb-3">
            <label>CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cliente['cpf']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $cliente['telefone']; ?>" required>
        </div>
        <div class="mb-3">
            <label>CNPJ (opcional):</label>
            <input type="text" class="form-control" name="cnpj" id="cnpj" value="<?php echo $cliente['cnpj']; ?>">
        </div>
        <div class="mb-3">
            <label>CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $cliente['cep']; ?>" onblur="buscarCep('cep','logradouro','bairro','cidade','uf')" required>
        </div>
        <div class="mb-3">
            <label>Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?php echo $cliente['logradouro']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $cliente['bairro']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cliente['cidade']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>UF:</label>
            <input type="text" class="form-control" id="uf" name="uf" value="<?php echo $cliente['uf']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Número do Estabelecimento/nº Casa:</label>
            <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $cliente['numero']; ?>" required>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="noNumber" onclick="toggleNumberField()">
                <label class="form-check-label" for="noNumber">Não tenho número</label>
            </div>
        </div>
        <div class="mb-3">
            <label>Complemento:</label>
            <input type="text" class="form-control" name="complemento" value="<?php echo $cliente['complemento']; ?>">
        </div>
        <div class="mb-3">
            <label>Telefone Fixo (opcional):</label>
            <input type="text" class="form-control" name="telefone_fixo" id="telefone_fixo" value="<?php echo $cliente['telefone_fixo']; ?>">
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>

<script>
function toggleNumberField() {
    var numeroField = document.getElementById('numero');
    if (document.getElementById('noNumber').checked) {
        numeroField.disabled = true;
        numeroField.value = '';
    } else {
        numeroField.disabled = false;
    }
}

document.getElementById('cpf').addEventListener('input', function(e) {
    var cpf = e.target.value.replace(/\D/g, '');
    if (cpf.length > 11) cpf = cpf.substring(0, 11);
    e.target.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
});

document.getElementById('cnpj').addEventListener('input', function(e) {
    var cnpj = e.target.value.replace(/\D/g, '');
    if (cnpj.length > 14) cnpj = cnpj.substring(0, 14);
    e.target.value = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
});

document.getElementById('telefone').addEventListener('input', function(e) {
    var telefone = e.target.value.replace(/\D/g, '');
    if (telefone.length > 11) telefone = telefone.substring(0, 11);
    e.target.value = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
});

document.getElementById('telefone_fixo').addEventListener('input', function(e) {
    var telefone = e.target.value.replace(/\D/g, '');
    if (telefone.length > 10) telefone = telefone.substring(0, 10);
    e.target.value = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
});

document.getElementById('cep').addEventListener('input', function(e) {
    var cep = e.target.value.replace(/\D/g, '');
    if (cep.length > 8) cep = cep.substring(0, 8);
    e.target.value = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
});
</script>

<?php include 'footer.php'; ?>
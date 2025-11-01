<?php
$pageTitle = "Editar Contrato";
include 'header.php';
require 'connection.php';

if (!isset($_GET['id'])) {
    die("ID do contrato não fornecido.");
}

$id = $_GET['id'];

// Busca os dados do contrato
$stmt = $pdo->prepare("SELECT * FROM contratos WHERE id = ?");
$stmt->execute([$id]);
$contrato = $stmt->fetch();

if (!$contrato) {
    die("Contrato não encontrado.");
}

// Busca os dados do cliente associado ao contrato
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$contrato['cliente_id']]);
$cliente = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome_empresa = $_POST['nome_empresa'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $logradouro = $_POST['logradouro'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $uf = $_POST['uf'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
    $valor = $_POST['valor'] ?? '';
    $pagamento_honorario = $_POST['pagamento_honorario'] ?? '';
    $quantia_honorarios = $_POST['quantia_honorarios'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $mes = $_POST['mes'] ?? '';
    $ano = $_POST['ano'] ?? '';

    // Atualiza os dados no banco de dados
    $stmt = $pdo->prepare("UPDATE contratos SET nome_empresa = ?, cpf = ?, cnpj = ?, telefone = ?, cep = ?, logradouro = ?, bairro = ?, cidade = ?, uf = ?, numero = ?, complemento = ?, valor = ?, pagamento_honorario = ?, quantia_honorarios = ?, dia = ?, mes = ?, ano = ? WHERE id = ?");
    $stmt->execute([$nome_empresa, $cpf, $cnpj, $telefone, $cep, $logradouro, $bairro, $cidade, $uf, $numero, $complemento, $valor, $pagamento_honorario, $quantia_honorarios, $dia, $mes, $ano, $id]);

    header("Location: banco_dados.php");
    exit;
}
?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Editar Contrato</h3>
    <form action="editar_contrato.php?id=<?php echo $id; ?>" method="POST">
        <!-- Informações Pessoais -->
        <div class="mb-3">
            <label>Nome da Empresa:</label>
            <input type="text" class="form-control" name="nome_empresa" value="<?php echo $contrato['nome_empresa'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cliente['cpf'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>CNPJ:</label>
            <input type="text" class="form-control" name="cnpj" id="cnpj" value="<?php echo $cliente['cnpj'] ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $cliente['telefone'] ?? ''; ?>" required>
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label>CEP:</label>
            <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $cliente['cep'] ?? ''; ?>" onblur="buscarCep('cep', 'logradouro', 'bairro', 'cidade', 'uf')" required>
        </div>
        <div class="mb-3">
            <label>Logradouro:</label>
            <input type="text" class="form-control" name="logradouro" id="logradouro" value="<?php echo $cliente['logradouro'] ?? ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Bairro:</label>
            <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $cliente['bairro'] ?? ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Cidade:</label>
            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $cliente['cidade'] ?? ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>UF:</label>
            <input type="text" class="form-control" name="uf" id="uf" value="<?php echo $cliente['uf'] ?? ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Número do Estabelecimento/nº Casa:</label>
            <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $cliente['numero'] ?? ''; ?>" required>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="noNumber" name="noNumber" onclick="toggleNumberField()">
                <label class="form-check-label" for="noNumber">Não tenho número</label>
            </div>
        </div>
        <div class="mb-3">
            <label>Complemento:</label>
            <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $cliente['complemento'] ?? ''; ?>">
        </div>

        <!-- Informações do Contrato -->
        <div class="mb-3">
            <label>Preço Honorário:</label>
            <input type="text" class="form-control" name="valor" id="valor" value="<?php echo $contrato['valor'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Dia de Pagamento do(s) Honorário(s):</label>
            <select name="pagamento_honorario" class="form-control" required>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo ($i == ($contrato['pagamento_honorario'] ?? '')) ? 'selected' : ''; ?>>
                        <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Quantia de Honorários:</label>
            <input type="text" class="form-control" name="quantia_honorarios" id="quantia_honorarios" value="<?php echo $contrato['quantia_honorarios'] ?? ''; ?>" required>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Dia Atual:</label>
                <select name="dia" class="form-control" required>
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == ($contrato['dia'] ?? '')) ? 'selected' : ''; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Mês Atual:</label>
                <select name="mes" class="form-control" required>
                    <?php
                    $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                    foreach ($meses as $mesNome): ?>
                        <option value="<?php echo $mesNome; ?>" <?php echo ($mesNome == ($contrato['mes'] ?? '')) ? 'selected' : ''; ?>>
                            <?php echo $mesNome; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Ano Atual:</label>
                <input type="text" class="form-control" name="ano" value="<?php echo $contrato['ano'] ?? ''; ?>" required>
            </div>
        </div>
</div>
<div class="text-center mt-3">
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</div>
</form>
</div>

<script>
    // Função para desabilitar o campo de número
    function toggleNumberField() {
        var numeroField = document.getElementById('numero');
        if (document.getElementById('noNumber').checked) {
            numeroField.disabled = true;
            numeroField.value = '';
        } else {
            numeroField.disabled = false;
        }
    }

    // Máscaras para os campos
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

    document.getElementById('cep').addEventListener('input', function(e) {
        var cep = e.target.value.replace(/\D/g, '');
        if (cep.length > 8) cep = cep.substring(0, 8);
        e.target.value = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
    });
</script>

<?php include 'footer.php'; ?>
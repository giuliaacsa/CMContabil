<?php
$pageTitle = "Contratos";
include 'header.php';
require 'connection.php';

// Busca a lista de clientes
$stmt = $pdo->query("SELECT id, nome_completo FROM clientes");
$clientes = $stmt->fetchAll();
?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Gerar Contrato</h3>
    <form action="processa_contrato.php" method="POST">
        <!-- Informações Pessoais -->
        <div class="mb-3">
            <label>Selecione o Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required onchange="carregarDadosCliente()">
                <option value="">Selecione...</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome_completo']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Nome da Empresa:</label>
            <input type="text" class="form-control" name="nome_empresa" id="nome_empresa" required>
        </div>
        <div class="mb-3">
            <label>CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" required>
        </div>
        <div class="mb-3">
            <label>CNPJ:</label>
            <input type="text" class="form-control" name="cnpj" id="cnpj">
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="telefone" required>
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label>CEP:</label>
            <input type="text" class="form-control" name="cep" id="cep" onblur="buscarCep('cep', 'logradouro', 'bairro', 'cidade', 'uf')" required>
        </div>
        <div class="mb-3">
            <label>Logradouro:</label>
            <input type="text" class="form-control" name="logradouro" id="logradouro" readonly>
        </div>
        <div class="mb-3">
            <label>Bairro:</label>
            <input type="text" class="form-control" name="bairro" id="bairro" readonly>
        </div>
        <div class="mb-3">
            <label>Cidade:</label>
            <input type="text" class="form-control" name="cidade" id="cidade" readonly>
        </div>
        <div class="mb-3">
            <label>UF:</label>
            <input type="text" class="form-control" name="uf" id="uf" readonly>
        </div>
        <div class="mb-3">
            <label>Número do Estabelecimento/nº Casa:</label>
            <input type="text" class="form-control" name="numero" id="numero" required>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="noNumber" name="noNumber" onclick="toggleNumberField()">
                <label class="form-check-label" for="noNumber">Não tenho número</label>
            </div>
        </div>
        <div class="mb-3">
            <label>Complemento:</label>
            <input type="text" class="form-control" name="complemento" id="complemento">
        </div>

        <!-- Informações do Contrato -->
        <div class="mb-3">
            <label>Preço Honorário:</label>
            <input type="text" class="form-control" name="valor" id="valor" required>
        </div>
        <div class="mb-3">
            <label>Dia de Pagamento do(s) Honorário(s):</label>
            <select name="pagamento_honorario" class="form-control" required>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Quantia de Honorários:</label>
            <input type="text" class="form-control" name="quantia_honorarios" id="quantia_honorarios" required>
        </div>

        <!-- Data de Início -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Dia de Início:</label>
                <select name="diainicio" class="form-control" required>
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Mês de Início:</label>
                <select name="mesinicio" class="form-control" required>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Ano de Início:</label>
                <input type="text" class="form-control" name="anoinicio" required>
            </div>
        </div>

        <!-- Data Atual -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Dia Atual:</label>
                <select name="dia" class="form-control" required>
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Mês Atual:</label>
                <select name="mes" class="form-control" required>
                    <?php
                    $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                    foreach ($meses as $mesNome): ?>
                        <option value="<?php echo $mesNome; ?>"><?php echo $mesNome; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Ano Atual:</label>
                <input type="text" class="form-control" name="ano" value="<?php echo date('Y'); ?>" required>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary w-100">Gerar Contrato</button>
        </div>
    </form>
</div>

<script>
// Função para carregar os dados do cliente
function carregarDadosCliente() {
    var clienteId = document.getElementById('cliente_id').value;
    if (clienteId) {
        fetch('buscar_cliente.php?id=' + clienteId)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('cpf').value = data.cpf || '';
                    document.getElementById('cnpj').value = data.cnpj || '';
                    document.getElementById('telefone').value = data.telefone || '';
                    document.getElementById('cep').value = data.cep || '';
                    document.getElementById('logradouro').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.cidade || '';
                    document.getElementById('uf').value = data.uf || '';
                    document.getElementById('numero').value = data.numero || '';
                    document.getElementById('complemento').value = data.complemento || '';
                }
            })
            .catch(error => console.error('Erro ao carregar dados do cliente:', error));
    }
}

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
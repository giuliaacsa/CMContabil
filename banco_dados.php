<?php
$pageTitle = "Banco de Dados";
include 'header.php';
require 'connection.php';
?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Dados do Sistema</h3>
    
    <h4>Clientes Cadastrados</h4>
    <?php
    $stmt = $pdo->query("SELECT * FROM clientes");
    $clientes = $stmt->fetchAll();
    if ($clientes):
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>CEP</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome_completo']; ?></td>
                <td><?php echo $cliente['cep']; ?></td>
                <td><?php echo $cliente['telefone']; ?></td>
                <td><?php echo $cliente['cpf']; ?></td>
                <td>
                    <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>Nenhum cliente cadastrado.</p>
    <?php endif; ?>

    <h4 class="mt-5">Contratos Gerados</h4>
    <?php
    $stmt = $pdo->query("SELECT c.id, cl.nome_completo, c.nome_contrato, c.caminho_contrato FROM contratos c INNER JOIN clientes cl ON c.cliente_id = cl.id");
    $contratos = $stmt->fetchAll();
    if ($contratos):
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Nome do Contrato</th>
                <th>Caminho do Contrato</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?php echo $contrato['id']; ?></td>
                <td><?php echo $contrato['nome_completo']; ?></td>
                <td><?php echo $contrato['nome_contrato']; ?></td>
                <td><?php echo $contrato['caminho_contrato']; ?></td>
                <td>
                    <a href="editar_contrato.php?id=<?php echo $contrato['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="excluir_contrato.php?id=<?php echo $contrato['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este contrato?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>Nenhum contrato gerado.</p>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
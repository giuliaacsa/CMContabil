<?php 
$pageTitle = "Home"; 
include 'header.php'; 
?>
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <a href="contratos.php" class="btn btn-outline-primary w-100 p-4 home-button">
                <i class="fas fa-file-contract fa-3x"></i>
                <div class="mt-2">Contratos</div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="cadastro.php" class="btn btn-outline-primary w-100 p-4 home-button">
                <i class="fas fa-user-plus fa-3x"></i>
                <div class="mt-2">Cadastro</div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="banco_dados.php" class="btn btn-outline-primary w-100 p-4 home-button">
                <i class="fas fa-database fa-3x"></i>
                <div class="mt-2">Banco de Dados</div>
            </a>
        </div>
    </div>
</div>
<style>
    .home-button {
        transition: transform 0.3s;
    }
    .home-button:hover {
        transform: scale(1.1);
    }
</style>
<?php include 'footer.php'; ?>
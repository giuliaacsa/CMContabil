<?php
// header.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageTitle ?? 'Sistema'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script>
      function buscarCep(inputId, logradouroId, bairroId, cidadeId, ufId) {
          let cep = document.getElementById(inputId).value.replace(/\D/g, '');
          if (cep.length !== 8) return;
          fetch(`https://viacep.com.br/ws/${cep}/json/`)
              .then(response => response.json())
              .then(data => {
                  if (!data.erro) {
                      document.getElementById(logradouroId).value = data.logradouro;
                      document.getElementById(bairroId).value = data.bairro;
                      document.getElementById(cidadeId).value = data.localidade;
                      document.getElementById(ufId).value = data.uf;
                  }
              })
              .catch(error => console.error("Erro ao buscar CEP:", error));
      }
  </script>
</head>
<body>
  <nav class="navbar bg-white shadow-sm p-3">
      <div class="container-fluid">
          <a class="navbar-brand d-flex align-items-center" href="index.php">
              <img src="logoapp.jpg" alt="Logo" width="140" height="80">
              <span class="ms-3 text-dark fw-bold fs-4">CM Contabilidade Moraes</span>
          </a>
      </div>
  </nav>
  <hr style="border-top: 3px solid blue;">

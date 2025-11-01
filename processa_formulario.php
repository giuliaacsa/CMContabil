<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

function buscarCep($cep) {
    $cep = preg_replace('/\D/', '', $cep);

    if (strlen($cep) !== 8) {
        die("CEP inválido.");
    }

    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $response = file_get_contents($url);

    if ($response === false) {
        die("Erro ao buscar o CEP. Tente novamente mais tarde.");
    }

    return json_decode($response, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_empresa = $_POST['nome_empresa'] ?? '';
    $contratante = $_POST['contratante'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $valor = $_POST['valor'] ?? '';
    $pagamento_honorario = $_POST['pagamento_honorario'] ?? '';
    $quantia_honorarios = $_POST['quantia_honorarios'] ?? '';
    //$data_inicio = $_POST['data_inicio'] ?? '';
    $diainicio = $_POST['diainicio'] ?? '';
    $mesinicio = $_POST['mesinicio'] ?? '';
    $anoinicio = $_POST['anoinicio'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $mes = $_POST['mes'] ?? '';
    $ano = $_POST['ano'] ?? '';

    if (empty($nome_empresa) || empty($contratante) || empty($cep) || empty($numero) || empty($cnpj) || empty($cpf) || empty($valor)) {
        die("Erro: Todos os campos obrigatórios devem ser preenchidos.");
    }

    $valor = "R$ " . $valor;

    $endereco = buscarCep($cep);
    $logradouro = $endereco['logradouro'] ?? '';
    $bairro = $endereco['bairro'] ?? '';
    $cidade = $endereco['localidade'] ?? '';
    $uf = $endereco['uf'] ?? '';

    $modeloContrato = "C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato teste.docx";
    $novoContrato = "C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Preenchido.docx";

    if (!file_exists($modeloContrato)) {
        die("Erro: O arquivo do contrato não foi encontrado no caminho: " . realpath($modeloContrato));
    }

    $template = new TemplateProcessor($modeloContrato); // PhpOffice\PhpWord\TemplateProcessor

    $template->setValue('nome_empresa', $nome_empresa);
    $template->setValue('contratante', $contratante);
    $template->setValue('cep', $cep);
    $template->setValue('logradouro', $logradouro);
    $template->setValue('bairro', $bairro);
    $template->setValue('cidade', $cidade);
    $template->setValue('uf', $uf);
    $template->setValue('numero', $numero);
    $template->setValue('cnpj', $cnpj);
    $template->setValue('cpf', $cpf);
    $template->setValue('valor', $valor);
    $template->setValue('pagamento_honorario', $pagamento_honorario);
    $template->setValue('quantia_honorarios', $quantia_honorarios);
    //$template->setValue('data_inicio', $data_inicio);
    $template->setValue('diainicio', $diainicio);
    $template->setValue('mesinicio', $mesinicio);
    $template->setValue('anoinicio', $anoinicio);
    $template->setValue('dia', $dia);
    $template->setValue('mes', $mes);
    $template->setValue('ano', $ano);

    $template->saveAs($novoContrato);

    if (!file_exists($novoContrato)) {
        die("Erro ao gerar o contrato.");
    }

    header("Content-Description: File Transfer");
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=" . basename($novoContrato));
    header("Expires: 0");
    header("Cache-Control: must-revalidate");
    header("Pragma: public");
    header("Content-Length: " . filesize($novoContrato));
    readfile($novoContrato);
    exit;
}
?>

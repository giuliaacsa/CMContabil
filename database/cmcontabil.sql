-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/03/2025 às 02:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cmcontabil`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(10) DEFAULT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome_completo`, `cep`, `logradouro`, `bairro`, `cidade`, `uf`, `telefone_fixo`, `telefone`, `cpf`, `cnpj`) VALUES
(6, 'Giulia Acsa dos Santos Muniz', '12903807', 'Rua Malbec', 'Residencial Quinta dos Vinhedos', 'Bragança Paulista', 'SP', '11934539301', '11974668659', '50590973827', '66666666666666'),
(7, 'Marcio Jose de Moraes', '12913045', 'Estrada Mauro de Próspero', 'Residencial das Ilhas', 'Bragança Paulista', 'SP', '1187665544', '110099887766', '666.666.666.90', ''),
(8, 'hgfghfhgfhgfg', '12954789', 'Rua Alberto Helena', 'Vila Santa Helena', 'Atibaia', 'SP', '', '5454', 'yyt', ''),
(9, 'André Augusto Gutierres Fernandes Beati', '12904180', 'Rua Bocaina', 'Vila Santa Libânia', 'Bragança Paulista', 'SP', '11 994125038', '11 994125038', '29641001876', ''),
(10, 'Gabriel de Farias Miranda', '12912380', 'Rua Jundiaí', 'Vila Municipal', 'Bragança Paulista', 'SP', '11974668659', '11974668659', '666666666666666', ''),
(11, 'Gabriel de Farias Miranda', '12912380', 'Rua Jundiaí', 'Vila Municipal', 'Bragança Paulista', 'SP', '11974668659', '411111111111', '666666666666666', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nome_contrato` varchar(255) NOT NULL,
  `caminho_contrato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contratos`
--

INSERT INTO `contratos` (`id`, `cliente_id`, `nome_contrato`, `caminho_contrato`) VALUES
(1, 6, 'Contrato_Giulia_Acsa_dos_Santos_Muniz.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Giulia_Acsa_dos_Santos_Muniz.docx'),
(2, 7, 'Contrato_Marcio_Jose_de_Moraes.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Marcio_Jose_de_Moraes.docx'),
(3, 8, 'Contrato_hgfghfhgfhgfg.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_hgfghfhgfhgfg.docx'),
(4, 7, 'Contrato_Marcio_Jose_de_Moraes.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Marcio_Jose_de_Moraes.docx'),
(5, 9, 'Contrato_André_Augusto_Gutierres_Fernandes_Beati.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_André_Augusto_Gutierres_Fernandes_Beati.docx'),
(6, 6, 'Contrato_Giulia_Acsa_dos_Santos_Muniz.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Giulia_Acsa_dos_Santos_Muniz.docx'),
(7, 11, 'Contrato_Gabriel_de_Farias_Miranda.docx', 'C:\\xampp\\htdocs\\VSCode - Projetos\\CMContabil\\Contratos\\Contrato_Gabriel_de_Farias_Miranda.docx');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

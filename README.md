## 🧾 Sistema de Gestão de Contratos — CMContábil

Este sistema foi desenvolvido por **Giulia Acsa dos Santos Muniz** e **Gabriel de Farias Miranda** para a empresa **CMContabil**, com o objetivo de **otimizar o gerenciamento de contratos**, centralizando informações e automatizando processos que antes eram realizados manualmente.

O projeto está **em processo de aprimoramento e negociação comercial**, com foco na expansão das funcionalidades e na integração a outros módulos administrativos.

---

## 🚀 Funcionalidades principais:

  * Cadastro e edição de contratos

  * Associação de clientes e serviços

  * Geração automática de documentos (via PHPWord)

  * Controle de dados (edição e exclusão)

  * Exportação e formatação profissional dos documentos

  * Interface simples e intuitiva para uso empresarial

---

## 🛠️ Tecnologias utilizadas

- **PHP** — Back-end e lógica de negócios  
- **MySQL** — Banco de dados relacional  
- **HTML5** — Estrutura das páginas  
- **CSS3** — Estilização e responsividade  
- **JavaScript** — Interatividade e validações  
- **Bootstrap** — Layout responsivo e componentes visuais  
- **Composer** — Gerenciador de dependências (com dependências: vendor, phpoffice, math, phpword)

---

## 🗃️ Banco de Dados

O arquivo de banco de dados (`cmcontabil.sql`) está localizado na pasta `/database`.  
> Basta importá-lo no **phpMyAdmin** para criar as tabelas necessárias.

---

## 📦 Instalação e Execução

1. Clone este repositório:
   ```bash
   git clone https://github.com/giuliaacsa/CMContabil.git

2. Acesse a pasta do projeto:
   ```bash
   cd CMContabil

3. Instale as dependências via Composer:
    ```bash
    composer install

4. Configure a conexão com o banco de dados no arquivo de configuração (ex: config.php ou similar).

5. Importe o banco de dados (cmcontabil.sql) no phpMyAdmin.

6. Inicie o servidor local com o XAMPP (ou similar) e acesse:
    ```bash
    http://localhost/CMContabil

## 📚 Aprendizados

Durante o desenvolvimento deste projeto, pude aprimorar habilidades de:

  * Estruturação de sistemas web com PHP e MySQL

  * Organização de dados e modelagem de tabelas para contratos e clientes

  * Implementação completa de CRUD para gerenciamento de informações

  * Geração automática de documentos e relatórios em PDF e Word usando bibliotecas do Composer

  * Integração de múltiplas bibliotecas externas (phpoffice, math, phpword) de forma organizada

  * Colaboração em equipe, trabalhando junto com outro desenvolvedor em um projeto real

  * Desenvolvimento de soluções voltadas para necessidades de um cliente específico, aplicando feedback e melhorias contínuas

## 👩‍💻 Autores

**Giulia Acsa dos Santos Muniz**

Estudante do curso técnico em Desenvolvimento de Sistemas — ETEC de Bragança Paulista

📫 LinkedIn: 
www.linkedin.com/in/giulia-acsa-dos-santos-muniz-b5bb13267

**Gabriel de Farias Miranda**

Estudante do curso técnico em Desenvolvimento de Sistemas — ETEC de Bragança Paulista

📫 LinkedIn:
https://www.linkedin.com/in/gabriel-de-farias-miranda-28b90a252/

## ⚙️ Observação

A pasta /vendor foi ignorada no repositório por meio do .gitignore,
mas pode ser recriada automaticamente executando o comando:
   ```bash
   composer install

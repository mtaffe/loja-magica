### README.md

# Aplicação Web de Gerenciamento de Clientes e Pedidos

## Descrição

Esta é uma aplicação web desenvolvida utilizando PHP, JavaScript, Bootstrap, HTML e CSS. A aplicação permite a importação de arquivos de clientes no formato Excel, operações CRUD para clientes e pedidos, leitura e importação de arquivos XML para pedidos, e envio de e-mails para promoções, avisos e atualizações de pedidos.

## Funcionalidades

1. **Importação de Arquivos Excel**:
   - Permite a importação de arquivos de clientes no formato Excel.
   
2. **Operações CRUD para Clientes**:
   - Create (Criar): Adicionar novos clientes ao sistema.
   - Read (Ler): Visualizar a lista de clientes cadastrados.
   - Update (Atualizar): Atualizar informações dos clientes.
   - Delete (Excluir): Remover clientes do sistema.

3. **Leitura e Importação de Arquivos XML para Pedidos**:
   - Importar e processar arquivos XML contendo informações de pedidos.

4. **Operações CRUD para Pedidos**:
   - Create (Criar): Adicionar novos pedidos ao sistema.
   - Read (Ler): Visualizar a lista de pedidos cadastrados.
   - Update (Atualizar): Atualizar informações dos pedidos.
   - Delete (Excluir): Remover pedidos do sistema.

5. **Envio de E-mails**:
   - Enviar e-mails para promoções, avisos e atualizações de pedidos.

## Instruções de Instalação

### Pré-requisitos

- XAMPP (ou outro servidor Apache com suporte para PHP e MySQL)
- Navegador web
- Editor de texto ou IDE para PHP

### Passo a Passo

1. **Clonar o Repositório**

   Clone este repositório para o seu diretório local e acesse a pasta para executar a instalação das dependências:
   ```bash
   git clone https://github.com/mtaffe/loja-magica.git
   cd loja-magica
   composer update
   ```

2. **Importar o Banco de Dados**

   - Abra o phpMyAdmin (ou outro cliente MySQL).
   - Crie um novo banco de dados.
   - Importe o arquivo `database.sql` localizado na pasta do projeto:
     ```sql
     SOURCE caminho/para/database.sql;
     ```

3. **Configurar as Credenciais do Banco de Dados e URL**

   - Abra o arquivo `config.php` no editor de texto.
   - Configure as credenciais do banco de dados e URL conforme necessário:
     ```php
     <?php
     define('BASE_URL', 'http://localhost/loja-magica/');

     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'seu_usuario');
     define('DB_PASSWORD', 'sua_senha');
     define('DB_DATABASE', 'nome_do_banco_de_dados');
     ?>
     ```

4. **Mover a Pasta do Projeto para o Servidor XAMPP**

   - Mova a pasta do projeto para o diretório `htdocs` do XAMPP:
     ```bash
     mv caminho/para/seu_projeto /caminho/para/xampp/htdocs/
     ```

5. **Iniciar o Servidor Apache**

   - Abra o painel de controle do XAMPP e inicie o servidor Apache e MySQL.

6. **Acessar a Aplicação**

   - Abra o navegador web e acesse:
     ```
     http://localhost/loja-magica/
     ```

## Uso

### Dados para login

   - email: admin@email.com
   - senha: admin

### Importação de Clientes

1. Vá para a seção de importação de clientes.
2. Faça o upload do arquivo Excel contendo os dados dos clientes.
3. Clique em "Importar" para processar o arquivo e adicionar os clientes ao banco de dados.

### Gerenciamento de Clientes

- **Adicionar Cliente**: Preencha o formulário de novo cliente e clique em "Salvar".
- **Visualizar Clientes**: Navegue até a lista de clientes para visualizar todos os clientes cadastrados.
- **Editar Cliente**: Clique no botão de edição ao lado do cliente que deseja atualizar, faça as alterações e salve.
- **Excluir Cliente**: Clique no botão de exclusão ao lado do cliente que deseja remover.

### Importação de Pedidos

1. Vá para a seção de importação de pedidos.
2. Faça o upload do arquivo XML contendo os dados dos pedidos.
3. Clique em "Importar" para processar o arquivo e adicionar os pedidos ao banco de dados.

### Gerenciamento de Pedidos

- **Adicionar Pedido**: Preencha o formulário de novo pedido e clique em "Salvar".
- **Visualizar Pedidos**: Navegue até a lista de pedidos para visualizar todos os pedidos cadastrados.
- **Editar Pedido**: Clique no botão de edição ao lado do pedido que deseja atualizar, faça as alterações e salve.
- **Excluir Pedido**: Clique no botão de exclusão ao lado do pedido que deseja remover.

### Envio de E-mails

- Navegue até a seção de envio de e-mails.
- Selecione o tipo de e-mail que deseja enviar (promoção, aviso, atualização de pedido).
- Preencha os detalhes do e-mail e clique em "Enviar".

---

Feito com por Matheus Taffe
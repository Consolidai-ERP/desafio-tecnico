# Desafio técnico

Desenvolver uma Aplicação Web, utilizando PHP e uma estrutura básica em MVC (sem a utilização de
frameworks para o backend). A aplicação deve exibir uma listagem de registros de clientes, em formato de
“table”, onde cada um destes, poderão sofrer todas as operações básicas de CRUD.

O layout da aplicação deverá ser responsivo / adaptativo e utilizar o Boostrap para tal. Deve ser utilizado AJAX nas
operações de CRUD utilizando jQuery.

Pra realização desse teste o candidato deverá realizar um fork do repositório, realizar o teste inserindo os arquivos dentro do mesmo repositório e ao finalizar todo o teste deverá realizar um Pull Request para o repositório original.

## Atenção

Para o teste ser válido, o candidato deverá preencher toda a documentação básica dentro deste mesmo arquivo README.md informando todos os tópicos necessários pra ser executado no ambiente do testador.

Em casos de problema de execução do ambiente do avaliador, o teste poderá ser desconsiderado.

# Requisitos

1. PHP >= 5;
2. MySQL >= 5.6;
3. Bootstrap >= 3.3;
4. Git / Github.

## Instalação
1. Certifique-se de que você possui Docker e Docker Compose instalados em sua máquina de acordo o sistema operacional.
    * Instalar o Docker: <https://docs.docker.com/get-started/get-docker/>

2. Faça o download do código ou clone o repositório do pull request.

3. As seguintes portas precisam estar disponíveis:
    * 8000:80
    * 8080:80
    * 3306:3306
    * essas portas se referem à aplicação, phpmyadmin e mysql respectivamente.

4. Navegue até a pasta do projeto pela linha de comando e execute o seguinte comando:
    * docker-compose up -d

5. Acesse:
    Aplicação: <http://localhost:8000>
    Phpmyadmin: <http://localhost:8080>

## Utilização
### Funcionalidades principais
1. Login
    * Na tela inicial, autentique-se usando as credenciais fornecidas:
        * teste@gmail.com.br
        * batatinhafrita123

2. Cadastro de Clientes:
    * Acesse a funcionalidade "Cadastrar" para criar novos registros.
    * Campos disponíveis: Nome, E-mail, Endereço, CEP, Número, Complemento, Tipo de Pessoa (Física/Jurídica), e CPF/CNPJ.

3. Gerenciamento:
    * Edite ou exclua clientes existentes usando os botões disponíveis na lista.

## Funcionamento
### Estrutura do projeto
* Arquitetura MVC:
    * Models: Manipulação de dados com PDO para interação segura com o banco de dados.
    * Views: Arquivos PHP que geram as páginas exibidas ao usuário.
    * Controllers: Processamento de requisições e controle do fluxo do sistema.

* Banco de dados
    * O banco de dados é criado a partir do arquivo init.sql executado pelo docker

* Fluxo do Sistema
1. O sistema inicia na tela de login.
2. Após autenticação, o usuário é redirecionado para a tela principal de gerenciamento de clientes.
3. Todas as operações (cadastrar, editar, excluir) passam por validações de segurança:
    * **CSRF Token:** Garante que as requisições sejam legítimas.
    * **SQL Injection:** Prevenido pelo uso de consultas parametrizadas com PDO.
    * **XSS:** Tratamento e escape de dados para evitar ataques.





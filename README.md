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

https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.40/xampp-windows-x64-5.6.40-1-VC11-installer.exe/download




## Utilização

O testador irá precisar fazer o download do XAMPP na versão 5.6.40 pelo link acima para testar a aplicação.
Depois da instalação, o arquivo cliente_api contendo os arquivos da aplicação precisam estar dentro da pasta htdocs que fica dentro da pasta do XAMPP para realizar o teste (A pasta dos arquivos do XAMPP vai estar a onde ele foi adicionado na instalação),também será preciso colocar a senha do banco de dados do testador no arquivo database.php. Assim que o arquivo da API estiver nesse local e alterado, o testador vai precisar também colocar a URL: http://localhost/cliente_api/ na barra de pesquisa do navegador para assim conseguir realizar o teste.




## Funcionamento

O sistema que foi criado serve para gerenciar cadastros de cliente, na página inicial é possível ver as os dados, nome, CPF, email, telefone, CEP, logradouro, número, complemento, bairro, cidade, UF de cada cliente cadastrado no sistema em formato de tabela, acima dessa tabela há um botão chamado Cadastrar Cliente que ao usuário clicar será aberto um formulário para o usuário digitar todas as informações do cliente para que ele seja cadastrado no site.
Ao lado dos dados de cada cliente na tabela da pagina inicial também terá um botão chamado Alterar Cliente que ao clicar será aberto um formulário para que usuário possa alterar os dados desejados do cliente e ao lado do botão Alterar Cliente na tela inicial também terá o botão Excluir que ao clicar o uma mensagem aparece na tela confirmando se o usuário deseja exclui o cliente e ao clicar no botão verde excluir o cliente é excluído do sistema.

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>

    <!-- Inclusão do jQuery via CDN para manipulação de DOM e requisições AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <!-- Inclusão do Bootstrap via CDN para estilização e componentes UI -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
         /* Estilos customizados para a página */
        body {
            background-color: #f8f9fa;  /* Cor de fundo da página */
        }
        .header {
            background-color: #800000;  /* Cor bordô do cabeçalho */
            color: white;  /* Cor do texto */
            padding: 15px;  /* Padding no cabeçalho */
            text-align: center;  /* Alinhamento centralizado do texto */
        }
        .btn-cadastrar {
            margin-bottom: 20px;  /* Margem inferior no botão de cadastro */
        }
        .modal-header {
            background-color: #800000;  /* Cor bordô no cabeçalho do modal */
            color: white;  /* Cor do texto no cabeçalho do modal */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gerenciamento de Clientes</h1>
    </div>

    <div class="container-fluid">
        <!-- Botão para abrir o modal de cadastro de cliente -->
        <button class="btn btn-success btn-cadastrar" data-toggle="modal" data-target="#modalCadastrar">Cadastrar Cliente</button>

        <!-- Tabela para exibir a lista de clientes -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>CEP</th>
                            <th>Logradouro</th>
                            <th>Número</th>
                            <th>Complemento</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Ações</th>  <!-- Ações como alterar ou excluir -->
                </tr>
            </thead>
            <tbody id="listaClientes">
                <!-- Os clientes serão adicionados dinamicamente aqui via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Aqui serão injetados os modais de alteração e exclusão dos clientes via JavaScript -->
    <div id="modal">

    </div>

    <!-- Modal para cadastrar cliente -->
    <div id="modalCadastrar" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Cadastrar Cliente</h4>
                </div>
                <div class="modal-body">

                    <!-- Formulário de cadastro de cliente -->
                    <form id="formCadastrar">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" id="logradouro" name="logradouro" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="uf">UF</label>
                            <input type="text" id="uf" name="uf" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- Botão de salvar cadastro, chama a função que envia o form via AJAX -->
                    <button type="button" class="btn btn-success" id="salvarCadastro">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusão de scripts necessários -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Inclusão do script AJAX que contém a lógica de manipulação da API -->
    <script src="app/public/ajax.js"></script>
</body>
</html>

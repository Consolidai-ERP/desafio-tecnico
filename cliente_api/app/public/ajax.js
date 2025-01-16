$(document).ready(function () {
    // Ao carregar a página, chama a função 'listarClientes' para carregar a lista de clientes
    listarClientes();
});

// Função para listar todos os clientes
function listarClientes() {
    $.ajax({
        url: 'http://localhost/cliente_api/app/public/index.php?acao=listar',  // URL da API para listar os clientes
        method: 'GET',  // Método HTTP GET
        dataType: 'json',  // Tipo de resposta esperada é JSON
        success: function (response) {  // Caso a requisição seja bem-sucedida
            const dados = response.dados;  // Armazena a lista de clientes retornada pela API
            let tabela = '';  // Variável para armazenar as linhas da tabela
            let modal = '';  // Variável para armazenar os modais de alteração e exclusão

            // Percorre cada cliente e cria as linhas da tabela e os modais correspondentes
            dados.forEach(function(cliente) {
                tabela += `
                    <tr>
                        <td>${cliente.id}</td>
                        <td>${cliente.nome}</td>
                        <td>${cliente.cpf}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefone}</td>
                        <td>${cliente.cep}</td>
                        <td>${cliente.logradouro}</td>
                        <td>${cliente.numero}</td>
                        <td>${cliente.complemento}</td>
                        <td>${cliente.bairro}</td>
                        <td>${cliente.cidade}</td>
                        <td>${cliente.uf}</td>
                        <td>
                            <button class="btn btn-primary" data-id="${cliente.id}" data-toggle="modal" data-target="#modalAlterar${cliente.id}">Alterar</button>
                            <button class="btn btn-danger btn-excluir" data-id="${cliente.id}" data-toggle="modal" data-target="#modalExcluir${cliente.id}">Excluir</button>
                        </td>
                    </tr>
                `;

                // Criação do modal de alteração de cliente
                modal +=  `
                    <!-- Modal para alterar cliente -->
                    <div id="modalAlterar${cliente.id}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Alterar Cliente</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="formAlterar-${cliente.id}">
                                        <input type="hidden" id="id-${cliente.id}" name="id" value="${cliente.id}">
                                        <div class="form-group">
                                            <label for="nome-${cliente.id}">Nome</label>
                                            <input type="text" id="nome-${cliente.id}" name="nome" class="form-control" value="${cliente.nome}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email-${cliente.id}">E-mail</label>
                                            <input type="email" id="email-${cliente.id}" name="email" class="form-control" value="${cliente.email}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf-${cliente.id}">CPF</label>
                                            <input type="text" id="cpf-${cliente.id}" name="cpf" class="form-control" value="${cliente.cpf}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cep-${cliente.id}">CEP</label>
                                            <input type="text" id="cep-${cliente.id}" name="cep" class="form-control" value="${cliente.cep}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="logradouro-${cliente.id}">Logradouro</label>
                                            <input type="text" id="logradouro-${cliente.id}" name="logradouro" class="form-control" value="${cliente.logradouro}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero-${cliente.id}">Número</label>
                                            <input type="text" id="numero-${cliente.id}" name="numero" class="form-control" value="${cliente.numero}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="complemento-${cliente.id}">Complemento</label>
                                            <input type="text" id="complemento-${cliente.id}" name="complemento" class="form-control" value="${cliente.complemento}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bairro-${cliente.id}">Bairro</label>
                                            <input type="text" id="bairro-${cliente.id}" name="bairro" class="form-control" value="${cliente.bairro}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cidade-${cliente.id}">Cidade</label>
                                            <input type="text" id="cidade-${cliente.id}" name="cidade" class="form-control" value="${cliente.cidade}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uf-${cliente.id}">UF</label>
                                            <input type="text" id="uf-${cliente.id}" name="uf" class="form-control" value="${cliente.uf}" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="salvarAlteracao(${cliente.id})">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para excluir cliente -->
                    <div id="modalExcluir${cliente.id}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Excluir Cliente</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza de que deseja excluir este cliente?</p>
                                    <input type="hidden" id="excluirId${cliente.id}" value="${cliente.id}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="confirmarExclusao(${cliente.id})">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `
                
                ;
            });

            // Atualiza o conteúdo da tabela e dos modais com os dados carregados
            $('#listaClientes').html(tabela);
            $('#modal').html(modal);
        },
        error: function () {
            // Caso ocorra erro ao tentar listar os clientes
            alert('Erro ao listar clientes. Verifique a API.');
        }
    });
}

// Função para cadastrar um novo cliente
$('#salvarCadastro').click(function () {
    const dados = {
        nome: $('#nome').val(),
        cpf: $('#cpf').val(),
        email: $('#email').val(),
        telefone: $('#telefone').val(),
        senha: $('#senha').val(),
        cep: $('#cep').val(),
        logradouro: $('#logradouro').val(),
        numero: $('#numero').val(),
        complemento: $('#complemento').val(),
        bairro: $('#bairro').val(),
        cidade: $('#cidade').val(),
        uf: $('#uf').val()
    };

    $.ajax({
        url: 'http://localhost/cliente_api/app/public/index.php?acao=criar',  // URL da API para criar o cliente
        method: 'POST',  // Método HTTP POST
        data: JSON.stringify(dados),  // Dados a serem enviados no corpo da requisição
        contentType: 'application/json',  // Tipo de conteúdo da requisição
        success: function () {  // Caso o cliente seja cadastrado com sucesso
            alert('Cliente cadastrado com sucesso!');
            window.location.reload();  // Recarrega a página para refletir a mudança
        },
        error: function (error) {  // Caso ocorra erro ao tentar cadastrar o cliente
            window.location.reload();  // Recarrega a página mesmo em caso de erro (pode ser ajustado para tratar erros específicos)
        }
    });
});

// Função para abrir o modal de alteração com os dados do cliente
$(document).on('click', '.btn-alterar', function () {
    const id = $(this).data('id');

    $.ajax({
        url: `http://localhost/cliente_api/app/public/index.php?acao=buscar&id=${id}`,   // URL da API para buscar os dados do cliente
        method: 'GET', // Método HTTP GET
        dataType: 'json', // Tipo de resposta esperado é JSON
        success: function (cliente) {  // Preenche os campos do formulário de alteração com os dados do cliente

            $('#formAlterar #Coloque\ o\ Id').val(cliente.id);
            $('#formAlterar #Digite\ o\ Nome').val(cliente.nome);
            $('#formAlterar #Digite\ o\ Email').val(cliente.email);
            $('#formAlterar #altera\ CPF').val(cliente.cpf);
            $('#formAlterar #alterar\ CEP').val(cliente.cep);
            $('#formAlterar #alterar\ Logradouro').val(cliente.logradouro);
            $('#formAlterar #alterar\ Numero').val(cliente.numero);
            $('#formAlterar #alterar\ Complemento').val(cliente.complemento);
            $('#formAlterar #alterar\ Bairro').val(cliente.bairro);
            $('#formAlterar #alterar\ Cidade').val(cliente.cidade);
            $('#formAlterar #alterar\ UF').val(cliente.uf);
        },
        error: function () {  // Caso ocorra erro ao buscar os dados
            alert('Erro ao buscar dados do cliente.');
        }
    });
});

// Função para salvar alterações do cliente
function salvarAlteracao(id){
    // Capturar os dados do formulário dinâmico com base no ID do cliente
    const dados = {
        id: $(`#id-${id}`).val(),
        nome: $(`#nome-${id}`).val(),
        email: $(`#email-${id}`).val(),
        cpf: $(`#cpf-${id}`).val(),
        cep: $(`#cep-${id}`).val(),
        logradouro: $(`#logradouro-${id}`).val(),
        numero: $(`#numero-${id}`).val(),
        complemento: $(`#complemento-${id}`).val(),
        bairro: $(`#bairro-${id}`).val(),
        cidade: $(`#cidade-${id}`).val(),
        uf: $(`#uf-${id}`).val()
    };

    $.ajax({
        url: 'http://localhost/cliente_api/app/public/index.php?acao=alterar',  // URL da API para alterar os dados do cliente
        method: 'POST',  // Método HTTP POST
        data: JSON.stringify(dados),  // Dados a serem enviados
        contentType: 'application/json',  // Tipo de conteúdo da requisição
        success: function (response) {  // Caso a alteração seja bem-sucedida
            alert('Cliente alterado com sucesso!');
            window.location.reload();  // Recarrega a página para refletir a mudança
        },
        error: function (error) {  
            // Caso ocorra erro ao alterar o cliente
            alert('Erro ao alterar cliente. Verifique os dados e tente novamente.' + error);
        }
    });
}

// Função para excluir cliente
function confirmarExclusao(id){
    const dados = {
        id: $('#excluirId'+id).val()  // Captura o ID do cliente a ser excluído
    };

    $.ajax({
        url: `http://localhost/cliente_api/app/public/index.php?acao=excluir`,  // URL da API para excluir o cliente
        method: 'POST',  // Método HTTP POST
        data: JSON.stringify(dados),  // Dados a serem enviados
        contentType: 'application/json',  // Tipo de conteúdo da requisição
        success: function () {  // Caso o cliente seja excluído com sucesso
            alert('Cliente excluído com sucesso!');
            window.location.reload();  // Recarrega a página para refletir a exclusão
        },
        error: function (error) {
             // Caso ocorra erro ao excluir o cliente
            alert('Erro ao excluir cliente.' + error);
        }
    });
}




// Preencher ID no modal de exclusão (ao clicar no botão "Excluir")
$(document).on('click', '.btn-excluir', function () {
    const id = $(this).data('id');
    $('#excluirId').val(id);  // Preenche o campo escondido com o ID do cliente a ser excluído
});

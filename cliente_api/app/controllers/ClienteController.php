<?php
// Inclusão do arquivo que contém a definição do modelo Cliente
require_once __DIR__ . '/../controllers/models/Cliente.php';

class ClienteController {
    private $clienteModel;  // Instância do modelo Cliente

     /**
     * Construtor da classe ClienteController.
     * Cria uma instância do modelo Cliente para manipular os dados do cliente.
     */

    public function __construct() {
        // Criação de uma instância do modelo Cliente
        $this->clienteModel = new Cliente();
    }

     /**
     * Método para listar todos os clientes.
     * 
     * Retorna os dados dos clientes em formato JSON.
     */

    // Listar clientes
    public function listar() {
        try {
            // Chama o método listar() do modelo Cliente e recupera os dados
            $clientes = $this->clienteModel->listar();
            // Retorna os dados em formato JSON com status de sucesso
            echo json_encode(['status' => 'sucesso', 'dados' => $clientes]);
        } catch (Exception $e) {
            // Caso ocorra algum erro, retorna a mensagem de erro
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao listar clientes: ' . $e->getMessage()]);
        }
    }

     /**
     * Método para criar um novo cliente.
     * 
     * Recebe os dados do cliente em formato JSON e os valida.
     * Retorna uma resposta JSON com o status da operação.
     */

    // Criar um novo cliente
    public function criar() {
        try {
            // Recupera os dados enviados no corpo da requisição
            $dados = json_decode(file_get_contents("php://input"), true);

            // Validação básica dos dados obrigatórios
            if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha'])) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Nome, e-mail e senha são obrigatórios.']);
                return;
            }

            // Chama o método criar() do modelo Cliente para inserir os dados
            if ($this->clienteModel->criar($dados)) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Cliente criado com sucesso.']);
            } else {
                // Caso haja erro ao criar o cliente
                echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao criar cliente.']);
            }
        } catch (Exception $e) {
            // Caso ocorra algum erro durante o processamento da solicitação
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao processar solicitação: ' . $e->getMessage()]);
        }
    }

     /**
     * Método para alterar os dados de um cliente existente.
     * 
     * Recebe os dados do cliente em formato JSON, incluindo o ID para identificar o cliente.
     * Retorna uma resposta JSON com o status da operação.
     */

    // Alterar cliente
    public function alterar() {
        try {
            // Recupera os dados enviados no corpo da requisição
            $dados = json_decode(file_get_contents("php://input"), true);
            $id = isset($dados['id']) ? $dados['id'] : null;

            // Validação básica dos dados obrigatórios
            if (!$id || empty($dados['nome']) || empty($dados['email'])) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'ID, nome e e-mail são obrigatórios.']);
                return;
            }

            // Chama o método alterar() do modelo Cliente para atualizar os dados
            if ($this->clienteModel->alterar($id, $dados)) {
                // Caso a alteração seja bem-sucedida
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Cliente atualizado com sucesso.']);
            } else {
                // Caso haja erro para a alteração
                echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao atualizar cliente.']);
            }
        } catch (Exception $e) {
            // Caso ocorra algum erro durante o processamento da solicitação
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao processar solicitação: ' . $e->getMessage()]);
        }
    }

     /**
     * Método para excluir um cliente.
     * 
     * Recebe o ID do cliente a ser excluído e retorna uma resposta JSON com o status da operação.
     */

    // Excluir cliente
    public function excluir() {
        try {
            // Recupera os dados enviados no corpo da requisição
            $dados = json_decode(file_get_contents("php://input"), true);

             // Verifica se o ID foi fornecido
            $id = isset($dados['id']) ? $dados['id'] : null;

            if (!$id) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'ID é obrigatório para exclusão.']);
                return;
            }

            // Chama o método excluir() do modelo Cliente para remover o cliente
            if ($this->clienteModel->excluir($id)) {
                // Caso o cliente seja excluído com sucesso
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Cliente excluído com sucesso.']);
            } else {
                // Caso haja erro na exclusão
                echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao excluir cliente.']);
            }
        } catch (Exception $e) {
            // Caso ocorra algum erro durante o processamento da solicitação
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao processar solicitação: ' . $e->getMessage()]);
        }
    }
}
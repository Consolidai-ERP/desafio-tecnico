<?php
// Requer o arquivo do controlador de cliente
require_once __DIR__ . '/../controllers/ClienteController.php';

// Configurações de cabeçalhos para permitir o acesso da API de diferentes origens (CORS)
// Define o tipo de conteúdo como JSON para comunicação entre cliente e servidor
header("Access-Control-Allow-Origin: *");  // Permite acesso de qualquer origem
header("Content-Type: application/json; charset=UTF-8");  // Define o tipo de conteúdo da resposta como JSON
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");  // Permite os métodos HTTP POST, GET, PUT e DELETE
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");  // Permite os cabeçalhos especificados


// Instancia o controlador de clientes
$clienteController = new ClienteController();

// Obtém a URI da requisição (caminho da URL)
$rota = $_SERVER['REQUEST_URI'];

// Obtém o método HTTP da requisição (GET, POST, PUT, DELETE)
$metodoHttp = $_SERVER['REQUEST_METHOD'];

// Obtém a ação (caso haja) da URL, como 'listar', 'criar', 'alterar', 'excluir'
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;


// Roteamento básico da aplicação (determina qual ação será executada com base na URL e no método HTTP)
switch ($metodoHttp) {
    // Caso o método seja GET
    case 'GET':
        // Se a ação for listar, chama o método 'listar' do controlador
        if ($acao === 'listar') {
            $clienteController->listar();
        } else {
            // Se a ação não for válida, retorna um erro
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida para GET.']);
        }
        break;

    // Caso o método seja POST
    case 'POST':
        // Se a ação for criar, chama o método 'criar' do controlador
        if ($acao === 'criar') {
            $clienteController->criar();

        // Se a ação for alterar, chama o método 'alterar' do controlador
        } elseif ($acao === 'alterar') {
            $clienteController->alterar();

            // Se a ação for excluir, chama o método 'excluir' do controlador
        } elseif ($acao === 'excluir') {
            $clienteController->excluir();
        } else {
            // Se a ação não for válida, retorna um erro
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida para POST.']);
        }
        break;

    // Caso o método HTTP não seja suportado
    default:
        // Retorna um erro indicando que o método não é suportado
        echo json_encode(['status' => 'erro', 'mensagem' => 'Método HTTP não suportado.']);
        break;
}
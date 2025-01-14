<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Client;

class ClienteController extends Controller
{

    public function index()
    {
        $this->view('home', ['activePage' => 'home',]);
    }

    public function cadastro()
    {
        $this->view('cliente_cadastro', ['activePage' => 'cliente',]);
    }

    public function edita($id)
    {
        $clienteModel = new Client();
        $cliente = $clienteModel->getById($id);

        if ($cliente) {
            $this->view('cliente_edita', ['activePage' => 'cliente', 'cliente' => $cliente]);
        } else {
            $this->view('home');
        }
    }

    /**
     * Metódo responsável por inserir um cliente no bando de dados
     * @param void
     * @return json
     */
    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Middleware::veriry_csrf($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $data = array(
                    'success' => false,
                    'message' => "Houve um erro inesperado, por favor tente novamente"
                );
                echo json_encode($data);
                return;
            }


            $campos = [
                'nome',
                'email',
                'endereco',
                'cep',
                'numero',
                'complemento',
                'tipo_pessoa',
                'cpf_cnpj'
            ];

            /* Verifica se existe algum campo vazio */
            foreach ($campos as $campo) {
                if (isset($_POST[$campo]) && !empty($_POST[$campo])) {
                    /* Escapa string e salva na variável */
                    $$campo = htmlspecialchars($_POST[$campo], ENT_QUOTES);
                } else {
                    $$campo = null;
                }
            }

            $cpf_cnpj = preg_replace('/\D/', '', $cpf_cnpj);

            $data = [
                'nome' => $nome,
                'email' => $email,
                'endereco' => $endereco,
                'cep' => $cep,
                'numero' => $numero,
                'complemento' => $complemento,
                'tipo_pessoa' => $tipo_pessoa,
                'cpf_cnpj' => $cpf_cnpj
            ];

            $clienteModel = new Client();

            /* Válida se o cliente já foi cadastrado pelo CPF*/
            $cliente = $clienteModel->getByCpfCnpj($cpf_cnpj);

            if ($cliente) {
                $data = array(
                    'success' => false,
                    'message' => "Já existe um cliente com esse CPF ou CNPJ"
                );
                echo json_encode($data);
                return;
            }

            /* Válida se o cliente já foi cadastrado pelo email*/
            $cliente = $clienteModel->getByEmail($email);

            if ($cliente) {
                $data = array(
                    'success' => false,
                    'message' => "Já existe um cliente com esse email"
                );
                echo json_encode($data);
                return;
            }

            /* Cadastra o cliente */
            $result = $clienteModel->insert($data);

            if ($result) {
                $data = array(
                    'success' => true,
                    'message' => 'Cadastro realizado com sucesso'
                );
                echo json_encode($data);
                return;
            }

            $data = array(
                'success' => false,
                'message' => 'Houve um problema ao cadastrar o cliente!'
            );

            echo json_encode($data);
            return;
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Middleware::veriry_csrf($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $data = array(
                    'success' => false,
                    'message' => "Houve um erro inesperado, por favor tente novamente"
                );
                echo json_encode($data);
                return;
            }

            $campos = [
                'id',
                'nome',
                'email',
                'endereco',
                'cep',
                'numero',
                'complemento',
                'tipo_pessoa',
                'cpf_cnpj'
            ];

            /* Verifica se existe algum campo vazio */
            foreach ($campos as $campo) {
                if (isset($_POST[$campo]) && !empty($_POST[$campo])) {
                    /* Escapa string e salva na variável */
                    $$campo = htmlspecialchars($_POST[$campo], ENT_QUOTES);
                } else {
                    $$campo = null;
                }
            }

            $cpf_cnpj = preg_replace('/\D/', '', $cpf_cnpj);

            $clienteModel = new Client();

            /* Válida se o cliente já foi cadastrado pelo CPF*/
            $cliente = $clienteModel->getByCpfCnpj($cpf_cnpj);

            if ($cliente && $cliente['id'] != $id) {
                $data = array(
                    'success' => false,
                    'message' => "Já existe um cliente com esse CPF ou CNPJ"
                );
                echo json_encode($data);
                return;
            }

            /* Válida se o cliente já foi cadastrado pelo email*/
            $cliente = $clienteModel->getByEmail($email);

            if ($cliente && $cliente['id'] != $id) {
                $data = array(
                    'success' => false,
                    'message' => "Já existe um cliente com esse email"
                );
                echo json_encode($data);
                return;
            }

            $data = [
                'nome' => $nome,
                'email' => $email,
                'endereco' => $endereco,
                'cep' => $cep,
                'numero' => $numero,
                'complemento' => $complemento,
                'tipo_pessoa' => $tipo_pessoa,
                'cpf_cnpj' => $cpf_cnpj
            ];

            /* Atualiza o cliente */
            $result = $clienteModel->update($id, $data);

            if ($result) {
                $data = array(
                    'success' => true,
                    'message' => 'Atualização realizada com sucesso'
                );
                echo json_encode($data);
                return;
            }

            $data = array(
                'success' => false,
                'message' => 'Houve um problema ao atualizar o cliente!'
            );

            echo json_encode($data);
            return;
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Middleware::veriry_csrf($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $data = array(
                    'success' => false,
                    'message' => "Houve um erro inesperado, por favor tente novamente"
                );
                echo json_encode($data);
                return;
            }

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                /* Escapa string e salva na variável */
                $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            } else {
                $data = array(
                    'success' => false,
                    'message' => "Houve um erro ao excluir."
                );
                echo json_encode($data);
                return;
            }

            $clienteModel = new Client();

            $result = $clienteModel->delete($id);

            if ($result) {
                $data = array(
                    'success' => true,
                    'message' => 'exclusão realizada com sucesso'
                );
                echo json_encode($data);
                return;
            }

            $data = array(
                'success' => false,
                'message' => 'Houve um problema ao excluir o cliente!'
            );

            echo json_encode($data);
            return;
        }
    }
}

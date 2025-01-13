<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Client;

class ClienteController extends Controller
{
    public function cadastro()
    {
        $this->view('cliente_cadastro', ['activePage' => 'cliente',]);
    }

    /**
     * Metódo responsável por inserir um cliente no bando de dados
     * @param void
     * @return json
     */
    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $data = array(
                    'success' => false,
                    'message' => "Houve um erro inesperado, por favor tente novamente"
                );
                echo json_encode($data);
                return;
            }

            $campos = ['nome_cad', 'email_cad', 'cpf_cnpj', 'empresa_cad'];

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
}

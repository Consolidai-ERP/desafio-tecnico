<?php

namespace App\Models;

use App\Core\Database;

class Client
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Metódo responsável por buscar todos os clientes
     */
    public function getAllClients()
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE 1");
        $stmt->execute([]);
        return $stmt->fetchAll();
    }
    
    /**
     * Metódo responsável por buscar um cliente pelo email
     */
    public function getByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Metódo responsável por buscar um cliente pelo cpf ou cnpj
     */
    public function getByCpfCnpj($cpf_cnpj)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE cpf_cnpj = ?");
        $stmt->execute([$cpf_cnpj]);
        return $stmt->fetch();
    }

    /**
     * Metódo responsável por inserir um cliente
     */
    public function insert($data)
    {
        $nome = $data['nome'];
        $email = $data['email'];
        $endereco = $data['endereco'];  
        $cep = $data['cep'];
        $numero = $data['numero'];
        $complemento = $data['complemento'];
        $tipo_pessoa = $data['tipo_pessoa'];
        $cpf_cnpj = $data['cpf_cnpj'];
        $data_cadastro = date('Y-m-d H:i:s');

        $sql = "INSERT INTO clientes (nome, email, endereco, cep, numero, complemento, tipo_pessoa, cpf_cnpj, data_cadastro) VALUES (:nome, :email, :endereco, :cep, :numero, :complemento, :tipo_pessoa, :cpf_cnpj, :data_cadastro)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':tipo_pessoa', $tipo_pessoa);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt->bindParam(':data_cadastro', $data_cadastro);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

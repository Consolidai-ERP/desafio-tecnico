<?php
// Classe responsável por gerenciar a conexão com o banco de dados.
class Database {

    // Definições de conexão ao banco de dados
    private $host = "localhost";
    private $db_name = "clientes";
    private $username = "root";
    private $password = " "; //senha do banco dadaos
    public $conn;

     /**
     * Método para estabelecer e retornar a conexão com o banco de dados.
     * 
     * @return PDO $conn A conexão com o banco de dados.
     */

    public function getConnection() {
        $this->conn = null; // Inicializa a variável $conn como null para garantir que não haja uma conexão anterior.

        try {

            // Criação da conexão utilizando PDO (PHP Data Objects), fornecendo o host, nome do banco e credenciais.
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            // Configuração para gerar exceções em caso de erro de SQL.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Erro na conexão: " . $exception->getMessage());
            // Caso ocorra erro, é exibida a mensagem de erro e o processo é interrompido.
        }

        // Retorna a instância de conexão com o banco de dados.
        return $this->conn;
    }
}
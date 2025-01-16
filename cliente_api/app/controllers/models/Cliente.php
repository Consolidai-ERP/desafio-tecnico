<?php
// Inclusão do arquivo de configuração do banco de dados para estabelecer a conexão
require_once __DIR__ . '/../../config/database.php';

class Cliente {
    private $conn;  // Variável para armazenar a conexão com o banco de dados
    private $table_name = "clientes";  // Nome da tabela do banco de dados que será utilizada pela classe

    
    //Construtor da classe Cliente. Estabelece a conexão com o banco de dados.
    

    public function __construct() {
        // Criação de uma instância da classe Database e obtenção da conexão
        $database = new Database();
        $this->conn = $database->getConnection();
    }

     /**
     * Método para listar todos os clientes cadastrados.
     * 
     * @return array Array de clientes em formato associativo.
     */

    public function listar() {
        // Consulta SQL para selecionar todos os campos dos clientes
        $query = "SELECT id, nome, cpf, email, telefone, cep, logradouro, numero, complemento, bairro, cidade, uf FROM " . $this->table_name;
        // Preparação da query SQL
        $stmt = $this->conn->prepare($query);
        // Execução da query
        $stmt->execute();
        // Retorno dos dados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * Método para criar um novo cliente no banco de dados.
     * 
     * @param array $dados Dados do cliente a ser inserido (nome, cpf, email, etc.).
     * @return bool Retorna true se a operação for bem-sucedida, ou false caso contrário.
     */

    public function criar($dados) {
         // Consulta SQL para inserir um novo cliente na tabela
        $query = "INSERT INTO " . $this->table_name . " (nome, cpf, email, telefone, senha_hash, cep, logradouro, numero, complemento, bairro, cidade, uf) VALUES (:nome, :cpf, :email, :telefone, :senha_hash, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :uf)";
        // Preparação da query SQL
        $stmt = $this->conn->prepare($query);

        // Vinculação dos parâmetros da query com os dados fornecidos
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':cpf', $dados['cpf']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        $stmt->bindParam(':senha_hash', password_hash($dados['senha'], PASSWORD_BCRYPT));
        $stmt->bindParam(':cep', $dados['cep']);
        $stmt->bindParam(':logradouro', $dados['logradouro']);
        $stmt->bindParam(':numero', $dados['numero']);
        $stmt->bindParam(':complemento', $dados['complemento']);
        $stmt->bindParam(':bairro', $dados['bairro']);
        $stmt->bindParam(':cidade', $dados['cidade']);
        $stmt->bindParam(':uf', $dados['uf']);



        // Execução da query e retorno do resultado
        return $stmt->execute();
    }

     /**
     * Método para alterar os dados de um cliente.
     * 
     * @param int $id O ID do cliente que será alterado.
     * @param array $dados Dados que irão substituir os dados antigos do cliente.
     * @return bool|array Retorna true se a operação for bem-sucedida, ou um array de erro em caso de falha.
     */

    public function alterar($id, $dados) {
         // Consulta SQL para atualizar os dados de um cliente específico
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, cpf = :cpf, email = :email, 
        telefone = :telefone,  cep = :cep, logradouro = :logradouro, numero = :numero, 
        complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id = :id";
        // Preparação da query SQL
        $stmt = $this->conn->prepare($query);

        // Vinculação dos parâmetros com os dados a serem alterados
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':cpf', $dados['cpf']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        $stmt->bindParam(':cep', $dados['cep']);
        $stmt->bindParam(':logradouro', $dados['logradouro']);
        $stmt->bindParam(':numero', $dados['numero']);
        $stmt->bindParam(':complemento', $dados['complemento']);
        $stmt->bindParam(':bairro', $dados['bairro']);
        $stmt->bindParam(':cidade', $dados['cidade']);
        $stmt->bindParam(':uf', $dados['uf']);

        // Execução da query e verificação de sucesso
        if ($stmt->execute()) {
            return true;
        } else {
            // Caso ocorra erro, retorna os detalhes do erro
            $error = $stmt->errorInfo();
            return [
                'error' => true,
                'code' => $error[0],   
                'driver_code' => $error[1], 
                'message' => $error[2] 
            ];
        }
    }

     /**
     * Método para excluir um cliente do banco de dados.
     * 
     * @param int $id O ID do cliente a ser excluído.
     * @return bool Retorna true se a operação for bem-sucedida, ou false caso contrário.
     */

    public function excluir($id) {
        // Consulta SQL para excluir um cliente com o ID especificado
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        // Preparação da query SQL
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
         // Execução da query e retorno do resultado
        return $stmt->execute();
    }
}
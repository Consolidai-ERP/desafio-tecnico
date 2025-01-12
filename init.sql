CREATE DATABASE IF NOT EXISTS testdb;

USE testdb;

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(15) NULL,
    endereco TEXT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserção de dados iniciais
INSERT INTO clientes (nome, email, telefone, endereco) VALUES
('João da Silva', 'joao@gmail.com', '(11) 98765-4321', 'Rua A, 123'),
('Maria Oliveira', 'maria@gmail.com', '(21) 99876-5432', 'Rua B, 456');

CREATE DATABASE IF NOT EXISTS teste_consolidai;

USE teste_consolidai;

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    endereco TEXT NULL,
    cep VARCHAR(100) NOT NULL,
    numero VARCHAR(100) NOT NULL,
    complemento VARCHAR(100) NOT NULL,
    tipo_pessoa VARCHAR(100) NOT NULL,
    cpf_cnpj VARCHAR(100) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserção de dados iniciais
INSERT INTO clientes (nome, email, endereco, cep, numero, complemento, tipo_pessoa, cpf_cnpj) VALUES
('Lucas Duarte', 'lucas@gmail.com', 'Rua B - antonio narcisio', '39405121', '123', 'A', 'fisica', '166.732.900-64'),
('Larissa Duarte', 'larissa@gmail.com', 'Rua B - antonio narcisio', '39405121', '123', 'A', 'fisica', '558.015.920-08');


CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome, email, password) VALUES
('Lucas Duarte', 'teste@gmail.com.br', '$2y$10$lz4tE/2FNiZWiIKOrfTe4.D1km1tEC4rU4OgZzjfVmSXTBHENjI62');
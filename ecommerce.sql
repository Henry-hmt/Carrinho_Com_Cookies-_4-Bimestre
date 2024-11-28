CREATE DATABASE ecommerce;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    email VARCHAR(40) UNIQUE,
    senha VARCHAR(50)
);


CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT,
    preco DECIMAL(10, 2)
);

INSERT INTO usuarios (email, senha) 
VALUES ('admin@gmail', MD5('123'));

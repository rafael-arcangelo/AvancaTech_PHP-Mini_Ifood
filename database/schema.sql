CREATE DATABASE mini_ifood;
USE mini_ifood;

CREATE TABLE usuario (
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_pessoa VARCHAR(100) NOT NULL,
    nome_restaurante VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    imagem_restaurante VARCHAR(250)
) ENGINE=InnoDB;

CREATE TABLE produto (
	id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(250) NOT NULL,
    descricao TEXT,
    categoria ENUM ('entrada', 'principal', 'bebida', 'sobremesa', 'combo') NOT NULL DEFAULT 'principal',
    preco DECIMAL(10,2) NOT NULL,
    disponibilidade TINYINT NOT NULL DEFAULT 1,
    imagem_produto VARCHAR(255) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;

SELECT * FROM usuario;
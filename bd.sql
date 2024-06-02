-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS mercado;

-- Usa o banco de dados criado
USE mercado;

-- Cria a tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

-- Cria a tabela categoria
CREATE TABLE IF NOT EXISTS categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

-- Cria a tabela mercadoria
CREATE TABLE IF NOT EXISTS mercadoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

-- Cria a tabela log
CREATE TABLE IF NOT EXISTS log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tabela VARCHAR(50) NOT NULL,
    operacao VARCHAR(50) NOT NULL,
    dados TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação dos gatilhos (triggers) para registrar as operações no log
DELIMITER //

CREATE TRIGGER after_insert_usuarios
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('usuarios', 'INSERT', CONCAT('id: ', NEW.id, ', nome: ', NEW.nome, ', email: ', NEW.email));
END //

CREATE TRIGGER after_update_usuarios
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('usuarios', 'UPDATE', CONCAT('id: ', NEW.id, ', nome: ', NEW.nome, ', email: ', NEW.email));
END //

CREATE TRIGGER after_delete_usuarios
AFTER DELETE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('usuarios', 'DELETE', CONCAT('id: ', OLD.id, ', nome: ', OLD.nome, ', email: ', OLD.email));
END //

CREATE TRIGGER after_insert_mercadoria
AFTER INSERT ON mercadoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('mercadoria', 'INSERT', CONCAT('id: ', NEW.id, ', nome: ', NEW.nome, ', quantidade: ', NEW.quantidade, ', categoria_id: ', NEW.categoria_id));
END //

CREATE TRIGGER after_update_mercadoria
AFTER UPDATE ON mercadoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('mercadoria', 'UPDATE', CONCAT('id: ', NEW.id, ', nome: ', NEW.nome, ', quantidade: ', NEW.quantidade, ', categoria_id: ', NEW.categoria_id));
END //

CREATE TRIGGER after_delete_mercadoria
AFTER DELETE ON mercadoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('mercadoria', 'DELETE', CONCAT('id: ', OLD.id, ', nome: ', OLD.nome, ', quantidade: ', OLD.quantidade, ', categoria_id: ', OLD.categoria_id));
END //

CREATE TRIGGER after_insert_categoria
AFTER INSERT ON categoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('categoria', 'INSERT', CONCAT('id: ', NEW.id, ', tipo: ', NEW.tipo));
END //

CREATE TRIGGER after_update_categoria
AFTER UPDATE ON categoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('categoria', 'UPDATE', CONCAT('id: ', NEW.id, ', tipo: ', NEW.tipo));
END //

CREATE TRIGGER after_delete_categoria
AFTER DELETE ON categoria
FOR EACH ROW
BEGIN
    INSERT INTO log (tabela, operacao, dados) VALUES ('categoria', 'DELETE', CONCAT('id: ', OLD.id, ', tipo: ', OLD.tipo));
END //

DELIMITER ;

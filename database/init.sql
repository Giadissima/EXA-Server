DROP DATABASE IF EXISTS exa_shop;
CREATE DATABASE exa_shop;
USE exa_shop;

DROP TABLE IF EXISTS microcontrollore;
DROP TABLE IF EXISTS catalogo;
DROP TABLE IF EXISTS n_catalogo;
DROP TABLE IF EXISTS utente;
DROP TABLE IF EXISTS credenziali;
DROP TABLE IF EXISTS comune;
DROP TABLE IF EXISTS provincia;
DROP TABLE IF EXISTS paese;
DROP TABLE IF EXISTS indirizzo;
DROP TABLE IF EXISTS acquisto;

CREATE TABLE microcontrollore(
    id INT PRIMARY KEY AUTO_INCREMENT,
    prezzo_scontato DECIMAL(20, 2),
    comunicazione VARCHAR(45) NOT NULL,
    RAM INT NOT NULL,
    autonomia INT NOT NULL,
    prezzo DECIMAL(20,2) NOT NULL,
    modello VARCHAR(45) NOT NULL UNIQUE,
    CPU DECIMAL(20,2) NOT NULL,
    descrizione VARCHAR(45) NOT NULL
);

CREATE TABLE catalogo(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    visibile TINYINT(1) NOT NULL
);

CREATE TABLE utente(
    id INT PRIMARY KEY AUTO_INCREMENT,
    mail VARCHAR(45) NOT NULL UNIQUE,
    num_telefono NUMERIC(10),
    -- S = super admin, C = client, A = administrator
    tipo VARCHAR(1) NOT NULL
);

CREATE TABLE comune(
    id INT PRIMARY KEY AUTO_INCREMENT,
    cap VARCHAR(10) NOT NULL
);

CREATE TABLE provincia(
    id INT PRIMARY KEY AUTO_INCREMENT,
    sigla VARCHAR(45) NOT NULL,
    nome VARCHAR(45) NOT NULL
);

CREATE TABLE paese(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL
);

CREATE TABLE n_catalogo(
    id INT PRIMARY KEY AUTO_INCREMENT,
    microcontrollore INT NOT NULL,
    id_catalogo INT NOT NULL,
    
    FOREIGN KEY(microcontrollore)
    REFERENCES microcontrollore(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION,
    
    FOREIGN KEY(id_catalogo)
    REFERENCES catalogo(id)
    on delete CASCADE on update NO ACTION
);

CREATE TABLE credenziali(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(45) NOT NULL UNIQUE,
    password VARCHAR(128) NOT NULL,
    salt VARCHAR(60) NOT NULL,
    
    FOREIGN KEY(id)
    REFERENCES utente(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION
);

CREATE TABLE indirizzo(
    id INT PRIMARY KEY AUTO_INCREMENT,
    n_civico INT NOT NULL,
    via VARCHAR(60) NOT NULL,
    comune INT NOT NULL,
    provincia INT NOT NULL,
    paese INT NOT NULL,
    utente INT NOT NULL,
    
    FOREIGN KEY(comune)
    REFERENCES comune(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION,

    FOREIGN KEY(provincia)
    REFERENCES provincia(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION,

    FOREIGN KEY(paese)
    REFERENCES paese(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION,

    FOREIGN KEY(utente)
    REFERENCES utente(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION
);

CREATE TABLE acquisto(
    id INT PRIMARY KEY AUTO_INCREMENT,
    data DATE NOT NULL,
    microcontrollore INT NOT NULL,
    utente INT NOT NULL,
    
    FOREIGN KEY(microcontrollore)
    REFERENCES microcontrollore(id)
    -- cascade = la cancellazione della tupla riflette sulla chiave esterna
    -- restrict = impedisce la modifica della tupla nella tabella padre
    on delete CASCADE on update NO ACTION,
    
    FOREIGN KEY(utente)
    REFERENCES utente(id)
    on delete CASCADE on update NO ACTION
);


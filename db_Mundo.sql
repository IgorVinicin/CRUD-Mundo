create DATABASE bd_MUNDO;
USE bd_MUNDO;

CREATE TABLE Paises (
    id_pais INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    continente VARCHAR(50) NOT NULL,
    populacao BIGINT NOT NULL,
    idioma VARCHAR(50) NOT NULL
);

CREATE TABLE Cidades (
    id_cidade INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    populacao BIGINT NOT NULL,
    id_pais INT NOT NULL,
    FOREIGN KEY (id_pais) REFERENCES Paises(id_pais)
);
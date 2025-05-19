CREATE DATABASE IF NOT EXISTS el_tablon_digital;
USE el_tablon_digital;

CREATE TABLE Tipo_Anuncio (
    id INT PRIMARY KEY,
    nombre_tipo_anuncio VARCHAR(150)
);

CREATE TABLE Categorias (
    id INT PRIMARY KEY,
    nombre_categoria VARCHAR(150)
);

CREATE TABLE Provincia (
    id INT PRIMARY KEY,
    nombre_provincia VARCHAR(200)
);

CREATE TABLE Localidades (
    id INT PRIMARY KEY,
    nome_localidades VARCHAR(250),
    id_provincia INT,
    codigo_postal BIGINT,
    FOREIGN KEY (id_provincia) REFERENCES Provincia(id)
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY,
    nombre_usuario VARCHAR(100) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(250),
    fecha_creacion DATE,
    fecha_modificacion DATE,
    borrado BOOLEAN DEFAULT FALSE
);

CREATE TABLE Particular (
    id INT PRIMARY KEY,
    dni VARCHAR(20),
    FOREIGN KEY (id) REFERENCES Usuario(id)
);

CREATE TABLE Empresa (
    id INT PRIMARY KEY,
    cif VARCHAR(20),
    nombre_comercial VARCHAR(100),
    url_web VARCHAR(100),
    FOREIGN KEY (id) REFERENCES Usuario(id)
);

CREATE TABLE Anuncio (
    id INT PRIMARY KEY,
    id_usuario INT,
    titulo VARCHAR(200),
    descripcion VARCHAR(255),
    contenido TEXT,
    id_tipo_anuncio INT,
    fecha_creacion DATE,
    fecha_modificacion DATE,
    id_localidad INT,
    imagen_url VARCHAR(255),
    borrado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    FOREIGN KEY (id_tipo_anuncio) REFERENCES Tipo_Anuncio(id),
    FOREIGN KEY (id_localidad) REFERENCES Localidades(id)
);

CREATE TABLE Anuncio_Categorias (
    id_anuncio INT,
    id_categoria INT,
    PRIMARY KEY (id_anuncio, id_categoria),
    FOREIGN KEY (id_anuncio) REFERENCES Anuncio(id),
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id)
);

CREATE TABLE Rol (
    id INT PRIMARY KEY,
    nombre_rol VARCHAR(50) UNIQUE
);

CREATE TABLE Usuario_Rol (
    id_usuario INT,
    id_rol INT,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    FOREIGN KEY (id_rol) REFERENCES Rol(id)
);

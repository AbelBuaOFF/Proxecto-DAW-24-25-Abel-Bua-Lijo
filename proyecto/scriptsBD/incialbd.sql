CREATE TABLE Tipo_Usuario (
    id INT PRIMARY KEY,
    nombre_tipo_usuario VARCHAR(100)
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY,
    nombre_usuario VARCHAR(100),
    email VARCHAR(50),
    password VARCHAR(250),
    id_tipo_usuario INT,
    FOREIGN KEY (id_tipo_usuario) REFERENCES Tipo_Usuario(id)
);

CREATE TABLE Tipo_Anuncio (
    id INT PRIMARY KEY,
    nombre_tipo_anuncio VARCHAR(150)
);

CREATE TABLE Provincia (
    id INT PRIMARY KEY,
    nombre_provincia VARCHAR(200)
);

CREATE TABLE Localizacion (
    id INT PRIMARY KEY,
    nome_localizacion VARCHAR(250),
    id_provincia INT,
    codigo_postal BIGINT,
    FOREIGN KEY (id_provincia) REFERENCES Provincia(id)
);

CREATE TABLE Anuncio (
    id INT PRIMARY KEY,
    id_usuario INT,
    titulo VARCHAR(200),
    descripcion TEXT,
    id_tipo_anuncio INT,
    fecha_publicacion DATE,
    id_localizacion INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    FOREIGN KEY (id_tipo_anuncio) REFERENCES Tipo_Anuncio(id),
    FOREIGN KEY (id_localizacion) REFERENCES Localizacion(id)
);

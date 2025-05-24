CREATE DATABASE IF NOT EXISTS el_tablon_digital;
USE el_tablon_digital;

CREATE TABLE Rol (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_rol VARCHAR(50) UNIQUE
);


CREATE TABLE Tipo_Anuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tipo_anuncio VARCHAR(150)
);

CREATE TABLE Categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(150)
);

CREATE TABLE Provincia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_provincia VARCHAR(200)
);

CREATE TABLE Localidades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_localidades VARCHAR(250),
    id_provincia INT,
    codigo_postal BIGINT,
    FOREIGN KEY (id_provincia) REFERENCES Provincia(id) ON DELETE RESTRICT ON UPDATE CASCADE;  
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(100) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(250) NOT NULL,
    borrado BOOLEAN DEFAULT FALSE,
    id_rol INT DEFAULT 2,
    FOREIGN KEY (id_rol) REFERENCES Rol(id) ON DELETE RESTRICT ON UPDATE CASCADE;  
);

CREATE TABLE Particular (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Usuario(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Empresa (
    id INT PRIMARY KEY,
    nombre_comercial VARCHAR(100),
    url_web VARCHAR(100),
    FOREIGN KEY (id) REFERENCES Usuario(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Anuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    titulo VARCHAR(200),
    descripcion VARCHAR(255),
    contenido TEXT,
    id_tipo_anuncio INT,
    id_categoria INT,
    fecha_creacion DATE,
    fecha_modificacion DATE,
    id_localidad INT,
    imagen_url VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tipo_anuncio) REFERENCES Tipo_Anuncio(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_localidad) REFERENCES Localidades(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

/*    Datos Ejemplo      */

-- Insertar Roles
INSERT INTO Rol (id, nombre_rol) VALUES
(1, 'Admin'),
(2, 'Usuario');

-- Insertar Usuarios con roles asignados
INSERT INTO Usuario (nombre_usuario, email, password, fecha_creacion, fecha_modificacion, borrado, id_rol) VALUES
('carlos_acoruna', 'carlos.acoruna@example.com', 'hashedpassword1', '2025-05-01', '2025-05-01', FALSE, 1),
('ana_vigo', 'ana.vigo@example.com', 'hashedpassword2', '2025-05-02', '2025-05-02', FALSE, 2);

-- Insertar Particulares (usuario 1)
INSERT INTO Particular (id) VALUES
(1);

-- Insertar Empresas (usuario 2)
INSERT INTO Empresa (id, nombre_comercial, url_web) VALUES
(2, 'Servicios Vigo SL', 'https://serviciosvigo.gal');

-- Insertar Tipos de Anuncio
INSERT INTO Tipo_Anuncio (id, nombre_tipo_anuncio) VALUES
(1, 'Venta'),
(2, 'Compra'),
(3, 'Alquiler');

-- Insertar Categorías
INSERT INTO Categorias (id, nombre_categoria) VALUES
(1, 'Vehículos'),
(2, 'Electrónica'),
(3, 'Inmuebles');

-- Insertar Provincias de Galicia
INSERT INTO Provincia (id, nombre_provincia) VALUES
(1, 'A Coruña'),
(2, 'Lugo'),
(3, 'Ourense'),
(4, 'Pontevedra');

-- Insertar Localidades de Galicia
INSERT INTO Localidades (id, nome_localidades, id_provincia, codigo_postal) VALUES
(1, 'A Coruña', 1, 15001),
(2, 'Santiago de Compostela', 1, 15701),
(3, 'Lugo', 2, 27001),
(4, 'Monforte de Lemos', 2, 27400),
(5, 'Ourense', 3, 32001),
(6, 'Verín', 3, 32600),
(7, 'Pontevedra', 4, 36001),
(8, 'Vigo', 4, 36200);

-- Insertar Anuncios
INSERT INTO Anuncio (id_usuario, titulo, descripcion, contenido, id_tipo_anuncio, id_categoria, fecha_creacion, fecha_modificacion, id_localidad, imagen_url) VALUES
(1, 'Venta de furgoneta en A Coruña', 'Furgoneta en buen estado, lista para trabajar', 'Furgoneta Ford Transit 2018, 80.000 km, ITV al día', 1, 1, '2025-05-20', '2025-05-20', 1, 'img/furgoneta.jpg'),
(2, 'Busco piso en Vigo', 'Piso céntrico y bien comunicado', 'Busco piso de 3 habitaciones en Vigo, zona centro', 2, 3, '2025-05-21', '2025-05-21', 8, 'img/piso_vigo.jpg');

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

CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(150)
);

CREATE TABLE Provincia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_provincia VARCHAR(200)
);

CREATE TABLE Localidad (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_localidad VARCHAR(250),
    id_provincia INT,
    codigo_postal BIGINT,
    FOREIGN KEY (id_provincia) REFERENCES Provincia(id) ON DELETE RESTRICT ON UPDATE CASCADE 
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(100) UNIQUE,
    email VARCHAR(50) UNIQUE,
    passw VARCHAR(250) NOT NULL,
    borrado BOOLEAN DEFAULT FALSE,
    id_rol INT DEFAULT 2,
    tipo_usuario ENUM('particular', 'empresa') DEFAULT 'particular',
    nombre_comercial VARCHAR(100),
    url_web VARCHAR(100),
    fecha_creacion TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES Rol(id) ON DELETE RESTRICT ON UPDATE CASCADE  
);

CREATE TABLE Anuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    contenido TEXT,
    id_tipo_anuncio INT,
    id_categoria INT,
    fecha_creacion TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_localidad INT,
    imagen_url VARCHAR(255) DEFAULT '/pagina/uploads/anuncio/anuncio_default.jpg',
    borrado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tipo_anuncio) REFERENCES Tipo_Anuncio(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_localidad) REFERENCES Localidad(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE AuthToken (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    fecha_creacion TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_expiracion DATETIME NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id) ON DELETE CASCADE ON UPDATE CASCADE
);

/*    Datos Ejemplo      */

-- Insertar Roles
INSERT INTO Rol (nombre_rol) VALUES
('Admin'),
('Usuario');

-- Insertar Tipos de Anuncio
INSERT INTO Tipo_Anuncio (nombre_tipo_anuncio) VALUES
('Anuncio'),
('Aviso'),
('Información'),
('Evento');

-- Insertar Categorías
INSERT INTO Categoria (nombre_categoria) VALUES
('Vehículos'),
('Inmuebles'),
('Empleo'),
('Servicios'),
('Fiestas'),
('Local');

-- Insertar Provincias
INSERT INTO Provincia (nombre_provincia) VALUES
('A Coruña'),
('Lugo'),
('Ourense'),
('Pontevedra');

-- Insertar Localidades
INSERT INTO Localidad (nombre_localidad, id_provincia, codigo_postal) VALUES
('A Coruña', 1, 15001),
('Santiago de Compostela', 1, 15701),
('Lugo', 2, 27001),
('Monforte de Lemos', 2, 27400),
('Ourense', 3, 32001),
('Verín', 3, 32600),
('Pontevedra', 4, 36001),
('Vigo', 4, 36200);

-- Insertar Usuarios
-- administrador
INSERT INTO Usuario (nombre_usuario, email, passw, id_rol)
VALUES ('administrador','admin@mail.com','f2e53c927c66fe711e8e88ef9b37a8e3187f1652216b313fc8eb2513883dd360', 1);
-- Insertar usuario particular
INSERT INTO Usuario (nombre_usuario, email, passw, tipo_usuario)
VALUES ('particular', 'particular@mail.com', 'f2e53c927c66fe711e8e88ef9b37a8e3187f1652216b313fc8eb2513883dd360', 'particular');

-- Insertar usuario empresa
INSERT INTO Usuario (nombre_usuario, email, passw, tipo_usuario, nombre_comercial, url_web)
VALUES ('empresa', 'empresa@mail.com', 'f2e53c927c66fe711e8e88ef9b37a8e3187f1652216b313fc8eb2513883dd360', 'empresa', 'Empresa prueba SL', 'empresa.com');

-- Insertar Anuncios
INSERT INTO Anuncio (id_usuario, titulo, descripcion, contenido, id_tipo_anuncio, id_categoria, id_localidad,imagen_url) VALUES
(2, 'Venta de furgoneta en A Coruña', 'Furgoneta en buen estado, lista para trabajar', 'Furgoneta Ford Transit 2018, 80.000 km, ITV al día', 1, 1, 1,'/pagina/uploads/anuncio/furgoneta.jpg'),
(2, 'Alquila piso en Vigo', 'Piso céntrico y bien comunicado', 'Alquila piso de 3 habitaciones en Vigo, zona centro', 2, 3, 8,'/pagina/uploads/anuncio/piso_vigo.jpg'),
(2, 'Evento de música en vivo', 'Concierto gratuito en el parque', 'Ven a disfrutar de una tarde de música en vivo con bandas locales', 4, 5, 7,'/pagina/uploads/anuncio/musica.jpg'),
(3, 'Se alquila local comercial en Santiago', 'Local en pleno centro, ideal para negocio', 'Local de 100 m² con escaparate, zona de paso', 1, 6, 2,'/pagina/uploads/anuncio/anuncio_default.jpg'),
(2, 'Perro perdido en Ourense', 'Se busca perro labrador negro', 'Responde al nombre de Max, se perdió el 10 de junio en el Parque San Lázaro. Recompensa.', 2, 6, 5,'/pagina/uploads/anuncio/perro.jpg'),
(2, 'Gato extraviado en Lugo', 'Gato blanco y gris visto por última vez cerca del campus', 'Tiene chip y es muy manso. Contacto: 600123456.', 2, 6, 3,'/pagina/uploads/anuncio/anuncio_default.jpg'),
(3, 'Fiestas de San Juan en A Coruña', 'Gran celebración en la playa del Orzán', 'Hogueras, conciertos y fuegos artificiales el 23 de junio desde las 20:00.', 4, 5, 1,'/pagina/uploads/anuncio/anuncio_default.jpg'),
(3, 'Feria del pulpo en Monforte', 'Evento gastronómico', 'Ven a degustar el mejor pulpo á feira, con música tradicional y actividades para niños.', 4, 5, 4,'/pagina/uploads/anuncio/anuncio_default.jpg'),
(3, 'Fiestas de San Juan en A Coruña', 'Gran celebración en la playa del Orzán', 'Hogueras, conciertos y fuegos artificiales el 23 de junio desde las 20:00.', 4, 5, 1,'/pagina/uploads/anuncio/anuncio_default.jpg'),
(3, 'Feria del pulpo en Monforte', 'Evento gastronómico', 'Ven a degustar el mejor pulpo á feira, con música tradicional y actividades para niños.', 4, 5, 4,'/pagina/uploads/anuncio/anuncio_default.jpg');



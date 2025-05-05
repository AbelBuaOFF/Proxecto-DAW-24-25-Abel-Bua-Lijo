INSERT INTO Provincia (id, nombre_provincia) VALUES
(1, 'A Coruña'),
(2, 'Lugo'),
(3, 'Ourense'),
(4, 'Pontevedra');

INSERT INTO Localizacion (id, nome_localizacion, id_provincia, codigo_postal) VALUES
-- A Coruña
(1, 'Santiago de Compostela', 1, 15701),
(2, 'A Coruña', 1, 15001),
(3, 'Ferrol', 1, 15401),

-- Lugo
(4, 'Lugo', 2, 27001),
(5, 'Monforte de Lemos', 2, 27400),
(6, 'Vilalba', 2, 27800),

-- Ourense
(7, 'Ourense', 3, 32001),
(8, 'Verín', 3, 32600),
(9, 'O Barco de Valdeorras', 3, 32300),

-- Pontevedra
(10, 'Vigo', 4, 36201),
(11, 'Pontevedra', 4, 36001),
(12, 'Vilagarcía de Arousa', 4, 36600);

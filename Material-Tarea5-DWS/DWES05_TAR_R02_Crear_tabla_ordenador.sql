-- Seleccionamos la base de datos
USE tarea5;

-- Creamos la estructura de la tabla `ordenador`
CREATE TABLE IF NOT EXISTS `ordenador` (
  `cod` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `procesador` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RAM` int(11) NOT NULL COMMENT 'En GB',
  `disco` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Indicar numero, tecnologi­a y capacidad',
  `grafica` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `unidadoptica` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `SO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `otros` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Insertamos los datos en la tabla `ordenador`
INSERT INTO `ordenador` (`cod`, `procesador`, `RAM`, `disco`, `grafica`, `unidadoptica`, `SO`, `otros`) VALUES
('ACERAX3950', 'Intel Core i5-650', 4, '1 disco SATA2 1TB', 'Nvidia GT320 1GB', 'DVD+-R DL 16x', 'Windows 7 Home Premium', NULL),
('PBELLI810323', 'Intel Core i3-550', 4, '1 disco SATA2 640GB', 'Nvidia G210M D3 512MB', 'DVD+-R DL', 'Windows 7 Home Premium', 'Equpo integrado con pantalla táctil 16:9 HD 23"');

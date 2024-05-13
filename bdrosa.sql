-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 10:13:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdrosa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE `lector` (
  `DNI` varchar(9) NOT NULL,
  `NOMBRE_LECTOR` varchar(255) NOT NULL,
  `APELLIDO_LECTOR` varchar(255) NOT NULL,
  `CONTRASENIA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lector`
--

INSERT INTO `lector` (`DNI`, `NOMBRE_LECTOR`, `APELLIDO_LECTOR`, `CONTRASENIA`) VALUES
('11111111A', 'Enric', 'Diez', 'E567D739AE47EB4F9D8020CACD10142BF7C8D2462C0BA75E06CC0CB0328A6B18'),
('22222222B', 'Adelina', 'Diaz', 'DF0511CC4EA3EB8A0A01421934B98AB90D8281CAB7142F5CD002173DD9B131FC'),
('33333333C', 'Alfonso', 'Arranz', 'C7E52D8590EAED2BC3558EACD21B5ED7D1AC0770507440F8BC2748308090BC77'),
('44444444D', 'Elena', 'Cobo', '0CE93C9606F0685BF60E051265891D256381F639D05C0AEC67C84EEC49D33CC1'),
('55555555E', 'Luis', 'Matas', 'C5FF177A86E82441F93E3772DA700D5F6838157FA1BFDC0BB689D7F7E55E7ABA'),
('66666666F', 'Araceli', 'Gaspar', 'A33D016C98C22BF5FCE2FBF6E9BC1B69D75B15AC9473206677685770FFC6D73C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `CODIGO_LIBRO` int(11) NOT NULL,
  `NOMBRE_LIBRO` varchar(255) NOT NULL,
  `GENERO` varchar(255) NOT NULL,
  `AUTOR` varchar(255) NOT NULL,
  `EDITORIAL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`CODIGO_LIBRO`, `NOMBRE_LIBRO`, `GENERO`, `AUTOR`, `EDITORIAL`) VALUES
(146, 'La casa de Bernarda Alba', 'Teatro', 'Federico Garcia Lorca', 'Planeta'),
(235, 'Cometas en el cielo', 'Drama', 'Khaled Hosseini', 'Booket'),
(353, 'La casa de las sombras', 'Terror', 'Adam Nevill', 'Edebe'),
(382, '1984', 'Novela', 'George Orwell', 'Debolsillo'),
(469, 'Cien años de soledad', 'Novela', 'Gabriel Garcia Marquez', 'Debolsillo'),
(857, 'El color de las cosas invisibles', 'Juvenil', 'Andrea Longarela', 'SM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `DNI_LECTOR` varchar(9) NOT NULL,
  `COD_LIBRO` int(11) NOT NULL,
  `VALORACION` int(11) NOT NULL,
  `OPINION` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`DNI_LECTOR`, `COD_LIBRO`, `VALORACION`, `OPINION`) VALUES
('11111111A', 382, 7, 'Buena novela de ciencia ficcion para pasar el rato'),
('44444444D', 353, 8, 'De las pocas novelas que hacen referencia a su género'),
('55555555E', 146, 8, 'Uno de los mejores teatros conocidos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lector`
--
ALTER TABLE `lector`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`CODIGO_LIBRO`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`DNI_LECTOR`,`COD_LIBRO`),
  ADD KEY `FK_VALORACION_LIBRO` (`COD_LIBRO`),
  ADD KEY `FK_VALORACION_LECTOR` (`DNI_LECTOR`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `FK_VALORACION_LECTOR` FOREIGN KEY (`DNI_LECTOR`) REFERENCES `lector` (`DNI`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_VALORACION_LIBRO` FOREIGN KEY (`COD_LIBRO`) REFERENCES `libro` (`CODIGO_LIBRO`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

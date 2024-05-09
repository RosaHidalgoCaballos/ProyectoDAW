-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2024 a las 10:44:18
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

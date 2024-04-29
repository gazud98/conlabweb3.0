-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2023 a las 16:24:14
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
-- Base de datos: `u116753122_cw3completa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regimen_fiscal_config`
--

CREATE TABLE `regimen_fiscal_config` (
  `idreg` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regimen_fiscal_config`
--

INSERT INTO `regimen_fiscal_config` (`idreg`, `descripcion`) VALUES
(2, 'Gran Contribuyente'),
(3, 'Régimen Común');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `regimen_fiscal_config`
--
ALTER TABLE `regimen_fiscal_config`
  ADD PRIMARY KEY (`idreg`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `regimen_fiscal_config`
--
ALTER TABLE `regimen_fiscal_config`
  MODIFY `idreg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2023 a las 16:23:50
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
-- Estructura de tabla para la tabla `codigo_contable`
--

CREATE TABLE `codigo_contable` (
  `idcod` int(11) NOT NULL,
  `codigo_info` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valor_uvt` decimal(11,2) DEFAULT NULL,
  `base_uvt` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codigo_contable`
--

INSERT INTO `codigo_contable` (`idcod`, `codigo_info`, `descripcion`, `valor_uvt`, `base_uvt`) VALUES
(1, 23654004, 'compras', 42412.00, 27),
(2, 23652501, 'servicios', 42412.00, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigo_contable`
--
ALTER TABLE `codigo_contable`
  ADD PRIMARY KEY (`idcod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigo_contable`
--
ALTER TABLE `codigo_contable`
  MODIFY `idcod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

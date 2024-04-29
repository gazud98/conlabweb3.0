-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2023 a las 16:23:05
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
-- Estructura de tabla para la tabla `config_impuestos`
--

CREATE TABLE `config_impuestos` (
  `id_config_imp` int(11) NOT NULL,
  `codigo_cuenta` int(11) NOT NULL,
  `valor_uvt_config` decimal(11,2) DEFAULT NULL,
  `base_pesos` decimal(11,2) DEFAULT NULL,
  `porcentaje_uvt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `config_impuestos`
--

INSERT INTO `config_impuestos` (`id_config_imp`, `codigo_cuenta`, `valor_uvt_config`, `base_pesos`, `porcentaje_uvt`) VALUES
(1, 23654004, 42412.00, 1145124.00, 2),
(4, 23652501, 42412.00, 169648.00, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config_impuestos`
--
ALTER TABLE `config_impuestos`
  ADD PRIMARY KEY (`id_config_imp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config_impuestos`
--
ALTER TABLE `config_impuestos`
  MODIFY `id_config_imp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

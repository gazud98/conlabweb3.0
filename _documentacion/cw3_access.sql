-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2023 a las 18:20:10
-- Versión del servidor: 10.6.10-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cw3_access`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprise`
--

CREATE TABLE `enterprise` (
  `id_enterprise` int(11) NOT NULL COMMENT 'cdg empresa que adquiere cw3',
  `prefix` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'prefijo que usa como bd propia',
  `token` varchar(245) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='empresa que adquiere cw3';

--
-- Volcado de datos para la tabla `enterprise`
--

INSERT INTO `enterprise` (`id_enterprise`, `prefix`, `token`) VALUES
(1, 'cw3', '898432f40e1e56218f2ddcd552bd190e'),
(2, 'pasteurlab', '745231383561b1ee2a5eb84ca9c3a913'),
(3, 'desarrollo', 'acbf157754bc921e70ab30b1e79c75f5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id_enterprise`),
  ADD UNIQUE KEY `entrerprise_UN` (`prefix`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `id_enterprise` int(11) NOT NULL AUTO_INCREMENT COMMENT 'cdg empresa que adquiere cw3', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

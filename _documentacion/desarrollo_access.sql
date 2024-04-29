-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2023 a las 18:20:29
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
-- Base de datos: `desarrollo_access`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripción` varchar(245) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargos`, `nombre`, `descripción`, `estado`) VALUES
(1, 'bacteriologa', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `estado`) VALUES
(1, 'Alergias', 1),
(2, 'Aseo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direcciones` int(11) NOT NULL,
  `direccion` varchar(245) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL COMMENT '0 vivienda\n1 oficina\n3 otros',
  `tipo` tinyint(4) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleados` int(11) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `tarjeta_profecional` varchar(245) DEFAULT NULL,
  `email_empresarial` varchar(245) DEFAULT NULL COMMENT 'Sede del empleado cargada por defecto',
  `id_sede` int(11) DEFAULT NULL COMMENT 'SEDE DEFAULT',
  `id_persona` int(11) DEFAULT NULL,
  `id_cargos` int(11) DEFAULT NULL,
  `detalle_cargo` varchar(145) DEFAULT NULL,
  `descripcion_cargo` varchar(245) DEFAULT NULL,
  `tarjeta_profesional` varchar(45) DEFAULT NULL,
  `empresa_temporal` varchar(45) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_estado_empleado` int(11) DEFAULT NULL,
  `id_cw2_empleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleados`, `fecha_ingreso`, `fecha_retiro`, `nombre_empleado`, `tarjeta_profecional`, `email_empresarial`, `id_sede`, `id_persona`, `id_cargos`, `detalle_cargo`, `descripcion_cargo`, `tarjeta_profesional`, `empresa_temporal`, `estado`, `id_estado_empleado`, `id_cw2_empleados`) VALUES
(461, '2022-11-16', NULL, 'Erbin Antonio Santana Rios', NULL, 'prueba@pasteurlab.com', 1, 464, 1, NULL, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `externos`
--

CREATE TABLE `externos` (
  `id_externos` int(11) NOT NULL,
  `id_empresas` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupomodulos`
--

CREATE TABLE `grupomodulos` (
  `id_grupomodulos` int(11) NOT NULL,
  `name` varchar(145) DEFAULT NULL,
  `identificacion` varchar(145) DEFAULT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `icono` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `url` varchar(245) DEFAULT NULL,
  `id_submodulos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_campos`
--

CREATE TABLE `grupo_campos` (
  `id_grupo_campos` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `descripcion` varchar(145) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `id_grupomodulos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_personal`
--

CREATE TABLE `info_personal` (
  `id_info_personal` int(11) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG cities_id',
  `expedicion_documento` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG cities_id',
  `fecha_expedicion` date DEFAULT NULL,
  `id_tipo_estado_civil` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG id_tipo_estado_civil',
  `estrato` varchar(45) DEFAULT NULL,
  `id_tipo_sangre` varchar(45) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG tipo_sangre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inf_enterprise`
--

CREATE TABLE `inf_enterprise` (
  `id_enterprise` int(11) NOT NULL,
  `id_tipo_identificacion` int(11) DEFAULT NULL,
  `identificacion` bigint(20) DEFAULT NULL,
  `cv` int(11) DEFAULT NULL,
  `razon_social` varchar(245) DEFAULT NULL,
  `nombre_comercial` varchar(245) DEFAULT NULL,
  `abreviatura` varchar(45) DEFAULT NULL,
  `id_representante_legal` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web` varchar(245) DEFAULT NULL,
  `id_enterprise_cw` int(11) DEFAULT NULL COMMENT 'CW3_ACCESS id_enterprise',
  `estado` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `inf_enterprise`
--

INSERT INTO `inf_enterprise` (`id_enterprise`, `id_tipo_identificacion`, `identificacion`, `cv`, `razon_social`, `nombre_comercial`, `abreviatura`, `id_representante_legal`, `id_ubicacion`, `email`, `web`, `id_enterprise_cw`, `estado`) VALUES
(1, 1, 900484448, NULL, 'Laboratorios Pasteur SAS', 'Pasteurlab', 'PLAB', NULL, 1, 'contacto@pasteurlab.com', 'pasteurlab.com', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8mb3_bin NOT NULL,
  `login` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulos` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `url` varchar(245) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulos`, `name`, `identificacion`, `descripcion`, `icono`, `estado`, `url`, `orden`) VALUES
(1, 'Cartera', 'cartera', '', 'fa fa-microchip', 0, '', 0),
(6, 'Recepción', 'recepcion', '', 'fa fa-microchip', 0, '', 0),
(7, 'Settings', 'mantenimiento', '', 'fa fa-microchip', 0, NULL, 0),
(8, 'Consumos', 'consumos', 'Sistemas de costos', 'fa fa-microchip', 1, NULL, 1),
(9, 'Costos', 'costos', 'Módulos de costos', 'fa fa-microchip', 1, NULL, 2),
(15, 'Comercial', 'comercial', '', 'fa fa-microchip', 0, '', 0),
(16, 'Control de Ingreso', 'ctrlingreso', '', 'fa fa-microchip', 0, '', 0),
(17, 'Crm', 'crm', '', 'fa fa-microchip', 0, '', 0),
(18, 'Facturación', 'facturacion', '', 'fa fa-microchip', 0, '', 0),
(19, 'Laboratorio', 'laboratorio', '', 'fa fa-microchip', 0, '', 0),
(20, 'Sistemas', 'sistemas', '', 'fa fa-microchip', 0, '', 0),
(22, 'Wikilab', 'wikilab', '', 'fa fa-microchip', 0, '', 0),
(23, 'Manejo de Muestras', 'manejomuestra', '', 'fa fa-microchip', 0, '', 0),
(24, 'Compras e Inventario', 'comprainventario', '', 'fa fa-microchip', 1, '', 0),
(25, 'Prueba', 'test1', 'Modulo de Prueba', 'fa fa-microchip', 0, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `id_tipo_identificacion` int(11) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `nombre_1` varchar(100) DEFAULT NULL,
  `nombre_2` varchar(100) DEFAULT NULL,
  `apellido_1` varchar(100) DEFAULT NULL,
  `apellido_2` varchar(100) DEFAULT NULL,
  `id_tipo_genero` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_cw2_empleados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `id_tipo_identificacion`, `documento`, `nombre_1`, `nombre_2`, `apellido_1`, `apellido_2`, `id_tipo_genero`, `id_ubicacion`, `id_users`, `id_cw2_empleados`) VALUES
(464, 1, '1048214251', 'jesus', 'alberto', 'ariza', 'reyes', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id_profiles` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos_cargos`
--

CREATE TABLE `requisitos_cargos` (
  `id_requisitos_cargo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos_cargos_has_cargos`
--

CREATE TABLE `requisitos_cargos_has_cargos` (
  `requisitos_cargos_id_requisitos_cargo` int(11) NOT NULL,
  `cargos_id_cargos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_empresa`
--

CREATE TABLE `seccion_empresa` (
  `id_seccion_empresa` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `seccion_empresa`
--

INSERT INTO `seccion_empresa` (`id_seccion_empresa`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrativa                                                                                      ', '', 1),
(2, 'Operativa                                                                                           ', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sedes` int(11) NOT NULL,
  `name` varchar(245) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sedes`, `name`, `estado`) VALUES
(1, 'Principal ctg', 1),
(2, 'Centro ', 1),
(3, 'Villa carolina', 1),
(4, 'Villa campestre', 1),
(5, 'La castellana', 2),
(6, 'Centro medico allianz', 1),
(7, 'Liga de lucha contra el cancer', 1),
(8, 'Principal baq', 1),
(9, 'Clientes externos', 1),
(10, 'Elite ', 1),
(11, 'Soledad / principal sold', 1),
(12, 'Principal smt ', 1),
(13, 'Elite santa marta', 1),
(14, 'Rodadero santa marta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos`
--

CREATE TABLE `submodulos` (
  `id_submodulos` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `id_modulos` int(11) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `icono` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `url` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `submodulos`
--

INSERT INTO `submodulos` (`id_submodulos`, `idpadre`, `name`, `id_modulos`, `identificacion`, `descripcion`, `icono`, `estado`, `url`, `orden`) VALUES
(22, 0, 'Mantenimiento Recepcion', 6, 'mto_recepcion', '', 'fa fa-plus', 0, '?c=recepcion&a=mto_recepcion', 0),
(24, 0, 'Mantenimiento', 1, 'mto_cartera', NULL, 'fa fa-plus', 0, '?c=cartera&a=mto_cartera', 0),
(25, 53, 'Consunos', 8, 'consumos', NULL, 'far fa-circle nav-icon\r\n', 1, '?c=consumos', 3),
(27, 0, 'Mantenimiento', 15, 'mto_comercial', NULL, 'fa fa-plus', 0, '?c=comercial&a=mto_comercial', 0),
(28, 0, 'Mantenimiento', 24, 'mto_compra_inventario', NULL, 'fa fa-plus', 0, '?c=compra_inventario&a=mto_compra_inventario', 0),
(29, 0, 'Mantenimiento', 9, 'mto_costos', '', 'fa fa-plus', 0, '?c=costos&a=mto_costos', 0),
(30, 0, 'Mantenimiento', 8, 'mto_consumos', '', 'fa fa-plus', 0, '?c=consumos&a=mto_consumos', 0),
(31, 0, 'MTO CORE', 7, 'mto_core', '', 'fa fa-cogs', 0, '?c=app&a=mto_core', 0),
(32, 0, 'USUARIOS', 7, 'users', '', 'fa fa-users', 0, '?c=app&a=users', 0),
(43, 0, 'Mantenimiento canal informacion', 6, '2', '', 'fa fa-plus', 0, '?c=default&prg=canal_informacion', 0),
(44, 52, 'Identificacion Oficial', 8, 'consumo_idtofc', 'identifiacion oficial de la empresa', 'fa fa-plus', 1, '?c=default&prg=idtfofc', 1),
(45, 52, 'Departamentos', 8, 'Departamentos', 'Departamentos de la Empresa', 'fa fa-plus', 1, '?c=default&prg=dptos', 2),
(46, 52, 'Proveedores', 8, 'proveedor', 'Proveedores disponibles', 'fa fa-plus', 1, '?c=default&prg=proveedor', 3),
(48, 52, 'Reactivos', 8, 'proveedorx', 'Proveedores disponibles', 'fa fa-plus', 1, '?c=default&prg=reactivos', 4),
(49, 52, 'Asignacion de Reactivos a Pruebas', 8, 'Asigreactivo', 'Asignacion de Reactivos a Pruebas', 'fa fa-plus', 1, '?c=default&prg=reactivoprueba', 5),
(50, 52, 'Empleados', 8, 'empleados', 'Manejo de Empleados', 'fa fa-plus', 0, '?c=default&prg=csumo50', 6),
(51, 52, 'Estuches', 8, 'estuchex', 'Manejo de Estuches', 'fa fa-plus', 1, '?c=default&prg=estuches', 7),
(52, 52, 'Datos Iniciales', 8, 'datinix', 'Datos Iniciales', 'fa fa-plus', 1, '', 1),
(53, 53, 'Manejo de Estuches', 8, 'manesrtuche', 'Manejo de Estuches', 'fa fa-plus', 1, '', 2),
(54, 54, 'Reportes', 8, 'reportesx', 'reportes de Consumos', 'fa fa-plus', 0, '', 3),
(56, 54, 'Ingreso de Datos', 8, 'ingresodatos', 'Manejo de Estuches', 'fa fa-plus', 1, '?c=default&prg=ingresodatos', 2),
(58, 58, 'Datos Iniciales', 9, 'dtadici', '', 'fa fa-plus', 1, '', 1),
(60, 58, 'Identifiacion Oficial', 8, 'datinix2', 'Datos Iniciales', 'fa fa-plus', 1, '?c=default&prg=idtfofc', 1),
(61, 58, 'Departamentos', 9, 'datinix23', 'Mantenimieno', 'fa fa-plus', 1, '?c=default&prg=dptos', 1),
(63, 58, 'Proveedores', 9, 'datinix231', 'Proveedores disponibles', 'fa fa-plus', 1, '?c=default&prg=proveedor', 1),
(65, 58, 'Reactivos', 8, 'proveedorx2', 'Proveedores disponibles', 'fa fa-plus', 1, '?c=default&prg=reactivos', 4),
(66, 58, 'Empleados', 9, 'empleadosx2', 'Manejo de Empleados', 'fa fa-plus', 0, '?c=default&prg=csumo50', 6),
(67, 58, 'Costos Indirectos', 9, 'costoindirecto', 'Manejo de Empleados', 'fa fa-plus', 1, '?c=default&prg=costosindirectos', 7),
(68, 68, 'Mantenimiento', 9, 'mtdo', '', 'fa fa-plus', 1, '', 2),
(69, 69, 'Procesos', 9, 'procsos', '', 'fa fa-plus', 1, '', 3),
(71, 68, 'Valor Costo Indirecto', 9, 'mtdo1\r\n', '', 'fa fa-plus', 1, '?c=default&prg=costos', 1),
(72, 68, 'Gastos Fijos', 9, 'mtdo2', '', 'fa fa-plus', 1, '?c=default&prg=gastosfijos', 2),
(73, 68, 'Valor Mano de Obra', 9, 'mtdo3', '', 'fa fa-plus', 1, '?c=default&prg=manoobra', 3),
(74, 68, 'Asignación de Pruebas a Empleados', 9, 'mtdo4', '', 'fa fa-plus', 1, '?c=default&prg=pruebaempleado', 4),
(76, 68, 'Asignación de Reactivos a Pruebas', 9, 'mtdo5', '', 'fa fa-plus', 1, '?c=default&prg=reactivoprueba', 5),
(77, 69, 'Costo por pruebas', 9, 'procsos1', '', 'fa fa-money-check', 1, '?c=costos', 1),
(79, 82, 'Unidad de Medida', 24, 'unidad_medida', 'Unidad de Medida', 'fa fa-plus', 1, '?c=default&prg=unidadmedida', 1),
(80, 52, 'Sedes', 8, 'sedes', 'Mantenimiento de sedes', 'fa fa-plus', 1, '?c=default&prg=sedes', 1),
(82, 82, 'Datos Iniciales', 24, 'pruebax', 'Datos Iniciales', 'fa fa-plus', 1, '', 1),
(84, 82, 'Unidad de Empaque', 24, 'unidad_empaque', 'Unidad de Empaque', 'fa fa-plus', 1, '?c=default&prg=unidadempaque', 1),
(85, 86, 'Producto', 24, 'producto', 'producto', 'fa fa-plus', 1, '?c=default&prg=producto', 3),
(86, 86, 'Procesos', 24, 'pruebaxprc', 'Datos Iniciales', 'fa fa-plus', 1, '', 1),
(87, 86, 'Ingreso de Producto', 24, 'productoing', 'producto', 'fa fa-plus', 1, '?c=default&prg=productos', 2),
(90, 86, 'Reactivos', 24, 'reactivos', 'Reactivos', 'fa fa-plus', 1, '?c=default&prg=reactivos', 4),
(91, 86, 'Proveedores', 24, 'provecores', 'Proveedores disponibles', 'fa fa-plus', 1, '?c=default&prg=proveedor', 1),
(92, 86, 'Activos Fijos', 24, 'Activos_Fijos', 'producto Activos_Fijos', 'fa fa-plus', 1, '?c=default&prg=actfijo', 5),
(93, 93, 'Bodega', 24, 'bodegaje', 'producto', 'fa fa-plus', 1, '', 2),
(94, 93, 'Bodega', 24, 'bodega', 'productoga', 'fa fa-plus', 1, '?c=default&prg=bodega', 1),
(95, 93, 'Productos en Bodegas', 24, 'bodegaprod', 'productoga', 'fa fa-plus', 1, '?c=default&prg=prdbodega', 2),
(96, 82, 'Creacion de Actividades', 24, 'creaactividad', 'Creacion de Actividades', 'fa fa-plus', 1, '?c=default&prg=creaactividad', 1),
(97, 86, 'Escoger Proveedor', 24, 'selprovproductos', 'selprovproductos', 'fa fa-plus', 1, '?c=default&prg=selprovproductos', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `id_telefonos` int(11) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `extencion` varchar(45) DEFAULT NULL,
  `tipo_telefono` tinyint(4) DEFAULT NULL COMMENT '0 telefono fijo\n1 telefono celular\n2 fax\n3 whatsaap\n4 telegrand\n5 otro',
  `id_ubicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubicacion` int(11) NOT NULL,
  `cities_id` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG cities_id',
  `barrio` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubicacion`, `cities_id`, `barrio`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT '1000-01-01 00:00:00',
  `new_email` varchar(100) COLLATE utf8mb3_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8mb3_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `created` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_enterprise` int(11) DEFAULT NULL,
  `id_cw2_empleados` int(11) NOT NULL,
  `sede_default` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `id_enterprise`, `id_cw2_empleados`, `sede_default`) VALUES
(1, 'jesus', '$2y$10$QUge2HPH0Ae6Bz4oRya02Ou6noDwdA04sAme4srfZUt6mmhfvy/5e', 'jesusalbertoariza@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2023-01-14 03:19:22', 1, 0, 1),
(403, 'i.morales', '$2y$10$O6R4WA37bfMqMphw2Dt6Z.fctCkd50xEDvwnPSTs9eri4Ik6cclSa', 'ibis@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-12-10 06:42:10', 1, 0, 1),
(404, 'e.cortez', '$2y$10$UCyYfhD.JQyeqz0OqMEfb.5Mr0zpCK49aOGhUO5ZKJaSQ1Jea5Mcy', 'elkin@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-10-20 04:47:02', 1, 0, 1),
(405, 'eorj', '$2y$10$.99RBIScv6BFoyDgwB1rAO0dsEBivD2loLckOigdQOfqbVXpkDGg.', 'erestrepojaner@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2023-03-15 02:32:46', 1, 0, 1),
(406, 'm.vidal', '$2y$10$Uz/iubcezErgvajw2Z0CoueidkdgtO/NibQ9c8SFy46Tca52ByRSu', 'erestrepojaner@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-12-10 06:41:14', 1, 0, 1),
(407, 'm.herrera', '$2y$10$d17yDzolWSdFPdXsNj6rHuFO6UDLgWSzDKiFnt7QYchlOI/m0J.AG', 'mherrera@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-10-20 04:42:04', 1, 0, 1),
(408, 'i.torres', '$2y$10$Y0JNCq1bPOAu5OtaIEOHVeFPxdNCtFps/N48j.n0wxaNS641tl3Qm', 'irinatorres@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-10-20 04:42:04', 1, 0, 1),
(409, 'h.abello', '$2y$10$xCOhU6fnCmbCjjenRAzTZuMdrKm6BAVPihqtceYQWDIcjYd3ckv5a', 'habello@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2022-10-20 04:42:04', 1, 0, 1),
(410, 'erbin', '$2y$10$Ah/zFFW6a095tSn6Gw2tMeM5c3INiKAX3UKVrQqX75rfp.fBkgLe2', 'erbinantonio20@gmail.com', 1, 0, NULL, NULL, '1000-01-01 00:00:00', NULL, 'afffc23c5378a9f9ae870c9fafcf9565', '::1', '1000-01-01 00:00:00', '1000-01-01 00:00:00', '2023-02-09 00:54:29', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8mb3_bin NOT NULL,
  `id_users` int(11) NOT NULL,
  `user_agent` varchar(150) COLLATE utf8mb3_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8mb3_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id_user_profiles` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_profiles` int(11) DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargos`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direcciones`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleados`);

--
-- Indices de la tabla `externos`
--
ALTER TABLE `externos`
  ADD PRIMARY KEY (`id_externos`);

--
-- Indices de la tabla `grupomodulos`
--
ALTER TABLE `grupomodulos`
  ADD PRIMARY KEY (`id_grupomodulos`);

--
-- Indices de la tabla `grupo_campos`
--
ALTER TABLE `grupo_campos`
  ADD PRIMARY KEY (`id_grupo_campos`);

--
-- Indices de la tabla `info_personal`
--
ALTER TABLE `info_personal`
  ADD PRIMARY KEY (`id_info_personal`);

--
-- Indices de la tabla `inf_enterprise`
--
ALTER TABLE `inf_enterprise`
  ADD PRIMARY KEY (`id_enterprise`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulos`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profiles`);

--
-- Indices de la tabla `requisitos_cargos`
--
ALTER TABLE `requisitos_cargos`
  ADD PRIMARY KEY (`id_requisitos_cargo`);

--
-- Indices de la tabla `requisitos_cargos_has_cargos`
--
ALTER TABLE `requisitos_cargos_has_cargos`
  ADD PRIMARY KEY (`requisitos_cargos_id_requisitos_cargo`,`cargos_id_cargos`);

--
-- Indices de la tabla `seccion_empresa`
--
ALTER TABLE `seccion_empresa`
  ADD PRIMARY KEY (`id_seccion_empresa`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sedes`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD PRIMARY KEY (`id_submodulos`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`id_telefonos`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_users_id_enterprise_idx` (`id_enterprise`);

--
-- Indices de la tabla `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`);

--
-- Indices de la tabla `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id_user_profiles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direcciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT de la tabla `externos`
--
ALTER TABLE `externos`
  MODIFY `id_externos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupomodulos`
--
ALTER TABLE `grupomodulos`
  MODIFY `id_grupomodulos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `grupo_campos`
--
ALTER TABLE `grupo_campos`
  MODIFY `id_grupo_campos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `info_personal`
--
ALTER TABLE `info_personal`
  MODIFY `id_info_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inf_enterprise`
--
ALTER TABLE `inf_enterprise`
  MODIFY `id_enterprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `requisitos_cargos`
--
ALTER TABLE `requisitos_cargos`
  MODIFY `id_requisitos_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion_empresa`
--
ALTER TABLE `seccion_empresa`
  MODIFY `id_seccion_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sedes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  MODIFY `id_submodulos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `id_telefonos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

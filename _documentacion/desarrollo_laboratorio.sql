-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2023 a las 18:20:35
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
-- Base de datos: `desarrollo_laboratorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_seguimiento`
--

CREATE TABLE `actividad_seguimiento` (
  `id_actividad_seguimiento` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `actividad_seguimiento`
--

INSERT INTO `actividad_seguimiento` (`id_actividad_seguimiento`, `descripcion`) VALUES
(1, 'primera actividad de seguimiento editar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_laboratorio`
--

CREATE TABLE `areas_laboratorio` (
  `id_areas_laboratorio` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_edicion` datetime DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `areas_laboratorio`
--

INSERT INTO `areas_laboratorio` (`id_areas_laboratorio`, `descripcion`, `fecha_creacion`, `fecha_edicion`, `estado`) VALUES
(1, 'Bodega principal', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(2, 'Dirección General', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(3, 'Dirección Científica', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(4, 'Dirección Financiera', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(5, 'Dirección Administrativa', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(6, 'Dirección de Informática', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(7, 'Dirección de Calidad', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1),
(8, 'Dirección Comercial', '2022-06-02 16:37:04', '2022-06-02 16:37:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesores_comerciales`
--

CREATE TABLE `asesores_comerciales` (
  `id_asesores_comerciales` int(11) NOT NULL,
  `id_empleados` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_productos_examenes`
--

CREATE TABLE `asignacion_productos_examenes` (
  `id_asignacion_productos_examenes` int(11) NOT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `id_examenes` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `id_usuario_update` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `rendimiento` int(11) DEFAULT NULL COMMENT 'cantidad de pruebas realizables por productos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `asignacion_productos_examenes`
--

INSERT INTO `asignacion_productos_examenes` (`id_asignacion_productos_examenes`, `id_productos`, `id_examenes`, `estado`, `fecha_creacion`, `id_usuario_creacion`, `fecha_update`, `id_usuario_update`, `valor`, `rendimiento`) VALUES
(1, 191, 1, 1, '2022-06-09 00:06:12', NULL, NULL, NULL, 15000, 100),
(2, 482, 1, 1, '2022-06-09 00:06:12', NULL, '2022-06-09 00:06:12', NULL, 12000, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_pruebas_empleados`
--

CREATE TABLE `asignacion_pruebas_empleados` (
  `id_asignacion_pruebas_empleados` int(11) NOT NULL,
  `id_examenes` int(11) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL,
  `identificacion` int(11) NOT NULL,
  `prueba` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tiempo_prueba` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `id_usuario_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `asignacion_pruebas_empleados`
--

INSERT INTO `asignacion_pruebas_empleados` (`id_asignacion_pruebas_empleados`, `id_examenes`, `id_empleados`, `identificacion`, `prueba`, `descripcion`, `tiempo_prueba`, `estado`, `fecha_creacion`, `id_usuario_creacion`, `fecha_update`, `id_usuario_update`) VALUES
(1, 1, 1, 0, '', '', 10, 1, '2022-06-09 00:08:15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id_bodegas` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `id_centro_costo` int(11) DEFAULT NULL,
  `bodega` varchar(245) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id_bodegas`, `codigo`, `id_centro_costo`, `bodega`, `id_empleado`, `estado`) VALUES
(3, '9554456465', 1, 'Mi primera bodega', 461, 1),
(4, '5645641', 1, 'Mi segunda bodega', 461, 1),
(6, '541564564', 1, 'otra bodega', 461, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canal_informacion`
--

CREATE TABLE `canal_informacion` (
  `id_canal_informacion` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `canal_informacion`
--

INSERT INTO `canal_informacion` (`id_canal_informacion`, `descripcion`) VALUES
(26, 'nuevo registro holis holis'),
(27, 'este es el nuevo datonkl');

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
(1, 'bacterióloga\r\n', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_clinicas`
--

CREATE TABLE `categorias_clinicas` (
  `id_categorias_clinicas` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categorias_clinicas`
--

INSERT INTO `categorias_clinicas` (`id_categorias_clinicas`, `descripcion`) VALUES
(2, 'hola de nuevo h');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `id_categoria_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `pucdebito` varchar(20) NOT NULL DEFAULT '000000000',
  `puccredito` varchar(20) NOT NULL DEFAULT '00000000',
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria_producto`, `nombre`, `pucdebito`, `puccredito`, `estado`) VALUES
(1, 'Papeles', '', '', 1),
(2, 'Resma carta ', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_umd`
--

CREATE TABLE `categoria_umd` (
  `id_categoria_umd` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria_umd`
--

INSERT INTO `categoria_umd` (`id_categoria_umd`, `nombre`, `estado`) VALUES
(1, 'Tiempo', 1),
(2, 'Peso', 1),
(3, 'Longitud', 1),
(4, 'Presion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_costos`
--

CREATE TABLE `centros_costos` (
  `id_centros_costos` int(11) NOT NULL,
  `id_sedes` int(11) DEFAULT NULL,
  `id_seccion_empresa` int(11) DEFAULT NULL,
  `id_areas_laboratorio` int(11) DEFAULT NULL,
  `nombre` varchar(245) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `puc` varchar(45) DEFAULT NULL,
  `facturar` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `centros_costos`
--

INSERT INTO `centros_costos` (`id_centros_costos`, `id_sedes`, `id_seccion_empresa`, `id_areas_laboratorio`, `nombre`, `codigo`, `puc`, `facturar`, `estado`) VALUES
(1, 2, 1, 1, 'primer centro de costo', '11151', '1123', 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_medico`
--

CREATE TABLE `centro_medico` (
  `id_centro_medico` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `direccion` varchar(245) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `adicional` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `centro_medico`
--

INSERT INTO `centro_medico` (`id_centro_medico`, `descripcion`, `id_ciudad`, `direccion`, `contacto`, `adicional`) VALUES
(1, 'Ejemplo de centro médico', 20574, 'Cll 50E # 2 f -11', '3222143839', 'En la equina '),
(2, 'Mi segunda vez', 20643, 'Cll 50E # 2F -11 todo bien', 'Cll 50E # 2F -11 ', 'Esquina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conservacion`
--

CREATE TABLE `conservacion` (
  `id_conservacion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos_fijos`
--

CREATE TABLE `costos_fijos` (
  `id_costos_fijos` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `mes` varchar(100) NOT NULL,
  `ano` varchar(100) NOT NULL,
  `nombre` varchar(245) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `costos_fijos`
--

INSERT INTO `costos_fijos` (`id_costos_fijos`, `fecha`, `mes`, `ano`, `nombre`, `id_sede`, `valor`) VALUES
(1, '2022-12-02', '01', '2023', 'mi primer gasto fijo g', 2, 15000),
(2, '2022-12-07', '03', '2022', 'jrjryk', 4, 16000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos_indirectos_fabricacion`
--

CREATE TABLE `costos_indirectos_fabricacion` (
  `id_costos_indirectos_fabricacion` int(11) NOT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `id_descripcion_costo` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `motivo_costos` varchar(45) DEFAULT NULL,
  `ano_mes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `costos_indirectos_fabricacion`
--

INSERT INTO `costos_indirectos_fabricacion` (`id_costos_indirectos_fabricacion`, `id_sede`, `id_descripcion_costo`, `valor`, `fecha_creacion`, `fecha_update`, `id_usuario_creacion`, `id_usuario_actualizacion`, `motivo_costos`, `ano_mes`) VALUES
(1, 1, 2, 150000, '2022-06-08 23:41:15', '2022-06-08 23:41:15', NULL, NULL, '<xc<', '2022-01'),
(9, 1, 1, 234, NULL, NULL, NULL, NULL, 'dgf', '2022-06'),
(10, 1, 1, 1500, NULL, NULL, NULL, NULL, 'knk', '2022-03'),
(11, 2, 3, 15000, NULL, NULL, NULL, NULL, 'otros costo asociado', '2022-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_costo`
--

CREATE TABLE `descripcion_costo` (
  `id_descripcion_costo` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `id_area_laboratorio` int(11) DEFAULT NULL,
  `costo_fijo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `descripcion_costo`
--

INSERT INTO `descripcion_costo` (`id_descripcion_costo`, `descripcion`, `id_area_laboratorio`, `costo_fijo`) VALUES
(1, 'ACUEDUCTO Y ALCANTARILLADO', 5, 0),
(2, 'ALOJAMIENTO Y MANUTENCION', 5, 0),
(3, 'otra descripcón', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresas` int(11) NOT NULL,
  `razon_social` varchar(245) DEFAULT NULL,
  `nombre_comercial` varchar(245) DEFAULT NULL,
  `id_tipo_identificacion` int(11) DEFAULT NULL COMMENT 'CW3_CONFIG id_tipo_identificacion',
  `documento` varchar(100) DEFAULT NULL,
  `dv` varchar(45) DEFAULT NULL,
  `id_plazo_pago` int(11) DEFAULT NULL,
  `id_grupo_clientes` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `motivo_estado` varchar(245) DEFAULT NULL,
  `id_obligaciones_fiscales` int(11) DEFAULT NULL,
  `id_regimen_tax` int(11) DEFAULT NULL,
  `id_regimen_fiscal` int(11) DEFAULT NULL,
  `empresa_facturar` tinyint(4) DEFAULT NULL,
  `examenes_pacientes` tinyint(4) DEFAULT NULL,
  `bloquear_resultados` tinyint(4) DEFAULT NULL,
  `requiere_logo` tinyint(4) DEFAULT NULL,
  `requiere_mensajeria` tinyint(4) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `id_representate_legal` varchar(45) DEFAULT NULL,
  `id_ejecutivo_comercial` int(11) DEFAULT NULL,
  `consideraciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades_bancarias`
--

CREATE TABLE `entidades_bancarias` (
  `id_entidades_bancarias` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `puc` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `entidades_bancarias`
--

INSERT INTO `entidades_bancarias` (`id_entidades_bancarias`, `descripcion`, `puc`, `estado`) VALUES
(1, 'hola mundo', '4151561561', NULL),
(2, 'hola mundo', '48556456', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `codigo` int(50) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `departamento` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `proveedor` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `modelo` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `serie` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `fecha_instalacion` datetime(6) NOT NULL,
  `seguro` int(10) NOT NULL,
  `valor_seguro` int(200) NOT NULL,
  `garantia` int(10) NOT NULL,
  `fecha_vence_garantia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad_medica`
--

CREATE TABLE `especialidad_medica` (
  `id_especialidad_medica` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `especialidad_medica`
--

INSERT INTO `especialidad_medica` (`id_especialidad_medica`, `descripcion`) VALUES
(2, 'hola munod');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id_examenes` int(11) NOT NULL,
  `codigo_cups` varchar(45) DEFAULT NULL,
  `nombre_examen` varchar(145) DEFAULT NULL,
  `nombre_alterno` varchar(145) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id_examenes`, `codigo_cups`, `nombre_examen`, `nombre_alterno`, `abreviatura`, `estado`) VALUES
(1, 'cod_cups', 'nombre_examen', 'nombres_alternos', 'abreviatur', 0),
(2, '1176', 'Examen de riesgo cardiovascular', 'Framingham', 'ERC.', 1),
(3, '', 'PRUEBA PSICOLÓGICA PARA TRABAJO EN ALTURAS', '', '', 1),
(4, '90.6.8.33', 'INMUNOGLOBULINA D', 'IGD', 'IGD', 1),
(5, '', 'RAST MEJILLON', 'MEJILLON', '', 1),
(6, '', 'TOMA DE MUESTRA', '', '', 1),
(7, '90.8.4.05', 'CARIOTIPO BANDEO Q', 'Estudio Cromosómico, Citogenética, Estudio Citogenético Bandas Q, Estudio Cromosómico Bandeo Q, Análisis Cromosómico - Bandas Q', 'CARQ', 1),
(8, '', 'ELECTROENCEFALOGRAMA', 'EEC', 'EEC', 1),
(9, '', 'TOXOCARA CANNIS IGM', 'TOXOCARA', 'TC IGM', 1),
(10, '90.6.4.58', 'ANTICUERPOS MICROSOMALES', 'Anticuerpos anti peroxidasa, TPO, Anti TPO,Ac coloidales', 'MICROS', 1),
(11, '90.3.8.68', 'TRIGLICERIDOS', 'TRG, PERFIL DE LIPIDOS, PERFIL LIPIDICO', 'TRIG', 1),
(12, '90.4.9.21', 'T4 LIBRE', 'T4L, TIROXINA LIBRE, T4 FRACCIÓN LIBRE, HORMONAS TIROIDEAS LIBRES', 'T4L', 1),
(13, '90.6.0.23', 'HELICOBACTER PYLORI IGG', 'H PYLORI IGG, ANTICUERPOS IGG CONTRA HELICOBACTER', 'HPYLORIG', 1),
(14, '', 'HERPES I EN LCR, ANTICUERPOS IGM', 'HERPES I EN LCR', '', 1),
(15, '90.3.8.23', 'DEPURACION DE CREATININA', 'ACLARAMIENTO DE CREATININA, CREATININA DEPURACION', 'DEPC', 1),
(16, '', 'VALORACION POR OPTOMETRIA', '', '', 1),
(17, '', 'EXAMEN MEDICO POS INCAPACIDAD', '', 'EXAMPI', 1),
(18, '90.6.0.01', 'ANTIESTREPTOLISINA O', 'ASTO, ASO, ASTOS,', 'ASTO', 1),
(19, '', 'CYTOGEL 6 ML PRIMERA DOSIS', '', 'CYTI6M1', 1),
(20, '', 'RAST PULPO', 'PULPO', '', 1),
(21, '90.6.2.28', 'HERPES I IGG', 'Herpes tipo I IgG, anticuerpos IgG para Herpes, herpes simple IgG,HSV IgG', 'HERIG', 1),
(22, '', 'MARIHUANA CUANTITATIVA EN SUERO', 'THC CUANTITATIVA, MARIHUANA EN SANGRE,TETRAHIDROCANABINOL EN SANGRE', 'THCCUAN', 1),
(23, '90.4.9.20', 'TIROGLOBULINA', 'Marcador de Ca de tiroides, TG,TGB', 'TG', 1),
(24, '90.7.2.01', 'ESPERMOGRAMA BASICO', 'Estudio espermatico', 'ESPE', 1),
(25, '', 'Hemoglobina Paroxistica Nocturna', 'Sindrome de Marchiafava-Micheli,1 ', 'HPN', 2),
(26, '', 'ULTRASONAGRAFIA DE TEJIDOS BLANDOS EXTREMIDADES SUPERIORES', '', 'ULTRASONTB', 1),
(27, '90.6.4.62', 'ANTICUERPOS PEROXIDASA', 'TPO, Anti TPO, anticuerpos tiroideos, anticuerpos microsomales', 'TPO', 1),
(28, '90.3.8.78', 'POTASIO EN ORINA AL AZAR', 'K, electrolitos en orina, potasuria, electrolitos en orina al azar.', 'KOA', 1),
(29, '90.3.8.74', 'PROTEINAS EN ORINA AL AZAR', 'Proteinuria, proteinas en orina.', 'PROOA', 1),
(30, '', 'CALAMAR', 'CALAMAR', '', 1),
(31, '', 'RAST DE CASEINA', 'RAST DE PROTEINA DE LECHE CASEINA', 'RASTCASEIN', 1),
(32, '', 'TASA DE FILTRACION GLOMERULAR', 'TFG, IFG, GFR ', 'TFG', 1),
(33, '90.6.0.29', 'LEPTOSPIRA IGG', 'ANTICUERPOS IGG PARA LEPTOSPIRA, LEPTOSPIROSIS', 'LEPTIGG', 1),
(34, '90.6.3.18', 'HEPATITIS B ANTIGENO E', 'HVBAgE, Hepatitis B AgE, HBE', 'HVBAGE', 1),
(35, '', 'Síndrome Mieloproliferativo Cronico (SMC) (Exon 12 - JAK2) Screening', 'EXON 12 SMP', 'EXON 12', 1),
(36, '90.6.4.82', 'BETA 2 GLICOPROTEINA IgM', 'Beta-2-GPI, anticuerpos IgM', 'B2GM', 1),
(37, '', 'EXAMEN MEDICO CORPORATIVO', '', 'MEDICO', 1),
(38, '90.6.9.13', 'PROTEINA C REACTIVA', 'PCR, CRP', 'PCR', 1),
(39, '', 'ULTRASONAGRAFIA DE TEJIDOS BLANDOS EXTREMIDADES INFERIORES', '', 'ULTSONTBIN', 1),
(40, '', 'ULTRASONAGRAFIA DE TEJIDOS BLANDOS DE ABDOMEN Y PELVIS', '', 'ULTSONTBAB', 1),
(41, '', 'RX DE COLUMNA CERVICAL', '', 'RXCOCER', 1),
(42, '', 'RX COLUMNA DORSAL', '', 'RXCODORSAL', 1),
(43, '', 'RAST DE GLUTEN', 'INMUNOGLOBULINA E ESPECIFICA PARA GLUTEN', 'RASTGLUT', 1),
(44, '90.6.9.10', 'FACTOR REUMATOIDEO', 'RF, RHF, RA TEST, AR', 'FR', 1),
(45, '', 'RAST CARACOL', 'CARACOL', '', 1),
(46, '90.6.2.30', 'HERPES II IGG', 'Herpes simple tipo II IgG, HVS II IgG, TORCH IgG', 'HERIIG', 1),
(47, '90.4.7.04', 'INSULINA', 'INSULINA BASAL, NIVELES DE INSULINA,INSULINEMIA', 'INS', 1),
(48, '', 'RX COLUMNA DORSO LUMBAR', '', 'RXCDL', 1),
(49, '90.7.1.05', 'RECUENTO HAMBURGUER', 'Recuento minutado de Hamburguer', 'HAMBURGUER', 1),
(50, '90.3.0.44', 'PORCENTAJE DE SATURACION DE TRANSFERRINA', '% DE SATURACION, INDICE DE SATURACION, SATURACION DEL HIERRO', '%ST', 1),
(51, '', 'ECOGRAFIA DE MAMA', '', 'ECOMAMA', 1),
(52, '', 'CYTOGEL DE 3 ML PRIMERA DOSIS', '', 'CYTO3ML1', 1),
(53, '85', 'COLESTEROL VLDL', 'VLDL, COLESTEROL DE MUY BAJA DENSIDAD', 'VLDL', 1),
(54, '90.6.2.29', 'HERPES I IGM', 'Herpes tipo I IgM, HVS I IgM, HERPES SIMPLE I IgM', 'HERIM', 1),
(55, '906834  .  .', 'RAST DE ATUN', 'inmunoglobulina ige especifica para atun', 'RASTATUN', 1),
(56, '90.8.4.07', 'CARIOTIPO BANDEO R', 'Análisis Cromosómico Bandeo R, Estudio Citogenetico Bandeo R', 'CARBANR', 1),
(57, '89.5.2.', 'ELECTROCARDIOGRAMA', 'EKG, ECG', 'ECG', 1),
(58, '90.3.8.46', 'HIERRO', 'FE, HIERRO SERICO, FERREMIA, FE++, ', 'FE', 1),
(59, '', 'DOMICILIO SANTA MARTA', '', '', 1),
(60, '1854', 'RAST OSTRA', 'OSTRAS', '', 1),
(61, '90.3.4.26', 'HEMOGLOBINA GLICOSILADA', 'HBA1C,HBA1, HEMOGLOBINA GLICADA', 'A1c_3', 1),
(62, '90.6.3.27', 'ROTAVIRUS', 'Detección de antígeno rotavirus', 'ROTAV', 1),
(63, '906834. . ', 'RAST DE ALFALACTOALBUMINA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA ALFALACTOALBUMINA', 'RASTALFALC', 1),
(64, '90.6.4.32', 'ANTICUERPOS MITOCONDRIALES', 'Mitocondria anticuerpos, AMA. AMAS', 'AMA', 1),
(65, '', 'VACUNA TRIPLE VIRAL', '', 'VTRIPLEV', 1),
(66, '', 'CARIOTIPO DE VELLOSIDADES CORIONICAS', 'ESTUDIO CITOGENETICO DE VELLOSIDAD CORIONICA', 'CARVELLCOR', 1),
(67, '', 'VACUNA TETANO', '', 'VATETANO', 1),
(68, '', 'EMBALAJE Y TRANSPORTE', '', 'EMBYTTE', 1),
(69, '', 'CYTOGEL DE 12 ML PRIMERA DOSIS', '', 'CYT12ML1', 1),
(70, '9.06834.', 'RAST DE CARNE DE RES', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CARNE DE RES', 'RASTCARRES', 1),
(71, '', 'HIDROXI-PREGNENOLONA 17', '', '', 1),
(72, '90.6.8..37', 'LAMBDA CADENAS LIVIANAS EN ORINA ', 'LAMBDA CADENAS LIGERAS EN ORINA', 'LAMLIVORIN', 1),
(73, '90.6.2.22', 'HEPATITIS B ACS AGE', 'hbage, anticuerpos contra antigeno E, hepatitis b anticuerpos contra el antigeno E', 'HVBAcsE', 1),
(74, '901304', 'FROTIS VAGINAL', 'Secreción vaginal examen directo, fresco y Gram', 'SECVRUT', 1),
(75, '90.5.7.16', 'MARIHUANA', 'CANNABIS, THC, CANNABIS SATIVA, CANNABINOIDE, TETRAHIDROCANNABINOL', 'THC', 1),
(76, '', 'PML/RARA t(15;17) (q22;q21)', 'PML', '', 1),
(77, '', 'VACUNA HEPATITIS B', '', 'VAHEPB', 1),
(78, '90.4.9.12', 'PARATOHORMONA', 'PTH, PTHI, HORMONA PARATIROIDEA, PARATOHORMONA MOLECULA INTACTA,PARATIRINA', 'PTH', 1),
(79, '90.6.2.55', 'TOXOCARA ANTICUERPOS IgG', 'ANTICUERPOS ANTITOXOCARA IGG', 'TOXCARIGG', 1),
(80, '90.7.0.12', 'SANGRE OCULTA SERIADA', 'SO, Guayaco seriado', 'SOS', 1),
(81, '', ' D Xilosa en Suero. (0-15 años)', 'Prueba de Absorción de D-Xilosa, Prueba de Tolerancia a la D-Xilosa', 'DXS', 2),
(82, '', 'Índice de riesgo prenatal segundo trimestre (AFP y Beta-HCG)', '', '', 1),
(83, '', 'RAST DE CYNODON DACTYLON ', '(Grama Mayor), Pólenes Gramineas', 'RASTGRAMA', 1),
(84, '', 'VACUNA HEPATITIS A', '', 'VAHEPA', 1),
(85, '', 'VACUNA FIEBRE TIFOIDEA', '', 'VACFTIF', 1),
(86, '90.7.0.08', 'SANGRE OCULTA', 'SO, GUAYACO, DETERMINACIÓN DE HEMOGLOBINA HUMANA EN HECES', 'SO', 1),
(87, '90.6.9.03', 'MONOTEST', 'Anticuerpos Heterófilos, MI, Anticuerpos por Mononucleosis Infecciosa, mononucleosis infecciosa prueba rápida,', 'MONO', 1),
(88, '90.6.8.36', 'INMUNOGLOBULINA E', 'IGE, IGE SERICA, NIVELES DE IGE, IGE TOTAL', 'IgE', 1),
(89, '906834.  ..', 'RAST DE ALGODON', 'inmunoglobulina ige especifica para algodon', 'RASTALGOD', 1),
(90, '90.6.0.25', 'HELICOBACTER PYLORI CUALITATIVO', 'H. pylori, anticuerpos para helicobacter, Helicobacter pylori anticuerpos totales', 'H.PYL', 1),
(91, '90.3.8.59', 'POTASIO', 'K, electrolitos, ionograma, potasio serico, niveles de potasio, potasemia', 'K', 1),
(92, '', 'RAST DE BROCOLI', 'Alérgeno Brócoli (f260), Anticuerpos IgE', '', 1),
(93, '90.57.27', 'METANFETAMINAS CUANTITATIVAS EN ORINA', 'Metedrina, Desoxyn', 'METAN', 1),
(94, '90.3.8.75', 'FOSFORO EN ORINA AL AZAR', 'FOSFATURIA, FOSFATOS EN ORINA AL AZAR, FÓSFORO EN ORINA AL AZAR', 'POA', 1),
(95, '90.3.0.46', 'TRANSFERRINA', 'Siderofilina', 'TRANS', 1),
(96, '90.3.1.13', 'ACIDO VANILMANDELICO (VMA) EN ORINA DE 24HORAS ', 'VMA, ACIDO VANILMANDELICO EN ORINA,ÁCIDO 3-METOXI-4-HIDROXIMANDÉLICO, , ÁCIDO 4-HIDROXI-3-METOXIMANDÉLICO', 'VMA', 1),
(97, '90.3.8.30', 'FOSFATASA ACIDA', 'ACP', 'FOSACI', 1),
(98, '90.4.9.25', 'T3 TOTAL', 'T3T, TRIYODOTIRONINA TOTAL', 'T3', 1),
(99, '90.3.0.21', 'HAPTOGLOBINA', 'HAPTOGLOBINA', 'HAPTO', 1),
(100, '90.6.8.29', 'INMUNOGLOBULINA G', 'IGG', 'IGG', 1),
(101, '', 'VISIOMETRIA', '', 'VISIO', 1),
(102, '90683.4.', 'RAST DE AVENA', 'inmunoglobulina ige especifica para avena', 'RASTAVENA', 1),
(103, '', 'RAST DE POLVO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA POLVO', 'POLVO', 1),
(104, '', 'ACIDO MANDELICO   ACIDO FENILGLIOXILICO', '', 'MANDFENIL', 1),
(105, '', 'VACUNA DE INFLUENZA', '', 'VACINFLU', 1),
(106, '', 'GLIADINA ANTICUERPOS IGM', 'GLIADINA IGM', 'GIGM', 2),
(107, '90.6.8.27', 'INMUNOGLOBULINA A', 'IGA', 'IGA', 1),
(108, '', 'PROPEPTIDO N TERMINAL DEL PROCOLAGENO TIPO I', 'PRUEBA DE RESORCION OSEA', 'P1NP', 1),
(109, '', 'PAM EPILEPSIA + CNV 474 GENES ', 'PAM EPILEPSIA', '474', 1),
(110, '90.6.8.32', 'INMUNOGLOBULINA M', 'IGM', 'IGM', 1),
(111, '90.3.8.54', 'MAGNESIO', 'MG, MAGNESIO EN SANGRE', 'MG', 1),
(112, '561', 'VISIBILIT', 'PRUEBA PRENATAL NO INVASIVA ', 'VISIBILIT', 2),
(113, '90.8.8.07', 'HEPATITIS C CARGA VIRAL', 'CARGA VIRAL PARA HEPATITIS C', 'HEPCCARGA', 1),
(114, '', 'CULTIVO DE AMBIENTE O SUPERFICIES', 'Control microbiológico de superficie, cultivo de salas', 'CUAS', 1),
(115, '90.6.3.17', 'HEPATITIS B ANTIGENO DE SUPERFICIE', 'Hepatitis B ags, Hepatitis B antígeno de superficie,HVBAGS', 'HVBAgS', 1),
(116, '90.6.8.42', 'KAPPA CADENAS LIBRES EN SUERO', 'CADENAS KAPPA LIBRES EN SANGRE', 'KAPLIBSU', 1),
(117, '90.3.7.11', 'VITAMINA K', 'Fitomenadiona', 'VIT K', 1),
(118, '90.3.8.79', 'MAGNESIO EN ORINA AL AZAR', 'MG EN ORINA, MG EN ORINA AISLADA, MAGNESIO EN ORINA AISLADA', 'MGOA', 1),
(119, '', 'RAST DE POLLO', 'inmunoglobulina ige especifica para pollo', 'RASTPOLLO', 1),
(120, '', 'RAST DE PENICILINA G VIA INTRAVENOSA', 'inmunoglobulina ige especifica para penicilina G intravenosa', 'PENGIV', 1),
(121, '', 'VACUNA FIEBRE AMARILLA', '', 'VACFAMA', 1),
(122, '90.5.7.26', 'COCAINA', 'DROGAS DE ABUSO, COC, ', 'COC', 1),
(123, '', 'RAST DE PENICILLIUM', 'inmunoglobulina ige especifica para penicillium', 'RASTPENLL', 1),
(124, '906834.  .', 'RAST DE BETA LACTOGLOBULINA', 'inmunoglobulina ige especifica para beta lactoglobulina', 'BETALACTGL', 1),
(125, '90.6.9.06', 'COMPLEMENTO C-3', 'C3, FRACCION 3 DEL COMPLEMENTO, ', 'C3', 1),
(126, '91.1.0.04', 'COOMBS INDIRECTO', '', 'COOMI', 1),
(127, '90.3.0.66', 'PEPTIDO NATRIUREICO BNP', 'BNP, PÉPTIDO ATRIAL NATRIURÉTICO [BNP] [PÉPTIDO CEREBRAL NATRIURÉTICO', 'BNP', 1),
(128, '9 0.6.9.04', 'COMPLEMENTO HEMOLITICO', 'CH50, COMPLEMENTO HEMOLITICO 50, ENSAYO DE COMPLEMENTO, PROTEINAS DE COMPLEMENTO', 'CH50', 1),
(129, '90.3.8.45', 'TEST O\' SULLIVAN', 'Test de sullivan, pre y post 50 gramos ', 'TOSUL', 1),
(130, '', 'RX COLUMNA LUMBOSACRA', '', 'RXCOLSAC', 1),
(131, '90.3.4.05', 'ALFA 1 ANTITRIPSINA EN SUERO', 'AAT, α1-AT, α1-Antiproteasa', 'ALFA1AS', 1),
(132, '90.6.8.43', 'LAMBDA CADENAS LIBRES EN SUERO', 'CADENAS LAMBDA LIBRES EN SANGRE', 'LAMLIBSU', 1),
(133, '90.3.8.49', 'CITOQUIMICO DE LIQUIDO ASCITICO', 'Citoquímico de líquido peritoneal', 'CLAS', 1),
(134, '', 'RAST DE LENTEJA', '', '', 1),
(135, '9005', 'TEST DE STAI PARA ALTURA ', '', 'TDSTA', 1),
(136, '305', 'CRIOGLOBULINAS', '', 'CRIOG', 1),
(137, '', 'CITOLOGIA DE CAPA FINA ANAL', '', 'CCA', 1),
(138, '90.4.8.07', 'CORTISOL EN ORINA', 'Cortisol libre en orina de 24 horas ', 'CORTIO', 1),
(139, '908328', 'Glucosaminoglucano-Mucopolisacarido Cualitativo', 'Glucosaminoglucano', 'G-MC', 1),
(140, '90.5.7.26.', 'COCAINA EN SANGRE ', 'COCAINA CUANTITATIVA EN SUERO ', 'COCSA', 1),
(141, '90.2.0.39', 'FACTOR V LEIDEN R-PCA', 'FACTOR V LEIDEN', 'FVLEIDEN', 1),
(142, '', 'RAST DE CAMARON', 'inmunoglobulina ige especifica para camaron', 'CAMARON', 1),
(143, '', 'RAST DE PESCADO', 'inmunoglobulina ige especifica para pescado', 'RASTPESC', 1),
(144, '90.6.8.42.', 'KAPPA CADENAS LIBRES EN ORINA', 'CADENAS KAPPA LIBRES EN ORINA', 'KAPLIBORI', 1),
(145, '90.6.8.37', 'KAPPA CADENAS LIVIANAS EN SUERO', 'CADENAS LIGERAS KAPPA,CADENAS KAPPA EN SUERO', 'KALIVISU', 1),
(146, '90.3.3.02', 'CURVA DE LACTOSA', 'PRUEBA DE TOLERANCIA A LA  LACTOSA, TEST DE SOBRECARGA A LA LACTOSA, PRUEBA DE INTOLERANCIA A LA LACTOSA', 'CTL', 1),
(147, '90.8.8.05', 'CITOMEGALOVIRUS CARGA VIRAL', 'CARGA VIRAL PARA CITOMEGALOVIRUS', 'CITOCARVIR', 1),
(148, '90.6.8.41', 'PROCALCITONINA', 'PCT,PROCALCITONINA CUANTITATIVA', 'PCT', 1),
(149, '90.2.0.11', 'DILUCIONES DE TIEMPO DE TROMBOPLASTINA PARCIAL', 'PTT Diluciones, PTT Diluido', 'DPTT', 1),
(150, '', 'EXAMEN MEDICO CON ENFASIS EN ALTURA ', '', 'EXMEAL', 1),
(151, '', 'VALORACION PSICOLOGICA TRABAJO EN ALTURA Y  ESPACIOS CONFINADOS', 'ESPACIOS CONFINADOS', 'VPAEC', 1),
(152, '90.6.8.13', 'FACTOR INTRINSECO ANTICUERPOS  BLOQUEADORES FIJADORES', 'Factor Intrínseco Gástrico, Factor Intrínseco de Castle', 'FIACSBL', 1),
(153, '', 'RX TORAX', '', 'RXTORAX', 1),
(154, '', 'PRETIX', 'ESTUDIO DE LA PERDIDA GESTACIONAL', 'pre', 1),
(155, '90.6.4.74', 'GLIADINA IGA', 'ANTIGLIADINA IGA, ANTICUERPOS ANTI GLIADINA IGA', 'GLIADIGA', 1),
(156, '90.6.8.37.', 'LAMBDA CADENAS LIVIANAS EN SUERO', 'LAMBDA CADENAS LIGERAS EN SUERO, CADENAS LIVIANAS LAMBDA', 'LAMBLISU', 1),
(157, '90.6.2.19', 'HEPATITIS A ACS. IgG', 'HVA Total, HAVIgG, Anticuerpos totales de hepatitis A', 'HVAG', 1),
(158, '90.6.2.18', 'HEPATITIS A ACS. IgM', 'HVA IgM, HVAM, Anticuerpos IgM contra hepatitis A.', 'HVAM', 1),
(159, '', 'EXAMEN MEDICO CON ENFASIS OSTEOMUSCULAR Y ALTURA', '', 'EXMOSTAL', 2),
(160, '798', 'VIRUS RESPIRATORIO SIETE VIRUS', 'Siete Virus Deteccion De AntigenO', '7VIRU', 1),
(161, '90.4.2.02', 'HORMONA DE CRECIMIENTO PRE Y POS EJERCICIO', 'Crecimiento Hormona (GH) - Prueba de Estímulo con Ejercicio', 'HGPYPE', 1),
(162, '', 'EXAMEN MEDICO CON ENFASIS OSTEOMUSCULAR', '', 'EXMOSTE', 1),
(163, '90.6.8..34', 'RAST DE SOYA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA SOYA', 'RSOYA', 1),
(164, '90.6.8.43.', 'LAMBDA CADENAS LIBRES EN ORINA', 'CADENAS LMABDA LIBRES EN ORINA', 'LAMLIBORI', 1),
(165, '', 'RAST DE BLOMIAS TROPICALES', 'inmunoglobulina ige especifica para blomias tropicales,blomia tropicalis', 'BLOMIAS', 1),
(166, '', 'RX TORAX AP LAT', '', 'RXAPLAT', 1),
(167, '90.6.2.26', 'HEPATITIS DELTA ACS TOTALES', 'HEPATITIS D', 'HEPDELTATO', 1),
(168, '90.4.2.04', 'PROLACTINA PRE Y POST ESTIMULO', 'PRL PRE Y POS, PROLACTINA BASAL Y POS ACTH', 'PRLPYP', 2),
(169, '90.7.1.08', 'DIMORFISMO ERITROCITARIO', 'Glóbulos rojos morfología en orina, Morfología Globular en Orina', 'DEO', 1),
(170, '90.6.1.31', 'CHAGAS IGG', 'TRIPANOSOMA CRUZI ANTICUERPOS, CHAGAS ANTICUERPOS IGG', 'CHAGASG', 1),
(171, '90.5.7.31', 'MERCURIO EN SANGRE', 'NIVELES DE MERCURIO EN SANGRE, HG EN SANGRE', 'MERCUSAN', 1),
(172, '', 'PRUEBA DE APTITUD PSICOFISICA', '', 'PAPSICOF', 1),
(173, '90.6.4.53', 'ANTICUERPOS RNP', 'ANTI RNP, RNP ANTICUERPOS, ENAS', 'RNP', 1),
(174, '', 'EMBALAJE Y TRANSPORTE INTERNACIONAL', '', 'EMBTTEINTE', 1),
(175, '90.2.1.06', 'ERITROPOYETINA', 'EPO, Hematopoyetina', 'EPO', 1),
(176, '90.3.5.03', 'CITOQUIMICO DE LIQUIDO PERICARDICO', 'Liquido pericardico citoquímico ', 'CLP', 1),
(177, '', 'OPTOMETRIA', '', 'OPTO', 1),
(178, '214', 'BACILOSCOPIA EN ORINA', 'BK en orina', 'BKO', 1),
(179, '695', 'CROMO EN SANGRE', 'CR, CROMO SERICO, NIEVELS DE CROMO EN SANGRE', 'CROMOSAN', 1),
(180, '90.3.8.37', 'FRACCION EXCRETADA DE SODIO', 'Excreción de sodio fraccionada, ', 'FENa', 1),
(181, '90.3.4.17', 'CERULOPLASMINA', 'FERROXIDASA', 'CERU', 1),
(182, '90.6.4.54', 'ANTICUERPOS RO/SSA', 'ANTI RO, ANTI SSA, ENAS', 'RO', 1),
(183, '908341', 'Ácido Siálico en Orina', '', '', 1),
(184, '', 'ESTEATOCRITO', '', 'ESTEAT', 1),
(185, '90.5.2.06', 'CARBAMAZEPINA', 'Carbatrol, Epitol, Equetrol, Tegretol-XR, Tegretol, niveles de carbamazepina', 'CARB', 1),
(186, '90.5.2.03', 'BARBITURICOS CUANTITATIVOS EN ORINA', '', 'BARTCO', 1),
(187, '90.3.8.15', 'COLESTEROL HDL', 'HDL, LIPOPROTEINA DE ALTA DENSIDAD, COLESTEROL BUENO', 'HDL', 1),
(188, '90.6.2.36', 'INFLUENZA VIRUS B, ANTICUERPOS IgG e IgM', '', '', 1),
(189, '', 'ANALISIS DEL PUESTO DE TRABAJO', '', 'APT', 1),
(190, '', 'PRUEBA DE EQUILIBRIO O VERTIGO ', '', 'PEQYVER', 1),
(191, '90.2.0.35', 'PROTEINA S DE LA COAGULACION', 'PROTEINA S, PROTEINA S FUNCIONAL DE LA COAGULACION', 'PROTS', 1),
(192, '90.8.8.06', 'HEPATITIS B CARGA VIRAL', 'CARGA VIRAL HEPATITIS B, CARGA VIRAL POR PCR -RT PARA HEPATITIS B', 'HBCARVIR', 1),
(193, '90.3.8.27', 'CUERPOS CETONICOS EN SANGRE', 'Cetonas en sangre, cetonemia, cuerpos cetonicos en suero', 'CETS', 1),
(194, '90.6.4.56', 'ANTICUERPOS SM', 'ANTI SM, ANTI SMITH, ENAS', 'SM', 1),
(195, '90.4.8.09', 'DEHIDROEPIANDROSTERONA SULFATO', 'DHEAS, DHEA-SO4', 'DHEAS', 1),
(196, '90.1.2.30', 'CULTIVO PARA MYCOBACTERIUM', 'Cultivo de BK', 'MYCOB', 1),
(197, '90.6.4.30', 'ANTICUERPOS LA/SSB', 'Anti LA, anti SSB, enas, anticuerpos nucleares extractables', 'la/ssb', 1),
(198, '90.6.4.63', 'ANTICUERPOS TIROGLOBULINICOS', 'Anticuerpos antitiroglobulina, ATG, TgAb, anticuerpos tiroideos', 'ATG', 1),
(199, '906212', 'Epstein Barr Virus Antígeno de Cápside (VCA), Anticuerpos IgG', 'Epstein Barr Virus Antígeno de Cápside (VCA), Anticuerpos IgG', '', 1),
(200, '90.3.8.02', 'ACIDO URICO EN ORINA DE 24 HORAS', 'URICOSURIA, URATOS EN ORINA, AU EN ORINA ', 'AU24H', 1),
(201, '', 'RAST DE MAIZ', 'inmunoglobulina ige especifica para maiz', 'MAIZ', 1),
(202, '', 'Dra VALORACION PSICOLOGICA TRABAJO EN ALTURA Y  ESPACIOS CONFINADOS ', 'Dra VALORACION', 'DRA PTAEC', 1),
(203, '90.3.8.77', 'ACIDO URICO EN ORINA AL AZAR', 'URICOSURIA, ACIDO URICO EN ORINA AISLADA,URATOS', 'AUOA', 1),
(204, '306', 'CUERPOS LAMELARES', 'Recuento de CL en liquido amniótico, Partículas lamelares en liquido amniótico ', 'CUERL', 1),
(205, '', 'RAST DE CLARA DE HUEVO', 'INMUNOGLOBULINA E ESPECIFICA PARA CLARA DE HUEVO', 'RASTCLAH', 1),
(206, '', 'ESTUDIO DE MICROARREGLOS CYTOSCAN OPTIMA PARA MATERIAL DE ABORTO Y ESTUDIO PRENATAL ', '', 'CYTOPTIMA', 2),
(207, '90.3.8.80', 'CLORO EN ORINA AL AZAR', 'CLORURO EN ORINA', 'CLOA', 1),
(208, '', 'CAMPIMETRIA', 'CAM', '', 1),
(209, '', 'RAST DE YEMA DE HUEVO', 'inmunoglobulina e especifica para yema de huevo', 'RASTYEMA', 1),
(210, '', 'HEXANODIONA 2.5 TOTAL, ORINA', '', '', 1),
(211, '', 'METALES EN CABELLO', 'Metales Nutrientes y Tóxicos en Cabello', 'METALCABEL', 1),
(212, '90.2.0.18', 'FACTOR VIII', 'FACTOR VIII DE LA COAGULACION, FACTOR ANTIHEMOLITICO A', 'FVIII', 1),
(213, '', 'MATERNIT BASE', '', 'MTB', 1),
(214, '90.4.5.03', 'ESTRADIOL', 'E2,ESTROGENOS, ESTRADIOL 17 BETA', 'E2', 1),
(215, '90.6.4.0 7', 'CARDIOLIPINA IgA', 'anticuerpos iga para cardiolipinas, ACAS IGA', 'ACAIGA', 1),
(216, '90.2.1.12', 'HEMOGLOBINA FETAL', 'HbF, ', 'HbF', 1),
(217, '90.1.0.02', 'ANTIBIOGRAMA', 'ATB', 'ATB', 2),
(218, '90.3.7.03', 'VITAMINA B12', 'Vit B12, cianocobalamina, Cobalamina', 'B12', 1),
(219, '', 'RAST DE CLADOSPORIUM HERBARUM', 'inmunoglobulina ige especifica para cladosporium herbarum', 'CLADOSPO', 1),
(220, '', 'CA 72-4', 'Marcador Tumoral 72.4', '', 1),
(221, '90.6.2.15', 'EPSTEIN BARR VCA IGM', 'EB VCA IGM, EPSTEIN BARR VIRUS CAPSIDE IGM', 'EBVCAM', 1),
(222, '90.3.8.55', 'MAGNESIO EN ORINA DE 24 HORAS', 'MG EN ORINA, MAGNESIO EN ORINA', 'MG24H', 1),
(223, '', 'EXON 12', '	Mutacion Analisis del Gen NPM (Exon 12) - Nucleofosmina', '', 1),
(224, '90.5.2.01', 'ACIDO VALPROICO', 'Ácido Diprofilacético, Depacon, Depakene, Depakote, Depamide, Valproato de Sodio, Valproato semisodio, Valcote, Leptilan', 'VALP', 1),
(225, '90.3.8.65', 'SODIO EN ORINA DE 24 HORAS', 'sodio en orina, sodio urinario, na en orina, electrolitos en orina', 'NA24H', 1),
(226, '90.6.2.12', 'EPSTEIN BARR VCA IGG', 'EB VCA IGG, VIRUS EPSTEIN BARR VIRUS CAPSIDE IGG', 'EBVCAG', 1),
(227, '90.6.8.34.', 'RAST ACAROS D FARINAE', 'ACAROS FARINAE, D FARINAE', 'DFARI', 1),
(228, '90.4.0.06', 'LEPTINA', '', 'LEPTINA', 1),
(229, '90.7.1.04', 'RECUENTO DE ADDIS', '', 'ADDIS', 1),
(230, '', 'Domicilio examen medico', 'Domicilio', '', 1),
(231, '', 'CURSO DE MANIPULACIÓN DE ALIMENTOS', '', 'CMA', 1),
(232, '', 'Alcoholimetria en aliento', '', '', 2),
(233, '90.2.2.21', 'RECUENTO MANUAL DE PLAQUETAS', 'Recuento de plaquetas', 'PLAQU', 1),
(234, '', 'INTERLEUQUINA 10', '', 'IL 10', 1),
(235, '', 'Deoxipiridolina', 'Pirilinks D', 'DPD', 1),
(236, '90.6.6.02', 'ALFAFETOPROTEINA', 'AFP, Alfafetoproteina serica', 'AFP', 1),
(237, '90.6.1.26', 'TOXOPLASMA IGA', 'TOXOPLASMA INMUNOGLOBULINA A, TOXOPLASMA GONDII IGA', 'TOXOIGA', 1),
(238, '90.3.8.52', 'CITOQUIMICO DE LIQUIDO PLEURAL', 'Liquido pleural citoquímico', 'CLPL', 1),
(239, '', 'ALERGENO LANGOSTA ANTIGENO IgE', 'F304, RAST DE LANGOSTA', 'RASTLANG', 1),
(240, '90.1.1.09', 'COLORACION DE TINTA CHINA', 'Investigacion de Criptococo Neoformans', 'CTCH', 1),
(241, '90.2.2.17', 'FRAGILIDAD CAPILAR', 'Prueba de Torniquete, Prueba de Rumpel Leede', 'FRAC', 1),
(242, '90.3.8.57', 'NITROGENO UREICO EN ORINA DE 24 HORAS ', 'BUN EN ORINA, NU EN ORINA , AZOADOS EN ORINA', 'BUN24H', 1),
(243, '90.6.4.66', 'ANTICUERPOS CICLICOS CITRULINADOS', 'Citrulina, Anti CCP, antipeptidos ciclicos citrulinados', 'CCP', 1),
(244, '', 'INTERLEUQUINA 8', 'IL 8', 'IL 8', 1),
(245, '90.1.2.06', 'COPROCULTIVO', 'Cultivo de materia fecal, ', 'COPROC', 1),
(246, '90.2.0.41', 'RETRACCION DEL COAGULO', '', 'RETCO', 1),
(247, '', 'INTERLEUQUINA 2', 'IL 2', 'IL 2', 1),
(248, '90.2.0.10', 'DILUCIONES DE TIEMPO DE PROTROMBINA', 'PT Diluciones, PT diluido', 'DPT', 1),
(249, '90.2.1.21', 'SICLEMIA', 'Drepanocitos, Ciclaje, Células Falciformes', 'SICLE', 1),
(250, '90.3.4.19', 'COLINESTERASA EN ERITROCITOS', 'Colinesterasa Intraeritrocitaria, Acetilcolinesterasa en glóbulos rojos, Colinesterasa Verdadera', 'COLIE', 1),
(251, '90.4.5.11', 'HORMONA ANTIMULLERIANA', ' AMH, ANTIMULLERIANA, Sustancia Inhibidora Mulleriana (SIM) , Hormona Inhibidora Mulleriana (HIM) , Factor Inhibidor Mulleriano (FIM)', 'AMH', 1),
(252, '90.2.0.06', 'ANTITROMBINA III POR CONCENTRACION', 'ATIII, ANTITROMBINA III,AT3', 'AT3C', 1),
(253, '', 'RAST DE CUCARACHA', 'inmunoglobulina ige especifica para cucaracha', 'CUCARACHA', 1),
(254, '', 'INTERLEUQUINA 4', 'IL 4', 'IL 4', 1),
(255, '90.6.8.23', 'C1Q INHIBIDOR ANTIGENO POR CONCENTRACION', 'C1 Inhibidor Cuantitativo', 'C1QI', 1),
(256, '90.68.3.4', 'RAST MEZCLA DE PESCADO', 'INMNOGLOBULINA E MEZCLA DE PESCADO', 'RMP', 1),
(257, '90.6.4.55', 'ANTICUERPOS SCL 70', 'SCL 70, ATISCL, ESCLERODERMIA ANTICUERPOS,TOPOISOMERASA I ANTICUERPOS', 'SCL70', 1),
(258, '90.3.8.26', 'CUERPOS CETONICOS EN ORINA', 'Cetonas en orina', 'CETO', 1),
(259, '90.2.2.14', 'HEMOPARÁSITOS EXTENDIDO DE GOTA GRUESA', 'Malaria, gota gruesa, Hemoparásitos', 'HEMO', 1),
(260, '', 'VALORACION POR FISIOTERAPEUTA', '', 'VALFISIOT', 1),
(261, '649', 'ACIDOS ORGANICOS EN SUERO', 'ACIDOS ORGANICOS', 'ACORG', 2),
(262, '', ' VALORACION POR MEDICINA GENERAL', ' VALORACION POR MEDICINA GENERAL', 'vmg', 1),
(263, '', 'Antigeno para SARS-CoV-2  en saliva', 'SARS-CoV-2 ', 'SARS-SALV', 1),
(264, '', 'SINDROME DE PRADER WILLI POR FISH', '', 'SPW', 2),
(265, '', 'ELABORACION DE PROFESIOGRAMA', '', 'ELPROF', 1),
(266, '', 'Prueba de esfuerzo ', 'Prueba de esfuerzo', '', 1),
(267, '', 'PRUEBA DE ACIDOS ORGANICOS', '', 'PRUEBAAO', 2),
(268, '90.8.8.32', 'CARGA VIRAL PARA HIV', 'VIH CARGA VIRAL, VIRUS DE INMUNODEFICIENCIA HUMANA CARGA VIRAL', 'HIVCARGA', 1),
(269, '', 'RAST DE FRESA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA FRESA', 'FRESA', 1),
(270, '90.3.0.34', 'OSMOLARIDAD SANGUINEA', 'OSMOLARIDAD DE LA SANGRE', 'OSMS', 1),
(271, '', 'VALORACION OCUPACIONAL', '', 'VALOCUP', 1),
(272, '90.4.7.06', 'PEPTIDO C', 'Péptido Insulino - Conector', 'PEPTIDO C', 1),
(273, '', 'VALORACION MEDICO NEUROLOGICA COMPLETA', '', 'VALNEUCOMP', 1),
(274, '90.4.1.03', 'HORMONA ADRENOCORTICOTROPICA', 'ACTH,Corticotropin', 'ACTH', 1),
(275, '90.7.1.07', 'UROBILINOGENO EN ORINA PARCIAL', '', 'UROBIL', 1),
(276, '90.7.0.03', 'COPROLOGICO POR CONCENTRACION', 'Examen Parasitológico por Concentración', 'COPROPC', 1),
(277, '90.2.2.10', 'CUADRO HEMATICO', 'HEMOGRAMA, CH, HEMOLEUCOGRAMA, HLG, HEMOGRAMA+FD, CBC, HEMOGRAMA TIPO IV, ', 'CH', 1),
(278, '90.6.8.34 .', 'RAST DE TRIGO', 'INMUNOGLOBULINA E ESPECIFICA PARA TRIGO, ', 'RASTTRIGO', 1),
(279, '90.6.9.01', 'CRIOAGLUTININAS', 'Aglutininas frias', 'CRIO', 1),
(280, '', 'VALORACION FONIATRICA', '', 'VALFONIA', 1),
(281, '90.4.7.05', 'INSULINA LIBRE', 'INSULINA LIBRE BIOACTIVA', 'INSULIBRE', 1),
(282, '90.6.8.08', 'ELECTROFORESIS ALCALINA DE HEMOGLOBINA', 'Electroforesis de hemoglobina ', 'ELECHB', 1),
(283, '90.2.2.11', 'HEMATOCRITO', 'HTO, HCT', 'HTO', 1),
(284, '', 'RAST DE PENICILINA V VIA ORAL', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PENICILINA V VIA ORAL', 'PENVVO', 1),
(285, '', 'DOMICILIO GALAPA', '', '', 1),
(286, '', 'INDICE HOMA- IR', 'HOMA, RESISTENCIA A LA INSULINA', 'HOMA', 1),
(287, '90.1.2.13', 'CULTIVO PARA MICOSIS SUPERFICIALES', 'Cultivo de hongos ', 'MICOS', 1),
(288, '90.1.3.09', 'LEISHMANIA IGG', 'ANTICUERPOS CONTRA LEISHMANIA, LEISHMANIA ANTICUERPOS', 'LEISHACS', 1),
(289, '', 'RAST DE TOMATE', 'INMUNOGLOBULINA IGE ESPECIFICA PARA TOMATE', 'TOMATE', 1),
(290, '', 'RAST DE MARISCOS', 'INMUNOGLOBULINA IGE ESPECIFICA PARA MARISCOS', 'MARISCOS', 2),
(291, '90.4.1.05', 'HORMONA FOLICULO ESTIMULANTE', 'FSH', 'FSH', 1),
(292, '', 'AUDIOMETRIA', '', 'AUDIO', 1),
(293, '90.3.8.53', 'CITOQUIMICO DE LIQUIDO SINOVIAL', 'Liquido sinovial examen físico y citoquímico', 'CLS', 1),
(294, '90.6.4.44', 'ANTICUERPOS PLAQUETARIOS', 'PLAQUETARIOS ANTICUERPOS', 'PLAACS', 1),
(295, '90.3.8.14', 'CLORO EN ORINA DE 24 HORAS', 'CL EN 24 HORAS, CLORO EN 24H, CLORUROS EN ORINA', 'CL24H', 1),
(296, '90.4.1.01', 'SOMATOMEDINA C', 'IGF-1, factor I de crecimiento  similar a la insulina', 'IGF1', 1),
(297, '90.2.1.07', 'FRAGILIDAD OSMOTICA', 'Fragilidad Osmótica del Eritrocito', 'FRAO', 1),
(298, '', 'GLOBULINA', 'Proteinograma, relación albumina/globulina ', 'GLO', 1),
(299, '902113', 'HEMOGLOBINA LIBRE EN PLASMA', 'HB  LIBRE EN PLASMA', 'HBLIBRE', 1),
(300, '', 'PRO PSA', 'INDICE DE SALUD PROSTATICO', 'PRO PSA', 1),
(301, '90.2.0.19', 'FACTOR VON WILLEBRAND', 'FvW', 'WILLEBRAND', 1),
(302, '90.6 . 2. 27', 'HEPATITIS DELTA IGM', 'HEPATITIS D IGM', 'HEPDIGM', 1),
(303, '90.4.2.0 7', 'CURVA DE HORMONA DE CRECIMIENTO POS GLUCOSA', 'Crecimiento Hormona (GH) - Prueba de Estímulo con Glucosa, Somatotrófica Hormona - Prueba de Estímulo con Glucosa', 'HGPYPG', 1),
(304, '90.2.2.04', 'ERITROSEDIMENTACION', 'VSG, VELOCIDAD DE SEDIMENTACION GLOBULAR', 'VSG', 1),
(305, '', 'FACTOR DE VON WILLEBRAND, ANTÍGENO', 'FVW AG', '', 1),
(306, '', 'ESPIROMETRIA', '', 'ESPIRO', 1),
(307, '', 'DOMICILIO', '', 'DOM', 1),
(308, '', 'RELACION PSA LIBRE / PSA TOTAL', 'Cociente PSA libre/PSA toal, ratio PSA libre/PSA total', 'PSAL/PSAT', 1),
(309, '908412 ', 'EXOMA COMPLETO TRIO', 'EXOMA', 'ECT', 1),
(310, '90.6.1.33', 'CHAGAS IGM', 'Trypanosoma cruzi ANTICUERPOS Ig M', 'CHAGASM', 1),
(311, '90.3.1.03', 'ACIDO 5 HIDROXI INDOL ACETICO', '5-HIAA', '5-HIAA', 1),
(312, '90.3.8.11', 'CALCIO EN ORINA DE 24 HORAS', 'CALCIURIA, CALCIO EN ORINA', 'CA24H', 1),
(313, '', 'RAST DE PAPA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PAPA', 'PAPA', 1),
(314, '90.3.8.73', 'CALCIO EN ORINA AL AZAR', 'CALCIURIA, CALCIO EN ORINA AISLADA', 'CAOA', 1),
(315, '90.8.8.02', 'HIV-1 GENOTIPO PLUS', 'genotipificacion de hiv,Resistencia de VIH-1 a agentes antirretrovirales', 'HIVGENOTIP', 1),
(316, '676', 'NEUROMIELITIS OPTICA ANTICUERPOS IGG EN SUERO', 'Acuaporina 4, EM óptico-espinal, Enfermedad de Devic, IgG-NMO, Neuritis Óptica por Anticuerpos, Anticuerpos Devic´s, Mielitis Transversa', 'AQ4', 1),
(317, '906834. ', 'RAST DE ACACIA LONGIFOLIA', 'inmunoglobulina ige especifica para acacia longifolia', 'RASTACACIA', 1),
(318, '90.3.8.61', 'RELACIÓN ALBUMINA/GLOBULINA', 'Proporción albúmina/globulina, proporción A/G plasmática', 'ALB/GLO', 1),
(319, '', 'RAST DE MANI', 'inmunoglobulina ige especifica para mani', 'MANI', 1),
(320, '', 'AUDIOMETRIA CLINICA', '', 'AUDIOCLI', 1),
(321, '90.3.8.24', 'CREATININA EN ORINA 24 H', 'CREATINURIA', 'CR24H', 1),
(322, '90.6.9.08', 'COMPLEMENTO C-4', 'C4, FRACCIÓN 4 DEL COMPLEMENTO', 'C4', 1),
(323, '90.3.0.26', 'MICROALBUMINURIA EN ORINA AL  AZAR', 'Albuminuria, albumina en orina', 'MICOA', 1),
(324, '', 'CYTOGEL 6 ML SEGUNDA DOSIS', '', 'CYT6ML2D', 1),
(325, '90.6.6.05', 'MARCADOR TUMORAL  CA 125', 'ca125, MARCADOR DE CÁNCER DE OVARIO', 'CA125', 1),
(326, '906834.   ', 'RAST DE AGUACATE', '', 'AGU', 1),
(327, '90.3.0.36', 'OXALATOS EN ORINA DE 24 HORAS', 'OXALATO EN ORINA, ACIDO OXALICO,Esteres de Acido Oxálico, Sales de Acido Oxálico', 'OXALA24H', 1),
(328, '90.3.8.36', 'FOSFORO EN ORINA DE 24 HORAS', 'FOSFATOS EN ORINA', 'P24H', 1),
(329, '90.3.0.27', 'MICROALBUMINURIA EN ORINA DE 24 HORAS', 'Albuminuria, albumina en orina, ', 'MIC24H', 1),
(330, '91.10.08', 'COOMBS DIRECTO FRACCIONADO', '', 'COOMDF', 1),
(331, '', 'RELACION CALCIO/CREATININA', '', 'CAL/CR', 1),
(332, '', 'CAPACITACION', '', 'CAPACITA', 1),
(333, '90.3.7.07', 'VITAMINA D 1.25 DIHIDROXI', 'CALCIFIDOL, VITAMINA 125, Vitamina D2, 1,25 (OH)2, Vitamina D3, 1,25 (OH)2', 'VIT1.25', 1),
(334, '', 'ECOGRAFIA TRANSABDOMINAL', '', 'ECOTRABD', 1),
(335, '90.6.6.27', 'CROMOGRANINA A', 'NIVELES DE CROMOGRANINA A', 'CROMOGA', 1),
(336, '90.6.4.84', 'LKM-1 ANTICUERPOS', 'ANTICUERPOS LKM1,Microsomales de Hígado y Riñón', 'LKM1', 1),
(337, '906834  .', 'RAST DE ALTERNARIA', 'inmunoglobulina ige especifica para alternaria', 'RASTALTER', 1),
(338, '90.5.7.09', 'ARSENICO EN SANGRE', 'As en sangre', 'AS', 2),
(339, '90.6.0.10', 'BRUCELLA IGG', 'ANTICUERPOS IGG CONTRA BRUCELLA, BRUCELOSIS', 'BRUCIGG', 1),
(340, '906834.   .    ', 'RAST DE AMPICILINA', 'inmunoglobulina ige especifica para ampicilina', 'RASTAMPIC', 1),
(341, '90.6.5.08', 'HLA B27', 'ANTIGENO LEUCOCITARIO HUMANO B27', 'HLAB27', 1),
(342, '90.4.2.01', 'CURVA DE HORMONA DE CRECIMIENTO POS ESTIMULACION', 'Hormona de crecimiento pre y pos Glucagón', 'HGPYPGL', 1),
(343, '90.5.3.01', 'ANFETAMINAS', 'Anfetaminas en orina, anfetaminas cualitativas en orina, AMP', 'ANF', 1),
(344, '90.2.2.24', 'RECUENTO DE RETICULOCITOS', '', 'RETIC', 1),
(345, '', 'PRUEBA PSICOSENSOMETRICA', '', 'PSICOSEN', 1),
(346, '', 'Rickettsia typhi , Anticuerpos IgG', '', 'RTYPG', 1),
(347, '90.4.1.07', 'HORMONA LUTEINIZANTE', 'LH,LUTROPINA', 'LH', 1),
(348, '90.6.0.11', 'BRUCELLA IGM', 'ANTICUERPOS IGM CONTRA BRUCELLA, BRUCELOSIS IGM', 'BRUIGM', 1),
(349, '90.6.1.29', 'TOXOPLASMA IGM', 'Toxo IgM, Toxo M, Anticuerpos IgM contra Toxoplasma, TORCH IgM', 'TOXOM', 1),
(350, '', 'RAST DE ZANAHORIA', '', 'RASTZAN', 1),
(351, '90.3.4.02', 'ALDOLASA', 'ALD, Aldolasa Fructosa Bifostato', 'ALDO', 1),
(352, '90.6.1.27', 'TOXOPLASMA  IgG', 'Toxo G, anticuerpos contra toxoplasma, Torch IgG, toxoplasma anticuerpos IgG, toxoplasma gondii IgG', 'ToxoG', 1),
(353, '90.3 .8.92', 'CURVA DE GLICEMIA DE 5 HORAS', 'PRUEBA DE TOLERANCIA A LA GLUCOSA DE 5 HORAS', 'CG5H', 1),
(354, '90.3.8.72', 'SODIO EN ORINA AL AZAR', 'SODIO URINARIO, NA EN ORINA', 'NAOA', 1),
(355, '', 'RAST DE FUSARIUM MONILIFORME', 'INMUNOGLOBULINA IGE ESPECIFICA PARA FUSARIUM MONILIFORME', 'FUSMONI', 1),
(356, '90.2.0.20', 'FACTOR X', 'Factor Stuart-Power, factor Stuart', 'FACTORX', 1),
(357, '90.3.0.08', 'CATECOLAMINAS EN PLASMA', ' Adrenalina en sangre, Noradrenalina en sangre', 'CATEPLASMA', 1),
(358, '', 'ANTICUERPOS ANTI PM Scl (PM-1)', 'PM 1', '', 1),
(359, '90.3.8.62', 'PROTEINAS EN ORINA DE 24 HORAS', 'Proteinuria, proteínas en orina', 'PRO24H', 1),
(360, '', 'RAST DE UVA', '', 'RASTUV', 1),
(361, '90.6.8.34.	.', 'RAST CARNE DE CERDO', 'inmunoglobulina ige especifica para carne de cerdo', 'CERDO', 1),
(362, '906834.   .', 'RAST DE AMOXACILINA', 'inmunoglobulina ige especifica para amoxacilina', 'RASTAMOX', 1),
(363, '90.3.8.42', 'GLICEMIA PRE Y POS CARGA', 'GLICEMIA BASAL Y POS CARGA, GLICEMIA A Y B, GLUCOSA PRE Y POS', 'GLIPYPC', 1),
(364, '90.6.9.12', 'PREALBUMINA', '', 'PREALB', 1),
(365, '90.2.0.49', 'TIEMPO DE TROMBOPLASTINA', 'PTT,APTT, TIEMPO PARCIAL DE TROMBOPLASTINA, y TPT', 'PTT', 1),
(366, '90.3.1.11', 'ACIDO LACTICO', 'LACTATO EN SANGRE, LACTATO, NIVELES DE ACIDO LACTICO', 'LACTICO', 1),
(367, '90.5.2.13', 'FENITOINA ', ' Difenilidantoína, Epamin, Idantoína, Hidanil, Epilantín, Dilantín', 'FENITOINA', 1),
(368, '', 'CARIOTIPO ALTA RESOLUCION', 'CARIOTIPO BANDEO G ALTA RESOLUCION, ESTUDIO CITOGENETICO ALTA RESOLUCION, CARIOTIPO ', 'ALTARESOL', 1),
(369, '90.3.8.95', 'CREATININA', 'CREA, CREATININA EN SANGRE, CREATININA SERICA, AZOADOS', 'CR', 1),
(370, '', 'Trombocitemia Somatica – Gen CALR - Secuenciacion Completa', 'CALR', '', 1),
(371, '90.5.2.14', 'FENOBARBITAL', 'Comizial, Fenilcal, Gardenale, Luminal, Solfoton,niveles de fenobarbital', 'FENOB', 1),
(372, '90.5.3.12', 'LITIO', 'LITEMIA, NIVELES DE LITIO, LI, VALPROATO DE LITIO', 'LI', 1),
(373, '90.3.4.39', 'TROPONINA T CUANTITATIVA', '', 'TROPO T', 1),
(374, '', 'RAST DE MOSQUITO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA MOSQUITO', 'MOSQUITO', 1),
(375, '90.2.0.23', 'FACTOR XIII', 'FSF FACTOR ESTABILIZANTE DE LA FIBRINA O TIEMPO DE LISIS COÁGULO', 'FACTORXIII', 1),
(376, '90.6.8.34.	 . ', 'RAST  CASPA DE GATO', 'inmunoglobulina ige especifica para  caspa de gato', 'CASGATO', 1),
(377, '90683.4', 'RAST DE APIO', 'inmunoglobulina ige especifica para apio', 'RASTAPIO', 1),
(378, '90.6.8.30', 'IgG SUBCLASES', 'Inmunoglobulina G (G1, G2, G3, G4)', 'IGGSUB', 1),
(379, '', 'COBALTO ', 'COBALTO EN SUERO', 'COBT', 2),
(380, '90.4.0.04', 'RENINA CONCENTRACION', 'RENINA PLASMATICA, NIVELES DE RENINA', 'RENICON', 1),
(381, '', 'TOPIRAMATO', 'TOPAMAX', 'TOPIR', 1),
(382, '90.4.0.05', 'RENINA ACTIVIDAD PLASMATICA', 'renina actividad funcional', 'RENIACTI', 1),
(383, '90.3.8.12', 'CAPACIDAD DE FIJACIÓN DEL HIERRO', 'TIBC, CAPACIDAD DE COMBINACIÓN DEL HIERRO', 'TIBC', 1),
(384, '90..6.8.34', 'RAST DE ACAROS PTERONISSINUS', 'ACAROS D PTERONISSINUS, ACAROS DERMATOFAGOIDE PTERNONISSINUS', 'RASTAPTERO', 1),
(385, '90.6.8.37..', 'KAPPA CADENAS LIVIANAS EN ORINA', 'KAPPA CADENAS LIGERAS EN ORINA', 'KAPLIVORI', 1),
(386, '9.06834', 'RAST DE ASPERGILLUS', 'inmunoglobulina ige especifica para aspergillus', 'RASTASPERG', 1),
(387, '', 'RAST DE POLEN', 'INMUNOGLOBULINA IGE ESPECIFICA PARA POLEN,Rast Test Alergenos: Especificos A  Polenes Arboles y Arbustos', 'POLEN', 1),
(388, '90.2.0.59', 'INHIBIDOR DE FACTOR VIII', 'FACTOR VIII INHIBIDOR', 'INHFACVIII', 1),
(389, '', 'RELACION BUN / CREATININA', 'BUN/CR', 'BUN/CR', 1),
(390, '90.5.7.36.', 'COBRE SERICO', 'CU, COBRE EN SANGRE, COBRE EN SUERO', 'COBRES', 1),
(391, '', 'RAST DE LEVADURAS Y MOHOS', 'INMUNOGLOBULINA IGE ESPECIFICA PARA LEVADURAS Y MOHOS', 'LEVAMOH', 1),
(392, '', 'RAST DE NUEZ', 'INMUNOGLOBULINA IGE ESPECIFICA PARA NUEZ', 'NUEZ', 1),
(393, '90.2.1.01', 'CELULAS L.E.', '', 'L.E.', 1),
(394, '', 'RAST DE LATEX', 'INMUNOGLOBULINA IGE ESPECIFICA PARA LATEX', 'LATEX', 1),
(395, '90.6.2.16', 'EPSTEIN BARR EBNA IgM', 'VIRUS EB ANTIGENOS NUCLEARES ANTICUERPOS IGM', 'EBNAIGM', 1),
(396, '906834 ', 'RAST DE AVISPA POLISTES', 'INMUNOGLOBULINA IGE ESPECIFICA PARA AVISPA POLISTES,VENENO DE AVISPA', 'AVISPOL', 1),
(397, '', 'RAST DE CACAO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CACAO', 'CACAO', 1),
(398, '', 'RAST DE CANDIDA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CANDIDA', 'CANDIDA', 1),
(399, '', 'RAST DE CANGREJO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CANGREJO', 'CANGREJO', 1),
(400, '90.6.2.03', 'ADENOVIRUS ANTICUERPOS IgM', 'ANTICUERPOS IGM PARA ADENOVIRUS', 'ADENOIGM', 1),
(401, '90.4.5.01', 'ANDROSTENEDIONA', '4-Androstenediona, andrógenos.', 'AND', 1),
(402, '90.6.4.25', 'ANTICUERPOS CONTRA INSULINA', '', 'INSULIACS', 1),
(403, '', 'BANDAS OLIGOCLONALES', 'ELECTROFORESIS DE LCR', 'BO', 1),
(404, '90.2.0.51', 'COFACTOR DE RISTOCETINA', 'ACTIVIDAD DEL FACTOR VON WILLEBAND,', 'COFARIST', 1),
(405, '90.3.0.33', 'OSMOLARIDAD URINARIA', 'OSMOLARIDAD EN ORINA', 'OSMOURI', 1),
(406, '90.6.3.25', 'PNEUMOCYSTIS CARINII ANTIGENO', '', 'PNEUM', 1),
(407, '', 'PRECIPITINAS ASPERGILLUS FUMIGATUS', 'PREC', 'PREASP', 1),
(408, '90.3.8.32', 'FOSFATASA ACIDA PROSTATICA', 'FOSFATASA ACIDA FRACCION PROSTATICA,FA PROSTATICA', 'FACPROST', 1),
(409, '', 'INHIBINA A', 'INHIBINA', 'INHIA', 1),
(410, '90.2.0.22', 'FACTOR XII', 'FACTOR DE HAGEMAN', 'FACTORXII', 1),
(411, '', 'FORMATO ADICIONAL OCUPACIONAL', 'FORMATO', '', 1),
(412, '', 'INHIBINA B', 'INHIBINA', 'INHIB', 1),
(413, '90.5.7.06', 'ALCOHOL ETILICO', 'NIVELES DE ALCOHOL, ALCOHOL EN SANGRE', 'ALCOHOL', 1),
(414, '90.5.3.02', 'METANFETAMINAS', 'Metedrina, Desoxyn', 'METANFE', 1),
(415, '90.8.4.11', 'CARIOTIPO EN MEDULA OSEA', 'ESTUDIO CITOGENETICO EN MEDULA OSEA', 'CARMO', 2),
(416, '90.2.0.29', 'PLASMINOGENO ACTIVIDAD', '', 'PLASMAC', 1),
(417, '506', 'OXCARBAZEPINA Y METABOLITOS', 'Trileptal', 'OXC', 1),
(418, '', 'SARCOPTES SCABIEI', '', '', 1),
(419, '502', 'PLOMO EN ORINA DE 24 HORAS', 'PB EN ORINA', 'PBO', 1),
(420, '90.8.4.09', 'CARIOTIPO PARA CROMOSOMA FRAGIL X', '', 'CARCRXFRA', 2),
(421, '90.3.0.35', 'OSTEOCALCINA', 'BPG (Proteina Gla ósea), Glicoproteína G1A', 'OST', 1),
(422, '90.6.4.29', 'ANTICUERPOS JO-1', 'JO-1 ANTICUERPOS', 'JO-1', 1),
(423, '90.2.0.56', 'INHIBIDOR DEL FACTOR IX', 'FACTOR IX INHIBIDOR', 'INHFACIX', 1),
(424, '90.1.3.12', 'LISTERIA ANTICUERPOS', 'LISTERIA SEROTIPIFICACION', 'LISTE', 1),
(425, '', 'u', '', '', 1),
(426, '512', 'OSMOLARIDAD EN ORINA  24 HORAS', '', 'OSM', 1),
(427, '90.6.8.11', 'Electroforesis de proteinas en liquido cefaloraquideo', 'Inmunofijacion en lcr', 'eprotlcr', 1),
(428, '', 'SINDROME DE ANGELMAN', '', 'SANG', 2),
(429, '90.6.4.75', 'GLIADINA IGG', 'GLIADINA ANTICUERPOS IGG', 'GLIADIGG', 1),
(430, '90.6.4.78', 'TRANSGLUTAMINASA IgG', 'ANTITRASNGLUTAMINASA IGG', 'TRANSGIGG', 1),
(431, '90.6.0.40', 'FTA ABS IGG', 'TREPONEMA PALLIDUM IGG', 'FTAABSIG', 1),
(432, '90.3.0.06', 'CAROTENOS', 'BETA CAROTENOS', 'CAROTENOS', 1),
(433, '90.3.4.33', 'PROTOPORFIRINA ERITROCITARIA LIBRE', '', 'PREL', 1),
(434, '90.6.3.03', 'ANTIGENOS BACTERIANOS', 'AG  BACTERIANOS', 'AGBACT', 1),
(435, '90.4.6.01', 'TESTOSTERONA LIBRE', 'TESTOSTERONA L, ANDROGENOS', 'TESTL', 1),
(436, '90.6.0.39', 'FTA ABS ', 'Treponema pallidum absorbido, prueba confirmatoria para sífilis', 'FTA', 1),
(437, '90.6.4.71', 'ENDOMISIO IGA', 'ENDOMESIALES IGA, ANTIENDOMISIO IGA', 'ENDOMIGA', 1),
(438, '90.6.4.72', 'ENDOMISIO  IGG', 'ENDOMESIALES IGG, ANTIENDOMISIO IGG', 'ENDOMIGG', 1),
(439, '90.6.4.80', 'BETA 2 GLICOPROTEINA IGA', 'B2GLICOPROTEINA IGA,B-2-GP1', 'B2GLIIGA', 1),
(440, '90.1.5.02', 'CLOSTRIDIUM DIFFICILE TOXINA A Y B', 'TOXINA A Y B DE CLOSTRIDIUM,CLOSTRIDIUM DIFFICILE', 'CLDIFTOXAB', 1),
(441, '575', 'UREAPLASMA UREALYTICUM ANTICUERPOS IgG', '', 'UREURIGG', 1),
(442, '905736', 'COBRE EN PLASMA', 'COBRE SERICO, CU', 'COB', 2),
(443, '', 'RAST DE MORA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA MORA', 'MORA', 1),
(444, '90.8.8.33', 'GENOTIPIFICACION PARA HEPATITIS C', 'HEPATITIS C GENOTIPIFICACION', 'GENHEPC', 1),
(445, '90.4.7.10', 'PROTEINA TRANSPORTADORA DE SOMATOMEDINA', 'nsulina como Proteína Fijadora de Factor de Crecimiento (IGFBP3), igfbp3', 'IGFBP3', 1),
(446, '', 'LEVODOPA', 'L-DOPA', 'LEVO', 1),
(447, '', 'RAST BETULA VERRUCOSA (ABEDUL), ANTICUERPOS IGE ESPECIFICA', '', '', 1),
(448, '90.4.9.01', 'GLOBULINA TRANSPORTADORA TIROXINA', 'PROTEINA TRANSPORTADORA DE TIROXINA,GLOBULINA FIJADORA DE TIROXINA,TBG', 'TBG', 1),
(449, '90.6.3.21', 'INFLUENZA A H1N1', 'H1N1', 'INFA', 1),
(450, '90.5.5.03', 'TACROLIMUS', ' FK-506,Fujimycin, NIVELES DE TACROLIMUS', 'TACROL', 1),
(451, '90.6.0.36', 'MYCOPLASMA PNEUMONIAE ACS IgM', '', 'MYCOIGM', 1),
(452, '90.6.2.48', 'VARICELA ZOSTER IgM', 'VARICELA IGM, ', 'VARZOSIGM', 1),
(453, '908407', 'CARIOTIPO BANDEO R DE ALTA RESOLUCION', '', '', 1),
(454, '90.6.337', 'HISTOPLASMA GALACTOMANANO ANTIGENO', 'HISTOPLASMA AG', 'HGALACT', 1),
(455, '90.3.7.02', 'VITAMINA B1', 'TIAMINA', 'VITB1', 1),
(456, '90.6.6.21', 'CALCITONINA', '', 'CALCITO', 1),
(457, '90.5.7.49', 'PRIMIDONA', '', 'PRIM', 1),
(458, '90.8.4.27', 'PROTROMBINA MUTACION G20210A', 'MUTACION G20210A DE LA PROTROMBINA,Mutación del Gen de la Protrombina (G20210A) ', 'G20210A', 1),
(459, '90.6.8.22', 'HISTAMINA EN PLASMA', '4-(2-aminoétil)-1,3-diazol en plasma', 'HIST', 1),
(460, '90.3.7.09', 'VITAMINA C (ACIDO ASCORBICO)', 'ACIDO ASCORBICO', 'VITC', 1),
(461, '90.3.7.01', 'VITAMINA A', 'RETINOL', 'VITA', 1),
(462, '682', 'FIBROSIS QUISTICA GEN CFTR, DELECION/DUPLICACION', 'Gen CFTR, Deleción / Duplicación,Fibrosis Quística', 'FIBRQ', 1),
(463, '', 'ESTUDIO DE HERMANDAD COMPLETA', 'PRUEBA DE HERMANDAD ', 'ESTHERM', 2),
(464, '560', 'HERPES II IGG EN LCR', 'HERPES ', 'HIIIGG', 1),
(465, '557', 'HERPES II IGM EN LCR', '', 'HERIIIGM', 1),
(466, '90.6.6.24', 'GASTRINA', '', 'GAST', 1),
(467, '90.2.0.46', 'TIEMPO DE SANGRIA', 'Método de Duke', 'TS', 1),
(468, '', 'LIPIDOS TOTALES', '', 'LIPIDOST', 1),
(469, '90.5.3.08', 'FENCICLIDINA', 'Polvo de ángel, PCP', 'FENC', 1),
(470, '906012', 'BRUCELLA ROSA DE BENGALA', 'ROSA DE BENGALA PARA BRUCELLA, PRUIEBA RAPIDA PARA BRUCELLOSIS', 'ROSABENGA', 1),
(471, '90.2.1.09', 'GLUCOSA 6 FOSFATO DESHIDROGENASA', 'G-6-PDH', 'G-6-PDH', 1),
(472, '90.6.3.36', 'GIARDIA LAMBLIA ANTIGENO', '', 'GIARDIAG', 1),
(473, '90.3.4.31', 'LIPOPROTEINA A Lp', 'Lipoproteína Pequeña, Lp(a)', 'LALP', 1),
(474, '', 'RAST DE LANA DE OVEJA ', '', 'RLO', 1),
(475, '', 'PREECLAMPSIA TEST', 'CRIBADO DE  LA PRE ECLAMPSIA-PlGF- factor de crecimiento placentario', 'PECLAM', 1),
(476, '', 'ESTUDIO GENETICO PARA ENFERMEDAD DE HUNTINGTON', 'Baile De San Vito,Corea De Huntington', 'GENHUN', 1),
(477, '', 'CULTIVO DE MICOSIS PROFUNDA', '', '', 1),
(478, '', 'ESTUDIO DE ENFERMEDAD MINIMA RESIDUAL EN MEDULA OSEA', ' ', 'ESTMO', 1),
(479, '90.6.2.13', 'EPSTEIN BARR EBNA IgG ', 'VIRUS EB ANTIGENOS NUCLEARES IGG', 'EBNAG', 1),
(480, '90.2.1.10', 'HEMOGLOBINA A 2', 'HBA2,HEMOGLOBINA A2 EN COLUMNA', 'HBA2', 1),
(481, '90.2.0.43', 'TIEMPO DE COAGULACION', 'Tiempo de coagulación de Lee-White.', 'TCOA', 1),
(482, '90.8.3.14.', 'CISTINA EN SUERO', '', 'CISSU', 1),
(483, '90.3.4.28', 'HEMOSIDERINA EN ORINA', 'Hemoside ', 'HEM', 1),
(484, '90.6.2.14', 'EPSTEIN BARR ANTIGENOS TEMPRANOS IGG', '', 'TEMPRANOIG', 1),
(485, '', 'EPSTEIN BARR ANTIGENOS TEMPRANO IGM', '', 'TEMPRANOIM', 1),
(486, '90.4.0.02', 'ENZIMA CONVERTIDORA DE ANGIOTENSINA', 'ECA', 'ENZANG', 1),
(487, '90.6.1.10', 'ECHINOCOCCUS GRANULOSUS ANTICUERPOS', 'ECHINOCOCCUS GRANULOSUS IGG', 'EGIGG', 1),
(488, '90.4.8.08', 'DEHIDROEPINANDROSTERONA NO SULFATO', 'DHEA,DEHIDROEPINANDROSTERONA ', 'DHEA', 1),
(489, '90.6.4.26', 'ANTICUERPOS ISLOTES PANCREATICOS', 'ICA,slotes Langerhans (células Beta), Anticuerpos', 'ICA', 1),
(490, '90.6.4.83', 'ACIDO GLUTAMICO DECARBOXILASA ANTICUERPOS GAD', 'ANTIGAD', 'GAD', 1),
(491, '90.6.8.34', 'RAST DE LECHE DE VACA', 'Alérgeno de leche, IgE especifica de leche de vaca, prueba de alergias a la leche de vaca.', 'RASLEC', 1),
(492, '', 'CRIPTOCOCO ANTICUERPOS', '', 'CRIPAC', 1),
(493, '90.6.0.17', 'CHLAMYDIA PSITTACCI ANTICUERPOS Ig M', 'CHLAMYDIA PSITTACCI IGM', 'CHLAPSIGM', 1),
(494, '90.3.0.13.', 'ACIDO ASCORBICO EN SEMEN', 'ESPERMOGRAMA CON BIOQUIMICA', 'AASCOSEMEN', 1),
(495, '90.5.7.31.', 'MERCURIO EN ORINA 24H', 'Hg en Orina de 24 horas', 'HGORINA', 1),
(496, '90.6.3.33', 'ASPERGILLUS GALACTOMANANO ANTIGENO', 'GALACTOMANANO PARA ASPERGILLUS,Detección de Antígenos de Aspergillus Solubles en Suero', 'ASPGALACTO', 1),
(497, '90.6.2.38', 'PAPERAS Acs IgG', 'PAROTIDITIS IGG', 'PAPEIGG', 1),
(498, '90.4.5.07', 'ESTRONA', '', 'ESTRONA', 1),
(499, '', 'RAST DE PIÑA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PIÑA', 'PIÑA', 1),
(500, '90.5.7.15', 'CAFEINA', '', 'CAF', 1),
(501, '90.5.2.10', 'FENITOINA LIBRE', 'EPAMIN LIBRE,CUMATIL, HIDANIL DEFENILHIDANTOINA LIBRES', 'FENLIBRE', 1),
(502, '', 'MANGANESO EN SANGRE TOTAL', '', 'MANGASANG', 1),
(503, '', 'SINDROME X FRAGIL TAMIZAJE EXPANSIÓN DETRIPLETES', 'SINDROME X FRAGIL', 'SINDXFRAGI', 2),
(504, '90.6.8.06', 'C1 Q INMUNOCOMPLEJO', 'C1Q COMPLEMENTO', 'C1Q', 1),
(505, '90.6.0.06', 'BORDETELLA PERTUSSIS IGM', 'BORDETELLA PERTUSSIS ACS IGM', 'BORDIGM', 1),
(506, '90.2.0.48', 'TIEMPO DE TROMBINA', 'TT', 'TT', 1),
(507, '', 'BICARBONATO EN ORINA', 'CO3H-', 'BICAR', 1),
(508, '', 'BABESIA MICROTI IGG IGM', 'BABESIA MICROTI ANTICUERPOS', 'BAB', 1),
(509, '90.2.0.31', 'PRODUCTOS DE DEGRADACION DEL FIBRINOGENO', '', 'PDF', 1),
(510, '90.6.4.23', 'FOSFOLIPIDOS IGM', 'ANTIFOSFOLIPIDOS IGM', 'FOSIGM', 1),
(511, '', 'DISTROFIA MUSCULAR DUCHENE Y BECKER PANEL 1 Y 2  98% DELECCIONES', 'DISTROFIA MUSCULAR', 'DISTMUSC', 1),
(512, '90.6.2.46', 'SARAMPION IGM', '', 'SARIGM', 1),
(513, '90.6.0.09', 'BORRELIA BURGDORFERI ACS IgM ', 'enfermedad de Lyme,garrapatas , borreliosis', 'BORRIGM', 1),
(514, '', 'FOSFOLIPIDOS IGM PERFIL COMPLETO', 'Beta 2 Glicoproteina 1, Fosfatidil serina, Fosfatidil Inositol y Acido Fosfatídico,cardiolipina', 'FIGMCOMPL', 1),
(515, '', 'ALERGIAS ALIMENTARIAS IGG CANDIDA', '', 'ALERIGCAND', 2),
(516, '', 'ANTIGENOS SOLUBLES HEPATICOS HIGADO PANCREAS ANTICUERPOS', 'AG SOLUBLES HEPATICOS', 'AGHEP', 1),
(517, '90.6.2.59.', 'PARVOVIRUS IGM', 'arvovirus B19, Anticuerpos IgM', 'PVVIGM', 1),
(518, '', 'RAST DE LECHUGA', '', '', 1),
(519, '90 .6.4 . 11', 'CELULAS PARIETALES ACS', 'PARIETALES ANTICUERPOS,Celulas Parietales Gastricas,  Anticuerpos     ', 'PARIETALES', 1),
(520, '90.2.0.07', 'ANTITROMBINA III FUNCIONAL', 'AT3, ATIII', 'AT3', 1),
(521, '90.5.6.03', 'DIGOXINA', 'Anocar, Cardioreg, Lanocor, Lanoxin, Lenoxin', 'DIGX', 1),
(522, '90.4.9.27', 'T3 REVERSA', 'triyodotironina reversa', 'T3R', 1),
(523, '90.3.8.34', 'FOSFATASA ALCALINA FRACCION OSEA', 'FA OSEA, ', 'FALPOSEA', 1),
(524, '90.6.0.34', 'MYCOPLASMA PNEUMONIAE IgG', 'ANTICUERPOS IGG CONTRA MYCOPLASMA', 'MYCOPNEIGG', 1),
(525, '90.6.2.58', 'PAPERAS ACS IgM', 'PAROTIDITIS IGM, ANTICUERPOS CONTRA PAPERAS', 'PAPEIGM', 1),
(526, '90.6.2.59', 'PARVOVIRUS B19 IgG', ' Parvovirus B19, Anticuerpos IgG', 'PVVIGG', 1),
(527, '90.4.7.08', 'SOMATOSTATINA', '', 'SOM', 1),
(528, '90.4.7.03', 'CURVA DE INSULINA 5 MUESTRAS EN 3 HORAS', '', 'CURINS5', 1),
(529, '90.4.8.02', 'ALDOSTERONA EN ORINA 24 HORAS', '', 'ALD', 1),
(530, '', 'VARICELA ZOSTER IGM EN LCR', '', 'VZLCR', 1),
(531, '', 'PANEL DE EVALUACION BASICA BAP', '', 'BAP', 2),
(532, '90.4.7.09', 'ADIPONECTINA', '', 'ADP', 1),
(533, '90.6.7.11', 'LINFOCITOS B CD19', 'LINFOCITOS B', 'LINBCD19', 1),
(534, '90.6.8.23..', 'C1Q INHIBIDOR ESTERASA FUNCIONAL', 'C1 ESTERASA FUNCIONAL', 'C1QEF', 1),
(535, '90.8.4.26', 'MUTACIÓN C677T (MTHFR) METILENTETRAHIDROFOLATO REDUCTASA', 'METILENTETRAHIDROFOLATO,MTHFR,MUTACION C677T', 'MTHFR', 1),
(536, '90.3.0.31', 'MIOGLOBINA EN SUERO', '', 'MIOSU', 1),
(537, '', 'RAST DE PLUMAS DE GANZO (OCA)', 'INMUNOGLOBULINA IGE ESPECIFICA PARA OCA', 'OCA', 1),
(538, '90.3.1.06', 'ACIDO FOLICO EN ERITROCITOS', 'Folato, N5-metil-tetrahidrofolato', 'AFOLER', 1),
(539, '90.3.8.41', 'GLICEMIA', 'GLUCOSA, GLICEMIA BASAL, GLICEMIA A, GLUSEMIA', 'GLIC', 1),
(540, '90.6.0.08', 'BORRELIA BURGDORFERI ACS IGG', 'ENFERMEDAD DE LYME, BRUCELLOSIS IGG, ENFERMEDAD DE LA GARRAPATA', 'BORRIGG', 1),
(541, '90.5.7.61', 'FENOL EN ORINA', 'BENCENO,FENOLES URINARIOS', 'FENOL', 1),
(542, '', 'RAST DE QUESO (CHEDDAR)', 'INMUNOGLOBULINA IGE ESPECIFICA PARA QUESO ', 'CHEDDAR', 1),
(543, '660', 'MARIHUANA CUANTITATIVA EN ORINA', 'THC CUANTITATIVA EN ORINA, CANABINOIDES CUANTITATIVOS EN ORINA,TETRAHIDROCANABINOL', 'THCCUNORI', 1),
(544, '903440', 'TRIPTASA SERICA', 'TRIPTASA', 'TRIP', 1),
(545, '', 'stein Barr Virus Antigeno de Cápside (VCA) en LCR, Anticuerpos IgG', '', '', 1),
(546, '', 'LITTLE BABY', 'Determinacion sexo', 'sex', 2),
(547, '', 'SINDROME DE NOONAN PTPN11', 'Lentiginosis Cardiomiopática, Locus 12q24.1, Síndrome de Lentigines Múltiples', 'SINOON', 1),
(548, '90.3.4.35', 'SEROTONINA EN ORINA DE 24 HORAS', '5-Hidroxitritamina', 'SER', 1),
(549, '', 'SIROLIMUS', 'RIPAMICINA,Rapamune', 'SIROL', 1),
(550, '', 'VIRUS ZIKA, ANTICUERPOS IGM', '', '', 1),
(551, '90.3.0.67', 'METANEFRINA LIBRES EN PLASMA', 'Metanefrina Libre ,Normetanefrina Libre', 'METALIBPLA', 1),
(552, '', 'ESTUDIO DE MICROARREGLOS HD AFFYMETRIX', '', 'HDAFFY', 2),
(553, '90.6.4.13', 'ANTICUERPOS ANTICENTROMERO', 'CENTROMERO ANTICUERPOS', 'CENTROM', 1),
(554, '90.4.3.01', 'CORTISOL PRE Y POST ESTIMULO', 'cortisol pre y pos ACTH', 'CPYPACTH', 2),
(555, '', 'INMUNOFENOTIPO', 'Clasificación de Leucemias por Citometría,Citometria De Flujo En Sangre Periferica', 'INMF', 1),
(556, '90.3.0.13..', 'ACIDO CITRICO EN SEMEN', 'ESPERMOGRAMA CON BIOQUIMICA', 'ACITRICOSE', 1),
(557, '942', 'HOMOCISTEINA EN ORINA', 'Homocisteinuria', 'HOMOC', 1),
(558, '90.6.3.04', 'ANTIGENOS FEBRILES', 'La reacción de Widal, prueba de Widal, Weil Felix, seroaglutinaciones', 'AFEB', 1),
(559, '90.3.0.41', 'PORFOBILINOGENO EN ORINA 24 H', 'PBG 24 horas', 'PORFOB24H', 1),
(560, '762', 'TAMIZAJE METABOLICO', '', 'TAMET', 1),
(561, '90.6.8.12', 'ELECTROFORESIS DE PROTEINAS', 'Electroforesis de proteinas en suero,  EFP', 'ELECP    ', 1),
(562, '90.3.8.43', 'GLICEMIA PRE Y POS DESAYUNO', 'GLICEMIA PRE Y POS PRANDIAL, GLICEMIA PRE Y POS PRANDIAL SIN CARGA, GLUCOSA PRE Y POS, GLICEMIA A Y B, AZUCAR EN SANGRE PRE Y POS', 'GLIPYPD', 1),
(563, '90.4.8.11', 'HIDROXI CORTICOSTEROIDES 17', '17 HIDROXI CORTICOSTEROIDES,17-OHCS, Cromógeno Porter-Silver', '17HIDRCORT', 1),
(564, '903705', 'VITAMINA B6', 'Piridoxal 5-fosfato (PLP) , Piridoxina, PALP (Piridoxal 5-fosfato), Piridoxal 5-fosfato (PALP), Piridoxal Fosfato', 'VITB6', 1),
(565, '90.3.0.32', 'N TELOPEPTIDO EN SUERO', 'TELOPEPTIDO N  SERICO', 'NTELOPSU', 1),
(566, '90.5.7.36', 'PLOMO EN SANGRE', 'PB, PLUMBEMIA, NIVELES DE PLOMO EN SANGRE, BLL', 'PB', 1),
(567, '', 'ESTUDIO DE MICROARREGLOS ONCOSCAN ESTUDIOS EN CÁNCER', '', 'ONCOSCAN', 2),
(568, '903032', 'N TELOPEPTIDO EN ORINA', 'TELOPEPTIDO N EN ORINA,NTx, NTX-Telopéptido Orina', 'NTELOORI', 1),
(569, '90.8.3.16', 'FENILALANINA', '', 'FENIL', 1),
(570, '', 'TETANO TOXOIDE ANTICUERPOS IGG', '', 'TEIGG', 1),
(571, '90.5.7.58.', 'ACIDO METIL HIPURICO', 'Xileno', 'METILHIP', 1),
(572, '90.8.3.42', 'MUCOPOLISACARIDOS', 'glucosaminoglicanos (GAGs)', 'MUCOP', 1),
(573, '90.6.1.39', 'SACCHAROMYCES CEREVISIAE IgG', 'ASCAS IGG', 'ASCASG', 1),
(574, '90.5.5.05', 'EVEROLIMUS', 'Afinitor, Evero, Zortress', 'EVERL', 1),
(575, '90.6.4.36', 'ANTICUERPOS ANTI MUSCULO LISO', 'ASMA, ASMAS, MUSCULO LISO ANTICUERPOS', 'ASMA', 1),
(576, '90.8.8.20', 'TOXOPLASMA POR PCR', 'TOXOPLASMA GONDII POR PCR, TOXOPLASMA EN LIQUIDO AMNIOTICO', 'TOXOPCR', 1),
(577, '90.8.8.20.', 'TOXOPLASMA EN LIQUIDO AMNIOTICO', '', 'TOXOLA', 1);
INSERT INTO `examenes` (`id_examenes`, `codigo_cups`, `nombre_examen`, `nombre_alterno`, `abreviatura`, `estado`) VALUES
(578, '90.3 12', 'ACIDO PIRUVICO', 'Piruvato', 'ACPIRU', 1),
(579, '656', 'A200', 'Análisis de intolerancias alimentarias, Prueba de tolerancia alimentaria', 'A200', 1),
(580, '90.5.2.04', 'BARBITURICOS', 'Barbituricos cualitativos en orina, barbituricos en orina', 'barb', 1),
(581, '90.4.7.01', 'GLUCAGON', '', 'GLUCAG', 1),
(582, '90.6.3.19', 'HEPATITIS DELTA ANTIGENO VIRAL', 'ANTIGENO HEPATITIS DELTA,VHD', 'HDELAG', 1),
(583, '', 'CITOMEGALOVIRUS AVIDEZ ANTICUERPOS  IGG', 'CITOMEGALOVIRUS AVIDEZ', 'CMVAVID', 1),
(584, '528', 'APOLIPOPROTEINA E', '', 'APOE', 1),
(585, '90.6.1.07', 'CISTICERCO IGG', '', 'CISIGG', 1),
(586, '', 'CITOMEGALOVIRUS DNA DETECTOR', 'CMV DETECTOR', 'CMVDetect', 1),
(587, ' 90.6.834', 'RAST DE COCO', 'ALERGENO DE COCO', 'RCOCO', 1),
(588, '90.6.1.18', 'HISTOPLASMA CAPSULATUM ANTICUERPOS', '', 'HISCAPACS', 1),
(589, '732', 'CLONAZEPAM (RIVOTRIL)', 'Clonagin, Diocam, Klonopin, Ravotril, clonacepam', 'RIVOTRIL', 1),
(590, '90.6.4.31', 'MEMBRANA BASAL GLOMERULAR ACS IgG', 'ANTICUERPOS CONTRA MEMBRANA BASAL,GMB,Anti GBM, Síndrome de Goodpasture', 'MEMBAGLO', 1),
(591, '', 'COTININA METABOLITO DE LA NICOTINA', 'NIVELES DE NICOTINA SERICOS,COTININA METABOLITO DE LA NICOTINA', 'NICOSU', 1),
(592, '', 'RAST DE PLUMAS DE PALOMA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PLUMAS DE PALOMA', 'PLUPALOMA', 1),
(593, '90.6.3.01', 'ADENOVIRUS EN MATERIA FECAL', 'ADENOVIRUS ANTIGENO', 'ADENOMF', 1),
(594, '90.3.1.04', 'ACIDO DELTA AMINOLEVULINICO ORINA 24H', 'ALA, Ácido Aminolevulínico, Delta-ALA', 'ALA', 1),
(595, '', 'RAST DE RATON', 'INMUNOGLOBULINA IGE ESPECIFICA PARA RATON', 'RATON', 1),
(596, '', 'RAST DE NARANJA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA NARANJA', 'NARANJA', 1),
(597, '90.6.7.11.', 'LINFOCITOS B CD 20', 'LINFOCITOS B,CD20,Linfocitos CD19/CD20', 'CD20', 1),
(598, '', 'RAST DE SALMON', 'INMUNOGLOBULINA IGE ESPECIFICA PARA SALMON', 'SALMON', 1),
(599, '90.5.7.58..', 'TOLUENO EN SANGRE', '', 'TOLUENOS', 1),
(600, '90.5.7.27', 'BAZUCO EN ORINA', 'PASTA DE COCAINA,BASE DE COCAINA', 'BAZUCO', 1),
(601, '90.3.0.01', 'ALFA 2 MACROGLOBULINA', '', 'ALFA2MA', 1),
(602, '', 'RAST DE RHIZOPUS', 'INMUNOGLOBULINA IGE ESPECIFICA PARA RHIZOPUS', 'RHIZOPUS', 1),
(603, '', 'SÍNDROME DE VON HIPPEL', 'Síndrome VHL, Angiomatosis Retiniana, Angiofacomatosis retiniana y cerebelosa, Angiomatosis Familiar Cerebeloretinal', 'SCOHOP', 1),
(604, '745', 'FTA-ABS EN LCR', 'TREPONEMA PALLIDUM EN LCR', 'FTAABSLCR', 1),
(605, '90.6.8.50', 'PRESEPSINA', '', 'PRSE', 1),
(606, '90.3.0.59', 'METANEFRINAS FRACCIONADAS ORINA 24 HORAS', 'Normetanefrina Metanefrina', 'METAF24H', 1),
(607, '', 'RAST DE ROBLE', 'INMUNOGLOBULINA IGE ESPECIFICA PARA ROBLE', 'ROBLE', 1),
(608, '', 'PANEL DE SECUENCIACIÓN DE SIGUIENTE GENERACIÓN PARA DISTROFIAS MUSCULARES, MIOPATIAS Y POLI NEUROPATIAS', 'MIOPATIAS, POLI NEUROPATIAS, DISTROFIA MUSCULAR', 'NGS', 1),
(609, '', 'PRE ALBUMINA', '', 'PRE ALB', 1),
(610, '90.8.3.43', 'ACIDOS ORGANICOS DE CADENA CORTA Y MEDIANA EN ORINA', '', 'AORCCYM', 1),
(611, '', 'ACIDO TRANSMUCONICO', 'ACIDO T,T MUCONICO', 'TRANSMUCO', 1),
(612, '', 'RAST DE CEBADA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CEBADA', 'CEBADA', 1),
(613, '90.2.1.04', 'DIMERO D', 'D-Dímero, D-D', 'DIMERO', 1),
(614, '90.3.0.38', 'PORFIRINAS ', 'Uroporfirinas,Coproporfirinas', 'porf', 1),
(615, '', 'RAST DE MANZANA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA', 'MANZANA', 1),
(616, '', 'VARICELA ZOSTER IGG EN LCR', 'Herpes Zoster Virus, Anticuerpos IgG, VZV anticuerpos', 'VZLCRG', 1),
(617, '', 'RAST DE PLUMAS DE PATO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PLUMAS DE PATO', 'PLPATO', 1),
(618, '', 'RAST DE PLUMAS DE PERIQUITO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PLUMAS DE PERIQUITO', 'PERIQUITO', 1),
(619, '', 'RAST DE PLUMAS DE POLLO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PLUMAS DE POLLO', 'PLPOLLO', 1),
(620, '', 'RAST DE CEFALOSPORINAS', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CEFALOSPORINAS', 'CEFALOSPOR', 1),
(621, '', 'RAST DE CENTENO SILVESTRE', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CENTENO SILVESTRE', 'CENTENOSIL', 1),
(622, '', 'RAST DE COLORANTE AMARILLO', 'TARTRAZINA, INMUNOGLOBULINA IGE ESPECIFICA PARA COLORANTE AMARILLO', 'AMARILLO', 1),
(623, '', 'RAST DE EPITELIO DE CABALLO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CABALLO', 'CABALLO', 1),
(624, '', 'RAST DE EPITELIO DE CONEJO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CONEJO', 'CONEJO', 1),
(625, '', 'RAST DE EPITELIO DE HAMSTER', 'INMUNOGLOBULINA IGE ESPECIFICA PARA HAMSTER', 'HAMSTER', 1),
(626, '', 'RAST DE ESPINACA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA ESPINACA', 'ESPINACA', 1),
(627, '', 'RAST DE HORMIGA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA HORMIGA', 'HORMIGA', 1),
(628, '', 'RAST DE MUCOR RACEMOSUS', '', 'MUCORAC', 1),
(629, '', 'RAST DE PASTO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA PASTO, JUNQUILLO COMÚN', 'PASTO', 1),
(630, '90.6.4.68', 'ACETILCOLINA RECEPTORES ACS FIJADORES', '', 'ACETILFIJA', 1),
(631, '90.6.4.69', 'ACETILCOLINA RECEPTORES ACS MODULADORES', 'AChRM', 'ACTILMOD', 1),
(632, '90.8.8.21', 'VARICELA HERPES ZOSTER POR PCR', 'Herpes zoster por PCR', 'HZPCR', 1),
(633, '90.8.6.10', 'CARNITINA EVALUACION', 'CARNITINA TOTAL', 'CAREVAL', 1),
(634, '', 'FACTOR VON WILLEBRAND MULTIMEROS', 'FVW Multímeros', 'FCWMULT', 1),
(635, '90.5.7.62', 'ACIDO HIPURICO', '', 'HIPU', 1),
(636, '', 'Rickettsia typhi, Anticuerpos IgM', '', 'RYYPM', 1),
(637, '90.6.8.34..', 'RAST ALBUMINA SUERO BOVINO', '', 'RASB', 1),
(638, '90.8.3.08', 'ACIDO OROTICO', 'Ácido Pirimidinecarboxílico, Aciduria Orótica Hereditaria, Deficiencia de Ornitina Transcarbamilasa, Deficiencia de Uridina Monofosfato', 'OROTICO', 1),
(639, '', 'TOXOPLASMA IGM EN LCR', '', 'TXMLCR', 1),
(640, '', 'TOXOPLASMA IGG EN LCR', '', 'TXGLCR', 1),
(641, '', 'TESTOSTERONA BIODISPONIBLE', '', 'TESTBIO', 1),
(642, '90.5.6.07', 'TEOFILINA', 'Aminofilina', 'TEO', 1),
(643, '90.5.7.21', 'CIANURO', 'CIANURO EN SANGRE', 'CIANURO', 1),
(644, '90.6.8.25', 'INMUNOFIJACION EN SUERO', 'INMUNOELECTROFORESIS, INMUNOFIJACION DE PROTEINAS SERICAS', 'INMUSU', 1),
(645, '', 'SINDROME DE PRADER WILLI ANGELMAN POR MLPA', '', 'PWILL', 1),
(646, '', 'ANDROSTERONA', '', 'ANDROSTE', 1),
(647, '90.3.1.05', 'ACIDO FOLICO', 'Folatos, niveles de acido folico, perfil de anemia, N5-metil-tetrahidrofolato, Vitamina B9', 'ACFOL', 1),
(648, '618', 'C2  FRACCION DEL COMPLEMENTO', 'C2', 'C2C', 1),
(649, '90.8.3.29', 'ACIDOS GRASOS DE CADENA MUY LARGA EN SUERO', 'AGCML', 'GRASOSLARG', 1),
(650, '90.3.6.03', 'CALCIO', 'CA, CALCIO SERICO,CALCEMIA, IONO GRAMA', 'CA', 1),
(651, '', 'ANTICUERPOS ANTIFOSFOLIPASA A2', '', 'FA2ACS', 1),
(652, '90.6.4.35', 'ANTICUERPOS MUSCULO ESTRIADO', '', 'ESTRIADO', 1),
(653, '', 'ACIDOS ORGANICOS CUANTITATIVOS EN ORINA PANEL COMPLETO', '', 'ORGPANEL', 1),
(654, '90.8.6.09', 'ACILCARNITINA CUANTITATIVA', 'ACILCARNITIVA EN PLASMA O SUERO', 'ACILCA', 1),
(655, '90.3.4.07', 'ALFA 1 GLICOPROTEINA ACIDA ', 'UROMUCOIDE', 'A1GLIACI', 1),
(656, '90.8.3.34', 'ALFA GALACTOSIDASA A', '', 'ALFAGA', 1),
(657, '', 'CHLAMYDIA PNEUMONIAE IgM', '', 'CHLPNEIGM', 1),
(658, '90.3.6.01', 'ALUMINIO EN ORINA DE 24 HORAS', 'AL EN ORINA', 'AL24H', 1),
(659, '90.6.1.13', 'AMEBA HISTOLITICA ANTICUERPOS IGG', 'Entamoeba histolytica, Anticuerpos IgG', 'AMEBA', 1),
(660, '', 'GASTOS LOGISTICOS', 'GASTO', 'GL', 1),
(661, '90.6.5.15', 'PRA Clase I - II Cualitativo      ', 'Panel de Anticuerpos Reactivos Clase I - II', 'PRAICUALI', 1),
(662, '90.6.5.16', 'PRA ClASE I CUANTITATIVOS', 'Panel de Anticuerpos Reactivos Clase I', 'PRAICUANT', 1),
(663, '90.8.3.30', 'ARILSULFATASA A EN SUERO', '', 'ARILSSU', 1),
(664, '90.6.1.40', 'RICKETTSIA THYFI IGG', '', 'RTIGG', 1),
(665, '90.6.5.16.', 'ANTICUERPOS PRA CLASE II CUANTITATIVO', ' Anticuerpos Reactivos Clase II', 'PRAIICUANT', 1),
(666, '90.6.6.03', 'MARCADOR TUMORAL  CEA', 'CEA, ACE, ANTIGENO CARCINOEMBRIONARIO', 'CEA', 1),
(667, '', 'ANTIMAG AUTOANTICUERPOS', 'Glicoproteína Asociada a La Mielina Ac IgM (MAG)   ', 'ANTIMAG', 1),
(668, '90 .6.0.4 5', 'BARTONELLA HENSELAE Acs IgG', '', 'BARTOHIGG', 1),
(669, '', 'BETA HIDROXIBUTIRATO', '3-Hidroxibutirato', 'BHIBUT', 1),
(670, '90.5.3.04', 'ANTIDEPRESIVOS TRICICLICOS CUALITATIVOS', '', 'TRICLIC', 1),
(671, '90.6.0.05', 'BORDETELLA PERTUSSIS ACS IgG', 'TOSFERINA', 'BOPERIGG', 1),
(672, '', 'BRCA PLUS  (18 genes panel   3 genes MLPA)', '', 'MLPA', 1),
(673, '', 'PROTEINA BASICA DE LA MIELINA EN L.C.R', '', 'pbmlcr', 1),
(674, '', 'PERSONA ADICIONAL (SE TIENE PERFIL MATERNO, OTRO P. PADRE CON HIJO)', '', '', 1),
(675, '90.3.7.06.1', 'VITAMINA D 25  FRACCIONADA (D2-D3) ', 'VITAMINA D3, CALCIFEROLVITD2-3, 25-OHD2 - Ergocalciferol, 25-OHD3 - Colecalciferol', 'VITD2-D3', 1),
(676, '90.5.7.39', 'MORFINA', 'NIVELES DE MORFINA EN ORINA', 'MORFINA', 1),
(677, '', 'SINDROME SOTOS NSD1 SECUENCIACION', 'Gigantismo Cerebral', 'SINSOTO', 1),
(678, '', 'SINDROME DE BARDET-BIEDK GEN BBS1', 'GEN BBS1', 'BARDET', 1),
(679, '90.5...7.36', 'CADMIO EN ORINA DE 24 HORAS', 'CD ORINA 24 HORAS', 'CDORI24H', 1),
(680, '90.6.0.14', 'CAMPYLOBACTER JEJUNI ANTICUERPOS IgG', '', 'CAMPIIGG', 1),
(681, '', 'CARIOTIPO BANDEO C', 'ESTUDIO CROMOSOMICO BANDEO C', 'BANDEOC', 1),
(682, '90.6.1.05', 'CANDIDA ALBICANS ANTICUERPOS IGG', '', 'CAIGG', 1),
(683, '', 'VALORACIÓN MEDICA OCUPACIONAL', '', '', 1),
(684, '', 'RAYOS X DE TORAX POR ILO', '', 'RXTILO', 1),
(685, '', 'Ó', '', 'SEL', 1),
(686, '', 'SCHISTOSOMAS IgG', '', 'SCHG', 1),
(687, '', 'CHLAMYDIA PNEUMONIAE IgG', '', 'CHLPNEIGG', 1),
(688, '', 'ADAMTS-13', 'Actividad de la Proteasa de Ruptura del Factor Von Willebrand', 'ADAMTS-13', 1),
(689, '90.6.8.45', 'DIFTERIA TOXOIDE ACS  IgG', 'Difterotoxina Anticuerpos', 'DIFTOXIGG', 1),
(690, '', 'PERSONA ADICIONAL (HIJO)', '', 'PPH', 1),
(691, '90.6.3.34', 'CANDIDA DETECCION DE ANTIGENO', '', 'CANAG', 1),
(692, '90.6.8.34.	 .', 'RAST DE ABEJA', 'inmunoglobulina ige especifica para abeja', 'RASTABEJA', 1),
(693, '1008', 'INFLUENZA A Y B ANTICUERPOS TOTALES', 'influenza a y b', 'influe', 1),
(694, '90.57.55    ', 'SALICILATOS CUANTITATIVOS EN SANGRE', '', 'SAL', 1),
(695, '', 'CARIOTIPO DE INTERCAMBIO CROMATIDES HERMANAS', '', 'cromatides', 1),
(696, '', 'Rickettsia rickettsii, Anticuerpos IgG', '', 'RICKG', 1),
(697, '', 'RAST DE OVALBUMINA', '', 'OVALBUMINA', 1),
(698, '', 'PROTEINA S ANTIGENO TOTAL', '', 'PSAGT', 1),
(699, '86.0.2.05', 'PRUEBA DE MANTOUX', 'PPD, TUBERCULINA, Prueba Derivado Proteico Purificado', 'PPD', 1),
(700, '', 'Rickettsias, DNA', '', 'RCKDNA', 1),
(701, '', 'PERSONA ADICIONAL (HIJO CON O SIN MAMA, OTRO P. PADRE)', '', 'PAH', 2),
(702, '', 'PROTEINASA 3 PR3 AUTOANTICUERPOS', 'PR-3, PR3 ANCA, pANCA (Anticuerpos Perinucleares Anticitoplasma de Neutrófilos)', 'P3PR3', 1),
(703, '', 'CHLAMYDIA TRACHOMATIS DNA DETECTOR', '', 'CHLTRDNA', 1),
(704, '906834.', 'RAST CASPA DE PERRO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA CASPA DE PERRO', 'RASTCASPAP', 1),
(705, '90.6.8.25    ', 'PROTEINAS DE BENCE JONES POR INMUNOFIJACION', '', 'PROTBJ', 1),
(706, '', 'Epstein Barr Virus Antigeno de Cápside (VCA) en LCR, Anticuerpos IgG', '', '', 1),
(707, '90.8.3.14', 'CISTINA EN ORINA DE 24 HORAS', 'CISTINURIA', 'CIS24H', 1),
(708, '', 'ECHINOCOCUS GRANULOSUS ACS IgG', '', 'ECHINOIGG', 1),
(709, '', 'CITOMEGALOVIRUS IGG EN LCR', '', 'CITOGLCR', 1),
(710, '', 'CITOMEGALOVIRUS IGM EN LCR', 'CMV EN LCR', 'CITIGMLCR', 1),
(711, '688', 'INDICE DE TIROXINA LIBRE', 'INDICE DE T4 LIBRE, ITL', 'IT4LIBRE', 1),
(712, '906834 . ', 'RAST DE CHOCOLATE', 'inmunoglobulina ige especifica para chocolate,cacao', 'CHOCOLATE', 1),
(713, '', 'Transporte de personal medico en actividad extra mural', 'transporte de personal medico', '', 1),
(714, '	90.6.8.34', 'Rast Ácido Acetilsalicílico', 'Rast Ácido Acetilsalicílico', '', 1),
(715, '', 'Atrofia muscular espinosa SMN1-SMN2', 'ESTUDIO MOLECULAR DE SMN1-SMN2', 'AME', 1),
(716, '90.4.7.02.', 'INSULINA PRE Y POS DESAYUNO', 'INSULINA PRE Y POS PRANDIAL SIN CARGA', 'INSPYPD', 1),
(717, '90.6.3.01.', 'ADENOVIRUS DETECCION DE ANTIGENO EN DIVERSAS MUESTRAS', '', 'ADENODIVM', 1),
(718, '', 'PLASMINOGENO CONCENTRACION', '', 'PLASMCON', 1),
(719, '', 'VIRUS SINCITIAL RESPIRATORIO ACS IGG', 'Virus sincitial', 'sincitial', 1),
(720, '90.4.7.21', 'PEPTIDO INTESTINAL VASOACTIVO', 'VIP', 'PIV', 1),
(721, '', 'EPSTEIN BAAR CARGA DE DNA VIRAL', '', 'EBDNA', 1),
(722, '', 'EPSTEIN BARR VCA IgM EN LCR', 'Epstein Barr Virus Antígeno de Cápside (VCA) en LCR, Anticuerpos IgM', 'EBVCAMLCR', 1),
(723, '90.4.1.02', 'HORMONA ANTIDIURETICA', 'VASOPRESINA,ADH/Arginina', 'ADH', 1),
(724, '90.7.1.01', 'AZUCARES REDUCTORES EN ORINA', '', 'REDUORI', 1),
(725, '', 'NEUROMIELITIS OPTICA IGG EN LCR', 'ACUAPORINA 4 EN LCR,NMO EN LCR', 'NMOPLCR', 1),
(726, '', 'INDICE DE SALUD PROSTATICO', ' ProPSA PHI ', 'SALUDPROST', 1),
(727, '', 'TRADUCCIÓN DE EXÁMENES', 'EXAMENES', '', 1),
(728, '90.3.8.63', 'PROTEINAS TOTALES', 'PT, PROTEINOGRAMA, PROTEINAS DIFERENCIADAS, PROTEINAS, RELACION ALBUMINA GLOBULINA', 'PROT', 1),
(729, '90.6.3.22', 'LEGIONELLA ANTIGENO EN ORINA', '', 'LEGAG', 1),
(730, '', '17 HIDROXIPROGESTERONA PEDIATRICA ', '17 HIDROXIPROGESTERONA PEDIATRICA ALFA', '17HPPALFA', 1),
(731, '', 'PERMEABILIDAD INTESTINAL', '', 'PERMINT', 2),
(732, '91.1.0.10', 'COOMBS DIRECTO', 'Prueba de coombs', 'COOMD', 1),
(733, '', 'CHLAMYDIA TRACHOMATIS Y NEISSERIA GONORRHOEAE', 'CHLAMYDIA Y NEISSERIA POR PCR', 'CHNEISPCR', 1),
(734, '', 'CULTIVO DE GERMENES COMUNES SIN ATB', '', 'CSINATB', 1),
(735, '', 'NIVELES DE LAMOTRIGINA', 'LAMOTRIGINA EN SANGRE,Lamictal', 'LAMOTRIGIN', 1),
(736, '', 'NIVELES DE ESTRICNINA', 'Estricnidin-10-ona', 'ESTRICNINA', 1),
(737, '1067', 'UREAPLASMA UREALITICUM, ANTICUERPOS IgM', '', 'UUACIGM', 1),
(738, '', 'HORMONA TIROIDEA RESISTENCIA THRB SECUENCIACION', 'RESISTENCIA THRB ', 'THRB', 1),
(739, '90.5.7.41', 'ORGANOCLORADOS EN SANGRE', '', 'OCSAN', 1),
(740, '90.4.9.24', 'T3 LIBRE', 'T3L, TRIYODOTIRONINA LIBRE, T3F', 'T3L', 1),
(741, '90.5.7.41..', 'ORGANOCLORADOS EN ORINA', '', 'OCORI', 1),
(742, '', 'ORTOCRESOL', '', 'ORTOC', 1),
(743, '', 'PARAINFLUENZA ANTICUERPOS IGM', '', 'PARAIGM', 1),
(744, '', 'FENOTIAZINAS', 'FNT, Dibenzotiazina, Tiodifenilamina', 'FNT', 1),
(745, '', 'RAST DE PAPAYA', 'inmunoglobulina ige especifica para papaya', 'PAPAYA', 1),
(746, '90.8.4.12    ', 'PANEL DE ENFERMEDADES DE TRANSMISION SEXUAL', '', 'PSEX', 1),
(747, '', 'RAST DE AVELLANA', 'Avellana', '', 1),
(748, '90683.4 ', 'RAST DE ARTEMISA', 'INMUNOGLOBULINA IGE ESPECIFICA PARA ARTEMISA', 'ARTEMISA', 1),
(749, '90.6.2.08', 'DENGUE IGM CUANTITATIVO', 'Dengue M, Anticuerpos IgM contra dengue', 'DEMC', 1),
(750, '', 'RAST DE GUAYABA ', 'INMUNOGLOBULINA IGE ESPECIFICA PARA GUAYABA', 'GUAYABA', 1),
(751, '', 'FOSFATIDIL SERINA IGG', '', 'FSERIGG', 1),
(752, '', 'SINDROME DE POMPE (ARG854X, ASP645GLU, IVS1-13 T>G - GAA) SCREENING', '(ARG854X, ASP645GLU, IVS1-13 T>G - GAA) SCREENING', 'POM', 1),
(753, '', 'FOSFATIDIL SERINA IGM', '', 'FSERIGM', 1),
(754, '90.2.1.18', 'METAHEMOGLOBINA', '', 'METH', 1),
(755, '90.8.8.03', 'GENOTIPIFICACION HEPATITIS B', 'HEPATITIS B GENOTIPO', 'HEPBGENOTI', 1),
(756, '', 'PROSTAGLANDINA E2 PLASMA', 'PE2P', 'PE2', 1),
(757, '', 'GLUTEN ANTICUERPOS IGG', '', 'GLUTENIGG', 1),
(758, '', 'ESPIROMETRIA CLINICA', 'ESPIROMETRIA CLINICA', 'EC', 1),
(759, '90.6.0.49', 'COXIELLA BURNETI ANTICUERPOS IGM', 'FIEBRE Q', 'COXIBURIGM', 1),
(760, '', 'PORFIRINAS FRACCIONADAS EN ORINA', '', 'PFRAC', 1),
(761, '90.4.4.02', '17 HIDROXIPROGESTERONA PRE Y POS ESTIMULO', '17OH PRE Y POS ACTH, PROGESTERONA 17 HIDROXI PRE Y POS ACTH', '17HOPYP', 2),
(762, '952', 'HEMOCULTIVO SERIADO', 'CULTIVO EN SANGRE', 'HEMOCUL', 2),
(763, '90.2.0.05', 'TIEMPO DE VENENO DE VIBORA RUSSEL', 'ANTICOAGULANTE LUPICO PRUEBA CONFIRMATORIA,TVVR', 'RUSELL', 1),
(764, '', 'TSI AUTOANTICUERPOS A RECEPTORES DE TSH', 'TRABS', 'TSI', 1),
(765, '', 'MYCOBACTERIUM ANTICUERPOS IGG', '', 'MYCIGG', 1),
(766, '', 'MYCOBACTERIUM ANTICUERPOS IGM', '', 'MYCIGM', 1),
(767, '90.6.4.85', 'MIELOPEROXIDASA', 'ANTI-MPO', 'MPO', 1),
(768, '', 'MELATONINA', 'N-acetil-5-metoxitriptamina', 'MELA', 1),
(769, '902061', 'INHIBIDOR DEL FACTOR XI', '', 'IF XI', 1),
(770, '90.6.4.40', 'ANTICUERPOS ANTINUCLEARES', 'ANAS, ANAS POR IFI, ANTINUCLEARES PATRÓN Y TITULO', 'ANAS', 1),
(771, '906834.    ', 'RAST DE AHUYAMA', '', 'AHY', 1),
(772, '90.7.0.04', 'COPROLOGICO DIRIGIDO', 'Croproscopico, materia fecal examen microquímico, azucares reductores', 'COPDIR', 1),
(773, '90.6.7.38', 'LINFOCITOS NK CD16/CD56', 'CITOMETRIA DE FLUJO CD16/CD56', 'NKC', 1),
(774, '', 'HLA COMPLETO MEDIANA RESOLUCION', 'Antígenos de Histocompatibilidad (HLA) ', 'HLA', 1),
(775, '', 'MARCADOR TUMORAL CA 27.29', 'Marcador Activador De Cancer De Mama', 'CA27', 1),
(776, '', 'VIRUS DEL PAPILOMA HUMANO ANAL', 'VPH ANAL', 'VPHA', 2),
(777, '90.3.6.11', 'ALUMINIO EN SUERO', 'AL, ALUMINIO EN SANGRE', 'ALSUERO', 2),
(778, '906834.    .', 'RAST DE ALMENDRAS', 'inmunoglobulina ige especifica para almendras', 'RASTALMEND', 1),
(779, '', 'ACIDOS GRASOS EN SUERO', 'Perfil completo de ácidos grasos', 'GRASOSSU', 1),
(780, '90.6.2.21', 'HEPATITIS B CORE ACS. IgG', 'Core G, Hepatitis B core total, Hepatitis B core IgG, Anti-HBc', 'COREG', 1),
(781, '90.3.8.67', 'ASPARTATO AMINOTRANSFERASA', 'GOT,TGO,ASAT, TRANSAMINASA OXALACETICA', 'AST', 1),
(782, '', '5 HIDROXI-TRIPTAMINA', 'SEROTONINA EN SANGRE', '5HTP', 1),
(783, '90.6.2.33', 'HTLV I Y II ANTICUERPOS', 'HTLV , PARAPARESIA ESPASTICA TROPICAL,Virus Linfotrópico Células T, Anticuerpos', 'HTLVI II', 1),
(784, '90.5.736', 'CROMO EN ORINA EN ORINA AL AZR', '', 'CR ORINA', 1),
(785, '9068.34 ', 'RAST DE BANANO', '', '', 1),
(786, '90.5.7.01', 'ACETAMINOFEN NIVELES SERICOS', 'Paracetamol, DCI,  Acetaminofeno, Anacín, Datril, Dolex, Liquiprin, Panadol, Tylenol, Niveles sericos de acetaminofen', 'ACETAM', 1),
(787, '90.6.4.01', 'ACETILCOLINA RECEPTORES ACS BLOQUEADORES', 'AChRB', 'AChRB', 1),
(788, '90.4.7.07', 'PROINSULINA', '', 'PROINS', 1),
(789, '', 'CONCEPTO MEDICO 2 INSTANCIA', '', '', 1),
(790, '570', 'HEROINA EN ORINA', 'NIVELES DE HEROINA EN ORINA, 3,6-diacetilmorfina', 'HER', 1),
(791, '90.2.1.15', 'PRUEBA DE HAM', 'HEMOLISINA ACIDA', 'HAM', 2),
(792, '90.6.0.24', 'HELICOBACTER PYLORI IGM', 'H.PYLORI IGM', 'HPYLORIM', 1),
(793, '', 'ACIDOS GRASOS PERFIL COMPLETO SANGRE TOTAL', '', 'AGO3O6', 1),
(794, '90.3.0.07', 'CATECOLAMINAS EN ORINA DE 24 HORAS', 'CATECOLAMINAS EN ORINA,Noradrenalina en orina, Adrenalina en orina', 'CATEORI24H', 1),
(795, '90.6.1.34', 'TOXOPLASMA PRUEBA DE AVIDEZ', 'TEST DE AVIDEZ PARA TOXOPLASMA, TEST DE AVIDEZ PARA ANTICUERPOS IGG DEL TOXOPLASMA', 'TOXAVIDEZ', 1),
(796, '90.3.8.60', 'POTASIO EN ORINA DE 24 HORAS', 'K, potasio urinario, potasuria, potasio en orina, electrolitos en orina de 24 horas.', 'K24H', 1),
(797, '90.3.0.11', 'PIRIDINOLINA', 'PIRILINKS,	DEOXIPIRIDINOLINA, DPD.', 'PIRILINKS', 1),
(798, '90.68.34.', 'Alérgeno Atropina', '', 'ATROP', 1),
(799, '90.3.4.25', 'FRUCTOSAMINA', 'Albúmina Glicada', 'FRUC', 1),
(800, '90.2.0.16', 'FACTOR V', 'FACTOR V LABIL O PROACELERINA', 'FACTORV', 1),
(801, '', 'PROTEINA S ANTIGENO LIBRE', '', 'PRSAL', 1),
(802, '90.2.0.21', 'FACTOR XI ', 'FACTOR XI DE LA COAGULACION', 'FACTORXI', 1),
(803, '90.6.2.43', 'RUBEOLA IGM', 'RUBEOLA ANTICUERPOS IGM, TORCH IGM, RUBEOLA M', 'RUBM', 1),
(804, '90.6.1.04', 'CANDIDA ALBICANS ANTICUERPOS IGM', '', 'CAIGM', 1),
(805, '905724', 'COCAÍNA CUANTITATIVA EN ORINA', 'COCA', 'cocc', 1),
(806, '90.7 1 03', 'PROTEINAS DE BENCE JONES', 'Proteinas de bence jones en orina, BJP', 'PBJ', 1),
(807, '90.7.0.07', 'PRUEBA DE GRAHAM', 'Frotis Rectal (Oxiuros), Test de Graham  ', 'GRAHAM', 1),
(808, '90.5.7.42', 'ORGANOFOSFORADOS EN SANGRE', '', 'OFSAN', 1),
(809, '90.1.2.35', 'UROCULTIVO Y ATB MANUAL', '', 'UROC', 1),
(810, '563', 'MATERNIT GENOME', '', 'MGENOME', 1),
(811, '90.4.5.08.', 'PAII', 'Prueba de admisión ocupacional, prueba de aptitud II, serología II', 'PAII', 1),
(812, '', 'PREPARACION DE LAMINA', '', '', 1),
(813, '', 'RAST DE CASPA DE VACA', 'ALERGENO CASPA DE VACA ANTICUERPOS IGE', '', 1),
(814, '90.6.1.08', 'CISTICERCO IGG POR WESTERN BLOT', '', 'CISTWEST', 1),
(815, '90.2.2.18', 'RECUENTO DE EOSINOFILOS EN CUALQUIER MUESTRA', 'Eosinofilos recuento', 'RECEOC', 1),
(816, '90.5.7.42.', 'ORGANOFOSFORADOS EN ORINA', '', 'OFORI', 1),
(817, '', 'PRUEBA PSICOTECNICA PARA CONDUCTORES', '', '', 1),
(818, '90.2.2.19', 'RECUENTO DE EOSINOFILOS EN MOCO NASAL', '', 'EMNAS', 1),
(819, '90.6.4.22', 'FOSFOLIPIDOS IGG', 'FOSFOLIPIDOS ANTICUERPOS IGG', 'FOSFIGG', 1),
(820, '90.2.2.13', 'HEMOGLOBINA ', 'Hb, Hgb', 'Hb', 1),
(821, '84', 'CK-MM', 'CREATIN KINASA FRACCION MM, CKMM, CPK MM', 'CKMM', 1),
(822, '90.6.6.26', 'BHCG SUB UNIDAD BETA LIBRE', 'BETA HCG LIBRE, GONADOTROPINA CORIONICA LIBRE', 'BHCGLIBRE', 1),
(823, '90.3.4.22', 'COPROPORFIRINAS', '', 'COPROP', 1),
(824, '', 'SELENIO EN SANGRE', 'Selenio, Niveles Sericos  ,se', 'SELENIOS', 1),
(825, '908421', 'HIBRIDACION GENOMICA COMPARADA POR ARRAYS', 'HIBRIDACION GENOMICA COMPARADA', 'HGCA', 1),
(826, '90.3.0.03', 'BICARBONATO EN SUERO', ' ‎NaHCO3,BICARBONATO EN SANGRE', ' ‎NaHCO3SU', 1),
(827, '90.2.0.33', 'PROTEINA C DE LA COAGULACION', 'PROTEINA C, PROTEINA C ACTIVIDAD, PROTEINA C FUNCIONAL', 'PROTC', 1),
(828, '90.6.6.20.', 'BETA 2 MICROGLOBULINA EN ORINA', 'B2M EN ORINA', 'B2MIORIN', 1),
(829, '', 'TAMIZAJE PRIMER TRIMESTRE', 'TRIPLEMARCADOR', 'TAM', 1),
(830, '', 'HERPES I EN LCR, ANTICUERPOS IGG', 'HERPES VIRUS TIPO I EN LCR IGG', '', 1),
(831, '', 'GLUTATION (GHS)', 'GHS', '', 1),
(832, '90.3.4.12', 'APOLIPOPROTEINA B', 'Apo-B', 'APOB', 1),
(833, '90.3.7.08', 'VITAMINA E', 'TOCOFEROL', 'VITE', 1),
(834, '90.2.0.39.', 'RESISTENCIA A LA PROTEINA C ACTIVADA', 'RESISTENCIA A LA PROTEINA C RPCA', 'RPCA', 1),
(835, '', 'RAST DE CEBOLLA', '', '', 1),
(836, '90.8.3.05', 'PIRUVATOKINASA EN ERITROCITOS', '', 'PKERIT', 1),
(837, '90.4.5.04', 'ESTRIOL', 'E3, Estrogenos, Estriol libre, Estriol no conjugado', 'E3', 1),
(838, '90.3.8.13', 'CLORO', 'CL,CLORURO, CLORO SERICO, ELECTROLITOS SERICOS, IONOGRAMA', 'CL', 1),
(839, '90.4.7.16', 'CURVA DE INSULINA DE 5 HORAS', 'CURVA DE INSULINA DE 7 MUESTRAS', 'CIN5H', 1),
(840, '90.6.6.11', 'PSA LIBRE', 'ANTIGENO ESPECIFICO DE PROSTATA FRACCION LIBRE, PSAL', 'PSAL', 1),
(841, '90.5.7.38', 'CARBOXIHEMOGLOBINA', 'MONÓXIDO DE CARBONO,COHb', 'CARBX', 1),
(842, '', 'CARNET MANIPULADOR DE ALIMENTO ', 'CARNET MANIPULADOR DE ALIMENTO ', 'CARNET MAN', 1),
(843, '', 'TOMA DE MUESTRA SANGUINEA', '', '', 1),
(844, '', 'TOMA DE MUESTRA Y EMBALAJE', '', 'tm', 2),
(845, '90.2.0.32', 'PROPERDINA FACTOR B', 'PFB', 'PROPB', 1),
(846, '90.6.4.09', 'CARDIOLIPINAS IGM', 'ACA, ACAS, ANTI CARDIOLIPINAS IGM, ACAS IGM', 'ACAM', 1),
(847, '90.64.91', 'TIROSINASA MUSCULO ESPECIFICA', 'MUSK', 'MUSK', 1),
(848, '90.4.8.05', 'CORTISOL', 'CORTISOL AM, CORTISOL PLASMATICO, ', 'COR', 1),
(849, '90.4.8.06', 'CORTISOL AM PM', 'CORTISOL 8:00 AM-4:00 PM', 'CAMPM', 1),
(850, '90.7.1.06', 'UROANALISIS', 'PARCIAL DE ORINA, PO, ORINA CITOQUIMICO, EXAMEN DE ORINA, SEDIMENTO Y DENSIDAD URINARIO', 'PO', 1),
(851, '', 'CARNET MANIPULADOR DE ALIMENTO DM', 'CARNET MANIPULADOR DE ALIMENTO DM', '', 1),
(852, '90.2.0.17', 'FACTOR VII', 'Proconvertina, Factor estable', 'FACTORVII', 1),
(853, '90.2.0.14', 'FACTOR IX', 'FACTOR IX DE LA COAGULACION,CHRISTMAS,FACTOR ANTIHEMOLITICO B', 'FIX', 1),
(854, '90.4.1.09', 'POOL DE PROLACTINA', 'PROLACTINA 3 MUESTRAS', 'PRLPOOL', 1),
(855, '90.3.4.01', 'ADENOSIN DEAMINASA', 'ADA', 'ADA', 1),
(856, '90.6.9.15', 'SEROLOGIA TREPONEMA PALLIDUM', 'VDRL, RPR, SIFILIS', 'SIF', 1),
(857, '90.2.0.12', 'FACTOR II', '', 'FACTORII', 1),
(858, '90.3.4.09', 'APOLIPOPROTEINA A1', 'APOA1', 'APOA1', 1),
(859, '90.5.7.60', 'TALIO EN SANGRE TOTAL', '', 'TI', 1),
(860, '90.3.8.21', 'CK TOTAL', 'CK, CPK, CREATIN KINASA TOTAL, CREATIN FOSFOKINASA', 'CK', 1),
(861, '', 'LDL OXIDADA', '', '', 1),
(862, '', 'HIBRIDACION GENOMICA COMPARADA 180K', '', '', 1),
(863, '90.3.0.22', 'HOMOCISTEINA', 'Homocisteína Cardiovascular', 'HOMO', 1),
(864, '421', 'ELECTROFORESIS DE PROTEINAS EN ORINA', 'PROTEINAS EN ORINA POR ELECTROFORESIS, PROTEINOGRAMA EN ORINA', 'ELPROSORIN', 1),
(865, '', 'CARNET MANIPULADOR DE ALIMENTO 55', 'CARNET MANIPULADOR DE ALIMENTO ', '', 1),
(866, '9069131', 'PCR ULTRASENSIBLE', 'cardio pcr, pcr us, pcr hs, pcr cardiaca', 'PCRUS', 1),
(867, '90.5.5.02', 'CICLOSPORINA', '', 'CICLO', 1),
(868, '717', 'CLOZAPINA Y NORCLOZAPINA', 'Clozaril', 'cloz', 1),
(869, '90.5.3.05', 'BENZODIACEPINAS EN SUERO', 'BENZODIACEPINAS EN SANGRE, Valium, Xanas, Ativan, Serox, Centrox', 'BENZSUER', 1),
(870, '', 'CLOBAZAM', 'Clobazepam, Karidium, Urbadan', 'CLOBA', 1),
(871, '', 'ESTUDIO DE MICROARREGLOS CHIP 750 AFFYMETRIX ', 'CHIP750 ', 'CHIP750', 2),
(872, '90.3.1.09', 'ACIDO HOMOVANILICO', 'ACIDO HVA', 'AHOMO', 1),
(873, '', 'D XILOSA EN SUERO', 'D-XILOSA EN SUERO', 'DX', 2),
(874, '651', 'ACIDO HIALURONICO', '', 'ACHIAL', 1),
(875, '90.6.8.51', 'CALPROTECTINA', 'CALPROTECTINA EN HECES', 'CALPROTEC', 1),
(876, '90.6.7.44', 'LINFOCITOS T CD3 CD4 CD8 ', 'citometria de flujo para linfocitos t', 'cd3cd4cd8', 1),
(877, '', 'VITAMINA B3 ', ' NIACINA,Ácido Nicotínico, Factor P.P., Niacina, Nicotinamina', 'VITB3', 1),
(878, '', 'FORMATO CONTROLAR', 'FORMATO', '', 1),
(879, '90.3.0.25', 'METANEFRINAS TOTALES EN ORINA DE 24 HORAS', '', '', 1),
(880, '90.5.3.03', 'AMITRIPTILINA Y NORTRIPTILINA NIVELES SERICOS', '', 'AMITNORT', 1),
(881, '90.3.0.16', 'FERRITINA', 'Perfil de hierro.', 'FER', 1),
(882, '', 'BIOTINA', 'Vitamina B7, Vitamina B8, Vitamina H, Coenzima R, Antiavidina', 'BIOTINA', 1),
(883, '90.1.2.22', 'HEMOCULTIVO PARA GERMENES AEROBIOS', 'Cultivo de Sangre Aerobio', 'HEMOCU', 1),
(884, '90..5.7.36', 'CADMIO EN SANGRE', 'Cd en sangre total', 'CADMIO', 2),
(885, '90.8.8.30', 'MUTACION FACTOR DE LEIDEN', 'Factor V Mutación G1691A', 'VLEID', 1),
(886, '', 'RAST DE MANGO', '', 'MNG', 1),
(887, '90.1.1.02', 'COLORACION DE ZIEHL NEELSEN MODIFICADO', 'criptosporidium, isospora belli, bk modificado', 'ZNMOD', 1),
(888, '', 'BRCA 1 Y BRCA 2 GENES SECUENCIACION Y DELECION DUPLICACION', 'BRACA', 'BRCA', 1),
(889, '90.6.2.50', 'WESTERN BLOT PARA HIV', ' PRUEBA CONFIRMATORIA PARA HIV', 'WESTERN', 1),
(890, '90.1.1.01', 'BACILOSCOPIA', 'BK, COLORACION DE ZIEHL-NEELSEN', 'BK', 1),
(891, '90.6.3.08', 'CHLAMYDIA TRACHOMATIS ANTÍGENO', 'Chlamydia en secreción', 'CHLAM', 2),
(892, '90.6.4.15', 'ANCAS', 'Anticuerpos citoplasma de neutrófilos, C anca, P anca', 'ANCAS', 1),
(893, '', 'CULTIVO DE GERMENES COMUNES Y ATB MANUAL', '', 'CDC', 1),
(894, '90.2.0.04', 'ANTICOAGULANTE LUPICO', 'AL, ANTICUERPOS CIRCULANTES', 'AL', 1),
(895, '90.3.0.05', 'CALCULO URINARIO', 'Examen fisico quimico de composicion litiasica, calculo renal', 'calcur', 1),
(896, '90.7.0.13', 'COPROLOGICO SERIADO ', 'COPRO', 'COPROSE', 1),
(897, '', 'ESTUDIO DE PATERNIDAD TRIO', 'PRUEBA DE PATERNIDAD', 'PATERTRIO', 1),
(898, '90.2.2.06', 'EXTENDIDO DE SANGRE PERIFERICA', 'ESP, FSP, ESTUDIO DE MORFOLOGÍA GLOBULAR EN SANGRE PERIFERICA', 'ESP', 1),
(899, '', 'MEDIO DE TRANSPORTE PARA CULTIVO', '', 'MDT', 1),
(900, '90.6.4.81', 'BETA 2 GLICOPROTEINA IgG', 'Beta-2-GPI, Apolipoproteína H, B2GpI', 'B2GLG', 1),
(901, '90.5.7.60 .', 'TALIO EN ORINA ', 'TO', 'TIO', 1),
(902, '90.1.3.05', 'FROTIS DIRECTO PARA HONGOS (KOH)', 'KOH, FROTIS PARA HONGOS', 'KOH', 1),
(903, '90.5.7.34', 'METADONA', 'TAMIZAJE METADONA', 'METADONA', 1),
(904, '90.4.9.23', 'T3 UPTAKE CAPTACION', 'T3 UPTAKE', 'UPTAKE', 1),
(905, '', 'CYTOGEL 3 ML SEGUNDA DOSIS', '', 'CYT3ML2D', 1),
(906, '90.6.8.10', 'ELECTROFORESIS DE LIPOPROTEINAS', '', 'ElecLP', 1),
(907, '90.3.8.76', 'CREATININA EN ORINA AZAR', 'CREATINURIA, CREATININA EN ORINA AISLADA', 'CROA', 1),
(908, '90.6.6.10', 'ANTIGENO ESPECIFICO DE PROSTATA ULTRASENSIBLE', 'PSA, APS, APE, ANTIGENO PROSTATICO, PSA TOTAL', 'PSA', 1),
(909, '90.4.6.05', 'DIHIDROTESTOSTERONA', '5α-DHT, 5α-Dihydrotestosterona, Androstanolona, DHT', 'DIHID', 1),
(910, '90.3.8.39', 'GASES ARTERIALES', 'Medición de gases en sangre arterial ', 'GASEA', 1),
(911, '90.3.1.07', 'ACIDO FORMICO', 'ACIDO METANOICO', 'FORM', 1),
(912, '90.6.3.14', 'CRIPTOCOCO ANTIGENO', 'Cryptococcus neoformans Antigeno', 'criptoag', 1),
(913, '90.4.7.20', 'ELASTASA PANCREATICA', 'ELASTASA EN HECES', 'ELASPANC', 1),
(914, '902106', 'ESCOPOLAMINA', 'BURUNDANGA', 'ESCOPO', 1),
(915, '90.5.7.18', 'CARBAMATOS', '', 'CARBAMATOS', 1),
(916, '', 'VIRUS SINCITIAL RESPIRATORIO, ANTICUERPOS IgM', '', '', 1),
(917, '', 'TOMA DE MUESTRA NO QUIRURGICA', '', 'TOM', 1),
(918, '', 'ANEMIA DE FANCONI GEN BRIP1', 'ANEMIA FANCONI', 'FAN', 1),
(919, '90.5.7.40', 'OPIACEOS', 'Codeina, opiaceos en orina, drogas de abuso', 'OPI', 1),
(920, '', 'RAST DE COLORANTE ROJO', 'INMUNOGLOBULINA IGE ESPECIFICA PARA COLORANTE ROJO,o Extracto Cochinilla,ROJO COCHINILLA', 'ROJO', 2),
(921, '90.3.8.17', 'COLESTEROL LDL', 'LDL, COLESTEROL DE BAJA DENSIDAD, LIPOPROTEINA DE BAJA DENSIDAD, COLESTEROL MALO', 'LDL', 1),
(922, '', 'PRA CLASE I CUALITATIVO', 'PRA I', 'P.R.A.', 1),
(923, '', 'PRA CLASE II CUALITATIVO', 'PRA II', 'PRA2', 1),
(924, '', 'RAYOS X DE TOBILLO', 'RX', '', 1),
(925, '90.3.8.56', 'NITROGENO UREICO', 'BUN. NU, AZOADOS, UREMIA', 'BUN', 1),
(926, '90.1.2.36', 'UROCULTIVO Y ATB POR MIC', 'Cultivo de orina', 'URO', 1),
(927, '744', 'FENILCETONURIA', 'PKU', 'FENILC', 1),
(928, '', 'CYTOGEL DE 12 ML TERCERA DOSIS', '', 'CYT12', 1),
(929, '90.4.5.08', 'BETA HCG CUALITATIVA', 'Prueba de embarazo, gravindex, HCG, gonadotropina corionica cualitativa', 'HCG', 1),
(930, '90.7.0.02', 'COPROLOGICO', 'EXAMEN DE MATERIA FECAL, EXAMEN DE HECES, COPRO, ', 'COPRO', 1),
(931, '', 'ESTUDIO DE ABUELIDAD', '', 'ABUEL', 2),
(932, '', 'RETICULINA ACS IGG', 'ANTIRETICULINA IGG', 'RETG', 1),
(933, '', 'RETICULINA ACS IGA', 'ANTIRETICULINA IGA', 'RETA', 1),
(934, '334', 'ANTICUERPOS BLOQUEADORES', 'ANTICUERPOS  LEUCOCITARIOS PATERNOS', 'ABLOQUE', 1),
(935, '905716', 'Marihuana Cuantitativa en orina al azar', 'Cannabis', 'THCc', 1),
(936, '90.6.8.09', 'ELECTROFORESIS ACIDA DE HEMOGLOBINA', 'electroforesis de hemoglobina en medio acido', 'ELHBACIDO', 1),
(937, '', 'PAPILOMA ANTICUERPOS IgG', '', '', 1),
(938, '520', 'MACROPROLACTINA', '', 'MACROP', 1),
(939, '', 'FOSFOLIPIDOS IGG PERFIL COMPLETO', 'fosfolipidos igg Beta 2 Glicoproteina 1,cardiolipina, Fosfatidil serina, Fosfatidil Inositol y Acido Fosfatídico.', 'FIGGCOMP', 1),
(940, '90.3.8.64', 'SODIO', 'NA, SODIO EN SANGRE, SODIO SERICO, ELECTROLITOS SERICOS, IONOGRAMA', 'NA', 1),
(941, '90.6.5.10', 'ANTICUERPOS CITOTOXICOS ', 'HLA CITOTOXICOS ANTICUERPOS', 'CITOTOXACS', 1),
(942, '', 'PSICOLOGIA', '', '', 1),
(943, '90.6.3.29', 'VIRUS SINCITIAL RESPIRATORIO ANTIGENO', '', 'VSR', 1),
(944, '90.3.8.38', 'GAMMA GLUTAMIL TRANSFERASA', 'ggt,ygt, gamma gt, gamma glutamil transpeptidasa', 'GGT', 1),
(945, '90.6.0.20', 'CHLAMYDIA TRACHOMATIS IGM', 'CHLAMYDIA ANTICUERPOS IGM', 'CHLTRIGM', 1),
(946, '', 'CYTOGEL 12 ML SEGUNDA DOSIS', '', 'CYT12ML2D', 1),
(947, '', 'RELACIÓN ALBUMINURIA/CREATINURIA', '', 'ALB/CR', 1),
(948, '90.1.2.17', 'CULTIVO DE GERMENES COMUNES Y ATB POR MIC', 'Cultivo para microorganismos en cualquier muestra diferente a médula ósea orina y heces', 'CGCATB', 1),
(949, '', 'Fenilciclidina', 'fenilciclidina', 'fen', 1),
(950, '90.3.6.04', 'CALCIO IONICO', 'CALCIO IONIZADO, CA++,CAI', 'CAI', 1),
(951, '', 'RAST DE HABICHUELA', '', 'HAB', 1),
(952, '', 'HEMOCROMATOSIS HEREDITARIA GEN HFE MUTACIONES C282 YH63D Y S65C', 'HFE, Mutacion HH', 'HEMHFE', 1),
(953, '90.8.8.25', 'MYCOBACTERIA TUBERCULOSIS POR PCR', '', 'MYCPCR', 1),
(954, '89.8.0.01', 'CITOLOGIA CONVENCIONAL', 'Estudio de coloración básica en citología vaginal', 'CCVC', 1),
(955, '90.6.2.45', 'SARAMPION ACS IgG', '', 'SARIGG', 1),
(956, '', 'RAST DE HUEVO', 'RAST DE HUEVO', 'EHV', 1),
(957, '1069', 'ALFA 1 ANTITRIPSINA EN HECES', '', '', 1),
(958, '90.6.0.30', 'LEPTOSPIRA IGM', 'ANTICUERPOS PARA LEPTOSPIRA, ANTICUERPOS IGM PARA LEPTOSPIRA, LEPTOSPIROSIS', 'LEPTIGM', 1),
(959, '', 'RAST DE LIMON', '', 'RLM', 1),
(960, '90.4.7.13', 'CURVA DE INSULINA DE 3 HORAS', 'CURVA DE INSULINA, CURVA DE INSULINA 5 MUESTRAS, INSULINA BASAL Y POS CARGA TOMAR A LA HORA 2 HORAS Y 3 HORAS', 'CIN3H', 1),
(961, '431', 'TEST ALERGICO 20 DETERMINACIONES', 'PANEL DE 20 ALERGENOS', 'TEST20DETE', 1),
(962, '', 'ESPIROMETRIA CURVA DE FLUJO VOLUMEN PRE Y POS', '', '', 1),
(963, '', 'RAST DE CALAMAR', '', '', 1),
(964, '377', 'FIBROTEST', 'FIBROSURE', 'FIBROTEST', 1),
(965, '', 'ECOGRAFIA ABDOMINAL DE TEJIDOS BLANDOS', '', 'EABT', 1),
(966, '986', 'METANEFRINAS FRACCIONADAS EN PLASMA', '', 'MEFP', 1),
(967, '90.4.3.02', 'CORTISOL PRE Y POS SUPRESION CON DEXAMETASONA', 'TEST DE SUPRESION DE CORTISOL, CORTISOL PRE Y POS DEXAMETASONA', 'CPYPDEX', 1),
(968, '', 'PT CRUZADO', '', 'PTC', 1),
(969, '90.1.1.06', 'COLORACION DE GRAM', 'Gram', 'GRAM', 1),
(970, '90.3.0.52', 'CITRATO EN ORINA DE 24 HORAS', 'CITRATO EN ORINA, NIVELES DE CITRATO EN ORINA, ACIDO CITRICO EN ORINA', 'CIT24H', 1),
(971, '167', 'ALCOHOL EN SALIVA', 'Determinación de alcohol en saliva', 'ALCS', 1),
(972, '', 'RAST DE CHAMPIÑON', 'Alérgeno Champiñones (f212), Anticuerpos IgE', '', 1),
(973, '', 'CITOQUIMICO DE LIQUIDO CORPORAL', '', 'CTQ', 1),
(974, '90.6.2.47', 'VARICELA ZOSTER IGG', 'ANTICUERPOS IGG CONTRA VARICELA', 'VZOSIGG', 1),
(975, '', 'CISTATINA C', 'Cistatina', 'CistC', 1),
(976, '90.8.4.39', 'FRAGILIDAD CROMOSOMICA CON MITOMICINA', '', 'FC', 1),
(977, '', 'GENE-XPERT', 'PCR en tiempo real para M. tuberculosis y detección de resistencia a Rifampicina, Prueba molecular para la determinación de myciobacterium.', 'GXP', 1),
(978, '90.6.8.25.', 'INMUNOFIJACION EN ORINA', 'INMUNOELECTROFORESIS DE PROTEINAS EN ORINA', 'INMFIORI', 1),
(979, '9068.34', 'RAST DE ARVEJA', '', 'ARV', 1),
(980, '988', 'TEST DE TZANCK', 'Tincion de tzanck, prueba de tzanck', 'zan', 1),
(981, '90.6.2.25', 'HEPATITIS C', 'HEPATITIS C ANTICUERPOS, HVC, ANTICUERPOS TOTALES CONTRA HEPATITIS C, ', 'HVC', 1),
(982, ' 90.6.8.34', 'RAST DE AJONJOLI', 'INMUNOGLOBULINA E ESPECIFICA DE AJONJOLI', '', 1),
(983, '90.6.5.02', 'HLA I Y II A B C DR DQ COMPLETO', 'HLA CLASE I Y II (A,B,C,DRB,DQB1) , HISTOCOMPATIBILIDAD ANTÍGENO A B C DR DO CLASE I Y II', 'HLAABCDRDQ', 1),
(984, '905727', 'Anfetaminas cuantitativas', 'anfetaminas', 'anfc', 1),
(985, '', 'VACUNA DE TOSFERINA', 'TOSFERINA', 'VACTOS', 1),
(986, '90.3.8.66', 'ALANINA AMINOTRANSFERASA', 'ALAT, GPT, TGP, TRANSAMINASA GLUTAMICO-PIRÚVICA', 'ALT', 1),
(987, '90.5.7..36..', 'COBRE EN ORINA 24 HORAS', 'COBRE URINARIO, CU ORINA', 'COORI', 1),
(988, '', 'POLIPEPTIDO PANCREATICO', 'Polipéptido Pancreático Humano', 'HPP', 1),
(989, '90.5.4.10', 'VANCOMICINA', 'Lifocin, Vancocin, Vancoled', 'VAN', 1),
(990, '', 'ANTIFACTOR X ACTIVADO', 'ANTI FACTOR XA', 'ACFXAC', 1),
(991, '', 'CYTOGEL 6 ML TERCERA DOSIS', '', 'CYT6ML3D', 1),
(992, '', 'LINFOCITOS NK CD7- CD16/CD56', '', 'NKCD', 1),
(993, '990', 'MEDIO PARA HEMOCULTIVO ', '', 'MPH', 1),
(994, '', 'Hidroxiprolina en Orina de 24 horas', 'Hidroxiprolina', 'hidroxipro', 1),
(995, '90.13.0.4', 'FROTIS URETRAL', 'Secreción uretral, directo y Gram de secreción uretral', 'SECU', 1),
(996, '905739', 'Opiaceos cuantitativo', 'opio', 'opicc', 1),
(997, '', 'ESTUDIO COLORACION CITOLOGIA LIQUIDO CORPORAL', '', 'CITLCORP', 1),
(998, '90.1.1.02 ', 'PRUEBA DE HANSEN', 'Lepra', 'HANSEN', 1),
(999, '906424', 'HISTONAS ANTICUERPOS', 'HISTONAS ANTICUERPOS IGG', 'HISAC', 1),
(1000, '', 'RAST DE OVOALBUMINA', 'ALERGENO OVOALBUMINA', 'ROVOA', 1),
(1001, '', 'Bun PRE y POS', 'Bun pre y pos', '', 1),
(1002, '', 'INHIBIDOR DEL FACTOR VII', 'INHIBIDOR DEL FACTOR VII', 'FACTOR', 1),
(1003, '', 'RAST DE OVOMUCOIDE', 'ALERGENO OVOMUCOIDE', 'ROVOM', 1),
(1004, '90.6.8.53', 'INTERLEUQUINA 6', 'IL 6', 'IL6', 1),
(1005, '90.4.9.26', 'TIROXINA 4 NORMAL', 'T4 NORMAL,T4 Normalizado,T4N', 'T4N', 1),
(1006, '906489', 'GANGLIOSIDO ASIALO IGM', 'GANGLIOSIDO, gm1', 'GANG, ASIA', 1),
(1007, '906488', 'GANGLIOSIDO ASIALO IGG', 'GANGLIO, ASIALO,gm1', 'GANGL', 1),
(1008, '90.3.0.43', 'TEST DE ALIENTO (UREA C13) A HELICOBACTER PYLORI', 'TEST DE ALIENTO PARA HELICOBACTER PYLORI', 'UREAC13', 2),
(1009, '', 'FOSFATASA ACIDA TARTRATO', 'TARTRATO', 'FOS', 1),
(1010, '', 'ESTUDIO DE PATERNIDAD O MATERNIDAD DUO', 'PRUEBA DE PATERNIDAD DUO', 'PATERDUO', 1),
(1011, '', 'CARGA DE GLUCOSA DE 25 Gr', 'CARGLU25', 'CARGLUC', 1),
(1012, '581', 'FACTOR INTRINSECO ANTICUERPOS BLOQUEADORES', 'Factor Intrínseco Gástrico, Factor Intrínseco de Castle', 'FACIAC', 1),
(1013, '', 'INFLUENZA VIRUS A Y B DETECCION DE ANTIGENO', 'INFLUENZA VIRUS A Y B DETECCION DE ANTIGENO', 'influenza', 1),
(1014, '902011', 'PTT CRUZADO', 'PTT CRUZADO', 'PTTC', 2),
(1015, '90.6.3.24', 'PARAINFLUENZA TIPO I II Y III DETECCION DE ANTIGENO', '', 'AGPARAINF', 1),
(1016, '908825', 'MYCOBACTERIUM TUBERCULOSIS, DNA DETECTOR POR PCR', 'Mycobacterium por pcr', 'Mycobacter', 2),
(1017, '90.3.8.47', 'LIPASA', 'LIPASA EN SANGRE', 'LIP', 1),
(1018, '90.6.2.01', 'ADENOVIRUS ANTICUERPOS IGG', '', 'ADENOIGG', 1),
(1019, '', 'Bk poliomavirus carga viral', 'poliomavirus', 'polio', 1),
(1020, '90.3.0.31.', 'MIOGLOBINA EN ORINA', '', 'MIOOR', 1),
(1021, '91.1.0.18', 'HEMOCLASIFICACION', 'Grupo sanguíneo, ABO, Rh, Clasificación sanguínea', 'ABO', 1),
(1022, '90.6.2.41', 'RUBEOLA IgG', 'RUBEOLA G, ANTICUERPOS CONTRA RUBEOLA, TORCH IGG', 'RUBG', 1),
(1023, '90.7.0.06', 'SUDAN EN MATERIA FECAL', 'SUDAN III, SUDAN EN HECES, GRASAS NEUTRAS', 'SUDAN', 1),
(1024, '90.8.4.36', 'VPH POR PCR', 'test de vph, adn para virus de papiloma, virus de papiloma humano por reacción en cadena de polimerasa', 'VPH', 1),
(1025, '90.5.7.09.', 'ARSENICO EN ORINA', 'As en Orina Parcial o en 24 horas', 'ARSEN', 1),
(1026, '', 'CITOSOL HEPATICO TIPO 1 (LC1) ANTICUERPO', 'ANTI LC1', 'LC1', 1),
(1027, '90.5.7.58', 'ACIDO S FENILMERCAPTURICO', 'SPMA', 'SPMA', 1),
(1028, '', 'TRANSPORTE CHEQUEO', '', 'TCHE', 1),
(1029, '', 'CARIOTIPO PRENATAL', 'CARIOTIPO FETAL BANDEO G Y Q', 'CPRE', 1),
(1030, '', 'CYTOGEL 3ML TERCERA DOSIS', '', 'CYT3ML', 1),
(1031, '90.6.1.38', 'SACCHAROMYCES CEREVISIAE IGA', 'ASCAS IGA, Enf. de Crohn', 'ASCASA', 1),
(1032, '', 'PRUEBA DE SUSCEPTIBILIDAD A FARMACOS  DE PRIMERA LINEA', 'B38', 'psfpl', 1),
(1033, '', 'PRUEBA DE SENSIBILIDAD A FARMACOS DE SEGUNDA LINEA', 'B39', 'PSFSL', 1),
(1034, '90.3.1.01', 'ACIDOS BILIARES TOTALES EN SUERO', '', 'ACBILISU', 1),
(1035, '', 'CREATINA EN SUERO', 'CREATINA', 'CREA', 1),
(1036, '', 'YODO EN ORINA DE 24 HORAS', 'YODO EN ORINA', 'YD24', 1),
(1037, '', 'CARNET MANIPULADOR DE ALIMENTO 4', 'CARNET MANIPULADOR DE ALIMENTO ', '', 1),
(1038, '', 'GLUCOSA EN LIQUIDO DIALIZADO', 'PEV', 'GPEV', 1),
(1039, '', 'KTV', 'glucosa en liquido dializado, creatinina en liquido dializado', '', 1),
(1040, '', 'MATERNIT 21 PLUS', 'PRUEBA PRENATAL NO INASIVA', 'MATERNIT21', 1),
(1041, '', 'PET', '', 'PEV', 1),
(1042, '', 'NITROGENO UREICO DE ORINA INTERDIALITICA', '', '', 1),
(1043, '', 'DOMICILIO SOLEDAD', '', '', 1),
(1044, '', 'DOMICILIO BARRANQUILLA', '', '', 1),
(1045, '90.1.3.21', 'STREP A TEST', 'Streptococo Beta Hemolítico Grupo “A”(Prueba Directa)', 'STREP', 2),
(1046, '90.6.7.20', 'LINFOCITOS T CD8 CITOTOXICOS', 'LINFOCITOS CD8, CITOMETRIA DE FLUJO PARA CD8', 'CD8', 1),
(1047, '908846', 'Mycobacterium Tuberculosis Detección y Resistencia', 'Mycobacterium Tuberculosis', 'MTDR', 1),
(1048, '', 'DOMICILIO SOLEDAD NOCHE', '', '', 1),
(1049, '', 'ACIDOS GRASOS (Omega 3-Omega 6), NIVELES SERICOS', 'omega 3-omega 6', 'ACNS', 1),
(1050, '', 'PREGNENOLONA', '3beta-Hydroxy-5-pregnen-20-one, 5-pregnen-3B-ol-20-one, 5-Pregnen-3beta-ol-20-one', '', 1),
(1051, '90.3.0.62', 'GASES VENOSOS', 'Medición de gases en sangre venosa', 'GASVE', 1),
(1052, '90.8.4.04', 'CARIOTIPO CON BANDEO G', 'CARIOTIPO, CARIOTIPO CON BANDAS G, ,ESTUDIO CITOGENETICO EN SANGRE PERIFERICA DEL NACIDO VIVO', 'CARBANG', 1),
(1053, '90.1.3.13 ', 'IDENTIFICACION DE MYCOBACTERIUM', '', '', 1),
(1054, '90.1.1.11', 'BACILOSCOPIA SERIADA', 'BK Seriado', 'BKS', 1),
(1055, '', 'FILARIA ESTUDIO', 'FILARIA', 'FIL', 1),
(1056, '', 'VALORACION DE CARGOS MEDIOS', 'VALORACION DE CARGOS MEDIOS', 'VCM', 1),
(1057, '90.5.7.47', 'PIRETROIDES EN ORINA', 'PIRETRINAS', 'PIR', 1),
(1058, '', 'ULTRA SONOGRAFIA DIAGNOSTICA DE MAMA CON TRADUCTOR DE 7 Mhz', 'Ultrasonografia', '', 1),
(1059, '90.5.7.36..', 'NIQUEL ', 'NI, NIQUEL EN SANGRE', 'NI', 2),
(1060, '903857', 'NITROGENO UREICO EN ORINA AL AZAR', 'BUN EN ORINA AL AZAR, NU EN ORINA, BUN EN ORINA AISLADA', 'BUNOA', 1),
(1061, '', 'TOMA DE MUESTRA DE ADN', 'SERVICIO TOMA DE MUESTRA DE PATERNIDAD', '', 1),
(1062, '905305', 'BENZODIACEPINAS CUANTITATIVOS EN ORINA', '', 'BCO', 1),
(1063, '906623', 'FACTOR DE NECROSIS TUMORAL ALFA', 'TNF', 'TNF', 1),
(1064, '1036', 'SCC ANTIGENO (CARCINOMA DE CELULAS ESCAMOSAS)', 'CARCINOMA DE CELULAS ESCAMOSAS', 'SCC', 1),
(1065, '', 'INDICE DE OMEGA 3', '', 'OME3', 1),
(1066, '90.8.3.37', 'RELACION LACTATO PIRUVATO', 'RELACION ACIDO LACTICO PIRUVICO,Lactato / Piruvato, Relacion  ', 'RELLACPIR', 1),
(1067, '901326', 'LEISHMANIA EXAMEN DIRECTO', 'Determinación de Leishmania', 'LEISH', 1),
(1068, '90.5.4.01', 'AMIKACINA', '', 'AMK', 1),
(1069, '	906.8.34', 'RAST TEST ALERGENOS PLEHUM PARENTESE', 'PLEHUM PARENTESE', 'PP', 1),
(1070, '90.3.8.20', 'CK-MB', 'CPK MB, CREATIN KINASA FRACCION MB,CKMB', 'CKMB', 1),
(1071, '330', 'CITOLOGIA DE CAPA FINA', 'Estudio de coloración básica en citología de líquido', 'CCVCF', 1),
(1072, '', 'Fluoruro  en suero', 'Fluor', 'Fl', 1),
(1073, '', 'HORMONA DE CRECIMIENTO PRIORITARIO', 'HGH, GH, HG, Somatotropina, Somatotropica, Hormona Somatotropica', 'HG P', 1),
(1074, '90.4.5.09', '17 HIDROXI PROGESTERONA', '17OH, PROGESTERONA 17 HIDROXI, 17 HIDROXIPROGESTERONA ALFA', '17OH', 1),
(1075, '90.3.0.48', 'PROTEINA PLASMATICA ASOCIADA AL EMBARAZO', 'PAPP-A', 'PAPP-A', 1),
(1076, '', 'CALCULO DEL INDICE DE TAMIZAJE DEL PRIMER TRIMESTRE', 'TAMIZAJE DEL PRIMER TRIMESTRE', 'CITPT', 1),
(1077, '	90.6.834', 'RAST TEST ALERGENOS TRUCHA', 'TRUCHA', 'RTAT', 1),
(1078, '906834  . ', 'RAST DE ARROZ', 'inmunoglobulina ige especifica para arroz', 'RASTARROZ', 1),
(1079, '90.4.8.01', 'ALDOSTERONA', 'ALDOSTERONA PLASMATICA', 'ALDOST', 1),
(1080, '90.6.2.31', 'HERPES II IGM', 'Herpes tipo II IgM, HVS II IgM, Herpes simple IgM', 'HERIIM', 1),
(1081, '90.4.1.04', 'HORMONA DE CRECIMIENTO', 'HGH, GH, HG, Somatotropina, Somatotropica, Hormona Somatotropica', 'HG', 1),
(1082, '', 'CLORO EN SUDOR CON PILOCARPINA', 'IONTOFORESIS', 'IOTF', 2),
(1083, '90.6.8.34.	 ', 'Rast Apis Mellifera (I1)(Abeja insectos, anticuerpos IgG)', 'rast Apis', 'Apis', 1),
(1084, '', 'RAST RV V5 (I209) VESPULA ANTICUERPOS IGE ', 'VESPULA', 'VESP', 1),
(1085, '', 'CORTISOL EN SALIVA', 'CORTISOL SALIVA', 'CORSAL', 1),
(1086, '', 'Aplicacion de Test de Riesgo de 1 a 30 Personas', '', 'APTR', 1),
(1087, '906211', 'Epstein Barr Virus Antígeno de Capside (VCA), Anticuerpos IgA', 'VEB VCA', 'VEB', 1),
(1088, '', 'Aplicación de Test de Riesgo Psicosocial de 31 a 50 personas', '', 'APRT', 1),
(1089, '', 'Aplicación de Test de Riesgo Psicosocial de  mas de 51 personas', '', 'apt51', 1),
(1090, '', 'ANTIGENOS BACTERIANOS EN LCR', '', '', 1),
(1091, '90.6.0.41', 'TREPONEMA PALLIDUM, ANTICUERPOS IGM', 'TREPONEMA IGM,', 'TPIGM', 1),
(1092, '90.3.4.32', '5 NUCLEOTIDASA', '5\' Ribonucleótido Fosfohidrolasa, 5\' NT', '5NT', 1),
(1093, '', 'RAST DE MANDARINA', '', 'RMAND', 1),
(1094, '1048', 'ACIDO METIL MALONICO', 'ACIDO METIL MALONICO', 'AMMO', 1),
(1095, '90.68.34', 'RAST TEST ALERGENOS BACALAO', 'BACALAO', 'RAB', 1),
(1096, '90.6.4.77', 'TRANSGLUTAMINASA IGA', 'TRANSGLUTAMINASA TISULAR IGA, ANTITRANSGLUTAMINASA IGA', 'TRANSIGA', 1),
(1097, '', 'Coenzima Q10', 'CQ10 Q10', 'CQ10', 1),
(1098, '906503', 'HLA B51', '', '', 1),
(1099, '', 'RAST DE LOLIUM PERENNE', 'LOLIUM PERENNE', 'LP', 1),
(1100, '', 'ENFERMEDAD DE HUNTINGTON - GEN IT15 TAMIZAJE (TPPCR)', 'Baile de San Vito, Corea de Huntington, Enfermedad de Huntington', '', 1),
(1101, '90.6.8.48', 'QUANTIFERON TB', 'QUANTIFERON TB (QFT)', 'QTB', 1),
(1102, '90.6.2.05', 'CITOMEGALOVIRUS IGG', 'Cito G, TORCH IgG, Anticuerpos IgG contra citomegalovirus, CMVIgG', 'CMVG', 1),
(1103, '90.3.8.50', 'CITOQUIMICO DE LIQUIDO CEFALORRAQUIDEO ', 'LCR CitoquImico', 'CLLCR', 1),
(1104, '90.3.0.42', 'PROTEINA TRANSPORTADORA DE HORMONAS SEXUALES', 'GTHS, SHBG', 'GTHS', 1),
(1105, '', 'BETA 2 TRANSFERRINA ', 'BETA 2 TRANSFERRINA EN LIQUIDO NASAL O LCR', 'B2TRANS', 1),
(1106, '90.3.8.09', 'BILIRRUBINAS', 'BT,BD, BI, BILIRRUBINAS FRACCIONADAS, BILIRRUBINA TOTAL Y DIRECTA.', 'BIL', 1),
(1107, '90.6.2.06', 'CITOMEGALOVIRUS IGM', 'Cito IgM, CMVIgM, Anticuerpos IgM contra citomegalovirus, TORCH IgM', 'CMVM', 1),
(1108, '', 'CORONAVIRUS ', 'COVID-19', 'covid', 1),
(1109, '', 'Secuenciacion Gen Col4a3', 'Sindrome de alport', '', 1),
(1110, '90.6.2.23', 'HEPATITIS B ACS. AgS', 'HEPATITIS B ANTICUERPOS CONTRA EL ANTÍGENO DE SUPERFICIE, ANTIHBS, HEPATITIS B ANTIS', 'HVBACS', 1),
(1111, '724', 'LEVETIRACETAM', 'NIVELES DE LEVETIRACETAM,LEVETIRA', 'LEVETI', 1),
(1112, '90.6.2.20', 'HEPATITIS B CORE  IgM', 'Core M de la Hepatitis B, Anticuerpos centrales IgM de la Heaptitis B, HVBCIgM', 'COREM', 1),
(1113, '90.6.2.34', 'INFLUENZA A, ANTICUERPOS IgG e IgM', '', '', 1),
(1114, '90.6.4.17', 'ANTI DNA', 'DNA nativo de doble cadena, anticuerpos anti DNA', 'DNA', 1),
(1115, '', 'Prueba de vertigo', '', 'pdev', 1),
(1116, '', 'INFORME PSICOTECNICO PARA TRABAJO EN ALTURA', 'INFORME PSICOTECNICO PARA TRABAJO EN ALTURA', 'IPPTEA', 1),
(1117, '', 'PRUEBA DE VÉRTIGO EN OCUPACIONAL', 'PRUEBA DE VÉRTIGO EN OCUPACIONAL', 'PDV', 1),
(1118, '', 'Coxsackie  A9, Anticuerpos IgG', 'Coxsackie ', 'CA9 IgG', 1),
(1119, '90.4.2.05', 'CURVA DE HORMONA DE CRECIMIENTO POST CLONIDINA', 'Crecimiento Hormona (GH) - Prueba de Estímulo con Clonidina, Somatotrópica Hormona - Prueba de Estímulo con Clonidina', 'HGPYPC', 1),
(1120, '90.6.7.12', 'LINFOCITOS T CD3 TOTALES', 'CD3, LINFOCITOS CD3, CITOMETRIA DE FLUJO PARA CD3', 'CD3', 2),
(1121, '906834-1', 'RAST DE LANGOSTA', 'RAST DE LANGOSTA', '', 1),
(1122, '90.6.7.64.', 'LINFOCITOS T CD4 AYUDADORES', 'LINFOCITOS  CD4, CD4', 'CD4', 1),
(1123, '90.6.4.08', 'CARDIOLIPINAS IGG', 'ACA, ACAS, ANTI CARDIOLIPINAS IGG, ACAS IGG', 'ACAG', 1),
(1124, '', 'Coxsackie B1-6, Anticuerpos IgG', 'Coxsackie B1-Picomavirus', 'Cox B1-6', 1),
(1125, '', 'VALORACION POS COVID-19', '', 'VPC-19', 1),
(1126, '90.6.6.20', 'BETA 2 MICROGLOBULINA', 'B2 Microglobulina, beta 2 microglobulina en suero, B2M', 'B2M', 1),
(1127, '168', 'EXTASIS', ' Metilendioximetanfetamina, MDMA, drogas de abuso', 'extas', 1),
(1128, '90.3.7.04', 'VITAMINA B2', 'RIBOFLAVINA', 'VITB2', 1),
(1129, '', 'RAST ALMEJA', 'ALMEJA', '', 1),
(1130, '', ' BIOQUIMICA  SEMINAL', 'BIOQUIMICA SEMINAL', '', 2),
(1131, '90.6.2.09', 'DENGUE CUALITATIVO', 'Dengue IgG/IgM, Anticuerpos contra dengue, dengue anticuerpos totales.', 'DENGUE', 1),
(1132, '', 'EXAMEN COMPLETO DE HECES', '', 'HEC', 2),
(1133, '90.2.0.03.', 'AGREGACION PLAQUETARIA 4 AGENTES', 'CURVA DE AGREGACION PLAQUETARIA, AGREGOMETRIA PLAQUETARIA, ADP, COLAGENO, EPINEFRINA, ACIDO ARAQUIDONICO, ACA', 'AGPL4', 1),
(1134, '906848', 'Determinación del interferón-gamma en tuberculosis', '(Interferon Gamma, IGRA)', 'IGRA', 1),
(1135, '90.6.2.49', 'HIV ANTICUERPOS', 'VIH, prueba de elisa, prueba de cuarta generacion para hiv,', 'HIV', 1),
(1136, '90.5.3.06', 'BENZODIACEPINAS EN ORINA', 'BZO, BENZODIACEPINAS CUALITATIVAS EN ORINA, OXACEPAN', 'BENZOR', 1),
(1137, '906834', 'RAST DE FRIJOL', 'FRIJOL', 'FRI', 1),
(1138, '', 'METALES EN SANGRE Y GLOBULOS ROJOS', 'METALES PESADOS EN SANGRE', 'MTS', 2),
(1139, '908421 ', 'HIBRIDACION GENOMICA COMPARADA 750K + SNPs (CGH ARRAY)', '', '', 1),
(1140, '90.6.3.02', 'ANTÍGENO P 24 Virus de inmunodeficiencia humana 1', 'Antigeno P24, HIV, VIH', 'ag p24', 1),
(1141, '90.3.0.54', 'C TELOPEPTIDO', 'B-Cross Laps, Beta Cross Laps, CTX, Enlaces Cruzados, CrossLaps (CTX)', 'CTX', 1),
(1142, '90.2.0.03', 'AGREGACION PLAQUETARIA CON RISTOCETINA', 'CURVA DE AGREGACION PLAQUETARIA, AGREGOMETRIA PLAQUETARIA CON RISTOCETINA', 'AGRPLRISTO', 1),
(1143, '90.4.9.03', 'TSH NEONATAL', 'Hormona estimulante de tiroides neonatal', 'TSHN', 2),
(1144, '90.6.0.19', 'CHLAMYDIA TRACHOMATIS IgG', 'CHLAMYDIA TRACHOMATIS IgG', 'CHTRIGG', 1),
(1145, '90.8.4.17', 'BCR ABL TRASLOCACION DE GENES CUANTITATIVO ', 'BCR ABL,CROMOSOMA FILADELFIA,PCR	TIEMPO	REAL TRANSLOCACION ABL/BCR CROMOSOMA PHILADELPHIA (9:22)  CUANTITATIV', 'BCRABL', 1),
(1146, '90.4.8.04', '17 CETOESTEROIDE', 'CETOESTEROIDE 17, 17-CS 17-KS', '17CS', 1),
(1147, '922', 'SINDROME DE POMPE SECUENCIACION GAA', 'ACTIVIDA ENZIMATICA DE ALFA GLUCOSIDASA ACIDA ', 'SGAA', 1),
(1148, '', 'SEPTINA 9', '', 'SEP', 1),
(1149, '', 'JANUS KINASA 2 JAK2 MUTACION V617F', '', 'jak2', 1),
(1150, '90.3.8.06', 'AMILASA EN ORINA', 'AMILASURIA', 'AMIO', 1),
(1151, '90.2.0.45', 'TIEMPO DE PROTROMBINA', 'TP. PT, INR', 'PT', 1),
(1152, '90.4.6.02', 'TESTOSTERONA TOTAL', 'TESTOSTERONA, ANDROGENOS', 'TEST', 1),
(1153, '90.3.4.20', 'COLINESTERASA SERICA', 'COLINESTERASA, PSEUDOCOLINESTERASA', 'COLIS', 1),
(1154, '90.6.6.04', 'MARCADOR TUMORAL CA 15.3', 'CA 15.3, MARCADOR TUMORAL DE MAMA', 'CA153', 1),
(1155, '90.3.8.35', 'FOSFORO', 'P, FOSFATEMIA,FOSFORO EN SANGRE, FOSFATO,PO4', 'P', 1),
(1156, '90.2.0.24', 'FIBRINOGENO', 'factor I, fibrinogeno por coagulación', 'FIBRI', 1),
(1157, '90.3.8.89', 'CURVA DE GLICEMIA DE 3 HORAS', 'PRUEBA DE TOLERANCIA A LA GLUCOSA 3 HORAS O 5 MUESTRAS', 'CG3H', 1),
(1158, '', 'FISH DETECCION DE ANEUPLOIDIAS 13;18;21; X y Y PRENATAL', 'FISH PRENATAL', 'FAPR', 1),
(1159, '90.3.8.69', 'UREA', 'UREA, UREMIA, AZOADOS', 'UREA', 1),
(1160, '90.3.8.18', 'COLESTEROL TOTAL', 'CT, COLESTEROL Y FRACCIONES, PERFIL LIPIDICO', 'CHOL_2', 1),
(1161, '90.3.8.28', 'DESHIDROGENASA LACTICA', 'LDH, DHL,LACTATO DESHIDROGENASA', 'LDH', 1),
(1162, '90.3.8.05', 'AMILASA EN SUERO', 'AMILASEMIA, AMILASA PANCREATICA', 'AMIS', 1),
(1163, '90.3.8.01', 'ACIDO URICO', 'AU, URICEMIA, URATO', 'AU', 1),
(1164, '90.6.6.06', 'MARCADOR TUMORAL CA 19.9', 'ca 19.9, marcador cáncer de colon, ', 'CA199', 1),
(1165, '90.6.6.25', 'BETA HCG CUANTITATIVA', 'BHCG, HCG Cuantitativa, Gonadotropina corionica cuantitativa, Sub unidad beta de gonadotropina corionica', 'BHCG', 1),
(1166, '90.4.1.08', 'PROLACTINA', 'PRL, PROLACTINA BASAL,LUTEOTROPINA', 'PRL', 1),
(1167, '90.4.5.10', 'PROGESTERONA', 'PGN,PGR, PRG, P4', 'PRG', 1),
(1168, '90.3.6.08', 'ZINC', 'ZN,NIVELES DE ZINC', 'ZN', 2),
(1169, '90.4.7.02', 'INSULINA PRE Y POST CARGA', 'INSULINA PRE Y POS, INSULINA BASAL Y POS CARGA', 'INSPYPC', 1),
(1170, '90.4.9.22', 'T4 TOTAL', 'T4,T4T,TIROXINA TOTAL', 'T4', 1),
(1171, '90.4.9.04', 'TSH ULTRASENSIBLE', 'TSH, HORMONA ESTIMULANTE DE TIROIDES,TIROTROPINA', 'TSH', 1),
(1172, '90.3.8.03', 'ALBUMINA', 'ALBUMINA EN SUERO, ALBUMINA EN SANGRE, PROTEINAS DIFERENCIADAS, RELACION ALBUMINA/GLOBULINA', 'ALB', 1),
(1173, '90.3.8.33', 'FOSFATASA ALCALINA', 'FA,FALK, FALP,F.ALCALINA,FALC', 'FAL', 1),
(1174, '90.3.0.17', 'ISOENZIMA DE FOSFATASA ALCALINA', 'ALP Isoenzimas', 'ISOE', 1);
INSERT INTO `examenes` (`id_examenes`, `codigo_cups`, `nombre_examen`, `nombre_alterno`, `abreviatura`, `estado`) VALUES
(1175, '90.3.7.06', 'VITAMINA D 25 TOTAL', 'VITAMINA D, VITAMINA D25 HIDROXI, VITAMINA D 25 TOTAL,Vitamina D, 25 - OH, Total, fraccionada', 'VitD', 1),
(1176, '', 'ANTICUERPOS CUANTITATIVOS PARA SARS-COV-2', 'ANTICUERPO  CUANTITATIVO PARA COVID-19', 'ACCCOVID', 1),
(1177, '90.6.2.56', 'HELICOBACTER PYLORI ANTIGENO EN MATERIA FECAL', 'ANTIGENO DE HELICOBACTER PYLORI EN MATERIA FECAL', 'HEPYMFECAL', 1),
(1178, '598', 'DENGUE ANTIGENO NS1', 'NSI DENGUE', 'DNSI', 1),
(1179, '90.3.4.37', 'TROPONINA I CUANTITATIVA', 'Troponina I cuantitativa, Troponina, Perfil cardiaco, troponina cardiaca', 'TROP', 1),
(1180, '90.8.3.38.', 'AMINOACIDOS EN ORINA', '', 'AAORINA', 1),
(1181, '90.8.3.38', 'AMINOACIDOS EN PLASMA', '', 'AAPLASMA', 1),
(1182, '90.3.6.02', 'AMONIO', 'NH3, niveles de amonio', 'AMON', 1),
(1183, '', 'PROTEÍNA EPIDIDIMAL HUMANA 4 ', 'HE-4 (Proteína Epididimal Humana) - Monitoreo Cáncer de Ovario, Incluye CA 125, Perfil Roma                                                 ', 'PEPID', 1),
(1184, '90.30.65', 'PRO PEPTIDO NATRIURETICO BNP', '', 'PROBNP', 1),
(1185, '', 'HISOPADO NASOFARINGEO ANTÍGENO  COVID-19', 'ANTIGENO COVID-19', 'AG-COVID19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia_compra`
--

CREATE TABLE `frecuencia_compra` (
  `id_frecuencia_compra` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `tiempo_reorden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `frecuencia_compra`
--

INSERT INTO `frecuencia_compra` (`id_frecuencia_compra`, `descripcion`, `tiempo_reorden`) VALUES
(1, 'mi primera frecuencia', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_clientes`
--

CREATE TABLE `grupo_clientes` (
  `id_grupo_clientes` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identificacion_empresa`
--

CREATE TABLE `identificacion_empresa` (
  `id_empresa` int(10) NOT NULL,
  `identificacion_legal` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `codigo_ria` int(50) DEFAULT NULL,
  `licencia` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nombre_empresa` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `pais` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telefono` int(100) DEFAULT NULL,
  `codigo_postal` int(100) DEFAULT NULL,
  `fax` int(100) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `direccion_electronica` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_day_kit`
--

CREATE TABLE `info_day_kit` (
  `id_info_day_kit` int(11) NOT NULL,
  `n_pruebas` int(11) DEFAULT NULL,
  `n_calibradores` int(11) DEFAULT NULL,
  `n_controles` int(11) DEFAULT NULL,
  `n_verificaciones` int(11) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL COMMENT 'Especifica si el dia esta abierto cerrado\n1 Abierto\n2 Cerrado',
  `start` date DEFAULT NULL,
  `id_info_live_kit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `info_day_kit`
--

INSERT INTO `info_day_kit` (`id_info_day_kit`, `n_pruebas`, `n_calibradores`, `n_controles`, `n_verificaciones`, `comentario`, `estado`, `start`, `id_info_live_kit`) VALUES
(5, 20, 5, 2, 0, '', 1, '2022-06-28', 4),
(6, 70, 2, 1, 0, '', 1, '2022-06-29', 4),
(7, 100, 0, 0, 0, '', 1, '2022-06-29', 5),
(8, 20, 5, 1, 5, '', 1, '2022-06-29', 6),
(9, 10, 10, 20, 6, '', 1, '2022-06-30', 6),
(10, 0, 0, 0, 0, '', 1, '2022-07-01', 6),
(11, 0, 0, 0, 0, '', 1, '2022-07-03', 6),
(12, 10, 8, 4, 1, '', 1, '2022-07-05', 6),
(13, 0, 0, 0, 0, '', 1, '2022-07-08', 6),
(14, 25, 2, 6, 0, '', 1, '2022-07-11', 8),
(15, 0, 2, 0, 0, '', 1, '2022-07-12', 8),
(16, 0, 0, 0, 0, '', 1, '2022-07-15', 8),
(17, 20, 0, 0, 0, '', 1, '2022-07-18', 10),
(18, 20, 0, 0, 0, '', 1, '2022-07-18', 8),
(19, 0, 100, 0, 0, '', 1, '2022-07-22', 10),
(20, 150, 10, 0, 0, '', 1, '2022-10-18', 11),
(21, 30, 30, 30, 30, '', 1, '2022-10-19', 11),
(22, 5, 2, 0, 1, '', 1, '2022-10-19', 12),
(23, 1, 0, 0, 0, '', 1, '2022-10-20', 12),
(24, 20, 5, 2, 2, 'mi descripción', 1, '2022-10-20', 13),
(25, 0, 1, 0, 0, '', 1, '2023-02-16', 15),
(26, 0, 1, 1, 0, '', 1, '2023-02-16', 16),
(27, 0, 1, 0, 0, '', 1, '2023-02-16', 17),
(28, 0, 2, 1, 0, '', 1, '2023-03-17', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_kit`
--

CREATE TABLE `info_kit` (
  `id_info_kit` int(11) NOT NULL,
  `id_examenes` int(11) DEFAULT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `valor_reactivo` int(11) DEFAULT NULL,
  `name_examen` varchar(145) DEFAULT NULL,
  `codigo_cups` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL COMMENT '1 Abierto\n2 cerrado\n\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `info_kit`
--

INSERT INTO `info_kit` (`id_info_kit`, `id_examenes`, `descripcion`, `valor_reactivo`, `name_examen`, `codigo_cups`, `fecha`, `estado`) VALUES
(1, 11, NULL, NULL, 'TRIGLICERIDOS', '90.3.8.68', '2022-06-02', 1),
(2, 1135, NULL, NULL, 'HIV ANTICUERPOS', '90.6.2.49', '0000-00-00', 1),
(3, 882, NULL, NULL, 'BIOTINA', '', '0000-00-00', 1),
(4, 1021, NULL, NULL, 'HEMOCLASIFICACION', '91.1.0.18', '0000-00-00', 1),
(5, 647, NULL, NULL, 'ACIDO FOLICO', '90.3.1.05', '2022-06-12', 1),
(6, 1130, NULL, NULL, ' BIOQUIMICA  SEMINAL', '', '2022-06-08', 1),
(7, 179, NULL, NULL, 'CROMO EN SANGRE', '695', '0000-00-00', 1),
(8, 1146, NULL, NULL, '17 CETOESTEROIDE', '90.4.8.04', '2022-10-02', 1),
(9, 1092, NULL, NULL, '5 NUCLEOTIDASA', '90.3.4.32', '2022-10-26', 1),
(10, 911, NULL, NULL, 'ACIDO FORMICO', '90.3.1.07', '2022-10-10', 1),
(11, 1163, NULL, NULL, 'ACIDO URICO', '90.3.8.01', '2022-10-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_kit_has_sedes`
--

CREATE TABLE `info_kit_has_sedes` (
  `info_kit_id_info_kit` int(11) NOT NULL,
  `sedes_id_sedes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `info_kit_has_sedes`
--

INSERT INTO `info_kit_has_sedes` (`info_kit_id_info_kit`, `sedes_id_sedes`) VALUES
(7, 1),
(7, 8),
(7, 10),
(8, 8),
(9, 1),
(10, 3),
(11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_live_kit`
--

CREATE TABLE `info_live_kit` (
  `id_info_live_kit` int(11) NOT NULL,
  `n_pruebas` varchar(45) DEFAULT NULL,
  `n_controles` varchar(45) DEFAULT NULL,
  `n_calibradores` varchar(45) DEFAULT NULL,
  `n_verificaciones` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `end_live` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `id_info_kit` int(11) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `referencia_interna` varchar(45) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `pruebas_permitidas` int(11) DEFAULT NULL,
  `bonificables` tinyint(1) DEFAULT NULL,
  `id_sedes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `info_live_kit`
--

INSERT INTO `info_live_kit` (`id_info_live_kit`, `n_pruebas`, `n_controles`, `n_calibradores`, `n_verificaciones`, `comentario`, `date_start`, `date_expiration`, `end_live`, `estado`, `id_info_kit`, `codigo`, `referencia_interna`, `costo`, `pruebas_permitidas`, `bonificables`, `id_sedes`) VALUES
(4, NULL, NULL, NULL, NULL, '', '2022-06-28 00:00:00', '2022-07-06', NULL, 2, 1, '4554', '561', 150000, 100, 1, 1),
(5, NULL, NULL, NULL, NULL, '', '2022-06-29 00:00:00', '2022-07-09', NULL, 2, 1, '456456', '4654', 150000, 100, 1, 2),
(6, NULL, NULL, NULL, NULL, '', '2022-06-29 00:00:00', '2022-07-08', NULL, 2, 1, '525463', '456456', 150000, 100, 0, 8),
(7, NULL, NULL, NULL, NULL, '', '2022-06-30 00:00:00', '2022-06-29', NULL, 2, 2, '42423', '423423', 130000, 100, 0, 1),
(8, NULL, NULL, NULL, NULL, '', '2022-07-11 00:00:00', '2022-07-20', NULL, 2, 1, '2353', '63453', 150000, 100, 0, 1),
(9, NULL, NULL, NULL, NULL, '', '2022-07-11 00:00:00', '2022-07-13', NULL, 1, 5, '454', '44477', 15000, 100, 0, 1),
(10, NULL, NULL, NULL, NULL, '', '2022-07-14 00:00:00', '2022-07-30', NULL, 2, 7, '152432', '15245', 150000, 200, 1, 1),
(11, NULL, NULL, NULL, NULL, '', '2022-10-18 00:00:00', '2022-10-31', NULL, 2, 9, '1515415', '1214554', 150000, 100, 0, 1),
(12, NULL, NULL, NULL, NULL, '', '2022-10-19 00:00:00', '2022-10-21', NULL, 2, 10, '45454', '15454', 150000, 10, 0, 1),
(13, NULL, NULL, NULL, NULL, '', '2022-10-20 00:00:00', '2022-10-31', NULL, 2, 1, '1212541', '554155', 150000, 100, 1, 1),
(14, NULL, NULL, NULL, NULL, '', '2022-10-20 00:00:00', '2022-10-21', NULL, 2, 11, '23543', '3453', 120000, 100, 0, 1),
(15, NULL, NULL, NULL, NULL, '3r32rr2r23', '2023-02-16 00:00:00', '2023-02-21', NULL, 2, 1, '95544564653', '1212', 2232, 2, 0, 1),
(16, NULL, NULL, NULL, NULL, '', '2023-02-16 00:00:00', '2023-03-03', NULL, 2, 1, '4546', '412', 2323, 23, 1, 1),
(17, NULL, NULL, NULL, NULL, '', '2023-02-16 00:00:00', '2023-03-08', NULL, 2, 1, '112121212', '22', 23232, 2, 0, 1),
(18, NULL, NULL, NULL, NULL, 'wqrewf', '2023-03-17 00:00:00', '2023-03-31', NULL, 1, 10, '123456', '32365', 2131, 33, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mano_obra_directa`
--

CREATE TABLE `mano_obra_directa` (
  `id_mano_obra_directa` int(11) NOT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `id_area_laboratorio` int(11) DEFAULT NULL,
  `id_seccion_empresa` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `tiempo_dedicacion` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `mano_obra_directa`
--

INSERT INTO `mano_obra_directa` (`id_mano_obra_directa`, `id_sede`, `id_area_laboratorio`, `id_seccion_empresa`, `id_cargo`, `id_empleado`, `tiempo_dedicacion`, `fecha`, `valor`) VALUES
(1, 1, 3, 2, 1, 1, 8, '2022-06-08', 1500000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marcas` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_glosas`
--

CREATE TABLE `motivos_glosas` (
  `id_motivos_glosas` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `motivos_glosas`
--

INSERT INTO `motivos_glosas` (`id_motivos_glosas`, `descripcion`, `estado`) VALUES
(1, 'hola erick', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_pqr`
--

CREATE TABLE `motivos_pqr` (
  `id_motivos_pqr` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `motivos_pqr`
--

INSERT INTO `motivos_pqr` (`id_motivos_pqr`, `descripcion`) VALUES
(11, 'hola bb como estas este todo bien'),
(17, 'este es mi primer registro'),
(21, 'jodaaaaa erick');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_seguimiento`
--

CREATE TABLE `motivos_seguimiento` (
  `id_motivos_seguimiento` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `motivos_seguimiento`
--

INSERT INTO `motivos_seguimiento` (`id_motivos_seguimiento`, `descripcion`) VALUES
(1, 'primer motivo de seguimiento holis'),
(2, 'otro motivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedencias`
--

CREATE TABLE `procedencias` (
  `id_procedencias` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `id_tipo_procedencia` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `procedencias`
--

INSERT INTO `procedencias` (`id_procedencias`, `descripcion`, `id_tipo_procedencia`, `estado`) VALUES
(2, 'mi primera descripción otra modificacion', 2, 1),
(3, 'otra procedencia', 1, NULL),
(4, 'otro estado', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `id_categoria_producto` int(11) DEFAULT NULL,
  `nombre` varchar(245) DEFAULT NULL,
  `presentacion` varchar(145) DEFAULT NULL,
  `id_unidad_medida` int(11) DEFAULT NULL,
  `clasificacion_riesgo` int(11) DEFAULT NULL,
  `nombre_imagen` varchar(45) DEFAULT NULL,
  `nombre_ficha_tecnica` text DEFAULT NULL,
  `cantidad_presentacion` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `id_categoria_producto`, `nombre`, `presentacion`, `id_unidad_medida`, `clasificacion_riesgo`, `nombre_imagen`, `nombre_ficha_tecnica`, `cantidad_presentacion`, `estado`) VALUES
(1, NULL, 'CIO2 Microclean 2L 100A - 1 Pouch', '1 kit ', NULL, 0, NULL, '', 0, 1),
(2, NULL, 'ELEMENTOS ADICIONALES. 1 VIGA PARA 3 PUESTOS ', '', NULL, 0, NULL, '', 0, 1),
(3, NULL, 'ACIDO MURIATICO ', '1 galon', NULL, 0, NULL, '', 0, 1),
(4, NULL, 'CAMISETA TIPO POLO CON 1 BORDADO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(5, NULL, 'BENEDICT PRUEBA AZUCARES REDUCTORES EN HECES', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 2),
(6, NULL, 'BACTISAN SPRAY ', 'Und x 400cc ', NULL, 0, NULL, '', 0, 1),
(7, NULL, 'BOLSA GRIS MEDIANA. 56*58', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 2),
(8, NULL, 'BOLSA ROJA EXTRA JUMBO 89*114', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(9, NULL, 'ALCOHOL ACIDO Z.N.', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(10, NULL, 'AZUCAR INCAUCA ', 'Paquete x 200 sobres', NULL, 0, NULL, '', 0, 1),
(11, NULL, 'VASO DESECHABLE CAFETERO ', 'Paquete x 50 und', NULL, 0, NULL, '', 0, 1),
(12, NULL, 'BOLSA GRIS JUMBO 70*100', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 2),
(13, NULL, 'VASO ICOPOR 4 OZ ', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(14, NULL, 'AGAR CROMOGENICO BRILLANCE UTI CLARITY', 'Frasco x 500 gr', NULL, 0, NULL, '', 0, 1),
(15, NULL, 'AGAR CLED', 'Frasco por 500 gr', NULL, 0, NULL, '', 0, 1),
(16, NULL, 'AST-N271 TEST KIT', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(17, NULL, 'CHUPETAS ', 'Bolsa x 25 unidades', NULL, 0, NULL, '', 0, 1),
(18, NULL, 'AMOXACILINA ACIDO CLAVULANICO', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(19, NULL, 'CERA PARA SELLAR HEMATOCRITO MARCA BRAND', 'Unidad', NULL, 0, NULL, '', 0, 1),
(20, NULL, 'AMIKACIN 30 ug', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(21, NULL, 'AGAR SABOUROUD', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(22, NULL, 'BOLSA VERDE MEDIANA 65*80', 'Paquete x 20', NULL, 0, NULL, '', 0, 1),
(23, NULL, 'AGAR EMB (EOSIN METHYLENE BLUE LEVINE) EOSINA AZUL DE METILO', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(24, NULL, 'BOLSA ROJA PEQUEÑA 56*58', 'Paquete x 20 unidades', NULL, 0, NULL, '', 0, 1),
(25, NULL, 'EOSINA 1% ACUOSA', 'Frasco x 100 ml', NULL, 0, NULL, '', 0, 1),
(26, NULL, 'FIELD SOLUCION A', 'Frasco x 200 ml', NULL, 0, NULL, '', 0, 2),
(27, NULL, 'AGAR SS MODIFICADO SALMONELLA SHIGELLA X 500 GRS', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(28, NULL, 'AGAR XYLOSE LYSINE DEOXYCHOLATE MODIFIED', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(29, NULL, 'CA 19-9', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(30, NULL, 'AGAR OGAWA KUDOH', 'Caja x 20 tubos', NULL, 0, NULL, '', 0, 1),
(31, NULL, 'AMPICILINA 25UG', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(32, NULL, 'AMPICILINA SULBACTAM 20 Ug', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(33, NULL, 'CAFÉ AGUILA ROJA 500 GR', 'Bolsa x 500 grs', NULL, 0, NULL, '', 0, 1),
(34, NULL, 'BALDE PLASTICO DE 12 LTS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(35, NULL, 'CA 125II', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(36, NULL, 'CA 15-3', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(37, NULL, 'AZUL DE CRESILO BRILLANTE', 'Frasco x 50 ml', NULL, 0, NULL, '', 0, 1),
(38, NULL, 'AGAR MUELLER HINTON II', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(39, NULL, 'CEA (ANTIGENO CARCINOEMBRIONARIO)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(40, NULL, 'ECOR (CORTISOL)', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(41, NULL, 'EE2 (ESTRADIOL)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(42, NULL, 'FSH (HORMONA FOLICULO ESTIMULANTE)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(43, NULL, 'VASO CONICO 6,0 OZ ', 'Paquete x125 u', NULL, 0, NULL, '', 0, 1),
(44, NULL, 'FT3 (T3 LIBRE)', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(45, NULL, 'FT4 (T4 LIBRE)', 'Kit de 250 pruebas', NULL, 0, NULL, '', 0, 1),
(46, NULL, 'HBsAg (HBs) HBsII (Antigeno contra la superficie)', 'Kit de 200 pruebas', NULL, 0, NULL, '', 0, 1),
(47, NULL, 'AGAR BASE SANGRE (BLOOD AGAR BASE No. 2)', 'Frasco x 500g', NULL, 0, NULL, '', 0, 1),
(48, NULL, 'ATOMIZADOR CON ENVASE', 'Frasco 500cc', NULL, 0, NULL, '', 0, 1),
(49, NULL, 'AMPOLLA ESTERIL CONTROL GST E6', '20 amp', NULL, 0, NULL, '', 0, 1),
(50, NULL, 'BOLSA GRIS EXTRA JUMBO 94*127', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(51, NULL, 'FIELD SOLUCION A PARA MALARIA X 50ML', 'Frasco x 50 ml', NULL, 0, NULL, '', 0, 1),
(52, NULL, 'BOLSA ROJA JUMBO 94*127', 'Jumbo paq x 20', NULL, 0, NULL, '', 0, 2),
(53, NULL, 'BOLSA GRIS PEQUEÑA 46*51', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(54, NULL, 'PALILLOS ', 'Paquete x 180 und', NULL, 0, NULL, '', 0, 1),
(55, NULL, 'REVOLVEDORES', 'Paquete x 1000 und', NULL, 0, NULL, '', 0, 1),
(56, NULL, 'AMBIENTADOR BONAIRE ', 'Frasco x 400 ml', NULL, 0, NULL, '', 0, 1),
(57, NULL, 'BANDEJA AUTOSERVICIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(58, NULL, 'SERVILLETAS ', 'Paquete x 100 unds', NULL, 0, NULL, '', 0, 1),
(59, NULL, 'AZUCAR INCAUCA BOLSA X 500 GRS', 'Bolsa x 500 gramos', NULL, 0, NULL, '', 0, 1),
(60, NULL, 'VASO TUC 10 OZ', 'Paquete x 25 und', NULL, 0, NULL, '', 0, 1),
(61, NULL, 'CALIFICACION DE DESEMPEÑO A CABINA DE SEGURIDAD BIOLOGICA MARCA AIRR 100 ', '', NULL, 0, NULL, '', 0, 1),
(62, NULL, 'HIV CENTAURO', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(63, NULL, 'AZUL DE METILENO Z.N.', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 1),
(64, NULL, 'BAJALENGUAS ', 'Paq x 20 und', NULL, 0, NULL, '', 0, 1),
(65, NULL, 'DESINFECTANTE FABULOSO', 'Botella x 2lt', NULL, 0, NULL, '', 0, 1),
(66, NULL, 'IGE (INMUNOGLOBULINA E TOTAL)', 'Kit de 250 pruebas', NULL, 0, NULL, '', 0, 1),
(67, NULL, 'CEPILLO LAVA SANITARIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(68, NULL, 'IRI (INSULINA)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(69, NULL, 'LH (HORMONA LUTEINIZANTE)', 'Kit de 300 pruebas', NULL, 0, NULL, '', 0, 1),
(70, NULL, 'PRGE (PROGESTERONA)', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(71, NULL, 'LUSTRAMUEBLE ', '500 ml', NULL, 0, NULL, '', 0, 1),
(72, NULL, 'PRL (PROLACTINA)', 'Kit de 250 pruebas', NULL, 0, NULL, '', 0, 1),
(73, NULL, 'GUANTES DE NITRILO VERDE TALLA 8', 'Par', NULL, 0, NULL, '', 0, 1),
(74, NULL, 'DESINCRUSTANTE KLIN LIMPIA JUNTAS ', '3 litros', NULL, 0, NULL, '', 0, 1),
(75, NULL, 'PSA TOTAL', 'Kit de 500 pruebas', NULL, 0, NULL, '', 0, 1),
(76, NULL, 'CURDEX (CARGA DE GLUCOSA ALBOR) 50*25 GRS', 'Caja x 50 sobres', NULL, 0, NULL, '', 0, 1),
(77, NULL, 'AMPOLLA DE SYNACTHENE 1 mg/ml', 'Vial x 1 ml', NULL, 0, NULL, '', 0, 1),
(78, NULL, 'PTH (iPTH)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(79, NULL, 'CURDEX LIQUIDO SABOR NARANJA', 'Galon * 4000 ml', NULL, 0, NULL, '', 0, 1),
(80, NULL, 'BOLSA VERDE PEQUEÑA 56*58', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(81, NULL, 'DETER PLUS', '4 lt', NULL, 0, NULL, '', 0, 1),
(82, NULL, 'RUBEOLA IGG ', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(83, NULL, 'CONDUGEL X 240 CC', 'Frasco *240 cc', NULL, 0, NULL, '', 0, 1),
(84, NULL, 'ALCOHOL ANTISEPTICO 700ML JGB', 'Botella x 500 ml', NULL, 0, NULL, '', 0, 1),
(85, NULL, 'ALGODÓN EN TORUNDAS 500 GRS', 'Bolsa', NULL, 0, NULL, '', 0, 1),
(86, NULL, 'RUBEOLA IGM', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(87, NULL, 'ESCOBA ', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(88, NULL, 'SIFILIS (SYPH)', 'Kit de 200 pruebas', NULL, 0, NULL, '', 0, 1),
(89, NULL, 'JABON ESPUMA KLEENEX ', 'Unidad 800cc', NULL, 0, NULL, '', 0, 1),
(90, NULL, 'ESPONJILLA  DORADA/PLATA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(91, NULL, 'T3 TRIYODORITONINA ', 'Kit de 400 pruebas', NULL, 0, NULL, '', 0, 1),
(92, NULL, 'CLORURO DE SODIO', 'X 500ml', NULL, 0, NULL, '', 0, 1),
(93, NULL, 'ESPONJILLA DOBLE USO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(94, NULL, 'T4 TRIYODORITONINA', 'Kit de 500 pruebas', NULL, 0, NULL, '', 0, 1),
(95, NULL, 'TESTOSTERONA (TSTO II)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(96, NULL, 'GEL ANTIBACTERIAL', '500cc', NULL, 0, NULL, '', 0, 1),
(97, NULL, 'ISOPO LAVADO DE MATERIAL', 'Grande', NULL, 0, NULL, '', 0, 1),
(98, NULL, 'ISOPO LAVADO DE MATERIAL ', 'Mediano', NULL, 0, NULL, '', 0, 1),
(99, NULL, 'DETERGENTE AS ', '1000 gr', NULL, 0, NULL, '', 0, 2),
(100, NULL, 'ISOPO LAVADO DE MATERIAL ', 'Pequeño', NULL, 0, NULL, '', 0, 1),
(101, NULL, 'TOXOPLASMA IGG', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(102, NULL, 'AST-N272 TEST KIT', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(103, NULL, 'TOALLITA IMPREGNADA DE ALCOHOL LARGA ESTERIL', 'Caja x 100 unds', NULL, 0, NULL, '', 0, 1),
(104, NULL, 'AZUL DE BROMOTIMOL', 'Frasco x 50ml', NULL, 0, NULL, '', 0, 1),
(105, NULL, 'AST-P577 TEST KIT', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(106, NULL, 'DETERGENTE AS', 'Bolsa 500gr', NULL, 0, NULL, '', 0, 1),
(107, NULL, 'BOLSA VERDE', 'Mini paq x 20', NULL, 0, NULL, '', 0, 2),
(108, NULL, 'APLICADOR DESECHABLE ', 'Paq x 100 unidades', NULL, 0, NULL, '', 0, 1),
(109, NULL, 'GUANTES DOMESTICOS CALIBRE 35 TALLA 8', 'Par', NULL, 0, NULL, '', 0, 1),
(110, NULL, 'GUANTES DOMESTICOS NEGROS CALIBRE 25 TALLA 8', 'Par', NULL, 0, NULL, '', 0, 1),
(111, NULL, 'CAMISAS (portatubos corto)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(112, NULL, 'CURDEX LIQUIDO NARANJA (BOTELLA *300 ML)', 'Caja x 90 unids', NULL, 0, NULL, '', 0, 2),
(113, NULL, 'AGUJA DESECHABLE HIPODÉRMICA 23G*1 ', 'Caja x 100 unds', NULL, 0, NULL, '', 0, 1),
(114, NULL, 'ASTREONAM 30 Ug', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(115, NULL, 'BATA MANGA CORTA PARA CITOLOGIA DESECHABLE AZUL ', 'Paq x 10 und', NULL, 0, NULL, '', 0, 1),
(116, NULL, 'AGUJA TOMA MULTIPLE 21G*1\" VACUTAINER', 'Caja x 100 unds', NULL, 0, NULL, '', 0, 1),
(117, NULL, ' FIELD AZUL MET FOSFATADO X 200 PARA MALARIA', 'Frasco x 200 ml', NULL, 0, NULL, '', 0, 1),
(118, NULL, 'FIELD SOLUCION B', 'Frasco x 200 ml', NULL, 0, NULL, '', 0, 1),
(119, NULL, 'AGUA DESTILADA BAXTER', 'Bolsa x 500 ml', NULL, 0, NULL, '', 0, 1),
(120, NULL, 'AZUL DE LACTOFENOL', 'Frasco x 100 ml', NULL, 0, NULL, '', 0, 1),
(121, NULL, 'CREMA LAVAPLATOS ', '450 gr', NULL, 0, NULL, '', 0, 1),
(122, NULL, 'BOLSA PEDIATRICA DE ORINA ', 'Paq x 50 und', NULL, 0, NULL, '', 0, 1),
(123, NULL, 'LIMPIA JUNTAS ', ' 3785 cc', NULL, 0, NULL, '', 0, 1),
(124, NULL, 'CPU JANUS CELERON 2.41 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(125, NULL, 'TOXOPLASMA IGM', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1),
(126, NULL, 'TSH3 ULTRA', 'Kit de 500 pruebas', NULL, 0, NULL, '', 0, 1),
(127, NULL, 'GUANTE VINILO TALLA L', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(128, NULL, 'GUANTE DE LATEX  TALLA L', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(129, NULL, 'ELEMENTOS ADICIONALES. 1 VIGA, PATAS Y ACCESORIOS PARA 1 PUESTO', '', NULL, 0, NULL, '', 0, 1),
(130, NULL, 'VITAMINA D (VIT D)', 'Kit de 100 pruebas', NULL, 0, NULL, '', 0, 1),
(131, NULL, 'TIRAS ONE CALL PLUS DE APOYO P/TIRAS ACON', 'Caja x 50 tiras', NULL, 0, NULL, '', 0, 1),
(132, NULL, 'GLUCOMETRO TRUETEST MG-DL, LATAM SPANISH', 'Unidad', NULL, 0, NULL, '', 0, 1),
(133, NULL, 'PALO PORTAMECHA INDUSTRIAL FULLER 140CM', 'Unidad', NULL, 0, NULL, '', 0, 1),
(134, NULL, 'DHEA-S', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(135, NULL, 'PALA RECOGEDORA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(136, NULL, 'CEFTAZIDIME 30 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(137, NULL, 'Tube Top Sample Cup 1ml', '1000 pruebas', NULL, 0, NULL, '', 0, 1),
(138, NULL, 'CEFEPIME 30 Ug', 'Caja de 5 tubos x 50 discos', NULL, 0, NULL, '', 0, 1),
(139, NULL, 'CEFALOTINA', 'Vial x 50 unidades', NULL, 0, NULL, '', 0, 1),
(140, NULL, 'CURITAS REDONDAS PEDIATRICAS ELITE', 'Caja x 500 unidades', NULL, 0, NULL, '', 0, 2),
(141, NULL, 'GUANTE DE LATEX TALLA XS', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(142, NULL, 'CEFINASA ', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(143, NULL, 'CURITAS REDONDAS PEDIATRICAS', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(144, NULL, 'CLAMIDIA (CHLAMYDIA) PRUEBA RÁPIDA ', 'Caja x 25 pruebas', NULL, 0, NULL, '', 0, 1),
(145, NULL, 'JERINGA PRECISION 10 ML ', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(146, NULL, 'HIDROXIDO DE POTASIO 10% KOH', 'Frasco x 100 ml', NULL, 0, NULL, '', 0, 1),
(147, NULL, 'GUANTE DE LATEX  TALLA S', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(148, NULL, 'JERINGA PRECISION 1 ML INSULINA ', 'Caja x 100', NULL, 0, NULL, '', 0, 1),
(149, NULL, 'GUANTE DE LATEX  TALLA M', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(150, NULL, 'PAPEL INDICADOR PH 1-14', 'X 200 tiras', NULL, 0, NULL, '', 0, 1),
(151, NULL, 'GORRO ORUGA AZUL', 'Bolsa x 100', NULL, 0, NULL, '', 0, 1),
(152, NULL, 'PAPELERA ROJA DE 121 LTS ', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(153, NULL, 'GLOBO R-12 LOGO PASTEUR (una tinta dos caras)', 'Bolsa x 100 unidades', NULL, 0, NULL, '', 0, 1),
(154, NULL, 'PAPELERA ROJA PEDAL DE 20 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(155, NULL, 'ACIDO VALPROICO (VALP)', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(156, NULL, 'HBC IGM (CORE M)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(157, NULL, 'AHBE (Anti-Hbe)', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(158, NULL, 'ANTI TPO (ATPO)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(159, NULL, 'ANTITIROGLOBULINA (ATG) LOTE: 283', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(160, NULL, 'CARBAMAZEPINA (CARB)', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(161, NULL, 'FERRITINA (FER)', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(162, NULL, 'FOLATO (FOL)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(163, NULL, 'ESPECULO VAGINAL DESECHABLE ', 'Bolsa x 100 unidades', NULL, 0, NULL, '', 0, 1),
(164, NULL, 'ANDROSTENEDIONA', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(165, NULL, 'GUANTE VINILO TALLA M ', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(166, NULL, 'GUANTES PLÁSTICOS PARA CITOLOGÍA', 'Bolsa x 100 unidades', NULL, 0, NULL, '', 0, 1),
(167, NULL, 'JERINGA HEPARINIZADA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(168, NULL, 'FOB SANGRE OCULTA EN HECES FECALES', 'Caja x 25 test', NULL, 0, NULL, '', 0, 1),
(169, NULL, 'FIELD SALES FOSFATADAS 10/5 BUFFER PARA MALARIA (SOL AMORTIGUA)', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 2),
(170, NULL, 'LIQUIDO PARA ESPERMOGRAMA (MACOMBER) NOVALAB', 'Frasco x 250 ml', NULL, 0, NULL, '', 0, 1),
(171, NULL, 'LIMPIAVIDRIOS ', '500 cc ', NULL, 0, NULL, '', 0, 1),
(172, NULL, 'MECHA ALGODÓN 160gr', 'Unidad', NULL, 0, NULL, '', 0, 1),
(173, NULL, 'MECHA SINTETICA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(174, NULL, 'GUANTES VINILO TALLA S ', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(175, NULL, 'PANO ABRASIVO VERDE ETERNA 9*11CM', 'Unidad', NULL, 0, NULL, '', 0, 1),
(176, NULL, 'CEFUROXIME 30 Mcg', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(177, NULL, 'CEFTRIAZONE 30 Mcg', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(178, NULL, 'CEFOXITIN 30 Ug', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(179, NULL, 'PANO WYPALL X 80 plus', 'Paquete x 25 ', NULL, 0, NULL, '', 0, 2),
(180, NULL, 'PAPEL HIGIENICO JUMBO NATURAL ', 'Rollo x 250 mts', NULL, 0, NULL, '', 0, 1),
(181, NULL, 'LUGOL PARASITOLOGICO', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(182, NULL, 'LUGOL PARASITOLOGICO', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 1),
(183, NULL, 'PAPELERA VERDE PEDAL DE 20 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(184, NULL, 'PAPELERA VERDE VAIVEN DE 53 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(185, NULL, 'SPIN-ROTAVIRUS', 'X 20 pbs', NULL, 0, NULL, '', 0, 1),
(186, NULL, 'PORTAMECHA 060 SIN MANGO ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(187, NULL, 'CONTROL DE CALIDAD EXTERNO MLE PARASITOLOGIA.', '50 parametros. 3 eventos', NULL, 0, NULL, '', 0, 1),
(188, NULL, 'Tube Top Sample Cup 2ml', '1 kit ', NULL, 0, NULL, '', 0, 1),
(189, NULL, 'CINTA CONTROL ESTERILIZACIÓN A VAPOR', 'Rollo', NULL, 0, NULL, '', 0, 1),
(190, NULL, 'TOALLA SCOTT NATURAL HD 150H VERTICAL', 'Rollo', NULL, 0, NULL, '', 0, 1),
(191, NULL, 'ACIDO URICO (UA)', 'Kit 980 pruebas', NULL, 0, NULL, '', 0, 1),
(192, NULL, 'ALANINA AMINOTRANSFERASA (ALT)', 'Kit x 2520 pruebas', NULL, 0, NULL, '', 0, 1),
(193, NULL, 'TERMOSTATO DIGITAL PROGRAMABLE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(194, NULL, 'CLINDAMICYN 2 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(195, NULL, 'LAMINAS CUBRE OBJETOS 22*60 MM ', 'Estuche x 100 unidades', NULL, 0, NULL, '', 0, 2),
(196, NULL, 'LUTEOLIBERINA (LHRH) 100 mcg - GNRH', 'Ampolla x 2', NULL, 0, NULL, '', 0, 1),
(197, NULL, 'MOPA AZUL PREMIUN X 20 OZ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(198, NULL, 'LAMINA PORTAOBJETOS 3\"*1 ', 'Caja x 50 unds', NULL, 0, NULL, '', 0, 1),
(199, NULL, 'ERITROMICYN 15 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(200, NULL, 'DESMANCHADOR PARA BAÑO ', '3.700 ml', NULL, 0, NULL, '', 0, 1),
(201, NULL, 'VARSOL SIN OLOR ', 'Frasco x 460ml', NULL, 0, NULL, '', 0, 1),
(202, NULL, 'TNI (TROPONINA ULTRA)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(203, NULL, 'CIPROFLOXACIN 5 Ug', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(204, NULL, 'BRILLADOR DE ALGODON 59 CM CON SOPORTE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(205, NULL, 'ERTAPENEM 10 Ug', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(206, NULL, 'Calibrador 66 (INSULINA)', 'Kit de 2x2ml. x nivel', NULL, 0, NULL, '', 0, 2),
(207, NULL, 'BRILLADOR DE ALGODON 82 CM CON SOPORTE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(208, NULL, 'LIMPIACRISTAL MANGO METALICO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(209, NULL, 'Calibrador 43 (CA 15-3)', 'Kit de 2x2 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(210, NULL, 'Calibrador 80', 'Kit de 2 viales x 5 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(211, NULL, 'Calibrador A', 'Kit de 2x5ml. x nivel', NULL, 0, NULL, '', 0, 1),
(212, NULL, 'Calibrador CA 125 ', 'Kit de 2 viales x 2 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(213, NULL, 'Calibrador E', 'Kit de 2x2ml. x nivel.', NULL, 0, NULL, '', 0, 1),
(214, NULL, 'Calibrador IPTH CAL 56', 'Kit de 2 pk', NULL, 0, NULL, '', 0, 1),
(215, NULL, 'Calibrador Q (PSA)', 'Kit de 2x2ml. x nivel', NULL, 0, NULL, '', 0, 1),
(216, NULL, 'HAV IGM (aHAVM)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(217, NULL, 'CUO CAPS PAQ X 1000', 'Caja x 1.000', NULL, 0, NULL, '', 0, 1),
(218, NULL, 'HAV TOTAL (aHAVT)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(219, NULL, 'HBCT (CORE TOTAL)', 'Kit x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(220, NULL, 'HBEAG (ANTIGENO E DE LA HEPATITIS B) ', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(221, NULL, 'HOMOSISTEINA (HCY)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(222, NULL, 'MONITOR LED JANUS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(223, NULL, 'THCG (GONADOTROPINA CORIONICA)', 'Kit x 250 pruebas ', NULL, 0, NULL, '', 0, 1),
(224, NULL, 'VALOR SERVICIO DÍA MINIMO AUXILIAR', '', NULL, 0, NULL, '', 0, 1),
(225, NULL, 'ALBUMINA', 'Kit x 2220 pruebas ', NULL, 0, NULL, '', 0, 1),
(226, NULL, 'VASELINA LIQUIDA', 'Frasco x 1000 cc', NULL, 0, NULL, '', 0, 1),
(227, NULL, 'KOVA LIQUA-TROL /HUMAN URIANALYSIS CONTROLS. nivel 1 ANORMAL Y 2 NORMAL', '6 x 15 ml', NULL, 0, NULL, '', 0, 1),
(228, NULL, 'MEDIOS DE TRANSPORTE ', 'Paquete x 50 unidades', NULL, 0, NULL, '', 0, 1),
(229, NULL, 'VITAMINA B12 (VB12)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(230, NULL, 'LANCETA PRESTIGE SUAVE', 'Caja x 100 unds', NULL, 0, NULL, '', 0, 2),
(231, NULL, 'TOALLAS DE MANOS  NATURAL EN Z DOBLE HOJA', 'Paquete x 100u', NULL, 0, NULL, '', 0, 1),
(232, NULL, 'ROLLO PAPEL PARA MESON 550 MT AIRFLEX NATURAL ', 'Rollo', NULL, 0, NULL, '', 0, 1),
(233, NULL, 'CONTROL DE CALIDAD EXTERNO MLE MICROBIOLOGIA', '9 parametros. 3 eventos', NULL, 0, NULL, '', 0, 1),
(234, NULL, 'CONTROL DE CALIDAD EXTERNO MLE UROANALISIS.', '43 parametros. 3 eventos', NULL, 0, NULL, '', 0, 1),
(235, NULL, 'PSA LIBRE (FPSA)', 'Kit x 50 pruebas ', NULL, 0, NULL, '', 0, 1),
(236, NULL, 'PERLAS PARA PRESERVACIÓN DE MICROORGANISMOS (ROJAS, VERDES, AMARILLAS, BLANCAS Y AZULES)', 'Bolsa x 25 (5 de c/u)', NULL, 0, NULL, '', 0, 1),
(237, NULL, 'LAMINAS CUBRE OBJETOS 22*22 MM ', 'Estuche x 100 unidades', NULL, 0, NULL, '', 0, 1),
(238, NULL, 'AMILASA', 'Kit x 1225 pruebas ', NULL, 0, NULL, '', 0, 1),
(239, NULL, 'LANCETA MUESTRA SANGRE ', 'Caja x200 unds', NULL, 0, NULL, '', 0, 1),
(240, NULL, 'ALCOHOL ETILICO O ETANOL', 'Galon', NULL, 0, NULL, '', 0, 1),
(241, NULL, 'TONER RM HP 85A', 'Unidad', NULL, 0, NULL, '', 0, 1),
(242, NULL, 'LEGAJADOR AZ OFICIO ULTRA NORMA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(243, NULL, 'AMONIO', 'Kit x 276 pruebas', NULL, 0, NULL, '', 0, 1),
(244, NULL, 'WYPALL ROLLO L20 IFLEX', 'Rollo ', NULL, 0, NULL, '', 0, 1),
(245, NULL, 'FUSCINA FENICADA', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 1),
(246, NULL, 'FUSCINA FENICADA', 'Frasco x 1000ml', NULL, 0, NULL, '', 0, 1),
(247, NULL, 'RECOLECTOR CORTOPUNZANTE 3,0 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(248, NULL, 'LUGOL DE GRAM', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(249, NULL, 'RECOLECTOR CORTOPUNZANTE 0,75 LTS MARCA RYMCO', '0,75 lts', NULL, 0, NULL, '', 0, 1),
(250, NULL, 'ETANOL CETONA 3:1', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(251, NULL, 'TIRAS PARA GLUCOMETRIA TRUETEST 50CT ', 'Caja x 50 unidades', NULL, 0, NULL, '', 0, 1),
(252, NULL, 'MINICOLLECT TAPA LILA 1ML ', 'Gradilla x 50 unidades', NULL, 0, NULL, '', 0, 1),
(253, NULL, 'SOPORTE BLANCO PARA GLOBO T x 1', 'Bolsa x 100 unidades', NULL, 0, NULL, '', 0, 1),
(254, NULL, 'IMIPENEM 10 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(255, NULL, 'PUNTAS AZULES', 'Paq x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(256, NULL, 'ROLLO PARA CAMILLA 50CM ', 'Rollo', NULL, 0, NULL, '', 0, 1),
(257, NULL, 'INNOCULATION LOOPS, NEUTRAL ESTERIL (ASAS BLANCAS)', 'Paquete por 10 uds', NULL, 0, NULL, '', 0, 1),
(258, NULL, 'SOPORTE GUARDIAN CORTOPUNZANTE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(259, NULL, 'GP TEST KIT VTK2', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(260, NULL, 'BETA-2 MICROGLOBULIN (BMG)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(261, NULL, 'ESCHERICHIA COLI ATCC 25922', 'Kit por 2 unidades', NULL, 0, NULL, '', 0, 1),
(262, NULL, 'GENTAMICINA 100 Mcg (GARAMICINA)', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(263, NULL, 'PUNTAS AMARILLAS', 'Paq x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(264, NULL, 'PIPERACILINA/TAZOBACTAM', 'Caja 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(265, NULL, '(ASO) ASTO - ANTIESTREPTOLISINA ', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(266, NULL, 'SAMPLE CUP 1500 PK no pedir tubos', 'Caja x 1.500', NULL, 0, NULL, '', 0, 1),
(267, NULL, 'SAMPLE TIPS (PUNTAS)', 'Caja x 6.480', NULL, 0, NULL, '', 0, 1),
(268, NULL, 'Control HIV QC KIT', 'Kit de 2 x 2,5 ml x 4', NULL, 0, NULL, '', 0, 1),
(269, NULL, 'Control IPTH QC', 'Kit de 3 niveles x 2 x 1 ml', NULL, 0, NULL, '', 0, 1),
(270, NULL, 'Control LIQCHK CARDC MKR+ LT NIVEL 1', 'Kit de 6 viales x 3 ml', NULL, 0, NULL, '', 0, 1),
(271, NULL, 'Control LIQCHK CARDC MKR+ LT NIVEL 2', 'Kit de 6 viales x 3 ml', NULL, 0, NULL, '', 0, 1),
(272, NULL, 'Control LIQCHK CARDC MKR+ LT NIVEL 3', 'Kit de 6 viales x 3 ml', NULL, 0, NULL, '', 0, 1),
(273, NULL, 'Control LYPHOCHEK IMMUNOSAY CTRL TRILEV: 4X3LS', 'Kit de 4 und x nivel, 12 undx5ml', NULL, 0, NULL, '', 0, 1),
(274, NULL, 'Control LYPHOCHEK TUMOR MARKER PLUS Lev1', 'Kit de 6 x 2 ml', NULL, 0, NULL, '', 0, 1),
(275, NULL, 'HCV (Ac Hepatitis C)', 'Kit x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(276, NULL, 'Control LYPHOCHEK TUMOR MARKER PLUS Lev2', 'Kit de 6 x 2 ml', NULL, 0, NULL, '', 0, 1),
(277, NULL, 'Auxiliar FOL DTT/REL AGT', 'Kit x 3 dtt x 3 vial', NULL, 0, NULL, '', 0, 1),
(278, NULL, 'Calibrador 1 (EATG) LOTE: 183 o A83', '2 x 1ml level', NULL, 0, NULL, '', 0, 1),
(279, NULL, 'Control LYPHOCHEK TUMOR MARKER PLUS Lev3', 'Kit de 6 x 2 ml', NULL, 0, NULL, '', 0, 1),
(280, NULL, 'Calibrador 28 (VALP)', '2 viales x 5 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(281, NULL, 'Calibrador B (THCG)', '2x5ml. x nivel', NULL, 0, NULL, '', 0, 1),
(282, NULL, 'Control RUBELLA IGG QC KIT', 'Kit de 2 viales x 2,7 ml. x 3 niv', NULL, 0, NULL, '', 0, 1),
(283, NULL, 'Calibrador C', '2x5ml. x nivel', NULL, 0, NULL, '', 0, 1),
(284, NULL, 'Calibrador D', '2x2ml. x nivel', NULL, 0, NULL, '', 0, 1),
(285, NULL, 'Calibrador FPSA', '2x2ml. x nivel', NULL, 0, NULL, '', 0, 1),
(286, NULL, 'Control RUBELLA IGM QC KIT', 'Kit de 2x2,7ml. x nivel', NULL, 0, NULL, '', 0, 1),
(287, NULL, 'Calibrador O (EATPO)', '2x1ml level', NULL, 0, NULL, '', 0, 1),
(288, NULL, 'Calibrador Z (CARB)', '2 x 5 x2 ml', NULL, 0, NULL, '', 0, 1),
(289, NULL, 'MINICOLLECT TAPA AMARILLA ', 'Gradilla x 100 unidades', NULL, 0, NULL, '', 0, 1),
(290, NULL, 'PORTALAMINAS PLASTICOS UNA LAMINA (ESTUCHE PORTA OBJETO)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(291, NULL, 'CITOMEGALOVIRUS IGG (CMV IGG)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(292, NULL, 'PIPETA PASTEUR 3 ML ', 'Unidad', NULL, 0, NULL, '', 0, 2),
(293, NULL, 'RECOLECTOR CORTOPUNZANTE 1,0 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(294, NULL, 'RECOLECTORES DE ORINA 60ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(295, NULL, 'HEMOBACTER BHI ADULTO BIO BACTER (HEMOCULTIVO)', 'Frasco x 50 ml', NULL, 0, NULL, '', 0, 1),
(296, NULL, 'TAPONES PARA TUBOS DE 13 x 75 MM', 'Bolsa x 1000', NULL, 0, NULL, '', 0, 1),
(297, NULL, 'RECOLECTOR X 1 GALON', 'Galon', NULL, 0, NULL, '', 0, 1),
(298, NULL, 'TORNIQUETE PLANO', 'Caja x 25 tiras', NULL, 0, NULL, '', 0, 1),
(299, NULL, 'CYSC ATELLICA CH', 'Na', NULL, 0, NULL, '', 0, 1),
(300, NULL, 'PLACAS PETRI 60x15MM VENTILADA', 'Bolsa x 20 placas', NULL, 0, NULL, '', 0, 1),
(301, NULL, 'TUBO EPPENDORF 0,5 ML CON TAPA ADJUNTA GRADUADO PP  MICROCENTRIFUGA', 'Bolsa x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(302, NULL, 'COMBO TECLADO GENIUS + MOUSE NEGRO', 'Combo teclado + mouse', NULL, 0, NULL, '', 0, 2),
(303, NULL, 'COCAINA (COCAINE METABOLITE) ATELLICA CH', 'Kit 4 x 380 pruebas', NULL, 0, NULL, '', 0, 1),
(304, NULL, 'CUVETAS (CUVETTES) CAJA X 15 BOLSAS CONSUMIBLE ', '3000', NULL, 0, NULL, '', 0, 1),
(305, NULL, 'NITROFURANTOINA 300 Mcg', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(306, NULL, 'TUBO TAPA AZUL 2ML COAG. CIT. SOD. 3,2% ', 'Gradilla x 50 tubo', NULL, 0, NULL, '', 0, 1),
(307, NULL, 'NORFLOXACIN 10 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(308, NULL, 'TUBO PARA ORINA DE POLIPROPILENO DE 16 X 100 SIN TAPÓN ', 'Bolsa x 500 und', NULL, 0, NULL, '', 0, 1),
(309, NULL, 'RECIPIENTE METALICO PARA ALGODON', 'Unidad', NULL, 0, NULL, '', 0, 1),
(310, NULL, 'TUBO TAPA VERDE CON HEPARINA SODICA 4 ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(311, NULL, 'OXIDASA', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(312, NULL, 'TIROGLOBULINA (THYROGLOBULIN IMMULITE)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(313, NULL, 'OXIDASA TAXO N', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(314, NULL, 'TUBO DE VIDRIO TAPA ROSCA 13 X 100 MM', 'Caja x 100 tubos', NULL, 0, NULL, '', 0, 1),
(315, NULL, 'PENICILINA 10 Ug ', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(316, NULL, 'Consumibles PROBE CLEANING KIT Solucion de limpieza', 'Unidad', NULL, 0, NULL, '', 0, 1),
(317, NULL, 'TUBO TAPA LILA 2ML PEDIAT.', 'Gradilla x 50 tubos', NULL, 0, NULL, '', 0, 1),
(318, NULL, 'Consumibles PROBE WASH MODULE Solución de Lavado', 'Caja x 2 x 100 ml', NULL, 0, NULL, '', 0, 1),
(319, NULL, 'MARIHUANA CANNABINOIDS ATELLICA CH', 'Kit 4 x 380 pruebas', NULL, 0, NULL, '', 0, 1),
(320, NULL, 'Control SYPH QC', 'Kit de 2x7 ml', NULL, 0, NULL, '', 0, 1),
(321, NULL, 'Calibrador Homosisteina HCY CAL', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(322, NULL, 'CONSUMIBLE ACID & BASE 1 Y 2', '5000', NULL, 0, NULL, '', 0, 1),
(323, NULL, 'Control TOXO IGG QC KIT', 'Kit de 2x2,7ml. x nivel', NULL, 0, NULL, '', 0, 1),
(324, NULL, 'CONSUMIBLE CLEANING SOLUTION', 'Caja x 12', NULL, 0, NULL, '', 0, 1),
(325, NULL, 'MEROPENEM 10 Mcg', 'Caja de 5 viales x 50 discos', NULL, 0, NULL, '', 0, 1),
(326, NULL, 'CONSUMIBLE WASH 1 SOL DE LAVADO', '2 x 2500 ml', NULL, 0, NULL, '', 0, 1),
(327, NULL, 'Control TOXO IGM QC KIT', 'Kit de 2x1.5ml. x nivel', NULL, 0, NULL, '', 0, 1),
(328, NULL, 'Control aCCP QC               ', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(329, NULL, 'Control aHAVT TOTAL QC KIT', '2x7 ml. xnivel', NULL, 0, NULL, '', 0, 1),
(330, NULL, 'Control VIT D QC KIT', 'Kit de 3x2 niveles', NULL, 0, NULL, '', 0, 1),
(331, NULL, 'Control HBSAG / HBSII QC KIT', 'Kit de 2x10ml. x nivel', NULL, 0, NULL, '', 0, 1),
(332, NULL, 'Diluyente 1', 'Kit de 2 x 25 ml', NULL, 0, NULL, '', 0, 1),
(333, NULL, 'Diluyente 2', 'Kit de 2 cartuchos x10 ml.', NULL, 0, NULL, '', 0, 1),
(334, NULL, 'Diluyente 3', 'Kit de 2 viales', NULL, 0, NULL, '', 0, 1),
(335, NULL, 'Diluyente BR ', 'Kit de 2  x10 ml.', NULL, 0, NULL, '', 0, 1),
(336, NULL, 'Diluyente ANCILLARY PROBE WASH 1', 'Kit de 2  x 25 ml', NULL, 0, NULL, '', 0, 1),
(337, NULL, 'Diluyente CA19-9', 'Kit de 2  x 5 ml', NULL, 0, NULL, '', 0, 1),
(338, NULL, 'Diluyente EE2', 'Kit de 2 x 5 ml', NULL, 0, NULL, '', 0, 1),
(339, NULL, 'Diluyente IGE', 'Kit de 2 viales', NULL, 0, NULL, '', 0, 1),
(340, NULL, 'Diluyente INSULIN', 'Kit de 2x10 ml', NULL, 0, NULL, '', 0, 1),
(341, NULL, 'HORMONA CRECIMIENTO (GROWTH HORMONE)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(342, NULL, 'Diluyente PARA T4', 'Kit de 10 ml', NULL, 0, NULL, '', 0, 1),
(343, NULL, 'Diluyente PW3', 'Kit de 1x50 ml', NULL, 0, NULL, '', 0, 1),
(344, NULL, 'Diluyente PW4', 'Kit de 1x25.0 ml', NULL, 0, NULL, '', 0, 1),
(345, NULL, 'Diluyente T3/T4/VB12', 'Kit de 2 x 25 ml.', NULL, 0, NULL, '', 0, 1),
(346, NULL, 'Diluyente VIT D', 'Kit de 2x25 ml', NULL, 0, NULL, '', 0, 1),
(347, NULL, 'Diluyente PARA T3', 'Kit de 10 ml', NULL, 0, NULL, '', 0, 1),
(348, NULL, 'CITOMEGALOVIRUS IGM (CMV IGM)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(349, NULL, 'ESTRIOL UNCONJUGATED ', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(350, NULL, 'TIBC (CAPACITAD TOTAL DE FIJACION DE HIERRO)  ATELLICA CH', 'Kit 4 x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(351, NULL, 'IGF-I (SOMATOMEDINA)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(352, NULL, 'TUBO TAPA LILA 4ML CON EDTA K3', 'Gradilla x 50 tubos', NULL, 0, NULL, '', 0, 1),
(353, NULL, 'DIMERO D', 'Kit x 150 pruebas', NULL, 0, NULL, '', 0, 1),
(354, NULL, 'TUBO DE ENSAYO EN VIDRIO DE 13 X 100MM', 'Caja x 250 tubos', NULL, 0, NULL, '', 0, 1),
(355, NULL, 'TUBO DE VIDRIO TAPA ROSCA 16 X 100 MM', 'Paquete x 100 unidades', NULL, 0, NULL, '', 0, 1),
(356, NULL, 'Copas para Muestras bolsa amarilla IMMULITE', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(357, NULL, 'Printerpaper            ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(358, NULL, 'Reaction Tube Sysmex CA                       ', 'Caja 3x 1000', NULL, 0, NULL, '', 0, 1),
(359, NULL, 'COMBO TECLADO GENIUS + MOUSE NEGRO', 'Combo teclado + mouse', NULL, 0, NULL, '', 0, 1),
(360, NULL, 'CA-Clean II 500ml                 ', 'Caja 1x 500 ml', NULL, 0, NULL, '', 0, 1),
(361, NULL, 'Control Dimero D', 'Unidad', NULL, 0, NULL, '', 0, 1),
(362, NULL, 'Consumibles Sustrato Quimioluminiscente 2 module 1000', 'Unidad', NULL, 0, NULL, '', 0, 1),
(363, NULL, 'TONER RM HP 05A / 80A ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(364, NULL, 'LYPHOCHEK COAG CONTROL N1 12X1 ML REF 744', 'Kit 12x1', NULL, 0, NULL, '', 0, 1),
(365, NULL, 'LYPHOCHEK COAG CONTROL N2 12X1 ML REF 745', 'Kit 12x1', NULL, 0, NULL, '', 0, 1),
(366, NULL, 'BFT II ANALYZER CUVETTES 1 KIT', 'Caja x 2500 und', NULL, 0, NULL, '', 0, 1),
(367, NULL, 'BFT II ANALYZER COPILLAS', 'Caja', NULL, 0, NULL, '', 0, 1),
(368, NULL, 'SAFRANINA DE GRAM', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(369, NULL, 'Calcium Chloride .025M-10x15                            ', 'Caja 10x 15 ml', NULL, 0, NULL, '', 0, 1),
(370, NULL, 'DESHIDROGENASA LACTICA (LD) ATELLICA CH', 'Kit 4 x 448 pruebas', NULL, 0, NULL, '', 0, 1),
(371, NULL, 'Control EATG SET LOTE: 181 Y 182', '3 vials per  2ml level', NULL, 0, NULL, '', 0, 1),
(372, NULL, 'TRIGLICERIDOS trig ATELLICA CH', 'Kit 4 x 500 pruebas', NULL, 0, NULL, '', 0, 1),
(373, NULL, 'Diluyente ATG ', '2 cartuchos x 5 ml', NULL, 0, NULL, '', 0, 1),
(374, NULL, 'BILIRUBINA TOTAL (TBIL) ATELLICA CH', 'Kit 4 x 448 pruebas', NULL, 0, NULL, '', 0, 1),
(375, NULL, 'Calibrador 30', 'Kit de 2x2 ml x nivel', NULL, 0, NULL, '', 0, 1),
(376, NULL, 'Diluyente 11', '2 cartuchos x 5 ml', NULL, 0, NULL, '', 0, 1),
(377, NULL, 'CN-FREE HGB TIMEPAC (CUADRO HEMATICO)', 'Kit de 3.700 pruebas', NULL, 0, NULL, '', 0, 1),
(378, NULL, 'Control IGF CONTROL MODULE', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(379, NULL, 'Diluyente 5', '2 x 5 ml', NULL, 0, NULL, '', 0, 1),
(380, NULL, 'PT INNOVIN (TIEMPO DE PROTROMBINA)', 'Kit x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(381, NULL, 'PTT ACTIN (TIEMPO PARCIAL DE TROMBOPLASTINA)', 'Kit x 400', NULL, 0, NULL, '', 0, 1),
(382, NULL, 'Diluyente ATG  ', '2 x 5 ml', NULL, 0, NULL, '', 0, 1),
(383, NULL, 'FIBRINOGENO ', 'Kit x 120', NULL, 0, NULL, '', 0, 1),
(384, NULL, 'Diluyente ATPO', '2  x 5 ml', NULL, 0, NULL, '', 0, 1),
(385, NULL, 'Diluyente FOL', '2 x 10 ml', NULL, 0, NULL, '', 0, 1),
(386, NULL, 'Diluyente CMV IGM', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(387, NULL, 'BILIRUBINA DIRECTA (DBIL_2) ATELLICA CH', 'Kit 4 x 448 pruebas', NULL, 0, NULL, '', 0, 1),
(388, NULL, 'Diluyente HCG SAMPLE IMM                 ', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(389, NULL, 'AST GOT (ASPARTATO AMINOTRANSFERASA)', 'Kit x 2520', NULL, 0, NULL, '', 0, 1),
(390, NULL, 'Diluyente PW1', '1 cartuchos x12, 5 ml.', NULL, 0, NULL, '', 0, 1),
(391, NULL, 'BILIRUBINA DIRECTA (DBIL_2)', 'Kit x 520', NULL, 0, NULL, '', 0, 1),
(392, NULL, 'Diluyente THCG', '2  x 25 ml.', NULL, 0, NULL, '', 0, 1),
(393, NULL, 'AMONIO ATELLICA CH', 'Kit 4 x 120 pruebas', NULL, 0, NULL, '', 0, 1),
(394, NULL, 'NITROGENO UREICO (UN_c) ATELLICA CH', 'Kit 4 x 1560 pruebas', NULL, 0, NULL, '', 0, 1),
(395, NULL, 'Control HCV QC KIT', '2x7ml. x nivel', NULL, 0, NULL, '', 0, 1),
(396, NULL, 'Control ANTI TPO QC', '3x2ml level', NULL, 0, NULL, '', 0, 1),
(397, NULL, 'Control HAV IGM QC KIT', '2x7 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(398, NULL, 'Control HBC IGM QC KIT', '2x7ml. x nivel', NULL, 0, NULL, '', 0, 1),
(399, NULL, 'Control HBCT QC KIT', '2 viales x 7 ml. x nivel', NULL, 0, NULL, '', 0, 1),
(400, NULL, 'Control HBeAG QC KIT', '2x10ml. x nivel', NULL, 0, NULL, '', 0, 1),
(401, NULL, 'Control AHBS2 QC KIT', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(402, NULL, 'DEFOAMER ANTIESPUMANTE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(403, NULL, 'EZ WASH', 'Unidad', NULL, 0, NULL, '', 0, 1),
(404, NULL, 'PEROX SHEAT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(405, NULL, 'SHEAT RINSE 20 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(406, NULL, 'CONTROL ALTO TESTPT VERDE ', 'Kit de 4x4,0 ml', NULL, 0, NULL, '', 0, 1),
(407, NULL, 'CONTROL BAJO AZUL TESTPT ', 'Kit de 4x4,0 ml', NULL, 0, NULL, '', 0, 1),
(408, NULL, 'CONTROL TESTPT BLANCO ', 'Kit de 4x4,0 ml', NULL, 0, NULL, '', 0, 1),
(409, NULL, 'CONTROL LIQUICHEK HEMATOLOGY CONTROL', 'Kit de 12x3,5 ml', NULL, 0, NULL, '', 0, 1),
(410, NULL, 'Standard B+Salt Bridge Atellica IMT ', 'Std b: 2 x 250ml  salt bridge: 2 x 125 ml', NULL, 0, NULL, '', 0, 1),
(411, NULL, 'PPD TUBERCULIN MAMMALIAN UNIDOSIS X 1 ml 5ut 0.1ml', 'Ampolla x 1 ml', NULL, 0, NULL, '', 0, 1),
(412, NULL, 'Control BETA2', 'Caja x 6 viales', NULL, 0, NULL, '', 0, 1),
(413, NULL, 'Diluyente BETA2 MICRO                 ', 'Frasco x 25 ml', NULL, 0, NULL, '', 0, 1),
(414, NULL, 'Consumibles Tapa Copa de Muestra IMMULITE', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(415, NULL, 'WATER TEST KIT IMMULITE, CONSUMIBLES COPILLAS PARA AGUA', 'Bolsa x 25 copillas', NULL, 0, NULL, '', 0, 1),
(416, NULL, 'SALINE SOLUTION 500ML', 'Botella x 500 ml', NULL, 0, NULL, '', 0, 1),
(417, NULL, 'BILIRUBINA TOTAL (TBIL)', 'Kit x 1424', NULL, 0, NULL, '', 0, 1),
(418, NULL, 'Diluyente VB12', '2 viales', NULL, 0, NULL, '', 0, 1),
(419, NULL, 'FOSFATASA ALKALINA (ALP_2) ATELLICA CH', 'Kit 4 x 1200 (4800) pruebas', NULL, 0, NULL, '', 0, 1),
(420, NULL, 'Diluyente CENTAUR VB12 DTT RA KIT', '1 vial dtt/2 releasing', NULL, 0, NULL, '', 0, 1),
(421, NULL, 'CALCIO CA_2 (CALCIUM 2 ARSENAZO)', 'Kit x 1610 ', NULL, 0, NULL, '', 0, 1),
(422, NULL, 'STREP A MÉTODO DIRECTO CASSETTE', 'Caja x 25 test', NULL, 0, NULL, '', 0, 1),
(423, NULL, 'CREATININA ENZIMATICA ECRE_2 ATELLICA CH', 'Kit 4 x 350 pruebas', NULL, 0, NULL, '', 0, 1),
(424, NULL, 'CK MB SL 2X62,5 ML', 'Kit x 756', NULL, 0, NULL, '', 0, 1),
(425, NULL, 'CARDIO PCR (HSCRP)', 'Kit x 440 ', NULL, 0, NULL, '', 0, 1),
(426, NULL, 'AFP (ALFAFETOPROTEINA)', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(427, NULL, 'GAMMA GLUTAMIL TRANSFERASA (GGT RGT) ATELLICA CH', 'Kit 4 x 448 pruebas', NULL, 0, NULL, '', 0, 1),
(428, NULL, 'ACCP ( CITRULINA)', 'Kit x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(429, NULL, 'COCAINA (COCAINE METABOLITE)', 'Kit x 760 pruebas', NULL, 0, NULL, '', 0, 1),
(430, NULL, 'COLESTEROL (CHOL_2)', 'Kit x 2400 pruebas', NULL, 0, NULL, '', 0, 1),
(431, NULL, 'PROTEINAS URINARIAS (UPRO) ATELLICA CH', 'Kit 4 x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(432, NULL, 'COLESTEROL HDL', 'Kit x 1304 pruebas', NULL, 0, NULL, '', 0, 1),
(433, NULL, 'SUSPENSION SOLUTION', 'Frasco x 500 ml', NULL, 0, NULL, '', 0, 1),
(434, NULL, 'TIRAS DE ORINA CLINITEK NOVUS', 'Kit x 450 pruebas', NULL, 0, NULL, '', 0, 1),
(435, NULL, 'LIQUIDCHEK URIANALYSIS  CONTROL BINIVEL REF: 435', 'Unidad', NULL, 0, NULL, '', 0, 1),
(436, NULL, 'LYSE 5L (CUADRO HEMATICO) ADVIA 560', '900 pruebas en 5l', NULL, 0, NULL, '', 0, 1),
(437, NULL, '10311123 CLINITEK NOVUS CAL/CTRL KIT 1-4', 'Unidad', NULL, 0, NULL, '', 0, 1),
(438, NULL, 'RINSE ADDITIVE ENXAGUAMENTO', 'Caja 4x26 ml', NULL, 0, NULL, '', 0, 1),
(439, NULL, 'AMIX ATELLICA CH ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(440, NULL, 'DESHIDROGENASA LACTICA (LD)', 'Kit x 1918 pruebas', NULL, 0, NULL, '', 0, 1),
(441, NULL, 'FOSFATASA ALKALINA (ALP_2) ', 'Kit x 7440 pruebas', NULL, 0, NULL, '', 0, 1),
(442, NULL, 'FÓSFORO INORGANICO', 'Kit x 2506 pruebas', NULL, 0, NULL, '', 0, 1),
(443, NULL, 'INMUNOGLOBULINA A (IGA II)', 'Kit x 375 pruebas', NULL, 0, NULL, '', 0, 1),
(444, NULL, 'GAMMA GLUTAMIL TRANSFERASA (GGT RGT)', 'Kit x 980 pruebas', NULL, 0, NULL, '', 0, 1),
(445, NULL, 'CREATININA ENZIMATICA ECRE_2', 'Kit x 1420 pruebas', NULL, 0, NULL, '', 0, 1),
(446, NULL, 'COLESTEROL LDL', 'Kit x 752 pruebas', NULL, 0, NULL, '', 0, 1),
(447, NULL, 'FACTOR REUMATOIDEO (RF)', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(448, NULL, 'Dil 20L ', 'Caja x 20 lt', NULL, 0, NULL, '', 0, 1),
(449, NULL, 'HIERRO (IRON 2)', 'Kit x 1015 pruebas', NULL, 0, NULL, '', 0, 1),
(450, NULL, 'Diff 1L', ' caja x 1 lt', NULL, 0, NULL, '', 0, 1),
(451, NULL, 'Hypoclean 100ml ', 'Caja x 100 ml', NULL, 0, NULL, '', 0, 1),
(452, NULL, 'FÓSFORO INORGANICO', 'Kit x 2506 pruebas', NULL, 0, NULL, '', 0, 1),
(453, NULL, 'SODIO HIDROXIDO (SODA CAUSTICA) EN LENTEJAS', 'Frasco 1 kg', NULL, 0, NULL, '', 0, 1),
(454, NULL, 'Calibrator ADVIA 560 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(455, NULL, 'FRUCTOSAMINA', 'Kit 200 pruebas', NULL, 0, NULL, '', 0, 1),
(456, NULL, 'Control ADVIA 560 Set para hematologia', 'Unidad', NULL, 0, NULL, '', 0, 1),
(457, NULL, 'AHBS2 (Anticuerpos contra Ag de Superficie)', 'Kit x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(458, NULL, 'CALCIO CA_2 (CALCIUM 2 ARSENAZO) ATELLICA CH', 'Kit 4 x 890 pruebas', NULL, 0, NULL, '', 0, 1),
(459, NULL, 'BRAIN HEART INFUSION', 'Frasco x 500 gr', NULL, 0, NULL, '', 0, 1),
(460, NULL, 'INMUNOGLOBULINA G (IGG_2 II)', 'Kit x 360 pruebas', NULL, 0, NULL, '', 0, 1),
(461, NULL, 'INMUNOGLOBULINA M (IGM_2 II)', 'Kit x 360 pruebas', NULL, 0, NULL, '', 0, 1),
(462, NULL, 'COMPLEMENTO C4', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(463, NULL, 'HIERRO (IRON 2) ATELLICA CH', 'Kit 4 x 448 pruebas', NULL, 0, NULL, '', 0, 1),
(464, NULL, 'COMPLEMENTO C3', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(465, NULL, 'AMILASA ATELLICA CH', 'Kit 3 x 350 pruebas', NULL, 0, NULL, '', 0, 1),
(466, NULL, 'MAGNESIO', 'Kit 980 kits ', NULL, 0, NULL, '', 0, 1),
(467, NULL, 'ALCOHOL ISOPROPILICO USP', 'Frasco x 1l', NULL, 0, NULL, '', 0, 1),
(468, NULL, 'TSAA SB AGAR BASE BX 450 GR', 'Frasco x 500g', NULL, 0, NULL, '', 0, 2),
(469, NULL, 'TUBOS NN PARA SENSIBILIDAD', '1 cajax 2000 tubos', NULL, 0, NULL, '', 0, 1),
(470, NULL, 'LIPASA (lip)', 'Kit x 640 pruebas', NULL, 0, NULL, '', 0, 1),
(471, NULL, 'COLINESTERASA (Che)', 'Kit x 532 pruebas', NULL, 0, NULL, '', 0, 1),
(472, NULL, 'GLUCOSA OXIDASA (GluO)', 'Kit x 2450 pruebas', NULL, 0, NULL, '', 0, 1),
(473, NULL, 'Diluyente THYROGLOBULIN  (TIROGLOBULINA IMMULITE)', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(474, NULL, 'VIOLETA DE GRAM', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(475, NULL, 'NH TEST KIT', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(476, NULL, 'TCA 1 CAL ATELLICA CH ', '1 kit 1 x 5 ml', NULL, 0, NULL, '', 0, 1),
(477, NULL, 'MARIHUANA CANNABINOIDS', '760', NULL, 0, NULL, '', 0, 1),
(478, NULL, 'PROTEINAS TOTALES (TP) ATELLICA CH', 'Kit 4 x 1850 pruebas ', NULL, 0, NULL, '', 0, 1),
(479, NULL, 'MICROALBUMIA (Ualb_2)', 'Kit x 420 pruebas', NULL, 0, NULL, '', 0, 1),
(480, NULL, 'Control aHBE QC KIT', '2x10ml. x nivel', NULL, 0, NULL, '', 0, 1),
(481, NULL, '(CRP_2) PROTEINA C REACTIVA ', 'Kit 1000 pruebas', NULL, 0, NULL, '', 0, 1),
(482, NULL, 'ACIDO URICO SELECTRA XS', 'Kit 1038 pruebas', NULL, 0, NULL, '', 0, 1),
(483, NULL, 'LIMPIEZA Y REPARACION DE TARJETA AIRE CIENTIFICA', '', NULL, 0, NULL, '', 0, 1),
(484, NULL, 'ELITROL I NORMAL10x5 ML.', 'Unidad', NULL, 0, NULL, '', 0, 1),
(485, NULL, 'CITORESINA ENTELLAN NUEVO MEDIO DE MONTAJE RAPIDO ', 'Botella x 100 ml', NULL, 0, NULL, '', 0, 1),
(486, NULL, 'ELITROL II ABNORMAL 10x5 ML.', 'Unidad', NULL, 0, NULL, '', 0, 1),
(487, NULL, 'BOLIGRAFO JERINGA MARCADO PASTEUR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(488, NULL, 'ELICAL 2 MULTICALIBRADOR   4x3 ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(489, NULL, 'ACIDO CLORHIDRICO 0.1 N X 500', 'Unidad', NULL, 0, NULL, '', 0, 1),
(490, NULL, 'BOLSA TERMICA ESSENTIAL PASTEUR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(491, NULL, 'SYSTEM CLEANING SOLUTION 1 L', 'Unidad', NULL, 0, NULL, '', 0, 1),
(492, NULL, 'LIQUID SYSTEM X 1000ML ELITECH', 'Unidad', NULL, 0, NULL, '', 0, 1),
(493, NULL, 'AMPHETAMINE COZART RAPID URINE TEST (ANFETAMINAS)', 'Caja x 25', NULL, 0, NULL, '', 0, 1),
(494, NULL, 'CAL HDL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(495, NULL, 'FÓSFORO INORGANICO ATELLICA CH', 'Kit 3 x 1700 pruebas', NULL, 0, NULL, '', 0, 1),
(496, NULL, 'ACIDO ACETICO GLACIAL 100% P/ANALISIS ANHIDRO ACS', 'Botella x 2.5 ml', NULL, 0, NULL, '', 0, 1),
(497, NULL, 'TRANSFERRINA ATELLICA CH', 'Kit 4 x 220 pruebas ', NULL, 0, NULL, '', 0, 1),
(498, NULL, 'COLINESTERASA (Che) ATELLICA CH', 'Kit 2 x 135 (270) pruebas', NULL, 0, NULL, '', 0, 1),
(499, NULL, 'TRANSFERRINA', 'Kit 440 pruebas', NULL, 0, NULL, '', 0, 1),
(500, NULL, 'DIFF TIMEPAC (Perox Sheat + Perox 1,2 y 3)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(501, NULL, 'COLESTEROL SELECTRA XS', 'Kit 1752 unds', NULL, 0, NULL, '', 0, 1),
(502, NULL, 'ALCOHOL EN SALIVA', 'Kit de 25 tiras', NULL, 0, NULL, '', 0, 1),
(503, NULL, 'CARBAMAZEPINA (CARB) ATELLICA CH', 'Kit 4 x 100 pruebas (400 pruebas)', NULL, 0, NULL, '', 0, 1),
(504, NULL, 'AMONIACO', 'Galón ', NULL, 0, NULL, '', 0, 1),
(505, NULL, 'CARDIO PCR (HSCRP) ATELLICA CH', 'Kit 2 x 370 pruebas', NULL, 0, NULL, '', 0, 1),
(506, NULL, 'MAGNESIO ATELLICA CH', 'Kit 3 x 400 pruebas ', NULL, 0, NULL, '', 0, 1),
(507, NULL, 'INMUNOGLOBULINA G (IGG_2 II) ATELLICA CH', 'Kit 4 x 180 pruebas', NULL, 0, NULL, '', 0, 1),
(508, NULL, 'INMUNOGLOBULINA A (IGA II) ATELLICA CH', 'Kit 4 x 150 pruebas', NULL, 0, NULL, '', 0, 1),
(509, NULL, 'ANTIGENOS FEBRILES ', 'Estuche 6 x 3ml', NULL, 0, NULL, '', 0, 1),
(510, NULL, 'APOYA CABEZA Y COBIJA PASTEUR', '', NULL, 0, NULL, '', 0, 1),
(511, NULL, 'INMUNOGLOBULINA M (IGM_2 II) ATELLICA CH', 'Kit 4 x 180 (720) pruebas ', NULL, 0, NULL, '', 0, 1),
(512, NULL, 'HDL COLESTEROL DIRECT SELECTRA XS', 'Kit 213 pruebas', NULL, 0, NULL, '', 0, 1),
(513, NULL, 'AST GOT (ASPARTATO AMINOTRANSFERASA) ATELLICA CH', 'Kit 3 x 850 pruebas', NULL, 0, NULL, '', 0, 1),
(514, NULL, 'ACIDO URICO (UA) ATELLICA CH', 'Kit 4 x 1200 (4800) pruebas ', NULL, 0, NULL, '', 0, 1),
(515, NULL, 'FACTOR REUMATOIDEO (RF) ATELLICA CH', 'Kit 2 x 180 pruebas ', NULL, 0, NULL, '', 0, 1),
(516, NULL, 'COLESTEROL HDL ATELLICA CH', 'Kit 4 x 448 pruebas ', NULL, 0, NULL, '', 0, 1),
(517, NULL, 'GLUCOSA OXIDASA (GluO) ATELLICA CH', 'Kit 4 x 1400 (5600) pruebas ', NULL, 0, NULL, '', 0, 1),
(518, NULL, '(CRP_2) PROTEINA C REACTIVA  ATELLICA CH', 'Kit 2 x 500 pruebas ', NULL, 0, NULL, '', 0, 1),
(519, NULL, 'COLESTEROL LDL ATELLICA CH', 'Kit 4 x 400 pruebas ', NULL, 0, NULL, '', 0, 1),
(520, NULL, 'FRUCTOSAMINA ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(521, NULL, 'GLUCOSA PAP SELECTRA XS 6X100 ML', 'Kit 1752 unds', NULL, 0, NULL, '', 0, 1),
(522, NULL, 'CREATININA ELITECH SELECTRA XS, 2X125 ML', 'Kit 806 pruebas', NULL, 0, NULL, '', 0, 1),
(523, NULL, 'UREA UV SELECTRA XS ELITECH 4X62.5 ML ', 'Kit 720 unds', NULL, 0, NULL, '', 0, 1),
(524, NULL, 'COLESTEROL (CHOL_2) ATELLICA CH', 'Kit 4 x 2100 pruebas ', NULL, 0, NULL, '', 0, 1),
(525, NULL, 'PROTEINAS TOTALES (TP)', 'Kit 3400 pruebas', NULL, 0, NULL, '', 0, 1),
(526, NULL, 'PROTEINAS URINARIAS (UPRO)', 'Kit x 776 pruebas', NULL, 0, NULL, '', 0, 1),
(527, NULL, 'TIBC (CAPACITAD TOTAL DE FIJACION DE HIERRO) ', 'Kit x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(528, NULL, 'COMPLEMENTO C4 ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(529, NULL, 'COMPLEMENTO C3 ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(530, NULL, '(ASO) ASTO - ANTIESTREPTOLISINA ATELLICA CH', 'Kit 3 x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(531, NULL, 'LIPASA (Lip) ATELLICA CH', 'Kit 4 x 320 (1280) pruebas', NULL, 0, NULL, '', 0, 1),
(532, NULL, 'NA K CL IMT ELECTROLITOS (ISE, ELECTRODE K) ATELLICA ', 'Kit 4 multisensores ', NULL, 0, NULL, '', 0, 1),
(533, NULL, 'BARBITURICOS', 'Caja x 25', NULL, 0, NULL, '', 0, 1),
(534, NULL, 'CLEAR PREP. CITOLOGY', 'Botella x 500 ml', NULL, 0, NULL, '', 0, 1),
(535, NULL, 'ORANGE G PAPANICOLAOU 2A NARANJA', 'Botella x 1 litro', NULL, 0, NULL, '', 0, 1),
(536, NULL, 'PAPANICOLAOU SOLUCION 1A HEMATOXILINA', 'Botella x 1 litro', NULL, 0, NULL, '', 0, 1),
(537, NULL, 'TCA 2 CAL ATELLICA CH ', '1 kit 1 x 5 ml', NULL, 0, NULL, '', 0, 1),
(538, NULL, 'CONTROLES DE CALIDAD EXTERNO RIQAS HBA1C X 12 MESES PARTE B', 'Unidad', NULL, 0, NULL, '', 0, 1),
(539, NULL, 'HAV IGM (aHAVM) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(540, NULL, 'HAV TOTAL (aHAVT) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(541, NULL, 'MORPHINA CASSETTE ', 'Kit de 25 pruebas', NULL, 0, NULL, '', 0, 1),
(542, NULL, 'HBC IGM (CORE M) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(543, NULL, 'OPIATES COZART RAPID URINE TEST', 'Kit de 25 pruebas', NULL, 0, NULL, '', 0, 1),
(544, NULL, 'AHBE (Anti-Hbe) ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(545, NULL, 'CALIBRADORES PARA HBA1C NIVELES 1&2 PRIMUS DIAGNOSTIC (USA)', 'Kit de 2x400 ul (1 frasco x nivel)', NULL, 0, NULL, '', 0, 1),
(546, NULL, 'UNIFORMES ADMINISTRATIVOS - CAMISA M/L ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(547, NULL, 'MARCADOR BORRABLE BEROL AZUL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(548, NULL, 'CONTROLES PARA HBA1C NIVELES 1&2 PRIMUS DIAGNOSTIC (USA)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(549, NULL, 'TONER RM 80 X ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(550, NULL, 'TESTOSTERONA LIBRE ACCUBIND ELISA (free testorone)', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(551, NULL, 'PSA LIBRE (FPSA) ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(552, NULL, 'FT3 (T3 LIBRE) ATELLICA IM', 'Kit x 60 pruebas', NULL, 0, NULL, '', 0, 1),
(553, NULL, 'HBCT (CORE TOTAL) ATELLICA IM', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(554, NULL, 'HBEAG (ANTIGENO E DE LA HEPATITIS B)  ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(555, NULL, 'PRUEBA RAPIDA COCAINA - COCAINE COZART RAPID URINE TEST', 'Kit de 25 pruebas', NULL, 0, NULL, '', 0, 1),
(556, NULL, 'ANCA ETANOL NOVA LYTE IFI caja blanca', 'Kit x 78 pbs', NULL, 0, NULL, '', 0, 1),
(557, NULL, 'MONOTEST M I-LATEX', 'Kit de 20 pruebas', NULL, 0, NULL, '', 0, 1),
(558, NULL, 'ANTI dsDNA IgG EIA', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(559, NULL, 'ANA HEP-2 IFA ', '84 pruebas', NULL, 0, NULL, '', 0, 1),
(560, NULL, 'ANTICARDIOLIPINA IgG', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(561, NULL, 'EXTASIS CASSETTE. MDMA EN ORINA', 'Kit de 25 pruebas', NULL, 0, NULL, '', 0, 1),
(562, NULL, 'HIV ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(563, NULL, 'HELICOBACTER PYLORY ANTIBODY', 'Kit de 30 pruebas', NULL, 0, NULL, '', 0, 1),
(564, NULL, 'COLUMNA - KIT DE 500 PRUEBAS DE HBA1C PARA PREMIER HB9210 TRINITY BIOTECH (USA)', 'Kit de 500 pruebas', NULL, 0, NULL, '', 0, 1),
(565, NULL, 'EASYLITE CONTROL CALIDAD CL/LI', 'Kit', NULL, 0, NULL, '', 0, 2),
(566, NULL, 'AFP (ALFAFETOPROTEINA) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(567, NULL, 'THC COZART RAPID URINE TEST - MARIHUANA', 'Kit de 25 pruebas', NULL, 0, NULL, '', 0, 1),
(568, NULL, 'DENGUE ELISA IgM CAPTURE', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(569, NULL, 'DENGUE CASSETTE', 'Kit x 25 pruebas', NULL, 0, NULL, '', 0, 1),
(570, NULL, 'aHCV (Ac Hepatitis C) ATELLICA IM', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(571, NULL, 'ANTITIROGLOBULINA (ATG) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(572, NULL, 'ANTI TPO (ATPO) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(573, NULL, 'CA 125II ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(574, NULL, 'CA 15-3 ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(575, NULL, 'CA 19-9 ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(576, NULL, 'CEA (ANTIGENO CARCINOEMBRIONARIO) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(577, NULL, 'ECOR (CORTISOL) ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(578, NULL, 'DHEA-S ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(579, NULL, 'EE2 (ESTRADIOL) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(580, NULL, 'FERRITINA (FER) ATELLICA IM', 'Kit x 90 pruebas', NULL, 0, NULL, '', 0, 1),
(581, NULL, 'FSH (HORMONA FOLICULO ESTIMULANTE) ATELLICA IM', 'Kit x 190 pruebas', NULL, 0, NULL, '', 0, 1),
(582, NULL, 'FOLATO (FOL) ATELLICA IM', 'Kit x 140 pruebas', NULL, 0, NULL, '', 0, 1),
(583, NULL, 'FT4 (T4 LIBRE) ATELLICA IM', 'Kit x250 pruebas', NULL, 0, NULL, '', 0, 1),
(584, NULL, 'ANTI-PHOSPHOLIPID SCREEN IGG/IGM (antifosfolipido)', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(585, NULL, 'CALCULOS URINARIOS', 'Kit de 50 pruebas', NULL, 0, NULL, '', 0, 1);
INSERT INTO `productos` (`id_productos`, `id_categoria_producto`, `nombre`, `presentacion`, `id_unidad_medida`, `clasificacion_riesgo`, `nombre_imagen`, `nombre_ficha_tecnica`, `cantidad_presentacion`, `estado`) VALUES
(586, NULL, 'ANTICARDIOLIPINA IgM', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(587, NULL, 'ANCA SLIDE FORMALIN', 'Kit de 1 x 5 pozos', NULL, 0, NULL, '', 0, 1),
(588, NULL, 'hCG EN SUERO Y ORINA (25mUl/ml) PRUEBA DE EMBARAZO', '1 caja x 30 pruebas', NULL, 0, NULL, '', 0, 1),
(589, NULL, 'KIT VPH', 'Un frasco + cepillo', NULL, 0, NULL, '', 0, 1),
(590, NULL, 'TONER RM LEXMAR 310', 'Unidad', NULL, 0, NULL, '', 0, 1),
(591, NULL, 'HOMOSISTEINA (HCY) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(592, NULL, 'CURITAS REDONDAS BEIGE ELITE ADULTO', 'Caja x 500 unidades', NULL, 0, NULL, '', 0, 2),
(593, NULL, 'PANCA CONTROL POSITIVO tapa verde', 'Gotero 0.5ml', NULL, 0, NULL, '', 0, 1),
(594, NULL, 'UNIFORMES ADMINISTRATIVOS - PANTALON', 'Unidad', NULL, 0, NULL, '', 0, 1),
(595, NULL, 'CONTROL DE CALIDAD EXTERNO AUTOCHEK (Control externo IFI ANA)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(596, NULL, 'PAPEL FILTRO CUALITATIVO 15 CM', 'Caja x 100', NULL, 0, NULL, '', 0, 1),
(597, NULL, 'ACEITE DE INMERSION', 'Frasco x 100ml', NULL, 0, NULL, '', 0, 1),
(598, NULL, 'TSH NEONATAL ACUBBIND ELISA', 'Kit x 192 pruebas', NULL, 0, NULL, '', 0, 1),
(599, NULL, 'COLORANTE DE WRIGTH', 'Frasco x 1000 ml', NULL, 0, NULL, '', 0, 1),
(600, NULL, 'HBsAg (HBs) HBsII (Antigeno contra la superficie) ATELLICA IM', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(601, NULL, 'TITAN III-H 3022 HEMOGLOBINE ELECTROFORESIS 60 X 76 MM', 'Paquete x 25', NULL, 0, NULL, '', 0, 1),
(602, NULL, 'TITAN III- 3900 LIPO 60 X 76 MM ', 'Paquete x 25', NULL, 0, NULL, '', 0, 1),
(603, NULL, 'TITAN III 3023 SERUM PROTEIN ELECTROFORESIS 60 X 76 MM', 'Paquete x 25', NULL, 0, NULL, '', 0, 1),
(604, NULL, 'SUPRE-HEME BUFFER ', 'Caja x 10 sobres', NULL, 0, NULL, '', 0, 1),
(605, NULL, 'IGE (INMUNOGLOBULINA E TOTAL) ATELLICA IM', 'Kit x 250 pruebas', NULL, 0, NULL, '', 0, 1),
(606, NULL, 'PONCEAU S (ELECTROFORESIS DE PROTEINA) ', 'Frasco x 105 gr', NULL, 0, NULL, '', 0, 1),
(607, NULL, 'Calibrador ADVIA ALP_2 ', '', NULL, 0, NULL, '', 0, 1),
(608, NULL, 'Calibrador ADVIA ENZYME 1', 'Kit 6x2,5 ml', NULL, 0, NULL, '', 0, 1),
(609, NULL, 'Calibrador ADVIA ENZYME 2', 'Kit 6x1,5 ml', NULL, 0, NULL, '', 0, 1),
(610, NULL, 'Calibrador ALCOHOL / AMONIA KIT ', '', NULL, 0, NULL, '', 0, 1),
(611, NULL, 'Calibrador CARDIO PHASE HSCRP ', '', NULL, 0, NULL, '', 0, 1),
(612, NULL, 'PILA RECARGABLE BULLET 2200MAH', 'Unidad', NULL, 0, NULL, '', 0, 1),
(613, NULL, 'Calibrador CHEMISTRY SETPOINT. REF: 09784096', 'Kit 12 x 3 ml', NULL, 0, NULL, '', 0, 1),
(614, NULL, 'Calibrador CRP_2', '', NULL, 0, NULL, '', 0, 1),
(615, NULL, 'IRI (INSULINA) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(616, NULL, 'Calibrador DAU 0 ', '', NULL, 0, NULL, '', 0, 1),
(617, NULL, 'CARNET DE HEMOCLASIFICACION', 'Unidad', NULL, 0, NULL, '', 0, 1),
(618, NULL, 'Calibrador DAU 1 ', '', NULL, 0, NULL, '', 0, 1),
(619, NULL, 'Calibrador DAU 2', '', NULL, 0, NULL, '', 0, 1),
(620, NULL, 'Calibrador DAU 3', '', NULL, 0, NULL, '', 0, 1),
(621, NULL, 'Calibrador DAU 4 ', '', NULL, 0, NULL, '', 0, 1),
(622, NULL, 'Calibrador DAU 5', '', NULL, 0, NULL, '', 0, 1),
(623, NULL, 'Calibrador FRUCTOSAMINA', '', NULL, 0, NULL, '', 0, 1),
(624, NULL, 'RUBEOLA IGG  ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(625, NULL, 'SSB La IgG EIA ', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(626, NULL, 'Sm / RNP IgG EIA ', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(627, NULL, 'Sm IgG EIA ', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(628, NULL, 'SUERO DE COOMBS', 'Frasco x 10 ml', NULL, 0, NULL, '', 0, 1),
(629, NULL, 'LH (HORMONA LUTEINIZANTE) ATELLICA IM', 'Kit x 110 pruebas', NULL, 0, NULL, '', 0, 1),
(630, NULL, 'HEMOCLASIFICADOR ANTI B', 'Frasco x 10 ml', NULL, 0, NULL, '', 0, 1),
(631, NULL, 'HEMOCLASIFICADOR ANTI A', 'Frasco x 10 ml', NULL, 0, NULL, '', 0, 1),
(632, NULL, 'HEMOCLASIFICADOR ANTI D', 'Frasco x 10ml', NULL, 0, NULL, '', 0, 1),
(633, NULL, 'PRL (PROLACTINA) ATELLICA IM', 'Kit x 250 pruebas', NULL, 0, NULL, '', 0, 1),
(634, NULL, 'PRGE (PROGESTERONA) ATELLICA IM', 'Kit x 90 pruebas', NULL, 0, NULL, '', 0, 1),
(635, NULL, 'RUBEOLA IGM ATELLICA IM', 'Kit x 50 pruebas', NULL, 0, NULL, '', 0, 1),
(636, NULL, 'SIFILIS (SYPH) ATELLICA IM', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(637, NULL, 'LIPOPROTEIN STAIN ', 'Frasco x 2.8 gr', NULL, 0, NULL, '', 0, 1),
(638, NULL, 'T4 TRIYODORITONINA ATELLICA IM', 'Kit x 150 pruebas', NULL, 0, NULL, '', 0, 1),
(639, NULL, 'THCG (GONADOTROPINA CORIONICA) ATELLICA IM', 'Kit x 90 pruebas', NULL, 0, NULL, '', 0, 1),
(640, NULL, 'TNI (TROPONINA ULTRA) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(641, NULL, 'TOXOPLASMA IGG ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(642, NULL, 'TSH3 ULTRA ATELLICA IM', 'Kit x 550 pruebas', NULL, 0, NULL, '', 0, 1),
(643, NULL, 'TESTOSTERONA (TSTO II) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(644, NULL, 'VITAMINA B12 (VB12) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(645, NULL, 'VITAMINA D (VIT D) ATELLICA IM', 'Kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(646, NULL, 'BOLSAS IMPRESAS PLASTICAS 25X12 C 2,5', 'Paq * 100 und', NULL, 0, NULL, '', 0, 1),
(647, NULL, 'ANTI SSA Ro IgG EIA', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(648, NULL, 'T3 TRIYODORITONINA  ATELLICA IM', 'Kit x 120 pruebas', NULL, 0, NULL, '', 0, 1),
(649, NULL, 'SORBENTE', 'Frasco x 2 de 1.5ml', NULL, 0, NULL, '', 0, 1),
(650, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS CARDIACO LIOFILIZADO 2V ANALITOS KIT 6X1 ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(651, NULL, 'Calibrador HDL/LDL CHOLESTEROL ', '3 x 1 ml.', NULL, 0, NULL, '', 0, 1),
(652, NULL, 'Calibrador LIQUID SPECIFIC PROTEIN ', '6 x 1 ml.', NULL, 0, NULL, '', 0, 1),
(653, NULL, 'Calibrador MICROALBUMIN_2', 'Curva de 5 x 2 ml.', NULL, 0, NULL, '', 0, 1),
(654, NULL, 'UNIFORMES ADMINISTRATIVOS - CAMISA M/L ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(655, NULL, 'Calibrador SPECIAL CHEMISTRY KIT (SPCL CHEM CAL)', '10 x 5 ml.', NULL, 0, NULL, '', 0, 1),
(656, NULL, 'FOLLETO CITOLOGIA DE CAPA FINA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(657, NULL, 'Calibrador URINE TOTAL PROTEIN ', '3 x 5 ml.', NULL, 0, NULL, '', 0, 1),
(658, NULL, 'TIRAS DE ORINA MULTISTIX', 'Kit x 100 unds', NULL, 0, NULL, '', 0, 1),
(659, NULL, 'Consumibles ACONDICIONADOR DE CUVETAS', '1.000 ml', NULL, 0, NULL, '', 0, 1),
(660, NULL, 'Consumibles CHEM ISE DET SOLUTION', '', NULL, 0, NULL, '', 0, 1),
(661, NULL, 'TALONARIO DE CITOLOGIA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(662, NULL, 'Consumibles CUVETTE TRAY RRV 1X17', 'Paquete x 17', NULL, 0, NULL, '', 0, 1),
(663, NULL, 'Consumibles CUVETTE WASH SOLUTION', '2000 ml.', NULL, 0, NULL, '', 0, 1),
(664, NULL, 'GAFAS TERAPEUTICAS PASTEUR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(665, NULL, 'Consumibles CUVETTE, DTT, 1X20', 'Paquete x 20', NULL, 0, NULL, '', 0, 1),
(666, NULL, 'Consumibles INCUBATN BATH OIL', '', NULL, 0, NULL, '', 0, 1),
(667, NULL, 'Consumibles ISE BUFFER', '', NULL, 0, NULL, '', 0, 1),
(668, NULL, 'KIT TENSIÓMETRO CON FONENDO LORD HS-50D', 'Unidad', NULL, 0, NULL, '', 0, 1),
(669, NULL, 'Consumibles ISE REFERENCE ELECTRODE', '', NULL, 0, NULL, '', 0, 1),
(670, NULL, 'Consumibles LAMP COOLANT ADD', '50 ml.', NULL, 0, NULL, '', 0, 1),
(671, NULL, 'Consumibles LAMP HALOGEN', 'Unidad', NULL, 0, NULL, '', 0, 1),
(672, NULL, 'Consumibles REAGENT PROBE WASH 1', '5 x 250 ml.', NULL, 0, NULL, '', 0, 1),
(673, NULL, 'Consumibles REAGENT PROBE WASH 2', '5 x 250 ml.', NULL, 0, NULL, '', 0, 1),
(674, NULL, 'RECIBO DE CAJA PASTEUR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(675, NULL, 'Consumibles REAGENT PROBE WASH 3', '1 x 500 ml.', NULL, 0, NULL, '', 0, 1),
(676, NULL, 'SPEAKER BLUETOOTH CALYPSO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(677, NULL, 'Consumibles SAMPLE CUPS', 'Caja x 1000', NULL, 0, NULL, '', 0, 1),
(678, NULL, 'Control CK MB REF: CKMB-0900', '4 x 3 ml', NULL, 0, NULL, '', 0, 1),
(679, NULL, 'Control FRUCTOSAMINE L1 FR 2994', '', NULL, 0, NULL, '', 0, 1),
(680, NULL, 'Control FRUCTOSAMINE L3 FR 2996', '', NULL, 0, NULL, '', 0, 1),
(681, NULL, 'PASTILLEROS MARCADOS ELITE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(682, NULL, 'Control LYPHOCHEK ASSAYED CHEM LEV 1', '12 und x 5', NULL, 0, NULL, '', 0, 1),
(683, NULL, 'Control LYPHOCHEK ASSAYED CHEM LEV 2', '12 und x 5', NULL, 0, NULL, '', 0, 1),
(684, NULL, 'Control LYPHOCHEK IMMUNOLOGY BILEV: 1 Y 2 ', '2 de 6 x 1ml', NULL, 0, NULL, '', 0, 1),
(685, NULL, 'SET STICKY PORTA MEMOS PASTEUR ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(686, NULL, 'Control LYPHOCHEK URINE CHEMISTRY, LEV 1', '12 und x 10 ml', NULL, 0, NULL, '', 0, 1),
(687, NULL, 'Control LYPHOCHEK URINE CHEMISTRY, LEV 1', '12 und x 10 ml', NULL, 0, NULL, '', 0, 1),
(688, NULL, 'ROLLO DT3000 DIGITURNOS 39,4*150 CORE 1 5/16\"', 'Rollo', NULL, 0, NULL, '', 0, 1),
(689, NULL, 'Control LYPHOCHEK URINE CHEMISTRY, LEV 2', '12 und x 10 ml', NULL, 0, NULL, '', 0, 1),
(690, NULL, 'Control LIQUICHEK 544 ETHANOL/AMMONIA L1 ', '6x3ml', NULL, 0, NULL, '', 0, 1),
(691, NULL, 'TERMO METÁLICO IMPRESO LASER ELITE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(692, NULL, 'Control LIQUICHEK 545 ETHANOL/AMMON L2', '6x3ml', NULL, 0, NULL, '', 0, 1),
(693, NULL, 'Control LIQUICHEK 546 ETHANOL/AMMONIA L3 ', '6x3ml', NULL, 0, NULL, '', 0, 1),
(694, NULL, 'ROLLO TÉRMICO 57MM X 30 M 55 GRS microscopia', 'Rollo', NULL, 0, NULL, '', 0, 1),
(695, NULL, 'ISE URINE ESTÁNDAR', '', NULL, 0, NULL, '', 0, 1),
(696, NULL, 'SOBRE BLANCO PASTEUR CORRESPONDENCIA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(697, NULL, 'ISE SUERO ESTANDAR ', '', NULL, 0, NULL, '', 0, 1),
(698, NULL, 'ELECTRODOS SODIO (ISE, ELECTRODE NA)', '1564', NULL, 0, NULL, '', 0, 1),
(699, NULL, 'TALONARIO MATERNIT21', 'Unidad', NULL, 0, NULL, '', 0, 1),
(700, NULL, 'ELECTRODOS POTASIO (ISE, ELECTRODE K)', '1564', NULL, 0, NULL, '', 0, 1),
(701, NULL, 'ROLLO DIGITURNO TERMICO ELITE', 'Rollo', NULL, 0, NULL, '', 0, 1),
(702, NULL, 'TALONARIO SINDROME DE DOWN', 'Unidad', NULL, 0, NULL, '', 0, 1),
(703, NULL, 'TALONARIO SOLICITUD DE EXAMEN TINTAS: 1*1 AZUL BOND DE 75GR', 'Engomados x 50 hojas', NULL, 0, NULL, '', 0, 1),
(704, NULL, 'TARJETA IMANTADA P/ NEVERA TINTAS: 4*0 TROQUELADAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(705, NULL, 'HOJAS MEMBRETE PASTEUR PARA CORRESPONDENCIA (LOGO EN LA PARTE DERECHA SUPERIOR)', 'Resma x 500 hojas', NULL, 0, NULL, '', 0, 1),
(706, NULL, 'ELECTRODOS CLORO (ISE, ELECTRODE CL)', '1564', NULL, 0, NULL, '', 0, 1),
(707, NULL, 'ROLLO RECIBO TÉRMICO 80X60 para facturación ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(708, NULL, 'CARTILLA + CRAYOLAS PARA COLOREAR ELITE - PASTEURIN', 'Revista + crayolas', NULL, 0, NULL, '', 0, 1),
(709, NULL, 'VOLANTES INSTRUCTIVO DE DESCARGA DE RESULTADOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(710, NULL, 'VOLANTES PROMOCIONALES FACHADA ELITE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(711, NULL, 'ARCHIVADOR FUELLE OFICIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(712, NULL, 'BANDAS DE CAUCHO', 'Caja ', NULL, 0, NULL, '', 0, 1),
(713, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS PROTEINAS ESPECIFICAS 24 ANALITOS KIT 12X3 ML', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(714, NULL, 'BORRADOR DE NATA PZ-20 PELICAN', 'Unidad', NULL, 0, NULL, '', 0, 1),
(715, NULL, 'LEGAJADOR AZ ULTRA CARTA AZUL C/BISEL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(716, NULL, 'BOLIGRAFO NEGRO ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(717, NULL, 'GANCHO LEGAJADOR X CAJA TRITON', 'Caja x 20 unidades', NULL, 0, NULL, '', 0, 1),
(718, NULL, 'CLIP METALICO MARIPOSA CAJA X 50 UNIDADES', 'Caja x 50 unidades', NULL, 0, NULL, '', 0, 1),
(719, NULL, 'NITROGENO UREICO (UN_c)', 'Kit x 4020 pruebas', NULL, 0, NULL, '', 0, 1),
(720, NULL, 'GN TEST KIT VTK2', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(721, NULL, 'ENGRAPADORA EAGLE TY-900 MM', 'Unidad', NULL, 0, NULL, '', 0, 1),
(722, NULL, 'FECHADOR MULTIPLE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(723, NULL, 'FOLDER CELUGUIA OFICIO HORIZONTAL MARRON', 'Unidad', NULL, 0, NULL, '', 0, 1),
(724, NULL, 'CINTA TRANSPARENTE 48x40', 'Unidad', NULL, 0, NULL, '', 0, 1),
(725, NULL, 'MARCADOR SHARPIE FINO NEGRO SANFORD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(726, NULL, 'GRAPA INDUSTRIAL ', 'Caja', NULL, 0, NULL, '', 0, 1),
(727, NULL, 'LAPIZ  HB2 NEGRO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(728, NULL, 'RESMA BLANCA DE PAPEL BOND TAMAÑO CARTA 75 GRS', '1 resma x 500 hojas', NULL, 0, NULL, '', 0, 1),
(729, NULL, 'PERFORADORA METALICA NEGRA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(730, NULL, 'REGLA 30 CMS ACRÍLICA COLORES SURTIDOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(731, NULL, 'CARTUCHO HP 22', 'Unidad', NULL, 0, NULL, '', 0, 1),
(732, NULL, 'SACAGRAPAS GEMMES', 'Unidad', NULL, 0, NULL, '', 0, 1),
(733, NULL, 'SACAPUNTA METALICO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(734, NULL, 'SOBRE BLANCO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(735, NULL, 'TALONARIO COMPROBANTE DE INGRESO NUMERADO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(736, NULL, 'CARTUCHO HP 21', 'Unidad', NULL, 0, NULL, '', 0, 1),
(737, NULL, 'REPUESTO DE CUCHILLA EXACTO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(738, NULL, 'MARCADOR BORRABLE E-163 SURTIDOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(739, NULL, 'MARCADOR SHARPIE FINO ROJO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(740, NULL, 'SOBRE DE MANILA CARTA 22,5X29CM', 'Unidad', NULL, 0, NULL, '', 0, 1),
(741, NULL, 'CARTUCHO HP 56', 'Unidad', NULL, 0, NULL, '', 0, 1),
(742, NULL, 'CINTA DOBLE FAZ FIJACIÓN 18*1 TESA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(743, NULL, 'CINTA PEQUEÑA TRANSPARENTE', 'Rollo', NULL, 0, NULL, '', 0, 1),
(744, NULL, 'CINTA SAT-CERA PARA IMPRESORA ZEBRA 110*74 OUT', 'Rollo', NULL, 0, NULL, '', 0, 1),
(745, NULL, 'PAPEL FAX GRAMAL 216 X 30 MTS', 'Rollo', NULL, 0, NULL, '', 0, 1),
(746, NULL, 'PAPELERA DE ESCRITORIO TRIPLE METALICA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(747, NULL, 'PASTA CATALOGO ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(748, NULL, 'PORTA LAPIZ METALICO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(749, NULL, 'PROBADOR DE BILLETE (tipo marcador)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(750, NULL, 'PEGA STICK EN BARRA 21GR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(751, NULL, 'UNIFORMES ADMINISTRATIVOS - CHAQUETA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(752, NULL, 'LIBRO ACTA OFICIO 300 FLS FINO BOSTON', 'Unidad', NULL, 0, NULL, '', 0, 1),
(753, NULL, 'FOLDER COLGANTE OFICIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(754, NULL, 'MARCADOR PERMANENTE 420 SURTIDOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(755, NULL, 'SOBRE MANILA OFICIO 25*35', 'Unidad', NULL, 0, NULL, '', 0, 1),
(756, NULL, 'BLOCK AMARILLO TAMAÑO CARTA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(757, NULL, 'CARTUCHERAS DOBLES PARA GUARDAR CUADRE DE CAJA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(758, NULL, 'CINTA DE ENMASCARAR GRUESA 48*40', 'Unidad', NULL, 0, NULL, '', 0, 1),
(759, NULL, 'CLIP SENCILLO (INSTITUCIONAL) TRITON', 'Caja x 100 und', NULL, 0, NULL, '', 0, 1),
(760, NULL, 'TINTA PARA SELLO/ CAUCHO X 30 CC AZUL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(761, NULL, 'RECIBO CAJA MENOR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(762, NULL, 'SOBRE MANILA OFICIO ESPECIAL X UNIDAD 25*35 UNIBOL NARAJA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(763, NULL, 'CELU-GUIAS PARA FOLDER SENCILLO', 'Unidad (paq x 190 unidades)', NULL, 0, NULL, '', 0, 1),
(764, NULL, 'EXACTO GRANDE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(765, NULL, 'TIJERAS GRANDES 7 PULGADAS TRITON', 'Unidad', NULL, 0, NULL, '', 0, 1),
(766, NULL, 'GUIAS SEPARADORAS * 5', 'Unidad', NULL, 0, NULL, '', 0, 2),
(767, NULL, 'TONER RM KYOCERA TK 1147', 'Unidad', NULL, 0, NULL, '', 0, 1),
(768, NULL, 'PLANILLERO (TABLA) PLÁSTICO IPP', 'Unidad', NULL, 0, NULL, '', 0, 1),
(769, NULL, 'BOLSA VERDE EXTRA JUMBO 89*114 ', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(770, NULL, 'CA-Clean I Clean solution                         ', 'Caja 1x 50 ml', NULL, 0, NULL, '', 0, 1),
(771, NULL, 'ALCOHOL ETILICO', 'Frasco x 1 l', NULL, 0, NULL, '', 0, 1),
(772, NULL, 'Control Dimero D', 'Caja x 10 frascos', NULL, 0, NULL, '', 0, 1),
(773, NULL, 'LYPHOCHEK COAG CONTROL N1 12X1 ML REF 744', 'Frasco x 1 unidad', NULL, 0, NULL, '', 0, 1),
(774, NULL, 'LYPHOCHEK COAG CONTROL N2 12X1 ML REF 745', 'Frasco x 1 unidad', NULL, 0, NULL, '', 0, 1),
(775, NULL, 'TUBO POLIPROPILENO FONDO REDONDO 13X75 MM, 5 ML', 'Bolsa x 500 unid', NULL, 0, NULL, '', 0, 1),
(776, NULL, 'TONER RM 83A ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(777, NULL, 'TUBO CONICO ESTERIL PARA CENTRIFUGA TIPO FALCON ORINA CON TAPA ROSCA DE 50ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(778, NULL, 'PANO WYPALL X 80 VERDE INTERFOLD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(779, NULL, 'PRESS APLIQUE AMARILLOS', 'Paquete x 714 unidades', NULL, 0, NULL, '', 0, 1),
(780, NULL, 'TAPONES ROJOS PARA TUBO DE CITOLOGIA 12X75', 'Bolsa x 1000 und', NULL, 0, NULL, '', 0, 1),
(781, NULL, 'TRIGLICERIDOS Trig', 'Kit x 1432 pruebas', NULL, 0, NULL, '', 0, 1),
(782, NULL, 'GUANTES DE NITRILO VERDE TALLA 9', 'Par', NULL, 0, NULL, '', 0, 1),
(783, NULL, 'PCR REACTIVA LATEX RODELG', 'Caja x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(784, NULL, 'PRESS APLIQUE 1193 VERDE', 'Sobre x 1064 unidades', NULL, 0, NULL, '', 0, 1),
(785, NULL, 'GUANTES DOMÉSTICOS NEGROS CALIBRE 25 TALLA 9', 'Par', NULL, 0, NULL, '', 0, 1),
(786, NULL, 'COMPROBANTE DE EGRESO 2006A X 50', '1 paq x 50 und', NULL, 0, NULL, '', 0, 1),
(787, NULL, 'Calibrador DAU 2 ATELLICA CH', '1 kit', NULL, 0, NULL, '', 0, 1),
(788, NULL, 'Calibrador DAU 3 ATELLICA CH', '1 kit', NULL, 0, NULL, '', 0, 1),
(789, NULL, 'Calibrador DAU 5 ATELLICA CH', '1 kit ', NULL, 0, NULL, '', 0, 1),
(790, NULL, 'CIO2 TEST STRIPS ATELLICA CH', 'Kit 1 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(791, NULL, 'TUBO TAPA ROJA CON GEL 4ML', 'Gradilla x 50 tubos', NULL, 0, NULL, '', 0, 1),
(792, NULL, 'ETOH ATELLICA CH', 'Kit 4 x 300 pruebas ', NULL, 0, NULL, '', 0, 1),
(793, NULL, 'OP ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(794, NULL, 'BNZ ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(795, NULL, 'AMP ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(796, NULL, 'BRB ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(797, NULL, 'PCP ATELLICA CH', 'Kit 4 x 380 pruebas', NULL, 0, NULL, '', 0, 1),
(798, NULL, 'PHNY ATELLICA CH', 'Kit 4 x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(799, NULL, 'VANC ATELLICA CH', 'Kit 4 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(800, NULL, 'THEO ATELLICA CH', 'Kit 4 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(801, NULL, 'PHNB ATELLICA CH', 'Kit 4 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(802, NULL, 'GENT ATELLICA CH', 'Kit 4 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(803, NULL, 'TOB ATELLICA CH', 'Kit 4 x 100 pruebas ', NULL, 0, NULL, '', 0, 1),
(804, NULL, 'XTC ATELLICA CH', 'Kit 4 x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(805, NULL, 'PPX ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(806, NULL, 'MDN ATELLICA CH', 'Kit 4 x 380 pruebas ', NULL, 0, NULL, '', 0, 1),
(807, NULL, 'CO2_c ATELLICA CH', 'Kit 4 x 1900 pruebas ', NULL, 0, NULL, '', 0, 1),
(808, NULL, 'ACET ATELLICA CH', 'Kit 4 x 300 pruebas', NULL, 0, NULL, '', 0, 1),
(809, NULL, 'SAL ATELLICA CH', 'Kit 4 x 300 pruebas ', NULL, 0, NULL, '', 0, 1),
(810, NULL, 'LAC ATELLICA CH', 'Kit 4 x 95 pruebas', NULL, 0, NULL, '', 0, 1),
(811, NULL, 'DGN ATELLICA CH', 'Kit 4 x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(812, NULL, 'METMTB ATELLICA CH', 'Kit 4 x 500 pruebas', NULL, 0, NULL, '', 0, 1),
(813, NULL, 'XILOL', 'Frasco x 1 l', NULL, 0, NULL, '', 0, 1),
(814, NULL, 'PRESS APLIQUE NEGRO', 'Paquete x 714 unidades', NULL, 0, NULL, '', 0, 1),
(815, NULL, 'BOTELLA PETALOIDE PEQUEÑA 250ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(816, NULL, 'PRESS APLIQUE ROJOS', 'Paquete x 714 unidades', NULL, 0, NULL, '', 0, 1),
(817, NULL, 'PRESS APLIQUE AZUL', 'Paquete x 714 unidades', NULL, 0, NULL, '', 0, 1),
(818, NULL, 'AGAR MYCOSEL', 'Frasco x 500gr', NULL, 0, NULL, '', 0, 1),
(819, NULL, 'EMPTY ATELLICA CH', '1 kit ', NULL, 0, NULL, '', 0, 1),
(820, NULL, 'LI ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(821, NULL, 'LI ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(822, NULL, 'GLUH_3 ATELLICA CH', 'Kit 4 x 1560 pruebas', NULL, 0, NULL, '', 0, 1),
(823, NULL, 'BOTELLA PETALOIDE MEDIANA 330ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(824, NULL, 'BOTELLA PETALOIDE GRANDE 500ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(825, NULL, 'ACIDO VALPROICO (VPA/VALP) ATELLICA CH', 'Kit 4 x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(826, NULL, 'PSA TOTAL ATELLICA IM', 'Kit 500 pruebas', NULL, 0, NULL, '', 0, 1),
(827, NULL, 'TOXOPLASMA IGM ATELLICA IM', 'Kit 50 pruebas', NULL, 0, NULL, '', 0, 1),
(828, NULL, 'TALONARIO PARA DOMICILIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(829, NULL, 'MASCARILLA 3M CONTRA PARTÍCULAS N95 REF: 9010', 'Unidad', NULL, 0, NULL, '', 0, 1),
(830, NULL, 'LIMPIADOR DE PISO FLOOR CARE', 'Unidad (cuñete)', NULL, 0, NULL, '', 0, 1),
(831, NULL, 'CREA_2 ATELLICA CH', 'Kit 4 x 1472 pruebas', NULL, 0, NULL, '', 0, 1),
(832, NULL, 'PreAlb ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(833, NULL, 'PAMY ATELLICA CH', 'Kit 4 x 430 pruebas', NULL, 0, NULL, '', 0, 1),
(834, NULL, 'APO A1 ATELLICA CH', 'Kit 2 x 150 pruebas ', NULL, 0, NULL, '', 0, 1),
(835, NULL, 'APO B ATELLICA CH', 'Kit 2 x 150 pruebas ', NULL, 0, NULL, '', 0, 1),
(836, NULL, 'Lp(a) ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(837, NULL, 'AAT ATELLICA CH', 'Kit 2 x 180 pruebas ', NULL, 0, NULL, '', 0, 1),
(838, NULL, 'AAG ATELLICA CH', 'Kit 2 x 200 pruebas ', NULL, 0, NULL, '', 0, 1),
(839, NULL, 'ALTPLc ATELLICA CH', 'Kit 2 x 1040 pruebas ', NULL, 0, NULL, '', 0, 1),
(840, NULL, 'ASTPLc ATELLICA CH', 'Kit 2 x 1040 pruebas ', NULL, 0, NULL, '', 0, 1),
(841, NULL, 'CK_L ATELLICA CH', 'Kit 3 x 332 pruebas ', NULL, 0, NULL, '', 0, 1),
(842, NULL, 'HAPT ATELLICA CH', 'Kit 2 x 150 pruebas ', NULL, 0, NULL, '', 0, 1),
(843, NULL, 'Diluent ATELLICA CH', 'Kit 2 x 1.5l', NULL, 0, NULL, '', 0, 1),
(844, NULL, 'Wash ATELLICA CH', 'Kit 2 x 1.5l', NULL, 0, NULL, '', 0, 1),
(845, NULL, 'Conditioner ATELLICA CH', 'Kit 2 x 1.5l ', NULL, 0, NULL, '', 0, 1),
(846, NULL, 'Cleaner ATELLICA CH', 'Kit 2 x 1.5l', NULL, 0, NULL, '', 0, 1),
(847, NULL, 'TUBO DE VIDRIO 16 X 100 SIN TAPA', 'Paquete x 100 unidades', NULL, 0, NULL, '', 0, 1),
(848, NULL, 'TARJETA PLATINO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(849, NULL, 'Standard A Atellica IMT ', 'Kit 2 x 1.5l', NULL, 0, NULL, '', 0, 1),
(850, NULL, 'Diluent Atellica IMT ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(851, NULL, 'LC ATELLICA CH', '1 kit ', NULL, 0, NULL, '', 0, 1),
(852, NULL, 'TRIGLICERIDOS MONO SELECTRA XS', 'Kit 876 pruebas', NULL, 0, NULL, '', 0, 1),
(853, NULL, 'Water bat additive ATELLICA CH', '1 kit ', NULL, 0, NULL, '', 0, 1),
(854, NULL, 'RPC4 ATELLICA CH', '1 kit', NULL, 0, NULL, '', 0, 1),
(855, NULL, 'AlbP CAL ATELLICA CH ', 'Kit 3 x 2 ml', NULL, 0, NULL, '', 0, 1),
(856, NULL, 'CHK Atellica CH ', 'Kit 8 x 47 ml', NULL, 0, NULL, '', 0, 1),
(857, NULL, 'RPC1 ATELLICA CH ', '1 kit', NULL, 0, NULL, '', 0, 1),
(858, NULL, 'RPC2 ATELLICA CH ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(859, NULL, 'ALP_2 CAL ATELLICA CH ', 'Kit 6 x 1 ml', NULL, 0, NULL, '', 0, 1),
(860, NULL, 'ENZ 1 CAL ATELLICA CH ', 'Kit 6 x 2.5 ml', NULL, 0, NULL, '', 0, 1),
(861, NULL, 'ENZ 2 CAL ATELLICA CH ', 'Kit 6 x 1.5 ml', NULL, 0, NULL, '', 0, 1),
(862, NULL, 'ENZ 3 CAL ATELLICA CH ', 'Kit 6 x 2 ml', NULL, 0, NULL, '', 0, 1),
(863, NULL, ' Dilution Check ATELLICA IMT', 'Kit 6 x 2 ml', NULL, 0, NULL, '', 0, 1),
(864, NULL, 'Reaction Ring Segment ATELLICA CH ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(865, NULL, 'Dilution Ring Segment ATELLICA CH ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(866, NULL, 'APO A1 & B CAL ATELLICA CH  ', 'Kit 5 x 1 ml', NULL, 0, NULL, '', 0, 1),
(867, NULL, 'A1c_3 CAL ATELLICA CH ', 'Kit 2 x 4 x 0.5 ml', NULL, 0, NULL, '', 0, 1),
(868, NULL, 'CHEM III CAL ATELLICA CH ', 'Kit 2 x 3 x 2.5 ml', NULL, 0, NULL, '', 0, 1),
(869, NULL, 'DRUG CAL ATELLICA CH ', 'Kit 2 x 5 x 3 ml', NULL, 0, NULL, '', 0, 1),
(870, NULL, 'MANTENIMIENTO A PARED A TODO COSTO EN EL AREA DE MICROBIOLOGIA Y MICROSCOPIA (PINTURA EPOXICA, RESANE E IMPERMEABILIZACION)', '', NULL, 0, NULL, '', 0, 1),
(871, NULL, 'AIU', '', NULL, 0, NULL, '', 0, 1),
(872, NULL, 'CRONOMETRO DIGITAL MARCA CASIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(873, NULL, 'TONER RM HP 05X ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(874, NULL, 'EQUIPO CENTRAL COMPLETO 3.0 TR. MARCA WESTINGHOUSE INVERTER HASTA SEER 20220V/60HZ/1F, REFRIGERANTE R 410A ECOLOGICO. CONDENSADORA + FANCOIL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(875, NULL, 'TERMOSTATO DIGITAL PROGRAMABLE PARA AIRE DE 3.0 TR WESTINGHOUSE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(876, NULL, 'DESMONTE AIRE ACONDICIONADO APTO. DR. ABELLO', '', NULL, 0, NULL, '', 0, 1),
(877, NULL, 'INSTALACION, MANO DE OBRA Y EQUIPO AA PUESTO EN MARCHA ', '', NULL, 0, NULL, '', 0, 1),
(878, NULL, 'BARRIDO DE TUBERIA CON NITROGENO + LIMPIADOR 141B', '', NULL, 0, NULL, '', 0, 1),
(879, NULL, 'TUBERIA EN COBRE DE 7/8 X 3/8 AISLADA EN RUBATEX', '', NULL, 0, NULL, '', 0, 1),
(880, NULL, 'ACCESORIOS, FILTRO SECADOR, CODOS, SEMICODOS', '', NULL, 0, NULL, '', 0, 1),
(881, NULL, 'REAJUSTE DE GAS REFRIGERANTE R410A', '', NULL, 0, NULL, '', 0, 1),
(882, NULL, 'ENTRADA A MAQUINA EN FIBRA DE VIDRIO', '', NULL, 0, NULL, '', 0, 1),
(883, NULL, 'CONTROL DIGITAL Y MANO DE OBRA PARA NEVERA DEL AREA INMUNOQUIMICA ', '', NULL, 0, NULL, '', 0, 1),
(884, NULL, 'Portátil Lenovo ideapad 110-14isk core I5 6a. GENERACION 8 GB 1TB', 'Unidad', NULL, 0, NULL, '', 0, 1),
(885, NULL, 'FILTROS PARA DISPENSADOR DE AGUA Y MANO DE OBRA', '', NULL, 0, NULL, '', 0, 1),
(886, NULL, 'BATERIA CSB 12V/7AH', 'Unidad', NULL, 0, NULL, '', 0, 1),
(887, NULL, 'HERPES SIMPLEX 1 ELISA IgG/IgM', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(888, NULL, 'ANTICUERPOS ANTIMUSCULO LISO IFI (AAS IFA KIT)', '160 pruebas', NULL, 0, NULL, '', 0, 1),
(889, NULL, 'HERPES SIMPLEX 2 ELISA IgG/IgM (Gg2)', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(890, NULL, 'SERVICIO MANO DE OBRA REVISIÓN DE NEVERA DE INMUNOQUIMICA', '', NULL, 0, NULL, '', 0, 1),
(891, NULL, 'MASCARILLA (TAPABOCA) SENCILLA SUJECION ELASTICO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(892, NULL, 'TCA 3 CAL ATELLICA CH ', 'Kit 1 x 5 ml', NULL, 0, NULL, '', 0, 1),
(893, NULL, 'TCA 4 CAL ATELLICA CH ', 'Kit 1 x 5 ml', NULL, 0, NULL, '', 0, 1),
(894, NULL, 'TCA NEG CAL ATELLICA CH ', 'Kit 1 x 10 ml', NULL, 0, NULL, '', 0, 1),
(895, NULL, 'CO2 CAL ATELLICA CH ', 'Kit 2 x 21 ml', NULL, 0, NULL, '', 0, 1),
(896, NULL, 'HDL/LDL CAL ATELLICA CH ', 'Kit 3 x 1 ml', NULL, 0, NULL, '', 0, 1),
(897, NULL, 'DRUG II CAL ATELLICA CH ', 'Kit 2 x 5 x 5 ml', NULL, 0, NULL, '', 0, 1),
(898, NULL, 'MULTIDRUG QC ATELLICA CH ', 'Kit ', NULL, 0, NULL, '', 0, 1),
(899, NULL, 'TCA QC ATELLICA CH ', '1 kit', NULL, 0, NULL, '', 0, 1),
(900, NULL, 'CHEM CAL ATELLICA CH ', 'Kit 12 x 3 ml', NULL, 0, NULL, '', 0, 1),
(901, NULL, 'hsCRP CAL ATELLICA CH ', 'Kit 1 x 6 x 1 ml', NULL, 0, NULL, '', 0, 1),
(902, NULL, 'CRP_2 CAL ATELLICA CH ', 'Kit 1 x 6 x 1 ml', NULL, 0, NULL, '', 0, 1),
(903, NULL, 'CysC CAL ATELLICA CH ', 'N/a', NULL, 0, NULL, '', 0, 1),
(904, NULL, 'Fruc CAL ATELLICA CH ', 'Kit 3 x 1 ml', NULL, 0, NULL, '', 0, 1),
(905, NULL, 'Lp(a) CAL ATELLICA CH ', 'Kit 1 x 5 x 1 ml', NULL, 0, NULL, '', 0, 1),
(906, NULL, 'LSP CAL ATELLICA CH ', 'Kit 1 x 6 x 1 ml', NULL, 0, NULL, '', 0, 1),
(907, NULL, 'MetMtb CAL ATELLICA CH ', 'Kit 1 x 10 ml', NULL, 0, NULL, '', 0, 1),
(908, NULL, 'SPCL CHEM CAL ATELLICA CH ', 'Kit 10  x  5 ml', NULL, 0, NULL, '', 0, 1),
(909, NULL, 'TDM CAL ATELLICA CH ', 'Kit 1 x 6 x 3 ml', NULL, 0, NULL, '', 0, 1),
(910, NULL, 'TOX CAL ATELLICA CH ', 'Kit 6 x 3 ml', NULL, 0, NULL, '', 0, 1),
(911, NULL, 'UPro CAL ATELLICA CH ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(912, NULL, 'B2M CAL ATELLICA CH ', 'Kit 3 x 1 ml', NULL, 0, NULL, '', 0, 1),
(913, NULL, 'Atellica IM cPSA MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(914, NULL, 'HOJAS MEMBRETE PASTEUR ELITE', 'Resma x 500 hojas', NULL, 0, NULL, '', 0, 2),
(915, NULL, 'CA-Clean I Clean solution                         ', 'Caja 1x 50 ml', NULL, 0, NULL, '', 0, 2),
(916, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS TORCH ', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(917, NULL, 'Atellica IM CsA MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(918, NULL, 'NEVERA TIPO VITRINA VERTICAL SLIM 42 PIES 3 PUERTAS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(919, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS HEMATOLOGIA 16 PARAMETROS KIT ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(920, NULL, 'AFP MCM SET Atellica IM ', '1 kit ', NULL, 0, NULL, '', 0, 1),
(921, NULL, 'Atellica IM aTPO MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(922, NULL, 'REPARACIÓN DE ASCENSOR 10791947 ELITE (TARJETA BOTONERA)', '', NULL, 0, NULL, '', 0, 1),
(923, NULL, 'Atellica IM aTPO MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(924, NULL, 'Atellica IM BNP MCM SET', '1 kit', NULL, 0, NULL, '', 0, 1),
(925, NULL, 'Atellica IM BR MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(926, NULL, 'Atellica IM CA 125II MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(927, NULL, 'Atellica IM CA 15-3 MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(928, NULL, 'Atellica IM CA 19-9 MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(929, NULL, 'Atellica IM CEA MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(930, NULL, 'UNIFORME MENSAJERO: Camisa de hombre en oxford, manga larga', 'Unidad', NULL, 0, NULL, '', 0, 1),
(931, NULL, 'Atellica IM Cor MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(932, NULL, 'Atellica IM CpS MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(933, NULL, 'Atellica IM DHEAS MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(934, NULL, 'Atellica IM APW1 2PK', '1 kit ', NULL, 0, NULL, '', 0, 1),
(935, NULL, 'BOLSA VERDE JUMBO 70*100', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 2),
(936, NULL, 'BOLSA ROJA JUMBO 70*100', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 2),
(937, NULL, 'GAFA LENTE CLARO PROTECCION ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(938, NULL, 'VOLANTES PROMOCION DEL MES ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(939, NULL, 'ALCOHOL ACIDO ZN ', 'Frasco x 1000ml', NULL, 0, NULL, '', 0, 2),
(940, NULL, 'SULFAMETOXAZOL TRIMETROPIN 25 Mcg', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(941, NULL, 'AGAR CHOCOLATE', 'Caja x 10 placas', NULL, 0, NULL, '', 0, 2),
(942, NULL, 'RESALTADOR ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(943, NULL, 'HOJAS MEMBRETE PASTEUR PARA RESULTADOS (LOGO CENTRADO)', 'Resma x 500 hojas', NULL, 0, NULL, '', 0, 1),
(944, NULL, 'CONTROL DE CALIDAD EXTERNO UROANALISIS ', 'Muestras liquidas 1 evento ', NULL, 0, NULL, '', 0, 1),
(945, NULL, 'ALANINA AMINOTRANSFERASA (ALT) ATELLICA CH', 'Kit 3 x 850 pruebas', NULL, 0, NULL, '', 0, 1),
(946, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS QUIMICA CLINICA 42 ANALITOS KIT 13X5 ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(947, NULL, 'GUANTES DE NITRILO TALLA M', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(948, NULL, 'BOLSAS PLÁSTICAS TRANSPARENTES ZIPLOC. MEDIDA 14X18', 'Paquete x 100 unidades', NULL, 0, NULL, '', 0, 1),
(949, NULL, 'GUANTES DE NITRILO TALLA S', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(950, NULL, 'MICROALBUMIA (Ualb_2) ATELLICA CH', 'Kit 4 x 210 (840) pruebas ', NULL, 0, NULL, '', 0, 1),
(951, NULL, 'MANTENIMIENTO PREVENTIVO A NEVERA DE UNA PUERTA UBICADA EN BODEGA DE COMPRAS. MANO DE OBRA Y REPUESTOS', '', NULL, 0, NULL, '', 0, 1),
(952, NULL, 'KIT DENSICHEK PLUS STANDARDS', '1 kit  unidad', NULL, 0, NULL, '', 0, 1),
(953, NULL, 'MANTENIMIENTO CORRECTIVO A NEVERA DE DOS PUERTAS UBICADA EN BODEGA DE COMPRAS. MANO DE OBRA Y REPUESTOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(954, NULL, 'CAMISA MENSAJERO EN LINO OXFORD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(955, NULL, 'PANTALON CLASICO BOLSILLO PICADO EN GABARDINA AZUL TURQUI', 'Unidad', NULL, 0, NULL, '', 0, 1),
(956, NULL, 'UNIFORME SERVICIOS GENERA (PANTALON Y CAMISA) EN TELA ANTIFLUIDOS COLOR AZUL TURQUI', 'Conjunto ', NULL, 0, NULL, '', 0, 1),
(957, NULL, 'TUBO CONICO ESTERIL PARA CENTRIFUGA TIPO FALCON ORINA CON TAPA ROSCA DE 15ML ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(958, NULL, 'PIPETA DE 5 A 50 MICROLITOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(959, NULL, 'Atellica IM aTPO MCM SET', '1 kit', NULL, 0, NULL, '', 0, 1),
(960, NULL, 'Atellica IM BNP CAL 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(961, NULL, 'Atellica IM BNP MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(962, NULL, 'Atellica IM BR MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(963, NULL, 'Atellica IM CA 125II CAL 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(964, NULL, 'Atellica IM CA 125II MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(965, NULL, 'Atellica IM CA 15-3 CAL 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(966, NULL, 'Atellica IM CA 15-3 MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(967, NULL, 'Atellica IM CA 19-9 MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(968, NULL, 'Atellica IM CAL 1 2PK', 'Kit 2 x 2 x 1 ml', NULL, 0, NULL, '', 0, 1),
(969, NULL, 'Atellica IM CAL 30 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(970, NULL, 'Atellica IM CAL 30 6PK', 'Kit 6 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(971, NULL, 'Atellica IM CAL 80 2PK IgE', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(972, NULL, 'Atellica IM HCY CAL 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(973, NULL, 'Atellica IM CAL A 2PK', 'Kit 2 x 2 x 5 ml', NULL, 0, NULL, '', 0, 1),
(974, NULL, 'SCANNER CODIGO DE BARRA 2D DATALOGIT QUICKSCAN QD2430 BKK1S', 'Unidad', NULL, 0, NULL, '', 0, 1),
(975, NULL, 'VIDEO BEAM EPSON X41 + DE 3600 LUMENES', 'Unidad', NULL, 0, NULL, '', 0, 1),
(976, NULL, 'HUMEDECEDOR DACTILAR CUENTA FACIL STORTKWIK', 'Unidad', NULL, 0, NULL, '', 0, 1),
(977, NULL, 'Control TAD CONTROL THYROID AUTOANTIBODY (TIROGLOBULINA IMMULITE)', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(978, NULL, 'MANTENIMIENTO PREVENTIVO AIRE ACONDICIONADO SEDE VILLA CAROLINA ', '', NULL, 0, NULL, '', 0, 1),
(979, NULL, 'SUMINISTRO DE BOTON PULSADOR No. 3', '', NULL, 0, NULL, '', 0, 1),
(980, NULL, 'REPARACIÓN DEL AIRE ACONDICIONADO INVERTER AUTOLAB', '', NULL, 0, NULL, '', 0, 1),
(981, NULL, 'TUBO PLASTICO CONICO PARA CENTRIFUGA DE 50 ML', 'Unidad', NULL, 0, NULL, '', 0, 2),
(982, NULL, 'PRUEBA RÁPIDA HEPATITIS C (HCV) VIRUS ANTIBODY', 'Caja x 30 pruebas', NULL, 0, NULL, '', 0, 1),
(983, NULL, 'Atellica IM CKMB ', '1 kit x 100 pruebas', NULL, 0, NULL, '', 0, 1),
(984, NULL, 'HERPES SIMPLEX 1 HSV1 IgM ', 'Caja x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(985, NULL, 'HERPES SIMPLEX 1 HSV1 IGG', 'Caja x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(986, NULL, 'OXIDASA (OXIDASE) 50 AMP 0.75ML', 'Caja x amp de 0.75 ml cada una', NULL, 0, NULL, '', 0, 1),
(987, NULL, 'HERPES SIMPLEX 2 HSV2 IGM', 'Caja x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(988, NULL, 'HERPES SIMPLEX 2 HSV2 IGG', 'Caja x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(989, NULL, 'Atellica IM tIgE MCM SET', '1kit', NULL, 0, NULL, '', 0, 1),
(990, NULL, 'Atellica IM PTH 950T', '1 kit x 950 pruebas', NULL, 0, NULL, '', 0, 1),
(991, NULL, 'Atellica IM PTH MCM SET', '1 kit', NULL, 0, NULL, '', 0, 1),
(992, NULL, 'Atellica IM PTH QC KIT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(993, NULL, 'Atellica IM IRI CAL 2PK', 'Kit 2 x 2 x 2 ml', NULL, 0, NULL, '', 0, 1),
(994, NULL, 'Atellica IM IRI DIL 2PK', 'Unidad', NULL, 0, NULL, '', 0, 1),
(995, NULL, 'Atellica IM IRI MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(996, NULL, 'Atellica IM LH 550T', 'Kit x 550 pruebas', NULL, 0, NULL, '', 0, 1),
(997, NULL, 'IGE ATELLICA IM', 'Kit x 250 pruebas', NULL, 0, NULL, '', 0, 2),
(998, NULL, 'RPR CARBON SPINREACT', 'Caja x 500 pruebas', NULL, 0, NULL, '', 0, 1),
(999, NULL, 'HUELLERO', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1000, NULL, 'ABONO SISTEMA PROHYGIENE', '', NULL, 0, NULL, '', 0, 1),
(1001, NULL, 'PRUEBA RÁPIDA HEPATITIS B HBSAG (ANTIGENO SUPERFICIE) ', 'Caja x 30 test', NULL, 0, NULL, '', 0, 1),
(1002, NULL, 'PTH (iPTH) ATELLICA IM', 'Kit x 190 pruebas', NULL, 0, NULL, '', 0, 1),
(1003, NULL, 'CLEAR AID ELECTROFORESIS', 'Frasco x 250 ml', NULL, 0, NULL, '', 0, 1),
(1004, NULL, 'BEBIDA CAFE GRANO SUAVE 2 - CAFE SELLO ROJO ESPRESSO VENDING 500GR', '', NULL, 0, NULL, '', 0, 1),
(1005, NULL, 'PRUEBA RAPIDA HIV PLUS COMBO SUERO, PLASMA, SANGRE TOTAL', 'Caja x 30 unidades', NULL, 0, NULL, '', 0, 1),
(1006, NULL, 'AGAR CHOCOLATE + POLYVITEX ', 'Kit x 20 placas', NULL, 0, NULL, '', 0, 1),
(1007, NULL, 'Atellica IM LH MCM SET', '1 kit ', NULL, 0, NULL, '', 0, 1),
(1008, NULL, 'Atellica IM Multi-Diluent 1 2PK', 'Kit', NULL, 0, NULL, '', 0, 1),
(1009, NULL, 'Atellica IM Multi-Diluent 1 6PK', 'Kit ', NULL, 0, NULL, '', 0, 1),
(1010, NULL, 'Atellica IM Multi-Diluent 1 Bottle', 'Kit', NULL, 0, NULL, '', 0, 1),
(1011, NULL, 'CINTA DE ENMASCARAR 48X40', 'Und', NULL, 0, NULL, '', 0, 2),
(1012, NULL, 'SOBRE DE MANILA BLANCO CARTA 25X31', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1013, NULL, 'CANECA PAPELERA GRIS VAIVEN MARCADA 10 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1014, NULL, 'CANECA PAPELERA ROJA VAIVEN MARCADA 10 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1015, NULL, 'CANECA PAPELERA ROJA PEDAL MARCADA 20 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1016, NULL, 'CANECA PAPELERA VERDE PEDAL MARCADA 20 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1017, NULL, 'CAMBIO DE FUENTE AVISO LUMINOSO EN VILLA CAMPESTRE', '', NULL, 0, NULL, '', 0, 1),
(1018, NULL, 'NOVOBIOCINA SESIDISCOS OXOID', 'Caja x 5 tubos', NULL, 0, NULL, '', 0, 1),
(1019, NULL, 'CANECA VERDE DE 45 LT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1020, NULL, 'CROMO CPS ELITE (CHROMID)', 'Caja x 20 plt', NULL, 0, NULL, '', 0, 1),
(1021, NULL, 'EQUIPO VIDAS 3', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1022, NULL, 'TIMER DIGITAL 1 TIEMPO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1023, NULL, 'Calificación de desempeño a una (1) cabina de seguridad biológica - Ubicada en Barranquilla', '', NULL, 0, NULL, '', 0, 1),
(1024, NULL, 'DESMONTE Y MONTAJE DE AVISO SEDE ELITE. CAMBIO DE CABLEADO POR DETERIORO', '', NULL, 0, NULL, '', 0, 1),
(1025, NULL, 'VINILO ESMERILADO INSTALADO EN NEVERAS.', '', NULL, 0, NULL, '', 0, 1),
(1026, NULL, 'TERMOHIGROMETRO DIGITAL. TEMPERATURA INTERNA: -10 A 50 °C, - RANGO DE TEMPERATURA EXTERNA -40 A 70 °C. HUMEDAD RELATIVA INTERNA 25 A 95% A 1', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1027, NULL, 'UNIFORMES SERVICIOS GENERALES Blusa azul turqui antifluido, cuello tipo V, tela TX 200, COLOR 194024. - Pantalòn tipo piyama azul turqui ant', 'Conjunto camisa y pantalon', NULL, 0, NULL, '', 0, 1),
(1028, NULL, 'CITOCEPILLOS PAQUETES X 100 UND', 'Paquete x 100 unidades', NULL, 0, NULL, '', 0, 1),
(1029, NULL, 'UNIFORMES AREA CIENTIFICA - Blusa M/C azul turqui antifluido, tela TX200, color 194024. Pantalon y bata', 'Conjunto camisa y pantalon', NULL, 0, NULL, '', 0, 1),
(1030, NULL, 'MANTENIMIENTO, LAVADO Y DESINFECCION DE TANQUES DE AGUA POTABLE DEL LABORATORIO, SEDES ELITE Y PRINCIPAL', '', NULL, 0, NULL, '', 0, 1),
(1031, NULL, 'MANTENIMIENTO PREVENTIVO PARA EQUIPO CHEMWELL ', '', NULL, 0, NULL, '', 0, 1),
(1032, NULL, 'SOPORTE PARA CPU', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1033, NULL, 'CARGADOR ACER PUNTA AMARILLA 19V 3.42A', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1034, NULL, 'CARTUCHO COMBO PACK HP 61 NEGRO + HP 61 COLOR', 'Combo dos cartuchos', NULL, 0, NULL, '', 0, 1),
(1035, NULL, 'MANTENIMIENTO AIRE CENTRAL SEDE CENTRO', '', NULL, 0, NULL, '', 0, 1),
(1036, NULL, 'PERFORMANCE CHECK KIT, 29XX ', 'Kit ', NULL, 0, NULL, '', 0, 1),
(1037, NULL, 'AGAR CHOCOLATE THAYER + POLIVITEX + VCAT3', 'Caja x 10 placas', NULL, 0, NULL, '', 0, 1),
(1038, NULL, 'UNIFORME MENSAJERO: Pantalón de hombre en germánica', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1039, NULL, 'JEANS DE HOMBRE INDUSTRIAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1040, NULL, 'DVR - XVR 32CH 5 EN 1 2CH IP HASTA 5MP GRABACION 1080N/720 - Pa15FPS 1 VGA/HDMI 1 ENTRADA/SALIDA RCA 2 SATA RS48 5H.264', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1041, NULL, 'RECARGA Y MANTENIMIENTO A EXTINTORES ', '', NULL, 0, NULL, '', 0, 1),
(1042, NULL, 'TARJETA DE PRESENTACION ', 'Paquete de 1000 und', NULL, 0, NULL, '', 0, 1),
(1043, NULL, 'SEÑALIZACION PARA BAÑOS EN VINILO TRANSPARENTE, ESMERILADO DE FONDO MONTADO SOBRE ACRÍLICO DE 2 PIEZAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1044, NULL, 'DAILY CLEANING SOLUTION KIT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1045, NULL, 'PALO ERGONOMICO EXTENSIONES DE 2MT ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1046, NULL, 'CALDO BHI CEREBRO CORAZÓN (INFUSION)', 'Frasco x 500 grs', NULL, 0, NULL, '', 0, 1),
(1047, NULL, 'PAPELERA ROJA PEDAL DE 12 LTS ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1048, NULL, 'PAPELERA GRIS PEDAL DE 12 LTS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1049, NULL, 'ELECTRA HR BUFFER REF 5805', 'Caja x 10', NULL, 0, NULL, '', 0, 1),
(1050, NULL, 'TUBO TAPA AZUL 3,5 ML SOLIUM CITRATE 3,2%', 'Gradilla x 50 tubos', NULL, 0, NULL, '', 0, 1),
(1051, NULL, 'SILLA OPERATIVA 280 SIN BRAZOS DOS PALANCAS, ESTRUCTURA INTERNA CON LAMINA TRIPLE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1052, NULL, 'UNIDAD DE IMAGEN KYOCERA FS M2035', '', NULL, 0, NULL, '', 0, 1),
(1053, NULL, 'UNIDAD FUSORA KYOCERA FS M2035', '', NULL, 0, NULL, '', 0, 1),
(1054, NULL, 'EASY EXPAND PACK, NA/K/CL/CA/LI, 800ML', 'Frasco 800ml', NULL, 0, NULL, '', 0, 1),
(1055, NULL, 'STICKER DE 5X5 CM PARA MÉDICOS', 'Hoja x 20 sticker', NULL, 0, NULL, '', 0, 1),
(1056, NULL, 'UPS MICRONET DE 500VA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1057, NULL, 'BI LEVEL QUALITY CONTROL KIT - EASYQC', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1058, NULL, 'MANTENIMIENTO PREVENTIVO A AIRE ACONDICIONADO MINI SPLIT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1059, NULL, 'SERVICIO TECNICO M2035 KYOCERA', '', NULL, 0, NULL, '', 0, 1),
(1060, NULL, 'BENEDICT PRUEBA AZUCARES REDUCTORES EN HECES X 250 ML NOVALAB', 'Botella x 250 ml', NULL, 0, NULL, '', 0, 1),
(1061, NULL, 'VIDRIO EN 10MM, 90*1.06 CMS. INCOLORO CRUDO, CON BORDES PULIDOS Y BRILLADOS, CON 4 PERFORACIONES SUJETOS A LA PARED. ESMERILADO TOTAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1062, NULL, 'BROCHURE ATELLICA 28*22 CM, 2 CUARTILLAS OCHO PAGINAS, 150 GR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1063, NULL, 'STICKER PAPEL ADHESIVO FULL COLOR TAMAÑO 15*15 CM: REF CANECAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1064, NULL, 'STICKER PAPEL ADHESIVO FULL COLOR TAMAÑO 15*15 CM PARA CANECAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1065, NULL, 'PLEGABLES CITOLOGIA A FULL COLOR X 2 LADOS TAMAÑO 49X22 CM PROPALCOTE 150GR ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1066, NULL, 'REAJUSTE DE GAS R 410 Y REFRIGERANTE R 410', '', NULL, 0, NULL, '', 0, 1),
(1067, NULL, 'CERRADURA ALCOBA AUSTIN CROMO YALE SKU 0006481 UE*24', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1068, NULL, 'RODILLO FELPA 9 SUKRA STANPROF UE 100', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1069, NULL, 'GALON PINTUCO VINILTEX BLANCO ALMENDRA 1561', 'Galon', NULL, 0, NULL, '', 0, 1),
(1070, NULL, 'GRAPA ESTÁNDAR GALVANIZADA TRITON', 'Caja x 5000 unidades', NULL, 0, NULL, '', 0, 1),
(1071, NULL, 'PROTECTOR DE CATALOGO EN ACETATO CARTA POLIPROPILENO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1072, NULL, 'CINTA DE ENMASCARAR TESA 12X40 EMP*72 ', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1073, NULL, 'BOLSA GRIS GRANDE 65*80', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(1074, NULL, 'MANTENIMIENTO PREVENTIVO AIRE CENTRAL', '', NULL, 0, NULL, '', 0, 1),
(1075, NULL, 'CRIOVIAL DE 2.0ML AUTOSOSTENIBLE ', 'Bolsa x 500 und', NULL, 0, NULL, '', 0, 1),
(1076, NULL, 'PAPANICOLAOU SOLUCION 3B EA50 POLICROMA', 'Papanicolaou solucion 3b ea50 policroma', NULL, 0, NULL, '', 0, 1),
(1077, NULL, 'OVEROL EN DRIL MANGA LARGA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1078, NULL, 'ERLERMEYER DE 500ML MARCA DURAN', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1079, NULL, 'CONTROL LYPHOCHEK, DIABETES PARA HEMOGLOBINA GLICOSILADA. BILELEVEL 1 Y 2', 'Kit x 6 controles 0.5ml', NULL, 0, NULL, '', 0, 1),
(1080, NULL, 'EQUIPO 5.0 TR EQUIPO CENTRAL COMPLETO MARCA RHEEM BOREAL INVERTER 220/60hz/1f, REFRIGERANTE R410A ECOLOGICO COMPUESTO POR CONDENSADORA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1081, NULL, 'PULIDA BRILLADA Y CRISTALIZADA DE PISOS EN TABLETA DE GRANITO', 'Uni', NULL, 0, NULL, '', 0, 1),
(1082, NULL, '3 Publicaciones de aviso o contenido editorial de 1 página en la Revista Actual impresa (1 publicación por mes o a decisión del cliente).', '', NULL, 0, NULL, '', 0, 1),
(1083, NULL, 'CARPETAS REFORZADAS EN MATERIAL YUTE PARA FACTURACION POLICIA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1084, NULL, 'CAMILLA GINECOLOGICA EN LAMINA COLD ROLLED, CALIBRE 20. EN PINTURA ELECROTATICA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1085, NULL, 'MARCADOR BORRABLE BEROL VERDE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1086, NULL, 'MINICOLLECT 1ml TAPA AZUL ', 'Paquete x 50 unidades', NULL, 0, NULL, '', 0, 1),
(1087, NULL, 'TUBO CÓNICO POLIPROPILENO 12*75 PARA CITOLOGIA', 'Caja x 1000 unidades', NULL, 0, NULL, '', 0, 1),
(1088, NULL, 'FUENTE DE PODER ATX', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1089, NULL, 'CABLE VGA PC', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1090, NULL, 'PATCH COD CATEGORIA 6', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1091, NULL, 'MOUSE RS DX 120 USB', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1092, NULL, 'MONOGAFAS BLACK PANTHER', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1093, NULL, 'CASCO TIPO II DE 3 PUNTOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1094, NULL, 'CAMILLA CON INMOVILIZADOR DE CUELLO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1095, NULL, 'PROTECTOR AUDITIVO TIPO LLAVERO', 'Par', NULL, 0, NULL, '', 0, 1),
(1096, NULL, 'BENZODIAZEPINES COZART RAPID URINE TEST', 'Kit de 40 pruebas', NULL, 0, NULL, '', 0, 1),
(1097, NULL, 'TONER RM 42A / 42X HP', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1098, NULL, 'ESTUCO MASTIC BLANCO 18070 CANECA 27KG 10359541 PINTUCO', 'Caneca 27kg', NULL, 0, NULL, '', 0, 1),
(1099, NULL, 'GALON PINTUCO VINILTEX BLANCO 1501', 'Galon', NULL, 0, NULL, '', 0, 1),
(1100, NULL, 'BOMBILLO AHORRADOR ESPIR 15 W T2 120V 6.5K 6000 HORAS CAJA UW20P28883-33 SYLVANIA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1101, NULL, 'LIJA OMEGA 150 CLAVE 1105 ABRACOL RPHOA0150000 UE 50', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1102, NULL, 'MEMORIA USB 16GB SANDISK EDGE ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1103, NULL, 'LAMINAS CUBRE OBJETO 24X60 CITOLOGIA', 'Paquete de 100 laminas', NULL, 0, NULL, '', 0, 1),
(1104, NULL, 'PENEL LED REDONDO INCRUSTAR 8´18W 6K 100-240V 120º 720 LUMEN P24338-33 SYLVANIA UE*30', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1105, NULL, 'SEPARADORES PLASTICOS 105  JUEGO X5 KM001001', 'Paquete x 5 und', NULL, 0, NULL, '', 0, 1),
(1106, NULL, 'PIPETA PASTEUR 3 ML ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1107, NULL, 'COLUMNA HEMOGLOBINA GLICOSILADA (A1C_3) CH ATELLICA', 'Kit x 400 pruebas', NULL, 0, NULL, '', 0, 1),
(1108, NULL, 'GALON PINTUCO VINILTEX BLANCO 1501 CANECA 5 GALONES', 'Caneca 5 galones', NULL, 0, NULL, '', 0, 1),
(1109, NULL, 'CONTROL GLUCOMETRO, TRUETESTS SOLUTION LEVEL 3', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1110, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS INMUNOENSAYO (HORMONAS) 38 ANALITOS REP 15 RANDOX UK ', 'Kit 12x5 ml', NULL, 0, NULL, '', 0, 1),
(1111, NULL, 'MANTENIMIENTO A EQUIPOS DE LABORATORIO', '', NULL, 0, NULL, '', 0, 1),
(1112, NULL, 'PANEL LED REDONDO INCRUSTAR 11´24W 6K 100-240V 120º 7200 LUMEN P24339-36 SYLVANIA UE * 20', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1113, NULL, 'GUANTES TIPO INGENIERO ', 'Par', NULL, 0, NULL, '', 0, 1),
(1114, NULL, 'ARNES 4 ARGOLLAS EN X', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1115, NULL, 'ESLINGAS EN Y CON ABSORCION Y GANCHOS 2 1/2¨', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1116, NULL, 'DESMONTE, REPARACION E INSTALACION DE TARJETA ELECTRONICA MINISPLIT INVERTER AUTOLAB', '', NULL, 0, NULL, '', 0, 1),
(1117, NULL, 'REPARACION DE TARJETA ELECTRONICA', '', NULL, 0, NULL, '', 0, 1),
(1118, NULL, 'ESTUCO PROFESIONAL PINTUCO INTERIOR BLANCO 117060 CANECA 5 GALONES ', '5 galones', NULL, 0, NULL, '', 0, 1),
(1119, NULL, 'CINTA DE PAPEL PARA YESO CARTON 50MM X 150 MT KACHE TOOLS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1120, NULL, 'CODO SANITARIO CC 2 GERFOR 300114', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1121, NULL, 'UNION SANITARIO 2 GERFOR 300135', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1122, NULL, 'ADAPTADOR MACHO 1/2 GERFOR 300026', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1123, NULL, 'CODO PRESION 1/2¨GERFOR 300057', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1124, NULL, 'UNION PVC 1/2 GERFOR 300095', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1125, NULL, 'SERRUCHO PARA DYWALL 6 65MN KACHE TOOLS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1126, NULL, 'TEFLON 1/2 X 8 MT STANPROF ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1127, NULL, 'LLAVE LAVAMANOS CROMADA + MANGO BRIZA GRIVAL 321493331', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1128, NULL, 'SIFON BOTELLA GRIVAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1129, NULL, 'SOLDADURA PVC VERDE 1/4 SUPRASOLD VERDE GERFOR 560121', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1130, NULL, 'TUBO PLASTICO CONICO PARA CENTRIFUGA DE 15 ML', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1131, NULL, 'CINTA DE ENMASCARAR DELGADA/MEDIANA', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1132, NULL, 'Toner rm 35a hp laser jet p1102w', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1133, NULL, 'MANTENIMIENTO AIRE MINISPLIT SANTA MARTA', '', NULL, 0, NULL, '', 0, 1),
(1134, NULL, 'TUBO CONICO 16 X 100 MM BOLSA X 250 UND', 'Bolsa x 250 und', NULL, 0, NULL, '', 0, 2),
(1135, NULL, 'CONTENEDOR PARA ESPUTO DE 120ML, ESTERIL A', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1136, NULL, 'MANTENIMIENTO A SILLAS PARA ÁREA CIENTÍFICA - VER RELACION', '', NULL, 0, NULL, '', 0, 1),
(1137, NULL, 'LOCKER METALICO DE 12 PUERTAS ELABORADO EN LAMINA COLD ROLLER CALIBRE 22', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1138, NULL, 'MUEBLE AUXILIAR PARA TOMA DE MUESTRA EN MADERA INDUSTRIAL ENCHAPADO EN FORMICA ', '', NULL, 0, NULL, '', 0, 1),
(1139, NULL, 'TUBO SANITARIO DE 2*6MT GERFOR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1140, NULL, 'LAVAMANOS MILANO BEIGE CORONA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1141, NULL, 'TUBO PRESION 1/2 X 6 MTS GERFOR 13.5 GERFOR 340147', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1142, NULL, 'BANDEJA EN ACRILICO ESTILO CAJON CON PARRILLA O SOPORTE SUPERIOR PARA TUBOS DE MUESTRAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1143, NULL, 'HEAVY DUTY 2-HOLE PUNCH', 'Heavy duty 2-hole punch', NULL, 0, NULL, '', 0, 1),
(1144, NULL, 'TONER RM KYOCERA TK 172', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1145, NULL, 'MASCARILLA O RESPIRADOR CONTRA PARTICULAS 3M REF 6200 CON CARTUCHOS 6001', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1146, NULL, 'INSTALACION DE ANALIZADOR DE REDES POR 3 DIAS, INCLUYE INFORME. ', '', NULL, 0, NULL, '', 0, 1),
(1147, NULL, 'UTILIDAD', '', NULL, 0, NULL, '', 0, 1),
(1148, NULL, 'INSTALACION DE DOS AIRES CENTRALES EN EL PISO 3. SEDE PRINCIPAL, NUEVAS OFICINAS WE WORK', '', NULL, 0, NULL, '', 0, 1);
INSERT INTO `productos` (`id_productos`, `id_categoria_producto`, `nombre`, `presentacion`, `id_unidad_medida`, `clasificacion_riesgo`, `nombre_imagen`, `nombre_ficha_tecnica`, `cantidad_presentacion`, `estado`) VALUES
(1149, NULL, 'SERVICIO DE MANTENIMIENTO ASCENSOR SEDE ELITE', '', NULL, 0, NULL, '', 0, 1),
(1150, NULL, 'AST ST03 TEST KIT (STREPTOCO)', 'Caja x 20 tarjetas', NULL, 0, NULL, '', 0, 1),
(1151, NULL, 'AGAR SANGRE PREPARADO 43041 (COLUMBIA 5% SHEEP BL)', 'Caja x 20 placas', NULL, 0, NULL, '', 0, 2),
(1152, NULL, 'MUEBLE ESPECIAL DE 85 DE FRENTE X 90 DE ALTO X 45, PUERTAS DE BATIENTE CON ZOCALO DE 12CM CON ESPALDAR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1153, NULL, 'IMPRESORA EPSON TM-T20 NEGRA USB MAS SERIALAC CON FUENTE INCLUIDA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1154, NULL, 'IMPRESORA DE ETIQUETAS ZEBRA GC420TD ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1155, NULL, 'LECTOR CODIGO LD 101R USB SAT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1156, NULL, 'PC COMPUTADOR COMPLETO. INTEL CELERON 2.41 GHZ. DISCO 1 TERA, MEMORIA DDR3, 4GB UNIDAD DVDRW LG. COMBO MOUSE Y TECLADO, MONITOR 20¨', 'Combo monitor, teclado, mouse, cpu', NULL, 0, NULL, '', 0, 1),
(1157, NULL, 'DESAGÜE SENCILLO SIN REBOSE GRIVAL 931120001', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1158, NULL, 'DISCO DIAMANTADO 4 1/2 SEGMENTADO CLAVE 5502 ABRACOL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1159, NULL, 'HIDROXIDO DE POTASIO 40% KOH ', 'Frasco x 100 ml', NULL, 0, NULL, '', 0, 1),
(1160, NULL, 'BOLIGRAFO ROJO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1161, NULL, 'PERFORADORA DE 2 HUECOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1162, NULL, 'MANTENIMIENTO PREVENTIVO A EQUIPOS DE LABORATORIO', '', NULL, 0, NULL, '', 0, 1),
(1163, NULL, 'TUBOS HEMATOCRITOS / HEPARINA ', 'Frasco x 100', NULL, 0, NULL, '', 0, 1),
(1164, NULL, 'CURITAS REDONDAS PARA ADULTO ', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(1165, NULL, 'Epoc bgem test cards', 'Caja x 50 tarjetas', NULL, 0, NULL, '', 0, 1),
(1166, NULL, 'CREATIN QUINASA (CK NAC SL 2X62,5 ML)', 'Kit x 980 pruebas', NULL, 0, NULL, '', 0, 1),
(1167, NULL, 'TUBO DE ENSAYO DE VIDRIO DE 12 X 75 ', 'Caja x 100 unidades', NULL, 0, NULL, '', 0, 1),
(1168, NULL, 'ELECTRODO DE LITIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1169, NULL, 'MANO DE OBRA PARA CAMBIO DE PISO EN BAÑO, INCLUYE QUITAR EL ACTUAL Y COLOCAR EL NUEVO.', '', NULL, 0, NULL, '', 0, 1),
(1170, NULL, 'CLORURO DE SODIO 0.9% X 100 ML ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1171, NULL, 'RECOLECTOR POR GALON AFORADO PARA ORINA 24 HORAS AMBAR DE 2.7 LITROS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1172, NULL, 'RECIPIENTE COPROLOGICO PAQUETE X 100 UNIDADES', 'Bolsa x 100 frascos', NULL, 0, NULL, '', 0, 1),
(1173, NULL, 'JERINGA PRECISION 2 ML PEDIATRICA. 21X1 1/2 ', 'Caja x 100', NULL, 0, NULL, '', 0, 1),
(1174, NULL, 'PRESS APLIQUE NARANJA', 'Paquete unidad', NULL, 0, NULL, '', 0, 1),
(1175, NULL, 'TERMÓMETRO ELECTRÓNICO DIGITAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1176, NULL, 'COLGADOR PARA TRAPERO Y ESCOBA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1177, NULL, 'CAJA METALICA GRANDE 28.5X29.5X8', '', NULL, 0, NULL, '', 0, 1),
(1178, NULL, 'COMUNICADOR GPRS EBS', '', NULL, 0, NULL, '', 0, 1),
(1179, NULL, 'BATERIA 12V 7 AMP GEL CASIL', '', NULL, 0, NULL, '', 0, 1),
(1180, NULL, 'FUENTE DE PODER DE 12 VDC 1.5 AMPS', '', NULL, 0, NULL, '', 0, 1),
(1181, NULL, 'TRANSFORMADOR 16.5V - 40V, 2.4A', '', NULL, 0, NULL, '', 0, 1),
(1182, NULL, 'MANO DE OBRA TECNIALARMA', '', NULL, 0, NULL, '', 0, 1),
(1183, NULL, 'MANTENIMIENTO PREVENTIVO MINISPLIT INVERTE', '', NULL, 0, NULL, '', 0, 1),
(1184, NULL, 'RAPIDEC CARBA NP', 'Kit x 25 pruebas', NULL, 0, NULL, '', 0, 1),
(1185, NULL, 'Test de Aliento 13C UREA para Helicobacter Pylori', 'Kit x 20 pruebas', NULL, 0, NULL, '', 0, 1),
(1186, NULL, 'MANTENIMIENTO DE VENTANAS PROYECTANTES, AJUSTE, LIMPIEZA, CAMBIO DE BRAZOS, CAMBIO DE TORNILLERIA', '', NULL, 0, NULL, '', 0, 1),
(1187, NULL, 'CAMARA NEWBAUER LINEA BLANCA ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1188, NULL, 'VASELINA BLANCA USP ', 'Frasco 125gr', NULL, 0, NULL, '', 0, 1),
(1189, NULL, 'Papel filtro TSH neonatal (96 unid) ', 'Paquete x 96 und', NULL, 0, NULL, '', 0, 1),
(1190, NULL, 'ELECTRODO DE REFERENCIA REF: 2152', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1191, NULL, 'MEMORIA DE 4 GIGAS DDR3 PARA PC', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1192, NULL, 'BOLSA ROJA MEDIANA 65*80', 'Paquete x 20 und', NULL, 0, NULL, '', 0, 1),
(1193, NULL, 'RECARGA EXTINTOR DE PQS ABC X 20LBS', '', NULL, 0, NULL, '', 0, 1),
(1194, NULL, 'RECARGA EXTINTOR DE PQS ABC X 10LBS', '', NULL, 0, NULL, '', 0, 1),
(1195, NULL, 'MANTENIMIENTO EXTINTOR DE SOLKAFLAM 3.700 GRS', '', NULL, 0, NULL, '', 0, 1),
(1196, NULL, 'VALVULAS PARA EXTINTOR DE PQS Y SOLKABLAM', '', NULL, 0, NULL, '', 0, 1),
(1197, NULL, 'FRENO ARRASTRADOR 16MM HERGO 06117-16', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1198, NULL, 'PARLANTE GENIUS SP U115', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1199, NULL, 'BOMBILLO HALOGEN DISPLAY OPTIC LAMP PARA MICROSCOPIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1200, NULL, 'COMPUTADOR DE ESCRITORIO INTEL I7 8GB ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1201, NULL, 'BATERIA EXIDE 31H 1000CCA 200CR', '', NULL, 0, NULL, '', 0, 1),
(1202, NULL, 'INSUMOS Y TRANSPORTE ', '', NULL, 0, NULL, '', 0, 1),
(1203, NULL, 'CAMBIO DE CONTACTOR PRINCIPAL PARA ASCENSOR ELITE', '', NULL, 0, NULL, '', 0, 1),
(1204, NULL, 'ASSY RFID, EL2 (tarjeta de litio)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1205, NULL, 'Servicio de alquiler ', '', NULL, 0, NULL, '', 0, 1),
(1206, NULL, 'LOFT 30*60 GREIGE', 'Caja x 8 ', NULL, 0, NULL, '', 0, 1),
(1207, NULL, 'DURAPEGA PERCELANICO GRIS X 25KG', 'Bolsa x 25 kg', NULL, 0, NULL, '', 0, 1),
(1208, NULL, 'MANTENIMIENTO PREVENTIVO Y CORRECTIVO A NEVERAS', '', NULL, 0, NULL, '', 0, 1),
(1209, NULL, 'DISCO CORTE METAL PLANO 4 1/2*0.45 DEWALT ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1210, NULL, 'DISCO DOBLE PROPOSITO 4 1/2*3/64*7/8 TIPO 1 ABRACOL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1211, NULL, 'KIT PULIDORA 4 1/2 + TALADRO 3/8 550W CAJA CARTON BLACK & DECKER G720-B3P', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1212, NULL, 'PIPETA AUTOMÁTICA 100-1000 uL-BOECO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1213, NULL, 'TALADRO INALAMBRICO 12VVDC-LI STANPROF + 6PUNTAS + 6BROCAS + ADAPTADOR', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1214, NULL, 'LLAVE JARDIN 1/2 SALI 3/4 CROMO-SATIN *6 GRIVAL ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1215, NULL, 'REPUESTO MANTENIMIENTO A NEVERAS ', '', NULL, 0, NULL, '', 0, 1),
(1216, NULL, 'SOPORTES TIPO CHANEL, PINTADOS, CON RANURAS PARA ALINEAR EL BLOWER. INCLUYE: AMORTIGUADORES Y CAUCHOS', '', NULL, 0, NULL, '', 0, 1),
(1217, NULL, 'SERVICIO DE REVISION Y MANTENIMIENTO A PLANTA ELECTRICA', '', NULL, 0, NULL, '', 0, 1),
(1218, NULL, 'LICENCIA DE WINDOWS ORIGINAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1219, NULL, 'EQUIPO ALADO 23G X 3/4 PEDIATRICO', 'Caja x 100 und', NULL, 0, NULL, '', 0, 1),
(1220, NULL, 'CORRECCION DE FUGA ', '', NULL, 0, NULL, '', 0, 1),
(1221, NULL, 'LAMINA PORTAOBJETOS ESMERILADA MATE CITOLOGIA', 'Caja x 50 unds', NULL, 0, NULL, '', 0, 1),
(1222, NULL, 'REAJUSTE DE GAS R 410', '', NULL, 0, NULL, '', 0, 1),
(1223, NULL, 'KILOS DE REFRIGERANTE R 410', '', NULL, 0, NULL, '', 0, 1),
(1224, NULL, 'AGUJA PEDIATRICA 22G X 1 BD VACUTAINER ', 'Caja x 100', NULL, 0, NULL, '', 0, 1),
(1225, NULL, 'JERINGA PRECISION 5 ML 3P LOCK AG 21*1/2', 'Caja x 100 uni', NULL, 0, NULL, '', 0, 1),
(1226, NULL, 'LLAVE LAVAMANOS NOGAL CROMADA + MANGUERA *3 GRIVAL ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1227, NULL, 'TALADRO ROTOMARTILLO PERFORADOR DEMOLEDOR 800W SK-2401 KACHE TOOLS 110/60HZ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1228, NULL, 'SILICONA PEGADIT TRANSPARENTE VIDRIOS Y ALUMINIO 280ML PEGATEX', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1229, NULL, 'OMEGA GALVANIZADA ROL C/REB 2 5/16*3/4 0.66 C-27 ESPESOR 0.38MM 2.44M 0.68KG', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1230, NULL, 'PRINCIPAL VIGUETA GALV ROL 1 1/2*3/4 C-27 ESPESOR 0.38MM *2.44 0.63 KG', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1231, NULL, 'ARENA EN BOLSA 28 KL', 'Bulto', NULL, 0, NULL, '', 0, 1),
(1232, NULL, 'SIKASET L 5KG SIKA T105001', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1233, NULL, 'LADRILLO CORRIENTE 18CML * 9CMA *5CMA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1234, NULL, 'tapa registro 15*15 blanca 580867-582011 INALGRIFOS UE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1235, NULL, 'MANTENIMIENTO A AA. TERMOSTATO DIGITAL HONEYWELL (DESMONTE E INSTALACION)', '', NULL, 0, NULL, '', 0, 1),
(1236, NULL, 'MANTENIMIENTO A AA (REFRIGERANTE R410 Y CORRECCION DE FUGA)', '', NULL, 0, NULL, '', 0, 1),
(1237, NULL, 'SILLA CINQUE MINI CONTACTO PERMANENTE AVANZADO SIN BRAZOS TAPIZADA 22000009840', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1238, NULL, 'MANTENIMIENTO DE AIRE CON DESMONTE DE PANAL. REPUESTOS Y MANO DE OBRA', '', NULL, 0, NULL, '', 0, 1),
(1239, NULL, 'VASO DESECHABLE 16 OZ PARA CARGA DE GLUCOSA', 'Paquete x 25 und', NULL, 0, NULL, '', 0, 1),
(1240, NULL, 'RECARGA EXTINTOR DE SOLKAFLAM 3.700 GRS', '', NULL, 0, NULL, '', 0, 1),
(1241, NULL, 'EXTINTOR DE SOLKAFLAM 3.700 GRS', '', NULL, 0, NULL, '', 0, 1),
(1242, NULL, 'CEMENTO GRIS 50 KL ARGOS', 'Bulto', NULL, 0, NULL, '', 0, 1),
(1243, NULL, 'SACO BLANCO POLIPROPILENO 60*90 CIA EMPAQUE', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1244, NULL, 'SIKA 01 MORTERO PLUS BLANCO POR 2KG T124260 UW ', '2kg', NULL, 0, NULL, '', 0, 1),
(1245, NULL, 'BROCHA PIRAMIDE 4\" INCEPAL 000007 UE12', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1246, NULL, 'SOLDADURA PVC VERDE 1/32 SUPRASOLD VERDE GERFOR 560119 UE 48', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1247, NULL, 'PEGANTE PEGARORTE PORCELANICO BLANCO 25KG', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1248, NULL, 'CEMENTO BLANCO 5 KL ARGOS UE*3', 'Bulto 5kl', NULL, 0, NULL, '', 0, 1),
(1249, NULL, 'SILICONA SIKA SIL IA BLANCA 300 ML ANTI HONGOS T271596 UE*12', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1250, NULL, 'DISCO DIAMANTADO SEGMENTADO 7*5/8 DEWALT DW47702L CAMBIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1251, NULL, 'TAPON PRUEBA 2 GERFOR GERFOR 300731', 'Caja x 100', NULL, 0, NULL, '', 0, 1),
(1252, NULL, 'TONER RM 55X', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1253, NULL, 'SUMINISTRO E INSTALACIÓN DE PUERTA DE VIDRIO DE 12MM INCOLORO. PERFORACION EN MANIJA Y BOQUETE PARA P4 SUP. 1192X2118 ', '', NULL, 0, NULL, '', 0, 1),
(1254, NULL, 'MANTENIMIENTO CORRECTIVO A PUERTA SEDE PRINCIPAL. AJUSTE, LIMPIEZA Y CAMBIO DE TORNILLOS.', '', NULL, 0, NULL, '', 0, 1),
(1255, NULL, 'RODILLO PROFESIONAL 4\" INCEPAL 04004 UW 100', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1256, NULL, 'CERRADURA DE EMBUTIR E20E NIQUELADA ENTRADA PPAL MANIJA FIJA MOVIL YALE SKU 0004071', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1257, NULL, 'PANEL LED REDONDO INCRUSTAR 6\" 12W 6K 100-240V 120º 720 LUMEN P24337-36 SYLVANIA UW*40', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1258, NULL, 'PENEL LED REDONDO INCRUSTAR 6´12W 6K 100-240V 120º 720 LUMEN P24337-36 SYLVANIA UE*40', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1259, NULL, 'MANTENIMIENTO VENTANA ALUMINIO, AJUSTE DE VIDRIO SALIDO DE HOYJA Y AJUSTE DE EMPAQUE', '', NULL, 0, NULL, '', 0, 1),
(1260, NULL, 'REVISION DE ACOMETIDA DE ENTRADA TABLERO GENERAL Y TOTALIZADOR DE PROTECCION POR MAL CONTACTO DE FLUIDO ELECTRICO, TORNILLOS FLOJOS, BALANCE', '', NULL, 0, NULL, '', 0, 1),
(1261, NULL, 'CAMBIO DE CABLEADOS CIRCUITOS NUEVOS TOMA CORRIENTE DE RECEPCION PARA INDEPENDIZAR CIRCUITOS DE NEVERAS Y CAMBIO DE BREAKER', '', NULL, 0, NULL, '', 0, 1),
(1262, NULL, 'MANTENIMIENTO AA. BLOWER GALVANIZADO, CAPACITOR DE 5 MF, CAMBIO DE FANRELAY', '', NULL, 0, NULL, '', 0, 1),
(1263, NULL, 'INSTALACION, TRASLADO Y MDO DE DOS AIRES CENTRALES EN SEDE CENTRO', '', NULL, 0, NULL, '', 0, 1),
(1264, NULL, 'MANTENIMIENTO AIRES INSTALADOS EN SEDE CENTRO. ', '', NULL, 0, NULL, '', 0, 1),
(1265, NULL, 'REVISTA BROCHURE ATELLICA', '', NULL, 0, NULL, '', 0, 1),
(1266, NULL, 'Mantenimiento correctivo y preventivo de cabina de flujo laminar', '', NULL, 0, NULL, '', 0, 1),
(1267, NULL, 'ALMOHADILLA DACTILAR PELIKAN', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1268, NULL, 'ALMOHADILLA PARA SELLO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1269, NULL, 'MTTO PREVENTIVO DE EQUIPO DE 1/2 GPM 2493 VENCE EN 2021-09. CAMBIO DE FILTRO ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1270, NULL, 'TONER RM 45A', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1271, NULL, 'Calibración acreditada ONAC micropipeta monocanal entre 1 ul a 5000 ul. EN LAB.', '', NULL, 0, NULL, '', 0, 1),
(1272, NULL, 'PANEL LED REDONDO 18W 8.6\" 6.5K 100-240V SOBREPONER P27180-36 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1273, NULL, 'IGE (INMUNOGLOBULINA E TOTAL) ATELLICA IM', 'Kit x 50 pbs', NULL, 0, NULL, '', 0, 2),
(1274, NULL, 'PIPETA AUTOMÁTICA 10-100 uL-BOECO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1275, NULL, 'RODILLO PROFESIONAL PLUS 9\" AMARILLO REUTILIZABLE PERFECT 04001', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1276, NULL, 'Mantenimiento preventivo micropipeta, equipo volumétrico laboratorio. En LAB Revisión de funcionamiento a Micropipetas nuevas, serie : ME 90', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1277, NULL, 'Mantenimiento preventivo micropipeta, equipo volumétrico laboratorio. En LAB Valor nominal: ( 100 a 1000) uL. Serial: ML 952144', '', NULL, 0, NULL, '', 0, 1),
(1278, NULL, 'Certificados impresos Lo invitamos a solicitar la próxima vez certificados digitales.', '', NULL, 0, NULL, '', 0, 1),
(1279, NULL, 'PANEL POSITIVO COMBO 34 X 20 PANELES ', '34x20 paneles', NULL, 0, NULL, '', 0, 1),
(1280, NULL, 'MICROSCAN NEG COMBO PANEL TYPE 66 X 20 PANELES', '66 x 20 paneles', NULL, 0, NULL, '', 0, 1),
(1281, NULL, 'PANEL NEG COMBO 72', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1282, NULL, 'HNIDO PANEL 20 PANELES', '20 paneles', NULL, 0, NULL, '', 0, 1),
(1283, NULL, 'RAPID YEAST PANEL 20 PANELES', '20 paneles', NULL, 0, NULL, '', 0, 1),
(1284, NULL, 'PROMPT CAJA X 60 UNIDADES ', '60 unidades', NULL, 0, NULL, '', 0, 1),
(1285, NULL, 'STERILE INOCULUM WATER/UNIDAD X TUBO 3.0 ML', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1286, NULL, 'INOCULUM WATER PLURONIC-D TUBO X 25ML UNIDAD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1287, NULL, 'INOCULATORS-D PAC X12 UNIDADES', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1288, NULL, 'HIND INOCULUM BROTH 60', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1289, NULL, 'VINILICO PINTURA BLANCO 2027155 CANECA 5 GALONES ICO ', 'Galones ico', NULL, 0, NULL, '', 0, 1),
(1290, NULL, 'PANEL LED REDONDO 24W 11.6\" 6.5K 100-240V SOBREPONER P27181-36', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1291, NULL, 'CONTROL DE CALIDAD EXTERNO RIQAS COAGULACION 5 PARAMETROS M1-6. REP 30. RANDOX UK KIT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1292, NULL, 'Atellica CH Alb (BCG) ALBUMINA', '4 x 1700 pbs', NULL, 0, NULL, '', 0, 1),
(1293, NULL, 'HIDRÓXIDO DE POTASIO 40% X 250 NOVALAB', 'Frasco 250 ml', NULL, 0, NULL, '', 0, 2),
(1294, NULL, 'CAJA DE ARCHIVO REF 500922 NO. 12 NORMA X-200 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1295, NULL, 'BATERIA CARGA SECA 12V 7.0AH', '', NULL, 0, NULL, '', 0, 1),
(1296, NULL, 'BATERIA FULLIBATTERY 12V 9AAH SECA SELLADA LIBRE DE MANTENIMIENTO', '', NULL, 0, NULL, '', 0, 1),
(1297, NULL, 'VINILO AUTOADHESIVO CON SELLO DE 71 AÑOS. REF. PUERTAS VIDRIO EN LA ENTRADA', '', NULL, 0, NULL, '', 0, 1),
(1298, NULL, 'CAMBIO DE ACETATO HP 3015', '', NULL, 0, NULL, '', 0, 1),
(1299, NULL, 'AVISOS VINILO HALE Y EMPUJE LAMINADO ', '', NULL, 0, NULL, '', 0, 1),
(1300, NULL, 'VINILO POLARIZADO ESMERILADO COLOR BLANCO TOMA MUESTRA ELITE NO. 5', '', NULL, 0, NULL, '', 0, 1),
(1301, NULL, 'VINILO ESMERILADO CON CORTE LOGO DE PASTEUR PARA FRANJA PUERTA DE ACCESO A SEDE ELITE', '', NULL, 0, NULL, '', 0, 1),
(1302, NULL, 'VINILO AUTOADHESIVO CON SELLO DE 71 AÑOS REF: VIDRIOS LATERALES SUPERIORES VENTANAS SALA ESPERA PRINCIPALES', '', NULL, 0, NULL, '', 0, 1),
(1303, NULL, 'VINILO AUTOADHESIVO IMPRESO EN POLICROMIA. REF: FORMATO DE CONSENTIMIENTO.', '', NULL, 0, NULL, '', 0, 1),
(1304, NULL, 'TALONARIO REFERENCIA (EXAMENES REMITIDOS)', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1305, NULL, 'PUBLICIDAD REVISTA - PAUTA DE MEDIA PAGINA ', '', NULL, 0, NULL, '', 0, 1),
(1306, NULL, 'CALCULADORA MAX 12 DIGITOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1307, NULL, 'DESMONTE ESMERILADO TOMA MUESTRA NO. 5 SEDE ELITE', '', NULL, 0, NULL, '', 0, 1),
(1308, NULL, 'VINILO AUTOADHESIVO TRANSPARENTE EN POLICROMIA AMAMOS LO QUE HACEMOS', '', NULL, 0, NULL, '', 0, 1),
(1309, NULL, 'CARPETA LEGAJADORA CELUGUIA CON GANCHO OFICIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1310, NULL, 'MANTENIMIENTO DE ASCENSOR SCHINDLER SEDE ELITE', '', NULL, 0, NULL, '', 0, 1),
(1311, NULL, 'MINERAL OIL (FOR WALKAWAY SI) 250ML ', 'Botella x 250ml', NULL, 0, NULL, '', 0, 1),
(1312, NULL, 'NAPHTHOL 30ML', 'Frasco 30 ml', NULL, 0, NULL, '', 0, 1),
(1313, NULL, 'MANTENIMIENTO BATERIA CARGA SECA 12V 7.0AH', '', NULL, 0, NULL, '', 0, 1),
(1314, NULL, 'INNOCULATION NEEDLESS ESTERIL (ASAS AZULES)', 'Paquete por 10 uds', NULL, 0, NULL, '', 0, 1),
(1315, NULL, 'MANTENIMIENTO CORRECTIVO EPSON L220', '', NULL, 0, NULL, '', 0, 1),
(1316, NULL, 'PACTH CORD DE RED', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1317, NULL, 'memoria 8gb ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1318, NULL, 'Pacth cord de red 1mt', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1319, NULL, 'MANTENIMIENTO AVISO SEDE PRINCIPAL Y ELITE', '', NULL, 0, NULL, '', 0, 1),
(1320, NULL, 'CINTA DE ENMASCARAR COLBON 24 X 40 EMP*72', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1321, NULL, 'FOLDER CELUGIA CARTA HORIZAONTAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1322, NULL, 'PROGESTERONE 17 A HYDROXY ELISA (progesterona 17)', 'Kit x 96 pruebas', NULL, 0, NULL, '', 0, 1),
(1323, NULL, 'DSX/DS2 RACKED SAMPLE TIPS (PUNTAS AZULES REF: 65910) MICROELISAS', '4x108 (caja x 432 puntas)', NULL, 0, NULL, '', 0, 1),
(1324, NULL, 'VINILO AUTOADHESIVO IMPRESO EN POLICROMIA. REF: MANEJO DE DATOS. MEDIDA: 14*17CM', '', NULL, 0, NULL, '', 0, 1),
(1325, NULL, 'MANTENIMIENTO PUERTA DE VIDRIO, AJUSTE DE TORNILLOS, AJUSTE DE ACCESORIOS Y CAMBIO DE TORNILLO A BASE', '', NULL, 0, NULL, '', 0, 1),
(1326, NULL, 'MANTENIMIENTO DE UN FOTOCONDUCTOR MS310', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1327, NULL, 'PLACAS PETRI 94x16MM VENTILADA', 'Caja x 480 unidades en 24 paquetes', NULL, 0, NULL, '', 0, 1),
(1328, NULL, 'BEBIDAS CAFE GRANO FUERTE 2 - CAFE SELLO ROJO ESPRESSO VENDING 500GR', 'Vaso', NULL, 0, NULL, '', 0, 1),
(1329, NULL, 'VOLANTES DOMICILIOS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1330, NULL, 'MANTENIMIENTO PREVENTIVO DE AIRE PAQ CON DESMONTE E INSTALACION DE MOTOR', '', NULL, 0, NULL, '', 0, 1),
(1331, NULL, 'CPU TORRE I3 NOVENA GENERACION', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1332, NULL, 'DSX/DS2 RACKED REAGENT TIPS (PUNTAS BLANCAS REF: 65920) MICROELISAS', '4x108 (caja x 432 puntas)', NULL, 0, NULL, '', 0, 1),
(1333, NULL, 'MONITOR DE 19,5 PULGADAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1334, NULL, 'TUBO FLUORESCENTE T8 32W 6500K SYLVANIA P01426-3 UE(25) ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1335, NULL, 'LIMPIAVIDRIOS MANGO PLASTICO DE 70 CM', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1336, NULL, 'LAMPARA CUELLO DE CISNE PARA CITOLOGIA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1337, NULL, 'TERMOMETRO DE PUNZON PARA TOMA DE TEMPERATURA A NEVERAS TERMICAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1338, NULL, 'MORTERO PLUS BLANCO', '', NULL, 0, NULL, '', 0, 1),
(1339, NULL, 'CARTUCHO NEGRO HP', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1340, NULL, 'CARTUCHO COLOR HP', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1341, NULL, 'MANTENIMIENTO PREVENTIVO IMPRESORA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1342, NULL, 'MANTENIMIENTO A PUERTA SEDE ELITE (AJUSTE, LIMPIEZA Y CAMBIO DE TORNILLERIA)', '', NULL, 0, NULL, '', 0, 1),
(1343, NULL, 'PROTECTOR DE CATALOGO EN ACETATO OFICIO POLIPROPILENO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1344, NULL, 'CARPETA PASTA CATALOGO 2.0 PULGADAS NORMA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1345, NULL, 'CARPETA PASTA CATALOGO 0.5 PULGADAS NORMA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1346, NULL, 'AHBS2 (Anticuerpos contra Ag de Superficie) ATELLICA IM', 'Kit x 200 pruebas', NULL, 0, NULL, '', 0, 1),
(1347, NULL, 'SILLA DE RUEDA STANDAR LLANTA MACIZA FT 500', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1348, NULL, 'BALANZA O BASCULA DIGITAL GMD ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1349, NULL, 'CAMBIO DE AISLAMIENTO', '', NULL, 0, NULL, '', 0, 1),
(1350, NULL, 'NEVERA MEDIANA TÉRMICA PARA TRANSPORTE DE MUESTRAS. 20 CM ALTO X 30 CM ANCHO Y 18 CM DE FUELLE. ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1351, NULL, 'NEVERA PEQUEÑA TÉRMICA PARA TRANSPORTE DE MUESTRAS. 20 CM ALTO X 19 CM ANCHO Y 17 CM DE FUELLE. ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1352, NULL, 'NEVERA GRANDE TÉRMICA PARA TRANSPORTE DE MUESTRAS. 25 CM ALTO X 30 CM ANCHO Y 24 CM DE FUELLE. ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1353, NULL, 'FILTRO DE POLVO CON MARCO', '', NULL, 0, NULL, '', 0, 1),
(1354, NULL, 'MANTENIMIENTO AIRE CENTRAL SEDE CARTAGENA ', '', NULL, 0, NULL, '', 0, 1),
(1355, NULL, 'CAMBIO DE VENTILADOR TANGENCIAL - ASCENSOR SEDE ELITE', '', NULL, 0, NULL, '', 0, 1),
(1356, NULL, 'PSEUDOMONA AERUGINOSA ATCC 27853 MICROBIOLOGICS', 'Kit x 2 unidades', NULL, 0, NULL, '', 0, 1),
(1357, NULL, 'KLEBSIELLA PNEUMONIAE ATCC BBA-1705 ', 'Kit por 2 unidades', NULL, 0, NULL, '', 0, 1),
(1358, NULL, 'STAPHYLOCOCCUS AUREUS ATCC 29213 MICROBIOLOGICS ', 'Kit por 2 unidades', NULL, 0, NULL, '', 0, 1),
(1359, NULL, 'PUESTO DE TRABAJO: REACONDICIONAMIENTO MUEBLE DE RECPCION EN L', '', NULL, 0, NULL, '', 0, 1),
(1360, NULL, 'REMODELACION MUEBLES Y TOMA DE MUESTRA SEDE CARTAGENA', '', NULL, 0, NULL, '', 0, 1),
(1361, NULL, 'CINTA GRUESA PARA EMPAQUE 48 MM * 40M', 'Unidad', NULL, 0, NULL, '', 0, 2),
(1362, NULL, 'REMODELACION MUEBLES Y TOMA DE MUESTRA SEDE SANTA MARTA', '', NULL, 0, NULL, '', 0, 1),
(1363, NULL, 'FABRICACIÓN DE BANDEJAS EN ACRÍLICO BLANCO CON MEDIDAS DE 51 CM ANCHO X 31 CM FONDO X 9 MM ALTO, 72 COMPARTIMIENTOS.', '', NULL, 0, NULL, '', 0, 1),
(1364, NULL, 'CERRADURA CILINDRICA ALCOBA MAD-DORADA DUBLIN YALE SKU 0006382', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1365, NULL, 'vinilo autoadhesivo impreso en policromia, sticker día de la mujer', '', NULL, 0, NULL, '', 0, 1),
(1366, NULL, 'STICKER DIA DE LA MUJER EN VINILO AUTOADHESIVO IMPRESO EN POLICROMIA ', '', NULL, 0, NULL, '', 0, 1),
(1367, NULL, 'ACRILICO CON VINILO EN AUTOADHESIVO INSTALADO EN TUBO DE TOMA DE MUESTRA NO. 6', '', NULL, 0, NULL, '', 0, 1),
(1368, NULL, 'AVISOS VINILO AUTOADHESIVO TRANSPARENTE. FEF: MISION, VISION PRINCIPAL. 133X 110CMS', '', NULL, 0, NULL, '', 0, 1),
(1369, NULL, 'AVISOS VINILO AUTOADHESIVO TRANSPARENTE. FEF: DERECHOS Y DEBERES. 70 X 2,20 CM ', '', NULL, 0, NULL, '', 0, 1),
(1370, NULL, 'AVISOS VINILO AUTOADHESIVO TRANSPARENTE. FEF: MISION Y VISION PRINCIPAL. POLITICA DEBERES ELITE. 1.50 X 1.70 CM', '', NULL, 0, NULL, '', 0, 1),
(1371, NULL, 'CONTROL GLUCOMETRO, TRUETETS SOLUTION LEVEL 1', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1372, NULL, 'CONTROL GLUCOMETRO, TRUETETS SOLUTION LEVEL 2', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1373, NULL, 'TERMOMETRO INFRARROJO PARA TOMA DE TEMPERATURA DE NEVERAS TERMICAS', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1374, NULL, 'EQUIPO COMPLETO: CPU TORRE I3 NOVENA GENERACION, LICENCIA ORIGINAL, MONITOR 19.5, TECLADO, MOUSE', 'Combo', NULL, 0, NULL, '', 0, 1),
(1375, NULL, 'BOMBILLO TOLEDO LED A60 12W DL 20H CAJA UE100 SYLVANIA P27632', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1376, NULL, 'BROCHA MONA MANGO PLASTICO 3 P. ACEPINT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1377, NULL, 'RODILLO PROFESIONAL AMARILLO/AZUL 9\" ACEPINT', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1378, NULL, 'SIKA ESTUKA ACRÍLICO 5/1 * 30 KG T218250 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1379, NULL, 'BEBIDA CAFE GRANULADO FUERTE - CAFE COLCAFE GRANULADO VENDING 500GR', '', NULL, 0, NULL, '', 0, 1),
(1380, NULL, 'ETIQUETA ADHESIVA TERMICO DIRECTO REMOVIBLES  TDR 60X30', 'Rollo x 3000', NULL, 0, NULL, '', 0, 1),
(1381, NULL, 'BEBIDA CAFE GRANULADO SUAVE - CAFE COLCAFE GRANULADO VENDING 500GR', '', NULL, 0, NULL, '', 0, 1),
(1382, NULL, 'CARETA PLASTICA DE SEGURIDAD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1383, NULL, 'Impresión en Vinilo autoadhesivo en policromia con recomendaciones entrada. Medidas:30 x 30 cms ', '', NULL, 0, NULL, '', 0, 1),
(1384, NULL, 'CARTUCHO COLOR HP 664', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1385, NULL, 'ALCOHOL AL 70% ', 'Pimpina', NULL, 0, NULL, '', 0, 1),
(1386, NULL, 'Reactivo hemolizado - Hemolysate Reagent', '250 ml', NULL, 0, NULL, '', 0, 1),
(1387, NULL, 'OVEROL TRAJE ANTIFLUIDO DE PROTECCION ANTIFLUIDO BLANCO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1388, NULL, 'MANTENIMIENTO AIRE CENTRAL CARRIER. MOTOR 3/4 PARA MANEJADORA, CAMBIO CONTACTOR, CAPACITOR', '', NULL, 0, NULL, '', 0, 1),
(1389, NULL, 'DISPENSADOR PARA GEL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1390, NULL, 'COMBO DESINFECCIÓN ', 'Paquete', NULL, 0, NULL, '', 0, 1),
(1391, NULL, 'ReparaciónacongeladorverticalGeneralElectric,fugaen tuberíadeevaporadorcausadaporeldesgastedeeltiempo,recargade refrigerante,instalacióndevá', '', NULL, 0, NULL, '', 0, 1),
(1392, NULL, 'MEDIO DE TRANSPORTE VIRAL. KIT x 16 TUBOS PLASTICOS (12,5 x 48 mm) * 1,5 mL', '16 tubos', NULL, 0, NULL, '', 0, 1),
(1393, NULL, 'HISOPO PUNTA RAYON CON PUNTO QUIEBRE', 'Kit x 100 piezas', NULL, 0, NULL, '', 0, 1),
(1394, NULL, 'PRUEBA RAPIDA STANDARD Q COVID-19 IgG/IgM Duo', 'Caja x 20 pruebas', NULL, 0, NULL, '', 0, 1),
(1395, NULL, 'IMPLEMENTACIÓN DE FACTURACIÓN ELECTRÓNICA', '', NULL, 0, NULL, '', 0, 1),
(1396, NULL, 'ZAPATOS TIPO CROCS', 'Par', NULL, 0, NULL, '', 0, 1),
(1397, NULL, 'CAMBIO DE CAPACITOR DEL VENTILADOR- 7.5MFD', '', NULL, 0, NULL, '', 0, 1),
(1398, NULL, 'INVERSOR DE ONDA PURA DE 600W A 12VDC MARCA PS .', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1399, NULL, 'Impresión en Vinilo autoadhesivo en policromia laminado con vinilo transparente para protección. Ref. Pies. 40 x 35 cms ', '', NULL, 0, NULL, '', 0, 1),
(1400, NULL, 'Impresión en Vinilo autoadhesivo en policromia laminado con vinilo transparente para protección. Ref. Sillas. 30 x 33 cms ', '', NULL, 0, NULL, '', 0, 1),
(1401, NULL, 'Instalación de un circuito eléctrico a una Centrifuga para conectar una planta inversora a un vehículo incluyendo cableado y accesorios.', '', NULL, 0, NULL, '', 0, 1),
(1402, NULL, 'CARETA FACIAL DE BIOSEGURIDAD', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1403, NULL, 'DISPENSADOR PARA GEL COLOR BLANCO CON SU AVISO INFORMATIVO', 'Unidad ', NULL, 0, NULL, '', 0, 1),
(1404, NULL, 'CAMBIO DE TACOS AIRE ACONDICIONADO', '', NULL, 0, NULL, '', 0, 1),
(1405, NULL, 'MANTENIMIENTO A AIRE ACONDICIONADO', '', NULL, 0, NULL, '', 0, 1),
(1406, NULL, 'GEL ANTIBACTERIAL', 'Galon', NULL, 0, NULL, '', 0, 1),
(1407, NULL, 'Servidor Marca: DELL Modelo: T30 Procesador: Intel Xeon E3-1225 3.3GHz Quad Core 8M Memoria: 8 GB Soporta hasta: 64 GB Disco Duro: 1 TB 7,2 ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1408, NULL, 'CAMBIO DE FUENTE DE ALIMENTACIÓN', '', NULL, 0, NULL, '', 0, 1),
(1409, NULL, 'UPS Marca: POWEST Capacidad: 1 KVA Tipo: Interactiva', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1410, NULL, 'MANTENIMIENTO CORRECTIVO IMPRESORA HP 400', '', NULL, 0, NULL, '', 0, 1),
(1411, NULL, 'CAMBIO DE ACETATO A IMPRESORA HP 400', '', NULL, 0, NULL, '', 0, 1),
(1412, NULL, 'PLANILLERO ACRILICO OFICIO', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1413, NULL, 'MTTO A NEVERA CONGELADOR', '', NULL, 0, NULL, '', 0, 1),
(1414, NULL, 'PRUEBA RAPIDA COVID-19 AD-BIO. SARS-CoV-2 Anticuerpos IgG/gM Kit x 30 Test. ', 'Caja x 3o test', NULL, 0, NULL, '', 0, 1),
(1415, NULL, 'UPS 700 VA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1416, NULL, 'Impresión en Vinilo autoadhesivo en policromia Ref. Bioseguridad atención. 45 x 35 cms  ', '', NULL, 0, NULL, '', 0, 1),
(1417, NULL, 'Impresión en Vinilo autoadhesivo en policromia Ref. Lavado de manos, TAMAÑO CARTA', '', NULL, 0, NULL, '', 0, 1),
(1418, NULL, 'Impresión en Vinilo autoadhesivo en policromia laminado Ref. Círculos pisos.', '', NULL, 0, NULL, '', 0, 1),
(1419, NULL, 'Impresión en Vinilo autoadhesivo en policromia Ref. Ascensores, 30 x 35 cms ', '', NULL, 0, NULL, '', 0, 1),
(1420, NULL, 'Impresión en Vinilo autoadhesivo en policromia pegado sobre lamina imantada vehicular, 45 x 35 cms ', '', NULL, 0, NULL, '', 0, 1),
(1421, NULL, 'Impresión en Vinilo autoadhesivo en policromia pegado sobre lamina imantada vehicular, 45 x 35 cms ', '', NULL, 0, NULL, '', 0, 1),
(1422, NULL, 'COMPUTADOR PC COMPLETO DE ESCRITORIO I3', 'Combo teclado, monitor, ups, mouse', NULL, 0, NULL, '', 0, 1),
(1423, NULL, 'PANTALLA EN ACRILICO DE 1 MT X 60 CM, ABERTURA PARA PASAR DOCUMENTOS DE 30X20 CM. ', '', NULL, 0, NULL, '', 0, 1),
(1424, NULL, 'Impresión en Vinilo autoadhesivo en policromia Ref. Cafeteria. Medidas: 60 x 60 cms', '', NULL, 0, NULL, '', 0, 1),
(1425, NULL, 'POLAINAS DESECHABLE ', 'Paquete x 50 pares hmb', NULL, 0, NULL, '', 0, 1),
(1426, NULL, 'AMONIO CUATERNARIO ', 'Galon', NULL, 0, NULL, '', 0, 1),
(1427, NULL, 'ALCOHOL ANTISEPTICO AL 70%', 'Galon', NULL, 0, NULL, '', 0, 1),
(1428, NULL, 'TAPETE DE DESINFECCION', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1429, NULL, 'Telefono IP Marca: Grandstream Modelo: GXP-1625 Cuentas SIP: 2 Lineas: 2', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1430, NULL, 'BATA MANGA LARGA PARA TOMA DE MUESTRAS DESECHABLE AZUL ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1431, NULL, 'TAPETE PARA SECADO DE PIES ', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1432, NULL, 'DIADEMA CON MICROFONO USB SENCILLA', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1433, NULL, 'REPUESTOS PARA NEVERA CONGELADOR GENERAL ELECTRIC', '', NULL, 0, NULL, '', 0, 1),
(1434, NULL, 'CD TDK EN BLANCO', '20 und', NULL, 0, NULL, '', 0, 1),
(1435, NULL, 'MANTENIMIENTO PREVENTIVO A EQUIPOS DE LABORATORIO sede cartagena', '', NULL, 0, NULL, '', 0, 1),
(1436, NULL, 'Telefono IP Marca: Grandstream Modelo: GXP-1628 Cuentas SIP: 2 Lineas: 2 Botonera: 8 Teclas.', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1437, NULL, 'Telefono IP Marca: Grandstream Modelo: GXP-1625 Cuentas SIP: 2 Lineas: 2', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1438, NULL, 'SERVICIO TECNICO DE TELEFONIA IP', '', NULL, 0, NULL, '', 0, 1),
(1439, NULL, 'MANTENIMIENTO, LAVADO Y DESINFECCION DE TANQUES DE AGUA POTABLE DEL LABORATORIO, SEDE PRINCIPAL', '', NULL, 0, NULL, '', 0, 1),
(1440, NULL, 'SERVICIO MANTENIMIENTO A IMPRESORA KYOCERA', '', NULL, 0, NULL, '', 0, 1),
(1441, NULL, 'ARMARIO METALICO DE 180x100x45 C4 ENTREPAÑOS GRADUABLES', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1442, NULL, 'CANECA PAPELERA COLPLAST ROJA X 25 LTS DE PEDAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1443, NULL, 'CANECA PAPELERA COLPLAST VERDE X 25 LTS PEDAL', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1444, NULL, 'MTTO DESMONTE DE PANAL, PEINADO Y REPUESTOS', '', NULL, 0, NULL, '', 0, 1),
(1445, NULL, 'PR 01-03-0097 REACTIVO DILUYENTE PARA HBA1C: PREMIER HB9210 TRINITY BIOTECH (USA) ', '1x3.8 l', NULL, 0, NULL, '', 0, 1),
(1446, NULL, 'INSTALACION MINISPLIT SEDE LIGA CONTRA EL CANCER', '', NULL, 0, NULL, '', 0, 1),
(1447, NULL, 'toner hp ce 285a trifasico', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1448, NULL, 'GATEWAY GRANDSTREAM 24 PUERTOS FXS GXW4224', '', NULL, 0, NULL, '', 0, 1),
(1449, NULL, 'PATCHCORDRJ45 ARJ11', '', NULL, 0, NULL, '', 0, 1),
(1450, NULL, 'PATCHCORDRJ45 ARJ11', '', NULL, 0, NULL, '', 0, 1),
(1451, NULL, 'ROUTER BOARD MIKROTIK RB750 4 PUERTOS', '', NULL, 0, NULL, '', 0, 1),
(1452, NULL, 'GATEWAY VOIP ANALÓGICO (Lina 3565771) Marca: Grandstream Modelo: HT503 No. Puertos: 1 FXO 1 FXS Interfaz: 1 LAN 10/100 Mbps y 1 WAN 10/100 M', 'Unidad', NULL, 0, NULL, '', 0, 1),
(1453, NULL, 'PRUEBA ANTIGENO COVID19 STANDARD Q25 ', '25 test', NULL, 0, NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL COMMENT '1 NACIONAL\n2 INTERNACIONAL',
  `estado` tinyint(4) DEFAULT NULL,
  `procedencia` tinyint(4) DEFAULT NULL,
  `id_tipo_contribuyente` int(11) DEFAULT NULL,
  `id_tipo_identificacion` int(11) DEFAULT NULL,
  `numero_identificacion` varchar(45) DEFAULT NULL,
  `dv` int(4) DEFAULT NULL COMMENT 'digito de verificacion',
  `razon_social` varchar(245) DEFAULT NULL,
  `nombre_comercial` varchar(245) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_representante_legal` int(11) DEFAULT NULL,
  `proveedor_credito` tinyint(4) DEFAULT NULL COMMENT '0 No\n1 Si',
  `plazo_dias` int(11) DEFAULT NULL,
  `monto_minimo` int(11) DEFAULT NULL,
  `monto_maximo` int(11) DEFAULT NULL,
  `id_clasificacion_tributaria` int(11) DEFAULT NULL,
  `numero_resolucion` varchar(45) DEFAULT NULL,
  `fecha_resolucion` date DEFAULT NULL,
  `codigo_act_eco_1` varchar(45) DEFAULT NULL COMMENT 'Codigo de la actividad economica principal',
  `codigo_act_ind_comer` varchar(45) DEFAULT NULL COMMENT 'Código de las actividad en industria y comercio',
  `id_tarifa_por_mil` int(11) DEFAULT NULL,
  `id_tarifa_retencion` int(11) DEFAULT NULL,
  `observaciones` varchar(245) DEFAULT NULL,
  `nombre_entidad_bancaria` varchar(245) DEFAULT NULL,
  `id_tipo_cuenta` int(11) DEFAULT NULL,
  `numero_cuenta` varchar(45) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `id_usuario_update` int(11) DEFAULT NULL,
  `id_tipo_autorretenedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `estado`, `procedencia`, `id_tipo_contribuyente`, `id_tipo_identificacion`, `numero_identificacion`, `dv`, `razon_social`, `nombre_comercial`, `id_ubicacion`, `email`, `id_representante_legal`, `proveedor_credito`, `plazo_dias`, `monto_minimo`, `monto_maximo`, `id_clasificacion_tributaria`, `numero_resolucion`, `fecha_resolucion`, `codigo_act_eco_1`, `codigo_act_ind_comer`, `id_tarifa_por_mil`, `id_tarifa_retencion`, `observaciones`, `nombre_entidad_bancaria`, `id_tipo_cuenta`, `numero_cuenta`, `fecha_creacion`, `id_usuario_creacion`, `fecha_update`, `id_usuario_update`, `id_tipo_autorretenedor`) VALUES
(2, 1, NULL, 1, 8, '802005820', 5, 'Ditar S. A.', 'Ditar S. A.', NULL, 'gerencia@ditarsa.net', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de rollos de recibo térmico, hojas de resultado y hojas membreteadas', '', NULL, '', '2016-05-02 16:04:00', NULL, NULL, NULL, NULL),
(3, 1, NULL, 1, 8, '830025281', 2, 'Annar Diagnóstica Import S. A. S.', 'Annar Diagnóstica Import S. A. S.', NULL, 'serviciocliente@annardx.com', NULL, 1, 60, 0, 0, 2, '14097', '2010-12-30', '4669', '4659', NULL, NULL, 'Www.annardx.com', '', NULL, '', '2016-04-27 16:28:00', NULL, NULL, NULL, NULL),
(4, 1, NULL, 1, 8, '900475439', 2, 'Distribuidora Aseotec S. A.', 'Distribuidora Aseotec S. A.', NULL, 'aseotec4@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Suministro de aseo, cafeteria, botiquin y mantenimiento de pisos', '', NULL, '', '2016-04-29 10:06:00', NULL, NULL, NULL, NULL),
(5, 1, NULL, 1, 8, '802019954', 0, 'Novaromas sas', 'Novaromas sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:29:54', NULL, NULL, NULL, NULL),
(6, 1, NULL, 1, 1, '8781029', 0, 'Olmos torres gustavo adolfo', 'Almacen surtitoner', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:39:57', NULL, NULL, NULL, NULL),
(7, 1, NULL, 1, 8, '8901113397', 0, 'Novaventa', 'Novaventa', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-04-03 16:46:07', NULL, NULL, NULL, NULL),
(8, 1, NULL, 1, 8, '19454262', 0, 'Henry Bossa Molina', 'Centrolux', NULL, 'henrybossa@centrolux.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Www.centrolux.com', '', NULL, '', '2016-04-29 14:30:00', NULL, NULL, NULL, NULL),
(9, 1, NULL, 1, 8, '900030599', 2, 'Arquitronica Ltda.', 'Arquitronica Ltda.', NULL, 'contactenos@arquitronica.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de apósitos secuenciales redondos y pediátricos x 500 unds', 'Bancolombia', NULL, '084-423822-64', '2016-04-29 10:17:00', NULL, NULL, NULL, NULL),
(10, 1, NULL, 1, 8, '860002134', 8, 'Abbott Laboratories De Colombia S. A.', 'Abbott Laboratories De Colombia S. A.', NULL, 'carolina.duarte@abbott', NULL, 1, 60, 0, 0, 1, '106', '1900-12-31', '4645', '4690', NULL, NULL, 'Proveedor de reactivos de infecciosas y hematología', '', NULL, '', '2016-04-27 13:07:00', NULL, NULL, NULL, NULL),
(11, 1, NULL, 1, 8, '900532434', 0, 'Aox Ingenieros S.a.s.', 'Aox Ingenieros S.a.s', NULL, 'info@aoxingenieros.com', NULL, 1, 0, 0, 0, 2, '', '1900-12-31', '7110', '7020', NULL, NULL, 'Www.aoxingenieros.com', 'Bancolombia', NULL, '605-851648-55', '2016-04-26 18:01:00', NULL, NULL, NULL, NULL),
(12, 1, NULL, 1, 8, '860020309', 6, 'Becton Dickinson De Colombia Ltda.', 'Becton Dickinson De Colombia Ltda.', NULL, 'maribel_casas@bd.com', NULL, 1, 60, 0, 0, 1, '14525', '2010-07-12', '4664', '4659', NULL, NULL, '', '', NULL, '', '2016-04-29 12:04:00', NULL, NULL, NULL, NULL),
(13, 1, NULL, 1, 8, '830023844', 1, 'Biomerieux Colombia S. A. S.', 'Biomerieux Colombia S. A. S.', NULL, 'camilo.buritica@biomerieux.com', NULL, 1, 30, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor microbiología', '', NULL, '', '2016-04-29 13:21:00', NULL, NULL, NULL, NULL),
(14, 1, NULL, 1, 8, '830087855', 5, 'Biolore Ltda.', 'Biolore Ltda.', NULL, 'biolore@hotmail.com', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-04-29 13:27:00', NULL, NULL, NULL, NULL),
(15, 1, NULL, 1, 8, '900324870', 7, 'Arcoink & Tr Comercial Ltda. ', 'Arcoink & Tr Comercial Ltda. ', NULL, '', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '4741', '4649', NULL, NULL, '', '', NULL, '', '2016-04-29 09:55:00', NULL, NULL, NULL, NULL),
(16, 1, NULL, 1, 8, '805001194', 5, 'Biosystems S. A.', 'Biosystems S. A.', NULL, 'biosystems@uniweb.net.co', NULL, 1, 60, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor quimica', '', NULL, '', '2016-04-29 13:31:00', NULL, NULL, NULL, NULL),
(17, 1, NULL, 1, 8, '800150822', 2, 'Apolo Ltda.', 'Apolo Ltda.', NULL, 'jcastro@apoloimpresores.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '1811', '', NULL, NULL, 'Etiquetas térmico directa removible premium 6x3. \r\nse acordó 3 entregas de 180.000 etiquetas por 3 meses consecutivos', 'Banco de bogota', NULL, '151062940', '2016-04-29 09:24:00', NULL, NULL, NULL, NULL),
(18, 1, NULL, 1, 8, '830010484', 5, 'Distriquimicos Aldir S. A. S.', 'Distriquimicos Aldir S. A. S.', NULL, 'alvarodiaz@distriquimicosaldir.com', NULL, 1, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Distribuidor de las marcas: rodelg, brand, human, albor', '', NULL, '', '2016-05-02 15:12:00', NULL, NULL, NULL, NULL),
(19, 1, NULL, 1, 8, '830072417', 7, 'Distribuidora Y Comercializadora Dizar Ltda.', 'Distribuidora Y Comercializadora Dizar Ltda.', NULL, 'info@dizar.net', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Controles externos para ana\'s', 'Bancolombia', NULL, '035-506195-07', '2016-05-02 16:23:00', NULL, NULL, NULL, NULL),
(20, 1, NULL, 1, 8, '800031439', 4, 'Dexco Ltda. ', 'Dexco Ltda. ', NULL, 'dexco@metrotel.net.co', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de rollos para camilla', '', NULL, '', '2016-05-02 16:36:00', NULL, NULL, NULL, NULL),
(21, 1, NULL, 1, 8, '802012179', 0, 'Dolmen S. A.  E. S. P.', 'Dolmen S. A.  E. S. P.', NULL, 'notificacionesjudiciales@dolmen.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de publicidad ', 'Banco de occidente', NULL, '825-04384-7', '2016-05-02 16:41:00', NULL, NULL, NULL, NULL),
(22, 1, NULL, 1, 8, '800031682', 8, 'Dotaciones Quimico Clínicas S. A. S.', 'Dotaciones Quimico Clínicas S. A. S.', NULL, 'comercial@dotacioness.com', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Quimicos', '', NULL, '', '2016-05-02 16:48:00', NULL, NULL, NULL, NULL),
(23, 1, NULL, 1, 11, '111111119', 0, 'Resolution biomedical inc', 'Resolution biomedical inc', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:37:29', NULL, NULL, NULL, NULL),
(24, 1, NULL, 1, 8, '860028580', 2, 'Dispapeles - distribuidora de papeles s. a.', 'Dispapeles S. A. ', NULL, 'guillermo.arciniegas@dispapeles.com', NULL, 1, 30, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-02 15:29:00', NULL, NULL, NULL, NULL),
(25, 1, NULL, 1, 8, '72248124', 0, 'Alex daniel rueda molina - gamers club', 'Alex daniel rueda molina - gamers club', NULL, 'AXEDR@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '2017-11-20', '4759', '4741', NULL, NULL, '', '', NULL, '', '2017-11-20 08:50:00', NULL, NULL, NULL, NULL),
(26, 1, NULL, 1, 8, '802008470', 4, 'Rdf  S. A.', 'Rdf  S. A.', NULL, 'agmaca@metrotel.net.co', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-24 13:29:00', NULL, NULL, NULL, NULL),
(27, 1, NULL, 1, 8, '892300678', 7, 'Eticos Serrano Gomez Ltda.', 'Eticos Ltda.', NULL, 'egomez@eticos.com', NULL, 1, 60, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de agua destilada y cloruro de sodio', '', NULL, '', '2016-05-02 17:05:00', NULL, NULL, NULL, NULL),
(28, 1, NULL, 1, 8, '890912308', 0, 'Laboratorios ltda. medellín', 'Laboratorios ltda. medellín', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-07 16:11:00', NULL, NULL, NULL, NULL),
(29, 1, NULL, 1, 8, '900053670', 7, 'Rpg Del Caribe Ltda.', 'Rpg Del Caribe Ltda.', NULL, 'gerencia@rpg.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', 'Banco de occidente', NULL, '815-04948-1', '2016-05-24 13:34:00', NULL, NULL, NULL, NULL),
(30, 1, NULL, 1, 8, '890800788', 7, 'Sumatec S. A.', 'Sumatec S. A.', NULL, 'sumatec@sumatec.com.co', NULL, 0, 0, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, '', 'Banco de bogotá', NULL, '428-09428-8', '2016-05-24 13:39:00', NULL, NULL, NULL, NULL),
(31, 1, NULL, 1, 8, '43269662', 8, 'Paola Andrea Vanegas Valladales', 'Toner Service Bq', NULL, 'toneryserviciosmultisistem@gmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', 'Citibank', NULL, '1006724627', '2016-05-24 13:47:00', NULL, NULL, NULL, NULL),
(32, 1, NULL, 1, 8, '900599598', 8, 'Todouniformes Gloriabe S. A. S.', 'Todouniformes Gloriabe S. A. S.', NULL, 'todouniformesgloriabe@gmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Uniformes para recepción y mensajeros', 'Banco de bogotá', NULL, '292527439', '2016-05-24 13:53:00', NULL, NULL, NULL, NULL),
(33, 1, NULL, 1, 8, '830117139', 1, 'Nipro Medical Corporation', 'Nipro Medical Corporation', NULL, 'lalonso@nipro.com.co', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Venta de insumos para toma de muestras', '', NULL, '', '2016-05-23 15:10:00', NULL, NULL, NULL, NULL),
(34, 1, NULL, 1, 8, '830056202', 3, 'Labcare De Colombia Ltda.', 'Labcare De Colombia Ltda.', NULL, '', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', 'Banco de bogotá', NULL, '035056688', '2016-05-26 17:50:00', NULL, NULL, NULL, NULL),
(35, 1, NULL, 1, 8, '830026545', 6, 'Felgon Ltda.', 'Felgon Ltda.', NULL, 'felgon@etb.net.co', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de elisas', '', NULL, '', '2016-05-02 17:31:00', NULL, NULL, NULL, NULL),
(36, 1, NULL, 1, 8, '802013210', 6, 'E-refrigeracion Cia. Ltda.', 'E-refrigeracion Cia. Ltda.', NULL, 'erefrigeracion@gmail.com', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de aires acondicionados', 'Bancolombia', NULL, '080-2666498-7', '2016-05-02 17:20:00', NULL, NULL, NULL, NULL),
(37, 1, NULL, 1, 8, '900235237', 2, 'Hardware Y Servicios Ltda.', 'Hardware Y Servicios Ltda.', NULL, 'gerencia@hysltda.net', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de tecnología', 'Bancolombia', NULL, '10796972918', '2016-05-02 17:43:00', NULL, NULL, NULL, NULL),
(38, 1, NULL, 1, 8, '900462246', 1, 'I. P Center S. A. S.', 'I. P Center S. A. S.', NULL, 'info@ipcenter.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de ups corporativas\r\nwww.ipcenter.com.co', 'Bancolombia', NULL, '10773886348', '2016-05-04 17:00:00', NULL, NULL, NULL, NULL),
(39, 1, NULL, 1, 8, '900128625', 9, 'Insumos Quirúrgicos Y Médicos S. A. S.', 'Iqm S. A. S.', NULL, 'iqm.ltda@yahoo.com', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', 'Bancolombia', NULL, '767-316622-20', '2016-05-04 17:27:00', NULL, NULL, NULL, NULL),
(40, 1, NULL, 1, 8, '890101815', 9, 'Johnson & Johnson De Colombia S. A.', 'Johnson & Johnson De Colombia S. A.', NULL, 'Idelgad4@conco.jnj.com', NULL, 1, 60, 90000000, 0, 1, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-19 14:39:00', NULL, NULL, NULL, NULL),
(41, 1, NULL, 1, 8, '800019856', 3, 'La Casa Del Médico S. A. S.', 'La Casa Del Médico S. A. S.', NULL, 'ubaquiroz@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-25 11:56:00', NULL, NULL, NULL, NULL),
(42, 1, NULL, 1, 8, '900171542', 8, 'Meca Del Caribe Ltda.', 'Meca Del Caribe Ltda.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Equipos de presión, bombas especiales para agua y químicos, motores, plantas eléctricas de gasolina y diesel.', 'Banco de occidente', NULL, '800-57510-2', '2016-05-25 08:47:00', NULL, NULL, NULL, NULL),
(43, 1, NULL, 1, 8, '900886644', 1, 'Lumira S. A.', 'Lumira S. A.', NULL, 'marybejarano50@yahoo.com', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Representante de la marca biosystems s.a.\r\ndescuento comercial otorgado: 40% en reactivos\r\ndescuento financiero: 0%', 'Corpbanca helm bank', NULL, '301-42849-6', '2016-05-13 11:57:00', NULL, NULL, NULL, NULL),
(44, 1, NULL, 1, 8, '8693305', 0, 'Mora tirado jaime roberto - servielectricas', 'Mora tirado jaime roberto - servielectricas', NULL, 'SERVIELECTRICASJAIMEMORA@HOTMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '08082899298', '2017-11-22 14:56:00', NULL, NULL, NULL, NULL),
(45, 1, NULL, 1, 8, '860065280', 5, 'Quimirel - químicos y reactivos s. a. s.', 'Quimirel', NULL, 'quimicos@quimirel.com.co', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Representante oxoid, honeywell, pall, dupont', '', NULL, '', '2016-05-26 08:46:00', NULL, NULL, NULL, NULL),
(46, 1, NULL, 1, 8, '860517647', 0, 'Universidad manuela beltran u m b', 'Universidad manuela beltran u m b', NULL, 'jcbeltran@umb.edu.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8544', '', NULL, NULL, '', '', NULL, '', '2016-09-14 16:06:50', NULL, NULL, NULL, NULL),
(47, 1, NULL, 1, 8, '900292014', 0, 'Te oigo, centro audiologico s.a.s.', 'Te oigo, centro audiologico s.a.s.', NULL, 'teoigo.josefita.marceles@gmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-14 16:39:59', NULL, NULL, NULL, NULL),
(48, 1, NULL, 1, 8, '802020489', 0, 'Sus vacunas s.a.s.', 'Sus vacunas s.a.s.', NULL, 'monigose@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '4645', '4773', NULL, NULL, '', '', NULL, '', '2016-09-14 17:55:03', NULL, NULL, NULL, NULL),
(49, 1, NULL, 1, 8, '9000443191', 0, 'Sistemas integrados en medicina laboral s.a.s', 'Sistemas integrados en medicina laboral s.a.s', NULL, 'administracion@gesmed.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8621', '', NULL, NULL, '', '', NULL, '', '2016-09-14 17:59:37', NULL, NULL, NULL, NULL),
(50, 1, NULL, 1, 8, '860529151', 0, 'Servicios medicos yunis turbay y cia s en c c', 'Servicios medicos yunis turbay y cia s en c c', NULL, 'contasmy@etb.net.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8699', '', NULL, NULL, '', '', NULL, '', '2016-09-14 18:04:04', NULL, NULL, NULL, NULL),
(51, 1, NULL, 1, 8, '900190807', 0, 'Prevencion y diagnostico en ginecologia obste', 'Prevencion y diagnostico en ginecologia obste', NULL, 'contabilidad@previgin.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8691', '', NULL, NULL, '', '', NULL, '', '2016-09-14 18:27:38', NULL, NULL, NULL, NULL),
(52, 1, NULL, 1, 8, '900458620', 0, 'Promocion y prevencion en salud ocupacional y', 'Promocion y prevencion en salud ocupacional y', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8413', '', NULL, NULL, '', '', NULL, '', '2016-09-14 18:36:23', NULL, NULL, NULL, NULL),
(53, 1, NULL, 1, 8, '802003408', 0, 'Laboratorio clinico clinica general del norte s.a.s.', 'Laboratorio clinico clinica general del norte s.a.s.', NULL, 'facturlabcgn@telecom.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-15 11:19:56', NULL, NULL, NULL, NULL),
(54, 1, NULL, 1, 8, '819005186', 0, 'Ips living e.u.', 'Ips living e.u.', NULL, 'livingcolombiaips@gmail.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8512', '8513', NULL, NULL, '', '', NULL, '', '2016-09-15 11:45:22', NULL, NULL, NULL, NULL),
(55, 1, NULL, 1, 8, '900414056', 0, 'Gp medidcina laboral s.a.s.', 'Gp medicina laboral s.a.s.', NULL, 'frondon@grupoperfiles.com.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8699', '', NULL, NULL, '', '', NULL, '', '2016-09-15 16:26:29', NULL, NULL, NULL, NULL),
(56, 1, NULL, 1, 8, '890112801', 0, 'Fundacion hospital universidad del norte', 'Fundacion hospital universidad del norte', NULL, 'clchavez@uninorte.edu.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8610', '8699', NULL, NULL, '', '', NULL, '', '2016-09-15 16:31:33', NULL, NULL, NULL, NULL),
(57, 1, NULL, 1, 8, '806011261', 0, 'Estrios s.a.s.', 'Estrios s.a.s.', NULL, 'a.lemus@estriosltda.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8610', '8621', NULL, NULL, '', '', NULL, '', '2016-09-15 16:42:27', NULL, NULL, NULL, NULL),
(58, 1, NULL, 1, 8, '12541348', 0, 'Armenta romano carlos alberto', 'Armenta romano carlos alberto', NULL, 'EGEDICAR56@YAHOO.COM', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '3312', '', NULL, NULL, '', '', NULL, '', '2016-09-15 17:56:27', NULL, NULL, NULL, NULL),
(59, 1, NULL, 1, 8, '900082301', 0, 'Auditoria y asesoria en garantia de la calidad ltda - acg ltda', 'Auditoria y asesoria en garantia de la calidad ltda - acg ltda', NULL, 'FREDDYPAEZ@ACGCALIDAD.COM', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '7020', '4799', NULL, NULL, '', '', NULL, '', '2016-09-15 18:01:04', NULL, NULL, NULL, NULL),
(60, 1, NULL, 1, 8, '900209705', 8, 'Ms Farma E.u.', 'Ms Farma E.u.', NULL, 'ventas@msfarma.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Venta de estímulos de acth, gnrh y trh', '', NULL, '', '2016-05-27 18:21:00', NULL, NULL, NULL, NULL),
(61, 1, NULL, 1, 8, '802005296', 0, 'Vital medicos ltda', 'Vital medicos ltda', NULL, 'VITALMEDICOS@YAHOO.COM.CO', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8621', '', NULL, NULL, '', '', NULL, '', '2016-09-14 15:47:00', NULL, NULL, NULL, NULL),
(62, 1, NULL, 1, 8, '802014564', 0, 'Centro medico clinica de alergia e inmnologia s.a.s.', 'Centro medico clinica de alergia e inmnologia s.a.s', NULL, 'CLINIALERGIA.ADMON@GMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8621', '', NULL, NULL, '', '', NULL, '', '2016-09-15 17:44:00', NULL, NULL, NULL, NULL),
(63, 1, NULL, 1, 8, '900818817', 0, 'Instituto de generacion de tejidos s.a.s.', 'Instituto de generacion de tejidos s.a.s.', NULL, 'rpiemagorda@procapsgroup.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '2100', '4645', NULL, NULL, '', '', NULL, '', '2016-09-15 11:49:00', NULL, NULL, NULL, NULL),
(64, 1, NULL, 1, 8, '800222660', 0, 'Instituto de referencia andino s.a.s.', 'Instituto de referencia andino s.a.s.', NULL, 'hparada@rochembiocare.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8699', '1999', NULL, NULL, '', '', NULL, '', '2016-09-15 14:48:00', NULL, NULL, NULL, NULL),
(65, 1, NULL, 1, 8, '802006337', 0, 'Tamara imagenes diagnosticas s.a.s.', 'Tamara imagenes diagnosticas s.a.s.', NULL, 'tamaraimagenes@epmnet.co', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-14 16:31:00', NULL, NULL, NULL, NULL),
(66, 1, NULL, 1, 8, '830048477', 0, 'Centro de analisis molecular s.a.', 'Centro de analisis molecular s.a.', NULL, 'CAMADMINISTRA@ETB.NET.CO', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8691', '8699', NULL, NULL, '', '', NULL, '', '2016-09-15 17:49:00', NULL, NULL, NULL, NULL),
(67, 1, NULL, 1, 8, '900399211', 0, 'Labco nous colombia ltda', 'Labco nous colombia ltda', NULL, 'sandra.garcia@labconous.com', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8699', '8691', NULL, NULL, '', '', NULL, '', '2016-09-15 11:40:00', NULL, NULL, NULL, NULL),
(68, 1, NULL, 1, 8, '900311634', 9, 'Technomedical', 'Technomedical', NULL, '', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-27 13:28:00', NULL, NULL, NULL, NULL),
(69, 1, NULL, 1, 8, '890101303', 0, 'Asociacion de obstetricia y ginecologia del atlantico', 'Asociacion de obstetricia y ginecologia del atlantico', NULL, 'ASOGAEVENTO@YAHOO.COM', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-15 18:06:00', NULL, NULL, NULL, NULL),
(70, 1, NULL, 1, 8, '890301054', 9, 'Torrecafe Aguila Roja Y Cia S. A.', 'Torrecafe Aguila Roja Y Cia S. A.', NULL, 'torrecafeaguilaroja@hotmail.com', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-06-01 12:02:00', NULL, NULL, NULL, NULL),
(71, 1, NULL, 1, 8, '800149384', 0, 'Clinica colsanitas s.a.', 'Clinica colsanitas s.a.', NULL, 'WMORA@COLSANITAS.COM', NULL, 0, 0, 0, 0, 1, '', '1900-12-31', '8610', '8621', NULL, NULL, '', '', NULL, '', '2016-09-15 18:14:21', NULL, NULL, NULL, NULL),
(72, 1, NULL, 0, 11, '444444441', 0, 'Sequenom center for molecular medicine', 'Sequenom center for molecular medicine', NULL, '', NULL, 0, 0, 0, 0, 0, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-15 18:18:22', NULL, NULL, NULL, NULL),
(73, 1, NULL, 0, 11, '444444442', 0, 'Center for disease detection', 'Center for disease detection', NULL, '', NULL, 0, 0, 0, 0, 0, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-15 18:28:53', NULL, NULL, NULL, NULL),
(74, 1, NULL, 0, 11, '444444443', 0, 'The great plains laboratory, inc', 'The great plains laboratory, inc', NULL, '', NULL, 0, 0, 0, 0, 0, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-15 18:35:20', NULL, NULL, NULL, NULL),
(75, 1, NULL, 0, 11, '444444444', 0, 'Lw scientific ', 'Lw scientific', NULL, '', NULL, 0, 0, 0, 0, 0, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-09-19 11:00:17', NULL, NULL, NULL, NULL),
(76, 1, NULL, 1, 8, '811045170', 0, 'Validarr ltda', 'Validarr ltda', NULL, 'VALIDARRLTDA@YAHOO.ES', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '4322', '7110', NULL, NULL, '', '', NULL, '', '2016-09-19 15:23:21', NULL, NULL, NULL, NULL),
(77, 1, NULL, 1, 8, '900704098', 0, 'Abm promos s.a.s.', 'Abm promos s.a.s.', NULL, 'plasticron50@gmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4759', '6820', NULL, NULL, '', 'Colpatria', NULL, '4191021776', '2017-11-29 12:47:09', NULL, NULL, NULL, NULL),
(78, 1, NULL, 1, 8, '860500862', 0, 'Rochem biocare colombia s.a.s.', 'Rochem biocare colombia s.a.s.', NULL, 'lbernal@rochembiocare.com', NULL, 0, 0, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 11:47:00', NULL, NULL, NULL, NULL),
(79, 1, NULL, 0, 11, '444444445', 0, 'Teco inc', 'Teco inc.', NULL, 'sales@tecoinc.com', NULL, 0, 0, 0, 0, 0, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-12 10:25:00', NULL, NULL, NULL, NULL),
(80, 1, NULL, 1, 1, '800066001', 0, 'Centro medico oftalmologico y laboratorio clinico andrade narvaez s.a.s.', 'Colcan', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8691', '', NULL, NULL, '', '', NULL, '', '2016-12-29 08:09:00', NULL, NULL, NULL, NULL),
(81, 1, NULL, 1, 8, '900406129', 0, 'Asesorias y servicios en salud ocupacional a y s ocupacional s.a.s.', 'Asesorias y servicios en salud ocupacional a y s ocupacional s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8821', '', NULL, NULL, '', '', NULL, '', '2016-09-15 17:52:00', NULL, NULL, NULL, NULL),
(82, 1, NULL, 1, 8, '22550926', 0, 'Dayan gonzalez caballero', 'Dayan gonzalez caballero', NULL, 'DAGOCA70@GMAIL.COM', NULL, 1, 30, 0, 0, 2, '', '2017-04-19', '8514', '7499', NULL, NULL, '', '', NULL, '', '2017-04-19 08:36:00', NULL, NULL, NULL, NULL),
(83, 1, NULL, 1, 8, '900617594', 0, 'Neuro vital s.a.s.', 'Neuro vital s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '8621', '8621', NULL, NULL, '', '', NULL, '', '2017-04-25 14:55:57', NULL, NULL, NULL, NULL),
(84, 1, NULL, 1, 8, '806016225', 0, 'Centro medico buenos aires limitada', 'Centro medico buenos aires ltda', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '8512', '', NULL, NULL, '', '', NULL, '', '2017-03-22 11:39:00', NULL, NULL, NULL, NULL),
(85, 1, NULL, 1, 8, '900644749', 0, 'Centro arte papeleria s.a.s.', 'Centro arte papeleria s.a.s.', NULL, 'info@centroartepapeleria.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-17 11:49:00', NULL, NULL, NULL, NULL),
(86, 1, NULL, 1, 8, '802009275', 0, 'Representaciones industriales junior e.u.', 'Representaciones industriales junior e.u.', NULL, 'repindjunioreu@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-18 09:03:00', NULL, NULL, NULL, NULL),
(87, 1, NULL, 1, 8, '890940164', 0, 'Laboratorios ltda cartagena', 'Laboratorios ltda. cartagena ', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 11:25:00', NULL, NULL, NULL, NULL),
(88, 1, NULL, 1, 8, '811037912', 0, 'Disprolab ltda', 'Disprlab ltda', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 11:27:00', NULL, NULL, NULL, NULL),
(89, 1, NULL, 1, 8, '802006491', 0, 'Laboratorio clinico garcia andrade ltda', 'Laboratorio clinico garcia andrade ltda', NULL, 'DEIVISCASTRO76@GMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '8691', '', NULL, NULL, '', '', NULL, '', '2016-10-05 09:13:00', NULL, NULL, NULL, NULL),
(90, 1, NULL, 1, 8, '819001920', 0, 'Prevenir 1-a servicios integrales de salud ocupacional promocion y prevencion s.a.', 'Prevenir 1-a s.a.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '8699', '', NULL, NULL, '', '', NULL, '', '2017-03-22 11:52:00', NULL, NULL, NULL, NULL),
(91, 1, NULL, 1, 8, '900922775', 0, 'Rs publicidad sas', 'Rs publicidad sas', NULL, 'CONTACTO@RSPUBLICIDAD.COM.CO', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-16 17:36:00', NULL, NULL, NULL, NULL),
(92, 1, NULL, 1, 8, '900721599', 0, 'Mebiox s.a.s.', 'Mebiox s.a.s.', NULL, 'hbarragan@mebiox.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4645', '4649', NULL, NULL, '', '', NULL, '', '2017-10-03 14:30:48', NULL, NULL, NULL, NULL),
(93, 1, NULL, 1, 8, '830093951', 0, 'Laboratorios dai de colombia s.a.', 'Laboratorios dai de colombia s.a.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 11:36:00', NULL, NULL, NULL, NULL),
(94, 1, NULL, 1, 8, '811013926', 0, 'Indulab s.a.', 'Indulab s.a.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 11:22:00', NULL, NULL, NULL, NULL),
(95, 1, NULL, 1, 8, '79317671', 0, 'Bernal morales hernan cibed', 'Bernal morales hernan cibed', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 14:14:00', NULL, NULL, NULL, NULL),
(96, 1, NULL, 1, 8, '800129968', 0, 'Esvan s.a.s.', 'Esvan s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 14:16:00', NULL, NULL, NULL, NULL),
(97, 1, NULL, 1, 8, '800010319', 0, 'Benjamin esteban & cia ltda.', 'Benjamin esteban & cia ltda.', NULL, '', NULL, 0, 0, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 16:39:00', NULL, NULL, NULL, NULL),
(98, 1, NULL, 1, 8, '890400246', 0, '	industrias de refrigeracion comercial s.a.indufrial s.a. - indufrial s.a.', '	industrias de refrigeracion comercial s.a.indufrial s.a. - indufrial s.a.', NULL, '', NULL, 0, 0, 0, 0, 1, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-10-10 16:42:00', NULL, NULL, NULL, NULL),
(99, 1, NULL, 1, 8, '17199479', 0, 'Rivas cotes roberto alfonso', 'Consultorio radiologico roberto rivas cotes', NULL, 'ROBERTOALFONSORIVAS@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '8691', '8691', NULL, NULL, '', '', NULL, '', '2017-04-25 14:59:00', NULL, NULL, NULL, NULL),
(100, 1, NULL, 1, 8, '901035878', 0, 'Tecnofresh ingenieria s.a.s.', 'Tecnofresh ingenieria s.a.s.', NULL, 'tecnofresh@gmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-19 16:00:00', NULL, NULL, NULL, NULL),
(101, 1, NULL, 1, 8, '8693652', 0, 'Litonel impresores - nelson peralta', 'Litonel impresores - nelson peralta', NULL, 'LITONEL@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-30 16:27:00', NULL, NULL, NULL, NULL),
(102, 1, NULL, 1, 8, '72189177', 0, 'Mendoza lopez fabian antonio - multisistem', 'Multisistem', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-05 09:46:00', NULL, NULL, NULL, NULL),
(103, 1, NULL, 1, 8, '860521236', 0, 'Ciel ingenieria ', 'Ciel ingenieria', NULL, 'acortes@cielingenieria.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-07 16:23:00', NULL, NULL, NULL, NULL),
(104, 1, NULL, 1, 8, '901030028', 0, 'Prime llc sucursal colombia', 'Prime llc sucursal colombia', NULL, 'primesucursalcolombia@gmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4645', '4645', NULL, NULL, '', '', NULL, '', '2017-05-30 10:21:18', NULL, NULL, NULL, NULL),
(105, 1, NULL, 1, 8, '800131518', 0, 'Fundacion grupo de estudio barranquilla', 'Laboratorio rey falls', NULL, 'LANDOFALS@GMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-08-08 17:19:00', NULL, NULL, NULL, NULL),
(106, 1, NULL, 1, 1, '72146272', 0, 'Augusto cesar morales', 'Augusto cesar morales', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-09-04 11:39:00', NULL, NULL, NULL, NULL),
(107, 1, NULL, 1, 8, '890101272', 0, 'Sempertex de colombia s.a', 'Sempertex de colombia s.a', NULL, 'karlam@Sempertex.com', NULL, 1, 60, 0, 0, 1, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-09-07 16:16:00', NULL, NULL, NULL, NULL),
(108, 1, NULL, 1, 8, '800145449', 0, 'Disgraficas de la costa sas', 'Disgraficas de la costa sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:24:17', NULL, NULL, NULL, NULL),
(109, 1, NULL, 1, 8, '890936529', 0, 'Industria colombiana de dotaciones metalicas s.a.s. ', 'Dometal s.a.s.', NULL, 'GERENCIA@DOMETAL.COM.CO', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '3250', '', NULL, NULL, '', '', NULL, '', '2017-08-03 07:49:00', NULL, NULL, NULL, NULL),
(110, 1, NULL, 1, 8, '900654826', 0, 'Anunciar de occidente s.a.s.', 'Anunciar de occidente s.a.s.', NULL, 'A.ANUNCIAR@GMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '2018-01-15', '7310', '4922', NULL, NULL, '', '', NULL, '', '2018-01-15 09:03:00', NULL, NULL, NULL, NULL),
(111, 1, NULL, 1, 8, '1140836767', 0, 'Edgardo alfonso fierro sinning', 'Edgardo alfonso fierro sinning', NULL, 'ARTEBARRANQUILLA01@GMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '7310', '', NULL, NULL, '', '', NULL, '', '2017-08-03 08:34:24', NULL, NULL, NULL, NULL),
(112, 1, NULL, 1, 8, '900406327', 0, 'Cobar etiquetas s.a.s.', 'Cobar etiquetas s.a.s.', NULL, 'VENTAS@COBARETIQUETAS.COM', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '1811', '', NULL, NULL, '', 'Bancolombia', NULL, '77070850425', '2017-09-08 07:50:27', NULL, NULL, NULL, NULL),
(113, 1, NULL, 1, 8, '802025316', 0, 'Soluzioni s.a.', 'Soluzioni s.a.', NULL, '3215746273', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '3110', '', NULL, NULL, '', '', NULL, '', '2017-09-12 09:17:35', NULL, NULL, NULL, NULL),
(114, 1, NULL, 1, 8, '830064712', 0, 'Labtronics s.a.s.', 'Labtronics s.a.s.', NULL, 'asesorcosta@labtronics.net', NULL, 1, 30, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-05 17:09:00', NULL, NULL, NULL, NULL),
(115, 1, NULL, 1, 8, '900126800', 2, 'Advance Scientific Colombia Ltda.', 'Advance Scientific Colombia Ltda.', NULL, '', NULL, 0, 0, 0, 0, 2, '4545-555', '1900-12-31', '4645', '4659', NULL, NULL, 'Www.advancescientificgroup.com\r\nventa de ampolla ppd (tuberculina)', 'Banco de bogotá', NULL, '276368933', '2016-04-27 13:45:00', NULL, NULL, NULL, NULL),
(116, 1, NULL, 1, 8, '890111930', 0, 'Doquimica de la costa ltda', 'Doquimica de la costa ltda', NULL, 'DOQUIM@METROTEL.NET.CO', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-17 11:31:00', NULL, NULL, NULL, NULL),
(117, 1, NULL, 1, 8, '900053982', 0, 'Representaciones medicas jazmín castellanos e.u', 'Representaciones medicas jazmín castellanos e.u', NULL, 'jascastellanos_represemedic@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-30 09:07:00', NULL, NULL, NULL, NULL),
(118, 1, NULL, 1, 8, '802008192', 0, 'Centro mayorista papelero tauro s.a.s', 'Centro mayorista papelero tauro s.a.s', NULL, '', NULL, 1, 60, 0, 0, 1, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-13 11:23:00', NULL, NULL, NULL, NULL),
(119, 1, NULL, 1, 8, '900745726', 0, 'Compubit colombia s.a.s', 'Compubit colombia sas', NULL, 'compubitcolombia@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-16 14:04:00', NULL, NULL, NULL, NULL),
(120, 1, NULL, 1, 8, '22523159', 0, 'Conrado espinel sandra patricia', 'Conrado espinel sandra patricia', NULL, 'SVALENTHINA@HOTMAIL.COM', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-09-04 12:14:00', NULL, NULL, NULL, NULL),
(121, 1, NULL, 1, 8, '802012326', 0, 'Insercop distrilan', 'Insercop distrilan', NULL, 'josenarvaez@insercop.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-27 12:44:00', NULL, NULL, NULL, NULL),
(122, 1, NULL, 1, 8, '890102466', 0, 'Publicaciones comerciales s.a.s.', 'Publicaciones comerciales s.a.s.', NULL, 'comercial@publicacionescomerciales.net', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-13 15:14:00', NULL, NULL, NULL, NULL),
(123, 1, NULL, 1, 8, '800191556', 0, 'Nobel impresores s.a.', 'Nobel impresores s.a.', NULL, 'INFO@NOBELIMPRESORES.NET', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-05-27 07:26:00', NULL, NULL, NULL, NULL),
(124, 1, NULL, 1, 8, '900070972', 0, 'Dispromedics ltda', 'Dispromedics ltda', NULL, 'ventas@dispromedics.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '007257644283', '2017-10-13 09:39:00', NULL, NULL, NULL, NULL),
(125, 1, NULL, 1, 8, '51560512', 0, 'Marta rodriguez gutierrez ', 'Marta rodriguez gutierrez ', NULL, 'MAUGAVA55@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '9521', '', NULL, NULL, '', '', NULL, '', '2017-10-27 09:29:00', NULL, NULL, NULL, NULL),
(126, 1, NULL, 1, 8, '802020198', 0, 'Colombian hospital s. en c.', 'Colombian hospital s. en c.', NULL, 'colombianhospital@hotmail.com', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '3250', '', NULL, NULL, '', '', NULL, '', '2017-09-12 09:28:00', NULL, NULL, NULL, NULL),
(127, 1, NULL, 1, 8, '1140836989', 0, 'Torres olano carol lizeth ', 'Cazamoda', NULL, 'CAZAMODA@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-06-23 17:45:00', NULL, NULL, NULL, NULL),
(128, 1, NULL, 1, 8, '860059687', 0, 'Multiproyectos s.a.', 'Multiproyectos s.a.', NULL, 'lquijano@multiproyectos.com.co', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-09-14 14:55:00', NULL, NULL, NULL, NULL),
(129, 1, NULL, 1, 8, '802001608', 0, 'Laboratorio para la industria y el medio ambiente s.a.s', 'Laboratorio lima s.a.s', NULL, 'GERENCIA.LIMA@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-10-21 07:46:00', NULL, NULL, NULL, NULL),
(130, 1, NULL, 1, 8, '900049404', 0, 'Sion trade sas', 'Sion trade sas', NULL, 'j.avila@sionpromocionales.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-07-28 07:48:00', NULL, NULL, NULL, NULL),
(131, 1, NULL, 1, 8, '72201370', 0, 'Alexander enrique silvera aguilar - arte impreso as', 'Alexander enrique silvera aguilar - arte impreso as', NULL, 'ALEXSILVERA22@HOTMAIL.COM', NULL, 1, 30, 0, 0, 2, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-09-25 13:49:00', NULL, NULL, NULL, NULL),
(132, 2, NULL, 1, 8, '900406327', 0, 'Cobar etiquetas s.a.s.', 'Cobar etiquetas s.a.s.', NULL, 'ventas@cobaretiquetas.com', NULL, 1, 60, 0, 0, 2, '', '0000-00-00', '1811', '', NULL, NULL, '', 'Bancolombia', NULL, '77070850425', '2017-10-03 11:59:00', NULL, NULL, NULL, NULL),
(133, 1, NULL, 1, 8, '900371380', 0, 'Novva sas', 'Novva sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:26:13', NULL, NULL, NULL, NULL),
(134, 1, NULL, 1, 8, '890111996', 0, 'Fuller pereira boo y cia ltda', 'Fuller pereira boo y cia ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:42:47', NULL, NULL, NULL, NULL),
(135, 1, NULL, 1, 8, '800183169', 0, 'Norquimicos ltda', 'Norquimicos ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2017-12-04 17:48:13', NULL, NULL, NULL, NULL),
(136, 1, NULL, 1, 8, '8715163', 0, 'Efrain alfonso gonzalez marino', 'Efrain alfonso gonzalez marino', NULL, 'EFRAINGONZALEZMARINO@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4719', '', NULL, NULL, '', 'Bancolombia', NULL, '47460833996', '2017-12-07 09:57:32', NULL, NULL, NULL, NULL),
(137, 1, NULL, 1, 8, '1045710287', 0, 'Kevin daniel gonzalez meza', 'Kevin daniel gonzalez meza', NULL, 'efraingonzalezmarino@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '7430', '', NULL, NULL, '', '', NULL, '', '2017-12-12 10:40:49', NULL, NULL, NULL, NULL),
(138, 1, NULL, 1, 8, '900842653', 0, 'Dfarma sas', 'Dfarma sas', NULL, 'costa@dfarma.co', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '07759707129', '2017-12-20 08:18:56', NULL, NULL, NULL, NULL),
(139, 1, NULL, 1, 8, '860001767', 0, 'Industrias colombia inducol s.a.s.', 'Industrias colombia inducol s.a.s.', NULL, 'jpacheco@inducol.com.co', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '2750', '4754', NULL, NULL, '', '', NULL, '', '2018-01-04 11:55:52', NULL, NULL, NULL, NULL),
(140, 1, NULL, 1, 8, '1140840606', 0, 'Luis eduardo rivaldo ortiz', 'Luis eduardo rivaldo ortiz', NULL, 'Di.luedrior@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '7410', '', NULL, NULL, '', '', NULL, '', '2018-01-16 13:18:45', NULL, NULL, NULL, NULL),
(141, 1, NULL, 1, 8, '900083002', 0, 'Casa electrica j.v. ltda.', 'Casa electrica j.v. ltda.', NULL, 'casaelectricajv@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4752', '', NULL, NULL, '', '', NULL, '', '2018-01-18 08:52:07', NULL, NULL, NULL, NULL),
(142, 1, NULL, 1, 8, '15030060', 0, 'Nefer enrique puche cuello', 'Nefer enrique puche cuello', NULL, 'nefer.puche@hotmail.com', NULL, 0, 0, 0, 0, 2, '', '2018-01-24', '3110', '', NULL, NULL, '', '', NULL, '', '2018-01-24 13:26:00', NULL, NULL, NULL, NULL),
(143, 1, NULL, 1, 8, '901071754', 0, 'Industrias cruz azur s.a.s.', 'Industrias cruz azur s.a.s.', NULL, 'aadmi@cruzazur.com.co', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '533-754337-92', '2018-02-19 08:54:04', NULL, NULL, NULL, NULL),
(144, 1, NULL, 1, 8, '890311274', 0, 'Cargvajal espacios sa', 'Mepal', NULL, 'REINA.BARRANCO@CARVAJAL.COM', NULL, 1, 30, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-03-22 13:57:36', NULL, NULL, NULL, NULL),
(145, 1, NULL, 1, 8, '890311274', 0, 'Carvajal espacios', 'Mepal', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-03-22 14:02:09', NULL, NULL, NULL, NULL),
(146, 1, NULL, 1, 1, '79889338', 0, 'Maximiliano antonio gutierrez ramirez', 'Maximiliano gutierrez', NULL, '', NULL, 1, 30, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-04-04 14:12:11', NULL, NULL, NULL, NULL),
(147, 1, NULL, 1, 8, '900654826', 0, 'Anunciar de occidente sas', 'Anunciar de occidente sas', NULL, 'A.ANUNCIAR@GMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Banco de bogota', NULL, '544231939', '2018-04-12 16:54:05', NULL, NULL, NULL, NULL),
(148, 1, NULL, 1, 8, '800157926', 1, 'K jiplas s. a.', 'Kjiplas s. a.', NULL, 'kjiplas@kjiplas.com', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Proveedor de bolsas ziploc transparentes e impresas', 'Bancolombia', NULL, '607-515599-45', '2016-05-31 16:17:00', NULL, NULL, NULL, NULL),
(149, 1, NULL, 1, 1, '43083269', 0, 'Mercedes de jesus hoyos hoyos', 'Mundial sellos y suministros', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-04-26 14:41:19', NULL, NULL, NULL, NULL),
(150, 1, NULL, 1, 8, '802025217', 0, 'Metric', 'Metric', NULL, 'COMERCIAL@MILLANSINGENIERIA.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Solicitado por kelly morales', 'Bbva', NULL, '', '2018-04-28 07:34:00', NULL, NULL, NULL, NULL),
(151, 1, NULL, 1, 8, '802013459', 0, 'Investigaciones metrologicas del caribe s.a', 'Metrocaribe', NULL, 'gerencia@metrocaribe.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '47508119729', '2018-05-15 13:38:06', NULL, NULL, NULL, NULL),
(152, 1, NULL, 1, 8, '901100205', 0, 'Dotauniformes1asas', 'Dotauniformes1asas', NULL, 'DOTAUNIFORMES1ASAS@HOTMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-05-18 08:20:21', NULL, NULL, NULL, NULL),
(153, 1, NULL, 1, 8, '800031358', 0, 'Estrategias', 'Estrategias ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-05-24 14:12:03', NULL, NULL, NULL, NULL),
(154, 1, NULL, 1, 8, '900967', 0, 'Insalata', 'Insalata', NULL, 'GERENCIADHG@GMAIL.COM', NULL, 1, 45, 2000000, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '477595031-94', '2018-05-25 15:31:47', NULL, NULL, NULL, NULL),
(155, 1, NULL, 1, 8, '900389650', 0, 'Capital colombia', 'Capital colombia', NULL, 'ricardo@capitalcolombia.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Solicitado por sistemas para impresora v campestre', 'Bancolombia', NULL, '16764142717', '2018-06-05 15:02:48', NULL, NULL, NULL, NULL),
(156, 1, NULL, 1, 8, '900832016', 0, 'Evolution q sas', 'Evolution q sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-06-12 15:02:00', NULL, NULL, NULL, NULL),
(157, 1, NULL, 1, 8, '900575661', 0, 'Kreative estudio creativo s.a.s', 'Kreative estudio creativo s.a.s', NULL, 'atephanie@go-kreative.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-06-14 09:11:52', NULL, NULL, NULL, NULL),
(158, 1, NULL, 1, 1, '72203262', 0, 'Jhon jairo melendez', 'Jhon jairo', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-06-30 10:22:59', NULL, NULL, NULL, NULL),
(159, 1, NULL, 1, 8, '802015607', 5, 'Rodelg Laboratorios Ltda.', 'Rodelg Laboratorios Ltda.', NULL, '', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-24 10:01:00', NULL, NULL, NULL, NULL),
(160, 1, NULL, 1, 8, '901048787', 0, 'Module offica', 'Module office', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-07-09 08:18:16', NULL, NULL, NULL, NULL),
(161, 1, NULL, 1, 1, '22485968', 0, 'Sandra rodriguez consuegra', 'Sandra rodriguez consuegra', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-07-12 09:45:28', NULL, NULL, NULL, NULL),
(162, 1, NULL, 1, 1, '72432012', 0, 'Jaime espinoza garcia', 'Jaime espinoza garcia', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-07-18 17:15:52', NULL, NULL, NULL, NULL),
(163, 1, NULL, 1, 1, '73130347', 0, 'Jaime urueta galvis', 'Jaime urueta galvis', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-07-19 11:10:03', NULL, NULL, NULL, NULL),
(164, 1, NULL, 1, 8, '900414638', 0, 'Servicios de ambientes limpios industriales s.a.s.', 'Servicios de ambientes limpios industriales s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-06-28 09:25:00', NULL, NULL, NULL, NULL),
(165, 1, NULL, 1, 8, '802013210', 0, 'E refrigeracion cia ltda', 'E refrigeracion cia ltda', NULL, 'erefrigeracion@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '2790', '', NULL, NULL, '', '', NULL, '', '2017-12-06 09:33:00', NULL, NULL, NULL, NULL),
(166, 1, NULL, 1, 8, '800052534', 0, 'Distribuciones axa s.a.s', 'Distribuciones axa s.a.s', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-07-27 17:39:37', NULL, NULL, NULL, NULL),
(167, 1, NULL, 1, 1, '8742956', 0, 'Jose luis posada pedroza', 'Quimifuego de la costa', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-08-03 16:52:45', NULL, NULL, NULL, NULL),
(168, 1, NULL, 1, 1, '1234093282', 0, 'Tecnonacho', 'Tecnonacho', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-08-06 10:30:00', NULL, NULL, NULL, NULL),
(169, 1, NULL, 1, 2, '8736900', 0, 'Clemente ricaurte', 'Clemente ricaurte', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Anticipo 50% - saldo al final del trabajo', '', NULL, '', '2018-08-31 11:19:00', NULL, NULL, NULL, NULL),
(170, 1, NULL, 1, 8, '900175902', 0, 'Genetix', 'Genetix', NULL, '', NULL, 1, 30, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-08-31 14:21:27', NULL, NULL, NULL, NULL),
(171, 1, NULL, 1, 1, '72289524', 0, 'Nelson javier salcedo corcho', 'Nelson javier salcedo corcho', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-06 14:48:45', NULL, NULL, NULL, NULL),
(172, 1, NULL, 1, 8, '900164891', 0, 'Cc aires sas', 'Cc aires sas', NULL, 'CONTABILIDAD@CCAIRES.COM', NULL, 1, 15, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '44237076202', '2018-09-11 15:36:58', NULL, NULL, NULL, NULL),
(173, 1, NULL, 1, 8, '802001608', 0, 'Laboratorio para la industria y el medio ambiente sas', 'Laboratorio para la industria y el medio ambiente sas', NULL, 'GERENCIA.LIMA@HOTMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-12 08:29:22', NULL, NULL, NULL, NULL),
(174, 1, NULL, 1, 1, '8520968', 0, 'Rafael sanchez castro', 'Rafael sanchez castro', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-13 16:02:05', NULL, NULL, NULL, NULL),
(175, 1, NULL, 1, 8, '901040258', 0, 'Ferremallas', 'Ferremallas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-13 16:15:49', NULL, NULL, NULL, NULL),
(176, 1, NULL, 1, 1, '72265733', 0, 'Armando avila paternina', 'Armando avila paternina', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-18 17:18:48', NULL, NULL, NULL, NULL),
(177, 1, NULL, 1, 8, '802005006', 0, 'Industrias guinovart y cia ltda', 'Guinovart', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-25 08:18:22', NULL, NULL, NULL, NULL),
(178, 1, NULL, 1, 8, '800224359', 0, 'Proquilab', 'Proquilab ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-25 08:34:00', NULL, NULL, NULL, NULL),
(179, 1, NULL, 1, 1, '72272805', 0, 'Arrieta torres samir ', 'Arrieta torres samir ', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-25 09:19:55', NULL, NULL, NULL, NULL),
(180, 1, NULL, 1, 1, '72135742', 0, 'Luis beltran palma gamez', 'Luis beltran palma gamez', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-26 08:37:21', NULL, NULL, NULL, NULL),
(181, 1, NULL, 1, 1, '45437911', 0, 'Magdalena lopez lara', 'Magdalena lopez lara', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-26 15:26:33', NULL, NULL, NULL, NULL),
(182, 1, NULL, 1, 8, '800537070', 0, 'Soluciones electronicas y refrigeracion sas', 'Soluciones electronicas y refrigeracion sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-09-26 15:47:18', NULL, NULL, NULL, NULL),
(183, 1, NULL, 1, 1, '1140873902', 0, 'Jair piña', 'Jair piña', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-05 09:03:37', NULL, NULL, NULL, NULL),
(184, 1, NULL, 1, 8, '901066534', 0, 'Incomel de la costa sas', 'Incomel de la costa sas', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-09 10:24:38', NULL, NULL, NULL, NULL),
(185, 1, NULL, 1, 1, '8754879', 0, 'Alexis serrano', 'Alexis serrano', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-16 10:12:45', NULL, NULL, NULL, NULL),
(186, 1, NULL, 1, 1, '1129513783', 0, 'Jorge luis solano carmona', 'Jorge luis solano carmona', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-18 14:53:40', NULL, NULL, NULL, NULL),
(187, 1, NULL, 1, 1, '1098708890', 0, 'Natalie stephaniea rodriguez perez', 'Photobooth la cabina santa marta', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-18 17:27:28', NULL, NULL, NULL, NULL),
(188, 1, NULL, 1, 1, '57456908', 0, 'Grey kelly ayala fontalvo', 'Grey kelly ayala fontalvo', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-10-22 15:45:34', NULL, NULL, NULL, NULL),
(189, 1, NULL, 1, 1, '32607047', 0, 'Fathya ghunaim', 'Fathya ghunaim', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-01 11:30:28', NULL, NULL, NULL, NULL),
(190, 1, NULL, 1, 8, '860001778', 0, 'Casa inglesa', 'Casa inglesa', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-02 16:30:05', NULL, NULL, NULL, NULL),
(191, 1, NULL, 1, 8, '900167288', 0, 'Fumigaciones y servicios industriales ltda', 'Fumigaciones y servicios industriales ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-06 07:37:38', NULL, NULL, NULL, NULL),
(192, 1, NULL, 1, 8, '890111339', 0, 'Laboratorio medico echavarria', 'Laboratorio medico echavarria', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-21 09:58:18', NULL, NULL, NULL, NULL),
(193, 1, NULL, 1, 8, '900086431', 0, 'Interlux ltda', 'Interlux ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-21 10:14:00', NULL, NULL, NULL, NULL);
INSERT INTO `proveedores` (`id_proveedores`, `estado`, `procedencia`, `id_tipo_contribuyente`, `id_tipo_identificacion`, `numero_identificacion`, `dv`, `razon_social`, `nombre_comercial`, `id_ubicacion`, `email`, `id_representante_legal`, `proveedor_credito`, `plazo_dias`, `monto_minimo`, `monto_maximo`, `id_clasificacion_tributaria`, `numero_resolucion`, `fecha_resolucion`, `codigo_act_eco_1`, `codigo_act_ind_comer`, `id_tarifa_por_mil`, `id_tarifa_retencion`, `observaciones`, `nombre_entidad_bancaria`, `id_tipo_cuenta`, `numero_cuenta`, `fecha_creacion`, `id_usuario_creacion`, `fecha_update`, `id_usuario_update`, `id_tipo_autorretenedor`) VALUES
(194, 1, NULL, 1, 8, '830067005', 0, 'Milenio pc', 'Milenio pc', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-21 11:02:37', NULL, NULL, NULL, NULL),
(195, 1, NULL, 1, 8, '900748930', 0, 'Src diseños', 'Src diseños', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-29 09:35:05', NULL, NULL, NULL, NULL),
(196, 1, NULL, 1, 1, '72334051', 0, 'Luis adarraga', 'Luis adarraga', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-12-13 09:48:32', NULL, NULL, NULL, NULL),
(197, 1, NULL, 1, 1, '1140822113', 0, 'Alvaro miguel villalba', 'Alvaro miguel villalba', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-12-31 09:45:43', NULL, NULL, NULL, NULL),
(198, 1, NULL, 1, 8, '900758616', 0, 'Manos a la obra', 'Manos a la obra', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-01-11 16:25:54', NULL, NULL, NULL, NULL),
(199, 1, NULL, 1, 8, '900817520', 0, 'Hm & m contrucciones s.a.s.', 'Hm & m contrucciones s.a.s.', NULL, 'hmymcnst@hotmail.com', NULL, 0, 0, 0, 0, 3, '20000180049', '2015-03-05', '', '0302', NULL, NULL, '', '', NULL, '', '2019-03-08 09:32:52', NULL, NULL, NULL, NULL),
(200, 1, NULL, 1, 8, '900991379', 0, 'Antarctica store s.a.s.', 'Antarctica store s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-29 09:42:00', NULL, NULL, NULL, NULL),
(201, 1, NULL, 1, 1, '1019132726', 0, 'Sebastian andres pacheco barraza - suministros sysp', 'Sebastian andres pacheco barraza - suministros sysp', NULL, 'suministrossysp@gmail.com', NULL, 0, 0, 0, 0, 4, '', '0000-00-00', '4741', '', NULL, NULL, '', '', NULL, '', '2018-08-23 15:41:00', NULL, NULL, NULL, NULL),
(202, 2, NULL, 1, 1, '45518761', 0, 'Tecnonacho store', 'Tecnonacho store', NULL, 'TECNONACHO84@GMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-05-28 16:35:00', NULL, NULL, NULL, NULL),
(203, 1, NULL, 1, 8, '900370779', 0, 'Latin electronics s.a.s.', 'Latin electronics s.a.s.', NULL, 'latin.asistente@gmail.com', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '9521', '', NULL, NULL, 'Servicio mtto filtros villa campestre', 'Banco popular', NULL, '11022915326-7', '2019-03-13 15:29:49', NULL, NULL, NULL, NULL),
(204, 1, NULL, 1, 8, '800122811', 0, 'Cotel s.a.s.', 'Cotel s.a.s.', NULL, 'CLAUDIA.GOMEZ@COTEL.COM.CO', NULL, 0, 0, 0, 0, 2, '', '2019-03-14', '7110', '4652', NULL, NULL, 'Proveedor equipos de computo y comunicacion', 'Bancolombia', NULL, '81004598431', '2019-03-14 08:25:00', NULL, NULL, NULL, NULL),
(205, 1, NULL, 1, 8, '900609301', 0, 'Holland group sas ', 'Holland group sas ', NULL, 'international@holland-group.co', NULL, 0, 0, 0, 0, 3, '', '0000-00-00', '4645', '4659', NULL, NULL, '', 'Davivienda', NULL, '010269984265', '2019-03-28 17:58:00', NULL, NULL, NULL, NULL),
(206, 1, NULL, 1, 8, '900016169', 0, 'Refriservicios del caribe sas', 'Refriservicios del caribe sas', NULL, 'REFRISERVICIOSDELCARIBEEU@HOTMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-04-03 08:49:27', NULL, NULL, NULL, NULL),
(207, 1, NULL, 1, 8, '1140873954', 0, 'Velez quintero roger eduardo - serviprinter pre prensa', 'Velez quintero roger eduardo - serviprinter pre prensa', NULL, 'ROGERVELEZQUINTERO@GMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Publicidad', '', NULL, '', '2019-08-01 09:12:12', NULL, NULL, NULL, NULL),
(208, 1, NULL, 1, 1, '1129574320', 0, 'Giovanna de la rosa muñoz - couture', 'Giovanna de la rosa muñoz - couture', NULL, 'couture.ventas@gmail.com', NULL, 0, 0, 0, 0, 4, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia', NULL, '77374570016', '2019-04-04 14:36:00', NULL, NULL, NULL, NULL),
(209, 1, NULL, 1, 8, '901088069', 0, 'Pcmart colombia sas', 'Pcmart colombia sas', NULL, 'ventas4@pcmartcolombia.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-04-16 16:59:33', NULL, NULL, NULL, NULL),
(210, 1, NULL, 1, 8, '860005289', 0, 'Ascensores schindler de colombia s.a.s', 'Ascensores schindler de colombia s.a.s', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2018-11-20 09:04:00', NULL, NULL, NULL, NULL),
(211, 1, NULL, 1, 8, '830024737', 0, 'Quimiolab s.a.s.', 'Quimiola s.a.s.', NULL, 'adriana.goenaga@quimiolab.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-05-07 14:30:36', NULL, NULL, NULL, NULL),
(212, 1, NULL, 1, 8, '900397763', 0, 'Sociedad clinica iberoamericana s.a.s', 'Sociedad clínica iberoamericana s.a.s', NULL, '', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '8610', '', NULL, NULL, '', '', NULL, '', '2019-05-13 17:27:00', NULL, NULL, NULL, NULL),
(213, 1, NULL, 1, 8, '802004326', 0, 'Laboratorio clinico falab s.a.s', 'Laboratorio clinico falab s.a.s', NULL, 'LABORATORIOFALAB@HOTMAIL.COM', NULL, 0, 0, 0, 0, 3, '', '0000-00-00', '8691', '', NULL, NULL, '', 'Bancolombia s.a', NULL, '48754720667', '2019-05-18 09:47:39', NULL, NULL, NULL, NULL),
(214, 1, NULL, 1, 8, '901168701', 0, 'Digito ingenieria s.a.s.', 'Digito ingenieria s.a.s.', NULL, 'o.meza@digitoingenieria.com', NULL, 0, 0, 0, 0, 3, '', '2019-06-11', '4652', '3314', NULL, NULL, 'Camaras', 'Bbva', NULL, '00130273000200174714', '2019-06-11 09:18:00', NULL, NULL, NULL, NULL),
(215, 1, NULL, 1, 1, '84450784', 0, 'Omar meza trujillo', 'Omar meza trujillo', NULL, 'O.MEZA@DIGITOINGENIERIA.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-06-11 11:17:19', NULL, NULL, NULL, NULL),
(216, 1, NULL, 1, 8, '22544175', 0, 'Marlene tomasa castañeda escorcia - segsolda', 'Marlene tomasa castañeda escorcia - segsolda', NULL, 'segsolda@hotmail.com', NULL, 1, 30, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', 'Bancolombia ', NULL, '08018760241', '2019-06-13 11:13:34', NULL, NULL, NULL, NULL),
(217, 1, NULL, 1, 8, '800121475', 0, 'Quimins ltda', 'Quimins ltda', NULL, 'QUIMINS@METROTEL.NET.CO', NULL, 1, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-06-25 11:27:03', NULL, NULL, NULL, NULL),
(218, 1, NULL, 1, 8, '900502979', 0, 'Ecos lineas y diseños s.a.s.', 'Ecos lineas y diseños s.a.s.', NULL, 'GERENCIAECOSLINEASYDISENOS@HOTMAIL.COM', NULL, 0, 0, 0, 0, 2, '', '2019-07-15', '', '', NULL, NULL, 'Proveedor inmobiliarios de oficina', 'Banco de bogota', NULL, '574102638', '2019-07-15 11:47:00', NULL, NULL, NULL, NULL),
(219, 1, NULL, 1, 8, '802014471', 0, 'Invesakk ltda - ferreteria samir', 'Invesakk ltda - ferreteria samir', NULL, 'VENTAS@FERRETERIASAMIR.COM', NULL, 1, 60, 10000000, 0, 1, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor para mantenimientos - ferreteria', 'Banco bogota', NULL, '467055471', '2019-07-25 11:19:00', NULL, NULL, NULL, NULL),
(220, 1, NULL, 1, 8, '8715402', 0, 'Perez vargas arturo rafael - acabados arquitectonicos', 'Perez vargas arturo rafael - acabados arquitectonicos', NULL, 'arturo50@hotmail.es', NULL, 0, 0, 0, 0, 4, '', '0000-00-00', '7110', '', NULL, NULL, 'Proveedor para brillar pisos', '', NULL, '', '2019-08-20 15:57:52', NULL, NULL, NULL, NULL),
(221, 1, NULL, 1, 8, '900331915', 0, 'Actual ediciones s.a.s.', 'Actual ediciones s.a.s.', NULL, 'comercial3@larevistaactual.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-08-21 16:45:24', NULL, NULL, NULL, NULL),
(222, 1, NULL, 1, 8, '900021348', 0, 'Gram ingenieria y construcciones s.a.s.', 'Gram ingenieria y construcciones s.a.s.', NULL, 'GRAMINGENIERIA@YAHOO.COM', NULL, 0, 0, 0, 0, 2, '', '0000-00-00', '4321', '7110', NULL, NULL, '', 'Bancolombia', NULL, '69222618978', '2019-09-17 10:26:00', NULL, NULL, NULL, NULL),
(223, 1, NULL, 1, 8, '9138943', 0, 'Ochoa reinel samuel primero', 'Ochoa reinel samuel primero', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor para realizar trabajos de mantenimientos de impermeabilizacion techos ', '', NULL, '', '2019-09-24 17:05:00', NULL, NULL, NULL, NULL),
(224, 1, NULL, 1, 8, '78111949', 0, 'Rafael francisco pulgar zuleta ', 'Rafael francisco pulgar zuleta ', NULL, 'zuleta1976@hotmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-09-27 11:23:06', NULL, NULL, NULL, NULL),
(225, 1, NULL, 1, 8, '890117413', 0, 'Tecnialarmas ltda', 'Tecnialarmas ltda', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Sistema de alarmas', '', NULL, '', '2019-09-27 17:46:23', NULL, NULL, NULL, NULL),
(226, 1, NULL, 1, 8, '901097821', 0, 'Zippercol s.a.s.', 'Zippercol s.a.s.', NULL, 'p.vega@zippercol.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor de bolsas plasticas e impresas', '', NULL, '', '2019-10-02 16:42:23', NULL, NULL, NULL, NULL),
(227, 1, NULL, 1, 8, '900811214', 0, 'Antiox s.a.s.', 'Antiox s.a.s.', NULL, 'antioxlaboratorio@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor helicobacter pilori', '', NULL, '', '2019-10-09 17:22:06', NULL, NULL, NULL, NULL),
(228, 1, NULL, 1, 8, '901256690', 0, 'Millan ingenieria biomedica s.a.s.', 'Millan ingenieria biomedica s.a.s.', NULL, 'gerencia@millanbiomedic.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-10-10 16:48:05', NULL, NULL, NULL, NULL),
(229, 1, NULL, 1, 8, '890107829', 9, 'Realab - reactivos para laboratorios ltda.', 'Realab ltda.', NULL, 'realabltda@yahoo.com', NULL, 1, 30, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-24 11:58:00', NULL, NULL, NULL, NULL),
(230, 2, NULL, 1, 8, '900019737', 8, 'Distribuidora Y Papeleria Veneplast Ltda.', 'Distribuidora Y Papeleria Veneplast Ltda.', NULL, 'contabilidad@papeleriaveneplast.co', NULL, 1, 60, 0, 0, 2, '', '1900-12-31', '', '', NULL, NULL, 'Venta de papeleria. \r\n3 días para despachos', 'Bancolombia', NULL, '775-567131-62', '2016-05-02 15:19:00', NULL, NULL, NULL, NULL),
(231, 1, NULL, 1, 8, '802001223', 0, 'Equinorte sa', 'Equinorte sa', NULL, 'dyepes@equinorte.net', NULL, 1, 30, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-11-07 14:32:00', NULL, NULL, NULL, NULL),
(232, 1, NULL, 1, 8, '800165377', 0, 'Grupo decor sas', 'Decorceramica', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-11-07 17:36:20', NULL, NULL, NULL, NULL),
(233, 1, NULL, 1, 8, '1140815626', 0, 'Cristina velez quintero - arte de amor', 'Cristina velez quintero - arte de amor', NULL, '', NULL, 1, 60, 10, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Publicitarios', '', NULL, '', '2019-12-03 14:57:22', NULL, NULL, NULL, NULL),
(234, 1, NULL, 1, 8, '800161098', 0, 'Comercializadora propura ltda', 'Comercializadora propura ltda', NULL, 'PROPURA@PROPURALTDA.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Mantenimiento de filtro de agua principal', '', NULL, '', '2019-12-12 16:57:09', NULL, NULL, NULL, NULL),
(235, 1, NULL, 1, 8, '900963642', 0, 'Beckman coulter colombia s.a.s.', 'Beckman coulter colombia s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2019-12-26 15:16:13', NULL, NULL, NULL, NULL),
(236, 1, NULL, 1, 8, '900119439', 9, 'Siemens healthcare diagnostics s.a.s', 'Siemens healthcare diagnostics s.a.s.', NULL, 'amparo.gentil_posada@siemens.com', NULL, 1, 60, 80000000, 0, 2, '', '1900-12-31', '', '', NULL, NULL, '', '', NULL, '', '2016-05-20 16:49:00', NULL, NULL, NULL, NULL),
(237, 1, NULL, 1, 8, '800043442', 0, 'Fundacion probarranquilla', 'Fundacion probarranquilla', NULL, 'oscar.gil@probarranquilla.org', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Revista publicidad', 'Bancolombia', NULL, '08301175789', '2020-01-10 10:10:25', NULL, NULL, NULL, NULL),
(238, 1, NULL, 1, 8, '900096245', 0, 'La casa de la ups s.a.s.', 'La casa de la ups s.a.s.', NULL, 'CONTADOR@CASAUPS.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-01-27 16:08:55', NULL, NULL, NULL, NULL),
(239, 1, NULL, 1, 8, '890110330', 0, 'Industrias cruz cañon ltda', 'Industrias cruz cañon ltda', NULL, 'gerencia@industriascruzcanon.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-02-26 10:04:59', NULL, NULL, NULL, NULL),
(240, 1, NULL, 1, 8, '900495438', 0, 'Orange medical store s.a.s.', 'Orange medical store s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-02-27 16:19:57', NULL, NULL, NULL, NULL),
(241, 1, NULL, 1, 8, '72249981', 0, 'Andris antonio olivares llanos ', 'Andris antonio olivares llanos ', NULL, 'ANDRIS0312@HOTMAIL.COM', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-03-16 15:02:52', NULL, NULL, NULL, NULL),
(242, 1, NULL, 1, 8, '901310456', 0, 'Grupo cresort s.a.s.', 'Grupo cresort s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-04-03 17:02:36', NULL, NULL, NULL, NULL),
(243, 1, NULL, 1, 8, '900900379', 0, 'Serso outsourcing sst s.a.s', 'Serso outsourcing sst s.a.s', NULL, 'facturaelectronicaserso@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-04-20 11:02:34', NULL, NULL, NULL, NULL),
(244, 1, NULL, 1, 8, '1045686209', 0, 'Gil segovia alexis de jesus - ag inspector hse', 'Gil segovia alexis de jesus - ag inspector hse', NULL, 'alexisgils201526@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-04-27 14:33:52', NULL, NULL, NULL, NULL),
(245, 1, NULL, 1, 8, '8692613', 0, 'Cavallo ibañez giovanni eugenio', 'Cavallo ibañez giovanni eugenio', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-04 14:51:21', NULL, NULL, NULL, NULL),
(246, 1, NULL, 1, 8, '32677202', 0, 'Abuchaibe costa jannette alicia', 'Abuchaibe costa jannette alicia', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-04 16:44:08', NULL, NULL, NULL, NULL),
(247, 1, NULL, 1, 8, '900399741', 0, 'Facture s.a.s.', 'Facture s.a.s.', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-12 11:27:10', NULL, NULL, NULL, NULL),
(248, 1, NULL, 1, 8, '72165812', 0, 'Chapman matera regulo ignacio', 'Chapman matera regulo ignacio', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-14 16:21:39', NULL, NULL, NULL, NULL),
(249, 1, NULL, 1, 8, '72276738', 0, 'Niebles de la cruz alberto carlos - mundo electrico barranquilla', 'Niebles de la cruz alberto carlos - mundo electrico barranquilla', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-14 16:58:18', NULL, NULL, NULL, NULL),
(250, 1, NULL, 1, 8, '1129510812', 0, 'Coneo polo eloisa', 'Coneo polo eloisa', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-21 19:43:55', NULL, NULL, NULL, NULL),
(251, 1, NULL, 1, 8, '1143441510', 0, 'Mendoza ochoa kevin de jesus', 'Mendoza ochoa kevin de jesus', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-05-22 16:26:03', NULL, NULL, NULL, NULL),
(252, 1, NULL, 1, 8, '901174712', 0, 'Comercializadora in.venta sas', 'Comercializadora in.venta sas', NULL, 'in.ventacomer@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-06-01 10:58:02', NULL, NULL, NULL, NULL),
(253, 1, NULL, 1, 8, '1023009669', 0, 'Boyaca campo victor stiven', 'Boyaca campo victor stiven', NULL, 'stivenvibo@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Elementos aseo', '', NULL, '', '2020-06-18 17:05:40', NULL, NULL, NULL, NULL),
(254, 1, NULL, 1, 8, '900374992', 0, 'Dlc colombia s.a.s', 'Dlc colombia s.a.s', NULL, 'contador.rattanholding@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Pruebas rapidas covid 19', '', NULL, '', '2020-06-18 17:35:19', NULL, NULL, NULL, NULL),
(255, 1, NULL, 1, 8, '1042439000', 0, 'Gonzalez rudas ronald ely', 'Gonzalez rudas ronald ely', NULL, 'rgonzalezrudas@gmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Mtto neveras, aires', '', NULL, '', '2020-06-19 09:35:46', NULL, NULL, NULL, NULL),
(256, 1, NULL, 1, 8, '1129581489', 0, 'Mendoza diaz yojaira - soportes aba', 'Mendoza diaz yojaira', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Soporte gel', '', NULL, '', '2020-06-19 14:30:06', NULL, NULL, NULL, NULL),
(257, 1, NULL, 1, 8, '72273674', 0, 'Cueto diaz onan', 'Cueto diaz onan', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-06-30 12:20:19', NULL, NULL, NULL, NULL),
(258, 1, NULL, 1, 8, '900636624', 0, 'Mi pc soluciones it s.a.s.', 'Mi pc soluciones it s.a.s.', NULL, 'soporte@mipc-soluciones.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-07-01 11:16:05', NULL, NULL, NULL, NULL),
(259, 1, NULL, 1, 8, '900565614', 0, 'Inversiones guevara s.a.s', 'Inversiones guevara s.a.s', NULL, 'camila.bernal@inverguevara.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, '', '', NULL, '', '2020-07-07 17:16:07', NULL, NULL, NULL, NULL),
(260, 1, NULL, 1, 8, '72285597', 0, 'Lopez cardona luis carlos - tecnonacho supplies and services', 'Lopez cardona luis carlos - tecnonacho supplies and services', NULL, '', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor elementos de computacion y comunicacion', '', NULL, '', '2020-07-10 17:50:10', NULL, NULL, NULL, NULL),
(261, 1, NULL, 1, 8, '811028717', 6, 'Hummalab s.a.', 'Humalab', NULL, 'hummalab33@hotmail.com', NULL, 1, 60, 100000000, 0, 2, '', '1900-12-31', '4690', '4645', NULL, NULL, 'Proveedor de insumos, pruebas rápidas y reactivos. \r\ndistribuidor de líneas albor, bd, nipro, ctk, comprolab', 'Bancolombia', NULL, '005-070722-12', '2016-04-26 15:50:00', NULL, NULL, NULL, NULL),
(262, 1, NULL, 1, 8, '901097041', 0, 'Importadora mafelam limitada', 'Importadora mafelam limitada', NULL, 'kateinv_@hotmail.com', NULL, 0, 0, 0, 0, 0, '', '0000-00-00', '', '', NULL, NULL, 'Proveedor epp', '', NULL, '', '2020-07-23 18:03:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas_domicilio`
--

CREATE TABLE `rutas_domicilio` (
  `id_rutas_domicilio` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `intervalo` varchar(45) DEFAULT NULL COMMENT '''minutos''',
  `id_tecnico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `rutas_domicilio`
--

INSERT INTO `rutas_domicilio` (`id_rutas_domicilio`, `descripcion`, `valor`, `id_ciudad`, `hora_inicio`, `hora_fin`, `intervalo`, `id_tecnico`) VALUES
(1, 'Esta es una ruta de ejemplo', 15000, 20574, '15:33:18', '14:33:18', '20', 461),
(9, 'descripcion', 15000, 118, '09:14:00', '09:14:00', '20', 461),
(10, 'esta es mi primera rut', 15000, 20574, '14:15:00', '14:15:00', '20', 461);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_adicional`
--

CREATE TABLE `servicio_adicional` (
  `id_servicio_adicional` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio_adicional`
--

INSERT INTO `servicio_adicional` (`id_servicio_adicional`, `descripcion`, `valor`) VALUES
(1, 'primer servicio', 3243525),
(2, 'segundo servicio 200', 12000),
(5, 'Mi primera vez', 15000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id_tarifas` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_unidad_medida` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contacto`
--

CREATE TABLE `tipo_contacto` (
  `id_tipo_contacto` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_contacto`
--

INSERT INTO `tipo_contacto` (`id_tipo_contacto`, `descripcion`) VALUES
(4, 'hola mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_crm`
--

CREATE TABLE `tipo_crm` (
  `id_tipo_crm` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_crm`
--

INSERT INTO `tipo_crm` (`id_tipo_crm`, `descripcion`) VALUES
(4, 'hola de nuevo bb'),
(5, 'weewrew');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento_contable`
--

CREATE TABLE `tipo_documento_contable` (
  `id_tipo_documento_contable` int(11) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `id_tipo_notas_contables` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_documento_contable`
--

INSERT INTO `tipo_documento_contable` (`id_tipo_documento_contable`, `descripcion`, `id_tipo_notas_contables`) VALUES
(1, 'mi primera tipo de nota contable', 1),
(2, 'Mi segundo tipo de nota contable', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_linea_producto`
--

CREATE TABLE `tipo_linea_producto` (
  `id_tipo_linea_producto` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_linea_producto`
--

INSERT INTO `tipo_linea_producto` (`id_tipo_linea_producto`, `nombre`, `estado`) VALUES
(1, 'Producto', 1),
(2, 'Servicio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_notas_contables`
--

CREATE TABLE `tipo_notas_contables` (
  `id_tipo_notas_contables` int(11) NOT NULL,
  `nombre` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_notas_contables`
--

INSERT INTO `tipo_notas_contables` (`id_tipo_notas_contables`, `nombre`) VALUES
(1, 'Nota Crédito'),
(2, 'Nota Débito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_procedencias`
--

CREATE TABLE `tipo_procedencias` (
  `id_tipo_procedencias` int(11) NOT NULL,
  `name` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_procedencias`
--

INSERT INTO `tipo_procedencias` (`id_tipo_procedencias`, `name`) VALUES
(1, 'General'),
(2, 'Maquilas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_empaque`
--

CREATE TABLE `unidad_empaque` (
  `id_unidad_empaque` int(11) NOT NULL,
  `nombre` varchar(245) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `unidad_empaque`
--

INSERT INTO `unidad_empaque` (`id_unidad_empaque`, `nombre`, `estado`) VALUES
(1, 'mi primera unidad de empaque .', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_unidad_medida` int(11) NOT NULL,
  `id_categoria_umd` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `simbolo` char(2) DEFAULT NULL,
  `factor` float DEFAULT NULL,
  `redondeo` int(11) DEFAULT NULL,
  `conversion` varchar(45) DEFAULT NULL COMMENT 'cantidad de decimales a mostar',
  `cantidad_decimal` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_unidad_medida`, `id_categoria_umd`, `nombre`, `simbolo`, `factor`, `redondeo`, `conversion`, `cantidad_decimal`, `estado`) VALUES
(1, 3, 'Metro', 'm', 100, 0, '0', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_seguimiento`
--
ALTER TABLE `actividad_seguimiento`
  ADD PRIMARY KEY (`id_actividad_seguimiento`);

--
-- Indices de la tabla `areas_laboratorio`
--
ALTER TABLE `areas_laboratorio`
  ADD PRIMARY KEY (`id_areas_laboratorio`);

--
-- Indices de la tabla `asesores_comerciales`
--
ALTER TABLE `asesores_comerciales`
  ADD PRIMARY KEY (`id_asesores_comerciales`);

--
-- Indices de la tabla `asignacion_productos_examenes`
--
ALTER TABLE `asignacion_productos_examenes`
  ADD PRIMARY KEY (`id_asignacion_productos_examenes`);

--
-- Indices de la tabla `asignacion_pruebas_empleados`
--
ALTER TABLE `asignacion_pruebas_empleados`
  ADD PRIMARY KEY (`id_asignacion_pruebas_empleados`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id_bodegas`);

--
-- Indices de la tabla `canal_informacion`
--
ALTER TABLE `canal_informacion`
  ADD PRIMARY KEY (`id_canal_informacion`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargos`);

--
-- Indices de la tabla `categorias_clinicas`
--
ALTER TABLE `categorias_clinicas`
  ADD PRIMARY KEY (`id_categorias_clinicas`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id_categoria_producto`);

--
-- Indices de la tabla `categoria_umd`
--
ALTER TABLE `categoria_umd`
  ADD PRIMARY KEY (`id_categoria_umd`);

--
-- Indices de la tabla `centros_costos`
--
ALTER TABLE `centros_costos`
  ADD PRIMARY KEY (`id_centros_costos`);

--
-- Indices de la tabla `centro_medico`
--
ALTER TABLE `centro_medico`
  ADD PRIMARY KEY (`id_centro_medico`);

--
-- Indices de la tabla `conservacion`
--
ALTER TABLE `conservacion`
  ADD PRIMARY KEY (`id_conservacion`);

--
-- Indices de la tabla `costos_fijos`
--
ALTER TABLE `costos_fijos`
  ADD PRIMARY KEY (`id_costos_fijos`);

--
-- Indices de la tabla `costos_indirectos_fabricacion`
--
ALTER TABLE `costos_indirectos_fabricacion`
  ADD PRIMARY KEY (`id_costos_indirectos_fabricacion`);

--
-- Indices de la tabla `descripcion_costo`
--
ALTER TABLE `descripcion_costo`
  ADD PRIMARY KEY (`id_descripcion_costo`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresas`);

--
-- Indices de la tabla `entidades_bancarias`
--
ALTER TABLE `entidades_bancarias`
  ADD PRIMARY KEY (`id_entidades_bancarias`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `especialidad_medica`
--
ALTER TABLE `especialidad_medica`
  ADD PRIMARY KEY (`id_especialidad_medica`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id_examenes`);

--
-- Indices de la tabla `frecuencia_compra`
--
ALTER TABLE `frecuencia_compra`
  ADD PRIMARY KEY (`id_frecuencia_compra`);

--
-- Indices de la tabla `grupo_clientes`
--
ALTER TABLE `grupo_clientes`
  ADD PRIMARY KEY (`id_grupo_clientes`);

--
-- Indices de la tabla `identificacion_empresa`
--
ALTER TABLE `identificacion_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `info_day_kit`
--
ALTER TABLE `info_day_kit`
  ADD PRIMARY KEY (`id_info_day_kit`);

--
-- Indices de la tabla `info_kit`
--
ALTER TABLE `info_kit`
  ADD PRIMARY KEY (`id_info_kit`);

--
-- Indices de la tabla `info_kit_has_sedes`
--
ALTER TABLE `info_kit_has_sedes`
  ADD PRIMARY KEY (`info_kit_id_info_kit`,`sedes_id_sedes`);

--
-- Indices de la tabla `info_live_kit`
--
ALTER TABLE `info_live_kit`
  ADD PRIMARY KEY (`id_info_live_kit`);

--
-- Indices de la tabla `mano_obra_directa`
--
ALTER TABLE `mano_obra_directa`
  ADD PRIMARY KEY (`id_mano_obra_directa`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marcas`);

--
-- Indices de la tabla `motivos_glosas`
--
ALTER TABLE `motivos_glosas`
  ADD PRIMARY KEY (`id_motivos_glosas`);

--
-- Indices de la tabla `motivos_pqr`
--
ALTER TABLE `motivos_pqr`
  ADD PRIMARY KEY (`id_motivos_pqr`);

--
-- Indices de la tabla `motivos_seguimiento`
--
ALTER TABLE `motivos_seguimiento`
  ADD PRIMARY KEY (`id_motivos_seguimiento`);

--
-- Indices de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  ADD PRIMARY KEY (`id_procedencias`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`);

--
-- Indices de la tabla `rutas_domicilio`
--
ALTER TABLE `rutas_domicilio`
  ADD PRIMARY KEY (`id_rutas_domicilio`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `servicio_adicional`
--
ALTER TABLE `servicio_adicional`
  ADD PRIMARY KEY (`id_servicio_adicional`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id_tarifas`);

--
-- Indices de la tabla `tipo_contacto`
--
ALTER TABLE `tipo_contacto`
  ADD PRIMARY KEY (`id_tipo_contacto`);

--
-- Indices de la tabla `tipo_crm`
--
ALTER TABLE `tipo_crm`
  ADD PRIMARY KEY (`id_tipo_crm`);

--
-- Indices de la tabla `tipo_documento_contable`
--
ALTER TABLE `tipo_documento_contable`
  ADD PRIMARY KEY (`id_tipo_documento_contable`);

--
-- Indices de la tabla `tipo_linea_producto`
--
ALTER TABLE `tipo_linea_producto`
  ADD PRIMARY KEY (`id_tipo_linea_producto`);

--
-- Indices de la tabla `tipo_notas_contables`
--
ALTER TABLE `tipo_notas_contables`
  ADD PRIMARY KEY (`id_tipo_notas_contables`);

--
-- Indices de la tabla `tipo_procedencias`
--
ALTER TABLE `tipo_procedencias`
  ADD PRIMARY KEY (`id_tipo_procedencias`);

--
-- Indices de la tabla `unidad_empaque`
--
ALTER TABLE `unidad_empaque`
  ADD PRIMARY KEY (`id_unidad_empaque`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_unidad_medida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad_seguimiento`
--
ALTER TABLE `actividad_seguimiento`
  MODIFY `id_actividad_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `areas_laboratorio`
--
ALTER TABLE `areas_laboratorio`
  MODIFY `id_areas_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `asesores_comerciales`
--
ALTER TABLE `asesores_comerciales`
  MODIFY `id_asesores_comerciales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion_productos_examenes`
--
ALTER TABLE `asignacion_productos_examenes`
  MODIFY `id_asignacion_productos_examenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `asignacion_pruebas_empleados`
--
ALTER TABLE `asignacion_pruebas_empleados`
  MODIFY `id_asignacion_pruebas_empleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id_bodegas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `canal_informacion`
--
ALTER TABLE `canal_informacion`
  MODIFY `id_canal_informacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias_clinicas`
--
ALTER TABLE `categorias_clinicas`
  MODIFY `id_categorias_clinicas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria_umd`
--
ALTER TABLE `categoria_umd`
  MODIFY `id_categoria_umd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `centros_costos`
--
ALTER TABLE `centros_costos`
  MODIFY `id_centros_costos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `centro_medico`
--
ALTER TABLE `centro_medico`
  MODIFY `id_centro_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `conservacion`
--
ALTER TABLE `conservacion`
  MODIFY `id_conservacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `costos_fijos`
--
ALTER TABLE `costos_fijos`
  MODIFY `id_costos_fijos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `costos_indirectos_fabricacion`
--
ALTER TABLE `costos_indirectos_fabricacion`
  MODIFY `id_costos_indirectos_fabricacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `descripcion_costo`
--
ALTER TABLE `descripcion_costo`
  MODIFY `id_descripcion_costo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entidades_bancarias`
--
ALTER TABLE `entidades_bancarias`
  MODIFY `id_entidades_bancarias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad_medica`
--
ALTER TABLE `especialidad_medica`
  MODIFY `id_especialidad_medica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id_examenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1186;

--
-- AUTO_INCREMENT de la tabla `frecuencia_compra`
--
ALTER TABLE `frecuencia_compra`
  MODIFY `id_frecuencia_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupo_clientes`
--
ALTER TABLE `grupo_clientes`
  MODIFY `id_grupo_clientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `info_day_kit`
--
ALTER TABLE `info_day_kit`
  MODIFY `id_info_day_kit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `info_kit`
--
ALTER TABLE `info_kit`
  MODIFY `id_info_kit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `info_live_kit`
--
ALTER TABLE `info_live_kit`
  MODIFY `id_info_live_kit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mano_obra_directa`
--
ALTER TABLE `mano_obra_directa`
  MODIFY `id_mano_obra_directa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marcas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivos_glosas`
--
ALTER TABLE `motivos_glosas`
  MODIFY `id_motivos_glosas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `motivos_pqr`
--
ALTER TABLE `motivos_pqr`
  MODIFY `id_motivos_pqr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `motivos_seguimiento`
--
ALTER TABLE `motivos_seguimiento`
  MODIFY `id_motivos_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  MODIFY `id_procedencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1454;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT COMMENT '1 NACIONAL\n2 INTERNACIONAL', AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `rutas_domicilio`
--
ALTER TABLE `rutas_domicilio`
  MODIFY `id_rutas_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_adicional`
--
ALTER TABLE `servicio_adicional`
  MODIFY `id_servicio_adicional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id_tarifas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_contacto`
--
ALTER TABLE `tipo_contacto`
  MODIFY `id_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_crm`
--
ALTER TABLE `tipo_crm`
  MODIFY `id_tipo_crm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_documento_contable`
--
ALTER TABLE `tipo_documento_contable`
  MODIFY `id_tipo_documento_contable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_linea_producto`
--
ALTER TABLE `tipo_linea_producto`
  MODIFY `id_tipo_linea_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_notas_contables`
--
ALTER TABLE `tipo_notas_contables`
  MODIFY `id_tipo_notas_contables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_procedencias`
--
ALTER TABLE `tipo_procedencias`
  MODIFY `id_tipo_procedencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unidad_empaque`
--
ALTER TABLE `unidad_empaque`
  MODIFY `id_unidad_empaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id_unidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

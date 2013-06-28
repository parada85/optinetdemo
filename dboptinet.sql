-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-06-2013 a las 16:37:42
-- Versión del servidor: 5.5.31
-- Versión de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dboptinet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Arqueo`
--

CREATE TABLE IF NOT EXISTS `Arqueo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `fechaarqueo` datetime NOT NULL,
  `efectivo` double NOT NULL,
  `efectivocont` double NOT NULL,
  `boletas` int(11) NOT NULL,
  `boletascont` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B2EA45AC952BE730` (`empleado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Arqueo`
--

INSERT INTO `Arqueo` (`id`, `empleado_id`, `fechaarqueo`, `efectivo`, `efectivocont`, `boletas`, `boletascont`, `estado`) VALUES
(1, 4, '2013-06-24 15:59:27', 313.35, 313, 4, 4, 1),
(2, 2, '2013-06-25 16:10:50', 254.33, 254.32999999999998, 5, 4, 0),
(3, 4, '2013-06-26 16:15:47', 98.34, 95.34, 3, 3, 0),
(5, 5, '2013-06-27 16:37:29', 51.7, 51.07, 8, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cita`
--

CREATE TABLE IF NOT EXISTS `Cita` (
  `id` int(11) NOT NULL,
  `medico_id` int(11) DEFAULT NULL,
  `fechacita` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9E05355CA7FB1C0C` (`medico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cita`
--

INSERT INTO `Cita` (`id`, `medico_id`, `fechacita`) VALUES
(3, 4, '2013-06-25 09:00:00'),
(4, 4, '2013-06-25 10:00:00'),
(5, 5, '2013-06-25 11:00:00'),
(6, 5, '2013-06-25 09:30:00'),
(7, 4, '2013-06-25 10:30:00'),
(8, 4, '2013-06-26 09:30:00'),
(9, 4, '2013-06-27 10:00:00'),
(19, 4, '2013-06-27 10:30:00'),
(20, 5, '2013-06-27 09:00:00'),
(21, 5, '2013-06-27 11:00:00'),
(26, 4, '2013-06-27 09:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Devolucion`
--

CREATE TABLE IF NOT EXISTS `Devolucion` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `total` double NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D109CB7F2A5805D` (`venta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Devolucion`
--

INSERT INTO `Devolucion` (`id`, `venta_id`, `total`, `descripcion`) VALUES
(12, 10, 5.67, 'defectuoso de origen'),
(25, 11, 43.33, '...'),
(39, 37, 111, '...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `idioma` varchar(7) NOT NULL,
  `tema` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `apellido1` varchar(255) NOT NULL,
  `apellido2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `claveusuario` varchar(255) NOT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `movil` varchar(9) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `tipo1` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D9D9BF527F8F253B` (`dni`),
  UNIQUE KEY `UNIQ_D9D9BF52F85E0677` (`username`),
  UNIQUE KEY `UNIQ_D9D9BF52E7927C74` (`email`),
  KEY `IDX_D9D9BF52D60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `role_id`, `dni`, `nombre`, `idioma`, `tema`, `username`, `apellido1`, `apellido2`, `email`, `localidad`, `provincia`, `claveusuario`, `telefono`, `movil`, `password`, `salt`, `direccion`, `fechaalta`, `activo`, `tipo1`) VALUES
(1, 1, '89653852x', 'José Ángel', 'es', 'cobalt', 'joseangel', 'Parada', 'Jiménez', 'paradajimenez85@gmail.com', 'San fernando', 'Cádiz', 'lNwc7VWSO4Fielon9OiK', '956890882', '625038674', 'qXoSRAnJrhSIwgCCLgNmuuW4fWI=', '6a5ab0fa45e427b1abda16ddd2da6251', 'Al andalus 13 6º A', '2013-06-24 15:51:07', 1, 'empleado'),
(2, 2, '69881840x', 'José', 'es', 'aristo', 'jose', 'Parada', 'Payero', 'paradita85@gmail.com', 'San fernando', 'Cádiz', 'wtuDyJ7zbdk4FCA5j1yP', '956890882', '665540839', 'VelyUzujZbzXFjZjy2UupUaik+E=', '6a5ab0fa45e427b1abda16ddd2da6251', 'Al andalus 13 6º A', '2013-06-24 15:51:07', 1, 'empleado'),
(3, 2, '19640506i', 'Rosario', 'en', 'cobalt', 'rosario', 'Jiménez', 'Padilla', 'parada85@hotmail.es', 'San fernando', 'Cádiz', '4vreN98bF5RvuEjYEMWW', '956890882', '654343536', 'OUwVfrqJPg6EFG5oCoFoabHpXok=', '6a5ab0fa45e427b1abda16ddd2da6251', 'Al andalus 13 6º A', '2013-06-24 15:51:07', 1, 'empleado'),
(4, 3, '10024466m', 'Juan', 'es', 'cobalt', 'juan', 'Ramirez', 'Lopez', 'medico1optinet@gmail.com', 'San fernando', 'Cadiz', '5pzZjtHGJEf7CSJYYxlV', '956098765', '625988776', 'NpPvulMBBg/ugbl7YzjUTL1XZ+s=', '6a5ab0fa45e427b1abda16ddd2da6251', 'Calle malaspina 1º A', '2013-06-24 15:51:07', 1, 'medico'),
(5, 3, '22282642t', 'Pedro', 'es', 'aristo', 'pedro', 'Callealta', 'Gonzalez', 'medico2optinet@gmail.com', 'San fernando', 'Cadiz', 'xAeOrx3jjuVQcIuLjaEY', '956768795', '625918356', 'DsWwVcdx+U2AqK7HQfx09M59TVg=', '6a5ab0fa45e427b1abda16ddd2da6251', 'Calle bienvenida 2º D', '2013-06-24 15:51:07', 1, 'medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Familia`
--

CREATE TABLE IF NOT EXISTS `Familia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91D4FBD33A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Familia`
--

INSERT INTO `Familia` (`id`, `nombre`) VALUES
(4, 'Accesorios'),
(3, 'Gafas sol'),
(1, 'Lentillas'),
(5, 'Limpiadores'),
(2, 'Monturas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Festivo`
--

CREATE TABLE IF NOT EXISTS `Festivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Festivo`
--

INSERT INTO `Festivo` (`id`, `fecha`) VALUES
(1, '2013-06-28 09:00:00'),
(2, '2013-07-05 09:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Informe`
--

CREATE TABLE IF NOT EXISTS `Informe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cita_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `odavsc` varchar(255) DEFAULT NULL,
  `odavcc` varchar(255) DEFAULT NULL,
  `odesf` varchar(255) DEFAULT NULL,
  `odcil` varchar(255) DEFAULT NULL,
  `odeje` varchar(255) DEFAULT NULL,
  `odav` varchar(255) DEFAULT NULL,
  `oiavsc` varchar(255) DEFAULT NULL,
  `oiavcc` varchar(255) DEFAULT NULL,
  `oiesf` varchar(255) DEFAULT NULL,
  `oicil` varchar(255) DEFAULT NULL,
  `oieje` varchar(255) DEFAULT NULL,
  `oiav` varchar(255) DEFAULT NULL,
  `problema` varchar(255) NOT NULL,
  `pupilar` varchar(255) NOT NULL,
  `worth` varchar(255) NOT NULL,
  `Amsler` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B1C8D8451E011DDF` (`cita_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Informe`
--

INSERT INTO `Informe` (`id`, `cita_id`, `fecha`, `odavsc`, `odavcc`, `odesf`, `odcil`, `odeje`, `odav`, `oiavsc`, `oiavcc`, `oiesf`, `oicil`, `oieje`, `oiav`, `problema`, `pupilar`, `worth`, `Amsler`) VALUES
(1, 26, '2013-06-26 16:14:04', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Miopia', 'Normal', 'Normal', 'Normal'),
(2, 19, '2013-06-26 16:14:27', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', 'Presbicia', 'Normal', 'Normal', 'Normal'),
(3, 9, '2013-06-26 16:14:54', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Presbicia', 'Alterada', 'Alterada', 'Alterada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lineasoperacion`
--

CREATE TABLE IF NOT EXISTS `Lineasoperacion` (
  `producto_id` int(11) NOT NULL,
  `operacion_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `pcompra` double NOT NULL,
  `iva` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`operacion_id`),
  KEY `IDX_80D0C6677645698E` (`producto_id`),
  KEY `IDX_80D0C667E6D597C3` (`operacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Lineasoperacion`
--

INSERT INTO `Lineasoperacion` (`producto_id`, `operacion_id`, `cantidad`, `precio`, `pcompra`, `iva`, `estado`) VALUES
(1, 14, 1, 39.66, 20.33, 18, NULL),
(2, 2, 1, 78, 33.33, 8, NULL),
(2, 11, 1, 78, 33.33, 8, NULL),
(2, 13, 2, 78, 33.33, 8, NULL),
(2, 16, 2, 78, 33.33, 8, NULL),
(3, 2, 2, 5.67, 5, 21, NULL),
(3, 10, 2, 5.67, 5, 21, NULL),
(3, 12, 1, 5.67, 5, 21, 'malo'),
(3, 18, 2, 5.67, 5, 21, NULL),
(3, 24, 5, 5.67, 5, 21, NULL),
(3, 38, 2, 5.67, 5, 21, NULL),
(4, 1, 2, 86.67, 20.67, 18, NULL),
(4, 2, 1, 86.67, 20.67, 18, NULL),
(4, 10, 1, 86.67, 20.67, 18, NULL),
(4, 23, 3, 86.67, 20.67, 18, NULL),
(4, 30, 2, 86.67, 20.67, 18, NULL),
(5, 24, 3, 90.33, 29, 8, NULL),
(5, 30, 3, 90.33, 29, 8, NULL),
(5, 31, 1, 90.33, 29, 8, NULL),
(6, 24, 1, 4.33, 2.33, 21, NULL),
(7, 22, 2, 52.67, 20, 18, NULL),
(7, 28, 2, 52.67, 20, 18, NULL),
(7, 31, 1, 52.67, 20, 18, NULL),
(8, 31, 1, 55.66, 12.33, 21, NULL),
(10, 32, 5, 20.34, 9.67, 4, NULL),
(10, 35, 5, 20.34, 9.67, 4, NULL),
(12, 27, 1, 59.33, 6, 18, NULL),
(12, 38, 1, 59.33, 6, 18, NULL),
(13, 1, 1, 45.34, 2.67, 8, NULL),
(13, 36, 1, 45.34, 2.67, 8, NULL),
(14, 36, 2, 37, 1, 18, NULL),
(14, 37, 3, 37, 1, 18, NULL),
(14, 39, 3, 37, 1, 18, 'bueno'),
(15, 13, 1, 67.67, 31, 18, NULL),
(15, 36, 3, 67.67, 31, 18, NULL),
(17, 27, 2, 41, 10.33, 18, NULL),
(17, 37, 1, 41, 10.33, 18, NULL),
(21, 31, 1, 14.67, 4, 21, NULL),
(26, 11, 1, 43.33, 31.33, 18, NULL),
(26, 16, 1, 43.33, 31.33, 18, NULL),
(26, 25, 1, 43.33, 31.33, 18, 'bueno'),
(27, 15, 2, 71.67, 29.67, 4, NULL),
(27, 29, 2, 71.67, 29.67, 4, NULL),
(28, 14, 1, 84.34, 19.67, 8, NULL),
(28, 18, 2, 84.34, 19.67, 8, NULL),
(35, 38, 1, 74.34, 15.67, 8, NULL),
(46, 17, 3, 51, 17, 4, NULL),
(46, 33, 2, 51, 17, 4, NULL),
(46, 34, 2, 51, 17, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lineaspedido`
--

CREATE TABLE IF NOT EXISTS `Lineaspedido` (
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `iva` int(11) NOT NULL,
  PRIMARY KEY (`pedido_id`,`producto_id`),
  KEY `IDX_810B9754854653A` (`pedido_id`),
  KEY `IDX_810B9757645698E` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Lineaspedido`
--

INSERT INTO `Lineaspedido` (`pedido_id`, `producto_id`, `cantidad`, `precio`, `iva`) VALUES
(1, 10, 10, 9.67, 4),
(1, 46, 10, 17, 4),
(1, 48, 10, 19.67, 4),
(2, 36, 10, 28, 21),
(2, 52, 20, 25.67, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log`
--

CREATE TABLE IF NOT EXISTS `Log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `fechalog` datetime NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B7722E25952BE730` (`empleado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `Log`
--

INSERT INTO `Log` (`id`, `empleado_id`, `fechalog`, `tipo`) VALUES
(1, 2, '2013-06-24 15:51:50', 'Entrada'),
(2, 2, '2013-06-24 15:54:37', 'Salida'),
(3, 3, '2013-06-24 15:54:43', 'Entrada'),
(4, 3, '2013-06-24 15:56:21', 'Salida'),
(5, 4, '2013-06-24 15:56:25', 'Entrada'),
(6, 4, '2013-06-24 15:59:30', 'Salida'),
(7, 3, '2013-06-25 15:59:51', 'Entrada'),
(8, 3, '2013-06-25 16:02:03', 'Salida'),
(9, 2, '2013-06-25 16:02:07', 'Entrada'),
(10, 2, '2013-06-25 16:02:32', 'Salida'),
(11, 1, '2013-06-25 16:02:37', 'Entrada'),
(12, 1, '2013-06-25 16:09:45', 'Salida'),
(13, 2, '2013-06-25 16:09:50', 'Entrada'),
(14, 2, '2013-06-25 16:10:54', 'Salida'),
(15, 2, '2013-06-26 16:11:12', 'Entrada'),
(16, 2, '2013-06-26 16:13:35', 'Salida'),
(17, 4, '2013-06-26 16:13:40', 'Entrada'),
(18, 4, '2013-06-26 16:15:52', 'Salida'),
(19, 2, '2013-06-27 16:16:09', 'Entrada'),
(20, 2, '2013-06-27 16:19:22', 'Salida'),
(21, 3, '2013-06-27 16:19:30', 'Entrada'),
(22, 3, '2013-06-27 16:21:41', 'Salida'),
(23, 1, '2013-06-27 16:35:07', 'Entrada'),
(24, 1, '2013-06-27 16:36:01', 'Salida'),
(25, 5, '2013-06-27 16:36:05', 'Entrada'),
(26, 5, '2013-06-27 16:37:33', 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `id` int(11) NOT NULL,
  `titulacion` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_34E5914C665648E9` (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id`, `titulacion`, `numero`, `color`) VALUES
(4, 'Grado en Óptica', '16972', '#1153ed'),
(5, 'Diplomatira en Óptica', '14378', '#8e39e3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Modificacion`
--

CREATE TABLE IF NOT EXISTS `Modificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `fechamod` datetime NOT NULL,
  `entidad` varchar(255) NOT NULL,
  `identificador` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3A9B910C952BE730` (`empleado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=235 ;

--
-- Volcado de datos para la tabla `Modificacion`
--

INSERT INTO `Modificacion` (`id`, `empleado_id`, `fechamod`, `entidad`, `identificador`, `tipo`, `info`) VALUES
(1, NULL, '2013-06-24 15:51:07', 'Empleado', '1', 'Inserción', ''),
(2, NULL, '2013-06-24 15:51:07', 'Empleado', '1', 'Inserción', ''),
(3, NULL, '2013-06-24 15:51:07', 'Empleado', '1', 'Inserción', ''),
(4, NULL, '2013-06-24 15:51:07', 'Medico', '1', 'Inserción', ''),
(5, NULL, '2013-06-24 15:51:07', 'Medico', '1', 'Inserción', ''),
(6, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(7, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(8, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(9, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(10, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(11, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(12, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(13, NULL, '2013-06-24 15:51:07', 'Proveedor', '1', 'Inserción', ''),
(14, NULL, '2013-06-24 15:51:07', 'Familia', '1', 'Inserción', ''),
(15, NULL, '2013-06-24 15:51:07', 'Familia', '1', 'Inserción', ''),
(16, NULL, '2013-06-24 15:51:07', 'Familia', '1', 'Inserción', ''),
(17, NULL, '2013-06-24 15:51:07', 'Familia', '1', 'Inserción', ''),
(18, NULL, '2013-06-24 15:51:07', 'Familia', '1', 'Inserción', ''),
(19, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(20, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(21, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(22, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(23, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(24, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(25, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(26, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(27, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(28, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(29, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(30, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(31, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(32, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(33, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(34, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(35, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(36, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(37, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(38, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(39, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(40, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(41, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(42, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(43, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(44, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(45, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(46, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(47, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(48, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(49, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(50, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(51, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(52, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(53, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(54, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(55, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(56, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(57, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(58, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(59, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(60, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(61, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(62, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(63, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(64, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(65, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(66, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(67, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(68, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(69, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(70, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(71, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(72, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(73, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(74, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(75, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(76, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(77, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(78, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(79, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(80, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(81, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(82, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(83, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(84, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(85, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(86, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(87, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(88, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(89, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(90, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(91, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(92, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(93, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(94, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(95, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(96, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(97, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(98, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(99, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(100, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(101, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(102, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(103, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(104, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(105, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(106, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(107, NULL, '2013-06-24 15:51:07', 'Producto', '1', 'Inserción', ''),
(108, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(109, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(110, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(111, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(112, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(113, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(114, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(115, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(116, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(117, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(118, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(119, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(120, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(121, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(122, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(123, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(124, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(125, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(126, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(127, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(128, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(129, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(130, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(131, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(132, NULL, '2013-06-24 15:51:07', 'Usuario', '1', 'Inserción', ''),
(133, 2, '2013-06-24 15:52:14', 'Venta', '1', 'Inserción', 'Total:218.68 €'),
(134, 2, '2013-06-24 15:52:14', 'Producto', '13', 'Modificación', 'stock:182 181 '),
(135, 2, '2013-06-24 15:52:14', 'Producto', '4', 'Modificación', 'stock:182 180 '),
(136, 2, '2013-06-24 15:52:49', 'Venta', '2', 'Inserción', 'Total:176.01 €'),
(137, 2, '2013-06-24 15:52:49', 'Producto', '2', 'Modificación', 'stock:80 79 '),
(138, 2, '2013-06-24 15:52:49', 'Producto', '3', 'Modificación', 'stock:126 124 '),
(139, 2, '2013-06-24 15:52:49', 'Producto', '4', 'Modificación', 'stock:180 179 '),
(140, 2, '2013-06-24 15:53:03', 'Cita', '3', 'Inserción', ''),
(141, 2, '2013-06-24 15:53:07', 'Cita', '4', 'Inserción', ''),
(142, 2, '2013-06-24 15:53:12', 'Cita', '5', 'Inserción', ''),
(143, 2, '2013-06-24 15:53:22', 'Cita', '6', 'Inserción', ''),
(144, 2, '2013-06-24 15:53:29', 'Cita', '7', 'Inserción', ''),
(145, 2, '2013-06-24 15:54:05', 'Cita', '8', 'Inserción', ''),
(146, 2, '2013-06-24 15:54:09', 'Cita', '9', 'Inserción', ''),
(147, 2, '2013-06-24 15:54:27', 'Venta', '10', 'Inserción', 'Total:98.01 €'),
(148, 2, '2013-06-24 15:54:27', 'Producto', '4', 'Modificación', 'stock:179 178 '),
(149, 2, '2013-06-24 15:54:27', 'Producto', '3', 'Modificación', 'stock:124 122 '),
(150, 3, '2013-06-24 15:55:04', 'Venta', '11', 'Inserción', 'Total:121.33 €'),
(151, 3, '2013-06-24 15:55:04', 'Producto', '2', 'Modificación', 'stock:79 78 '),
(152, 3, '2013-06-24 15:55:04', 'Producto', '26', 'Modificación', 'stock:51 50 '),
(153, 3, '2013-06-24 15:55:42', 'Devolucion', '12', 'Inserción', 'Total:5.67 €'),
(154, 3, '2013-06-24 15:56:09', 'Venta', '13', 'Inserción', 'Total:223.67 €'),
(155, 3, '2013-06-24 15:56:09', 'Producto', '2', 'Modificación', 'stock:78 76 '),
(156, 3, '2013-06-24 15:56:09', 'Producto', '15', 'Modificación', 'stock:75 74 '),
(157, 4, '2013-06-24 15:56:42', 'Venta', '14', 'Inserción', 'Total:124 €'),
(158, 4, '2013-06-24 15:56:42', 'Producto', '1', 'Modificación', 'stock:49 48 '),
(159, 4, '2013-06-24 15:56:42', 'Producto', '28', 'Modificación', 'stock:135 134 '),
(160, 4, '2013-06-24 15:57:11', 'Reserva', '15', 'Inserción', 'Total:143.34 €'),
(161, 4, '2013-06-24 15:57:12', 'Producto', '27', 'Modificación', 'stock:122 120 apartado:0 2 '),
(162, 3, '2013-06-25 16:00:15', 'Venta', '16', 'Inserción', 'Total:199.33 €'),
(163, 3, '2013-06-25 16:00:15', 'Producto', '2', 'Modificación', 'stock:76 74 '),
(164, 3, '2013-06-25 16:00:15', 'Producto', '26', 'Modificación', 'stock:50 49 '),
(165, 3, '2013-06-25 16:00:43', 'Reserva', '17', 'Inserción', 'Total:153 €'),
(166, 3, '2013-06-25 16:00:43', 'Producto', '46', 'Modificación', 'reservado:0 3 '),
(167, 3, '2013-06-25 16:01:05', 'Venta', '18', 'Inserción', 'Total:180.02 €'),
(168, 3, '2013-06-25 16:01:05', 'Producto', '3', 'Modificación', 'stock:122 120 '),
(169, 3, '2013-06-25 16:01:05', 'Producto', '28', 'Modificación', 'stock:134 132 '),
(170, 3, '2013-06-25 16:01:14', 'Cita', '19', 'Inserción', ''),
(171, 3, '2013-06-25 16:01:19', 'Cita', '20', 'Inserción', ''),
(172, 3, '2013-06-25 16:01:25', 'Cita', '21', 'Inserción', ''),
(173, 3, '2013-06-25 16:01:56', 'Reserva', '22', 'Inserción', 'Total:105.34 €'),
(174, 3, '2013-06-25 16:01:56', 'Producto', '7', 'Modificación', 'stock:139 137 apartado:0 2 '),
(175, 2, '2013-06-25 16:02:26', 'Venta', '23', 'Inserción', 'Total:260.01 €'),
(176, 2, '2013-06-25 16:02:26', 'Producto', '4', 'Modificación', 'stock:178 175 '),
(177, 1, '2013-06-25 16:03:13', 'Venta', '24', 'Inserción', 'Total:303.67 €'),
(178, 1, '2013-06-25 16:03:13', 'Producto', '3', 'Modificación', 'stock:120 115 '),
(179, 1, '2013-06-25 16:03:13', 'Producto', '6', 'Modificación', 'stock:111 110 '),
(180, 1, '2013-06-25 16:03:13', 'Producto', '5', 'Modificación', 'stock:135 132 '),
(181, 1, '2013-06-25 16:04:15', 'Devolucion', '25', 'Inserción', 'Total:43.33 €'),
(182, 1, '2013-06-25 16:04:15', 'Producto', '26', 'Modificación', 'stock:49 50 '),
(183, 1, '2013-06-25 16:04:41', 'Festivo', '1', 'Inserción', ''),
(184, 1, '2013-06-25 16:04:47', 'Festivo', '2', 'Inserción', ''),
(185, 1, '2013-06-25 16:08:24', 'Cita', '26', 'Inserción', ''),
(186, 1, '2013-06-25 16:08:44', 'Usuario', '4', 'Modificación', 'telefono:936675994  movil:661451348  '),
(187, 1, '2013-06-25 16:09:34', 'Usuario', '1', 'Modificación', 'telefono:925363842  movil:615410149  email:aliciadelmonte@lycos.es  '),
(188, 2, '2013-06-26 16:11:29', 'Venta', '27', 'Inserción', 'Total:141.33 €'),
(189, 2, '2013-06-26 16:11:29', 'Producto', '12', 'Modificación', 'stock:23 22 '),
(190, 2, '2013-06-26 16:11:29', 'Producto', '17', 'Modificación', 'stock:84 82 '),
(191, 2, '2013-06-26 16:11:46', 'Venta', '28', 'Inserción', 'Total:50.34 €'),
(192, 2, '2013-06-26 16:11:46', 'Producto', '7', 'Modificación', 'apartado:2 0 '),
(193, 2, '2013-06-26 16:12:01', 'Venta', '29', 'Inserción', 'Total:98.34 €'),
(194, 2, '2013-06-26 16:12:01', 'Producto', '27', 'Modificación', 'apartado:2 0 '),
(195, 2, '2013-06-26 16:12:58', 'Pedido', '1', 'Inserción', 'Total:463.4 €'),
(196, 2, '2013-06-26 16:13:15', 'Venta', '30', 'Inserción', 'Total:444.33 €'),
(197, 2, '2013-06-26 16:13:16', 'Producto', '4', 'Modificación', 'stock:175 173 '),
(198, 2, '2013-06-26 16:13:16', 'Producto', '5', 'Modificación', 'stock:132 129 '),
(199, 2, '2013-06-27 16:16:27', 'Venta', '31', 'Inserción', 'Total:213.33 €'),
(200, 2, '2013-06-27 16:16:27', 'Producto', '21', 'Modificación', 'stock:104 103 '),
(201, 2, '2013-06-27 16:16:27', 'Producto', '5', 'Modificación', 'stock:129 128 '),
(202, 2, '2013-06-27 16:16:27', 'Producto', '7', 'Modificación', 'stock:137 136 '),
(203, 2, '2013-06-27 16:16:27', 'Producto', '8', 'Modificación', 'stock:140 139 '),
(204, 2, '2013-06-27 16:17:08', 'Reserva', '32', 'Inserción', 'Total:101.7 €'),
(205, 2, '2013-06-27 16:17:09', 'Producto', '10', 'Modificación', 'reservado:0 5 '),
(206, 2, '2013-06-27 16:18:19', 'Reserva', '33', 'Inserción', 'Total:102 €'),
(207, 2, '2013-06-27 16:18:19', 'Producto', '46', 'Modificación', 'reservado:3 5 '),
(208, 2, '2013-06-27 16:19:14', 'Pedido', '2', 'Inserción', 'Total:793.4 €'),
(209, 3, '2013-06-27 16:19:39', 'Pedido', '2', 'Modificación', ''),
(210, 3, '2013-06-27 16:19:39', 'Producto', '36', 'Modificación', 'stock:15 25 '),
(211, 3, '2013-06-27 16:19:39', 'Producto', '52', 'Modificación', 'stock:1 21 '),
(212, 3, '2013-06-27 16:19:40', 'Pedido', '1', 'Modificación', ''),
(213, 3, '2013-06-27 16:19:40', 'Producto', '10', 'Modificación', 'stock:2 12 '),
(214, 3, '2013-06-27 16:19:40', 'Producto', '46', 'Modificación', 'stock:1 11 '),
(215, 3, '2013-06-27 16:19:40', 'Producto', '48', 'Modificación', 'stock:5 15 '),
(216, 3, '2013-06-27 16:19:52', 'Producto', '46', 'Modificación', 'stock:11 9 reservado:5 3 apartado:0 2 '),
(217, 3, '2013-06-27 16:19:57', 'Producto', '46', 'Modificación', 'stock:9 6 reservado:3 0 apartado:2 5 '),
(218, 3, '2013-06-27 16:20:04', 'Venta', '34', 'Inserción', 'Total:42 €'),
(219, 3, '2013-06-27 16:20:04', 'Producto', '46', 'Modificación', 'apartado:5 3 '),
(220, 3, '2013-06-27 16:20:26', 'Venta', '35', 'Inserción', 'Total:51.7 €'),
(221, 3, '2013-06-27 16:20:26', 'Producto', '10', 'Modificación', 'stock:12 7 reservado:5 0 '),
(222, 1, '2013-06-27 16:35:30', 'Venta', '36', 'Inserción', 'Total:322.35 €'),
(223, 1, '2013-06-27 16:35:30', 'Producto', '15', 'Modificación', 'stock:74 71 '),
(224, 1, '2013-06-27 16:35:30', 'Producto', '14', 'Modificación', 'stock:27 25 '),
(225, 1, '2013-06-27 16:35:30', 'Producto', '13', 'Modificación', 'stock:181 180 '),
(226, 1, '2013-06-27 16:35:53', 'Venta', '37', 'Inserción', 'Total:152 €'),
(227, 1, '2013-06-27 16:35:53', 'Producto', '14', 'Modificación', 'stock:25 22 '),
(228, 1, '2013-06-27 16:35:53', 'Producto', '17', 'Modificación', 'stock:82 81 '),
(229, 5, '2013-06-27 16:36:23', 'Venta', '38', 'Inserción', 'Total:145.01 €'),
(230, 5, '2013-06-27 16:36:23', 'Producto', '12', 'Modificación', 'stock:22 21 '),
(231, 5, '2013-06-27 16:36:23', 'Producto', '3', 'Modificación', 'stock:115 113 '),
(232, 5, '2013-06-27 16:36:23', 'Producto', '35', 'Modificación', 'stock:86 85 '),
(233, 5, '2013-06-27 16:36:38', 'Devolucion', '39', 'Inserción', 'Total:111 €'),
(234, 5, '2013-06-27 16:36:38', 'Producto', '14', 'Modificación', 'stock:22 25 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Operacion`
--

CREATE TABLE IF NOT EXISTS `Operacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `fechaoper` datetime NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_56BE4BE8DE734E51` (`cliente_id`),
  KEY `IDX_56BE4BE8952BE730` (`empleado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `Operacion`
--

INSERT INTO `Operacion` (`id`, `cliente_id`, `empleado_id`, `fechaoper`, `tipo`) VALUES
(1, 18, 2, '2013-06-24 15:52:14', 'venta'),
(2, 10, 2, '2013-06-24 15:52:49', 'venta'),
(3, 1, 2, '2013-06-24 15:53:03', 'cita'),
(4, 19, 2, '2013-06-24 15:53:07', 'cita'),
(5, 8, 2, '2013-06-24 15:53:12', 'cita'),
(6, 22, 2, '2013-06-24 15:53:22', 'cita'),
(7, 1, 2, '2013-06-24 15:53:29', 'cita'),
(8, 24, 2, '2013-06-24 15:54:05', 'cita'),
(9, 20, 2, '2013-06-24 15:54:09', 'cita'),
(10, 3, 2, '2013-06-24 15:54:27', 'venta'),
(11, 16, 3, '2013-06-24 15:55:04', 'venta'),
(12, 3, 3, '2013-06-24 15:55:42', 'devolucion'),
(13, 24, 3, '2013-06-24 15:56:09', 'venta'),
(14, 10, 4, '2013-06-24 15:56:42', 'venta'),
(15, 8, 4, '2013-06-24 15:57:11', 'reserva'),
(16, 1, 3, '2013-06-25 16:00:15', 'venta'),
(17, 1, 3, '2013-06-25 16:00:43', 'reserva'),
(18, 10, 3, '2013-06-25 16:01:05', 'venta'),
(19, 2, 3, '2013-06-25 16:01:14', 'cita'),
(20, 25, 3, '2013-06-25 16:01:19', 'cita'),
(21, 5, 3, '2013-06-25 16:01:25', 'cita'),
(22, 24, 3, '2013-06-25 16:01:56', 'reserva'),
(23, 6, 2, '2013-06-25 16:02:26', 'venta'),
(24, 4, 1, '2013-06-25 16:03:13', 'venta'),
(25, 16, 1, '2013-06-25 16:04:15', 'devolucion'),
(26, 4, 1, '2013-06-25 16:08:24', 'cita'),
(27, 1, 2, '2013-06-26 16:11:29', 'venta'),
(28, 24, 2, '2013-06-26 16:11:46', 'venta'),
(29, 8, 2, '2013-06-26 16:12:01', 'venta'),
(30, 10, 2, '2013-06-26 16:13:15', 'venta'),
(31, 7, 2, '2013-06-27 16:16:27', 'venta'),
(32, 8, 2, '2013-06-27 16:17:08', 'reserva'),
(33, 6, 2, '2013-06-27 16:18:19', 'reserva'),
(34, 6, 3, '2013-06-27 16:20:04', 'venta'),
(35, 8, 3, '2013-06-27 16:20:26', 'venta'),
(36, 22, 1, '2013-06-27 16:35:30', 'venta'),
(37, 3, 1, '2013-06-27 16:35:53', 'venta'),
(38, 22, 5, '2013-06-27 16:36:23', 'venta'),
(39, 3, 5, '2013-06-27 16:36:38', 'devolucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE IF NOT EXISTS `Pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `recepciona_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `fecharecepcion` datetime DEFAULT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C34013F8CB305D73` (`proveedor_id`),
  KEY `IDX_C34013F8952BE730` (`empleado_id`),
  KEY `IDX_C34013F8EE063E04` (`recepciona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Pedido`
--

INSERT INTO `Pedido` (`id`, `proveedor_id`, `empleado_id`, `recepciona_id`, `fecha`, `fecharecepcion`, `total`) VALUES
(1, 1, 2, 3, '2013-06-26 16:12:58', '2013-06-27 16:19:40', 463),
(2, 4, 2, 3, '2013-06-27 16:19:14', '2013-06-27 16:19:39', 793);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permiso`
--

CREATE TABLE IF NOT EXISTS `Permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32C79202952BE730` (`empleado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Permiso`
--

INSERT INTO `Permiso` (`id`, `empleado_id`, `fecha`, `inicio`, `fin`, `tipo`) VALUES
(2, 4, '2013-06-25 16:05:16', '2013-07-01 09:00:00', '2013-07-07 09:00:00', 'verano'),
(4, 5, '2013-06-25 16:06:49', '2013-07-03 09:00:00', '2013-07-03 09:00:00', 'baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE IF NOT EXISTS `Producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `reservado` int(11) NOT NULL,
  `apartado` int(11) NOT NULL,
  `pventa` double NOT NULL,
  `pcompra` double NOT NULL,
  `iva` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5ECD6443A02A2F00` (`descripcion`),
  KEY `IDX_5ECD6443CB305D73` (`proveedor_id`),
  KEY `IDX_5ECD6443D02563A3` (`familia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`id`, `proveedor_id`, `familia_id`, `descripcion`, `stock`, `reservado`, `apartado`, `pventa`, `pcompra`, `iva`) VALUES
(1, 3, 1, 'air optix aqua +2.5', 48, 0, 0, 39.66, 20.33, '18'),
(2, 2, 1, 'Biofinity +1.25', 74, 0, 0, 78, 33.33, '8'),
(3, 4, 1, 'Biofinity -1.25', 113, 0, 0, 5.67, 5, '21'),
(4, 3, 1, 'Biofinity -0.75', 173, 0, 0, 86.67, 20.67, '18'),
(5, 2, 1, 'Biofinity +2.5', 128, 0, 0, 90.33, 29, '8'),
(6, 4, 1, 'Biofinity +2', 110, 0, 0, 4.33, 2.33, '21'),
(7, 3, 1, 'acuvue Oasys +3', 136, 0, 0, 52.67, 20, '18'),
(8, 4, 1, 'Proclear sphere -1', 139, 0, 0, 55.66, 12.33, '21'),
(9, 4, 1, 'Soflens 59 +0.5', 191, 0, 0, 52.67, 20.67, '21'),
(10, 1, 1, 'softlens 38 +0.25', 7, 0, 0, 20.34, 9.67, '4'),
(11, 4, 1, 'Proclear toric +1', 160, 0, 0, 81, 16.33, '21'),
(12, 3, 1, 'Biomedics 55 evolution +1.5', 21, 0, 0, 59.33, 6, '18'),
(13, 2, 1, 'Purevision +1', 180, 0, 0, 45.34, 2.67, '8'),
(14, 3, 2, 'Rayban rx 5114', 25, 0, 0, 37, 1, '18'),
(15, 3, 2, 'Polo Ralph OPH 2039', 71, 0, 0, 67.67, 31, '18'),
(16, 2, 2, 'Polo Ralph ORA 7021', 73, 0, 0, 32.67, 16.67, '8'),
(17, 3, 2, 'Rayban rx 7026', 81, 0, 0, 41, 10.33, '18'),
(18, 4, 2, 'Rayban rx 2312', 61, 0, 0, 39.66, 16.33, '21'),
(19, 4, 2, 'Prada Pr 10FV', 50, 0, 0, 83.33, 19.33, '21'),
(20, 4, 2, 'Boss orange 0036', 67, 0, 0, 54.67, 30.67, '21'),
(21, 4, 2, 'Carrera Ca 6175', 103, 0, 0, 14.67, 4, '21'),
(22, 2, 2, 'Gucci GG 1612', 133, 0, 0, 50, 23.33, '8'),
(23, 4, 2, 'Police v 1677', 79, 0, 0, 14.34, 9.67, '21'),
(24, 1, 2, 'Vogue dd 2555', 183, 0, 0, 37.66, 28.33, '4'),
(25, 3, 2, 'Oakley ox 1066', 117, 0, 0, 64.67, 28, '18'),
(26, 3, 2, 'Nike 4162', 50, 0, 0, 43.33, 31.33, '18'),
(27, 1, 2, 'Adidas Fc 2343', 120, 0, 0, 71.67, 29.67, '4'),
(28, 2, 3, 'Vogue 3846s', 132, 0, 0, 84.34, 19.67, '8'),
(29, 1, 3, 'Vogue 2832sb', 35, 0, 0, 66, 33.33, '4'),
(30, 3, 3, 'Vogue 2795s', 183, 0, 0, 17.66, 12.33, '18'),
(31, 4, 3, 'Vogue 2818s', 63, 0, 0, 36.66, 5.33, '21'),
(32, 3, 3, 'Prada 27ps', 181, 0, 0, 39, 19, '18'),
(33, 1, 3, 'Prada 29ps', 88, 0, 0, 76.34, 29.67, '4'),
(34, 3, 3, 'Prada 21ps', 29, 0, 0, 66.67, 12, '18'),
(35, 2, 3, 'Polo Ralph 4076', 85, 0, 0, 74.34, 15.67, '8'),
(36, 4, 3, 'Polo Ralph 4077', 25, 0, 0, 38.67, 28, '21'),
(37, 2, 3, 'Bvigari 8113B', 170, 0, 0, 51, 9.67, '8'),
(38, 3, 3, 'Bvigari 8105B', 27, 0, 0, 42, 12.67, '18'),
(39, 3, 3, 'Bvigari 8116B', 137, 0, 0, 42.67, 28, '18'),
(40, 1, 3, 'Chanel 5434', 181, 0, 0, 50, 24.67, '4'),
(41, 1, 3, 'Chanel 3454', 43, 0, 0, 48.34, 15.67, '4'),
(42, 1, 3, 'Chanel 2343T', 168, 0, 0, 44, 9.33, '4'),
(43, 2, 3, 'Chanel 2378r', 30, 0, 0, 63.33, 30, '8'),
(44, 3, 3, 'Chanel 3456', 174, 0, 0, 90.33, 24.33, '18'),
(45, 1, 3, 'Chanel 5467', 133, 0, 0, 55.33, 23.33, '4'),
(46, 1, 3, 'Arnette 4544', 6, 0, 3, 51, 17, '4'),
(47, 2, 3, 'Arnette 4514', 50, 0, 0, 31.67, 25.67, '8'),
(48, 1, 3, 'Arnette 4678', 15, 0, 0, 21.67, 19.67, '4'),
(49, 2, 3, 'Arnette 4554y', 165, 0, 0, 29.33, 28, '8'),
(50, 2, 3, 'Gucci 4544', 127, 0, 0, 15, 13.67, '8'),
(51, 4, 3, 'Gucci 4333', 128, 0, 0, 63, 7, '21'),
(52, 4, 3, 'Carrera 6000R', 21, 0, 0, 41.67, 25.67, '21'),
(53, 2, 3, 'Carrera 5003', 191, 0, 0, 27.67, 11, '8'),
(54, 4, 3, 'Hugo Boss 0522S', 191, 0, 0, 53.33, 8, '21'),
(55, 3, 3, 'Hugo boss 0567E', 114, 0, 0, 82, 32, '18'),
(56, 1, 3, 'Hugo Boss 04556', 24, 0, 0, 10, 1.33, '4'),
(57, 3, 3, 'Hugo boss 0513S', 24, 0, 0, 76.33, 11, '18'),
(58, 4, 3, 'Rayban 3503', 192, 0, 0, 17.33, 0, '21'),
(59, 4, 3, 'Rayban 4167', 93, 0, 0, 67.33, 19.33, '21'),
(60, 1, 3, 'Rayban Aviator 3015', 51, 0, 0, 53, 3, '4'),
(61, 3, 3, 'Rayban Aviator 3012', 122, 0, 0, 27.66, 2.33, '18'),
(62, 4, 3, 'Rayban Aviator 3011', 90, 0, 0, 71.66, 6.33, '21'),
(63, 1, 3, 'Rayban Aviator 2034', 31, 0, 0, 25.67, 3, '4'),
(64, 4, 3, 'Rayban Aviator 2343', 141, 0, 0, 54, 5.33, '21'),
(65, 4, 4, 'Estuche ranas', 176, 0, 0, 24.66, 9.33, '21'),
(66, 1, 4, 'Estuche pez', 60, 0, 0, 56.67, 6.67, '4'),
(67, 4, 4, 'Estuche ositos', 21, 0, 0, 16, 0, '21'),
(68, 4, 4, 'estuche eclipse', 113, 0, 0, 41.67, 27, '21'),
(69, 1, 4, 'estuche elefantes', 40, 0, 0, 32, 9.33, '4'),
(70, 2, 4, 'estuche cerditos', 183, 0, 0, 66.67, 30, '8'),
(71, 2, 4, 'estuche de otoño', 193, 0, 0, 44.67, 28, '8'),
(72, 3, 4, 'lupa regla 210mm', 64, 0, 0, 64.67, 32, '18'),
(73, 2, 4, 'cadena dorada 0406', 34, 0, 0, 66.33, 4.33, '8'),
(74, 3, 4, 'cadena roja 0456', 170, 0, 0, 66.34, 9.67, '18'),
(75, 3, 4, 'cadena marron 0426', 37, 0, 0, 69.67, 15, '18'),
(76, 2, 4, 'estuche polka', 47, 0, 0, 28.34, 3.67, '8'),
(77, 3, 5, 'Sibosol set', 139, 0, 0, 71.33, 10, '18'),
(78, 2, 5, 'optifree express 500ml', 144, 0, 0, 35.33, 27.33, '8'),
(79, 4, 5, 'renu multiplus 240ml', 115, 0, 0, 40.67, 24, '21'),
(80, 4, 5, 'solocare aqua 360ml', 58, 0, 0, 80.33, 14.33, '21'),
(81, 1, 5, 'biotrue 300ml', 91, 0, 0, 88.33, 31, '4'),
(82, 2, 5, 'sibosol 250ml', 158, 0, 0, 49.67, 19, '8'),
(83, 2, 5, 'gotas Ciba aguify', 179, 0, 0, 62, 20, '8'),
(84, 3, 5, 'Easysept', 7, 0, 0, 79.33, 25.33, '18'),
(85, 2, 5, 'Complete', 35, 0, 0, 58, 20.67, '8'),
(86, 3, 5, 'Oxysept 1 step', 82, 0, 0, 65.67, 9.67, '18'),
(87, 3, 5, 'opticrom gotas 5ml', 192, 0, 0, 67.67, 15, '18'),
(88, 2, 5, 'iclean 50ml', 148, 0, 0, 44.67, 2, '8'),
(89, 3, 5, 'boston simplus 120ml', 142, 0, 0, 53, 33, '18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedor`
--

CREATE TABLE IF NOT EXISTS `Proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9431EA6D3A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `Proveedor`
--

INSERT INTO `Proveedor` (`id`, `nombre`, `direccion`, `telefono`, `localidad`, `provincia`, `email`) VALUES
(1, 'gafaskost', 'Calle Dolorosa 3', '981792353', 'Madrid', 'Madrid', 'gafaskost@hotmail.com'),
(2, 'esunvision', 'calle Villafuerte 23', '917795388', 'Aranjuez', 'Madrid', 'esunvision@hotmail.com'),
(3, 'ocho8', 'calle los bohemihos 1', '927839501', 'Boadilla del monte', 'Madrid', 'ocho8@hotmail.com'),
(4, 'Puckator', 'calle de la generosidad 12', '962751700', 'Fuenlabrada', 'Madrid', 'Puckator@hotmail.com'),
(5, 'luxottica', 'av de la felicidad 32', '925407313', 'Getafe', 'Madrid', 'luxottica@hotmail.com'),
(6, 'termopower', 'calle humanidad 11', '900028443', 'Alcorcón', 'Madrid', 'termopower@hotmail.com'),
(7, 'solextrem', 'calle dulzura 34', '922278840', 'Alcobendas', 'Madrid', 'solextrem@hotmail.com'),
(8, 'dipo', 'calle conciliación 5', '983012832', 'Léganes', 'Madrid', 'dipo@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva`
--

CREATE TABLE IF NOT EXISTS `Reserva` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `pago` varchar(255) NOT NULL,
  `totalpago` double NOT NULL,
  `avisada` datetime DEFAULT NULL,
  `adelanto` double NOT NULL,
  `total` double NOT NULL,
  `apartado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D73017A7F2A5805D` (`venta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Reserva`
--

INSERT INTO `Reserva` (`id`, `venta_id`, `pago`, `totalpago`, `avisada`, `adelanto`, `total`, `apartado`) VALUES
(15, 29, 'efectivo', 50, NULL, 45, 143.34, 'si'),
(17, NULL, 'tarjeta', 100, '2013-06-27 16:19:57', 100, 153, 'no'),
(22, 28, 'efectivo', 55, NULL, 55, 105.34, 'si'),
(32, 35, 'tarjeta', 50, NULL, 50, 101.7, 'no'),
(33, 34, 'tarjeta', 60, '2013-06-27 16:19:52', 60, 102, 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Role`
--

INSERT INTO `Role` (`id`, `name`) VALUES
(1, 'ROLE_A'),
(2, 'ROLE_U'),
(3, 'ROLE_M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido1` varchar(255) NOT NULL,
  `apellido2` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `movil` varchar(9) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C17F8F253B` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `dni`, `nombre`, `apellido1`, `apellido2`, `direccion`, `localidad`, `provincia`, `telefono`, `movil`, `email`) VALUES
(1, '15410149r', 'Alicia', 'Hernandez', 'Del monte', 'calle Feduchy 3º B', 'Chipiona', 'Cádiz', NULL, NULL, NULL),
(2, '97589922o', 'Oscar', 'Ramírez', 'Vazquez', 'calle San francisco 1º D', 'Benalup', 'Cádiz', '914862029', '697589922', 'oscarvazquez@yahoo.es'),
(3, '81368134p', 'Raquel', 'Hernandez', 'Ortega', 'calle Mesón 1º E', 'Cádiz', 'Cádiz', '971325435', '681368134', 'raquelortega@yahoo.es'),
(4, '61451348g', 'Julia', 'Vazquez', 'Morales', 'Calle San Juan bajo drcha', 'Barbate', 'Cádiz', NULL, NULL, 'juliamorales@lycos.es'),
(5, '47929858f', 'Julia', 'Ramírez', 'Basi', 'calle Pelota 1º A', 'Jerez de la frontera', 'Cádiz', '915676274', '647929858', 'juliabasi@yahoo.es'),
(6, '20865849f', 'Luis', 'Jiménez', 'García', 'Calle columela 2º B', 'Grazalema', 'Cádiz', '967901574', '620865849', 'luisgarcia@gmail.com'),
(7, '49191155c', 'Sara', 'Díaz', 'Gonzalez', 'Calle Jose del Toro 2º A', 'Grazalema', 'Cádiz', '994212734', '649191155', 'saragonzalez@hotmail.es'),
(8, '15815257t', 'Marta', 'Díaz', 'Martín', 'Calle osorio 1º E', 'Barbate', 'Cádiz', '998434453', '615815257', 'martamartin@lycos.es'),
(9, '27494856t', 'Antonia', 'Rodriguez', 'Domínguez', 'Calle Valverde 1º B', 'Barbate', 'Cádiz', '902368355', '627494856', 'antoniadominguez@yahoo.es'),
(10, '04032576l', 'Raquel', 'Ramos', 'Vazquez', 'Calle Colarte 2º B', 'Algodonales', 'Cádiz', '967437784', '604032576', 'raquelvazquez@gmail.com'),
(11, '87591367k', 'Mario', 'Basi', 'Rodriguez', 'Calle San Salvador 2º drcha', 'Puerto Real', 'Cádiz', '914843882', '687591367', 'mariorodriguez@hotmail.es'),
(12, '88625504f', 'Jesus', 'Perez', 'Serrano', ' Calle gas 1º izq', 'Barbate', 'Cádiz', '911479492', '688625504', 'jesusserrano@yahoo.es'),
(13, '21432685k', 'Cristina', 'Torres', 'Vazquez', 'Calle Luis Barile 1º A', 'Cádiz', 'Cádiz', '932681564', '621432685', 'cristinavazquez@yahoo.es'),
(14, '96374143a', 'Oscar', 'Morales', 'Navarro', 'Av Segunda aguada 3º C', 'Chiclana de la frontera', 'Cádiz', '901469609', '696374143', 'oscarnavarro@yahoo.es'),
(15, '98469575o', 'Angela', 'Sanchez', 'Martín', 'Calle San Gabriel 2º C', 'Grazalema', 'Cádiz', '981661520', '698469575', 'angelamartin@gmail.com'),
(16, '51259094v', 'Juan Jose', 'Jiménez', 'Ramos', 'Av Marconi 1º B', 'Bornos', 'Cádiz', '975528735', '651259094', 'juanjoseramos@hotmail.es'),
(17, '47583088g', 'Jose', 'Díaz', 'Martín', 'Calle Grazalema 2º izq', 'Algodonales', 'Cádiz', '945469069', '647583088', 'josemartin@lycos.es'),
(18, '01291888y', 'Isabel', 'Gonzalez', 'Hernandez', 'Calle Guadalmesí 1º A', 'Chiclana de la frontera', 'Cádiz', '901430733', '601291888', 'isabelhernandez@hotmail.es'),
(19, '31601192n', 'Juan Jose', 'Molina', 'Vazquez', 'Av Lacave 1º A', 'Olvera', 'Cádiz', '999841905', '631601192', 'juanjosevazquez@hotmail.es'),
(20, '91339509c', 'Davinia', 'Jiménez', 'Molina', 'Av de la Bahía 1º A', 'Chipiona', 'Cádiz', '938968046', '691339509', 'daviniamolina@yahoo.es'),
(21, '76900307l', 'Álvaro', 'Sanchez', 'Ramos', 'Calle Sotillo 1º E', 'Barbate', 'Cádiz', '988453267', '676900307', 'alvaroramos@gmail.com'),
(22, '73144194y', 'Alicia', 'Basi', 'Alonso', 'Calle Arillo 1º C', 'Espera', 'Cádiz', '969708891', '673144194', 'aliciaalonso@gmail.com'),
(23, '82945108c', 'Antonia', 'Delgado', 'Romero', 'Calle Palmones 2º B', 'Bornos', 'Cádiz', '928717711', '682945108', 'antoniaromero@hotmail.es'),
(24, '10849952f', 'Jose', 'Ramírez', 'Ramos', 'Calle Guadairo 1º A', 'Cádiz', 'Cádiz', '952031371', '610849952', 'joseramos@hotmail.es'),
(25, '69963692q', 'Alberto', 'Martínez', 'Rodriguez', 'Calle Alonso Cano 1º D ', 'Puerto Real', 'Cádiz', '976543163', '669963692', 'albertorodriguez@yahoo.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Venta`
--

CREATE TABLE IF NOT EXISTS `Venta` (
  `id` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `pago` varchar(255) NOT NULL,
  `totalpago` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Venta`
--

INSERT INTO `Venta` (`id`, `total`, `pago`, `totalpago`) VALUES
(1, 218.68, 'tarjeta', 0),
(2, 176.01, 'efectivo', 177),
(10, 98.01, 'efectivo', 100),
(11, 121.33, 'tarjeta', 0),
(13, 223.67, 'tarjeta', 0),
(14, 124, 'tarjeta', 0),
(16, 199.33, 'efectivo', 200),
(18, 180.02, 'tarjeta', 0),
(23, 260.01, 'tarjeta', 0),
(24, 303.67, 'tarjeta', 0),
(27, 141.33, 'tarjeta', 0),
(28, 50.34, 'tarjeta', 0),
(29, 98.34, 'efectivo', 100),
(30, 444.33, 'tarjeta', 0),
(31, 213.33, 'tarjeta', 0),
(34, 42, 'tarjeta', 0),
(35, 51.7, 'efectivo', 52),
(36, 322.35, 'tarjeta', 0),
(37, 152, 'tarjeta', 0),
(38, 145.01, 'tarjeta', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Arqueo`
--
ALTER TABLE `Arqueo`
  ADD CONSTRAINT `FK_B2EA45AC952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `Cita`
--
ALTER TABLE `Cita`
  ADD CONSTRAINT `FK_9E05355CBF396750` FOREIGN KEY (`id`) REFERENCES `Operacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9E05355CA7FB1C0C` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`id`);

--
-- Filtros para la tabla `Devolucion`
--
ALTER TABLE `Devolucion`
  ADD CONSTRAINT `FK_1D109CB7BF396750` FOREIGN KEY (`id`) REFERENCES `Operacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1D109CB7F2A5805D` FOREIGN KEY (`venta_id`) REFERENCES `Venta` (`id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_D9D9BF52D60322AC` FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);

--
-- Filtros para la tabla `Informe`
--
ALTER TABLE `Informe`
  ADD CONSTRAINT `FK_B1C8D8451E011DDF` FOREIGN KEY (`cita_id`) REFERENCES `Cita` (`id`);

--
-- Filtros para la tabla `Lineasoperacion`
--
ALTER TABLE `Lineasoperacion`
  ADD CONSTRAINT `FK_80D0C667E6D597C3` FOREIGN KEY (`operacion_id`) REFERENCES `Operacion` (`id`),
  ADD CONSTRAINT `FK_80D0C6677645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`);

--
-- Filtros para la tabla `Lineaspedido`
--
ALTER TABLE `Lineaspedido`
  ADD CONSTRAINT `FK_810B9757645698E` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`),
  ADD CONSTRAINT `FK_810B9754854653A` FOREIGN KEY (`pedido_id`) REFERENCES `Pedido` (`id`);

--
-- Filtros para la tabla `Log`
--
ALTER TABLE `Log`
  ADD CONSTRAINT `FK_B7722E25952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `FK_34E5914CBF396750` FOREIGN KEY (`id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Modificacion`
--
ALTER TABLE `Modificacion`
  ADD CONSTRAINT `FK_3A9B910C952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `Operacion`
--
ALTER TABLE `Operacion`
  ADD CONSTRAINT `FK_56BE4BE8952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `FK_56BE4BE8DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `FK_C34013F8EE063E04` FOREIGN KEY (`recepciona_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `FK_C34013F8952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `FK_C34013F8CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedor` (`id`);

--
-- Filtros para la tabla `Permiso`
--
ALTER TABLE `Permiso`
  ADD CONSTRAINT `FK_32C79202952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD CONSTRAINT `FK_5ECD6443D02563A3` FOREIGN KEY (`familia_id`) REFERENCES `Familia` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_5ECD6443CB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `Proveedor` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD CONSTRAINT `FK_D73017A7BF396750` FOREIGN KEY (`id`) REFERENCES `Operacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D73017A7F2A5805D` FOREIGN KEY (`venta_id`) REFERENCES `Venta` (`id`);

--
-- Filtros para la tabla `Venta`
--
ALTER TABLE `Venta`
  ADD CONSTRAINT `FK_4E26C151BF396750` FOREIGN KEY (`id`) REFERENCES `Operacion` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

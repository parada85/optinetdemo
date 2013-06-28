-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-06-2013 a las 11:03:33
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Arqueo`
--

INSERT INTO `Arqueo` (`id`, `empleado_id`, `fechaarqueo`, `efectivo`, `efectivocont`, `boletas`, `boletascont`, `estado`) VALUES
(1, 3, '2013-06-24 10:36:17', 139, 139, 5, 5, 1),
(2, 3, '2013-06-25 10:40:43', 456.3, 456.4, 4, 4, 1),
(3, 3, '2013-06-26 10:47:14', 37.33, 37.330000000000005, 4, 3, 0),
(4, 4, '2013-06-27 10:54:54', 273.98, 274, 6, 6, 1);

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
(6, 4, '2013-06-24 11:00:00'),
(7, 5, '2013-06-24 11:30:00'),
(8, 4, '2013-06-25 09:00:00'),
(9, 5, '2013-06-25 09:00:00'),
(10, 4, '2013-06-25 09:30:00'),
(11, 5, '2013-06-25 10:00:00'),
(14, 4, '2013-06-25 10:30:00'),
(15, 4, '2013-06-25 11:00:00'),
(16, 4, '2013-06-25 11:30:00'),
(22, 4, '2013-06-26 09:00:00'),
(23, 4, '2013-06-26 09:30:00'),
(24, 5, '2013-06-26 10:30:00'),
(25, 4, '2013-06-26 11:00:00'),
(30, 4, '2013-06-26 15:00:00'),
(31, 5, '2013-06-27 09:30:00'),
(39, 4, '2013-06-27 11:30:00'),
(42, 4, '2013-06-27 12:30:00'),
(43, 5, '2013-06-27 12:30:00');

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
(36, 34, 37.33, 'defecto de origen'),
(37, 35, 63.67, '...');

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
(1, 1, '22788752e', 'José Ángel', 'es', 'cobalt', 'joseangel', 'Parada', 'Jiménez', 'paradajimenez85@gmail.com', 'San fernando', 'Cádiz', 'gCBL2xvG6v6JmSzJ38fU', '956890882', '625038674', '1HrBXiiICkN8lQPwHKiQuxrxmos=', '747c7aeacab6ce07db3b52ff8e3357e6', 'Al andalus 13 6º A', '2013-06-24 10:29:35', 1, 'empleado'),
(2, 2, '25827093z', 'José', 'es', 'aristo', 'jose', 'Parada', 'Payero', 'paradita85@gmail.com', 'San fernando', 'Cádiz', 'hiCvGuaqWsjEyjrHMjQQ', '956890882', '665540839', 'JF0KeAWSppF3q2uJXAVwLdKc2ws=', '747c7aeacab6ce07db3b52ff8e3357e6', 'Al andalus 13 6º A', '2013-06-24 10:29:35', 1, 'empleado'),
(3, 2, '81760217l', 'Rosario', 'en', 'cobalt', 'rosario', 'Jiménez', 'Padilla', 'parada85@hotmail.es', 'San fernando', 'Cádiz', 'e0vxuMLU7ys4sXMLDEH3', '956890882', '654343536', 'L0LwfM3hx0h/FagOjUZZ96t6DTY=', '747c7aeacab6ce07db3b52ff8e3357e6', 'Al andalus 13 6º A', '2013-06-24 10:29:35', 1, 'empleado'),
(4, 3, '05432394x', 'Juan', 'es', 'cobalt', 'juan', 'Ramirez', 'Lopez', 'medico1optinet@gmail.com', 'San fernando', 'Cadiz', 'E4oCaHpcJeIB0jP5dzNN', '956098765', '625988776', 'oWBYUBArHONi3nK6z07CcT99wio=', '747c7aeacab6ce07db3b52ff8e3357e6', 'Calle malaspina 1º A', '2013-06-24 10:29:35', 1, 'medico'),
(5, 3, '42902757g', 'Pedro', 'es', 'aristo', 'pedro', 'Callealta', 'Gonzalez', 'medico2optinet@gmail.com', 'San fernando', 'Cadiz', 'yYcm7iYvuYjZyevwoeQF', '956768795', '625918356', 'OCqOMo8yifdPNyl7B8Dx+OOQ4ng=', '747c7aeacab6ce07db3b52ff8e3357e6', 'Calle bienvenida 2º D', '2013-06-24 10:29:35', 1, 'medico');

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
(2, '2013-07-03 09:00:00');

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
(1, 31, '2013-06-27 10:53:08', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Miopia', 'Normal', 'Normal', 'Normal'),
(2, 24, '2013-06-27 10:53:27', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', 'Hipermetropia', 'Normal', 'Normal', 'Normal'),
(3, 23, '2013-06-27 10:54:01', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Emetrope', 'Alterada', 'Alterada', 'Normal');

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
(1, 21, 1, 51.33, 8, 21, NULL),
(2, 1, 2, 63.33, 9.33, 21, NULL),
(2, 21, 1, 63.33, 9.33, 21, NULL),
(2, 40, 1, 63.33, 9.33, 21, NULL),
(2, 41, 1, 63.33, 9.33, 21, NULL),
(2, 45, 3, 63.33, 9.33, 21, NULL),
(3, 1, 2, 60.66, 1.33, 18, NULL),
(3, 21, 1, 60.66, 1.33, 18, NULL),
(3, 40, 2, 60.66, 1.33, 18, NULL),
(3, 45, 2, 60.66, 1.33, 18, NULL),
(4, 13, 2, 89.66, 30.33, 21, NULL),
(4, 19, 2, 89.66, 30.33, 21, NULL),
(4, 21, 1, 89.66, 30.33, 21, NULL),
(4, 27, 2, 89.66, 30.33, 21, NULL),
(4, 40, 2, 89.66, 30.33, 21, NULL),
(5, 12, 1, 74.66, 17.33, 4, NULL),
(5, 18, 1, 74.66, 17.33, 4, NULL),
(6, 2, 2, 45, 32.33, 21, NULL),
(7, 12, 1, 72, 28, 18, NULL),
(7, 35, 2, 72, 28, 18, NULL),
(8, 5, 3, 50, 26.67, 18, NULL),
(8, 20, 3, 50, 26.67, 18, NULL),
(11, 12, 1, 78.33, 29, 21, NULL),
(13, 17, 2, 37.33, 31.33, 8, NULL),
(13, 18, 2, 37.33, 31.33, 8, NULL),
(13, 27, 3, 37.33, 31.33, 8, NULL),
(13, 29, 1, 37.33, 31.33, 8, NULL),
(13, 34, 1, 37.33, 31.33, 8, NULL),
(13, 36, 1, 37.33, 31.33, 8, 'bueno'),
(13, 44, 2, 37.33, 31.33, 8, NULL),
(14, 38, 3, 45.33, 8, 18, NULL),
(14, 44, 2, 45.33, 8, 18, NULL),
(15, 3, 3, 13, 5.67, 4, NULL),
(15, 28, 4, 13, 5.67, 4, NULL),
(16, 35, 1, 63.67, 25, 18, NULL),
(16, 37, 1, 63.67, 25, 18, 'bueno'),
(16, 38, 3, 63.67, 25, 18, NULL),
(18, 2, 1, 54.33, 22.33, 18, NULL),
(21, 17, 2, 58.33, 9, 18, NULL),
(56, 4, 2, 71, 9, 4, NULL),
(56, 33, 2, 71, 9, 4, NULL),
(63, 41, 2, 28.34, 1.67, 8, NULL),
(77, 26, 4, 29.67, 9, 8, NULL),
(77, 32, 4, 29.67, 9, 8, NULL),
(85, 41, 2, 75, 25, 21, NULL);

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
(1, 56, 10, 9, 4),
(2, 77, 15, 9, 8),
(3, 6, 20, 32.33, 21),
(3, 54, 20, 30.33, 21);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `Log`
--

INSERT INTO `Log` (`id`, `empleado_id`, `fechalog`, `tipo`) VALUES
(1, 2, '2013-06-24 10:29:39', 'Entrada'),
(2, 2, '2013-06-24 10:32:59', 'Salida'),
(3, 3, '2013-06-24 10:33:04', 'Entrada'),
(4, 3, '2013-06-24 10:36:21', 'Salida'),
(5, 3, '2013-06-25 10:36:41', 'Entrada'),
(6, 3, '2013-06-25 10:40:48', 'Salida'),
(7, 4, '2013-06-26 10:41:01', 'Entrada'),
(8, 4, '2013-06-26 10:44:16', 'Salida'),
(9, 3, '2013-06-26 10:44:23', 'Entrada'),
(10, 3, '2013-06-26 10:47:16', 'Salida'),
(11, 5, '2013-06-27 10:47:34', 'Entrada'),
(12, 5, '2013-06-27 10:49:29', 'Salida'),
(13, 1, '2013-06-27 10:49:34', 'Entrada'),
(14, 1, '2013-06-27 10:52:43', 'Salida'),
(15, 5, '2013-06-27 10:52:47', 'Entrada'),
(16, 5, '2013-06-27 10:53:34', 'Salida'),
(17, 4, '2013-06-27 10:53:39', 'Entrada'),
(18, 4, '2013-06-27 10:54:58', 'Salida');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=236 ;

--
-- Volcado de datos para la tabla `Modificacion`
--

INSERT INTO `Modificacion` (`id`, `empleado_id`, `fechamod`, `entidad`, `identificador`, `tipo`, `info`) VALUES
(1, NULL, '2013-06-24 10:29:35', 'Empleado', '1', 'Inserción', ''),
(2, NULL, '2013-06-24 10:29:35', 'Empleado', '1', 'Inserción', ''),
(3, NULL, '2013-06-24 10:29:35', 'Empleado', '1', 'Inserción', ''),
(4, NULL, '2013-06-24 10:29:35', 'Medico', '1', 'Inserción', ''),
(5, NULL, '2013-06-24 10:29:35', 'Medico', '1', 'Inserción', ''),
(6, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(7, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(8, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(9, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(10, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(11, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(12, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(13, NULL, '2013-06-24 10:29:35', 'Proveedor', '1', 'Inserción', ''),
(14, NULL, '2013-06-24 10:29:35', 'Familia', '1', 'Inserción', ''),
(15, NULL, '2013-06-24 10:29:35', 'Familia', '1', 'Inserción', ''),
(16, NULL, '2013-06-24 10:29:35', 'Familia', '1', 'Inserción', ''),
(17, NULL, '2013-06-24 10:29:35', 'Familia', '1', 'Inserción', ''),
(18, NULL, '2013-06-24 10:29:35', 'Familia', '1', 'Inserción', ''),
(19, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(20, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(21, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(22, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(23, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(24, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(25, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(26, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(27, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(28, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(29, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(30, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(31, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(32, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(33, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(34, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(35, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(36, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(37, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(38, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(39, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(40, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(41, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(42, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(43, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(44, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(45, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(46, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(47, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(48, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(49, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(50, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(51, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(52, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(53, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(54, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(55, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(56, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(57, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(58, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(59, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(60, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(61, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(62, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(63, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(64, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(65, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(66, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(67, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(68, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(69, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(70, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(71, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(72, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(73, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(74, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(75, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(76, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(77, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(78, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(79, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(80, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(81, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(82, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(83, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(84, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(85, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(86, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(87, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(88, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(89, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(90, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(91, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(92, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(93, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(94, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(95, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(96, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(97, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(98, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(99, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(100, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(101, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(102, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(103, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(104, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(105, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(106, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(107, NULL, '2013-06-24 10:29:35', 'Producto', '1', 'Inserción', ''),
(108, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(109, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(110, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(111, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(112, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(113, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(114, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(115, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(116, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(117, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(118, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(119, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(120, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(121, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(122, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(123, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(124, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(125, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(126, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(127, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(128, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(129, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(130, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(131, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(132, NULL, '2013-06-24 10:29:35', 'Usuario', '1', 'Inserción', ''),
(133, 2, '2013-06-24 10:30:13', 'Venta', '1', 'Inserción', 'Total:247.98 €'),
(134, 2, '2013-06-24 10:30:13', 'Producto', '2', 'Modificación', 'stock:86 84 '),
(135, 2, '2013-06-24 10:30:13', 'Producto', '3', 'Modificación', 'stock:67 65 '),
(136, 2, '2013-06-24 10:30:38', 'Venta', '2', 'Inserción', 'Total:144.33 €'),
(137, 2, '2013-06-24 10:30:38', 'Producto', '18', 'Modificación', 'stock:180 179 '),
(138, 2, '2013-06-24 10:30:38', 'Producto', '6', 'Modificación', 'stock:21 19 '),
(139, 2, '2013-06-24 10:31:01', 'Venta', '3', 'Inserción', 'Total:39 €'),
(140, 2, '2013-06-24 10:31:01', 'Producto', '15', 'Modificación', 'stock:96 93 '),
(141, 2, '2013-06-24 10:31:31', 'Reserva', '4', 'Inserción', 'Total:142 €'),
(142, 2, '2013-06-24 10:31:31', 'Producto', '56', 'Modificación', 'reservado:0 2 '),
(143, 2, '2013-06-24 10:31:57', 'Reserva', '5', 'Inserción', 'Total:150 €'),
(144, 2, '2013-06-24 10:31:57', 'Producto', '8', 'Modificación', 'stock:119 116 apartado:0 3 '),
(145, 2, '2013-06-24 10:32:11', 'Cita', '6', 'Inserción', ''),
(146, 2, '2013-06-24 10:32:18', 'Cita', '7', 'Inserción', ''),
(147, 2, '2013-06-24 10:32:24', 'Cita', '8', 'Inserción', ''),
(148, 2, '2013-06-24 10:32:30', 'Cita', '9', 'Inserción', ''),
(149, 2, '2013-06-24 10:32:33', 'Cita', '10', 'Inserción', ''),
(150, 2, '2013-06-24 10:32:38', 'Cita', '11', 'Inserción', ''),
(151, 3, '2013-06-24 10:33:30', 'Venta', '12', 'Inserción', 'Total:224.99 €'),
(152, 3, '2013-06-24 10:33:30', 'Producto', '11', 'Modificación', 'stock:21 20 '),
(153, 3, '2013-06-24 10:33:30', 'Producto', '5', 'Modificación', 'stock:133 132 '),
(154, 3, '2013-06-24 10:33:30', 'Producto', '7', 'Modificación', 'stock:185 184 '),
(155, 3, '2013-06-24 10:33:56', 'Reserva', '13', 'Inserción', 'Total:179.32 €'),
(156, 3, '2013-06-24 10:33:56', 'Producto', '4', 'Modificación', 'stock:96 94 apartado:0 2 '),
(157, 3, '2013-06-24 10:34:07', 'Cita', '14', 'Inserción', ''),
(158, 3, '2013-06-24 10:34:11', 'Cita', '15', 'Inserción', ''),
(159, 3, '2013-06-24 10:34:16', 'Cita', '16', 'Inserción', ''),
(160, 3, '2013-06-25 10:37:05', 'Venta', '17', 'Inserción', 'Total:191.32 €'),
(161, 3, '2013-06-25 10:37:05', 'Producto', '13', 'Modificación', 'stock:72 70 '),
(162, 3, '2013-06-25 10:37:05', 'Producto', '21', 'Modificación', 'stock:37 35 '),
(163, 3, '2013-06-25 10:37:25', 'Venta', '18', 'Inserción', 'Total:149.32 €'),
(164, 3, '2013-06-25 10:37:26', 'Producto', '13', 'Modificación', 'stock:70 68 '),
(165, 3, '2013-06-25 10:37:26', 'Producto', '5', 'Modificación', 'stock:132 131 '),
(166, 3, '2013-06-25 10:38:11', 'Venta', '19', 'Inserción', 'Total:79.32 €'),
(167, 3, '2013-06-25 10:38:11', 'Producto', '4', 'Modificación', 'apartado:2 0 '),
(168, 3, '2013-06-25 10:38:24', 'Venta', '20', 'Inserción', 'Total:50 €'),
(169, 3, '2013-06-25 10:38:24', 'Producto', '8', 'Modificación', 'apartado:3 0 '),
(170, 3, '2013-06-25 10:38:48', 'Venta', '21', 'Inserción', 'Total:264.98 €'),
(171, 3, '2013-06-25 10:38:48', 'Producto', '4', 'Modificación', 'stock:94 93 '),
(172, 3, '2013-06-25 10:38:48', 'Producto', '3', 'Modificación', 'stock:65 64 '),
(173, 3, '2013-06-25 10:38:48', 'Producto', '2', 'Modificación', 'stock:84 83 '),
(174, 3, '2013-06-25 10:38:48', 'Producto', '1', 'Modificación', 'stock:181 180 '),
(175, 3, '2013-06-25 10:39:00', 'Cita', '22', 'Inserción', ''),
(176, 3, '2013-06-25 10:39:05', 'Cita', '23', 'Inserción', ''),
(177, 3, '2013-06-25 10:39:11', 'Cita', '24', 'Inserción', ''),
(178, 3, '2013-06-25 10:39:14', 'Cita', '25', 'Inserción', ''),
(179, 3, '2013-06-25 10:39:46', 'Reserva', '26', 'Inserción', 'Total:118.68 €'),
(180, 3, '2013-06-25 10:39:46', 'Producto', '77', 'Modificación', 'reservado:0 4 '),
(181, 4, '2013-06-26 10:41:17', 'Venta', '27', 'Inserción', 'Total:291.31 €'),
(182, 4, '2013-06-26 10:41:17', 'Producto', '13', 'Modificación', 'stock:68 65 '),
(183, 4, '2013-06-26 10:41:17', 'Producto', '4', 'Modificación', 'stock:93 91 '),
(184, 4, '2013-06-26 10:41:38', 'Venta', '28', 'Inserción', 'Total:52 €'),
(185, 4, '2013-06-26 10:41:38', 'Producto', '15', 'Modificación', 'stock:93 89 '),
(186, 4, '2013-06-26 10:42:13', 'Reserva', '29', 'Inserción', 'Total:37.33 €'),
(187, 4, '2013-06-26 10:42:13', 'Producto', '13', 'Modificación', 'stock:65 64 apartado:0 1 '),
(188, 4, '2013-06-26 10:42:25', 'Cita', '30', 'Inserción', ''),
(189, 4, '2013-06-26 10:42:34', 'Cita', '31', 'Inserción', ''),
(190, 4, '2013-06-26 10:43:17', 'Pedido', '1', 'Inserción', 'Total:90 €'),
(191, 4, '2013-06-26 10:44:09', 'Pedido', '2', 'Inserción', 'Total:135 €'),
(192, 3, '2013-06-26 10:44:30', 'Pedido', '2', 'Modificación', ''),
(193, 3, '2013-06-26 10:44:30', 'Producto', '77', 'Modificación', 'stock:2 17 '),
(194, 3, '2013-06-26 10:44:30', 'Pedido', '1', 'Modificación', ''),
(195, 3, '2013-06-26 10:44:30', 'Producto', '56', 'Modificación', 'stock:0 10 '),
(196, 3, '2013-06-26 10:44:40', 'Venta', '32', 'Inserción', 'Total:18.68 €'),
(197, 3, '2013-06-26 10:44:40', 'Producto', '77', 'Modificación', 'stock:17 13 reservado:4 0 '),
(198, 3, '2013-06-26 10:44:49', 'Producto', '56', 'Modificación', 'stock:10 8 reservado:2 0 apartado:0 2 '),
(199, 3, '2013-06-26 10:44:56', 'Venta', '33', 'Inserción', 'Total:42 €'),
(200, 3, '2013-06-26 10:44:56', 'Producto', '56', 'Modificación', 'apartado:2 0 '),
(201, 3, '2013-06-26 10:45:16', 'Venta', '34', 'Inserción', 'Total:7.33 €'),
(202, 3, '2013-06-26 10:45:16', 'Producto', '13', 'Modificación', 'apartado:1 0 '),
(203, 3, '2013-06-26 10:46:32', 'Pedido', '3', 'Inserción', 'Total:1253.2 €'),
(204, 5, '2013-06-27 10:47:51', 'Venta', '35', 'Inserción', 'Total:207.67 €'),
(205, 5, '2013-06-27 10:47:51', 'Producto', '7', 'Modificación', 'stock:184 182 '),
(206, 5, '2013-06-27 10:47:51', 'Producto', '16', 'Modificación', 'stock:6 5 '),
(207, 5, '2013-06-27 10:48:17', 'Devolucion', '36', 'Inserción', 'Total:37.33 €'),
(208, 5, '2013-06-27 10:48:17', 'Producto', '13', 'Modificación', 'stock:64 65 '),
(209, 5, '2013-06-27 10:48:45', 'Devolucion', '37', 'Inserción', 'Total:63.67 €'),
(210, 5, '2013-06-27 10:48:45', 'Producto', '16', 'Modificación', 'stock:5 6 '),
(211, 5, '2013-06-27 10:49:06', 'Venta', '38', 'Inserción', 'Total:327 €'),
(212, 5, '2013-06-27 10:49:06', 'Producto', '14', 'Modificación', 'stock:197 194 '),
(213, 5, '2013-06-27 10:49:06', 'Producto', '16', 'Modificación', 'stock:6 3 '),
(214, 5, '2013-06-27 10:49:20', 'Cita', '39', 'Inserción', ''),
(215, 1, '2013-06-27 10:49:50', 'Venta', '40', 'Inserción', 'Total:363.97 €'),
(216, 1, '2013-06-27 10:49:50', 'Producto', '2', 'Modificación', 'stock:83 82 '),
(217, 1, '2013-06-27 10:49:50', 'Producto', '3', 'Modificación', 'stock:64 62 '),
(218, 1, '2013-06-27 10:49:50', 'Producto', '4', 'Modificación', 'stock:91 89 '),
(219, 1, '2013-06-27 10:50:15', 'Venta', '41', 'Inserción', 'Total:270.01 €'),
(220, 1, '2013-06-27 10:50:15', 'Producto', '2', 'Modificación', 'stock:82 81 '),
(221, 1, '2013-06-27 10:50:15', 'Producto', '85', 'Modificación', 'stock:155 153 '),
(222, 1, '2013-06-27 10:50:15', 'Producto', '63', 'Modificación', 'stock:66 64 '),
(223, 1, '2013-06-27 10:50:26', 'Pedido', '3', 'Modificación', ''),
(224, 1, '2013-06-27 10:50:26', 'Producto', '6', 'Modificación', 'stock:19 39 '),
(225, 1, '2013-06-27 10:50:26', 'Producto', '54', 'Modificación', 'stock:9 29 '),
(226, 1, '2013-06-27 10:50:38', 'Cita', '42', 'Inserción', ''),
(227, 1, '2013-06-27 10:50:44', 'Cita', '43', 'Inserción', ''),
(228, 1, '2013-06-27 10:51:10', 'Venta', '44', 'Inserción', 'Total:165.32 €'),
(229, 1, '2013-06-27 10:51:10', 'Producto', '14', 'Modificación', 'stock:194 192 '),
(230, 1, '2013-06-27 10:51:10', 'Producto', '13', 'Modificación', 'stock:65 63 '),
(231, 1, '2013-06-27 10:52:24', 'Venta', '45', 'Inserción', 'Total:311.31 €'),
(232, 1, '2013-06-27 10:52:24', 'Producto', '2', 'Modificación', 'stock:81 78 '),
(233, 1, '2013-06-27 10:52:24', 'Producto', '3', 'Modificación', 'stock:62 60 '),
(234, 1, '2013-06-28 10:57:11', 'Festivo', '1', 'Inserción', ''),
(235, 1, '2013-06-28 10:57:15', 'Festivo', '2', 'Inserción', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `Operacion`
--

INSERT INTO `Operacion` (`id`, `cliente_id`, `empleado_id`, `fechaoper`, `tipo`) VALUES
(1, 21, 2, '2013-06-24 10:30:13', 'venta'),
(2, 23, 2, '2013-06-24 10:30:38', 'venta'),
(3, 7, 2, '2013-06-24 10:31:01', 'venta'),
(4, 2, 2, '2013-06-24 10:31:31', 'reserva'),
(5, 3, 2, '2013-06-24 10:31:57', 'reserva'),
(6, 1, 2, '2013-06-24 10:32:11', 'cita'),
(7, 11, 2, '2013-06-24 10:32:18', 'cita'),
(8, 1, 2, '2013-06-24 10:32:24', 'cita'),
(9, 24, 2, '2013-06-24 10:32:30', 'cita'),
(10, 5, 2, '2013-06-24 10:32:33', 'cita'),
(11, 25, 2, '2013-06-24 10:32:38', 'cita'),
(12, 4, 3, '2013-06-24 10:33:30', 'venta'),
(13, 20, 3, '2013-06-24 10:33:56', 'reserva'),
(14, 1, 3, '2013-06-24 10:34:07', 'cita'),
(15, 9, 3, '2013-06-24 10:34:11', 'cita'),
(16, 17, 3, '2013-06-24 10:34:16', 'cita'),
(17, 6, 3, '2013-06-25 10:37:05', 'venta'),
(18, 16, 3, '2013-06-25 10:37:25', 'venta'),
(19, 20, 3, '2013-06-25 10:38:11', 'venta'),
(20, 3, 3, '2013-06-25 10:38:24', 'venta'),
(21, 20, 3, '2013-06-25 10:38:48', 'venta'),
(22, 2, 3, '2013-06-25 10:39:00', 'cita'),
(23, 11, 3, '2013-06-25 10:39:05', 'cita'),
(24, 5, 3, '2013-06-25 10:39:11', 'cita'),
(25, 24, 3, '2013-06-25 10:39:14', 'cita'),
(26, 4, 3, '2013-06-25 10:39:46', 'reserva'),
(27, 1, 4, '2013-06-26 10:41:17', 'venta'),
(28, 4, 4, '2013-06-26 10:41:38', 'venta'),
(29, 10, 4, '2013-06-26 10:42:13', 'reserva'),
(30, 2, 4, '2013-06-26 10:42:25', 'cita'),
(31, 21, 4, '2013-06-26 10:42:34', 'cita'),
(32, 4, 3, '2013-06-26 10:44:40', 'venta'),
(33, 2, 3, '2013-06-26 10:44:56', 'venta'),
(34, 10, 3, '2013-06-26 10:45:16', 'venta'),
(35, 5, 5, '2013-06-27 10:47:51', 'venta'),
(36, 10, 5, '2013-06-27 10:48:17', 'devolucion'),
(37, 5, 5, '2013-06-27 10:48:45', 'devolucion'),
(38, 1, 5, '2013-06-27 10:49:06', 'venta'),
(39, 3, 5, '2013-06-27 10:49:20', 'cita'),
(40, 21, 1, '2013-06-27 10:49:50', 'venta'),
(41, 15, 1, '2013-06-27 10:50:15', 'venta'),
(42, 3, 1, '2013-06-27 10:50:38', 'cita'),
(43, 25, 1, '2013-06-27 10:50:44', 'cita'),
(44, 13, 1, '2013-06-27 10:51:10', 'venta'),
(45, 1, 1, '2013-06-27 10:52:24', 'venta');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Pedido`
--

INSERT INTO `Pedido` (`id`, `proveedor_id`, `empleado_id`, `recepciona_id`, `fecha`, `fecharecepcion`, `total`) VALUES
(1, 1, 4, 3, '2013-06-26 10:43:17', '2013-06-26 10:44:30', 90),
(2, 2, 4, 3, '2013-06-26 10:44:09', '2013-06-26 10:44:30', 135),
(3, 4, 3, 1, '2013-06-26 10:46:32', '2013-06-27 10:50:26', 1253);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Permiso`
--

INSERT INTO `Permiso` (`id`, `empleado_id`, `fecha`, `inicio`, `fin`, `tipo`) VALUES
(1, 4, '2013-06-28 10:57:52', '2013-07-02 09:00:00', '2013-07-02 09:00:00', 'baja'),
(3, 5, '2013-06-28 10:58:12', '2013-07-08 09:00:00', '2013-07-18 09:00:00', 'verano');

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
(1, 4, 1, 'air optix aqua +2.5', 180, 0, 0, 51.33, 8, '21'),
(2, 4, 1, 'Biofinity +1.25', 78, 0, 0, 63.33, 9.33, '21'),
(3, 3, 1, 'Biofinity -1.25', 60, 0, 0, 60.66, 1.33, '18'),
(4, 4, 1, 'Biofinity -0.75', 89, 0, 0, 89.66, 30.33, '21'),
(5, 1, 1, 'Biofinity +2.5', 131, 0, 0, 74.66, 17.33, '4'),
(6, 4, 1, 'Biofinity +2', 39, 0, 0, 45, 32.33, '21'),
(7, 3, 1, 'acuvue Oasys +3', 182, 0, 0, 72, 28, '18'),
(8, 3, 1, 'Proclear sphere -1', 116, 0, 0, 50, 26.67, '18'),
(9, 1, 1, 'Soflens 59 +0.5', 32, 0, 0, 64.67, 14, '4'),
(10, 2, 1, 'softlens 38 +0.25', 78, 0, 0, 43, 21, '8'),
(11, 4, 1, 'Proclear toric +1', 20, 0, 0, 78.33, 29, '21'),
(12, 1, 1, 'Biomedics 55 evolution +1.5', 162, 0, 0, 11.66, 0.33, '4'),
(13, 2, 1, 'Purevision +1', 63, 0, 0, 37.33, 31.33, '8'),
(14, 3, 2, 'Rayban rx 5114', 192, 0, 0, 45.33, 8, '18'),
(15, 1, 2, 'Polo Ralph OPH 2039', 89, 0, 0, 13, 5.67, '4'),
(16, 3, 2, 'Polo Ralph ORA 7021', 3, 0, 0, 63.67, 25, '18'),
(17, 4, 2, 'Rayban rx 7026', 104, 0, 0, 50, 5.33, '21'),
(18, 3, 2, 'Rayban rx 2312', 179, 0, 0, 54.33, 22.33, '18'),
(19, 4, 2, 'Prada Pr 10FV', 168, 0, 0, 18, 6, '21'),
(20, 1, 2, 'Boss orange 0036', 48, 0, 0, 71, 7, '4'),
(21, 3, 2, 'Carrera Ca 6175', 35, 0, 0, 58.33, 9, '18'),
(22, 3, 2, 'Gucci GG 1612', 126, 0, 0, 31, 24.33, '18'),
(23, 1, 2, 'Police v 1677', 133, 0, 0, 45, 3, '4'),
(24, 1, 2, 'Vogue dd 2555', 189, 0, 0, 60.67, 32, '4'),
(25, 3, 2, 'Oakley ox 1066', 137, 0, 0, 79, 26.33, '18'),
(26, 2, 2, 'Nike 4162', 31, 0, 0, 40.67, 28, '8'),
(27, 4, 2, 'Adidas Fc 2343', 91, 0, 0, 88.67, 26, '21'),
(28, 3, 3, 'Vogue 3846s', 64, 0, 0, 52.33, 33, '18'),
(29, 4, 3, 'Vogue 2832sb', 161, 0, 0, 5.33, 3.33, '21'),
(30, 3, 3, 'Vogue 2795s', 63, 0, 0, 15, 11.67, '18'),
(31, 4, 3, 'Vogue 2818s', 196, 0, 0, 76, 13.33, '21'),
(32, 1, 3, 'Prada 27ps', 84, 0, 0, 75.34, 14.67, '4'),
(33, 4, 3, 'Prada 29ps', 50, 0, 0, 65.67, 15, '21'),
(34, 3, 3, 'Prada 21ps', 136, 0, 0, 33.66, 30.33, '18'),
(35, 4, 3, 'Polo Ralph 4076', 110, 0, 0, 28, 25.33, '21'),
(36, 2, 3, 'Polo Ralph 4077', 185, 0, 0, 56.67, 30.67, '8'),
(37, 3, 3, 'Bvigari 8113B', 125, 0, 0, 71.66, 10.33, '18'),
(38, 2, 3, 'Bvigari 8105B', 80, 0, 0, 45.67, 15, '8'),
(39, 1, 3, 'Bvigari 8116B', 84, 0, 0, 75.33, 17.33, '4'),
(40, 1, 3, 'Chanel 5434', 164, 0, 0, 48, 13.33, '4'),
(41, 2, 3, 'Chanel 3454', 117, 0, 0, 51.67, 31.67, '8'),
(42, 3, 3, 'Chanel 2343T', 171, 0, 0, 56.34, 29.67, '18'),
(43, 2, 3, 'Chanel 2378r', 197, 0, 0, 63, 27, '8'),
(44, 3, 3, 'Chanel 3456', 182, 0, 0, 84.33, 27, '18'),
(45, 1, 3, 'Chanel 5467', 38, 0, 0, 44, 21.33, '4'),
(46, 3, 3, 'Arnette 4544', 113, 0, 0, 50.66, 23.33, '18'),
(47, 1, 3, 'Arnette 4514', 49, 0, 0, 82.33, 25, '4'),
(48, 2, 3, 'Arnette 4678', 157, 0, 0, 63, 33, '8'),
(49, 3, 3, 'Arnette 4554y', 195, 0, 0, 76, 20, '18'),
(50, 3, 3, 'Gucci 4544', 130, 0, 0, 25.34, 2.67, '18'),
(51, 4, 3, 'Gucci 4333', 135, 0, 0, 16.33, 15, '21'),
(52, 2, 3, 'Carrera 6000R', 105, 0, 0, 57, 5.67, '8'),
(53, 1, 3, 'Carrera 5003', 79, 0, 0, 56.67, 32, '4'),
(54, 4, 3, 'Hugo Boss 0522S', 29, 0, 0, 31, 30.33, '21'),
(55, 2, 3, 'Hugo boss 0567E', 28, 0, 0, 16.33, 13, '8'),
(56, 1, 3, 'Hugo Boss 04556', 8, 0, 0, 71, 9, '4'),
(57, 1, 3, 'Hugo boss 0513S', 77, 0, 0, 48, 24, '4'),
(58, 1, 3, 'Rayban 3503', 141, 0, 0, 46, 32, '4'),
(59, 1, 3, 'Rayban 4167', 18, 0, 0, 93, 31, '4'),
(60, 1, 3, 'Rayban Aviator 3015', 119, 0, 0, 44.33, 29, '4'),
(61, 4, 3, 'Rayban Aviator 3012', 129, 0, 0, 56, 6.67, '21'),
(62, 2, 3, 'Rayban Aviator 3011', 164, 0, 0, 19.66, 8.33, '8'),
(63, 2, 3, 'Rayban Aviator 2034', 64, 0, 0, 28.34, 1.67, '8'),
(64, 1, 3, 'Rayban Aviator 2343', 172, 0, 0, 73, 31, '4'),
(65, 4, 4, 'Estuche ranas', 20, 0, 0, 52, 28, '21'),
(66, 3, 4, 'Estuche pez', 37, 0, 0, 42.33, 22.33, '18'),
(67, 2, 4, 'Estuche ositos', 140, 0, 0, 35, 7.67, '8'),
(68, 2, 4, 'estuche eclipse', 181, 0, 0, 87.67, 27.67, '8'),
(69, 1, 4, 'estuche elefantes', 104, 0, 0, 38.66, 19.33, '4'),
(70, 1, 4, 'estuche cerditos', 121, 0, 0, 24, 13.33, '4'),
(71, 2, 4, 'estuche de otoño', 98, 0, 0, 70.33, 25, '8'),
(72, 2, 4, 'lupa regla 210mm', 82, 0, 0, 19, 1.67, '8'),
(73, 4, 4, 'cadena dorada 0406', 49, 0, 0, 29, 12.33, '21'),
(74, 1, 4, 'cadena roja 0456', 21, 0, 0, 38.34, 17.67, '4'),
(75, 3, 4, 'cadena marron 0426', 190, 0, 0, 45, 27.67, '18'),
(76, 3, 4, 'estuche polka', 132, 0, 0, 20.67, 4, '18'),
(77, 2, 5, 'Sibosol set', 13, 0, 0, 29.67, 9, '8'),
(78, 3, 5, 'optifree express 500ml', 22, 0, 0, 36, 23.33, '18'),
(79, 3, 5, 'renu multiplus 240ml', 132, 0, 0, 39, 3.67, '18'),
(80, 3, 5, 'solocare aqua 360ml', 58, 0, 0, 35.33, 23.33, '18'),
(81, 2, 5, 'biotrue 300ml', 84, 0, 0, 43, 11.67, '8'),
(82, 3, 5, 'sibosol 250ml', 153, 0, 0, 78.67, 26.67, '18'),
(83, 3, 5, 'gotas Ciba aguify', 93, 0, 0, 65, 29, '18'),
(84, 4, 5, 'Easysept', 140, 0, 0, 67, 7, '21'),
(85, 4, 5, 'Complete', 153, 0, 0, 75, 25, '21'),
(86, 1, 5, 'Oxysept 1 step', 81, 0, 0, 24.33, 24.33, '4'),
(87, 3, 5, 'opticrom gotas 5ml', 106, 0, 0, 18, 4, '18'),
(88, 1, 5, 'iclean 50ml', 72, 0, 0, 41, 9.67, '4'),
(89, 4, 5, 'boston simplus 120ml', 117, 0, 0, 58, 18.67, '21');

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
(1, 'gafaskost', 'Calle Dolorosa 3', '929955945', 'Madrid', 'Madrid', 'gafaskost@hotmail.com'),
(2, 'esunvision', 'calle Villafuerte 23', '934940120', 'Aranjuez', 'Madrid', 'esunvision@hotmail.com'),
(3, 'ocho8', 'calle los bohemihos 1', '919012133', 'Boadilla del monte', 'Madrid', 'ocho8@hotmail.com'),
(4, 'Puckator', 'calle de la generosidad 12', '975536725', 'Fuenlabrada', 'Madrid', 'Puckator@hotmail.com'),
(5, 'luxottica', 'av de la felicidad 32', '917052995', 'Getafe', 'Madrid', 'luxottica@hotmail.com'),
(6, 'termopower', 'calle humanidad 11', '913807933', 'Alcorcón', 'Madrid', 'termopower@hotmail.com'),
(7, 'solextrem', 'calle dulzura 34', '939552111', 'Alcobendas', 'Madrid', 'solextrem@hotmail.com'),
(8, 'dipo', 'calle conciliación 5', '909090635', 'Léganes', 'Madrid', 'dipo@hotmail.com');

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
(4, 33, 'tarjeta', 100, '2013-06-26 10:44:49', 100, 142, 'no'),
(5, 20, 'efectivo', 100, NULL, 100, 150, 'si'),
(13, 19, 'tarjeta', 100, NULL, 100, 179.32, 'si'),
(26, 32, 'tarjeta', 100, NULL, 100, 118.68, 'no'),
(29, 34, 'efectivo', 40, NULL, 30, 37.33, 'si');

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
(1, '68510091y', 'Lola', 'Perez', 'Moreno', 'calle Feduchy 3º B', 'Chipiona', 'Cádiz', '908913808', '668510091', 'lolamoreno@hotmail.es'),
(2, '05106504m', 'Antonio', 'Martín', 'Romero', 'calle San francisco 1º D', 'Chiclana de la frontera', 'Cádiz', '932731432', '605106504', 'antonioromero@hotmail.es'),
(3, '21663924i', 'Juan Manuel', 'Jiménez', 'Guitierrez', 'calle Mesón 1º E', 'San fernando', 'Cádiz', '959898329', '621663924', 'juanmanuelguitierrez@lycos.es'),
(4, '15266552b', 'Luis', 'Alonso', 'Perez', 'Calle San Juan bajo drcha', 'Puerto Real', 'Cádiz', '920294403', '615266552', 'luisperez@lycos.es'),
(5, '61894445e', 'Alicia', 'Martín', 'Gomez', 'calle Pelota 1º A', 'Bornos', 'Cádiz', '978457606', '661894445', 'aliciagomez@yahoo.es'),
(6, '46832042w', 'Isabel', 'Vazquez', 'Vazquez', 'Calle columela 2º B', 'Algar', 'Cádiz', '907352613', '646832042', 'isabelvazquez@gmail.com'),
(7, '26783397r', 'Isabel', 'Perez', 'Navarro', 'Calle Jose del Toro 2º A', 'Algodonales', 'Cádiz', '977431290', '626783397', 'isabelnavarro@yahoo.es'),
(8, '38639320k', 'Jesus', 'Sanchez', 'Navarro', 'Calle osorio 1º E', 'Algar', 'Cádiz', '934171598', '638639320', 'jesusnavarro@lycos.es'),
(9, '86795568e', 'Juan', 'Alonso', 'Ruiz', 'Calle Valverde 1º B', 'Benalup', 'Cádiz', '927997177', '686795568', 'juanruiz@gmail.com'),
(10, '73339741t', 'Carmen', 'Delgado', 'Delgado', 'Calle Colarte 2º B', 'Algar', 'Cádiz', '905591929', '673339741', 'carmendelgado@hotmail.es'),
(11, '96172615p', 'Raul', 'Delgado', 'Jiménez', 'Calle San Salvador 2º drcha', 'Grazalema', 'Cádiz', '983731716', '696172615', 'rauljimenez@lycos.es'),
(12, '63457268u', 'Diego', 'Ramírez', 'Gomez', ' Calle gas 1º izq', 'Grazalema', 'Cádiz', '935201585', '663457268', 'diegogomez@gmail.com'),
(13, '79210752g', 'Alberto', 'Fernandez', 'Sanchez', 'Calle Luis Barile 1º A', 'Chipiona', 'Cádiz', '922283029', '679210752', 'albertosanchez@lycos.es'),
(14, '39335680k', 'Raul', 'Gonzalez', 'Fernandez', 'Av Segunda aguada 3º C', 'Grazalema', 'Cádiz', '910510161', '639335680', 'raulfernandez@yahoo.es'),
(15, '12241951m', 'Álvaro', 'Díaz', 'Fernandez', 'Calle San Gabriel 2º C', 'Benalup', 'Cádiz', '954477349', '612241951', 'alvarofernandez@lycos.es'),
(16, '94847997l', 'Lola', 'Del monte', 'Vazquez', 'Av Marconi 1º B', 'Algar', 'Cádiz', '984293285', '694847997', 'lolavazquez@yahoo.es'),
(17, '88128691w', 'Alberto', 'Perez', 'Sanchez', 'Calle Grazalema 2º izq', 'Algodonales', 'Cádiz', '926361758', '688128691', 'albertosanchez@gmail.com'),
(18, '44004829t', 'Jose', 'Serrano', 'Fernandez', 'Calle Guadalmesí 1º A', 'Jerez de la frontera', 'Cádiz', '907606578', '644004829', 'josefernandez@lycos.es'),
(19, '39754253r', 'Mario', 'Ramírez', 'Rodriguez', 'Av Lacave 1º A', 'Barbate', 'Cádiz', '977990669', '639754253', 'mariorodriguez@gmail.com'),
(20, '74736698j', 'Mario', 'Jiménez', 'Delgado', 'Av de la Bahía 1º A', 'Algodonales', 'Cádiz', '992945401', '674736698', 'mariodelgado@yahoo.es'),
(21, '09661694d', 'Antonio', 'García', 'Vazquez', 'Calle Sotillo 1º E', 'Algodonales', 'Cádiz', '997123554', '609661694', 'antoniovazquez@yahoo.es'),
(22, '92662947w', 'Antonia', 'Ramos', 'Martínez', 'Calle Arillo 1º C', 'San fernando', 'Cádiz', '926731990', '692662947', 'antoniamartinez@yahoo.es'),
(23, '33652833w', 'Alberto', 'Alonso', 'Moreno', 'Calle Palmones 2º B', 'Barbate', 'Cádiz', '935257360', '633652833', 'albertomoreno@yahoo.es'),
(24, '70082186d', 'Maria', 'Alonso', 'Sanchez', 'Calle Guadairo 1º A', 'San fernando', 'Cádiz', '908044062', '670082186', 'mariasanchez@gmail.com'),
(25, '81679780u', 'Davinia', 'Lopez', 'Rodriguez', 'Calle Alonso Cano 1º D ', 'Jerez de la frontera', 'Cádiz', '934781239', '681679780', 'daviniarodriguez@hotmail.es');

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
(1, 247.98, 'tarjeta', 0),
(2, 144.33, 'tarjeta', 0),
(3, 39, 'efectivo', 40),
(12, 224.99, 'tarjeta', 0),
(17, 191.32, 'efectivo', 200),
(18, 149.32, 'tarjeta', 0),
(19, 79.32, 'tarjeta', 0),
(20, 50, 'tarjeta', 0),
(21, 264.98, 'efectivo', 270),
(27, 291.31, 'tarjeta', 0),
(28, 52, 'tarjeta', 0),
(32, 18.68, 'tarjeta', 0),
(33, 42, 'tarjeta', 0),
(34, 7.33, 'efectivo', 10),
(35, 207.67, 'tarjeta', 0),
(38, 327, 'tarjeta', 0),
(40, 363.97, 'tarjeta', 0),
(41, 270.01, 'tarjeta', 0),
(44, 165.32, 'tarjeta', 0),
(45, 311.31, 'efectivo', 320);

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

-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-03-2011 a las 21:31:09
-- Versión del servidor: 5.0.91
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `arayaper_codekamx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albalinea`
--
-- Creación: 22-02-2011 a las 17:44:27
-- Última actualización: 06-03-2011 a las 14:44:38
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `albalinea` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) character set utf8 default NULL,
  `cantidad` decimal(19,2) NOT NULL default '0.00',
  `precio` decimal(19,2) NOT NULL default '0.00',
  `importe` decimal(19,2) NOT NULL default '0.00',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `albalinea`
--

INSERT INTO `albalinea` (`codalbaran`, `numlinea`, `codfamilia`, `codigo`, `cantidad`, `precio`, `importe`, `dcto`) VALUES
(2, 1, 61, '49', '1.00', '60.00', '60.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albalineap`
--
-- Creación: 23-02-2011 a las 01:22:45
-- Última actualización: 23-02-2011 a las 01:22:45
--

CREATE TABLE IF NOT EXISTS `albalineap` (
  `codalbaran` varchar(20) NOT NULL default '0',
  `codproveedor` int(5) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) default NULL,
  `cantidad` decimal(10,2) NOT NULL default '0.00',
  `precio` decimal(19,2) NOT NULL default '0.00',
  `importe` decimal(19,2) NOT NULL default '0.00',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`codproveedor`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `albalineap`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albalineaptmp`
--
-- Creación: 23-02-2011 a las 01:22:56
-- Última actualización: 23-02-2011 a las 01:22:56
--

CREATE TABLE IF NOT EXISTS `albalineaptmp` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) default NULL,
  `cantidad` decimal(19,2) NOT NULL default '0.00',
  `precio` decimal(19,2) NOT NULL default '0.00',
  `importe` decimal(19,2) NOT NULL default '0.00',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `albalineaptmp`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albalineatmp`
--
-- Creación: 21-02-2011 a las 12:46:15
-- Última actualización: 06-03-2011 a las 14:44:35
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `albalineatmp` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) character set utf8 default NULL,
  `cantidad` decimal(19,2) NOT NULL default '0.00',
  `precio` decimal(19,2) NOT NULL default '0.00',
  `importe` decimal(19,2) NOT NULL default '0.00',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `albalineatmp`
--

INSERT INTO `albalineatmp` (`codalbaran`, `numlinea`, `codfamilia`, `codigo`, `cantidad`, `precio`, `importe`, `dcto`) VALUES
(160, 1, 61, '49', '1.00', '60.00', '60.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranes`
--
-- Creación: 22-02-2011 a las 17:45:06
-- Última actualización: 06-03-2011 a las 14:44:38
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `albaranes` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `codfactura` int(11) NOT NULL default '0',
  `fecha` date NOT NULL default '0000-00-00',
  `iva` tinyint(4) NOT NULL default '0',
  `codcliente` int(5) default '0',
  `estado` varchar(1) character set utf8 default '1',
  `totalalbaran` decimal(19,2) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `albaranes`
--

INSERT INTO `albaranes` (`codalbaran`, `codfactura`, `fecha`, `iva`, `codcliente`, `estado`, `totalalbaran`, `borrado`) VALUES
(2, 0, '2011-03-06', 19, 18, '1', '71.40', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranesp`
--
-- Creación: 22-02-2011 a las 17:45:16
-- Última actualización: 26-02-2011 a las 13:23:05
-- Última revisión: 26-02-2011 a las 13:23:05
--

CREATE TABLE IF NOT EXISTS `albaranesp` (
  `codalbaran` varchar(20) NOT NULL default '0',
  `codproveedor` int(5) NOT NULL default '0',
  `codfactura` varchar(20) default NULL,
  `fecha` date NOT NULL default '0000-00-00',
  `iva` tinyint(4) NOT NULL default '0',
  `estado` varchar(1) default '1',
  `totalalbaran` decimal(19,2) NOT NULL default '0.00',
  PRIMARY KEY  (`codalbaran`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `albaranesp`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranesptmp`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 07-03-2011 a las 20:51:11
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `albaranesptmp` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Temporal de albaranes de proveedores para controlar acceso s' AUTO_INCREMENT=99 ;

--
-- Volcar la base de datos para la tabla `albaranesptmp`
--

INSERT INTO `albaranesptmp` (`codalbaran`, `fecha`) VALUES
(97, '2011-03-07'),
(98, '2011-03-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranestmp`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 07-03-2011 a las 03:45:28
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `albaranestmp` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo' AUTO_INCREMENT=164 ;

--
-- Volcar la base de datos para la tabla `albaranestmp`
--

INSERT INTO `albaranestmp` (`codalbaran`, `fecha`) VALUES
(159, '2011-03-06'),
(160, '2011-03-06'),
(161, '2011-03-06'),
(162, '2011-03-06'),
(163, '2011-03-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--
-- Creación: 07-11-2010 a las 16:09:05
-- Última actualización: 07-03-2011 a las 15:58:48
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `codarticulo` int(10) NOT NULL auto_increment,
  `codfamilia` int(5) NOT NULL,
  `referencia` varchar(35) NOT NULL,
  `descripcion` varchar(35) NOT NULL,
  `impuesto` float NOT NULL,
  `codproveedor1` int(5) NOT NULL default '1',
  `codproveedor2` int(5) NOT NULL,
  `descripcion_corta` varchar(35) NOT NULL,
  `codubicacion` int(3) NOT NULL,
  `stock` int(10) NOT NULL,
  `stock_minimo` int(8) NOT NULL,
  `aviso_minimo` varchar(1) NOT NULL default '0',
  `datos_producto` varchar(200) NOT NULL,
  `fecha_alta` date NOT NULL default '0000-00-00',
  `codembalaje` int(3) NOT NULL,
  `unidades_caja` int(8) NOT NULL,
  `precio_ticket` varchar(1) NOT NULL default '0',
  `modificar_ticket` varchar(1) NOT NULL default '0',
  `observaciones` text NOT NULL,
  `precio_compra` decimal(19,2) default NULL,
  `precio_almacen` decimal(19,2) default NULL,
  `precio_tienda` decimal(19,2) default NULL,
  `precio_pvp` decimal(19,2) default NULL,
  `precio_iva` decimal(19,2) default NULL,
  `codigobarras` varchar(15) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codarticulo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Articulos' AUTO_INCREMENT=91 ;

--
-- Volcar la base de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`codarticulo`, `codfamilia`, `referencia`, `descripcion`, `impuesto`, `codproveedor1`, `codproveedor2`, `descripcion_corta`, `codubicacion`, `stock`, `stock_minimo`, `aviso_minimo`, `datos_producto`, `fecha_alta`, `codembalaje`, `unidades_caja`, `precio_ticket`, `modificar_ticket`, `observaciones`, `precio_compra`, `precio_almacen`, `precio_tienda`, `precio_pvp`, `precio_iva`, `codigobarras`, `imagen`, `borrado`) VALUES
(11, 18, '21023525674', 'Computador portatil bell', 19, 4, 5, 'computador bell', 1, -38, 2, '1', '', '2010-03-07', 3, 12, '1', '1', '', '120.00', '140.00', '180.00', NULL, '240.00', '5600000000113', 'foto11.jpg', '1'),
(12, 18, '21078945631', 'Computador portatil Cannon ', 19, 4, 5, 'computador portatil   cannon', 4, -52, 3, '1', '', '2010-03-07', 3, 1, '1', '1', '', '124.00', '126.00', '137.00', NULL, '167.00', '8400000000123', 'foto12.jpg', '1'),
(13, 19, '21089696314', 'Escritorio para notebook ', 19, 5, 6, 'escritorio', 1, -13, 1, '1', '', '2010-03-08', 3, 1, '1', '0', '', '234.00', '257.00', '567.00', NULL, '456.00', '8400000000130', 'foto13.jpg', '1'),
(34, 25, '21078952345', 'Tornillos caja computadores', 19, 7, 0, 'TORNILLOS  1 "', 5, 25, 18, '1', 'Tornillos de 1"', '2010-10-15', 3, 1, '0', '', 'Tornillos de hierro dulce', '0.54', '0.65', '0.70', NULL, '1.00', '8400000000345', 'foto34.jpg', '1'),
(39, 66, '21096314789', 'COOLER PARA CASE DE 12cm', 19, 15, 0, 'COOLER PARA CASE DE 12 cm', 3, 39, 1, '1', 'COOLER EVER GREEN FAN EVERCOOL DE 12cm', '2010-11-06', 7, 1, '1', '0', 'Modelo Nro EGF-12', '14.32', '17.04', '19.50', NULL, '24.99', '8400000001119', 'foto39.jpg', '1'),
(40, 66, '21096385248', 'Cooler MARTECH de 5cm', 19, 12, 0, 'COOLER  MARTECH de 5cm', 5, -28, 1, '0', 'Cooler para case MARTECH de 5cm color negro', '2010-11-06', 5, 1, '1', '0', 'Hecho en China', '4.00', '4.76', '5.52', NULL, '7.14', '8400000000406', 'foto40.jpg', '1'),
(41, 66, '20412896324', 'Personal computer Air Cond', 19, 12, 0, 'AIRE ACONDICIONADO PARA PC', 5, 230, 1, '1', 'Color: Azul con plateado / Dimensión: 149.5 x 42.7 x 85.5cm', '2010-11-06', 7, 1, '1', '0', 'Sólo para bahias de 5.25"', '18.27', '24.80', '25.00', NULL, '21.74', '8400000000879', 'foto41.jpg', '0'),
(42, 40, '21012385296', 'TARJETA DE RED INALAMBRICA TP-LINK ', 19, 16, 0, 'NIC INALAMBR TP-LINK TL-WN551', 5, -15196, 1, '1', 'Para Slot PCI / Rango 4x / seguridad WEB/WPA/WPA2/ fácil de usar / 54 Mbps / ', '2010-11-06', 1, 1, '1', '0', 'CON ANTENA OMNIDIRECCIONAL DESMONTABLE.', '36.54', '49.80', '50.00', NULL, '43.49', '8400000000420', 'foto42.jpg', '1'),
(49, 61, '21036985215', 'CARTUCHO DE TINTA CANON CL-31 TRICO', 19, 12, 0, 'CARTUCHO CANON CL-31 TRICOLOR', 5, 876, 1, '1', 'PARA IMPRESORAS SERIE PIXMA: IP1800/IP1900/IP2500/IP2600/MP140/MP190/MP210/MP220/MP470/MX300 & MX310', '2010-11-12', 1, 1, '1', '0', 'CARTUCHO TRICOLOR DE 3ml x 3ml = 9ml', '47.13', '60.00', '64.50', NULL, '56.08', '013803078411', 'foto49.jpg', '0'),
(50, 69, '21078996326', 'BATERIA PARA PC - SONY CR2032', 19, 13, 0, 'BATERIA  SONY CR2032', 5, -202, 1, '1', 'PARA COMPUTADORAS Y OTROS DISPOSITIVOS QUE UTILICEN ESTE MODELO DE BATERIAS', '2010-11-12', 1, 100, '1', '0', 'producto muy vrsatil', '85.00', '83.00', '115.00', NULL, '101.15', '56000324562', 'foto50.jpg', '1'),
(83, 61, '75022223804', 'Disco Compacto sin grabar', 19, 17, 16, 'CD grabable', 5, 573, 20, '1', '', '2010-12-18', 1, 500, '1', '0', 'No', '2.00', '3.00', '5.00', NULL, '8.20', '7502222380494', 'foto83.jpg', '0'),
(89, 72, '12324578789', 'Balanza', 19, 0, 0, 'Balanza Iris 2 Kg.', 5, 11, 7, '1', 'vvmbnmvmn', '2010-10-22', 8, 0, '0', '0', 'hjjhkbkjk', '123.00', '89.00', '789.00', NULL, '789631.00', '5600000000892', 'foto89.jpg', '0'),
(90, 72, '45636985274', 'Balanza americana 3 kilos', 19, 12, 0, 'Balanza Huneus 3 kilos', 5, -5, 1, '1', '', '2010-10-06', 8, 12, '1', '0', '', '123.00', '123.00', '123.00', '563.00', '2233.00', '5600000000908', 'foto90.jpg', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artpro`
--
-- Creación: 21-02-2011 a las 12:48:25
-- Última actualización: 26-02-2011 a las 16:01:51
-- Última revisión: 01-03-2011 a las 21:52:29
--

CREATE TABLE IF NOT EXISTS `artpro` (
  `codarticulo` varchar(15) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  PRIMARY KEY  (`codarticulo`,`codfamilia`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `artpro`
--

INSERT INTO `artpro` (`codarticulo`, `codfamilia`, `codproveedor`, `precio`) VALUES
('13', 18, 4, '234.00'),
('16', 18, 7, '114802.00'),
('16', 18, 8, '12352.00'),
('34', 25, 7, '0.54'),
('42', 40, 12, '36.54'),
('39', 66, 15, '14.32'),
('42', 40, 17, '36.54'),
('82', 63, 17, '95.00'),
('50', 69, 20, '85.00'),
('40', 66, 12, '5.00'),
('83', 61, 13, '2.00'),
('83', 61, 17, '4.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authteam`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
-- Última revisión: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `authteam` (
  `id` int(4) NOT NULL auto_increment,
  `teamname` varchar(25) NOT NULL default '',
  `teamlead` varchar(25) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `teamname` (`teamname`,`teamlead`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `authteam`
--

INSERT INTO `authteam` (`id`, `teamname`, `teamlead`, `status`) VALUES
(1, 'Ungrouped', 'sa', 'active'),
(2, 'Admin', 'sa', 'active'),
(3, 'Temporary', 'sa', 'active'),
(7, 'Group 1', 'sa', 'active'),
(8, 'Group 2', 'test', 'active'),
(9, 'Group 3', 'admin', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authuser`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `authuser` (
  `id` int(11) NOT NULL auto_increment,
  `uname` varchar(25) NOT NULL default '',
  `passwd` varchar(32) NOT NULL default '',
  `team` varchar(25) NOT NULL default '',
  `level` int(4) NOT NULL default '0',
  `status` varchar(10) NOT NULL default '',
  `lastlogin` datetime default NULL,
  `logincount` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `authuser`
--

INSERT INTO `authuser` (`id`, `uname`, `passwd`, `team`, `level`, `status`, `lastlogin`, `logincount`) VALUES
(1, 'sa', '9df3b01c60df20d13843841ff0d4482c', 'Admin', 1, 'active', '2010-06-26 11:29:28', 12),
(2, 'admin', '9df3b01c60df20d13843841ff0d4482c', 'Admin', 1, 'active', '2010-06-22 18:30:24', 21),
(3, 'test', '9df3b01c60df20d13843841ff0d4482c', 'Temporary', 999, 'active', '2003-04-03 00:00:34', 0),
(11, 'G1-0001', '9df3b01c60df20d13843841ff0d4482c', 'Group 1', 5, 'active', '2003-04-04 10:59:02', 0),
(12, 'G1-0002', '9df3b01c60df20d13843841ff0d4482c', 'Group 1', 2, 'active', '0000-00-00 00:00:00', 0),
(13, 'G2-0001', '9df3b01c60df20d13843841ff0d4482c', 'Group 2', 5, 'active', '2003-04-03 00:46:20', 0),
(14, 'G2-0002', '9df3b01c60df20d13843841ff0d4482c', 'Group 2', 6, 'active', '2003-04-03 00:48:04', 0),
(15, 'G2-0003', '9df3b01c60df20d13843841ff0d4482c', 'Group 2', 3, 'active', '2003-04-04 10:31:16', 0),
(16, 'G3-0001', '9df3b01c60df20d13843841ff0d4482c', 'Group 3', 10, 'active', '0000-00-00 00:00:00', 0),
(17, 'G3-0002', '9df3b01c60df20d13843841ff0d4482c', 'Group 3', 4, 'active', '0000-00-00 00:00:00', 0),
(20, 'arturo', '34facb611d63077b415e7e4ae92845a2', 'Group 2', 4, 'active', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--
-- Creación: 21-02-2011 a las 11:52:43
-- Última actualización: 06-03-2011 a las 16:54:27
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `codcliente` int(5) NOT NULL auto_increment,
  `nombre` varchar(40) NOT NULL,
  `nif` varchar(15) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL default '0',
  `localidad` varchar(35) NOT NULL,
  `codformapago` int(2) NOT NULL default '0',
  `codentidad` int(2) NOT NULL default '0',
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codcliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Clientes' AUTO_INCREMENT=39 ;

--
-- Volcar la base de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codcliente`, `nombre`, `nif`, `direccion`, `codprovincia`, `localidad`, `codformapago`, `codentidad`, `cuentabancaria`, `codpostal`, `telefono`, `movil`, `email`, `web`, `borrado`) VALUES
(1, 'Cliente Mostrador', 'NA', 'NA', 0, '', 0, 0, '', '', '', '', '', '', '1'),
(6, 'Compueasy', 'HEJS821008 KQ4', 'Avda, Juan Aldama nº 87 ', 16, 'Tlaquiltenango', 1, 4, '', '62983', '3421574', '', 'compueasy@mail.com', '', '1'),
(16, 'CORPORACION TECNICA INTERNACIONAL DE SER', '20479950602', 'CAL. 7 DE ENERO NRO. 1241 ', 9, 'Xochilmilco', 3, 15, '352-851-78', '074', '896132', '', '', '', '0'),
(17, 'INSTITUTO ALMA MATER SAC', '20438264095', 'CAL. ALFONSO UGARTE NRO. 670', 9, 'Xochilmilco', 2, 15, '632-897-85', '0745', '227312', '', '', '', '0'),
(18, 'PERALES HUANCARUNA S.A.C.', '20131495006', 'CAR. PANAMERICANA NORTE NRO. 3.5', 9, 'Milpa Alto', 3, 15, '963-125-56', '074', '459126', '', '', '', '0'),
(21, 'TANK''S 105 SERVICIOS GENERALES S.R.L.', '20482006729', 'CAL. LOS ALUMNOS NRO. 198', 9, 'Benito Juarez', 3, 12, '897-859-96', '0743', '876965', '', '', '', '0'),
(19, 'TUME GONZALES WALTER ENRIQUE', '10805858953', 'CAL. ANTONIO RAYMONDI NRO. 466 INT. B URB. EL', 0, 'CHICLAYO', 3, 0, '', '', '', '', '', '', '1'),
(20, 'APILADORA MARIA DEL PILAR S.C.R.L', '20479653063', 'CAR. PANAMERICANA NORTE NRO. K783 ', 9, 'Xochilmilco', 3, 15, '321-963-42', '074', '941365', '', '', '', '0'),
(22, 'TAI LOY S.A.', '20100049181', 'CAL. ALFREDO LAPOINT NRO. 8704', 9, 'Benito Juarez', 3, 15, '785-785-89', '0743', '986452', '', '', '', '0'),
(23, 'CORPORACION EDUCATIVA CESAR Y DAVID CORN', '20480510497', 'AV. MANUEL MARIA IZAGA NRO. 866', 9, 'Benito Juarez', 3, 15, '961-752-96', '', '153957', '', '', '', '0'),
(24, 'REPUESTOS ZAMORA S.R.LTDA.', '20171776482', 'AV. LUIS GONZALES NRO. 1272 ', 9, 'Benito Juarez', 3, 12, '987-362-78', '9874', '796452', '', '', '', '0'),
(25, 'JERPIMED S.A.C.', '20535558966', 'AV. JAVIER PRADO ESTE NRO. 499 ', 9, 'Xochilmilco', 3, 13, '965-758-23', '015', '986785', '', '', '', '0'),
(26, 'MUNICIPALIDAD DISTRITAL DE XOCHIMILCO', '20162368703', 'CAL. TUPAC AMARU NRO. 0531 ', 9, 'Xochimilco', 2, 0, '563-458-74', '074', '789632', '', '', '', '0'),
(27, 'GONZALES YAIPEN GABRIEL', '10166530925', 'CAL. VICENTE DE LA VEGA NRO. 936', 9, 'Benito Juarez', 3, 16, '748-965-78', '074', '987632', '', '', '', '0'),
(28, 'COMPUTROCK E.I.R.L.', '20480632410', 'CAL. ALFREDO LAPOINT NRO. 945 CENTRO', 9, 'Xochilmilco', 2, 13, '961-789-23', '074', '789325', '', '', '', '0'),
(29, 'RODRIGUEZ DE QUIROZ, JULIA MERCEDES', '10166743074', 'CAL. VALDIVIEZO MZA. C LOTE. 02 ', 9, 'Benito Juarez', 3, 12, '987-965-78', '0741', '320727', '', '', '', '0'),
(30, 'LORENROSE SRL', '20480799110', 'CAL. ALFREDO LAPOINT NRO. 1210', 9, 'Xochimilco', 3, 16, '654-852-89', '7896', '984563', '', '', '', '0'),
(31, 'CONSTRUCCION Y ADMINISTRACION S.A.', '20109565017', 'AV. JAVIER PRADO ESTE NRO. 4109 ', 9, 'Benito Juarez', 3, 12, '782-782-89', '01', '611393 ', '', 'admin@rivanet.com.ar', '', '0'),
(32, 'GLOBETECH CIX S.R.L.', '20487455637', 'CAL. LAPOINT NRO. 654 ', 9, 'Milpa Alto', 3, 13, '965-785-89', '074', '437086', '9560131', '', '', '0'),
(33, 'DEIBBIE JAVIER YARLAQUÉ SANTISTEBAN', '45489110451', 'FEDERICO VILLARREAL 733', 9, 'Xochilmilco', 2, 12, '879-632-45', '0741', '789632', '978741036', 'deibi16_1_89@hotmail.com', '', '0'),
(34, 'karla Garcia Castaño', 'GCK681221k52', 'Rio Caletiano 226', 19, 'Monterrey', 5, 0, '', '64859', '854656231', '894535412', 'karla@me.com', '', '1'),
(38, 'asd ', '', '', 0, '', 0, 0, '', '', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobradores`
--
-- Creación: 03-03-2011 a las 15:55:02
-- Última actualización: 06-03-2011 a las 16:51:43
--

CREATE TABLE IF NOT EXISTS `cobradores` (
  `codcobrador` int(2) NOT NULL auto_increment,
  `nombrecobrador` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codcobrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Cobradores' AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `cobradores`
--

INSERT INTO `cobradores` (`codcobrador`, `nombrecobrador`, `borrado`) VALUES
(1, 'ernesto  perez ', '1'),
(2, 'juan gacitua', '0'),
(4, 'irene perez', '0'),
(5, 'xccxcxc', '1'),
(6, 'jbbbb', '1'),
(7, 'vbxfzf', '1'),
(8, 'asd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--
-- Creación: 22-02-2011 a las 17:46:05
-- Última actualización: 07-03-2011 a las 15:59:20
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `cobros` (
  `id` int(11) NOT NULL auto_increment,
  `codfactura` int(11) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechacobro` date NOT NULL default '0000-00-00',
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Cobros de facturas a clientes' AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`id`, `codfactura`, `codcliente`, `importe`, `codformapago`, `numdocumento`, `fechacobro`, `observaciones`) VALUES
(1, 1, 1, '192.42', 1, '7896321456', '2011-02-22', ''),
(2, 3, 1, '20.00', 3, '1234', '2011-02-28', 'primer pago'),
(3, 3, 1, '35.68', 7, '3456', '2011-02-22', 'cheq'),
(4, 5, 1, '82.47', 6, '7896325621', '2011-02-23', ''),
(5, 10, 16, '153.51', 3, '', '2011-02-23', ''),
(6, 13, 1, '59.50', 1, '', '2011-02-23', ''),
(7, 4, 18, '5.00', 3, '', '2011-02-25', ''),
(8, 2007, 17, '7.10', 7, '896321', '2011-02-26', ''),
(9, 2000, 1, '190.16', 3, '33', '2011-03-05', ''),
(10, 2020, 1, '29.75', 1, '', '2011-03-06', ''),
(11, 2021, 16, '20.00', 3, '123', '2011-03-06', ''),
(12, 2021, 16, '51.40', 3, '456', '2011-03-06', ''),
(13, 2022, 22, '55.10', 3, '345', '2011-03-06', 'cheque banco machala'),
(14, 2018, 16, '50.00', 3, '', '2011-03-06', '1er abono'),
(15, 2024, 1, '76.76', 3, '', '2011-03-07', ''),
(16, 2025, 1, '59.50', 3, '', '2011-03-07', ''),
(17, 2028, 1, '938.91', 1, '456321', '2011-03-07', ''),
(18, 2029, 1, '146.37', 6, '12364', '2011-03-07', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails`
--
-- Creación: 08-03-2011 a las 16:45:05
--

CREATE TABLE IF NOT EXISTS `emails` (
  `codigo` int(11) NOT NULL auto_increment,
  `email` varchar(100) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `emails`
--

INSERT INTO `emails` (`codigo`, `email`) VALUES
(4, 'codekamx@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embalajes`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 26-02-2011 a las 13:23:05
-- Última revisión: 26-02-2011 a las 13:23:05
--

CREATE TABLE IF NOT EXISTS `embalajes` (
  `codembalaje` int(3) NOT NULL auto_increment,
  `nombre` varchar(30) default NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codembalaje`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Embalajes' AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `embalajes`
--

INSERT INTO `embalajes` (`codembalaje`, `nombre`, `borrado`) VALUES
(1, 'Caja', '0'),
(2, 'resma', '0'),
(3, 'unidad', '0'),
(4, 'No aplica', '0'),
(7, 'Blister', '0'),
(8, 'kilos', '0'),
(9, 'm2', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 06-03-2011 a las 16:47:39
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `entidades` (
  `codentidad` int(2) NOT NULL auto_increment,
  `nombreentidad` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codentidad`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias' AUTO_INCREMENT=27 ;

--
-- Volcar la base de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`codentidad`, `nombreentidad`, `borrado`) VALUES
(12, 'BANCO DE COMERCIO', '0'),
(13, 'BANCO DE CREDITO ', '0'),
(15, 'BANCO FINANCIERO', '0'),
(16, 'BANCO INTERAMERICANO DE FINANZAS', '0'),
(17, 'BANCO RIPLEY S.A.', '0'),
(19, 'BBVA BANCO CONTINENTAL', '0'),
(22, 'INTERBANK', '0'),
(23, 'MIBANCO, BANCO DE LA MICROEMPRESA', '0'),
(25, 'CITI', '0'),
(26, 'asd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventcal`
--
-- Creación: 01-10-2010 a las 16:45:03
-- Última actualización: 27-12-2010 a las 15:59:10
--

CREATE TABLE IF NOT EXISTS `eventcal` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `eventDate` date default NULL,
  `eventTitle` varchar(100) default NULL,
  `eventContent` text,
  `borrado` varchar(1) character set cp850 NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `eventcal`
--

INSERT INTO `eventcal` (`id`, `eventDate`, `eventTitle`, `eventContent`, `borrado`) VALUES
(1, '2010-09-28', 'ivas', 'pagar', '1'),
(2, '2010-09-30', 'Cumpleaño Maria Ines', 'Nos reuniremos a almorzar con la jefatura en el Casino Royal. Cancela la Empresa', '1'),
(3, '2010-10-05', 'despedida soltero', 'nos vamos pa la costa', '1'),
(4, '2010-10-14', 'fiesta', 'en rancagua', '0'),
(5, '2010-10-08', 'buenas noticias', 'seran aumentados los sueldos bases en un 25 % para todos aquellos que logren su titulo de Master en informatica antes del 30 de Diciembre de este año.', '1'),
(6, '2010-12-09', 'test', 'test de evento', '1'),
(7, '2010-12-31', 'xasas', 'asasas', '1'),
(8, '2010-12-30', 'carlos', 'no hay mas', '1'),
(9, '2010-12-27', 'cotiz<acxnes pendientes', 'ganancia $ 110.00 cada cotizacion', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` bigint(20) unsigned NOT NULL auto_increment,
  `eventDate` date default NULL,
  `eventContent` longtext,
  `langCode` varchar(20) default 'en',
  PRIMARY KEY  (`eventID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `events`
--

INSERT INTO `events` (`eventID`, `eventDate`, `eventContent`, `langCode`) VALUES
(1, '2010-09-23', 'this is my first ', 'en'),
(2, '2010-09-30', 'this is my second event', 'en'),
(3, '2010-09-30', '&#2351;&#2361; &#2350;&#2375;&#2352;&#2366; &#2346;&#2361;&#2354;&#2366; &#2360;&#2306;&#2342;&#2375;&#2358; &#2361;&#2376;', 'hi'),
(4, '2010-09-29', 'This is new event', 'en'),
(5, '2005-03-29', 'This is new event', 'en'),
(6, '2005-03-29', 'This is new event', 'en'),
(7, '2005-04-15', 'This is new event', 'en'),
(8, '2005-04-15', 'This is new event', 'en'),
(9, '2005-04-17', 'This is updated third event', 'en');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factulinea`
--
-- Creación: 22-02-2011 a las 17:47:00
-- Última actualización: 07-03-2011 a las 15:58:48
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `factulinea` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas a clientes' AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `factulinea`
--

INSERT INTO `factulinea` (`codfactura`, `numlinea`, `codfamilia`, `codigo`, `cantidad`, `precio`, `importe`, `dcto`) VALUES
(1, 1, 40, '42', '1.00', '50.00', '49.00', 2),
(1, 2, 69, '50', '1.00', '115.00', '112.70', 2),
(2, 1, 61, '49', '1.00', '60.00', '52.80', 12),
(2, 2, 66, '41', '1.00', '24.80', '24.80', 0),
(3, 1, 40, '42', '4.00', '12.00', '48.00', 0),
(4, 1, 61, '83', '3.00', '3.00', '9.00', 0),
(5, 1, 61, '83', '1.00', '5.00', '4.80', 4),
(5, 2, 61, '49', '1.00', '64.50', '64.50', 0),
(6, 1, 66, '41', '1.00', '25.00', '25.00', 0),
(7, 1, 61, '83', '1.00', '5.00', '5.00', 0),
(8, 1, 40, '42', '1.00', '49.80', '49.80', 0),
(9, 1, 40, '42', '1.00', '50.00', '50.00', 0),
(10, 1, 61, '49', '2.00', '64.50', '129.00', 0),
(11, 1, 40, '42', '1.00', '50.00', '50.00', 0),
(11, 2, 61, '49', '1.00', '64.50', '64.50', 0),
(12, 1, 69, '50', '1.00', '115.00', '115.00', 0),
(13, 1, 40, '42', '1.00', '50.00', '50.00', 0),
(14, 1, 40, '42', '1.00', '50.00', '50.00', 0),
(14, 2, 69, '50', '1.00', '115.00', '115.00', 0),
(15, 1, 40, '42', '1.00', '49.80', '49.80', 0),
(16, 1, 69, '50', '1.00', '83.00', '83.00', 0),
(2000, 1, 40, '42', '1.00', '49.80', '49.80', 0),
(2001, 1, 61, '83', '1.00', '3.00', '3.00', 0),
(2000, 2, 61, '49', '1.00', '60.00', '60.00', 0),
(2002, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2003, 3, 69, '50', '1.00', '83.00', '83.00', 0),
(2003, 2, 61, '83', '1.00', '3.00', '3.00', 0),
(2003, 1, 40, '42', '1.00', '49.80', '49.80', 0),
(2004, 1, 40, '42', '1.00', '90.00', '90.00', 0),
(2004, 2, 66, '41', '1.00', '44.00', '44.00', 0),
(2000, 3, 40, '42', '1.00', '50.00', '50.00', 0),
(2007, 2, 61, '83', '10.00', '3.00', '30.00', 0),
(2007, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2008, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2009, 1, 61, '83', '10.00', '5.00', '50.00', 0),
(2010, 1, 61, '83', '1.00', '5.00', '4.90', 2),
(2011, 1, 61, '83', '1.00', '5.00', '5.00', 0),
(2012, 1, 61, '83', '1.00', '5.00', '5.00', 0),
(2013, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2014, 1, 61, '49', '10.00', '60.00', '600.00', 0),
(2015, 1, 66, '41', '1.00', '24.80', '24.80', 0),
(2015, 2, 61, '49', '20.00', '60.00', '1200.00', 0),
(2017, 1, 66, '41', '1.00', '24.80', '24.80', 0),
(2018, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2020, 1, 66, '41', '1.00', '25.00', '25.00', 0),
(2021, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2022, 1, 66, '41', '10.00', '5.00', '47.50', 5),
(2023, 1, 72, '90', '15.00', '123.00', '1845.00', 0),
(2024, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2025, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2025, 2, 61, '83', '1.00', '5.00', '5.00', 0),
(2026, 1, 61, '49', '1.00', '60.00', '90.00', 0),
(2026, 2, 61, '49', '1.00', '60.00', '78.00', 0),
(2027, 1, 72, '90', '1.00', '123.00', '123.00', 0),
(2028, 1, 72, '89', '1.00', '789.00', '789.00', 0),
(2029, 1, 72, '90', '1.00', '123.00', '123.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factulineap`
--
-- Creación: 22-02-2011 a las 17:47:07
-- Última actualización: 07-03-2011 a las 04:01:19
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `factulineap` (
  `codfactura` varchar(20) NOT NULL default '',
  `codproveedor` int(5) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`codproveedor`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores' AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `factulineap`
--

INSERT INTO `factulineap` (`codfactura`, `codproveedor`, `numlinea`, `codfamilia`, `codigo`, `cantidad`, `precio`, `importe`, `dcto`) VALUES
('0002', 17, 1, 61, '83', '1.00', '2.00', '2.00', 0),
('0002', 17, 2, 61, '83', '4.00', '4.00', '16.00', 0),
('0003', 17, 1, 61, '83', '1.00', '4.00', '4.00', 0),
('0004', 17, 1, 61, '83', '2.00', '4.00', '8.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factulineaptmp`
--
-- Creación: 22-02-2011 a las 17:47:22
-- Última actualización: 01-03-2011 a las 21:52:29
-- Última revisión: 01-03-2011 a las 21:52:29
--

CREATE TABLE IF NOT EXISTS `factulineaptmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores temporal' AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `factulineaptmp`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factulineatmp`
--
-- Creación: 22-02-2011 a las 17:47:28
-- Última actualización: 08-03-2011 a las 16:35:35
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `factulineatmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Temporal de linea de facturas a clientes' AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `factulineatmp`
--

INSERT INTO `factulineatmp` (`codfactura`, `numlinea`, `codfamilia`, `codigo`, `cantidad`, `precio`, `importe`, `dcto`) VALUES
(2098, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2099, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2099, 2, 61, '83', '1.00', '5.00', '5.00', 0),
(2112, 1, 61, '83', '1.00', '150.00', '150.00', 0),
(2085, 1, 66, '41', '1.00', '25.00', '25.00', 0),
(2087, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2088, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2090, 1, 61, '49', '1.00', '60.00', '60.00', 0),
(2090, 2, 61, '83', '10.00', '3.00', '30.00', 0),
(2091, 1, 0, '', '1.00', '0.00', '0.00', 0),
(2092, 1, 66, '41', '10.00', '5.00', '47.50', 5),
(2097, 1, 72, '90', '15.00', '123.00', '1845.00', 0),
(2100, 1, 61, '49', '1.00', '64.50', '64.50', 0),
(2100, 2, 61, '83', '1.00', '5.00', '5.00', 0),
(2102, 1, 61, '49', '1.00', '60.00', '90.00', 0),
(2102, 2, 61, '49', '1.00', '60.00', '78.00', 0),
(2106, 1, 72, '90', '1.00', '123.00', '123.00', 0),
(2109, 1, 72, '89', '1.00', '789.00', '789.00', 0),
(2110, 1, 72, '90', '1.00', '123.00', '123.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--
-- Creación: 22-02-2011 a las 17:47:39
-- Última actualización: 07-03-2011 a las 15:59:20
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `estado` varchar(1) NOT NULL default '0',
  `totalfactura` decimal(19,2) NOT NULL,
  `fechavencimiento` date NOT NULL default '0000-00-00',
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='facturas de ventas a clientes' AUTO_INCREMENT=2030 ;

--
-- Volcar la base de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`codfactura`, `fecha`, `iva`, `codcliente`, `estado`, `totalfactura`, `fechavencimiento`, `borrado`) VALUES
(1, '2011-02-22', 19, 1, '2', '192.42', '0000-00-00', '0'),
(2, '2011-02-22', 19, 27, '1', '92.34', '0000-00-00', '0'),
(3, '2011-02-22', 19, 1, '1', '55.68', '0000-00-00', '0'),
(4, '2011-02-22', 19, 18, '1', '10.44', '0000-00-00', '0'),
(5, '2011-02-23', 19, 1, '2', '82.47', '0000-00-00', '0'),
(6, '2011-02-23', 19, 1, '1', '29.75', '0000-00-00', '0'),
(7, '2011-02-23', 19, 1, '1', '5.95', '0000-00-00', '0'),
(8, '2011-02-23', 19, 16, '1', '59.26', '0000-00-00', '0'),
(9, '2011-02-23', 19, 1, '1', '59.50', '0000-00-00', '0'),
(10, '2011-02-23', 19, 16, '2', '153.51', '0000-00-00', '0'),
(11, '2011-02-23', 19, 1, '1', '136.26', '0000-00-00', '0'),
(12, '2011-02-23', 19, 1, '1', '136.85', '0000-00-00', '0'),
(13, '2011-02-23', 19, 1, '2', '59.50', '0000-00-00', '0'),
(14, '2011-02-23', 19, 1, '1', '196.35', '0000-00-00', '0'),
(15, '2011-02-23', 16, 16, '1', '57.77', '0000-00-00', '0'),
(16, '2011-02-23', 16, 17, '1', '96.28', '0000-00-00', '0'),
(2000, '2011-02-23', 19, 16, '2', '82.71', '0000-00-00', '0'),
(2001, '2011-02-23', 19, 18, '1', '3.57', '0000-00-00', '0'),
(2002, '2011-02-23', 19, 27, '1', '71.40', '0000-00-00', '0'),
(2003, '2011-02-24', 19, 26, '1', '161.60', '0000-00-00', '0'),
(2004, '2011-02-24', 16, 1, '1', '155.44', '0000-00-00', '0'),
(2005, '2011-02-24', 16, 1, '1', '0.00', '0000-00-00', '0'),
(2006, '2011-02-25', 19, 1, '1', '0.00', '0000-00-00', '0'),
(2007, '2011-02-26', 19, 17, '1', '107.10', '0000-00-00', '0'),
(2008, '2011-03-01', 19, 1, '1', '76.76', '0000-00-00', '0'),
(2009, '2011-03-01', 19, 1, '1', '59.50', '0000-00-00', '0'),
(2010, '2011-03-01', 19, 1, '1', '5.83', '0000-00-00', '0'),
(2011, '2011-03-01', 19, 1, '1', '5.95', '0000-00-00', '0'),
(2012, '2011-03-01', 12, 16, '1', '5.60', '2011-03-02', '0'),
(2013, '2011-03-03', 19, 16, '1', '71.40', '0000-00-00', '0'),
(2014, '2011-03-04', 16, 29, '1', '696.00', '0000-00-00', '0'),
(2015, '2011-03-04', 16, 29, '2', '1420.77', '0000-00-00', '0'),
(2016, '2011-03-05', 19, 1, '1', '0.00', '0000-00-00', '0'),
(2017, '2011-03-05', 19, 22, '1', '29.51', '0000-00-00', '0'),
(2018, '2011-03-05', 19, 16, '1', '71.40', '0000-00-00', '0'),
(2019, '2011-03-05', 19, 27, '1', '0.00', '0000-00-00', '0'),
(2020, '2011-03-06', 19, 1, '2', '29.75', '0000-00-00', '0'),
(2021, '2011-03-06', 19, 16, '2', '71.40', '0000-00-00', '0'),
(2022, '2011-03-06', 16, 22, '2', '55.10', '0000-00-00', '0'),
(2023, '2011-03-06', 19, 16, '1', '2195.55', '0000-00-00', '0'),
(2024, '2011-03-07', 19, 1, '2', '76.76', '0000-00-00', '0'),
(2025, '2011-03-07', 0, 1, '2', '69.50', '0000-00-00', '0'),
(2026, '2011-03-07', 19, 32, '1', '199.92', '0000-00-00', '0'),
(2027, '2011-03-07', 19, 1, '1', '146.37', '0000-00-00', '0'),
(2028, '2011-03-07', 19, 1, '2', '938.91', '0000-00-00', '0'),
(2029, '2011-03-07', 19, 1, '2', '146.37', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasp`
--
-- Creación: 22-02-2011 a las 17:47:45
-- Última actualización: 07-03-2011 a las 04:01:19
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `facturasp` (
  `codfactura` varchar(20) NOT NULL default '',
  `codproveedor` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `estado` varchar(1) NOT NULL default '0',
  `totalfactura` decimal(19,2) NOT NULL,
  `fechapago` date NOT NULL default '0000-00-00',
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfactura`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='facturas de compras a proveedores';

--
-- Volcar la base de datos para la tabla `facturasp`
--

INSERT INTO `facturasp` (`codfactura`, `codproveedor`, `fecha`, `iva`, `estado`, `totalfactura`, `fechapago`, `borrado`) VALUES
('0002', 17, '2011-02-26', 19, '2', '21.42', '0000-00-00', '0'),
('0003', 17, '2011-02-26', 19, '1', '4.76', '0000-00-00', '0'),
('0004', 17, '2011-02-26', 19, '1', '9.52', '2011-02-25', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasptmp`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 08-03-2011 a las 18:22:57
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `facturasptmp` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='temporal de facturas de proveedores' AUTO_INCREMENT=133 ;

--
-- Volcar la base de datos para la tabla `facturasptmp`
--

INSERT INTO `facturasptmp` (`codfactura`, `fecha`) VALUES
(130, '2011-03-06'),
(131, '2011-03-06'),
(132, '2011-03-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturastmp`
--
-- Creación: 22-02-2011 a las 17:48:10
-- Última actualización: 08-03-2011 a las 16:34:36
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `facturastmp` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes' AUTO_INCREMENT=2113 ;

--
-- Volcar la base de datos para la tabla `facturastmp`
--

INSERT INTO `facturastmp` (`codfactura`, `fecha`) VALUES
(2100, '2011-03-07'),
(2099, '2011-03-07'),
(2098, '2011-03-07'),
(2112, '2011-03-08'),
(2085, '2011-03-06'),
(2086, '2011-03-06'),
(2087, '2011-03-06'),
(2088, '2011-03-06'),
(2089, '2011-03-06'),
(2090, '2011-03-06'),
(2091, '2011-03-06'),
(2092, '2011-03-06'),
(2093, '2011-03-06'),
(2094, '2011-03-06'),
(2095, '2011-03-06'),
(2096, '2011-03-06'),
(2097, '2011-03-06'),
(2101, '2011-03-07'),
(2102, '2011-03-07'),
(2103, '2011-03-07'),
(2104, '2011-03-07'),
(2105, '2011-03-07'),
(2106, '2011-03-07'),
(2107, '2011-03-07'),
(2108, '2011-03-07'),
(2109, '2011-03-07'),
(2110, '2011-03-07'),
(2111, '2011-03-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--
-- Creación: 07-11-2010 a las 16:24:24
-- Última actualización: 01-03-2011 a las 21:52:29
-- Última revisión: 01-03-2011 a las 21:52:29
--

CREATE TABLE IF NOT EXISTS `familias` (
  `codfamilia` int(5) NOT NULL auto_increment,
  `nombre` varchar(35) default NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfamilia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='familia de articulos' AUTO_INCREMENT=73 ;

--
-- Volcar la base de datos para la tabla `familias`
--

INSERT INTO `familias` (`codfamilia`, `nombre`, `borrado`) VALUES
(28, 'ACCESORIOS DE NOTEBO', '1'),
(29, 'ACCESORIOS PARA CASE', '1'),
(30, 'CABLES DIVERSOS', '1'),
(31, 'CARD READERS / WRITER', '0'),
(32, 'CASES (GABINETES)', '0'),
(33, 'COOLERS PARA MICROPROCESADORES', '0'),
(34, 'DISCOS DUROS EXTERNO', '0'),
(35, 'DISCOS DUROS INTERNO', '0'),
(36, 'DISP. DE ALMACENAMIENTO', '0'),
(37, 'DISP. DE IMAGENES', '0'),
(38, 'DISP. OPTICOS DE L/E', '0'),
(39, 'DISP. PARA REDES CAB', '0'),
(40, 'DISP. PARA REDES WIF', '0'),
(41, 'ESTABILIZADORES', '0'),
(42, 'FUENTES DE PODER', '0'),
(43, 'IMPRESORAS', '0'),
(44, 'MAINBOARDS', '0'),
(45, 'MEMORIAS', '0'),
(46, 'MEMORIAS DIGITALES,U', '0'),
(47, 'MICROPROCESADORES', '1'),
(48, 'MICROPROCESADORES', '0'),
(49, 'MONITORES', '0'),
(50, 'MOUSE, TRACKBALL, PU', '0'),
(51, 'NOTEBOOKS, LAPTOPS', '0'),
(52, 'OTRAS TARJETAS CONTR', '0'),
(53, 'PARLANTES / SUBWOOFER', '0'),
(54, 'PCS DE MARCA', '0'),
(55, 'PCS ENSAMBLADAS', '0'),
(56, 'PRINT SERVER', '0'),
(57, 'PRODUCTOS PARA VOIP', '0'),
(58, 'REPUESTOS DE NOTEBOOK', '0'),
(59, 'SERVIDORES', '1'),
(60, 'SOFTWARE', '0'),
(61, 'SUMINISTROS', '0'),
(62, 'SUPERMULTI DVD & BLU', '0'),
(63, 'TARJETAS DE VIDEO', '0'),
(64, 'TECLADOS', '0'),
(65, 'UPS Y DISP. DE PROTE', '1'),
(66, 'COOLERS PARA CASES', '0'),
(67, 'OTROS DISPOSITIVOS', '0'),
(69, 'BATERIAS', '0'),
(70, 'Aromatizantes', '1'),
(71, 'RESISTENCIAS', '0'),
(72, 'BASCULAS', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 06-03-2011 a las 16:53:11
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `formapago` (
  `codformapago` int(2) NOT NULL auto_increment,
  `nombrefp` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codformapago`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Forma de pago' AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`codformapago`, `nombrefp`, `borrado`) VALUES
(1, 'Tarjeta de crédito', '0'),
(2, 'Crédito directo', '0'),
(3, 'Contado/Efectivo', '0'),
(6, 'Cheque al dia', '0'),
(7, 'Cheque 30 dias', '0'),
(8, 'Nota de Credito', '0'),
(9, 'asd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--
-- Creación: 21-02-2011 a las 12:51:49
-- Última actualización: 06-03-2011 a las 16:46:28
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `impuestos` (
  `codimpuesto` int(3) NOT NULL auto_increment,
  `nombre` varchar(20) default NULL,
  `valor` decimal(19,1) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codimpuesto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='tipos de impuestos' AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`codimpuesto`, `nombre`, `valor`, `borrado`) VALUES
(5, 'IVA', '19.0', '0'),
(7, 'Exento', '0.0', '0'),
(13, 'asd', '12.0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librodiario`
--
-- Creación: 22-02-2011 a las 17:51:25
-- Última actualización: 07-03-2011 a las 15:59:20
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `librodiario` (
  `id` int(8) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  `tipodocumento` varchar(1) NOT NULL,
  `coddocumento` varchar(20) NOT NULL,
  `codcomercial` int(5) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numpago` varchar(30) NOT NULL,
  `total` decimal(19,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Movimientos diarios' AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `librodiario`
--

INSERT INTO `librodiario` (`id`, `fecha`, `tipodocumento`, `coddocumento`, `codcomercial`, `codformapago`, `numpago`, `total`) VALUES
(1, '2011-02-22', '2', '1', 1, 1, '7896321456', '192.42'),
(2, '2011-02-28', '2', '3', 1, 3, '1234', '20.00'),
(3, '2011-02-22', '2', '3', 1, 7, '3456', '35.68'),
(4, '2011-02-10', '1', '2342', 13, 2, '34567', '256.00'),
(5, '2011-02-23', '2', '5', 1, 6, '7896325621', '82.47'),
(6, '2011-02-23', '2', '10', 16, 3, '', '153.51'),
(7, '2011-02-23', '2', '13', 1, 1, '', '59.50'),
(8, '2011-02-25', '2', '4', 18, 3, '', '5.00'),
(9, '2011-02-26', '1', '0002', 17, 3, '2', '22.00'),
(10, '2011-02-26', '2', '2007', 17, 7, '896321', '7.10'),
(11, '0000-00-00', '2', '2007', 0, 0, '', '-7.10'),
(12, '0000-00-00', '2', '2007', 0, 0, '', '-7.10'),
(13, '2011-02-26', '1', '0004', 17, 7, '896321', '0.52'),
(14, '0000-00-00', '1', '0002', 0, 0, '', '-22.00'),
(15, '0000-00-00', '1', '0002', 0, 0, '', '-22.00'),
(16, '0000-00-00', '1', '0002', 0, 0, '', '-22.00'),
(17, '2011-02-26', '1', '0002', 17, 6, 'nc/1234', '0.58'),
(18, '2011-02-26', '1', '0002', 17, 6, 'NC/2345', '-1.16'),
(19, '2011-02-26', '1', '0002', 17, 6, '', '0.00'),
(20, '0000-00-00', '1', '0002', 0, 0, '', '0.00'),
(21, '2011-02-26', '1', '0004', 17, 8, 'NC/7862', '8.00'),
(22, '2011-03-05', '2', '2000', 1, 3, '33', '190.16'),
(23, '2011-03-06', '2', '2020', 1, 1, '', '29.75'),
(24, '2011-03-06', '2', '2021', 16, 3, '123', '20.00'),
(25, '2011-03-06', '2', '2021', 16, 3, '456', '51.40'),
(26, '2011-03-06', '2', '2022', 22, 3, '345', '55.10'),
(27, '2011-03-06', '2', '2018', 16, 3, '', '50.00'),
(28, '2011-03-07', '2', '2024', 1, 3, '', '76.76'),
(29, '2011-03-07', '2', '2025', 1, 3, '', '59.50'),
(30, '2011-03-07', '2', '2028', 1, 1, '456321', '938.91'),
(31, '2011-03-07', '2', '2029', 1, 6, '12364', '146.37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--
-- Creación: 22-02-2011 a las 17:51:35
-- Última actualización: 26-02-2011 a las 19:10:57
-- Última revisión: 01-03-2011 a las 21:52:29
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL auto_increment,
  `codfactura` varchar(20) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechapago` date default '0000-00-00',
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Pagos de facturas a proveedores' AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `codfactura`, `codproveedor`, `importe`, `codformapago`, `numdocumento`, `fechapago`, `observaciones`) VALUES
(1, '2342', 13, '256.00', 2, '34567', '2011-02-10', 'ret'),
(2, '0002', 17, '22.00', 3, '2', '2011-02-26', 'pago 22 pesos'),
(3, '0004', 17, '0.52', 7, '896321', '2011-02-26', ''),
(4, '0002', 17, '0.58', 6, 'nc/1234', '2011-02-26', 'seentrega nota de credito'),
(5, '0002', 17, '-1.16', 6, 'NC/2345', '2011-02-26', 'se entrega nota credito 5643'),
(6, '0002', 17, '0.00', 6, '', '2011-02-26', ''),
(7, '0004', 17, '8.00', 8, 'NC/7862', '2011-02-26', 'nota credito 7851');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--
-- Creación: 07-03-2011 a las 16:16:16
-- Última actualización: 07-03-2011 a las 16:55:14
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `indice` int(1) NOT NULL default '0',
  `usuario` varchar(10) default NULL,
  `clave` varchar(10) default NULL,
  `servidor` varchar(20) default NULL,
  `basedatos` varchar(20) default NULL,
  `numeracionfactura` decimal(10,0) default NULL,
  `setnumfac` decimal(1,0) default NULL,
  `fondofac` text,
  `imagenfac` varchar(30) default NULL,
  `fondoguia` text,
  `imagenguia` varchar(30) default NULL,
  `filasdetallefactura` int(2) default NULL,
  `ivaimp` decimal(2,0) default NULL,
  `nombremoneda` varchar(20) default NULL,
  `simbolomoneda` varchar(20) default NULL,
  `codigomoneda` varchar(10) default NULL,
  `nomempresa` tinytext,
  `giro` varchar(50) default NULL,
  `fonos` varchar(30) default NULL,
  `direccion` varchar(30) default NULL,
  `comuna` varchar(30) default NULL,
  `ciudadactual` varchar(30) default NULL,
  `numerofiscal` varchar(20) default NULL,
  `resolucionsii` varchar(50) default NULL,
  `rutempresa` varchar(20) default NULL,
  `giro2` varchar(50) default NULL,
  `logoempresa` varchar(50) default NULL,
  PRIMARY KEY  (`indice`),
  KEY `indice` (`indice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`indice`, `usuario`, `clave`, `servidor`, `basedatos`, `numeracionfactura`, `setnumfac`, `fondofac`, `imagenfac`, `fondoguia`, `imagenguia`, `filasdetallefactura`, `ivaimp`, `nombremoneda`, `simbolomoneda`, `codigomoneda`, `nomempresa`, `giro`, `fonos`, `direccion`, `comuna`, `ciudadactual`, `numerofiscal`, `resolucionsii`, `rutempresa`, `giro2`, `logoempresa`) VALUES
(1, '', '', '', '', '2000', '1', 'SI', 'Factura v3.jpg', 'SI', 'logo.jpg', 20, '19', 'pesos', '$', '$', 'ROBOTEC', 'Equipos de Computo', '051- 44 94 8 363562', 'CC PRIMAVERA ESTAND E4', 'CENTRO', 'XOCHIMILCO', '12345', '789654', 'R.F.C. 544544544', 'Telecomunicaciones', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petroleo`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `petroleo` (
  `mes` int(11) default NULL,
  `precio` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `petroleo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--
-- Creación: 21-02-2011 a las 11:53:05
-- Última actualización: 06-03-2011 a las 16:53:51
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `codproveedor` int(5) NOT NULL auto_increment,
  `nombre` varchar(40) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL,
  `localidad` varchar(35) NOT NULL,
  `codentidad` int(2) NOT NULL,
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codproveedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Proveedores' AUTO_INCREMENT=23 ;

--
-- Volcar la base de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`codproveedor`, `nombre`, `nif`, `direccion`, `codprovincia`, `localidad`, `codentidad`, `cuentabancaria`, `codpostal`, `telefono`, `movil`, `email`, `web`, `borrado`) VALUES
(12, 'GRUPO DELTRON S.A.', '20212331377', 'AV. SALAVERRY 580 URB. PATAZCA', 9, 'Benito Juarez', 12, '193-0076989-1', '074', '591061', '', '', 'WWW.deltron.com.mx', '0'),
(13, 'GRUPO IGARASHI S.R.L.', '20252011910', 'PJ. ARTEMIA WOYKE Nro 135 INT. 202', 9, 'Milpa Alto', 22, '123-4569-89', '074', '231994', '', '', 'www.grupoigarashi.com', '0'),
(14, 'HALION INTERNACIONAL S.A.', '20505970323', 'C. ALFREDO LAPOINT Nro 149 INT. B.', 9, 'Benito Juarez', 15, '123-897-96', '074', '456963', '', '', 'www.delux.com.mx', '0'),
(15, 'IMPULSO INFORMATICO S.A.', '20422561537 ', 'CAL. ALFREDO LAPOINT NRO. 337 ', 9, 'Xochilmilco', 19, '789-1236-78', '074', '421388 ', '', '', 'www.impulso.com.mx', '0'),
(16, 'MAXIMA INTERNACIONAL S.A', '20505970323', 'Av. Siesquicentenario 528 Urb. Santa Victoria', 9, 'Benito Juarez', 12, '456-785-52', '074', '207010', '', '', 'www.maximainternacional.com.mx', '0'),
(17, 'PCLINK S.A.C', '20469317855', 'Calle Tacna nro 623-625', 17, 'Xochimilco', 12, '782-456-23', '074', '270531', '', '', 'www.pclink.com.mx', '0'),
(18, 'TECHDATA S.A.C.', '20267163228', 'C. MANUEL ARTEAGA N? 520 Urb. Los Parques', 0, 'CHICLAYO', 13, '', '074', '270550', '', '', 'www.techdata.com.pe', '1'),
(20, 'Prueba', '01', '01', 2, '01', 14, '01', '01', '114', '10', '', '', '1'),
(21, 'JUAN SOTO GARAY', '456321456', 'Chantupec   123', 2, 'chantupec', 15, '7896321', '78963', '78-96321', '', 'juan@gmail.com', '', '0'),
(22, 'asd', '', '', 0, '', 0, '', '', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--
-- Creación: 01-03-2011 a las 19:58:37
-- Última actualización: 06-03-2011 a las 16:49:09
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `codprovincia` int(2) NOT NULL auto_increment,
  `nombreprovincia` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codprovincia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Provincias' AUTO_INCREMENT=38 ;

--
-- Volcar la base de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`codprovincia`, `nombreprovincia`, `borrado`) VALUES
(1, 'Aguascalientes', '0'),
(2, 'Baja California Norte', '0'),
(3, 'Baja California Sur', '0'),
(4, 'Chihuahua', '0'),
(5, 'Colima', '0'),
(6, 'Campeche', '0'),
(7, 'Coahuila', '0'),
(8, 'Chiapas', '0'),
(9, 'Distrito Federal', '0'),
(10, 'Durango', '0'),
(11, 'Guerrero', '0'),
(12, 'Guanajuato', '0'),
(13, 'Hidalgo', '0'),
(14, 'Jalisco', '0'),
(15, 'Michoacán', '0'),
(16, 'Morelos', '0'),
(17, 'Estado de México', '0'),
(18, 'Nayarit', '0'),
(19, 'Nuevo León', '0'),
(20, 'Oaxaca', '0'),
(21, 'Puebla', '0'),
(22, 'Quintana Roo', '0'),
(23, 'Querétaro', '0'),
(24, 'Sinaloa', '0'),
(25, 'San Luis Potosí', '0'),
(26, 'Sonora', '0'),
(27, 'Tabasco', '0'),
(28, 'Tlaxcala', '0'),
(29, 'Tamaulipas', '0'),
(30, 'Veracruz', '0'),
(31, 'Yucatán', '0'),
(32, 'Zacatecas', '0'),
(37, 'asd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabbackup`
--
-- Creación: 22-02-2011 a las 17:52:44
-- Última actualización: 26-02-2011 a las 13:23:56
-- Última revisión: 01-03-2011 a las 21:52:29
--

CREATE TABLE IF NOT EXISTS `tabbackup` (
  `id` int(6) NOT NULL auto_increment,
  `denominacion` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `archivo` varchar(40) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tabbackup`
--

INSERT INTO `tabbackup` (`id`, `denominacion`, `fecha`, `hora`, `archivo`) VALUES
(1, 'RP220220111755', '2011-02-22', '17:55:26', '../copias/copia1.sql'),
(2, 'yioyukluilululu', '2011-02-23', '02:15:18', '../copias/copia2.sql'),
(3, 'JJJ', '2011-02-25', '16:00:00', '../copias/copia3.sql'),
(4, 'JAZMIN', '2011-02-26', '13:22:22', '../copias/copia4.sql'),
(5, 'uuu', '2011-02-26', '13:23:51', '../copias/copia5.sql');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 06-03-2011 a las 16:48:26
-- Última revisión: 07-03-2011 a las 04:01:19
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `codubicacion` int(3) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codubicacion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Ubicaciones' AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`codubicacion`, `nombre`, `borrado`) VALUES
(3, 'PV Robotec - Juan Cuglievan', '0'),
(5, 'PV Robotec - Alfredo Lapoint', '0'),
(12, 'a-1-1', '1'),
(13, 'asd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uf`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `uf` (
  `Fecha` varchar(20) default NULL,
  `Valor` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `uf`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `useronline`
--
-- Creación: 16-10-2010 a las 21:14:47
-- Última actualización: 07-03-2011 a las 03:59:21
--

CREATE TABLE IF NOT EXISTS `useronline` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
  `timestamp` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=268 ;

--
-- Volcar la base de datos para la tabla `useronline`
--

INSERT INTO `useronline` (`id`, `ip`, `timestamp`) VALUES
(267, '190.90.91.2', '1299481161');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--
-- Creación: 29-09-2010 a las 11:16:58
-- Última actualización: 29-09-2010 a las 11:16:58
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL auto_increment,
  `full_name` varchar(200) character set latin1 collate latin1_general_ci NOT NULL default '',
  `user_name` varchar(200) character set latin1 collate latin1_general_ci NOT NULL default '',
  `user_pwd` varchar(200) character set latin1 collate latin1_general_ci NOT NULL default '',
  `user_email` varchar(200) character set latin1 collate latin1_general_ci NOT NULL default '',
  `activation_code` int(10) NOT NULL default '0',
  `joined` date NOT NULL default '0000-00-00',
  `country` varchar(100) character set latin1 collate latin1_general_ci NOT NULL default '',
  `user_activated` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `users`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--
-- Creación: 05-03-2011 a las 16:07:13
-- Última actualización: 06-03-2011 a las 17:57:20
--

CREATE TABLE IF NOT EXISTS `vendedores` (
  `codvendedor` int(5) NOT NULL auto_increment,
  `nombrevendedor` varchar(45) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codvendedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Clientes' AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`codvendedor`, `nombrevendedor`, `movil`, `email`, `borrado`) VALUES
(8, 'Juan Espinoza ', '', '', '0'),
(10, 'Maria Espinoza', '', '', '0'),
(11, 'Carlos Jorquera', '', '', '0');

-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
-- Servidor: localhost
-- Tiempo de generación: 07-03-2011 a las 16:42:00
-- Versión del servidor: 5.0.91
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
--
/*
MySQL Data Transfer
Source Host: localhost
Source Database: test
Target Host: localhost
Target Database: test
Date: 08-02-2011 18:46:45
*/

SET FOREIGN_KEY_CHECKS=0;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
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
  PRIMARY KEY  (`indice`),
  KEY `indice` (`indice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Volcar la base de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`indice`, `usuario`, `clave`, `servidor`, `basedatos`, `numeracionfactura`, `setnumfac`, `fondofac`, `imagenfac`, `fondoguia`, `imagenguia`, `filasdetallefactura`, `ivaimp`, `nombremoneda`, `simbolomoneda`, `codigomoneda`, `nomempresa`, `giro`, `fonos`, `direccion`, `comuna`, `ciudadactual`, `numerofiscal`, `resolucionsii`, `rutempresa`, `giro2`, `logoempresa`) VALUES
(1, '', '', '', '', '2000', '1', 'SI', 'Factura v3.jpg', 'SI', 'logo.jpg', 20, '19', 'pesos', '$', '$', 'ROBOTEC', 'Equipos de Computo', '051- 44 94 8 363562', 'CC PRIMAVERA ESTAND E4', 'CENTRO', 'XOCHIMILCO', '12345', '78965', 'R.F.C. 544544544', 'Telecomunicaciones', '');

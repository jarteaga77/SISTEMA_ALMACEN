-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-03-2011 a las 15:26:29
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
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `cobradores`;
CREATE TABLE IF NOT EXISTS `cobradores` (
  `codcobrador` int(2) NOT NULL auto_increment,
  `nombrecobrador` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codcobrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Cobradores' AUTO_INCREMENT=03 ;

--
-- Volcar la base de datos para la tabla `cobradores`
--

INSERT INTO `cobradores` (`codcobrador`, `nombrecobrador`, `borrado`) VALUES
(1, 'ernesto  perez', '0'),
(2, 'juan gacitua', '0');

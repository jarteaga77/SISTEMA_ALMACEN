-- MySQL dump 10.11
--
-- Host: localhost    Database: arayaper_codekamx
-- ------------------------------------------------------
-- Server version	5.0.91-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `albalinea`
--

DROP TABLE IF EXISTS `albalinea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albalinea` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) character set utf8 default NULL,
  `cantidad` decimal(19,4) NOT NULL default '0.0000',
  `precio` decimal(19,4) NOT NULL default '0.0000',
  `importe` decimal(19,4) NOT NULL default '0.0000',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albalinea`
--

LOCK TABLES `albalinea` WRITE;
/*!40000 ALTER TABLE `albalinea` DISABLE KEYS */;
INSERT INTO `albalinea` VALUES (4,1,18,'13','1.0000','257.0000','257.0000',0),(5,1,18,'13','1.0000','257.0000','257.0000',0),(6,1,18,'13','1.0000','257.0000','257.0000',0),(7,1,18,'12','1.0000','126.0000','126.0000',0),(7,2,18,'11','1.0000','140.0000','140.0000',0),(7,3,18,'11','1.0000','140.0000','119.0000',15),(8,1,23,'15','1.0000','5200.0000','5200.0000',0),(9,1,18,'11','2.0000','140.0000','280.0000',0),(10,1,26,'17','1.0000','30.0000','30.0000',0),(11,1,18,'16','1.0000','20.0000','20.0000',0),(12,1,25,'25','1.0000','20.0000','20.0000',0),(13,1,18,'16','1.0000','20.0000','20.0000',0),(14,1,18,'16','1.0000','20.0000','20.0000',0),(16,1,18,'31','1.0000','11.0000','11.0000',0);
/*!40000 ALTER TABLE `albalinea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albalineap`
--

DROP TABLE IF EXISTS `albalineap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albalineap` (
  `codalbaran` varchar(20) NOT NULL default '0',
  `codproveedor` int(5) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) default NULL,
  `cantidad` decimal(10,0) NOT NULL default '0',
  `precio` decimal(19,4) NOT NULL default '0.0000',
  `importe` decimal(19,4) NOT NULL default '0.0000',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`codproveedor`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albalineap`
--

LOCK TABLES `albalineap` WRITE;
/*!40000 ALTER TABLE `albalineap` DISABLE KEYS */;
/*!40000 ALTER TABLE `albalineap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albalineaptmp`
--

DROP TABLE IF EXISTS `albalineaptmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albalineaptmp` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) default NULL,
  `cantidad` decimal(19,4) NOT NULL default '0.0000',
  `precio` decimal(19,4) NOT NULL default '0.0000',
  `importe` decimal(19,4) NOT NULL default '0.0000',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albalineaptmp`
--

LOCK TABLES `albalineaptmp` WRITE;
/*!40000 ALTER TABLE `albalineaptmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `albalineaptmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albalineatmp`
--

DROP TABLE IF EXISTS `albalineatmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albalineatmp` (
  `codalbaran` int(11) NOT NULL default '0',
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) default NULL,
  `codigo` varchar(15) character set utf8 default NULL,
  `cantidad` decimal(19,4) NOT NULL default '0.0000',
  `precio` decimal(19,4) NOT NULL default '0.0000',
  `importe` decimal(19,4) NOT NULL default '0.0000',
  `dcto` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albalineatmp`
--

LOCK TABLES `albalineatmp` WRITE;
/*!40000 ALTER TABLE `albalineatmp` DISABLE KEYS */;
INSERT INTO `albalineatmp` VALUES (97,1,18,'16','1.0000','20.0000','20.0000',0);
/*!40000 ALTER TABLE `albalineatmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albaranes`
--

DROP TABLE IF EXISTS `albaranes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albaranes` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `codfactura` int(11) NOT NULL default '0',
  `fecha` date NOT NULL default '0000-00-00',
  `iva` tinyint(4) NOT NULL default '0',
  `codcliente` int(5) default '0',
  `estado` varchar(1) character set utf8 default '1',
  `totalalbaran` decimal(19,4) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albaranes`
--

LOCK TABLES `albaranes` WRITE;
/*!40000 ALTER TABLE `albaranes` DISABLE KEYS */;
INSERT INTO `albaranes` VALUES (4,124,'2010-03-10',16,1,'2','298.1200','0'),(5,126,'2010-03-11',16,1,'2','298.1200','0'),(6,1015,'2010-03-11',16,1,'2','298.1200','0'),(7,125,'2010-03-11',16,1,'2','446.6000','1'),(8,1008,'2010-08-18',16,7,'2','6032.0000','0'),(9,1009,'2010-08-18',16,7,'2','324.8000','0'),(10,1016,'2010-08-19',19,7,'2','35.7000','0'),(11,1019,'2010-08-24',19,5,'2','23.8000','0'),(12,1019,'2010-08-24',19,5,'2','23.8000','0'),(13,0,'2010-08-24',19,5,'1','23.8000','0'),(14,0,'2010-08-24',19,5,'1','23.8000','0'),(15,1028,'2010-08-25',19,5,'2','0.0000','0'),(16,1028,'2010-09-06',19,5,'2','13.0900','0');
/*!40000 ALTER TABLE `albaranes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albaranesp`
--

DROP TABLE IF EXISTS `albaranesp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albaranesp` (
  `codalbaran` varchar(20) NOT NULL default '0',
  `codproveedor` int(5) NOT NULL default '0',
  `codfactura` varchar(20) default NULL,
  `fecha` date NOT NULL default '0000-00-00',
  `iva` tinyint(4) NOT NULL default '0',
  `estado` varchar(1) default '1',
  `totalalbaran` decimal(19,4) NOT NULL default '0.0000',
  PRIMARY KEY  (`codalbaran`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albaranesp`
--

LOCK TABLES `albaranesp` WRITE;
/*!40000 ALTER TABLE `albaranesp` DISABLE KEYS */;
/*!40000 ALTER TABLE `albaranesp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albaranesptmp`
--

DROP TABLE IF EXISTS `albaranesptmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albaranesptmp` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='Temporal de albaranes de proveedores para controlar acceso s';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albaranesptmp`
--

LOCK TABLES `albaranesptmp` WRITE;
/*!40000 ALTER TABLE `albaranesptmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `albaranesptmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albaranestmp`
--

DROP TABLE IF EXISTS `albaranestmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albaranestmp` (
  `codalbaran` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`codalbaran`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albaranestmp`
--

LOCK TABLES `albaranestmp` WRITE;
/*!40000 ALTER TABLE `albaranestmp` DISABLE KEYS */;
INSERT INTO `albaranestmp` VALUES (97,'2010-09-29');
/*!40000 ALTER TABLE `albaranestmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `codarticulo` int(10) NOT NULL auto_increment,
  `codfamilia` int(5) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `descripcion` varchar(26) NOT NULL,
  `impuesto` float NOT NULL,
  `codproveedor1` int(5) NOT NULL default '1',
  `codproveedor2` int(5) NOT NULL,
  `descripcion_corta` varchar(30) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='Articulos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (11,18,'netbook toshiva 234-','computador portatil peso 3',15,4,5,'net6book toshiva',1,-39,2,'1','','2010-03-07',3,12,'1','1','dsdsds','120.00','140.00','180.00',NULL,'240.00','5600000000113','foto11.jpg','1'),(12,18,'notbook canon a-1345','computador portatil canon ',15,4,5,'computador portatil  ',4,-54,3,'1','','2010-03-07',3,1,'1','1','','124.00','126.00','137.00',NULL,'167.00','8400000000123','foto12.jpg','1'),(13,19,'escritorio notebook ','escritorio para notebook a',15,5,6,'escritorio',1,-13,1,'1','','2010-03-08',3,1,'1','0','fgfgfg','234.00','257.00','567.00',NULL,'456.00','8400000000130','foto13.jpg','1'),(14,18,'arturo','xcxccxxcz',15,4,0,'xczxczczx',4,11,2,'0','a','2010-05-13',1,1,'0','','ASDASDASD','0.00','0.00','0.00',NULL,'0.00','8400000000147','foto14.jpg','1'),(15,23,'CT-43','LANA',5,8,0,'CT',1,62,5,'1','TELA DE LANA','2010-08-18',2,50,'0','','','5000.00','5200.00','5500.00',NULL,'5800.00','8400000000154','foto15.jpg','1'),(16,18,'1800100','Consumo Electrico Mensual',19,7,0,'Consumo electrico',4,40,0,'0','','0000-00-00',4,0,'0','0','','0.00','0.00','0.00',NULL,'0.00','8400000000161','foto16.jpg','0'),(17,26,'err','dfsdf',19,7,0,'cvv',4,49,0,'0','','0000-00-00',1,0,'0','0','','0.00','0.00','0.00',NULL,'0.00','5600000000175','foto17.jpg','0'),(18,26,'12-123','BMNBMN',19,7,0,'LKLKÑ',5,99,0,'0','','2010-08-04',4,0,'0','0','','0.00','0.00','0.00',NULL,'0.00','8400000000185','foto18.jpg','0'),(19,26,'12-456','XCCC',19,7,0,'CCXXCZ',5,-32,0,'0','CCXCXC','0000-00-00',6,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000192','foto19.jpg','0'),(20,25,'12-98745','vbvb',19,7,0,'xcxcvv',1,12,0,'0','vxcv','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000208','foto20.jpg','0'),(21,25,'12-7896','asdafsdf',19,7,0,'sddsdsd',5,-6,0,'0','','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000215','foto21.jpg','0'),(22,26,'12-4563','vvbvb',19,7,0,'bvbvbv',5,0,0,'0','bvbb','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000222','foto22.jpg','0'),(23,26,'19-123654','fggffd',19,7,0,'dggd',4,0,0,'0','','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000239','foto23.jpg','0'),(24,26,'111111111','cvxc',19,0,0,'cvcvc',5,0,0,'0','ccvcv','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','8400000000246','foto24.jpg','0'),(25,25,'xcxccx','caño',19,5,0,'ccxxcc',1,-1,0,'0','','0000-00-00',4,0,'0','0','','33.00','0.00','31.00',NULL,'33.00','8400000000253','foto25.jpg','0'),(26,25,'44444444444444444444','cxzzxx',19,0,0,'xccxxc',5,0,0,'0','xcxcxc','0000-00-00',3,0,'0','','','0.00','0.00','0.00',NULL,'0.00','5600000000267','foto26.jpg','0'),(27,26,'asasas','asassa',19,0,0,'asasasa',4,0,0,'0','asasas','0000-00-00',3,0,'0','','','0.00','0.00','0.00',NULL,'0.00','5600000000274','foto27.jpg','0'),(28,26,'4444','asdad',19,0,0,'sddssda',4,-1,0,'0','sdsddssd','0000-00-00',4,0,'0','','','0.00','0.00','0.00',NULL,'0.00','5600000000281','foto28.jpg','0'),(29,25,'2132565487','xxczcxx',19,0,0,'cxxcxccx',4,0,0,'0','xccxxcczx','2010-08-01',1,0,'0','','zxccxzxc','0.00','0.00','0.00',NULL,'0.00','7500000000299','foto29.jpg','0'),(30,26,'54653221','x xczxcz',19,0,0,'xcxccxxcz',4,0,0,'0','cxxczxczxcxcz','2010-08-01',4,0,'0','','xczczxczxxzc','0.00','0.00','0.00',NULL,'0.00','7500000000305','foto30.jpg','0'),(31,18,'200-100','Mochila',19,0,0,'mochila',5,-3,0,'0','','0000-00-00',4,0,'0','','','11.00','11.00','0.00',NULL,'0.00','8400000000314','foto31.jpg','0'),(32,24,'3268884310','Cubeta de pintura vinilica',19,7,0,'cub. 20 litros',1,17,3,'1','cubeta de pintura vinilica de varios colores','2010-09-01',1,1,'0','','n','20.00','2.00','25.00',NULL,'30.00','8400000000321','foto32.jpg','0');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artpro`
--

DROP TABLE IF EXISTS `artpro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artpro` (
  `codarticulo` varchar(15) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `precio` decimal(19,4) NOT NULL,
  PRIMARY KEY  (`codarticulo`,`codfamilia`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artpro`
--

LOCK TABLES `artpro` WRITE;
/*!40000 ALTER TABLE `artpro` DISABLE KEYS */;
INSERT INTO `artpro` VALUES ('13',18,4,'234.0000'),('16',18,7,'114802.0000'),('16',18,8,'12352.0000');
/*!40000 ALTER TABLE `artpro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authteam`
--

DROP TABLE IF EXISTS `authteam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authteam` (
  `id` int(4) NOT NULL auto_increment,
  `teamname` varchar(25) NOT NULL default '',
  `teamlead` varchar(25) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `teamname` (`teamname`,`teamlead`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authteam`
--

LOCK TABLES `authteam` WRITE;
/*!40000 ALTER TABLE `authteam` DISABLE KEYS */;
INSERT INTO `authteam` VALUES (1,'Ungrouped','sa','active'),(2,'Admin','sa','active'),(3,'Temporary','sa','active'),(7,'Group 1','sa','active'),(8,'Group 2','test','active'),(9,'Group 3','admin','active');
/*!40000 ALTER TABLE `authteam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authuser`
--

DROP TABLE IF EXISTS `authuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authuser` (
  `id` int(11) NOT NULL auto_increment,
  `uname` varchar(25) NOT NULL default '',
  `passwd` varchar(32) NOT NULL default '',
  `team` varchar(25) NOT NULL default '',
  `level` int(4) NOT NULL default '0',
  `status` varchar(10) NOT NULL default '',
  `lastlogin` datetime default NULL,
  `logincount` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authuser`
--

LOCK TABLES `authuser` WRITE;
/*!40000 ALTER TABLE `authuser` DISABLE KEYS */;
INSERT INTO `authuser` VALUES (1,'sa','9df3b01c60df20d13843841ff0d4482c','Admin',1,'active','2010-06-26 11:29:28',12),(2,'admin','9df3b01c60df20d13843841ff0d4482c','Admin',1,'active','2010-06-22 18:30:24',21),(3,'test','9df3b01c60df20d13843841ff0d4482c','Temporary',999,'active','2003-04-03 00:00:34',0),(11,'G1-0001','9df3b01c60df20d13843841ff0d4482c','Group 1',5,'active','2003-04-04 10:59:02',0),(12,'G1-0002','9df3b01c60df20d13843841ff0d4482c','Group 1',2,'active','0000-00-00 00:00:00',0),(13,'G2-0001','9df3b01c60df20d13843841ff0d4482c','Group 2',5,'active','2003-04-03 00:46:20',0),(14,'G2-0002','9df3b01c60df20d13843841ff0d4482c','Group 2',6,'active','2003-04-03 00:48:04',0),(15,'G2-0003','9df3b01c60df20d13843841ff0d4482c','Group 2',3,'active','2003-04-04 10:31:16',0),(16,'G3-0001','9df3b01c60df20d13843841ff0d4482c','Group 3',10,'active','0000-00-00 00:00:00',0),(17,'G3-0002','9df3b01c60df20d13843841ff0d4482c','Group 3',4,'active','0000-00-00 00:00:00',0),(20,'arturo','34facb611d63077b415e7e4ae92845a2','Group 2',4,'active','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `authuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `codcliente` int(5) NOT NULL auto_increment,
  `nombre` varchar(45) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Cliente Mostrador','NA','NA',0,'',0,0,'','','','','','','1'),(5,'Cliente02','02','rto. Valle Nuevo',2,'San Salvador',3,4,'789','503','3232','232','tino@gmail.com','www.rd.com','0'),(6,'Compueasy','HEJS821008 KQ4','Avda, Juan Aldama nº 87 ',16,'Tlaquiltenango',1,4,'','62983','3421574','','compueasy@mail.com','','1'),(7,'Maria Cordero','1234556','calle 23 entre 27 y 28',2,'Barquisimeto',3,3,'23545 6 56467','45we5','5656','654','','','0'),(8,'ernesto perez','ddasasd','asdsddsd',29,'sdds',1,4,'','13665','2123323',',x,x,xc','sdfffsd','fddff','1'),(9,'21112121','','cxcc',0,'',0,0,'','','','','','','1'),(10,'cxcczxc','','',0,'',0,0,'','','','','','','1'),(11,'f444444','','',0,'',0,0,'','','','','','','1'),(12,'hjhhn77777¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡','','',0,'',0,0,'','','','','','','1');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobros`
--

DROP TABLE IF EXISTS `cobros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobros` (
  `id` int(11) NOT NULL auto_increment,
  `codfactura` int(11) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `importe` decimal(19,4) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechacobro` date NOT NULL default '0000-00-00',
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='Cobros de facturas a clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobros`
--

LOCK TABLES `cobros` WRITE;
/*!40000 ALTER TABLE `cobros` DISABLE KEYS */;
INSERT INTO `cobros` VALUES (24,122,1,'13.2200',1,'','2010-03-09',''),(25,123,1,'644.5656',1,'','2010-03-09',''),(26,127,5,'158.9200',1,'520','2010-03-23',''),(27,133,1,'158.9200',1,'','2010-06-03',''),(28,135,1,'208.8000',1,'45243481','2010-06-10',''),(29,136,1,'208.8000',1,'','2010-06-10',''),(30,131,1,'208.8000',1,'12345678','2010-06-11',''),(31,151,1,'163.0300',1,'','2010-06-26',''),(32,154,1,'0.0000',1,'','2010-08-06',''),(33,1001,1,'163.0300',1,'111','2010-08-10',''),(34,1005,5,'668.1600',1,'','2010-08-18',''),(35,1010,1,'0.0000',2,'','2010-08-18',''),(36,1011,5,'214.2000',1,'','2010-08-18',''),(37,1013,1,'194.2000',1,'','2010-08-18',''),(38,1017,1,'178.5000',1,'','2010-08-20',''),(39,1022,1,'146.3700',1,'','2010-08-29',''),(40,1026,1,'73.7800',2,'A0000','2010-09-09','Pago total'),(41,1026,1,'7.7800',2,'','2010-09-11',''),(42,1032,1,'73.7800',1,'','2010-09-21',''),(43,1033,5,'166.0050',1,'','2010-09-22',''),(44,1035,1,'29.7500',2,'89898','2010-09-24','');
/*!40000 ALTER TABLE `cobros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embalajes`
--

DROP TABLE IF EXISTS `embalajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `embalajes` (
  `codembalaje` int(3) NOT NULL auto_increment,
  `nombre` varchar(30) default NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codembalaje`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Embalajes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalajes`
--

LOCK TABLES `embalajes` WRITE;
/*!40000 ALTER TABLE `embalajes` DISABLE KEYS */;
INSERT INTO `embalajes` VALUES (1,'Caja','0'),(2,'resma','0'),(3,'unidad','0'),(4,'No aplica','0');
/*!40000 ALTER TABLE `embalajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entidades`
--

DROP TABLE IF EXISTS `entidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidades` (
  `codentidad` int(2) NOT NULL auto_increment,
  `nombreentidad` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codentidad`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidades`
--

LOCK TABLES `entidades` WRITE;
/*!40000 ALTER TABLE `entidades` DISABLE KEYS */;
INSERT INTO `entidades` VALUES (3,'Banamex','0'),(4,'Banco Azteca','0'),(5,'Santander','0'),(6,'BBVA Bancomer','0'),(7,'HSBC','0'),(8,'ScotiaBank','1'),(9,'Banorte','0'),(10,'bciii','1');
/*!40000 ALTER TABLE `entidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventcal`
--

DROP TABLE IF EXISTS `eventcal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventcal` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `eventDate` date default NULL,
  `eventTitle` varchar(100) default NULL,
  `eventContent` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventcal`
--

LOCK TABLES `eventcal` WRITE;
/*!40000 ALTER TABLE `eventcal` DISABLE KEYS */;
INSERT INTO `eventcal` VALUES (1,'2010-09-28','ivas','pagar'),(2,'2010-09-30','Cumpleaño Maria Ines','Nos reuniremos a almorzar con la jefatura en el Casino Royal. Cancela la Empresa');
/*!40000 ALTER TABLE `eventcal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventID` bigint(20) unsigned NOT NULL auto_increment,
  `eventDate` date default NULL,
  `eventContent` longtext,
  `langCode` varchar(20) default 'en',
  PRIMARY KEY  (`eventID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'2010-09-23','this is my first ','en'),(2,'2010-09-30','this is my second event','en'),(3,'2010-09-30','&#2351;&#2361; &#2350;&#2375;&#2352;&#2366; &#2346;&#2361;&#2354;&#2366; &#2360;&#2306;&#2342;&#2375;&#2358; &#2361;&#2376;','hi'),(4,'2010-09-29','This is new event','en'),(5,'2005-03-29','This is new event','en'),(6,'2005-03-29','This is new event','en'),(7,'2005-04-15','This is new event','en'),(8,'2005-04-15','This is new event','en'),(9,'2005-04-17','This is updated third event','en');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factulinea`
--

DROP TABLE IF EXISTS `factulinea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factulinea` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas a clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factulinea`
--

LOCK TABLES `factulinea` WRITE;
/*!40000 ALTER TABLE `factulinea` DISABLE KEYS */;
INSERT INTO `factulinea` VALUES (122,1,18,'13','1.00','12.00','11.40',5),(123,1,18,'13','1.00','567.00','555.66',2),(124,1,18,'13','1.00','257.00','257.00',0),(125,1,18,'12','1.00','126.00','126.00',0),(125,2,18,'11','1.00','140.00','140.00',0),(125,3,18,'11','1.00','140.00','119.00',15),(126,1,18,'13','1.00','257.00','257.00',0),(127,1,18,'12','1.00','137.00','137.00',0),(128,1,18,'11','1.00','180.00','180.00',0),(128,2,18,'12','1.00','126.00','126.00',0),(128,3,18,'12','1.00','126.00','126.00',0),(129,1,18,'12','1.00','137.00','137.00',0),(130,1,18,'12','1.00','200.00','200.00',0),(130,2,18,'12','10.00','126.00','945.00',25),(131,1,18,'11','1.00','180.00','180.00',0),(132,1,18,'11','1.00','180.00','180.00',0),(133,1,18,'12','1.00','137.00','137.00',0),(134,1,18,'12','1.00','126.00','126.00',0),(135,1,18,'11','1.00','180.00','180.00',0),(136,1,18,'11','1.00','180.00','180.00',0),(137,1,18,'12','1.00','126.00','126.00',0),(138,1,18,'12','1.00','137.00','137.00',0),(139,1,18,'11','1.00','140.00','140.00',0),(140,1,18,'14','1.00','0.00','0.00',0),(141,1,18,'12','1.00','137.00','137.00',0),(141,2,19,'13','1.00','567.00','567.00',0),(142,1,18,'12','1.00','137.00','137.00',0),(143,1,18,'12','1.00','137.00','137.00',0),(144,1,18,'11','1.00','180.00','180.00',0),(145,1,18,'12','1.00','137.00','137.00',0),(145,2,19,'13','1.00','567.00','567.00',0),(146,1,18,'12','1.00','137.00','137.00',0),(147,1,18,'12','1.00','137.00','137.00',0),(147,2,19,'13','1.00','567.00','567.00',0),(148,1,18,'11','1.00','180.00','180.00',0),(149,1,18,'12','1.00','137.00','137.00',0),(150,3,18,'11','6.00','140.00','739.20',12),(151,1,18,'12','1.00','137.00','137.00',0),(150,2,19,'13','10.00','257.00','2364.40',8),(150,1,18,'12','10.00','126.00','1197.00',5),(152,2,18,'11','16.00','140.00','1904.00',15),(152,1,18,'12','10.00','126.00','1071.00',15),(153,1,18,'11','1.00','180.00','180.00',0),(155,1,18,'12','1.00','137.00','137.00',0),(156,1,18,'12','1.00','126.00','126.00',0),(157,1,18,'12','1.00','137.00','137.00',0),(158,1,19,'13','1.00','257.00','257.00',0),(159,1,0,'','1.00','0.00','0.00',0),(159,2,18,'12','1.00','137.00','137.00',0),(160,1,18,'12','1.00','137.00','137.00',0),(999,1,19,'13','1.00','257.00','257.00',0),(1000,1,18,'11','7.00','140.00','980.00',0),(1001,1,18,'12','1.00','137.00','137.00',0),(1002,1,18,'12','1.00','137.00','137.00',0),(1003,1,18,'12','5.00','137.00','661.03',3),(1004,1,23,'15','1.00','3455.00','3455.00',0),(1004,2,18,'12','2.00','34556.00','65656.40',5),(1005,1,19,'13','1.00','576.00','576.00',0),(1006,1,23,'15','1.00','5200.00','5200.00',0),(1007,1,23,'15','6.00','5200.00','29640.00',5),(1008,1,23,'15','1.00','5200.00','5200.00',0),(1009,1,18,'11','2.00','140.00','280.00',0),(1011,1,18,'11','1.00','180.00','180.00',0),(1012,1,18,'16','1.00','0.00','0.00',0),(1012,2,18,'11','1.00','180.00','180.00',0),(1013,1,18,'11','1.00','180.00','180.00',0),(1014,1,18,'11','1.00','6678.00','6678.00',0),(1015,1,18,'13','1.00','257.00','257.00',0),(1016,1,26,'17','1.00','30.00','30.00',0),(1017,1,26,'17','1.00','150.00','150.00',0),(1018,1,18,'16','1.00','1000.00','1000.00',0),(1019,2,25,'25','1.00','20.00','20.00',0),(1019,1,18,'16','1.00','20.00','20.00',0),(1020,1,18,'16','6.00','0.00','0.00',0),(1020,2,26,'19','1.00','0.00','0.00',0),(1021,1,18,'16','1.00','0.00','0.00',0),(1022,2,26,'18','1.00','123.00','123.00',0),(1023,1,25,'25','1.00','31.00','31.00',0),(1023,2,25,'25','9.00','31.00','279.00',0),(1024,2,26,'19','31.00','0.00','0.00',5),(1024,1,26,'28','1.00','0.00','0.00',5),(1025,1,25,'25','1.00','31.00','31.00',0),(1026,1,25,'25','2.00','31.00','62.00',0),(1027,1,18,'16','1.00','0.00','0.00',0),(1027,2,25,'21','6.00','0.00','0.00',0),(1028,1,18,'31','1.00','11.00','11.00',0),(1029,1,18,'31','1.00','11.00','11.00',0),(1030,1,18,'31','1.00','11.00','11.00',0),(1031,1,25,'25','1.00','31.00','31.00',0),(1032,1,25,'25','1.00','31.00','31.00',0),(1032,2,25,'25','1.00','31.00','31.00',0),(1033,1,25,'25','5.00','31.00','139.50',10),(1034,1,18,'31','1.00','123.00','123.00',0),(1035,1,24,'32','1.00','25.00','25.00',0),(1036,1,24,'32','1.00','2.00','2.00',0),(1037,1,24,'32','1.00','2.00','2.00',0);
/*!40000 ALTER TABLE `factulinea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factulineap`
--

DROP TABLE IF EXISTS `factulineap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factulineap` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factulineap`
--

LOCK TABLES `factulineap` WRITE;
/*!40000 ALTER TABLE `factulineap` DISABLE KEYS */;
INSERT INTO `factulineap` VALUES ('6514021',7,1,18,'16','1.00','114802.00','114802.00',0);
/*!40000 ALTER TABLE `factulineap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factulineaptmp`
--

DROP TABLE IF EXISTS `factulineaptmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factulineaptmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores temporal';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factulineaptmp`
--

LOCK TABLES `factulineaptmp` WRITE;
/*!40000 ALTER TABLE `factulineaptmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `factulineaptmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factulineatmp`
--

DROP TABLE IF EXISTS `factulineatmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factulineatmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL auto_increment,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` decimal(19,2) NOT NULL,
  `precio` decimal(19,2) NOT NULL,
  `importe` decimal(19,2) NOT NULL,
  `dcto` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codfactura`,`numlinea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Temporal de linea de facturas a clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factulineatmp`
--

LOCK TABLES `factulineatmp` WRITE;
/*!40000 ALTER TABLE `factulineatmp` DISABLE KEYS */;
INSERT INTO `factulineatmp` VALUES (1144,1,18,'16','1.00','0.00','0.00',0),(1145,1,24,'32','1.00','25.00','25.00',0);
/*!40000 ALTER TABLE `factulineatmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `estado` varchar(1) NOT NULL default '0',
  `totalfactura` decimal(19,4) NOT NULL,
  `fechavencimiento` date NOT NULL default '0000-00-00',
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM AUTO_INCREMENT=1038 DEFAULT CHARSET=utf8 COMMENT='facturas de ventas a clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (122,'2010-03-09',16,1,'2','13.2240','0000-00-00','0'),(123,'2010-03-09',16,1,'2','644.5656','0000-00-00','0'),(124,'2010-03-10',16,1,'1','298.1200','0000-00-00','0'),(125,'2010-03-11',16,1,'1','446.6000','0000-00-00','0'),(126,'2010-03-11',16,1,'1','298.1200','0000-00-00','0'),(127,'2010-03-23',16,5,'2','158.9200','0000-00-00','0'),(128,'2010-03-23',16,1,'1','501.1200','0000-00-00','0'),(129,'2010-04-06',16,1,'1','158.9200','0000-00-00','0'),(130,'2010-04-07',16,1,'1','1328.2000','0000-00-00','0'),(131,'2010-06-02',16,1,'1','208.8000','2010-06-10','0'),(132,'2010-06-03',16,1,'1','208.8000','0000-00-00','0'),(133,'2010-06-03',16,1,'2','158.9200','0000-00-00','0'),(134,'2010-06-09',16,5,'1','146.1600','0000-00-00','0'),(135,'2010-06-10',16,1,'2','208.8000','0000-00-00','0'),(136,'2010-06-10',16,1,'2','208.8000','0000-00-00','0'),(137,'2010-06-10',19,1,'1','149.9400','0000-00-00','0'),(138,'2010-06-19',19,1,'1','163.0300','0000-00-00','0'),(139,'2010-06-19',19,1,'1','166.6000','0000-00-00','0'),(140,'2010-06-24',19,1,'1','0.0000','0000-00-00','0'),(141,'2010-06-24',19,1,'1','837.7600','0000-00-00','0'),(142,'2010-06-24',19,1,'1','163.0300','0000-00-00','0'),(143,'2010-06-24',19,1,'1','163.0300','0000-00-00','0'),(144,'2010-06-24',19,1,'1','214.2000','0000-00-00','0'),(145,'2010-06-24',19,1,'1','837.7600','0000-00-00','0'),(146,'2010-06-24',19,1,'1','163.0300','0000-00-00','0'),(147,'2010-06-25',19,1,'1','837.7600','0000-00-00','0'),(148,'2010-06-25',19,1,'1','214.2000','0000-00-00','0'),(149,'2010-06-25',19,1,'1','163.0300','0000-00-00','0'),(150,'2010-06-25',19,1,'1','5117.7140','0000-00-00','0'),(151,'2010-06-26',19,1,'2','163.0300','0000-00-00','0'),(152,'2010-06-30',5,6,'1','3123.7500','0000-00-00','0'),(153,'2010-08-06',19,1,'1','214.2000','0000-00-00','0'),(154,'2010-08-06',19,1,'2','0.0000','0000-00-00','0'),(155,'2010-08-07',19,1,'1','163.0300','0000-00-00','0'),(156,'2010-08-07',19,6,'1','149.9400','0000-00-00','0'),(157,'2010-08-07',19,1,'1','163.0300','0000-00-00','0'),(158,'2010-08-09',19,6,'1','305.8300','0000-00-00','0'),(159,'2010-08-10',19,1,'1','163.0300','0000-00-00','0'),(160,'2010-08-10',19,1,'1','163.0300','0000-00-00','0'),(999,'2010-08-10',19,6,'1','305.8300','0000-00-00','0'),(1000,'2010-08-11',19,1,'1','1166.2000','0000-00-00','0'),(1001,'2010-08-10',19,1,'2','163.0300','0000-00-00','0'),(1002,'2010-08-12',19,6,'1','163.0300','0000-00-00','0'),(1003,'2010-08-13',19,6,'1','786.6257','0000-00-00','0'),(1004,'2010-08-18',12,5,'1','77404.7680','0000-00-00','0'),(1005,'2010-08-18',16,5,'2','668.1600','0000-00-00','1'),(1006,'2010-08-18',16,7,'1','6032.0000','0000-00-00','1'),(1007,'2010-08-18',12,7,'1','33196.8000','0000-00-00','0'),(1008,'2010-08-18',16,7,'1','6032.0000','0000-00-00','0'),(1009,'2010-08-18',16,7,'1','324.8000','0000-00-00','0'),(1010,'2010-08-18',16,1,'2','0.0000','0000-00-00','0'),(1011,'2010-08-18',19,5,'2','214.2000','0000-00-00','0'),(1012,'2010-08-18',19,1,'1','214.2000','0000-00-00','0'),(1013,'2010-08-18',19,1,'2','214.2000','0000-00-00','0'),(1014,'2010-08-19',16,1,'1','7746.4800','0000-00-00','0'),(1015,'2010-03-11',16,1,'1','298.1200','0000-00-00','0'),(1016,'2010-08-19',19,7,'2','35.7000','0000-00-00','0'),(1017,'2010-08-20',19,1,'2','178.5000','0000-00-00','0'),(1018,'2010-08-23',19,1,'1','1190.0000','0000-00-00','0'),(1019,'2010-08-24',19,5,'1','47.6000','0000-00-00','0'),(1020,'2010-08-28',19,1,'1','0.0000','0000-00-00','0'),(1021,'2010-08-28',19,1,'1','0.0000','0000-00-00','0'),(1022,'2010-08-29',19,1,'2','146.3700','0000-00-00','0'),(1023,'2010-09-01',19,5,'1','368.9000','0000-00-00','0'),(1024,'2010-09-05',19,7,'1','0.0000','0000-00-00','0'),(1025,'2010-09-06',19,5,'1','36.8900','0000-00-00','0'),(1026,'2010-09-09',19,1,'2','73.7800','0000-00-00','0'),(1027,'2010-09-12',19,1,'1','0.0000','0000-00-00','0'),(1028,'2010-09-15',19,5,'1','13.0900','0000-00-00','0'),(1029,'2010-09-20',19,7,'1','13.0900','0000-00-00','0'),(1030,'2010-09-20',19,7,'1','13.0900','0000-00-00','0'),(1031,'2010-09-21',19,1,'1','36.8900','0000-00-00','0'),(1032,'2010-09-21',19,1,'2','73.7800','0000-00-00','0'),(1033,'2010-09-22',19,5,'2','166.0050','0000-00-00','0'),(1034,'2010-09-22',16,1,'1','142.6800','0000-00-00','0'),(1035,'2010-09-24',19,1,'2','29.7500','0000-00-00','0'),(1036,'2010-09-24',19,7,'1','2.3800','0000-00-00','0'),(1037,'2010-09-25',19,5,'1','2.3800','0000-00-00','0');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturasp`
--

DROP TABLE IF EXISTS `facturasp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturasp` (
  `codfactura` varchar(20) NOT NULL default '',
  `codproveedor` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `estado` varchar(1) NOT NULL default '0',
  `totalfactura` decimal(19,4) NOT NULL,
  `fechapago` date NOT NULL default '0000-00-00',
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfactura`,`codproveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='facturas de compras a proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturasp`
--

LOCK TABLES `facturasp` WRITE;
/*!40000 ALTER TABLE `facturasp` DISABLE KEYS */;
INSERT INTO `facturasp` VALUES ('6514021',7,'2010-05-24',19,'1','136614.3800','0000-00-00','0');
/*!40000 ALTER TABLE `facturasp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturasptmp`
--

DROP TABLE IF EXISTS `facturasptmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturasptmp` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='temporal de facturas de proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturasptmp`
--

LOCK TABLES `facturasptmp` WRITE;
/*!40000 ALTER TABLE `facturasptmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturasptmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturastmp`
--

DROP TABLE IF EXISTS `facturastmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturastmp` (
  `codfactura` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`codfactura`)
) ENGINE=MyISAM AUTO_INCREMENT=1146 DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturastmp`
--

LOCK TABLES `facturastmp` WRITE;
/*!40000 ALTER TABLE `facturastmp` DISABLE KEYS */;
INSERT INTO `facturastmp` VALUES (1144,'2010-09-29'),(1143,'2010-09-29'),(1142,'2010-09-28'),(1141,'2010-09-28'),(1140,'2010-09-28'),(1139,'2010-09-28'),(1138,'2010-09-28'),(1135,'2010-09-28'),(1137,'2010-09-28'),(1136,'2010-09-28'),(1134,'2010-09-27'),(1145,'2010-09-29');
/*!40000 ALTER TABLE `facturastmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familias` (
  `codfamilia` int(5) NOT NULL auto_increment,
  `nombre` varchar(20) default NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codfamilia`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='familia de articulos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
INSERT INTO `familias` VALUES (18,'Insumos Fabrica','0'),(19,'escritorios','1'),(20,'PEROLES','1'),(21,'PEROLITO','1'),(22,'COSAS','1'),(23,'tELAS','1'),(24,'Pinturas','0'),(25,'Fierro','0'),(26,'Gastos Bancos','0');
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formapago`
--

DROP TABLE IF EXISTS `formapago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formapago` (
  `codformapago` int(2) NOT NULL auto_increment,
  `nombrefp` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codformapago`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Forma de pago';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formapago`
--

LOCK TABLES `formapago` WRITE;
/*!40000 ALTER TABLE `formapago` DISABLE KEYS */;
INSERT INTO `formapago` VALUES (1,'Contado Efectivo','0'),(2,'Contado Cheque','0'),(3,'Cheque 30 y 60 ','0'),(4,'Tarjeta de Credito','1');
/*!40000 ALTER TABLE `formapago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impuestos`
--

DROP TABLE IF EXISTS `impuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impuestos` (
  `codimpuesto` int(3) NOT NULL auto_increment,
  `nombre` varchar(20) default NULL,
  `valor` decimal(19,4) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codimpuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='tipos de impuestos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impuestos`
--

LOCK TABLES `impuestos` WRITE;
/*!40000 ALTER TABLE `impuestos` DISABLE KEYS */;
INSERT INTO `impuestos` VALUES (5,'IVA','19.0000','0'),(6,'IVA nulo','0.0000','0'),(7,'exento','0.0000','0');
/*!40000 ALTER TABLE `impuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `librodiario`
--

DROP TABLE IF EXISTS `librodiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `librodiario` (
  `id` int(8) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  `tipodocumento` varchar(1) NOT NULL,
  `coddocumento` varchar(20) NOT NULL,
  `codcomercial` int(5) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numpago` varchar(30) NOT NULL,
  `total` decimal(19,4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='Movimientos diarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `librodiario`
--

LOCK TABLES `librodiario` WRITE;
/*!40000 ALTER TABLE `librodiario` DISABLE KEYS */;
INSERT INTO `librodiario` VALUES (33,'2010-03-09','2','122',1,1,'','13.2200'),(34,'2010-03-09','2','123',1,1,'','644.5656'),(35,'2010-03-23','2','127',5,1,'520','158.9200'),(36,'2010-06-03','2','133',1,1,'','158.9200'),(37,'2010-06-10','2','135',1,1,'45243481','208.8000'),(38,'2010-06-10','2','136',1,1,'','208.8000'),(39,'2010-06-11','2','131',1,1,'12345678','208.8000'),(40,'2010-06-26','2','151',1,1,'','163.0300'),(41,'2010-08-06','2','154',1,1,'','0.0000'),(42,'2010-08-10','2','1001',1,1,'111','163.0300'),(43,'2010-08-18','2','1005',5,1,'','668.1600'),(44,'2010-08-18','2','1010',1,2,'','0.0000'),(45,'2010-08-18','2','1011',5,1,'','214.2000'),(46,'2010-08-18','2','1013',1,1,'','194.2000'),(47,'2010-08-20','2','1017',1,1,'','178.5000'),(48,'2010-08-29','2','1022',1,1,'','146.3700'),(49,'2010-09-09','2','1026',1,2,'A0000','73.7800'),(50,'2010-09-11','2','1026',1,2,'','7.7800'),(51,'2010-09-21','2','1032',1,1,'','73.7800'),(52,'2010-09-22','2','1033',5,1,'','166.0050'),(53,'2010-09-24','1','6514021',7,2,'2323','136614.3800'),(54,'2010-09-24','2','1035',1,2,'89898','29.7500');
/*!40000 ALTER TABLE `librodiario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(11) NOT NULL auto_increment,
  `codfactura` varchar(20) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `importe` decimal(19,4) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechapago` date default '0000-00-00',
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Pagos de facturas a proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (4,'6514021',7,'136614.3800',2,'2323','2010-09-24','');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `indice` int(1) default NULL,
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
  `giro2` varchar(50) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` VALUES (1,'','','','','999','0','SI','Factura v3.jpg','SI','logo.jpg',24,'19','Pesos','$','$','PELUCHES ABASHAMME','PELUCHES Y REGALOS','051 44 94 8 363562','CC PRIMAVERA ESTAND E4','CENTRO','TRUJILLO',NULL,NULL,'R.F.C. 544544544',NULL);
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petroleo`
--

DROP TABLE IF EXISTS `petroleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petroleo` (
  `mes` int(11) default NULL,
  `precio` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petroleo`
--

LOCK TABLES `petroleo` WRITE;
/*!40000 ALTER TABLE `petroleo` DISABLE KEYS */;
/*!40000 ALTER TABLE `petroleo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `codproveedor` int(5) NOT NULL auto_increment,
  `nombre` varchar(45) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Proveedores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (4,'ernesto perez','123456','chutalpetec   234',8,'Chamullo ',4,'10-2345-9876543','2345','3456783','','asdf@hotmail.con','','0'),(5,'proveedor2','787','rto. Valle Nuevo',1,'San Salvador',3,'000123','503','2323232','23232','tino@gmail.com','dsds','0'),(6,'proveedor3','4546','sdadasd',2,'sdadas',4,'21321','503','311','21321','w','www.rd.com','1'),(7,'Chilectra  S.A.','96800570-7','Santa Rosa 76',1,'Santiago',3,'','','','','','','0'),(8,'ucla','123456','av las industrias',1,'Barquisimeto',6,'12324354e657','3001','23423435','4535646','','','0'),(9,'aaaaaaaaaa','','',0,'',0,'','','','','','','1');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `codprovincia` int(2) NOT NULL auto_increment,
  `nombreprovincia` varchar(40) NOT NULL,
  PRIMARY KEY  (`codprovincia`)
) ENGINE=MyISAM AUTO_INCREMENT=16406 DEFAULT CHARSET=utf8 COMMENT='Provincias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'Aguascalientes'),(2,'Baja California Norte'),(3,'Baja California Sur'),(4,'Chihuahua'),(5,'Colima'),(6,'Campeche'),(7,'Coahuila'),(8,'Chiapas'),(9,'Distrito Federal'),(10,'Durango'),(11,'Guerrero'),(12,'Guanajuato'),(13,'Hidalgo'),(14,'Jalisco'),(15,'Michoacán'),(16,'Morelos'),(17,'Estado de México'),(18,'Nayarit'),(19,'Nuevo León'),(20,'Oaxaca'),(21,'Puebla'),(22,'Quintana Roo'),(23,'Querétaro'),(24,'Sinaloa'),(25,'San Luis Potosí'),(26,'Sonora'),(27,'Tabasco'),(28,'Tlaxcala'),(29,'Tamaulipas'),(30,'Veracruz'),(31,'Yucatán'),(32,'Zacatecas');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `codubicacion` int(3) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codubicacion`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Ubicaciones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` VALUES (1,'bodega Central','0'),(2,'bodega tumbes','0'),(3,'bodega yucatan','0'),(4,'bodega Bellavista','0'),(5,'no aplica','0');
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uf`
--

DROP TABLE IF EXISTS `uf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uf` (
  `Fecha` varchar(20) default NULL,
  `Valor` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uf`
--

LOCK TABLES `uf` WRITE;
/*!40000 ALTER TABLE `uf` DISABLE KEYS */;
/*!40000 ALTER TABLE `uf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedores` (
  `codvendedor` int(5) NOT NULL auto_increment,
  `nombre` varchar(45) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL default '0',
  `localidad` varchar(35) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `borrado` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`codvendedor`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-09-29 11:15:33

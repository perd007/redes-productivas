-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.49-3


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema redes
--

CREATE DATABASE IF NOT EXISTS redes;
USE redes;

--
-- Definition of table `redes`.`cooperatva`
--

DROP TABLE IF EXISTS `redes`.`cooperatva`;
CREATE TABLE  `redes`.`cooperatva` (
  `nombre` varchar(50) NOT NULL,
  `rif` varchar(15) NOT NULL,
  `red` int(11) NOT NULL,
  `muncipip` varchar(30) NOT NULL,
  `norte` varchar(20) NOT NULL,
  `sur` varchar(20) NOT NULL,
  PRIMARY KEY (`rif`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `red` (`red`),
  CONSTRAINT `cooperatva_ibfk_1` FOREIGN KEY (`red`) REFERENCES `redes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`cooperatva`
--

/*!40000 ALTER TABLE `cooperatva` DISABLE KEYS */;
LOCK TABLES `cooperatva` WRITE;
INSERT INTO `redes`.`cooperatva` VALUES  ('Cooperativa Nuku 28 R.L.','J-31252373-5',11,'Atures','0000','0000'),
 ('Cooperativa Warurewa V R.L.','J-31546819-0',11,'Autana','0000','0000'),
 ('Cooperativa Galilea R.L.','J-31644286-1',11,'Atures','0000','0000'),
 ('Cooperativa La Resistencia AM2 R.L.','J-31666032-0',11,'Atures','0000','0000'),
 ('Cooperativa Merecha (Pez) R.L.','J-31669740-1',11,'Atures','0000','0000'),
 ('Buosa Inaka','J-31683311-9',11,'Atures','0000','0000'),
 ('Cooperativa Dearuwa R.L.','J-31708549-3',11,'Autana','0000','0000'),
 ('Arumecha 82','J3127532269',8,'Atures','4858','44885'),
 ('Pone','J31578998',13,'Autana','000','000');
UNLOCK TABLES;
/*!40000 ALTER TABLE `cooperatva` ENABLE KEYS */;


--
-- Definition of table `redes`.`cursos`
--

DROP TABLE IF EXISTS `redes`.`cursos`;
CREATE TABLE  `redes`.`cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `estado` varchar(13) NOT NULL,
  `facilitador` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `horas` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`cursos`
--

/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
LOCK TABLES `cursos` WRITE;
INSERT INTO `redes`.`cursos` VALUES  (3,'Consolidacion de la Red','Ejecutado','Maria Kock y Luis Bravo','2011-05-15','Apicultura Básica',48),
 (4,'Asistencia Tecnica Inicial','Ejecutado','Eugenio Franco Garcia','2007-07-05','Herramientas para la Acuicultura',8),
 (5,'Consolidacion de la Red','Ejecutado','Ciepe','2011-05-15','Manejo Integral de la Cachama',8),
 (6,'Asistencia Tecnica Inicial','Ejecutado','Fran Torres','0000-00-00','Manejo del Pijiguao',8),
 (7,'Consolidacion de la Red','Por Ejecutar','Fran Torres','2011-09-02','Cultivo del Pijiguao',8),
 (8,'Consolidacion de la Red','Por Ejecutar','Richard Cedeño','2011-10-15','Productos Derivados del Pijiguao',16),
 (9,'Asistencia Tecnica Inicial','Ejecutado','Eugenio Franco Garcia (AQUUACRIA)','2007-08-16','Acuicultura Básica',24),
 (11,'Consolidacion de la Red','Ejecutado','r4','2010-10-20',',,kk',8),
 (12,'Consolidacion de la Red','Ejecutado','Richard Cedeño - Teodosia Ebres','2010-06-11','manipulacion e higiene de alimentos',6),
 (13,'Consolidacion de la Red','Ejecutado','Richard Cedeño - Teodosia Ebres','2010-06-11','Manipulacion e Higiene de Alimentos',6);
UNLOCK TABLES;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


--
-- Definition of table `redes`.`hijos`
--

DROP TABLE IF EXISTS `redes`.`hijos`;
CREATE TABLE  `redes`.`hijos` (
  `productor` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `edad` int(2) NOT NULL,
  `estudio` varchar(20) NOT NULL,
  `viveJ` varchar(2) NOT NULL,
  `trabaja` varchar(2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `red` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productor` (`productor`),
  KEY `red` (`red`),
  CONSTRAINT `hijos_ibfk_1` FOREIGN KEY (`productor`) REFERENCES `productores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hijos_ibfk_2` FOREIGN KEY (`red`) REFERENCES `redes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`hijos`
--

/*!40000 ALTER TABLE `hijos` DISABLE KEYS */;
LOCK TABLES `hijos` WRITE;
INSERT INTO `redes`.`hijos` VALUES  (8947045,'luis miguel','perdomo',17792270,9,'primaria','SI','NO',1,1),
 (8948172,'rafael','luisa',NULL,10,'primaria','SI','NO',3,1),
 (8948172,'rafael','luisa',NULL,10,'primaria','SI','NO',4,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `hijos` ENABLE KEYS */;


--
-- Definition of table `redes`.`miembrosc`
--

DROP TABLE IF EXISTS `redes`.`miembrosc`;
CREATE TABLE  `redes`.`miembrosc` (
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `cedula` int(11) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `parroquia` varchar(50) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `cooperativa` varchar(15) NOT NULL,
  `red` int(11) NOT NULL,
  PRIMARY KEY (`cedula`),
  KEY `cooperativa` (`cooperativa`),
  KEY `red` (`red`),
  CONSTRAINT `miembrosc_ibfk_1` FOREIGN KEY (`cooperativa`) REFERENCES `cooperatva` (`rif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `miembrosc_ibfk_2` FOREIGN KEY (`red`) REFERENCES `redes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`miembrosc`
--

/*!40000 ALTER TABLE `miembrosc` DISABLE KEYS */;
LOCK TABLES `miembrosc` WRITE;
INSERT INTO `redes`.`miembrosc` VALUES  ('Luis','Casuri','Masculino',4781086,'Instancia Educacion','Comunidad Indigena Paria Grande, Via Samariapo','Platanillal',0,'0000','J-31252373-5',11),
 ('Pablo','Cardozo','Masculino',4782068,'Presidente','Comunidad Indigena Caño Veneno','Sipapo',0,'0000','J-31708549-3',11),
 ('Antonio','Gonzalez','Masculino',6538094,'Presidente','Comunidad Indigena Pendare','Sipapo',0,'0000','J-31546819-0',11),
 ('Luis Manuel','Moreno Lopez','Masculino',8945747,'Presidente','Comunidad Indigena Sardi, Via Gavilan','Platanillal',0,'0000','J-31683311-9',11),
 ('Alicia','Bolivar','Femenino',8949475,'Tesorera','Comunidad Indigena Sardi, Via Gavilan','Platanillal',0,'0000','J-31683311-9',11),
 ('Julia','Gonzalez de Arana','Femenino',10605446,'Secretaria','Comunidad Indigena Pendare','Sipapo',0,'0000','J-31546819-0',11),
 ('Gregorio','Perez','Masculino',12451148,'Secretario','Comunidad Indigena Paria Grande, Via Samariapo','Platanillal',0,'0000','J-31252373-5',11),
 ('Faustino','Perez','Masculino',12628987,'Presidente','Comunidad Indígena Paria Grande, Vía Samariapo','Platanillal',0,'0000','J-31252373-5',11),
 ('Juan','Gonzalez Gonzalez','Masculino',13964226,'Contralor','Comunidad Indigena Pendare','Sipapo',0,'0000','J-31546819-0',11),
 ('Alirio','Bolivar Martinez','Masculino',13964647,'Tesorero','Comunidad Indigena Caño Veneno','Sipapo',0,'0000','J-31708549-3',11),
 ('Omar','Luna Cardozo','Masculino',15304069,'Instancia Educacion','Comunidad Indigena Caño Veneno','Sipapo',0,'0000','J-31708549-3',11),
 ('Nelson','Arana Arana','Masculino',15304769,'Contralor','Comunidad Indigena Caño Veneno','Sipapo',0,'0000','J-31708549-3',11),
 ('Alonso','Gonzalez Gonzalez','Masculino',15304785,'Tesorero','Comunidad Indigena Pendare','Sipapo',0,'0000','J-31546819-0',11),
 ('Maria Eugenia','Bolivar Colina','Femenino',15954703,'Coordinador Educacion','Comunidad Indigena Gavilan','Platanillal',0,'0000','J-31644286-1',11),
 ('Luis','Bolivar Colina','Masculino',15955780,'Secretario','Comunidad Indigena Gavilan','Platanillal',0,'0000','J-31644286-1',11),
 ('Finny','Opa','Masculino',16767869,'Instancia de Control y Evaluac','Comunidad Indigena Paria Grande, Via Samariapo','Platanillal',0,'0000','J-31252373-5',11),
 ('Yonny','Gonzalez Ribero','Masculino',17105078,'Tesorero','Comunidad Indigena Gavilan','Platanillal',0,'0000','J-31644286-1',11),
 ('Nilde','Cardozo Luna','Femenino',18050232,'Secretaria','Comunidad Indigena Caño Veneno','Sipapo',0,'0000','J-31708549-3',11),
 ('David','Camico','Masculino',18050418,'Secretario','Comunidad Indigena Sardi, Via Gavilan','Platanillal',0,'0000','J-31683311-9',11),
 ('Oscar Jose','Silva Perez','Masculino',18242681,'Presidente','Comunidad Indigena Gavilan','Platanillal',0,'0000','J-31644286-1',11),
 ('Humberto','Bolivar Colina','Masculino',18506577,'Contralor','Comunidad Indigena Gavilan','Platanillal',0,'0000','J-31644286-1',11),
 ('Otilio','Lopez','Masculino',19054810,'Contralor','Comunidad Indigena Sardi, Via Gavilan','Platanillal',0,'0000','J-31683311-9',11),
 ('Saray','Moreno Bolivar','Femenino',19580595,'Coordinador Educacion','Comunidad Indigena Sardi, Via Gavilan','Platanillal',0,'0000','J-31683311-9',11),
 ('Ismenia','Casuri','Femenino',21549823,'Tesorera','Comunidad Indigena Paria Grande, Via Samariapo','Platanillal',0,'0000','J-31252373-5',11);
UNLOCK TABLES;
/*!40000 ALTER TABLE `miembrosc` ENABLE KEYS */;


--
-- Definition of table `redes`.`produccion`
--

DROP TABLE IF EXISTS `redes`.`produccion`;
CREATE TABLE  `redes`.`produccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elaborada` int(11) DEFAULT NULL,
  `disponible` int(11) DEFAULT NULL,
  `procesada` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `producto` int(11) NOT NULL,
  `productor` int(11) DEFAULT NULL,
  `rif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`producto`),
  KEY `productor` (`productor`),
  KEY `rif` (`rif`),
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`productor`) REFERENCES `productores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_ibfk_3` FOREIGN KEY (`rif`) REFERENCES `cooperatva` (`rif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`produccion`
--

/*!40000 ALTER TABLE `produccion` DISABLE KEYS */;
LOCK TABLES `produccion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `produccion` ENABLE KEYS */;


--
-- Definition of table `redes`.`productores`
--

DROP TABLE IF EXISTS `redes`.`productores`;
CREATE TABLE  `redes`.`productores` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `id_red` int(11) NOT NULL,
  `empresa` varchar(40) DEFAULT NULL,
  `estudio` varchar(40) DEFAULT NULL,
  `etnia` varchar(40) DEFAULT NULL,
  `ingreso` varchar(11) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `miembros` varchar(11) DEFAULT NULL,
  `terreno` varchar(50) DEFAULT NULL,
  `vivienda` varchar(20) DEFAULT NULL,
  `esposa` varchar(20) DEFAULT NULL,
  `edad` varchar(3) DEFAULT NULL,
  `edadEsp` varchar(3) DEFAULT NULL,
  `estuEsp` varchar(20) DEFAULT NULL,
  `municipio` varchar(20) DEFAULT NULL,
  `parroquia` varchar(30) DEFAULT NULL,
  `norte` varchar(5) DEFAULT NULL,
  `sur` varchar(5) DEFAULT NULL,
  `has` varchar(30) DEFAULT NULL,
  `sexo` varchar(9) NOT NULL,
  PRIMARY KEY (`cedula`),
  KEY `id_red` (`id_red`),
  CONSTRAINT `productores_ibfk_1` FOREIGN KEY (`id_red`) REFERENCES `redes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `redes`.`productores`
--

/*!40000 ALTER TABLE `productores` DISABLE KEYS */;
LOCK TABLES `productores` WRITE;
INSERT INTO `redes`.`productores` VALUES  (0,'Carmen  ','Yavinape','Av. Perimetral, Puerto Ayacucho','','',7,'','','','','','','','','','','','','Atures','Luis Alberto Gomez','','','','Femenino'),
 (1,'Carmen ','Moreno de Rosales','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (2,'Melania',' Linares','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (3,'Juana ','Zuruta de Menare','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (4,'Manuel ','Moreno Perez','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (5,'Maria  L. ','Lopez de G.','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (6,'Nico ','Colina Perez','Comunidad Merey, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (7,'Mirian ','Cayupare','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (8,'Jesus ','Yusuino','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (10,'Ramón ','Yosuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (792,'Augusto','Hernández','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1560027,'Bernabé ','Rodríguez','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1561893,'Eleazar','Zuruta','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1563172,'Américo ','Medina','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1563866,'Miguel ','Perales ','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1564374,'Rubén ','Calderón','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1564678,'Anulfo','Rojas','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1565447,'Gregoria','Nieves','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (1566194,'Rafael','Garcia','Comunidad Galipero viejo, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1566333,'Pablo Antonio ','Amazonas','Comunidad Colmena, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (1566378,'Maria Feliciana','Catimay','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (1566613,'Juan R.','Blanca.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (1566806,'Andrés','Pérez','Comunidad Pozo, Terecay, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (1566814,'Miguel ','Rodríguez','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (1566909,'Silva.','Juan.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (1567297,'Trina','Fuentes','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (1567522,'Enrique','Chipiaje','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (1567876,'Melbis','Coro','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1568075,'Eugenia','Fuentes','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (1568609,'Octavio',' Fernández','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1568864,'Celanda ','Ortiz','Sector Agua Linda Sur, Municipio Atures','2147483647','',8,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (1569347,'Nelson','Garrido','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (1569828,'Maneco ','Arana ','Comunidad Atubi Autana, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (2227093,'Pedro ','Diamon','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (3361226,'Hector','Medina','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (3365366,'Freddy','Mendoza Gomez','Comunidad Campo alegre, Municipio Atures','2147483647','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (3583595,'Luis ','Bravo','Urb. El Caicet, Puerto Ayacucho','2147483647','',1,'','','','','','','','','','','','','Atures','Luis Alberto Gomez','','','','Masculino'),
 (4441889,'Alberto ','León','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4622095,'Jesus','Rodríguez','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4779176,'Pedro','Sunasa ','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779177,'Martin','Ravilo','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779214,'Celestino ','Perez','Comunidad Yutaje, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4779220,'Alberto','Ortiz','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779271,'Ramon','Rojas','Comunidad Laguna Verde Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779280,'Clemente ','Ancua','Comunidad Macurijaca,  Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779284,'Ricardo ','Irerba','Comunidad Caño Ceje Mcipio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779289,'Celestino ','Gonzales','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4779333,'Tito ','Mereza','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4779366,'José Antonio ','Idiyu','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779401,'José ','Flores','Comunidad Reyo inahua','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779756,'Lucia ','Sucre','0','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (4779776,'Otilio','Gonzales','Comunidad Caño Maraca Mcipio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4779828,'Antonio ','Baldomero','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4779841,'José Manuel ',' Cardoza','Comunidad Barranco Tonina','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4780177,'Carlos','Orozco','Sector Union, Via Gavilan, Municipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4780422,'Luis ','Márquez ','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4780739,'Orlando ','Dasilva','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4781086,'Luis','Casuri','Comunidad indigena Gavilan',NULL,NULL,11,NULL,NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'64',NULL,NULL,'Atures','Platanillal','0',NULL,NULL,'Masculino'),
 (4781346,'Antonio francisco ','López','Comunidad Caño Maraca Mcipio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (4781882,'Luis','Yavinape','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (4782014,'Domingo ','Bolívar','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4782068,'Pablo','Cardozo','Comunidad Pendare, Mcipio Autana','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4782069,'Pablo ','Cardozo','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4782081,'José ','Ruiz','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (4782162,'Manuel','Menéndez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4782178,'Néstor',' Cardozo ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Atures','','','','','Masculino'),
 (4798790,'Julián ','Charaima','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4907331,'Juan ','Soto','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (4984833,'Benigna','Pérez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (5301049,'José Luis','García','Comunidad Caño Santo Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6537813,'Juan','Martínez','Comunidad Barranco Tonina','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (6537882,'Maneco ','Arana ','Comunidad Pendare Mcipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (6537983,'María Luisa ','Colina','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (6537993,'María Antonia ','Luna','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (6538001,'Juan Pablo R',' Rodríguez ','Comunidad Laguna Ballena, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (6538007,'Antonio ','Bossio ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (6538073,'María ','González','Comunidad Pendare, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (6538094,'Antonio','Gonzales','Apicultura y Meleponicultura','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (6538095,'Narciso Antonio','Jimenéz','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (6538164,'Antonio ','García','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (6721999,'Tito albino',' Rodríguez','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722001,'Pedro Manuel',' Pérez','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722002,'Daniel Pérez','Ureñau','Comunidad Pueblo viejo, Mcpio Manapiare ','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722030,'Agustín ','Milegro','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722035,'María Elena ','Rodríguez','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Femenino'),
 (6722040,'Aurelio ','Irazabal','Comunidad Laja Pela, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (6722078,'Pedro ','Quintero','Comunidad Caño Raya Municipio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722087,'Aniceto','Perez','Comunidad Cucurito Mcpio Manapiare','2147483647','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722169,'Pedro F.','Pantoja C.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (6722198,'Felipe ','zanches','Comunidad Caño Maraca Mcipio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722218,'Ramón ','Rodríguez','Comunidad Guayabalito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722229,'Francisco ','Rivas','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722238,'Enrique','Ortiz','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722268,'José Domingo ','Gonzales','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722277,'Luis ','Pérez','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722306,'Habrán ','Pérez','Comunidad Caraquita, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722321,'Octavio ','Pérez ','Comunidad Caño Ceiba Mcipio Manapaire','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722326,'Vicente ','González','Comunidad Tamanaco, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722425,'Rafael','Gaitan','Comunidad Guanay Mcpio Manapiare','528500','',2,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (6722426,'Gloria','Pérez','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Femenino'),
 (6722603,'Hugo Antonio ','López  ','Comunidad Puerto Limón, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (6903327,'Luis.','Luis.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (7651106,'Ramon','Molina','Sector cataniapo via gavilan, Municipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (7657349,'Rogelio ','Mirabal','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (7657519,'Luis m. ','Martínez ','Comunidad Pueblo viejo, Mcpio Manapiare ','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (7657671,'Juan ','Camejo','Comunidad Caño Piedra Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (7657686,'Nestor','Gonzalez','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (7678832,'María ','Rondón','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (7678836,'Jesus','Camico','Sector alto Carinagua, municipio atures','','',6,'','','','','','','','','','','','','Atures','','','','','Masculino'),
 (7678865,'Rogelio',' Blanco ','Comunidad Lagarto, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8218563,'José','Espino','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8414409,'Juan','Castillo ','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8538094,'Antonio ','González','Comunidad Pendare, Mcipio Autana',NULL,NULL,11,'Cooperativa Warurewa R.L.',NULL,'Piaroa',NULL,NULL,NULL,NULL,'Rancho',NULL,NULL,NULL,NULL,'Autana','Sipapo',NULL,NULL,'','Masculino'),
 (8554678,'Carmen ','López','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (8561188,'Marcial ','Rincones','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8617617,'Evelio','Corrales ','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8775412,'Irka  ','Aragua ','Barrio Cataniapo, Puerto Ayacucho','','',7,'','','','','','','','','','','','','Atures','Fernando Giron Tovar','','','','Femenino'),
 (8900244,'Diogenes','Curvelo','Urb. La Tigrera, Puerto Ayacucho','','',1,'','','','','','','','','','','','','Atures','Luis Alberto Gomez','','','','Masculino'),
 (8900278,'Felipea','Jimenéz','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (8900401,'Jairo','Pérez ','Fundo Jurepa II, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8900522,'Jose Luis','Jimenes','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8900942,'Pedro Antonio ','Maricapó','Comunidad Moriche, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (8900976,'Felipe ','Lopez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8900979,'Toribio ','López','Comunidad Nueva jerusalen, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8901127,'Manuel ',' Arevalo','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8901149,'Ana ','Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8901179,'Rogelia','Caballero','Comunidad Betania de Topocho, Municipio Atures','2147483647','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8901197,'America  ','Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8901288,'José Antonio ','García ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8901661,'Miguel ','Infante ','Fundo Jurepa I, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8901680,'Ramon.','Milano.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (8901687,'Rafael ','Jimenez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8901798,'Félix ','Flores','Comunidad San Félix de Paru','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (8901898,'Pedro Antonio ','Esqueda','Comunidad Albarical, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8901900,'Jose ',' Anija','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8901936,'Luciano ','Medina','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Parueña','','','','Masculino'),
 (8902205,'Eliseo','Olivero','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8902251,'Ana Teresa ','Catimay','Carretera nacional despues de la alcabala, Mcpio Atures','','',9,'','','','','','','','','','','','','Autana','Platanillal','','','','Femenino'),
 (8902302,'Ana ','Pérez','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Femenino'),
 (8902382,'Carlos  a.  ','Valero','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8902913,'Valdemar ','Guerrero','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8902958,'Olangel ','Darape','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8903109,'José',' Rodríguez','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8903172,'Carlos  ',' Gonzalez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8903330,'Beltran.','Ponare.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (8903437,'Nestor','Villamizar','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8903528,'María L.','Sánchez M.','Comunidad Pendare Mcipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (8903589,'Hilario ','Guerrero','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8904308,'Andrés ','Trujillo ','Comunidad Laguna de Moriche, Mcpio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8904353,'Ernestina  ','Evaristo','Evaristo','','',6,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8904703,'Nicolino ','Matar','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8904787,'Alfredo.','Guevara','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (8909986,'Antonio ','Reyes','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8910856,'Ángel','Sifontes','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8911402,'Jose Gregorio','Parra ','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8945085,'Wilmer',' Jordán','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8945339,'Maria  ','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8945398,'Ramón ','Barrios','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8945452,'Odilia Yusuino','Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8945747,'luis','López','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8945874,'Carmen','de Alvares','de Alvares','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (8946728,'Jesús Camico ','Silva','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8946980,'Ricardo ','Clemente','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8946986,'Zulay','Perez','Campo Calipso, Municipio Atures','2147483647','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8947045,'Anibal ','Pereira','Comunidad Paria Grande, Mcipio Atures','',NULL,1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8947246,'Juan','Ramirez Lopez','Comunidad Indigena Sardi, Via Gavilan',NULL,NULL,11,'Cooperativa Buosa Inaka',NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'48',NULL,NULL,'Atures','Platanillal',NULL,NULL,NULL,'Masculino'),
 (8947249,'Juan ','Ramírez López','Comunidad Sardi, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8947281,'Raul ','Camacho','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8947785,'Angel','Correa','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8947909,'Mateo ','Pérez Fuentes','Comunidad Barranco Tonina','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8948100,'Jacobo ','García','comunidad Puerto Lucera, Municipio Atures ','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (8948172,'Pedro Luis ','Moreno','Comunidad Paria Grande, Mcipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8948615,'Jose  ','Pesquera  g.','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8948616,'Aurora   ','Pesquera','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (8949094,'Henry ',' Arana ','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8949185,'Henry ','Román Machado ','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (8949283,'Juana Yurin ','Moreno','Comunidad Sardi, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (8949303,'Donardo ','Martinez Dacosta','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (8949416,'Alirio','Perales ','Urb. Francisco zambrano, segunda calle, casa 52','2147483647','',6,'','','','','','','','','','','','','Atures','Luis Alberto Gomez','','','','Masculino'),
 (8949475,'Alicia ','Bolívar','Comunidad Indigena Sardi, Via Gavilan',NULL,NULL,11,'Cooperativa Buosa Inaka R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Sardi, Via Gavilan',NULL,'Comunidad Indigena Sardi, Via Gavilan','Rancho',NULL,'36',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Femenino'),
 (8949547,'Lilia  ','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (9493099,'Jorge ','Rodríguez','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (9873911,'Oscar ','Oropeza','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10015274,'Linda.','Bautista.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (10024001,'Jesus.','Rodriguez.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (10024007,'Silverio ','Omaña Pérez','Comunidad Laguna Sardinita','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10024011,'Roman','Blanca ','Comunidad Sabanita de Ratón, Mcipio Aut.',NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Autana',NULL,NULL,NULL,'','Masculino'),
 (10024014,'Porfirio','Rodriguez R.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (10024054,'Amado ','Cachero Peña ','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10024076,'luis','Ortega','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024128,'Ramón ','Méndez','Comunidad Laguna Moriche, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10024267,'Ángel Luís ','Pérez ','Comunidad Tavi, tavi, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (10024318,'Julio ','Pérez ','Comunidad Tucumasal, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024342,'Juan ','Camejo Pérez','Comunidad Guayabalito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10024352,'Roberto ','Rojas','Comunidad Caño Santo Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024363,'José Luis ','Rodríguez','Comunidad Guayabalito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024405,'Curumi ','Pérez','Comunidad Paraiso, Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024415,'Joaquin ','Ortiz','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024424,'Demetrio ','Martínez','Comunidad Laja Pela, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (10024470,'Timoteo ','Anamajke','Comunidad Tamanaco, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024479,'Antonio ','Amazonas','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024508,'Federico ','Garcés','San Juan de Manapiare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10024529,'Moises ','Garrido','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10605085,'Sara ',' Arana','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Atures','','','','','Femenino'),
 (10605148,'Cesar.','Silva.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (10605173,'Simon p','Rodriguez R.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (10605298,'Luis','Cariban','Puerto Samariapo, Municipio Autana','2147483647','',1,'','','','','','','','','','','','','Autana','Platanillal','','','','Masculino'),
 (10605405,'Luis ','Cachero','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605440,'Pedro Rafael ','Luna','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605446,'Julia ','González de Arana','Comunidad Pendare, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (10605472,'Carlos ','Sánchez P. ','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605485,'Antonio ',' M. Méndez ','Comunidad Laguna Moriche, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605526,'Andrés ','Álvarez','Comunidad Laguna Moriche, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605540,'Antonio','Gonzalez','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605553,'Samuel ',' Mendoza','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10605557,'Brizaida ','Bossio S.','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (10605562,'Delvalle','Pérez','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (10605583,'José ','Vicente Rojas','Comunidad Caño Raya Municipio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10606052,'Elvira ','Garrido','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Femenino'),
 (10606141,'Lucinda ','Yavinape','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (10606806,'Pedro','Hernández','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10920024,'Jesús ','Hernández','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10920040,'José Gabriel',' Márquez','Comunidad Cerro Pendare, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10920313,'Cesar Jaime',' Uribe','Sector Agua Linda Sur, Municipio Atures','2147483647','',8,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10920353,'Alfonzo','Perez','Comunidad Paria Grande, Mcipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10920617,'Julio ','lopez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10920620,'Martin ','Perez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10920720,'Eva Perez ',' Gonzalez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (10920818,'Luis Manuel ','Lopez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10920826,'Agustin ','Rodríguez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10920863,'Antonio ','Gonzalez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10921204,'José francisco ','Pérez','Comunidad Valle Guanay, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10921243,'Arles ','Diaz','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (10921308,'Richard','Correa','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10922401,'Rafael f. ','Caballero','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (10922533,'Vicente ','Moreno','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10922691,'Gregorio ','Cariban','Comunidad Santa Marta, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10922837,'Anicia ','Garrido','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (10922843,'Cesar ',' Lopez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10922844,'Vicente ','Perez','Comunidad Betania de Topocho, Mcpio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10922914,'Carlos','Carmona','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (10923711,'Luis ','Camejo','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (10923975,'Cesar Simon','Panama','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10924233,'Nellys   m. ','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (10924234,'Mirian  ','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (10924473,'Narcisa','Muños','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (10924511,'Hernán ','García','Comunidad el progreso de galipero, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (10924615,'Victoria ','Medina','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (10963023,'Juan ','Mireles','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (11757693,'Luisa','Montilla ','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12127185,'Liber   ','Castañeda','Comunidad Sarón, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12173059,'Santiago',' Lopez Perez ','Comunidad Betania de Topocho, MunicipioAtures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12173090,'Alexander','Flores F.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (12173158,'Juan ','Perez','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12173193,'Nohemí ','Camico Murillo','Comunidad Raudalito, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (12173526,'Irma   ','Camico','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (12173527,'Senovia   ','Camico','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (12323194,'Ledys ','Barrios','Comunidad Galipero viejo, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12451010,'Alfonzo ','Escalante','Comunidad Paria Grande, Mcipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12451049,'Juan ','González','Comunidad Valle Wanai, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (12451130,'Bernabe','Flores','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12451148,'Gregorio','Perez','Carretera Via Samariapo, Comunidad Indigena Paria Grande',NULL,NULL,11,NULL,NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'41',NULL,NULL,'Atures','Platanillal','0000',NULL,NULL,'Masculino'),
 (12451320,'Antonio',' Acosta','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12451435,'Octavio ','Méndez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12451472,'Felipe ','Lopez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12451626,'Lucas ','Camacho','Comunidad Betania de Topocho, Mcpio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12451628,'Joaquin ','López','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12451737,'Lilia ','Pérez','Comunidad Gavilan, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12468864,'Jose ','Fetema','Comunidad Macurijaca,  Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12469103,'Birmania M. ',' Morales','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (12469116,'Antonio ',' Rodríguez ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (12469130,'Rafael','Cachero ','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12469131,'Rafael ','Sánchez Cachero','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (12469196,'Vicente ','Trujillo ','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12469418,'Alicia ','Garcia','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12469648,'Pablo','Idiyo','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (12469723,'Andrés albino ','Rodríguez','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12469726,'Nemencio ','Perez','Comunidad Colmena, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12469731,'Camilo ','Flores','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12469812,'Orlando','Guzmán','Comunidad Caño de Tigre Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12469851,'Antonio ','Rodríguez Pérez','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (12626571,'Gilberto','Arana','Barrio Quebrada Seca, Pto Ayacucho','2147483647','',8,'','','','','','','','','','','','','Atures','Fernando Giron Tovar','','','','Masculino'),
 (12628411,'Rosa  ','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (12628414,'Laura','Jimenez','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Femenino'),
 (12628571,'Ivon','Rincones','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12628742,'Félix Armando ','Panamá','Comunidad Albarical, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12628963,'Idalia ','Díaz','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12628987,'Pérez ','Faustino ','Comunidad Paria Grande, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12629084,'Jose ',' Guevara Gonzalez','Comunidad Betania de Topocho, Mcpio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12629226,'Juana ','M. de Martinez','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12629504,'Juan Rafael','Nieves','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (12629542,'Ana Isabel','Landaeta','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12629792,'Julio  Cesar  ','Navas','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (12922499,'Flora','Guerrero','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (12933868,'Abelardo','Pereira','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13058134,'Nerio ','Moreno','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13058351,'Carmen','Rosales ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (13304233,'Emilio','Rosanto','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13325598,'Francisco','Yavinape','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atures','ucada','','','','Masculino'),
 (13325650,'Humberto ','Pérez ','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (13425839,'Gregorio ','Pérez','Comunidad Valle Guanay, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425840,'Wilfredo ','Gonzales','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425857,'Gilberto ','Guariato','Comunidad Pozo, Terecay, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425873,'Ángel','Gonzales','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425882,'Gerenio ','Gonzales','Comunidad Valle Guanay, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425884,'Antonio',' González','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13425926,'Ricardo ','Rodríguez','Comunidad Caño Ceiba Mcipio Manapaire','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (13617281,'Ricardo ','Siae','Comunidad Momidö Uliam, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (13714180,'Francisco ','Mirabal','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','Platanillal','','','','Masculino'),
 (13714339,'William ','Gomez ','Comunidad Tavi, tavi, Municipio Manapiare','','',1,'','','','','','','','','','','','','Manapiare','Platanillal','','','','Masculino'),
 (13714575,'Martin ','Mendez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13714969,'Gerson ','Acosta','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13964135,'Wilmer ','Cardozo M. ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (13964226,'Juan ','González González','Comunidad Pendare, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (13964268,'Jose','Punta','Comunidad Picatonal, Municipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (13964383,'Juan ',' Bautista Lopez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (13964647,'Alirio ','Bolívar Martínez','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (13964673,'Gilberto ','Baldomero','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (13964803,'Lourdes ','Camico','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (13964969,'Manina  ','Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (14040286,'Yussi ','Gámez','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (14258292,'Abrahan ','Arevalo Perez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (14258436,'Jesus ','Pesquera','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (14258525,'Moisés ',' Torres Payema','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (14258599,'Margarita',' Perez G.','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (14258741,'Timoteo ',' Perez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (14564140,'Hernan','Silva C.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (14564144,'Raul.','Chipiaje.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (14564241,'Luis ','Mejias','Comunidad Paria Grande, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (14564610,'Genarino ',' Patiño M.','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (14564746,'Favio ','Cardozo M. ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (14564959,'Antonia',' Evaristo','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (14565644,'Finny ','Bossio R','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (14565713,'Nelson','Gómez Perdomo ','Comunidad Pendare Mcipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (14622216,'Alex','Rodriguez','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (14622217,'Maritza','Rodriguez','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (15086285,'Ana ','Yavinape','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (15086385,'Silvia  ','Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (15086411,'Alonso ','Bolívar','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (15086695,'Mario ','Rodríguez','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (15086999,'Omar','Estrada','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (15304060,'Elias','Punta','Comunidad Picatonal, Municipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (15304069,'Omar ','Luna Cardozo','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304180,'Moisés','Álvarez','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (15304208,'Darío ',' Patiño Machado','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304243,'Rafael Catire','Rondón ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304258,'Julio ','Carmona','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304289,'Nelly del C.','Rodriguez .','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Femenino'),
 (15304769,'Nelson ','Arana Arana','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304774,'Misael ','Blanco','Comunidad Lagarto, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304779,'Romania ','Cardozo luna','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (15304785,'Alonso ','González','Comunidad Pendare, Mcipio Autana','','',11,'','','','','','','','','','','','','Atures','','','','','Masculino'),
 (15304786,'Javier ','Blanco Blanco','0','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15304794,'David ','Morales ','Comunidad Pendare, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15499343,'Manuel ','Ortiz','Comunidad Cerro Colmena, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (15499869,'Zoraida ',' Bossio Pérez ','Comunidad Coromoto Cuao, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (15499874,'Hilberto','Bossio','Comunidad Pendare, Municipio Autana','','',7,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (15499875,'Ángela ','Rondón','Comunidad Guarinuma, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (15564139,'Pedro .','Silva C.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (15799161,'Rosa ','Rodriguez','Sector Agua Linda Sur, Municipio Atures','2147483647','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (15954452,'Reinaldo','Machado Caballero','Comunidad Betania de Topocho, Mcpio Atures','','',11,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (15954536,'Flor A.','Ledezma B.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Femenino'),
 (15954703,'María Eugenia ','Bolívar C.','Comunidad Indigena Gavilan',NULL,NULL,11,'Cooperativa Galilea R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Gavilan',NULL,'Comunidad Indigena Gavilan',NULL,NULL,'33',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Femenino'),
 (15954740,'Adrian','Cherepaju','Comunidad Colmena, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (15954786,'Javier','Perez','Comunidad Paria Grande, Municipio Atures','','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (15954790,'Nancy',' Perez Perez','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (15955361,'Flor M.','Rincon.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Femenino'),
 (15955446,'Sofia  ','Perez','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (15955588,'Julio ','Flores','Comunidad Macurijaca,  Mcpio Manapiare','528500','',2,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (15955780,'Luis ','Bolívar Colina','Comunidad Indigena Gavilan',NULL,NULL,11,NULL,NULL,NULL,NULL,'Comunidad Indigena Gavilan',NULL,'Comunidad Indigena Gavilan','Rancho',NULL,'27',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Masculino'),
 (16145380,'Rosa ','Elena Ruiz','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (16657731,'Melbis ','prieto','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (16766274,'Ernesto','Cariban','Puerto Samariapo, Municipio Autana','2147483647','',1,'','','','','','','','','','','','','Autana','Platanillal','','','','Masculino'),
 (16766356,'Rosalio','López   ','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (16767202,'Daniel ','Koch Hecker','Comunidad Provincial, Municipio AturesP','2147483647','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (16767360,'Pablo','Ochoa','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (16767615,'Yoel ','Moreno López','Comunidad Sardi, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (16767869,'Finny','Opa','Comunidad Indigena Gavilan',NULL,NULL,11,NULL,NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,'Atures','Platanillal','0000',NULL,NULL,'Masculino'),
 (16767890,'Julia ','Navas  Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (17023432,'Jacobo','Marcano ','Comunidad Maparacú','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (17105078,'Yonny ','González Rivero','Comunidad Indigena Gavilan',NULL,NULL,11,'Cooperativa Galilea R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Gavilan',NULL,'Comunidad Indigena Gavilan',NULL,NULL,'22',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Masculino'),
 (17105315,'Miguel ','Tovar','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (17105328,'Guillermo','Curumi','Eje carretero Norte Municipio Atures','','',2,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (17105518,'Cenaida ','Lopez Rosales','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (17105683,'Alida   ','Tovar Perez','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (17106233,'Alirio','Flores','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (17675017,'Tito','Camacho Acosta','Comunidad Betania de Topocho, Municipio Atures','2147483647','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (17675606,'Moises ','Silva Gomez ','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (17675870,'Imelda ','Martinez','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (17676829,'Jose I.','Rodriguez M.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (17975841,'Julio ','Martínez','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (18050232,'Nilde ','Cardozo luna','Comunidad Caño Veneno, Mcipio Autana','','',11,'','','','','','','','','','','','','Autana','','','','','Femenino'),
 (18050418,'David ','Camico ','Comunidad Indigena Sardi, Via Gavilan',NULL,NULL,11,'Cooperativa Buosa Inaka R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Sardi, Via Gavilan',NULL,'Comunidad Indigena Sardi, Via Gavilan','Rancho',NULL,'28',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Masculino'),
 (18051274,'Luisa ','Garrido','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (18051374,'Pedro ','Regetti','Comunidad Tamanaco, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051380,'Roberto','Pérez ','Comunidad Caño Santo Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051420,'Martin','Yuro','Comunidad Cucurito Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051427,'Luis ','Nanay ','Comunidad Tucumasal, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino');
INSERT INTO `redes`.`productores` VALUES  (18051442,'Humberto ','Gonzales','Comunidad Guara Mcpio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051484,'Pancho ','Rodríguez','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051645,'Alfonso','Gonzalez','Comunidad Marieta, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051679,'Humberto','López Martínez','Comunidad Caño Ceje Mcipio Manapiare','','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (18051950,'Yamile   ','Camico','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (18195133,'Enrique','Yavinape','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (18195134,'Milton ','Yusuina','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (18195135,'Carmen ','Yusuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Femenino'),
 (18195137,'Jaime ','Yosuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (18195274,'Carlos ','Yusuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (18195314,'Karelis ','Mirabal','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (18195315,'Elías',' Mirabal López','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (18195319,'Pola ','Pesquera','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (18195322,'Jairo ','Yusuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (18195324,'Alipio ','Dacosta','Comunidad Panorama, Mcipio Atabapo','2147483647','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (18195589,'Marcos ','Garrido','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (18195894,'Ana ','Garrido','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (18242680,'Justo H. ','Silva Perez','Comunidad Samaria, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (18242681,'Oscar José ','Silva Pérez','Comunidad Indigena Gavilan',NULL,NULL,11,'Cooperativa Galilea R.L.',NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'30',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Masculino'),
 (18506129,'Leycy ','Romero','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (18506577,'Humberto ','Bolívar Colina','Comunidad Gavilan, Mcipio Atures','','',11,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (18506661,'Elsa.','Milano R.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Femenino'),
 (18835157,'Rogelio ',' Perdomo Pérez','Comunidad Laguna Moriche, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (18967660,'Mireya ','Yusuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (19005307,'Efraín ','González','Comunidad Guanay Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (19044982,'Chamanare','Canawe','Comunidad Yoprope, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (19054161,'Yamile   ','Valero','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (19054536,'Ramón ',' Arana Infante','Comunidad Atubi Autana, Municipio Autana','','',8,'','','','','','','','','','','','','Autana','','','','','Masculino'),
 (19054810,'Otilio ','López Moreno','Comunidad Indigena Sardi, Via Gavilan',NULL,NULL,11,'Cooperativa Buosa Inaka R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Sardi, Via Gavilan',NULL,'Comunidad Indigena Sardi, Via Gavilan','Rancho',NULL,'25',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Masculino'),
 (19132914,'Nancy ','Salazar','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (19580595,'Saray ','Moreno Bolívar','Comunidad Indigena Sardi, Via Gavilan',NULL,NULL,11,'Cooperativa Buosa Inaka R.L.',NULL,'Piaroa',NULL,'Comunidad Indigena Sardi, Via Gavilan',NULL,'Comunidad Indigena Sardi, Via Gavilan','Rancho',NULL,'22',NULL,NULL,'Atures','Platanillal',NULL,NULL,'','Femenino'),
 (20437434,'Oscar Alejandro',' Pérez','Comunidad Yutaje, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (20437970,'Yenni   ','Camico','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (20720044,'Ana  ','Navas  Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (20720045,'Irma  ','Navas  Yusuino','Comunidad Limón de Parhueña, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (21108887,'Gilberto','lopez','Comunidad Betania de Topocho, Mcpio Atures','','',8,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (21549207,'Eva','Torcuato','Comunidad Pavoni, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Paruheña','','','','Femenino'),
 (21549823,'Ismenia','Casuri Casuri','Comunidad Indigena Gavilan',NULL,NULL,11,NULL,NULL,'Piaroa',NULL,NULL,NULL,NULL,NULL,NULL,'37',NULL,NULL,'Atures','Platanillal','0000',NULL,NULL,'Femenino'),
 (21789033,'Samuel Lorenzo','Gomez','Comunidad la Unión Mcipio Atures',NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Atures','Fernando Giron Tovar','00','00','','Masculino'),
 (21789083,'Wilfredo.','Silva C.','Comunidad Sabanita de Ratón, Mcipio Aut.','','',13,'','','','','','','','','','','','','Autana','Samariapo','','','','Masculino'),
 (22568348,'Jose Gregorio','Ortega','Comunidad Provincial Mcipio Atures','','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (22568641,'Edison','Moreno','Comunidad Caño de Tigre Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (22930119,'Hernán','Ocotoma','Comunidad Opohesi, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (22930256,'Samuel ','Shanawa','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (22930257,'Rafael','Cotecome','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (22986542,'Silverio ','Ventura','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (23548744,'Mirian ','Yusuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (23646746,'Maritza ','Mirabal','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (23646748,'Salomón ','Perez','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (23647448,'Guillermo ','Dacosta','Comunidad Panorama, Mcipio Atabapo','2147483647','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (23647450,'Efraín ','Martinez','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (23647460,'Graciela','Polanco','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (23985791,'Albertina ','Polanco','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Femenino'),
 (23986282,'Nelsy ','Pérez Garrido','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (23986311,'Egidio ','Ramírez','Comunidad Puerto Lucera, Municipio Atures ','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (23986328,'Eduardo ','González','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (23987169,'Luis ','A. Garrido','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (24127414,'Martin ','chirino','Comunidad Macurijaca,  Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Masculino'),
 (24127714,'Eleyda ','Pérez regeti','Comunidad Tamanaco, Mcpio Manapiare','528500','',5,'','','','','','','','','','','','','Manapiare','','','','','Femenino'),
 (24678108,'Roselino ','Garcia','Comunidad Puerto Lucera, Municipio Atures ','','',9,'','','','','','','','','','','','','Atures','Paruheña','','','','Masculino'),
 (25054628,'Isalas','Anuwe Yarami','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054629,'Neyi Yoenowe','Rana Catimi','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054644,'Carlos Karipisi','Vina Poni','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054649,'Pedro','Yorechiana Moy','Comunidad Yoprope, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054650,'Andrés ','Santos','Comunidad Yoprope, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054651,'Zulay','Pérez Mamo','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Femenino'),
 (25054663,'Maricela Virginio','Binina','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054664,'Alegandro','Ondo Yguami','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054666,'Yosaira','Gomez Rapami','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Femenino'),
 (25054667,'Hesakowe','Gonzalez Yatehama','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25054668,'Andreina','Mavio Noely','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Femenino'),
 (25054677,'Mauricio','Pérez yahima','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (25275232,'Maria ','Yosuino','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Femenino'),
 (25585521,'Gustavo ','Yavinape','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucada','','','','Masculino'),
 (25734070,'Wilians ','Urdaneta Sánchez','Comunidad Arata, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26013156,'Manuel Yuahimou','Ayopepe','Comunidad Opohesi, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26438335,'Yolanda  ','Martinez','Comunidad Sarón, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (26438623,'Betulio','Waimanawe','Comunidad Ukushi, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26438624,'Daniel Hoyawe','Shiripinawe','Comunidad Totoropowei, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26438626,'Paulino ','Perez Katekorawe','Comunidad Opohesi, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26438750,'Remigio Ayokowe','Shitikariama','Cominidad Maweti, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (26542694,'Camico ','Dorante','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Masculino'),
 (26542696,'Carmen ','Velásquez','Comunidad Panorama, Mcipio Atabapo','','',12,'','','','','','','','','','','','','Atabapo','ucata','','','','Femenino'),
 (26754210,'Esteban José','Lucho','Comunidad Shatiopo, Mcipio Alto Orinoco','','',10,'','','','','','','','','','','','','Alto_Orinoco','','','','','Masculino'),
 (27489639,'Marta ','Diaz','Comunidad Piedra de Cucurital, Municipio Atures','','',7,'','','','','','','','','','','','','Atures','Platanillal','','','','Femenino'),
 (63921558,'Cirilo ','Hernández','Sector Agua Linda Sur, Municipio Atures','','',9,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (81288066,'Maria','Hecker de Koch','Comunidad Provincial, Municipio Atures','2147483647','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (81403536,'Hans','Koch','Comunidad Provincial, Municipio Atures','2147483647','',1,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (84340446,'Aurelio','Balta','Comunidad Provincial Mcipio Atures','2147483647','',6,'','','','','','','','','','','','','Atures','Platanillal','','','','Masculino'),
 (84394177,'jose','Almeida','Sector alto Carinagua, municipio atures','','',6,'','','','','','','','','','','','','Atures','','','','','Masculino');
UNLOCK TABLES;
/*!40000 ALTER TABLE `productores` ENABLE KEYS */;


--
-- Definition of table `redes`.`productos`
--

DROP TABLE IF EXISTS `redes`.`productos`;
CREATE TABLE  `redes`.`productos` (
  `distribucion` varchar(30) NOT NULL,
  `red` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `medida` varchar(10) NOT NULL,
  `tiempo` varchar(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_productor` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costo` int(11) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `instalada` varchar(100) DEFAULT NULL,
  `procesamiento` varchar(100) DEFAULT NULL,
  `produccion` varchar(100) DEFAULT NULL,
  `rif` varchar(15) DEFAULT NULL,
  `tiempo2` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_red` (`id_productor`),
  KEY `id_productor` (`id_productor`),
  KEY `rif` (`rif`),
  KEY `red` (`red`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_productor`) REFERENCES `productores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`rif`) REFERENCES `cooperatva` (`rif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`red`) REFERENCES `redes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`productos`
--

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
LOCK TABLES `productos` WRITE;
INSERT INTO `redes`.`productos` VALUES  ('mercal',1,'pollos','Kg','Meses',4000,8948172,2,4000,NULL,NULL,NULL,NULL,NULL,0),
 ('mercatradona',1,'yuca','Kg','Año',400,8947045,4,3,'112 hectáreas','112 hectáreas','112 hectáreas','112 hectáreas',NULL,0),
 ('mercatadrona',2,'miel de abeja','Litros','Meses',4000,8947045,5,50,'1 hectarea','40000','123455','324555',NULL,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;


--
-- Definition of table `redes`.`redes`
--

DROP TABLE IF EXISTS `redes`.`redes`;
CREATE TABLE  `redes`.`redes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `objetivo` varchar(200) NOT NULL,
  `monto` float NOT NULL,
  `nombre_rep` varchar(30) NOT NULL,
  `apellido_rep` varchar(30) NOT NULL,
  `cedula_rep` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `rif` varchar(10) NOT NULL,
  `actividad` varchar(30) NOT NULL,
  `rubro` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula_rep` (`cedula_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `redes`.`redes`
--

/*!40000 ALTER TABLE `redes` DISABLE KEYS */;
LOCK TABLES `redes` WRITE;
INSERT INTO `redes`.`redes` VALUES  (1,2004,'Fortalecer y mejorar los procesos de producción apícola.',173.903,'Luis','Bravo',3583595,2147483647,'Urbanización el Caicet, Puerto Ayacucho ','luisbravo@cantv.net','Apicultura y Meliponicultura','j313234028','Cria de Abejas','Apicultura'),
 (2,2005,'Desarrollar la Cría de Aves, para la Producción de Carne para el consumo local y nacional',69.2,'Antonio','Gonzalez',6538094,248809619,'Comunidad Pendare Mcipio Autana ','No Posee','Avicultura','j308885398','Cria de Aves','Avícola'),
 (5,2005,'Fortalecer los procesos agro productivos para la obtención y comercialización de sus derivados',197.287,'Alonso ','Gonzales',18051645,1234,'Comunidad Marieta, Mcpio Manapiare','No Posee','Cacao Manapaire','j299233242','Produce Cacao','Cacao'),
 (6,2007,'Desarrollo sustentable del rubro caña panelera en el municipio Atures del Estado Amazonas',265.402,'Alirio','Perales',8949416,2147483647,'Urb. Francisco zambrano, segunda calle, casa 52','No Posee','Caña Panelera y Azúcar morena','j296029679','Cosecha de Caña','Caña de Azúcar'),
 (7,2006,'Desarrollar una salsa picante autóctona de calidad para la comercialización a nivel local y nacional',463.198,'Senovia','Camico',12173527,1234,'Comunidad Pavoni','No posee','Catara de Amazonas','j299686891','Produce Catara','Catara de Amazonas'),
 (8,2005,'Desarrollo del cultivo de frutas autóctonas y sus derivados mediante el fortalecimiento de las capacidades productivas de los productores',90.737,'Gilberto','Arana',12173289,2147483647,'Barrio Quebrada Seca, Pto Ayacucho','No Posee','Frutales de Amazonas','j308793418','Cultivo de Frutas Autóctonas','Frutas'),
 (9,2007,'Impulsar el cultivo del Merey precoz enano para la obtención de sus derivados.',180.018,'Eliseo','Olivero',8902205,2147483647,'Calle Principal del sector Agua Linda Sur.','No Posee','Merey','j295561300','Cultivo del Merey','Frutas'),
 (10,2006,'Capacitar a  productores Yanomami  de\r\ndiez comunidades del Alto Orinoco en la selección de cultivares y establecimiento de bancos de germoplasma productivos de musáceas.',240.465,'Mauricio','Pérez Yahima ',25054677,1234,'Comunidad Maweti, Mcipio Alto Orinoco','poreawealtoocamo@hotmail.com','Musáceas Yanomami','j298230991','Cultivo de Musáceas','Frutales'),
 (11,2006,'Generar una estrategia en el manejo sostenible del Pijiguao para la obtención y comercialización de sus productos ',276.869,'Luis Manuel','Moreno Lopez',8945747,1234,'Comunidad Sardi, Mcipio Atures','luismanuelmorelopez@yahoo.es','Pijiguao','j293532256','Cultivo de Pijiguao','Frutas'),
 (12,2006,'Implantar un sistema de producción tecnificado para la cría de Peces con una capacidad de producción que permita cubrir parte importante de las necesidades proteicas de alimentos de origen animal.',237.812,'Humberto','Pérez',13325650,1234,'Comunidad Panorama, Mcipio Atabapo','No Posee','Piscicultura Atabapo','j299233641','Cría de Peces','Piscicultura'),
 (13,2006,'Implantar un sistema de cultivo de peces en jaulas con el propósito de generar una actividad económica.',273.774,'Laura','Pineda Jimenez',12628414,2147483647,'Comunidad Sabanita de Ratón, Mcipio Autana','No Posee','Piscicultura Autana','j294329462','Cría de Peces','Pisicultura');
UNLOCK TABLES;
/*!40000 ALTER TABLE `redes` ENABLE KEYS */;


--
-- Definition of table `redes`.`regicur`
--

DROP TABLE IF EXISTS `redes`.`regicur`;
CREATE TABLE  `redes`.`regicur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productor` int(11) DEFAULT NULL,
  `curso` int(11) NOT NULL,
  `cooperativa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productor` (`productor`,`curso`),
  KEY `cooperativa` (`cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`.`regicur`
--

/*!40000 ALTER TABLE `regicur` DISABLE KEYS */;
LOCK TABLES `regicur` WRITE;
INSERT INTO `redes`.`regicur` VALUES  (1,17792270,1,NULL),
 (5,NULL,1,'a-12345678'),
 (6,10024011,4,NULL),
 (8,12628414,4,NULL),
 (9,12628414,9,NULL),
 (10,6722169,9,NULL),
 (11,14564144,9,NULL),
 (12,17676829,9,NULL),
 (13,9,6,NULL),
 (14,9,6,NULL),
 (15,84340446,10,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `regicur` ENABLE KEYS */;


--
-- Definition of table `redes`.`seguridad`
--

DROP TABLE IF EXISTS `redes`.`seguridad`;
CREATE TABLE  `redes`.`seguridad` (
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `modificar` int(11) DEFAULT NULL,
  `consultar` int(11) DEFAULT NULL,
  `registrar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `administrar` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`,`clave`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `redes`.`seguridad`
--

/*!40000 ALTER TABLE `seguridad` DISABLE KEYS */;
LOCK TABLES `seguridad` WRITE;
INSERT INTO `redes`.`seguridad` VALUES  ('admin','1234',1,1,1,1,1,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `seguridad` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

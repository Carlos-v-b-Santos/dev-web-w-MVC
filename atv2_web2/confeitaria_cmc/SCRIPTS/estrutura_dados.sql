-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: confeitaria_cmc
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Table structure for table `bolo`
--

DROP TABLE IF EXISTS `bolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bolo` (
  `id_opcao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `preco` float NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_opcao`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bolo`
--

LOCK TABLES `bolo` WRITE;
/*!40000 ALTER TABLE `bolo` DISABLE KEYS */;
INSERT INTO `bolo` VALUES (1,'Pequeno (P)',90,'tamanho'),(2,'Médio (M)',120,'tamanho'),(3,'Médio Grande (M+)',150,'tamanho'),(4,'Grande (G)',180,'tamanho'),(5,'Muito Grande (GG)',210,'tamanho'),(6,'Chantilly',3,'cobertura'),(7,'Marshmallow',3,'cobertura'),(8,'Naked',3,'cobertura'),(9,'Brigadeiro',3,'cobertura'),(10,'Pasta',3,'cobertura'),(11,'KitKat',3,'cobertura'),(12,'Chantilly',3,'recheio'),(13,'Creme branco',3,'recheio'),(14,'Creme de chocolate',3,'recheio'),(15,'Mousse de limão',3,'recheio'),(16,'Doce de leite',3,'recheio'),(17,'Nozes',3,'recheio'),(18,'Ameixa',3,'recheio'),(19,'Morango',3,'recheio'),(20,'Abacaxi',3,'recheio'),(21,'Coco',3,'recheio'),(22,'Chocolate',3,'massa'),(23,'Branco',3,'massa'),(24,'Cenoura',3,'massa');
/*!40000 ALTER TABLE `bolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encomenda`
--

DROP TABLE IF EXISTS `encomenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encomenda` (
  `id_encomenda` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `valorTotal` double DEFAULT NULL,
  PRIMARY KEY (`id_encomenda`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encomenda`
--

LOCK TABLES `encomenda` WRITE;
/*!40000 ALTER TABLE `encomenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `encomenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encomenda_bolo`
--

DROP TABLE IF EXISTS `encomenda_bolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encomenda_bolo` (
  `fk_id_encomenda` int(11) NOT NULL,
  `fk_id_opcao` int(11) NOT NULL,
  PRIMARY KEY (`fk_id_encomenda`,`fk_id_opcao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encomenda_bolo`
--

LOCK TABLES `encomenda_bolo` WRITE;
/*!40000 ALTER TABLE `encomenda_bolo` DISABLE KEYS */;
/*!40000 ALTER TABLE `encomenda_bolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin','4e7afebcfbae000b22c7c85e5560f89a2a0280b4','Admin','ADMIN');
                                        /*senha: Admin*/
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-20 19:01:39

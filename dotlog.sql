CREATE DATABASE  IF NOT EXISTS `dotlog` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dotlog`;
-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: dotlog
-- ------------------------------------------------------
-- Server version	10.4.10-MariaDB

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
-- Table structure for table `categoria_subcategoria`
--

DROP TABLE IF EXISTS `categoria_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_subcategoria` (
  `CategoriaID` int(11) NOT NULL,
  `SubCategoriaID` int(11) NOT NULL,
  PRIMARY KEY (`CategoriaID`,`SubCategoriaID`),
  KEY `SubCategoriaID` (`SubCategoriaID`),
  CONSTRAINT `categoria_subcategoria_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categorias` (`CategoriaID`),
  CONSTRAINT `categoria_subcategoria_ibfk_2` FOREIGN KEY (`SubCategoriaID`) REFERENCES `subcategorias` (`SubCategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_subcategoria`
--

LOCK TABLES `categoria_subcategoria` WRITE;
/*!40000 ALTER TABLE `categoria_subcategoria` DISABLE KEYS */;
INSERT INTO `categoria_subcategoria` VALUES (1,1),(1,2),(1,3),(2,1),(2,2),(2,3),(3,1),(3,2),(3,3);
/*!40000 ALTER TABLE `categoria_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `CategoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`CategoriaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Hardware'),(2,'Software'),(3,'Consumíveis');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `UtilizadorID` int(11) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `NomeEmpresa` varchar(150) NOT NULL,
  `Morada` varchar(150) NOT NULL,
  `Morada_Fat` varchar(150) NOT NULL,
  `NIF` char(9) NOT NULL,
  PRIMARY KEY (`UtilizadorID`),
  UNIQUE KEY `NIF` (`NIF`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`UtilizadorID`) REFERENCES `utilizador` (`UtilizadorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'921889121','PaivaInc','Evora','a','245090221'),(2,'922887999','VinagreIce','Leiria','Leiria','225590351'),(3,'924859551','PaivaInc','Evora','Evora','244098221'),(9,'922227919','WilliamBusiness','Leiria','Leiria','225790351'),(10,'924819551','Dourado','Evora','Evora','244098291');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionario` (
  `UtilizadorID` int(11) NOT NULL,
  `Data_Admissao` date NOT NULL,
  `Funcao` varchar(150) NOT NULL,
  PRIMARY KEY (`UtilizadorID`),
  CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`UtilizadorID`) REFERENCES `utilizador` (`UtilizadorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (4,'2019-01-01','Gerir produtos e ajudar clientes no Forum'),(5,'2019-01-01','Ajudar clientes no Forum'),(6,'2019-01-01','Ajudar clientes no Forum'),(7,'2019-01-01','Ajudar clientes no Forum'),(8,'2019-01-01','Ajudar clientes no Forum');
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `lista_de_mensagens`
--

DROP TABLE IF EXISTS `lista_de_mensagens`;
/*!50001 DROP VIEW IF EXISTS `lista_de_mensagens`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lista_de_mensagens` (
  `Nome` tinyint NOT NULL,
  `Apelido` tinyint NOT NULL,
  `Email` tinyint NOT NULL,
  `Assunto` tinyint NOT NULL,
  `Mensagem` tinyint NOT NULL,
  `DataHora` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `lista_de_produtos`
--

DROP TABLE IF EXISTS `lista_de_produtos`;
/*!50001 DROP VIEW IF EXISTS `lista_de_produtos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lista_de_produtos` (
  `ProdutoID` tinyint NOT NULL,
  `Nome` tinyint NOT NULL,
  `Descricao` tinyint NOT NULL,
  `Preco` tinyint NOT NULL,
  `Categoria` tinyint NOT NULL,
  `SubCategoria` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `lista_de_servicos`
--

DROP TABLE IF EXISTS `lista_de_servicos`;
/*!50001 DROP VIEW IF EXISTS `lista_de_servicos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lista_de_servicos` (
  `Nome` tinyint NOT NULL,
  `Apelido` tinyint NOT NULL,
  `Email` tinyint NOT NULL,
  `Nome da Empresa` tinyint NOT NULL,
  `Morada` tinyint NOT NULL,
  `telefone` tinyint NOT NULL,
  `Data de Inicio` tinyint NOT NULL,
  `Descricao` tinyint NOT NULL,
  `Data de Pedido` tinyint NOT NULL,
  `Data de Fim` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensagem` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `Mensagem` varchar(255) NOT NULL,
  `DataHora` datetime NOT NULL,
  `Assunto` varchar(100) NOT NULL,
  `id_mensagem_pai` int(11) DEFAULT NULL,
  `UtilizadorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PostID`),
  KEY `UtilizadorID` (`UtilizadorID`),
  CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`UtilizadorID`) REFERENCES `utilizador` (`UtilizadorID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagem`
--

LOCK TABLES `mensagem` WRITE;
/*!40000 ALTER TABLE `mensagem` DISABLE KEYS */;
INSERT INTO `mensagem` VALUES (1,'Olá a todos, tenho um problema com o monitor do meu computador da empresa, o monitor ja não da imagem, esta ligado mas mostra um ecrã preto.','2020-04-18 15:13:32','Problemas Com o Monitor',1,2),(2,'Olá senhor Alexandre, por favor verifique se os cabos do monitor estejam ligados, se for um computador fixo é muito provavel que seja esse o problema','2020-04-19 09:24:11','Resposta',1,4),(3,'Muito obrigado, verifiquei e era de facto mesmo esse o problema!','2020-04-19 15:02:55','Resposta',2,2),(9,'Boa tarde eu tinha uns problemas com a minha impressora, a impressora simplesmente deixou de imprimir','2020-04-22 16:22:55','Problema na impressora',9,3),(10,'Olá senhor Rodrigo, eu acredito que o problema deve ser relacionado com os tinteiros, por favor verifique se ainda tem tinta','2020-04-22 18:42:15','Resposta',9,4),(11,'Olá eu tenho um problema, conseguem me ajudar?','2020-04-18 19:13:32','Ajuda',11,2),(12,'Olá eu tenho um problema, conseguem me ajudar?','2020-04-18 19:13:32','Ajuda',12,2),(13,'Olá eu tenho um problema, conseguem me ajudar?','2020-04-18 19:13:32','Ajuda',13,2),(14,'Olá eu tenho um problema, conseguem me ajudar?','2020-04-18 19:13:32','Ajuda',14,2),(15,'Olá eu tenho um problema, conseguem me ajudar?','2020-04-18 19:13:32','Ajuda',15,2);
/*!40000 ALTER TABLE `mensagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `ProdutoID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `Imagem` blob DEFAULT NULL,
  `Descricao` varchar(150) DEFAULT NULL,
  `Preco` decimal(6,2) NOT NULL,
  `CategoriaID` int(11) NOT NULL,
  `SubCategoriaID` int(11) NOT NULL,
  PRIMARY KEY (`ProdutoID`),
  KEY `CategoriaID` (`CategoriaID`),
  KEY `SubCategoriaID` (`SubCategoriaID`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categorias` (`CategoriaID`),
  CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`SubCategoriaID`) REFERENCES `subcategorias` (`SubCategoriaID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Impressora Multifunções - Epson Workforce WF-2750DWF',NULL,'Impressora com varias funções, com design simples e compacto',89.99,1,1),(2,'Impressora Multifunções - Canon MG3650',NULL,'Impressora mais acessivel, com varias funcionalidades',49.99,1,1),(3,'Rolo de Papel (Pequeno)',NULL,'Rolo de papel de tamanho pequeno',4.99,3,1),(4,'Rolo de Papel (Médio)',NULL,'Rolo de papel de tamanho médio',8.99,3,1),(5,'Rolo de Papel (Grande)',NULL,'Rolo de papel de tamanho grande',19.99,3,1),(6,'POS - CAP Software Point of Sale',NULL,'Um Point of Sale da empresa POSGuys',500.00,2,1),(7,'POS - POSsible POS For Restaurant',NULL,'Um Point of Sale feito especificamente para restaurantes',475.00,2,1),(8,'Terminal Móvel - Zebra MT2070',NULL,'Um terminal móvel de 320x240 píxeis (cinzento)',919.99,1,1),(9,'Câmara de Segurança - Reolink 5MP RLK8-420D4',NULL,'Câmara de segurança com uma resolução de 2560x1920 píxeis',499.99,1,2),(10,'Leitor de Controlo Acesso - TimeMoto TM-626',NULL,'Leitor de controlo acesso de sensor RFID e impressão digital',549.99,1,3);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico_cliente`
--

DROP TABLE IF EXISTS `servico_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico_cliente` (
  `ServicoClienteID` int(11) NOT NULL AUTO_INCREMENT,
  `DataDeInicio` datetime DEFAULT NULL,
  `DataDeFim` datetime DEFAULT NULL,
  `DataDePedido` datetime NOT NULL,
  `Descricao` varchar(255) DEFAULT NULL,
  `ServicoID` int(11) NOT NULL,
  `UtilizadorID` int(11) NOT NULL,
  `ProdutoID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ServicoClienteID`),
  KEY `ServicoID` (`ServicoID`),
  KEY `UtilizadorID` (`UtilizadorID`),
  KEY `servico_cliente_ibfk_3` (`ProdutoID`),
  CONSTRAINT `servico_cliente_ibfk_1` FOREIGN KEY (`ServicoID`) REFERENCES `tipo_de_servicos` (`ServicoID`),
  CONSTRAINT `servico_cliente_ibfk_2` FOREIGN KEY (`UtilizadorID`) REFERENCES `utilizador` (`UtilizadorID`),
  CONSTRAINT `servico_cliente_ibfk_3` FOREIGN KEY (`ProdutoID`) REFERENCES `produto` (`ProdutoID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico_cliente`
--

LOCK TABLES `servico_cliente` WRITE;
/*!40000 ALTER TABLE `servico_cliente` DISABLE KEYS */;
INSERT INTO `servico_cliente` VALUES (1,'2020-04-27 14:56:21',NULL,'2020-04-25 15:12:05','Reparação Local de um computador',6,1,NULL),(2,'2020-04-27 14:56:21',NULL,'2020-04-25 15:12:58','Reparação Local de uma impressora',6,1,NULL),(3,'2020-04-02 11:00:00','2020-04-02 11:12:10','2020-03-27 18:42:12','Instalação Remota de software de POS',8,2,NULL),(4,'2020-04-05 13:00:00','2020-04-05 13:59:56','2020-04-01 10:10:17','Reparação Local de uma impressora',6,2,NULL),(5,'2020-04-15 10:00:00','2020-04-22 15:59:51','2020-04-04 11:14:00','Reparação Local de uma impressora',6,3,NULL),(6,'2020-04-15 10:00:00','2020-04-22 15:59:51','2020-04-04 11:14:00','Troca de Equipamento POS',10,3,NULL),(7,'2020-04-15 10:00:00','2020-04-22 15:59:51','2020-04-04 11:14:00','Instalação do hardware POS',9,3,NULL),(8,'2020-04-15 10:00:00','2020-04-22 15:59:51','2020-04-04 11:14:00','Instalação do software POS',9,3,NULL),(9,'2020-04-08 12:00:00','2020-04-10 13:59:56','2020-04-04 10:14:00','Instalação do hardware POS',9,3,NULL),(10,'2020-04-08 12:00:00','2020-04-10 13:59:56','2020-04-04 10:14:00','Instalação do software POS',9,3,NULL);
/*!40000 ALTER TABLE `servico_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `SubCategoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`SubCategoriaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,'Comercial'),(2,'Video Vigilância'),(3,'Controlo Acesso');
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_de_servicos`
--

DROP TABLE IF EXISTS `tipo_de_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_de_servicos` (
  `ServicoID` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(50) NOT NULL,
  `ID_tipo_pai` int(11) DEFAULT NULL,
  `Detalhes` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`ServicoID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_de_servicos`
--

LOCK TABLES `tipo_de_servicos` WRITE;
/*!40000 ALTER TABLE `tipo_de_servicos` DISABLE KEYS */;
INSERT INTO `tipo_de_servicos` VALUES (1,'Assistência Telefónica',NULL,'telefone'),(2,'Assistência Remota',NULL,'twitter.'),(3,'Assistência Local',NULL,'where did we park our truck?'),(4,'Reparação',1,'r'),(5,'Reparação',2,NULL),(6,'Reparação',3,NULL),(7,'Instalação',1,'i'),(8,'Instalação',2,NULL),(9,'Instalação',3,NULL),(10,'Troca de Equipamento',3,'trocation');
/*!40000 ALTER TABLE `tipo_de_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilizador` (
  `UtilizadorID` int(11) NOT NULL AUTO_INCREMENT,
  `PrimeiroNome` varchar(50) NOT NULL,
  `Apelido` varchar(50) NOT NULL,
  `Perfil` enum('Administrador','Funcionario','Cliente') DEFAULT 'Cliente',
  `Email` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Imagem` blob DEFAULT NULL,
  PRIMARY KEY (`UtilizadorID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilizador`
--

LOCK TABLES `utilizador` WRITE;
/*!40000 ALTER TABLE `utilizador` DISABLE KEYS */;
INSERT INTO `utilizador` VALUES (1,'Ana','Paiva','Cliente','ana_paiva5@gmail.com','aa70dd64afacd9cd9f12a2f365a1d650a3134db5a537a00a0a9f9eeef9e27e9e',NULL),(2,'Alexandre','Vinagre','Cliente','alexvinn@gmail.com','6d3a0686ee375bc381623181a5f8a5a5fd435c2eb9a85322dfb31a17c67ee479',NULL),(3,'Rodrigo','Janes','Cliente','RodJanes@gmail.com','134563d4e440f0e418b0f382f23a2cf301af6d7f648ccfae9895018345d779a3',NULL),(4,'Andre','Paiva','Administrador','sskyy_swd@gmail.com','000e30b439905a40c23c43d91f9ff47a40e26429cc38f6f996dc3561f905f61a',NULL),(5,'Jerónimo','Abasto','Funcionario','abasto@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL),(6,'Antonio','Morais','Funcionario','morais@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL),(7,'Silva','Morgado','Funcionario','morgado@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL),(8,'Rui','Ouro','Funcionario','ouro@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL),(9,'William','Glass','Cliente','williamglass@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL),(10,'Ken','Dourado','Cliente','kendourado@gmail.com','d9bb6357940ecd3b24300b42c797f1dc730cd342b80a84f16cc55c46b31e953c',NULL);
/*!40000 ALTER TABLE `utilizador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `utilizadores_empresa`
--

DROP TABLE IF EXISTS `utilizadores_empresa`;
/*!50001 DROP VIEW IF EXISTS `utilizadores_empresa`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `utilizadores_empresa` (
  `Nome` tinyint NOT NULL,
  `Apelido` tinyint NOT NULL,
  `Nome da Empresa` tinyint NOT NULL,
  `Email` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `utilizadores_funcionarios`
--

DROP TABLE IF EXISTS `utilizadores_funcionarios`;
/*!50001 DROP VIEW IF EXISTS `utilizadores_funcionarios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `utilizadores_funcionarios` (
  `Nome` tinyint NOT NULL,
  `Apelido` tinyint NOT NULL,
  `Perfil` tinyint NOT NULL,
  `Data_Admissao` tinyint NOT NULL,
  `Email` tinyint NOT NULL,
  `Funcao` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `lista_de_mensagens`
--

/*!50001 DROP TABLE IF EXISTS `lista_de_mensagens`*/;
/*!50001 DROP VIEW IF EXISTS `lista_de_mensagens`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lista_de_mensagens` AS select `utilizador`.`PrimeiroNome` AS `Nome`,`utilizador`.`Apelido` AS `Apelido`,`utilizador`.`Email` AS `Email`,`mensagem`.`Assunto` AS `Assunto`,`mensagem`.`Mensagem` AS `Mensagem`,`mensagem`.`DataHora` AS `DataHora` from (`utilizador` join `mensagem` on(`mensagem`.`UtilizadorID` = `utilizador`.`UtilizadorID`)) order by `mensagem`.`DataHora` desc limit 50 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `lista_de_produtos`
--

/*!50001 DROP TABLE IF EXISTS `lista_de_produtos`*/;
/*!50001 DROP VIEW IF EXISTS `lista_de_produtos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lista_de_produtos` AS select `produto`.`ProdutoID` AS `ProdutoID`,`produto`.`Nome` AS `Nome`,`produto`.`Descricao` AS `Descricao`,`produto`.`Preco` AS `Preco`,case when `produto`.`CategoriaID` = 1 then 'Hardware' when `produto`.`CategoriaID` = 2 then 'Software' when `produto`.`CategoriaID` = 3 then 'Consumiveis' else 'categoria indefinida' end AS `Categoria`,case when `produto`.`SubCategoriaID` = 1 then 'Comercial' when `produto`.`SubCategoriaID` = 2 then 'Video Vigilância' when `produto`.`SubCategoriaID` = 3 then 'Controlo Acesso' else 'subcategoria indefinida' end AS `SubCategoria` from `produto` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `lista_de_servicos`
--

/*!50001 DROP TABLE IF EXISTS `lista_de_servicos`*/;
/*!50001 DROP VIEW IF EXISTS `lista_de_servicos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lista_de_servicos` AS select `utilizador`.`PrimeiroNome` AS `Nome`,`utilizador`.`Apelido` AS `Apelido`,`utilizador`.`Email` AS `Email`,`empresa`.`NomeEmpresa` AS `Nome da Empresa`,`empresa`.`Morada` AS `Morada`,`empresa`.`Telefone` AS `telefone`,`servico_cliente`.`DataDeInicio` AS `Data de Inicio`,`servico_cliente`.`Descricao` AS `Descricao`,`servico_cliente`.`DataDePedido` AS `Data de Pedido`,ifnull(`servico_cliente`.`DataDeFim`,'Por Terminar') AS `Data de Fim` from (`servico_cliente` join (`utilizador` join `empresa` on(`empresa`.`UtilizadorID` = `utilizador`.`UtilizadorID`)) on(`servico_cliente`.`UtilizadorID` = `utilizador`.`UtilizadorID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `utilizadores_empresa`
--

/*!50001 DROP TABLE IF EXISTS `utilizadores_empresa`*/;
/*!50001 DROP VIEW IF EXISTS `utilizadores_empresa`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `utilizadores_empresa` AS select `utilizador`.`PrimeiroNome` AS `Nome`,`utilizador`.`Apelido` AS `Apelido`,`empresa`.`NomeEmpresa` AS `Nome da Empresa`,`utilizador`.`Email` AS `Email` from (`utilizador` join `empresa` on(`empresa`.`UtilizadorID` = `utilizador`.`UtilizadorID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `utilizadores_funcionarios`
--

/*!50001 DROP TABLE IF EXISTS `utilizadores_funcionarios`*/;
/*!50001 DROP VIEW IF EXISTS `utilizadores_funcionarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `utilizadores_funcionarios` AS select `utilizador`.`PrimeiroNome` AS `Nome`,`utilizador`.`Apelido` AS `Apelido`,`utilizador`.`Perfil` AS `Perfil`,`funcionario`.`Data_Admissao` AS `Data_Admissao`,`utilizador`.`Email` AS `Email`,`funcionario`.`Funcao` AS `Funcao` from (`utilizador` join `funcionario` on(`funcionario`.`UtilizadorID` = `utilizador`.`UtilizadorID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-18  9:00:40

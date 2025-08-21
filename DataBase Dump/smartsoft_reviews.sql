-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: smartsoft
-- ------------------------------------------------------
-- Server version	5.7.44-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Олеся 17 лет',NULL,'Я воспользовалась услугами данной компании и мне все понравилось доставка быстрая, услуги стоят не дорога'),(2,'Андрей Филатов',NULL,'Крутая компания, заказал доставку, оплатил, и ничего не пришло. 5 из 5 ??'),(3,'Никита из Сыктывкара',NULL,'Зашёл, ввёл почту и имя, а так же свой адрес, нажал зарегестрироваться и всё прошло успешно. Очень удобный интерфейс, из минусов только то что мне теперь постоянно пишут мошенникик'),(4,'Бабка 75lvl',NULL,'Сегодня я решила зайти на данный сайт и была в шоке от происходящего! Как такое вообще можно выкладывать в интерене. По300р вам и вашим родителям!'),(5,'Аскар из Уфы',NULL,'На вашем сайте удобный интерфейс, понятная логика, можно быстро и просто зарагестрироваться и оставить заказ. Мне всё понравилось, рекомендую друзьям'),(6,'Виктория Сергеевна',NULL,'Решила рассказать мужу, а он со смеху нашу дочку решил на колбасу пустить. Вот теперь сидим едим?'),(7,'Аноним',NULL,'⭐⭐⭐⭐⭐'),(8,'Димон',NULL,'Всё норм, еще не пользовался ?'),(9,'Елена',NULL,'В Краснодаре и в парке Галицкого впервые я побывала в июне 2025 года. Спасибо вам за такое приключение. Чтобы я делала без вашего сайта');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-12 19:53:48

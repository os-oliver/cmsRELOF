-- MariaDB dump 10.19-11.8.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: CMSrelof
-- ------------------------------------------------------
-- Server version	11.8.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `aboutus`
--

DROP TABLE IF EXISTS `aboutus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aboutus`
--

LOCK TABLES `aboutus` WRITE;
/*!40000 ALTER TABLE `aboutus` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `aboutus` VALUES (1);
/*!40000 ALTER TABLE `aboutus` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `calendarEvents`
--

DROP TABLE IF EXISTS `calendarEvents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendarEvents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendarEvents`
--

LOCK TABLES `calendarEvents` WRITE;
/*!40000 ALTER TABLE `calendarEvents` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `calendarEvents` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `category` VALUES
(1,'bg-yellow-100'),
(2,'bg-blue-100'),
(3,'bg-green-100'),
(4,'bg-red-100'),
(5,'bg-purple-100'),
(6,'bg-indigo-100');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `category_document`
--

DROP TABLE IF EXISTS `category_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_document`
--

LOCK TABLES `category_document` WRITE;
/*!40000 ALTER TABLE `category_document` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `category_document` VALUES
(1,'blue-500'),
(2,'green-500'),
(3,'yellow-500'),
(4,'purple-500'),
(5,'red-500');
/*!40000 ALTER TABLE `category_document` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `naslov` varchar(255) NOT NULL,
  `poruka` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `contacts` VALUES
(3,'Luka','Glisic','lukaglisic.srb@gmail.com','3213233','Problem','Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si ','2025-07-02 15:54:46'),
(6,'Luka','Markovic','lukaglisic.srb@gmail.com','+381773737','Problem','Zdravo, imam problem XXXX','2025-07-03 15:10:52');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filepath` varchar(512) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `fileSize` float NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_document_category` (`category_id`),
  CONSTRAINT `fk_document_category` FOREIGN KEY (`category_id`) REFERENCES `category_document` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `document` VALUES
(18,'0ff65d237d6df42d.pdf','pdf','2025-07-03 16:00:51',0.05,1),
(19,'e1c0bac216d65be4.pdf','pdf','2025-07-03 16:01:34',0.05,2),
(20,'407315860f0774be.docx','docx','2025-07-03 16:05:07',0,3),
(21,'53bef49b731d7f87.xlsx','xlsx','2025-07-03 16:05:47',0.01,4),
(22,'513881c4480ca323.docx','docx','2025-07-03 16:06:39',0,5);
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `employee` VALUES
(5,'direktor'),
(6,'Kustos'),
(7,'Tehnički koordinator'),
(8,'PR menadžer'),
(9,'Scenski radnik'),
(10,'Organizator programa'),
(11,'Producent'),
(12,'Recepcioner'),
(13,'Lektor'),
(14,'Voditelj radionica');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `kategorije_dogadjaja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `events` VALUES
(1,2,'2025-06-03','17:20:00','2025-07-03 16:20:22','/uploads/images/b4c8421f7d592794.jpeg','Kulturni centar'),
(2,1,'2025-06-02','16:24:00','2025-07-03 16:23:54','/uploads/images/6b7e6daa3b3594f9.jpg','Edukativni centar'),
(3,3,'2025-06-04','16:37:00','2025-07-03 16:33:18','/uploads/images/4fa5db671d8043d0.jpg','Pozorište'),
(5,4,'2025-06-05','16:36:00','2025-07-03 16:35:32','/uploads/images/e02147d78d12f050.jpg','Digitalni centar'),
(6,5,'2025-06-06','20:36:00','2025-07-03 16:36:45','/uploads/images/0e061695897e1667.jpg','Gradska sala'),
(7,4,'2025-08-05','13:16:00','2025-08-04 13:12:19','/uploads/images/4b3f433648758912.png','lokacija'),
(8,2,'2025-08-14','13:15:00','2025-08-04 13:13:00','/uploads/images/','fdsfds');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_file_path` varchar(500) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `gallery` VALUES
(6,'/uploads/gallery/a26a9b9104f8e4d0.jpg','2025-07-03 14:40:42'),
(7,'/uploads/gallery/53f8752bdb6f259a.jpg','2025-07-03 14:41:51'),
(8,'/uploads/gallery/bce46052e1e72bc2.jpg','2025-07-03 14:42:29'),
(9,'/uploads/gallery/640993caee7511af.jpg','2025-07-03 14:43:14'),
(10,'/uploads/gallery/c1bda5f2a9ba8662.jpg','2025-07-03 14:44:19');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `kategorije_dogadjaja`
--

DROP TABLE IF EXISTS `kategorije_dogadjaja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorije_dogadjaja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorije_dogadjaja`
--

LOCK TABLES `kategorije_dogadjaja` WRITE;
/*!40000 ALTER TABLE `kategorije_dogadjaja` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `kategorije_dogadjaja` VALUES
(1,'blue-500'),
(2,'purple-500'),
(3,'yellow-500'),
(4,'indigo-500'),
(5,'green-500'),
(6,'gray-500'),
(7,'red-500');
/*!40000 ALTER TABLE `kategorije_dogadjaja` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `published_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `news` VALUES
(1,'Milena Petrović','2025-06-10','2025-06-25 09:55:46',2),
(2,'Marko Jovanović','2025-06-20','2025-06-25 09:55:46',1),
(3,'Ana Nikolić','2025-06-15','2025-06-25 09:55:46',3),
(4,'Ivana Kovač','2025-06-12','2025-06-25 09:55:46',4),
(5,'Nikola Lukić','2025-06-11','2025-06-25 09:55:46',5),
(6,'Jelena Milić','2025-06-18','2025-06-25 09:55:46',6);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `text`
--

DROP TABLE IF EXISTS `text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_table` varchar(50) NOT NULL,
  `source_id` int(11) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `content_lat` text DEFAULT NULL,
  `content_cyr` text DEFAULT NULL,
  `content_eng` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_source` (`source_table`,`source_id`),
  FULLTEXT KEY `ft_content_lat` (`content_lat`),
  FULLTEXT KEY `ft_content_eng` (`content_eng`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text`
--

LOCK TABLES `text` WRITE;
/*!40000 ALTER TABLE `text` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `text` VALUES
(1,'aboutus',1,'mission','Centar za kulturu ima za cilj da bude pokretač umetničkog, kulturnog i obrazovnog života zajednice, stvarajući prostor za kreativno izražavanje, očuvanje tradicije i promociju savremenih kulturnih tokova. Kroz raznovrsne programe i manifestacije, Centar podstiče dijalog, toleranciju i razvoj kulturne svesti svih generacija.',NULL,NULL,'2025-08-04 17:12:24'),
(2,'aboutus',1,'goal','Glavni cilj Centra za kulturu je obogaćivanje kulturnog života zajednice putem organizovanja koncerata, pozorišnih predstava, izložbi, radionica i edukativnih programa, sa posebnim fokusom na uključivanje mladih, očuvanje lokalnog identiteta i unapređenje kulturne ponude na lokalnom i regionalnom nivou.',NULL,NULL,'2025-08-04 17:12:24'),
(3,'category',1,'name','Obaveštenja',NULL,NULL,'2025-08-04 17:12:24'),
(4,'category',2,'name','Konkursi',NULL,NULL,'2025-08-04 17:12:24'),
(5,'category',3,'name','Javni pozivi',NULL,NULL,'2025-08-04 17:12:24'),
(6,'category',4,'name','Odluke',NULL,NULL,'2025-08-04 17:12:24'),
(7,'category',5,'name','Projekti',NULL,NULL,'2025-08-04 17:12:24'),
(8,'category',6,'name','Izveštaji',NULL,NULL,'2025-08-04 17:12:24'),
(9,'category_document',1,'name','Godišnji izveštaji',NULL,NULL,'2025-08-04 17:12:24'),
(10,'category_document',2,'name','Finansijski izveštaji',NULL,NULL,'2025-08-04 17:12:24'),
(11,'category_document',3,'name','Izveštaji o projektima',NULL,NULL,'2025-08-04 17:12:24'),
(12,'category_document',4,'name','Tehnička dokumentacija',NULL,NULL,'2025-08-04 17:12:24'),
(13,'category_document',5,'name','Pravni dokumenti',NULL,NULL,'2025-08-04 17:12:24'),
(14,'document',18,'title','Godišnji izveštaj 2024',NULL,NULL,'2025-08-04 17:12:24'),
(15,'document',18,'description','Detaljan godišnji izveštaj za 2024. godinu.',NULL,NULL,'2025-08-04 17:12:24'),
(16,'document',19,'title','Finansijski izveštaj Q1 2025',NULL,NULL,'2025-08-04 17:12:24'),
(17,'document',19,'description','Pregled finansijskih rezultata za prvi kvartal 2025.',NULL,NULL,'2025-08-04 17:12:24'),
(18,'document',20,'title','Izveštaj o projektu Alfa',NULL,NULL,'2025-08-04 17:12:24'),
(19,'document',20,'description','Izveštaj o napretku i rezultatima projekta Alfa.',NULL,NULL,'2025-08-04 17:12:24'),
(20,'document',21,'title','Tehnička dokumentacija robota',NULL,NULL,'2025-08-04 17:12:24'),
(21,'document',21,'description','Detaljna tehnička specifikacija robota za proizvodnju',NULL,NULL,'2025-08-04 17:12:24'),
(22,'document',22,'title','Ugovor o saradnji',NULL,NULL,'2025-08-04 17:12:24'),
(23,'document',22,'description','Pravni dokument ugovora o poslovnoj saradnji.',NULL,NULL,'2025-08-04 17:12:24'),
(24,'employee',5,'name','Aleksandra',NULL,NULL,'2025-08-04 17:12:24'),
(25,'employee',5,'surname','Ćirić',NULL,NULL,'2025-08-04 17:12:24'),
(26,'employee',5,'biography','Odgovorna za umetnički program i saradnju sa umetnicima.',NULL,NULL,'2025-08-04 17:12:24'),
(27,'employee',6,'name','Čedomir',NULL,NULL,'2025-08-04 17:12:24'),
(28,'employee',6,'surname','Čolić',NULL,NULL,'2025-08-04 17:12:24'),
(29,'employee',6,'biography','Organizuje izložbe i vodi brigu o umetničkim kolekcijama.',NULL,NULL,'2025-08-04 17:12:24'),
(30,'employee',7,'name','Špela',NULL,NULL,'2025-08-04 17:12:24'),
(31,'employee',7,'surname','Šarić',NULL,NULL,'2025-08-04 17:12:24'),
(32,'employee',7,'biography','Zadužena za tehničku realizaciju događaja i izložbi.',NULL,NULL,'2025-08-04 17:12:24'),
(33,'employee',8,'name','Željko',NULL,NULL,'2025-08-04 17:12:24'),
(34,'employee',8,'surname','Živković',NULL,NULL,'2025-08-04 17:12:24'),
(35,'employee',8,'biography','Komunicira sa medijima i promoviše kulturne događaje.',NULL,NULL,'2025-08-04 17:12:24'),
(36,'employee',9,'name','Đorđe',NULL,NULL,'2025-08-04 17:12:24'),
(37,'employee',9,'surname','Đukić',NULL,NULL,'2025-08-04 17:12:24'),
(38,'employee',9,'biography','Pomaže u postavljanju i demontiranju scenografije.',NULL,NULL,'2025-08-04 17:12:24'),
(39,'employee',10,'name','Anđela',NULL,NULL,'2025-08-04 17:12:24'),
(40,'employee',10,'surname','Anđelković',NULL,NULL,'2025-08-04 17:12:24'),
(41,'employee',10,'biography','Planira i koordinira kulturne manifestacije.',NULL,NULL,'2025-08-04 17:12:24'),
(42,'employee',11,'name','Luka',NULL,NULL,'2025-08-04 17:12:24'),
(43,'employee',11,'surname','Lukić',NULL,NULL,'2025-08-04 17:12:24'),
(44,'employee',11,'biography','Brine o produkciji predstava i koncerata.',NULL,NULL,'2025-08-04 17:12:24'),
(45,'employee',12,'name','Jasmina',NULL,NULL,'2025-08-04 17:12:24'),
(46,'employee',12,'surname','Jasnić',NULL,NULL,'2025-08-04 17:12:24'),
(47,'employee',12,'biography','Dočekuje posetioce i pruža informacije o događajima.',NULL,NULL,'2025-08-04 17:12:24'),
(48,'employee',13,'name','Vesna',NULL,NULL,'2025-08-04 17:12:24'),
(49,'employee',13,'surname','Vesnić',NULL,NULL,'2025-08-04 17:12:24'),
(50,'employee',13,'biography','Zadužena za jezičku i stilsku ispravnost promotivnih materijala.',NULL,NULL,'2025-08-04 17:12:24'),
(51,'employee',14,'name','Zoran',NULL,NULL,'2025-08-04 17:12:24'),
(52,'employee',14,'surname','Zorić',NULL,NULL,'2025-08-04 17:12:24'),
(53,'employee',14,'biography','Organizuje i vodi kreativne radionice za decu i odrasle.',NULL,NULL,'2025-08-04 17:12:24'),
(54,'events',1,'title','Izložba srednjovekovne umetnosti',NULL,NULL,'2025-08-04 17:12:24'),
(55,'events',1,'description','Izložba radova srednjovekovnik umetnika u galeriji.',NULL,NULL,'2025-08-04 17:12:24'),
(56,'events',2,'title','Radionica IT-a',NULL,NULL,'2025-08-04 17:12:24'),
(57,'events',2,'description','Intenzivna radionica programiranja za početnike.',NULL,NULL,'2025-08-04 17:12:24'),
(58,'events',3,'title','Dečiji festival pozorišta',NULL,NULL,'2025-08-04 17:12:24'),
(59,'events',3,'description','Festival pozorišnih predstava za decu i mlade.',NULL,NULL,'2025-08-04 17:12:24'),
(60,'events',5,'title','Seminar o veštačkoj inteligenciji',NULL,NULL,'2025-08-04 17:12:24'),
(61,'events',5,'description','Seminar o primeni AI tehnologija u industriji.',NULL,NULL,'2025-08-04 17:12:24'),
(62,'events',6,'title','Okrugli sto: Lokalna zajednica',NULL,NULL,'2025-08-04 17:12:24'),
(63,'events',6,'description','Diskusija o unapređenju uslova u lokalnoj zajednici.',NULL,NULL,'2025-08-04 17:12:24'),
(64,'events',7,'title','nasa',NULL,NULL,'2025-08-04 17:12:24'),
(65,'events',7,'description','ggfdgfdfgd',NULL,NULL,'2025-08-04 17:12:24'),
(66,'events',8,'title','app',NULL,NULL,'2025-08-04 17:12:24'),
(67,'events',8,'description','fdsfs',NULL,NULL,'2025-08-04 17:12:24'),
(68,'gallery',6,'title','Boje Zrenjanina',NULL,NULL,'2025-08-04 17:12:24'),
(69,'gallery',6,'description','Izložba slika „Boje Zrenjanina“',NULL,NULL,'2025-08-04 17:12:24'),
(70,'gallery',7,'title','Noc uz muziku',NULL,NULL,'2025-08-04 17:12:24'),
(71,'gallery',7,'description','Letnji koncert na otvorenom',NULL,NULL,'2025-08-04 17:12:24'),
(72,'gallery',8,'title','Predstava Mala scena',NULL,NULL,'2025-08-04 17:12:24'),
(73,'gallery',8,'description','Pozorišna predstava na Maloj sceni',NULL,NULL,'2025-08-04 17:12:24'),
(74,'gallery',9,'title','Dečija umetnička radionica',NULL,NULL,'2025-08-04 17:12:24'),
(75,'gallery',9,'description','Kreativna radionica za najmlađe',NULL,NULL,'2025-08-04 17:12:24'),
(76,'gallery',10,'title','Digitalne tehnologije danas',NULL,NULL,'2025-08-04 17:12:24'),
(77,'gallery',10,'description','Seminar o digitalnim inovacijama',NULL,NULL,'2025-08-04 17:12:24'),
(78,'kategorije_dogadjaja',1,'naziv','Edukativni događaji',NULL,NULL,'2025-08-04 17:12:24'),
(79,'kategorije_dogadjaja',2,'naziv','Kulturni događaji',NULL,NULL,'2025-08-04 17:12:24'),
(80,'kategorije_dogadjaja',3,'naziv','Događaji za decu i mlade',NULL,NULL,'2025-08-04 17:12:24'),
(81,'kategorije_dogadjaja',4,'naziv','Digitalni i tehnološki',NULL,NULL,'2025-08-04 17:12:24'),
(82,'kategorije_dogadjaja',5,'naziv','Zajednica i društvo',NULL,NULL,'2025-08-04 17:12:24'),
(83,'kategorije_dogadjaja',6,'naziv','Interni događaji',NULL,NULL,'2025-08-04 17:12:24'),
(84,'kategorije_dogadjaja',7,'naziv','Online događaji',NULL,NULL,'2025-08-04 17:12:24'),
(85,'news',1,'title','Novi konkurs za mlade istraživače',NULL,NULL,'2025-08-04 17:12:24'),
(86,'news',1,'content','Objavljen je konkurs za finansiranje inovativnih projekata mladih istraživača. Rok za prijavu je 15. jul.',NULL,NULL,'2025-08-04 17:12:24'),
(87,'news',2,'title','Obaveštenje o radnom vremenu tokom praznika',NULL,NULL,'2025-08-04 17:12:24'),
(88,'news',2,'content','Tokom državnog praznika, kancelarije neće raditi 1. i 2. jula.',NULL,NULL,'2025-08-04 17:12:24'),
(89,'news',3,'title','Poziv za učešće na javnoj raspravi',NULL,NULL,'2025-08-04 17:12:24'),
(90,'news',3,'content','Pozivamo građane da učestvuju u javnoj raspravi o planu razvoja grada.',NULL,NULL,'2025-08-04 17:12:24'),
(91,'news',4,'title','Odluka o budžetu za narednu godinu',NULL,NULL,'2025-08-04 17:12:24'),
(92,'news',4,'content','Usvojena je odluka o budžetu za 2026. godinu, sa fokusom na obrazovanje i infrastrukturu.',NULL,NULL,'2025-08-04 17:12:24'),
(93,'news',5,'title','Završetak projekta \"Pametni grad\"',NULL,NULL,'2025-08-04 17:12:24'),
(94,'news',5,'content','Projekat \"Pametni grad\" uspešno je završen i rezultati su dostupni na sajtu.',NULL,NULL,'2025-08-04 17:12:24'),
(95,'news',6,'title','Godišnji izveštaj o radu institucije',NULL,NULL,'2025-08-04 17:12:24'),
(96,'news',6,'content','Objavljen je godišnji izveštaj koji prikazuje ostvarene ciljeve i izazove tokom protekle godine.',NULL,NULL,'2025-08-04 17:12:24');
/*!40000 ALTER TABLE `text` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'admin','$2y$12$gCJhYbZreyojxAWXyMKr/.OuDuacMFGy9PdNUECoWAAmXVGsKhpDm','admin','Luka','Glisic','2025-06-26'),
(8,'markic','$2y$12$vzaIj7ajz65Sh/Uiqyb2m.Vpz0Pvntl7bucGdFqE6cIg/FqohjqGi','editor','','','2025-06-26'),
(11,'fffff','$2y$12$PBHa30Tq7fClY7jCMMefouzvAyhRtjYhivciT6dftSXbpTICj.aPK','admin','fds','fds','2025-06-26'),
(12,'markon','$2y$12$BFsV5gkCcE7q61ROnANi6.BCOANTer.rkBjIrK5DOyCiYmqq9EFsG','editor','testtest','test','2025-06-26'),
(14,'sda','$2y$12$woGjXFR/nbfpf1MXztds5OG8FGNfypK/2lcOZupEOQJlntE3OD.La','editor','fds','fds','2025-06-26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-08-04 17:12:24


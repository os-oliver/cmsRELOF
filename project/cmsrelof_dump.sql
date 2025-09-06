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
(3,'Luka','Glisic','lukaglisic.srb@gmail.com','3213233','Problem','Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si Zdravo kako si ','2025-07-02 15:54:46'),
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
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `source_id` bigint(20) DEFAULT NULL,
  `source_table` varchar(64) DEFAULT NULL,
  `field_name` varchar(64) DEFAULT NULL,
  `lang` char(10) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_id` (`source_id`,`source_table`,`field_name`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text`
--

LOCK TABLES `text` WRITE;
/*!40000 ALTER TABLE `text` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `text` VALUES
(1,1,'aboutus','mission','sr','Centar za kulturu ima za cilj da bude pokretač umetničkog, kulturnog i obrazovnog života zajednice, stvarajući prostor za kreativno izražavanje, očuvanje tradicije i promociju savremenih kulturnih tokova. Kroz raznovrsne programe i manifestacije, Centar podstiče dijalog, toleranciju i razvoj kulturne svesti svih generacija.'),
(2,1,'aboutus','goal','sr','Glavni cilj Centra za kulturu je obogaćivanje kulturnog života zajednice putem organizovanja koncerata, pozorišnih predstava, izložbi, radionica i edukativnih programa, sa posebnim fokusom na uključivanje mladih, očuvanje lokalnog identiteta i unapređenje kulturne ponude na lokalnom i regionalnom nivou.'),
(3,1,'category','name','sr','Obaveštenja'),
(4,2,'category','name','sr','Konkursi'),
(5,3,'category','name','sr','Javni pozivi'),
(6,4,'category','name','sr','Odluke'),
(7,5,'category','name','sr','Projekti'),
(8,6,'category','name','sr','Izveštaji'),
(9,1,'category_document','name','sr','Godišnji izveštaj'),
(10,2,'category_document','name','sr','Finansijski izveštaj'),
(11,3,'category_document','name','sr','Izveštaji o projektima'),
(12,4,'category_document','name','sr','Tehnička dokumentacija'),
(13,5,'category_document','name','sr','Pravni dokumenti'),
(14,18,'document','title','sr','Godišnji izveštaj 2024'),
(15,18,'document','description','sr','Detaljan godišnji izveštaj za 2024. godinu.'),
(16,19,'document','title','sr','Finansijski izveštaj Q1 2025'),
(17,19,'document','description','sr','Pregled finansijskih rezultata za prvi kvartal 2025.'),
(18,20,'document','title','sr','Izveštaj o projektu Alfa'),
(19,20,'document','description','sr','Izveštaj o napretku i rezultatima projekta Alfa.'),
(20,21,'document','title','sr','Tehnička dokumentacija robota'),
(21,21,'document','description','sr','Detaljna tehnička specifikacija robota za proizvodnju'),
(22,22,'document','title','sr','Ugovor o saradnji'),
(23,22,'document','description','sr','Pravni dokument ugovora o poslovnoj saradnji.'),
(24,5,'employee','name','sr','Aleksandra'),
(25,5,'employee','surname','sr','Ćirić'),
(26,5,'employee','biography','sr','Odgovorna za umetnički program i saradnju sa umetnicima.'),
(27,6,'employee','name','sr','Čedomir'),
(28,6,'employee','surname','sr','Čolić'),
(29,6,'employee','biography','sr','Organizuje izložbe i vodi brigu o umetničkim kolekcijama.'),
(30,7,'employee','name','sr','Špela'),
(31,7,'employee','surname','sr','Šarić'),
(32,7,'employee','biography','sr','Zadužena za tehničku realizaciju događaja i izložbi.'),
(33,8,'employee','name','sr','Željko'),
(34,8,'employee','surname','sr','Živković'),
(35,8,'employee','biography','sr','Komunicira sa medijima i promoviše kulturne događaje.'),
(36,9,'employee','name','sr','Đorđe'),
(37,9,'employee','surname','sr','Đukić'),
(38,9,'employee','biography','sr','Pomaže u postavljanju i demontiranju scenografije.'),
(39,10,'employee','name','sr','Anđela'),
(40,10,'employee','surname','sr','Anđelković'),
(41,10,'employee','biography','sr','Planira i koordinira kulturne manifestacije.'),
(42,11,'employee','name','sr','Luka'),
(43,11,'employee','surname','sr','Lukić'),
(44,11,'employee','biography','sr','Brine o produkciji predstava i koncerata.'),
(45,12,'employee','name','sr','Jasmina'),
(46,12,'employee','surname','sr','Jasnić'),
(47,12,'employee','biography','sr','Dočekuje posetioce i pruža informacije o događajima.'),
(48,13,'employee','name','sr','Vesna'),
(49,13,'employee','surname','sr','Vesnić'),
(50,13,'employee','biography','sr','Zadužena za jezičku i stilsku ispravnost promotivnih materijala.'),
(51,14,'employee','name','sr','Zoran'),
(52,14,'employee','surname','sr','Zorić'),
(53,14,'employee','biography','sr','Organizuje i vodi kreativne radionice za decu i odrasle.'),
(54,1,'events','title','sr','Izložba srednjovekovne umetnosti'),
(55,1,'events','description','sr','Izložba radova srednjovekovnih umetnika u galeriji.'),
(56,2,'events','title','sr','Radionica IT-a'),
(57,2,'events','description','sr','Intenzivna radionica programiranja za početnike.'),
(58,3,'events','title','sr','Dečiji festival pozorišta'),
(59,3,'events','description','sr','Festival pozorišnih predstava za decu i mlade.'),
(60,5,'events','title','sr','Seminar o veštačkoj inteligenciji'),
(61,5,'events','description','sr','Seminar o primeni AI tehnologija u industriji.'),
(62,6,'events','title','sr','Okrugli sto: Lokalna zajednica'),
(63,6,'events','description','sr','Diskusija o unapređenju uslova u lokalnoj zajednici.'),
(64,7,'events','title','sr','Nasa'),
(65,7,'events','description','sr','ggfdgfdfgd'),
(66,8,'events','title','sr','App'),
(67,8,'events','description','sr','fdsfs'),
(68,6,'gallery','title','sr','Boje Zrenjanina'),
(69,6,'gallery','description','sr','Izložba slika „Boje Zrenjanina“'),
(70,7,'gallery','title','sr','Noć uz muziku'),
(71,7,'gallery','description','sr','Letnji koncert na otvorenom'),
(72,8,'gallery','title','sr','Predstava Mala scena'),
(73,8,'gallery','description','sr','Pozorišna predstava na Maloj sceni'),
(74,9,'gallery','title','sr','Dečija umetnička radionica'),
(75,9,'gallery','description','sr','Kreativna radionica za najmlađe'),
(76,10,'gallery','title','sr','Digitalne tehnologije danas'),
(77,10,'gallery','description','sr','Seminar o digitalnim inovacijama'),
(78,1,'kategorije_dogadjaja','naziv','sr','Edukativni događaji'),
(79,2,'kategorije_dogadjaja','naziv','sr','Kulturni događaji'),
(80,3,'kategorije_dogadjaja','naziv','sr','Događaji za decu i mlade'),
(81,4,'kategorije_dogadjaja','naziv','sr','Digitalni i tehnološki'),
(82,5,'kategorije_dogadjaja','naziv','sr','Zajednica i društvo'),
(83,6,'kategorije_dogadjaja','naziv','sr','Interni događaji'),
(84,7,'kategorije_dogadjaja','naziv','sr','Online događaji'),
(85,1,'news','title','sr','Novi konkurs za mlade istraživače'),
(86,1,'news','content','sr','Objavljen je konkurs za finansiranje inovativnih projekata mladih istraživača. Rok za prijavu je 15. jul.'),
(87,2,'news','title','sr','Obaveštenje o radnom vremenu tokom praznika'),
(88,2,'news','content','sr','Tokom državnog praznika, kancelarije neće raditi 1. i 2. jula.'),
(89,3,'news','title','sr','Poziv za učešće na javnoj raspravi'),
(90,3,'news','content','sr','Pozivamo građane da učestvuju u javnoj raspravi o planu razvoja grada.'),
(91,4,'news','title','sr','Odluka o budžetu za narednu godinu'),
(92,4,'news','content','sr','Usvojena je odluka o budžetu za 2026. godinu, sa fokusom na obrazovanje i infrastrukturu.'),
(93,5,'news','title','sr','Završetak projekta \"Pametni grad\"'),
(94,5,'news','content','sr','Projekat \"Pametni grad\" uspešno je završen i rezultati su dostupni na sajtu.'),
(95,6,'news','title','sr','Godišnji izveštaj o radu institucije'),
(96,6,'news','content','sr','Objavljen je godišnji izveštaj koji prikazuje ostvarene ciljeve i izazove tokom protekle godine.');

-- English (en) versions
INSERT INTO `text` VALUES
(97,1,'aboutus','mission','en','The Cultural Center aims to be a driving force of the artistic, cultural, and educational life of the community, creating space for creative expression, preservation of tradition, and promotion of contemporary cultural trends. Through diverse programs and events, the Center encourages dialogue, tolerance, and the development of cultural awareness across all generations.'),
(98,1,'aboutus','goal','en','The main goal of the Cultural Center is to enrich the cultural life of the community through organizing concerts, theater performances, exhibitions, workshops, and educational programs, with a special focus on youth inclusion, preservation of local identity, and enhancement of cultural offerings at local and regional levels.'),
(99,1,'category','name','en','Announcements'),
(100,2,'category','name','en','Competitions'),
(101,3,'category','name','en','Public Calls'),
(102,4,'category','name','en','Decisions'),
(103,5,'category','name','en','Projects'),
(104,6,'category','name','en','Reports'),
(105,1,'category_document','name','en','Annual Report'),
(106,2,'category_document','name','en','Financial Report'),
(107,3,'category_document','name','en','Project Reports'),
(108,4,'category_document','name','en','Technical Documentation'),
(109,5,'category_document','name','en','Legal Documents'),
(110,18,'document','title','en','Annual Report 2024'),
(111,18,'document','description','en','Detailed annual report for the year 2024.'),
(112,19,'document','title','en','Financial Report Q1 2025'),
(113,19,'document','description','en','Overview of financial results for the first quarter of 2025.'),
(114,20,'document','title','en','Project Alpha Report'),
(115,20,'document','description','en','Progress and results report for Project Alpha.'),
(116,21,'document','title','en','Robot Technical Documentation'),
(117,21,'document','description','en','Detailed technical specifications for the production robot.'),
(118,22,'document','title','en','Cooperation Agreement'),
(119,22,'document','description','en','Legal document for business cooperation agreement.'),
(120,5,'employee','name','en','Aleksandra'),
(121,5,'employee','surname','en','Ćirić'),
(122,5,'employee','biography','en','Responsible for artistic programs and collaboration with artists.'),
(123,6,'employee','name','en','Čedomir'),
(124,6,'employee','surname','en','Čolić'),
(125,6,'employee','biography','en','Organizes exhibitions and manages art collections.'),
(126,7,'employee','name','en','Špela'),
(127,7,'employee','surname','en','Šarić'),
(128,7,'employee','biography','en','Responsible for technical realization of events and exhibitions.'),
(129,8,'employee','name','en','Željko'),
(130,8,'employee','surname','en','Živković'),
(131,8,'employee','biography','en','Communicates with media and promotes cultural events.'),
(132,9,'employee','name','en','Đorđe'),
(133,9,'employee','surname','en','Đukić'),
(134,9,'employee','biography','en','Assists with setup and dismantling of stage scenery.'),
(135,10,'employee','name','en','Anđela'),
(136,10,'employee','surname','en','Anđelković'),
(137,10,'employee','biography','en','Plans and coordinates cultural manifestations.'),
(138,11,'employee','name','en','Luka'),
(139,11,'employee','surname','en','Lukić'),
(140,11,'employee','biography','en','Takes care of production of shows and concerts.'),
(141,12,'employee','name','en','Jasmina'),
(142,12,'employee','surname','en','Jasnić'),
(143,12,'employee','biography','en','Welcomes visitors and provides event information.'),
(144,13,'employee','name','en','Vesna'),
(145,13,'employee','surname','en','Vesnić'),
(146,13,'employee','biography','en','Responsible for linguistic and stylistic accuracy of promotional materials.'),
(147,14,'employee','name','en','Zoran'),
(148,14,'employee','surname','en','Zorić'),
(149,14,'employee','biography','en','Organizes and leads creative workshops for children and adults.'),
(150,1,'events','title','en','Medieval Art Exhibition'),
(151,1,'events','description','en','Exhibition of medieval artists'' works in the gallery.'),
(152,2,'events','title','en','IT Workshop'),
(153,2,'events','description','en','Intensive programming workshop for beginners.'),
(154,3,'events','title','en','Children''s Theater Festival'),
(155,3,'events','description','en','Theater performance festival for children and youth.'),
(156,5,'events','title','en','Seminar on Artificial Intelligence'),
(157,5,'events','description','en','Seminar on application of AI technologies in industry.'),
(158,6,'events','title','en','Round Table: Local Community'),
(159,6,'events','description','en','Discussion on improving conditions in the local community.'),
(160,7,'events','title','en','Nasa'),
(161,7,'events','description','en','ggfdgfdfgd'),
(162,8,'events','title','en','App'),
(163,8,'events','description','en','fdsfs'),
(164,6,'gallery','title','en','Colors of Zrenjanin'),
(165,6,'gallery','description','en','Painting exhibition "Colors of Zrenjanin"'),
(166,7,'gallery','title','en','Night with Music'),
(167,7,'gallery','description','en','Summer open-air concert'),
(168,8,'gallery','title','en','Small Stage Performance'),
(169,8,'gallery','description','en','Theater performance on the Small Stage'),
(170,9,'gallery','title','en','Children''s Art Workshop'),
(171,9,'gallery','description','en','Creative workshop for the youngest'),
(172,10,'gallery','title','en','Digital Technologies Today'),
(173,10,'gallery','description','en','Seminar on digital innovations'),
(174,1,'kategorije_dogadjaja','naziv','en','Educational Events'),
(175,2,'kategorije_dogadjaja','naziv','en','Cultural Events'),
(176,3,'kategorije_dogadjaja','naziv','en','Events for Children and Youth'),
(177,4,'kategorije_dogadjaja','naziv','en','Digital and Technological'),
(178,5,'kategorije_dogadjaja','naziv','en','Community and Society'),
(179,6,'kategorije_dogadjaja','naziv','en','Internal Events'),
(180,7,'kategorije_dogadjaja','naziv','en','Online Events'),
(181,1,'news','title','en','New Competition for Young Researchers'),
(182,1,'news','content','en','A competition for funding innovative projects of young researchers has been announced. The application deadline is July 15.'),
(183,2,'news','title','en','Notice on Working Hours During Holidays'),
(184,2,'news','content','en','During the state holiday, offices will be closed on July 1 and 2.'),
(185,3,'news','title','en','Invitation to Participate in Public Debate'),
(186,3,'news','content','en','Citizens are invited to participate in the public debate on the city development plan.'),
(187,4,'news','title','en','Decision on Next Year''s Budget'),
(188,4,'news','content','en','The decision on the budget for 2026 has been adopted, with a focus on education and infrastructure.'),
(189,5,'news','title','en','Completion of the "Smart City" Project'),
(190,5,'news','content','en','The "Smart City" project has been successfully completed and results are available on the website.'),
(191,6,'news','title','en','Annual Report on Institution''s Work'),
(192,6,'news','content','en','The annual report has been published, showing achieved goals and challenges during the past year.');

-- Cyrillic (cyr) versions
INSERT INTO `text` VALUES
(193,1,'aboutus','mission','sr-Cyrl','Центар за културу има за циљ да буде покретач уметничког, културног и образовног живота заједнице, стварајући простор за креативно изражавање, очување традиције и промоцију савремених културних токова. Кроз разноврсне програме и манифестације, Центар подстиче дијалог, толеранцију и развој културне свести свих генерација.'),
(194,1,'aboutus','goal','sr-Cyrl','Главни циљ Центра за културу је обогаћивање културног живота заједнице путем организације концерата, позоришних представа, изложби, радионица и едукативних програма, са посебним фокусом на укључивање младих, очување локалног идентитета и унапређење културне понуде на локалном и регионалном нивоу.'),
(195,1,'category','name','sr-Cyrl','Објаве'),
(196,2,'category','name','sr-Cyrl','Конкурси'),
(197,3,'category','name','sr-Cyrl','Јавни позиви'),
(198,4,'category','name','sr-Cyrl','Одлуке'),
(199,5,'category','name','sr-Cyrl','Пројекти'),
(200,6,'category','name','sr-Cyrl','Извештаји'),
(201,1,'category_document','name','sr-Cyrl','Годишњи извештај'),
(202,2,'category_document','name','sr-Cyrl','Финансијски извештај'),
(203,3,'category_document','name','sr-Cyrl','Извештаји о пројектима'),
(204,4,'category_document','name','sr-Cyrl','Техничка документација'),
(205,5,'category_document','name','sr-Cyrl','Правни документи'),
(206,18,'document','title','sr-Cyrl','Годишњи извештај 2024'),
(207,18,'document','description','sr-Cyrl','Детаљни годишњи извештај за 2024. годину.'),
(208,19,'document','title','sr-Cyrl','Финансијски извештај Q1 2025'),
(209,19,'document','description','sr-Cyrl','Преглед финансијских резултата за први квартал 2025.'),
(210,20,'document','title','sr-Cyrl','Извештај о пројекту Алфа'),
(211,20,'document','description','sr-Cyrl','Извештај о напретку и резултатима пројекта Алфа.'),
(212,21,'document','title','sr-Cyrl','Техничка документација робота'),
(213,21,'document','description','sr-Cyrl','Детаљна техничка спецификација робота за производњу'),
(214,22,'document','title','sr-Cyrl','Уговор о сарадњи'),
(215,22,'document','description','sr-Cyrl','Правни документ уговора о пословној сарадњи.'),
(216,5,'employee','name','sr-Cyrl','Александра'),
(217,5,'employee','surname','sr-Cyrl','Ћирић'),
(218,5,'employee','biography','sr-Cyrl','Одговорна за уметнички програм и сарадњу са уметницима.'),
(219,6,'employee','name','sr-Cyrl','Чедомир'),
(220,6,'employee','surname','sr-Cyrl','Чолић'),
(221,6,'employee','biography','sr-Cyrl','Организује изложбе и води бригу о уметничким колекцијама.'),
(222,7,'employee','name','sr-Cyrl','Шпела'),
(223,7,'employee','surname','sr-Cyrl','Шарић'),
(224,7,'employee','biography','sr-Cyrl','Задужена за техничку реализацију догађаја и изложби.'),
(225,8,'employee','name','sr-Cyrl','Жељко'),
(226,8,'employee','surname','sr-Cyrl','Живковић'),
(227,8,'employee','biography','sr-Cyrl','Комуницира са медијима и промовише културне догађаје.'),
(228,9,'employee','name','sr-Cyrl','Ђорђе'),
(229,9,'employee','surname','sr-Cyrl','Ђукић'),
(230,9,'employee','biography','sr-Cyrl','Помаже у постављању и демонтирању сценографије.'),
(231,10,'employee','name','sr-Cyrl','Анђела'),
(232,10,'employee','surname','sr-Cyrl','Анђелковић'),
(233,10,'employee','biography','sr-Cyrl','Планира и координира културне манифестације.'),
(234,11,'employee','name','sr-Cyrl','Лука'),
(235,11,'employee','surname','sr-Cyrl','Лукић'),
(236,11,'employee','biography','sr-Cyrl','Брине о продукцији представа и концерата.'),
(237,12,'employee','name','sr-Cyrl','Јасмина'),
(238,12,'employee','surname','sr-Cyrl','Јаснић'),
(239,12,'employee','biography','sr-Cyrl','Дочекује посетиоце и пружа информације о догађајима.'),
(240,13,'employee','name','sr-Cyrl','Весна'),
(241,13,'employee','surname','sr-Cyrl','Весић'),
(242,13,'employee','biography','sr-Cyrl','Задужена за језичку и стилску исправност промотивних материјала.'),
(243,14,'employee','name','sr-Cyrl','Зоран'),
(244,14,'employee','surname','sr-Cyrl','Зорић'),
(245,14,'employee','biography','sr-Cyrl','Организује и води креативне радионице за децу и одрасле.'),
(246,1,'events','title','sr-Cyrl','Изложба средњовековне уметности'),
(247,1,'events','description','sr-Cyrl','Изложба радова средњовековних уметника у галерији.'),
(248,2,'events','title','sr-Cyrl','Радиonica ИТ-а'),
(249,2,'events','description','sr-Cyrl','Интензивна радионица програмирања за почетнике.'),
(250,3,'events','title','sr-Cyrl','Дечији фестивал позоришта'),
(251,3,'events','description','sr-Cyrl','Фестивал позоришних представа за децу и младе.'),
(252,5,'events','title','sr-Cyrl','Семинар о вештачкој интелигенцији'),
(253,5,'events','description','sr-Cyrl','Семинар о примени AI технологија у индустрији.'),
(254,6,'events','title','sr-Cyrl','Округли сто: Локална заједница'),
(255,6,'events','description','sr-Cyrl','Дискусија о унапређењу услова у локалној заједници.'),
(256,7,'events','title','sr-Cyrl','Наса'),
(257,7,'events','description','sr-Cyrl','ггфдгфдфгд'),
(258,8,'events','title','sr-Cyrl','Апп'),
(259,8,'events','description','sr-Cyrl','фдсфс'),
(260,6,'gallery','title','sr-Cyrl','Боје Зрењанина'),
(261,6,'gallery','description','sr-Cyrl','Изложба слика „Боје Зрењанина“'),
(262,7,'gallery','title','sr-Cyrl','Ноћ уз музику'),
(263,7,'gallery','description','sr-Cyrl','Летњи концерт на отвореном'),
(264,8,'gallery','title','sr-Cyrl','Представа Мала сцена'),
(265,8,'gallery','description','sr-Cyrl','Позоришна представа на Малој сцени'),
(266,9,'gallery','title','sr-Cyrl','Дечија уметничка радиonica'),
(267,9,'gallery','description','sr-Cyrl','Креативна радионица за најмлађе'),
(268,10,'gallery','title','sr-Cyrl','Дигиталне технологије данас'),
(269,10,'gallery','description','sr-Cyrl','Семинар о дигиталним иновацијама'),
(270,1,'kategorije_dogadjaja','naziv','sr-Cyrl','Едукативни догађаји'),
(271,2,'kategorije_dogadjaja','naziv','sr-Cyrl','Културни догађаји'),
(272,3,'kategorije_dogadjaja','naziv','sr-Cyrl','Догађаји за децу и младе'),
(273,4,'kategorije_dogadjaja','naziv','sr-Cyrl','Дигитални и технолошки'),
(274,5,'kategorije_dogadjaja','naziv','sr-Cyrl','Заједница и друштво'),
(275,6,'kategorije_dogadjaja','naziv','sr-Cyrl','Интерни догађаји'),
(276,7,'kategorije_dogadjaja','naziv','sr-Cyrl','Онлајн догађаји'),
(277,1,'news','title','sr-Cyrl','Нови конкурс за младе истраживаче'),
(278,1,'news','content','sr-Cyrl','Објављен је конкурс за финансирање иновативних пројеката младих истраживача. Рок за пријаву је 15. јул.'),
(279,2,'news','title','sr-Cyrl','Обавештење о радном времену током празника'),
(280,2,'news','content','sr-Cyrl','Током државног празника, канцеларије неће радити 1. и 2. јула.'),
(281,3,'news','title','sr-Cyrl','Позив за учешће на јавној расправи'),
(282,3,'news','content','sr-Cyrl','Позивамо грађане да учествују у јавној расправи о плану развоја града.'),
(283,4,'news','title','sr-Cyrl','Одлука о буџету за наредну годину'),
(284,4,'news','content','sr-Cyrl','Усвојена је одлука о буџету за 2026. годину, са фокусом на образовање и инфраструктуру.'),
(285,5,'news','title','sr-Cyrl','Завршеток пројекта "Паметни град"'),
(286,5,'news','content','sr-Cyrl','Пројекат "Паметни град" успешно је завршен и резултати су доступни на сајту.'),
(287,6,'news','title','sr-Cyrl','Годишњи извештај о раду институције'),
(288,6,'news','content','sr-Cyrl','Објављен је годишњи извештај који приказује остварене циљеве и изазове током прошле године.');

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
/*M!999999\- enable the sandbox mode */ 
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
  `mission` text NOT NULL,
  `goal` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aboutus`
--

LOCK TABLES `aboutus` WRITE;
/*!40000 ALTER TABLE `aboutus` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `aboutus` VALUES
(1,'Centar za kulturu ima za cilj da bude pokretač umetničkog, kulturnog i obrazovnog života zajednice, stvarajući prostor za kreativno izražavanje, očuvanje tradicije i promociju savremenih kulturnih tokova. Kroz raznovrsne programe i manifestacije, Centar podstiče dijalog, toleranciju i razvoj kulturne svesti svih generacija.','Glavni cilj Centra za kulturu je obogaćivanje kulturnog života zajednice putem organizovanja koncerata, pozorišnih predstava, izložbi, radionica i edukativnih programa, sa posebnim fokusom na uključivanje mladih, očuvanje lokalnog identiteta i unapređenje kulturne ponude na lokalnom i regionalnom nivou.');
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
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
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
  `name` varchar(100) NOT NULL,
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
(1,'Obaveštenja','bg-yellow-100'),
(2,'Konkursi','bg-blue-100'),
(3,'Javni pozivi','bg-green-100'),
(4,'Odluke','bg-red-100'),
(5,'Projekti','bg-purple-100'),
(6,'Izveštaji','bg-indigo-100');
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
  `name` varchar(100) NOT NULL,
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
(1,'Godišnji izveštaji','blue-500'),
(2,'Finansijski izveštaji','green-500'),
(3,'Izveštaji o projektima','yellow-500'),
(4,'Tehnička dokumentacija','purple-500'),
(5,'Pravni dokumenti','red-500');
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
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
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
(18,'0ff65d237d6df42d.pdf','pdf','2025-07-03 16:00:51','Godišnji izveštaj 2024','Detaljan godišnji izveštaj za 2024. godinu.',0.05,1),
(19,'e1c0bac216d65be4.pdf','pdf','2025-07-03 16:01:34','Finansijski izveštaj Q1 2025','Pregled finansijskih rezultata za prvi kvartal 2025.',0.05,2),
(20,'407315860f0774be.docx','docx','2025-07-03 16:05:07','Izveštaj o projektu Alfa','Izveštaj o napretku i rezultatima projekta Alfa.',0,3),
(21,'53bef49b731d7f87.xlsx','xlsx','2025-07-03 16:05:47','Tehnička dokumentacija robota','Detaljna tehnička specifikacija robota za proizvodnju',0.01,4),
(22,'513881c4480ca323.docx','docx','2025-07-03 16:06:39','Ugovor o saradnji','Pravni dokument ugovora o poslovnoj saradnji.',0,5);
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
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `biography` text DEFAULT NULL,
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
(5,'Aleksandra','Ćirić','direktor','Odgovorna za umetnički program i saradnju sa umetnicima.'),
(6,'Čedomir','Čolić','Kustos','Organizuje izložbe i vodi brigu o umetničkim kolekcijama.'),
(7,'Špela','Šarić','Tehnički koordinator','Zadužena za tehničku realizaciju događaja i izložbi.'),
(8,'Željko','Živković','PR menadžer','Komunicira sa medijima i promoviše kulturne događaje.'),
(9,'Đorđe','Đukić','Scenski radnik','Pomaže u postavljanju i demontiranju scenografije.'),
(10,'Anđela','Anđelković','Organizator programa','Planira i koordinira kulturne manifestacije.'),
(11,'Luka','Lukić','Producent','Brine o produkciji predstava i koncerata.'),
(12,'Jasmina','Jasnić','Recepcioner','Dočekuje posetioce i pruža informacije o događajima.'),
(13,'Vesna','Vesnić','Lektor','Zadužena za jezičku i stilsku ispravnost promotivnih materijala.'),
(14,'Zoran','Zorić','Voditelj radionica','Organizuje i vodi kreativne radionice za decu i odrasle.');
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
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
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
(1,2,'Izložba srednjovekovne umetnosti	','Izložba radova srednjovekovnik umetnika u galeriji.	','2025-06-03','17:20:00','2025-07-03 16:20:22','/uploads/images/b4c8421f7d592794.jpeg','Kulturni centar'),
(2,1,'Radionica IT-a','Intenzivna radionica programiranja za početnike.	','2025-06-02','16:24:00','2025-07-03 16:23:54','/uploads/images/6b7e6daa3b3594f9.jpg','Edukativni centar'),
(3,3,'Dečiji festival pozorišta	','Festival pozorišnih predstava za decu i mlade.	','2025-06-04','16:37:00','2025-07-03 16:33:18','/uploads/images/4fa5db671d8043d0.jpg','Pozorište'),
(5,4,'Seminar o veštačkoj inteligenciji','Seminar o primeni AI tehnologija u industriji.\r\n','2025-06-05','16:36:00','2025-07-03 16:35:32','/uploads/images/e02147d78d12f050.jpg','Digitalni centar'),
(6,5,'Okrugli sto: Lokalna zajednica	','Diskusija o unapređenju uslova u lokalnoj zajednici.	','2025-06-06','20:36:00','2025-07-03 16:36:45','/uploads/images/0e061695897e1667.jpg','Gradska sala'),
(7,4,'nasa','ggfdgfdfgd','2025-08-05','13:16:00','2025-08-04 13:12:19','/uploads/images/4b3f433648758912.png','lokacija'),
(8,2,'app','fdsfs','2025-08-14','13:15:00','2025-08-04 13:13:00','/uploads/images/','fdsfds');
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
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
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
(6,'Boje Zrenjanina	','Izložba slika „Boje Zrenjanina“\r\n','/uploads/gallery/a26a9b9104f8e4d0.jpg','2025-07-03 14:40:42'),
(7,'Noc uz muziku	','Letnji koncert na otvorenom\n','/uploads/gallery/53f8752bdb6f259a.jpg','2025-07-03 14:41:51'),
(8,'Predstava Mala scena','Pozorišna predstava na Maloj sceni\r\n','/uploads/gallery/bce46052e1e72bc2.jpg','2025-07-03 14:42:29'),
(9,'Dečija umetnička radionica	','Kreativna radionica za najmlađe\r\n','/uploads/gallery/640993caee7511af.jpg','2025-07-03 14:43:14'),
(10,'Digitalne tehnologije danas	','Seminar o digitalnim inovacijama','/uploads/gallery/c1bda5f2a9ba8662.jpg','2025-07-03 14:44:19');
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
  `naziv` varchar(100) NOT NULL,
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
(1,'Edukativni događaji','blue-500'),
(2,'Kulturni događaji','purple-500'),
(3,'Događaji za decu i mlade','yellow-500'),
(4,'Digitalni i tehnološki','indigo-500'),
(5,'Zajednica i društvo','green-500'),
(6,'Interni događaji','gray-500'),
(7,'Online događaji','red-500');
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
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `published_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci DEFAULT NULL,
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
(1,'Novi konkurs za mlade istraživače','Milena Petrović','2025-06-10','2025-06-25 09:55:46',2,'Objavljen je konkurs za finansiranje inovativnih projekata mladih istraživača. Rok za prijavu je 15. jul.'),
(2,'Obaveštenje o radnom vremenu tokom praznika','Marko Jovanović','2025-06-20','2025-06-25 09:55:46',1,'Tokom državnog praznika, kancelarije neće raditi 1. i 2. jula.'),
(3,'Poziv za učešće na javnoj raspravi','Ana Nikolić','2025-06-15','2025-06-25 09:55:46',3,'Pozivamo građane da učestvuju u javnoj raspravi o planu razvoja grada.'),
(4,'Odluka o budžetu za narednu godinu','Ivana Kovač','2025-06-12','2025-06-25 09:55:46',4,'Usvojena je odluka o budžetu za 2026. godinu, sa fokusom na obrazovanje i infrastrukturu.'),
(5,'Završetak projekta \"Pametni grad\"','Nikola Lukić','2025-06-11','2025-06-25 09:55:46',5,'Projekat \"Pametni grad\" uspešno je završen i rezultati su dostupni na sajtu.'),
(6,'Godišnji izveštaj o radu institucije','Jelena Milić','2025-06-18','2025-06-25 09:55:46',6,'Objavljen je godišnji izveštaj koji prikazuje ostvarene ciljeve i izazove tokom protekle godine.');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
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
